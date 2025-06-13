<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Http\Requests\ComplaintFormCreateRequest;
use App\Http\Requests\ComplaintFormUpdateRequest;
use App\Models\Animal;
use App\Models\AutomatedCountryEmail;
use App\Models\AutomatedEmailContacts;
use App\Models\AutomatedResponse;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Location;
use App\Models\OutcomeOptions;
use App\Models\OutcomeOptionsCategories;
use App\Models\Severity;
use App\Providers\ComplaintFilled;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ComplaintFormController extends Controller
{
    public function index()
    {
        $userClinics = [];

        if (!auth()->user()->admin) {
            $userClinics[] = ClinicManagers::where('user_id', '=', auth()->id())
                ->get()
                ->pluck('clinic_id')
                ->toArray();

            if (auth()->user()->role->name === 'New Zealand Maintenance') {
                $userClinics[] = Clinic::where('country', '=', 'new zealand')
                    ->get()
                    ->pluck('id')
                    ->toArray();
            }
        }

        $queryData = \filter_var_array(
            \array_filter(request()->all(), function ($element) {
                return is_array($element);
            }), FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );

        $forms = ComplaintForm::query();

        $forms->whereIn('clinic_id', function ($query) {
            return $query->select('id')
                ->from('clinics')
                ->where('name', 'not like', '%test%');
        });

        foreach ($queryData as $data) {
            if (isset($data['column'], $data['search'], $data['type'])) {
                $this->createQuery($forms, $data);
            }
        }

        $forms = $forms->when(!auth()->user()->admin, function ($query) use ($userClinics) {
            return $query->whereIn('clinic_id', array_merge(...$userClinics));
        })
            ->with(['clinic', 'clinic.managers', 'clinic.managers.user', 'location', 'category', 'type', 'channel', 'animal', 'severity'])
            ->orderBy('created_at', 'DESC')
            ->paginate(20);

        /**
         * The Original project had functionality where you could set individual permissions
         * for each user - this has been removed, but for simplicity $canEdit is set to be true always
         */
        // $canEdit = auth()->user()->admin == 1 ||
        //         auth()->user()->role->hasPermission('w') ? true : false;

        $data = [
            'forms'          => $forms,
            'canEdit'        => true,
            'canDelete'      => auth()->user()->admin == 1,
            'severities'     => Severity::get(),
            'outcomes'       => OutcomeOptions::orderBy('name', 'asc')->get(),
            'outcomeOptions' => OutcomeOptionsCategories::with(['options'])->get(),
            'export'         => false,
            'aggressions'    => ComplaintForm::clientAggressionValues(),
            'countries'      => Clinic::$countries,
        ];

        if (!request()->ajax()) {
            $data['locations'] = Location::orderBy('name', 'asc')->get();
            $data['categories'] = ComplaintCategory::orderBy('name', 'asc')->get();
            $data['types'] = ComplaintType::orderBy('name', 'asc')->get();
            $data['channels'] = ComplaintChannel::orderBy('name', 'asc')->get();
            $data['animals'] = Animal::orderBy('name', 'asc')->get();

            return view('complaint-form/index', $data);
        }

        return [
            'html'       => view('complaint-form/partials/_forms', $data)->render(),
            'pagination' => view('pagination', [
                'paginator' => $forms,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'forms',
                'container' => 'forms-container',
                'filter'    => 'forms-filter',
            ])->render()
        ];
    }

    /**
     * Show the message after the form is sent.
     *
     * @return Response
     */
    public function sent()
    {

        if (rtrim(request()->server('HTTP_REFERER'), "/") != route('complaint-form.create')) {
            return redirect()->route('complaint-form.create');
        }

        return view('complaint-form/form-sent');
    }

    public function create()
    {
        return view('form', [
            'task'        => 'create',
            'view'        => 'complaint-form',
            'clinics'     => Clinic::with([
                                              'managers' => function ($query) {
                                                  return $query->whereIn('manager_type_id',
                                                                         [
                                                                             ClinicManagers::managerID('regional_manager'),
                                                                             ClinicManagers::managerID('veterinary_manager'),
                                                                             ClinicManagers::managerID('general_manager'),

                                                                         ]);
                                              },
                                              'managers.user'
                                          ])
                ->orderBy('name', 'asc')
                ->get(),
            'categories'  => ComplaintCategory::orderBy('name')->get(),
            'types'       => ComplaintType::orderBy('name')->get(),
            'channels'    => ComplaintChannel::orderBy('name')->get(),
            // 'locations'   => Location::orderBy('name')->get(),
            'severities'  => Severity::get(),
            'animals'     => Animal::get(),
            'aggressions' => ComplaintForm::clientAggressionValues(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ComplaintFormCreateRequest $request
     * @return RedirectResponse
     */
    public function store(ComplaintFormCreateRequest $request): RedirectResponse
    {
        $autoResponse = AutomatedResponse::whereJsonContains('scenario->categories', $request->complaint_category_id)
            ->whereJsonContains('scenario->types', $request->complaint_type_id)
            ->whereJsonContains('scenario->channels', $request->complaint_channel_id)
            ->whereJsonContains('scenario->severity', $request->severity_id)
            ->first();

        $autoEmailContacts = AutomatedEmailContacts::whereJsonContains(
            'scenario->categories', $request->complaint_category_id
        )
            ->orWhereJsonContains(
                'scenario->types', $request->complaint_type_id
            )
            ->orWhereJsonContains(
                'scenario->channels', $request->complaint_channel_id
            )
            ->orWhereJsonContains(
                'scenario->severity', $request->severity_id
            )
            ->orWhereJsonContains(
                'scenario->aggression', $request->aggression
            )->get();

        if (!$autoResponse) {
            $autoResponse = AutomatedResponse::where('default', '=', true)->first();
        }

        $model = new ComplaintForm();
        $data = $model->format($request->all());

        $data['level'] = $autoResponse->level ?? null;

        $model = $model->create($data);

        $directory = 'documents/complaint_form_' . $model->id;

        if (request()->hasFile('documents')) {
            foreach (request()->file('documents') as $file) {
                $fileName =
                    \strtolower(
                        \str_replace(' ', '',
                                     \filter_var($file->getClientOriginalName(),
                                                 FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                                                 FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                                     )
                        )
                    );

                Storage::putFileAs($directory,
                                   $file,
                                   $fileName);

            }
        }

        $autoEmailContactsData = \implode(',', $autoEmailContacts->pluck('contacts')->toArray());


        $clinic = Clinic::find($data['clinic_id']);

        $autoCountryEmails = AutomatedCountryEmail::where('country', $clinic->country)->first();

        ComplaintFilled::dispatch(
            $model,
            $autoResponse,
            $autoEmailContactsData,
            $autoCountryEmails,
        );

        return redirect()->route('complaint-form.sent')
            ->with([
                       'status'   => [
                           'message' => "You have file the complaint successfully",
                       ],
                       'response' => $autoResponse,
                       'user'     => $model->team_member,
                   ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ComplaintForm $form
     * @return Response
     */
    public function edit(ComplaintForm $form)
    {
        if (!auth()->user()->admin) {
            $userClinics = ClinicManagers::where('user_id', '=', auth()->id())
                ->get()
                ->pluck('clinic_id')
                ->toArray();

            if (!\in_array($form->clinic_id, $userClinics)) {
                return redirect()->route('complaint-form.create');
            }

        }

        return view('form', [
            'task'           => 'edit',
            'view'           => 'complaint-form',
            'readonly'       => auth()->user()->admin ? '' : 'readonly',
            'clinics'        => Clinic::with([
                                                 'managers' => function ($query) {
                                                     return $query->whereIn('manager_type_id',
                                                                            [
                                                                                ClinicManagers::managerID('regional_manager'),
                                                                                ClinicManagers::managerID('veterinary_manager'),
                                                                                ClinicManagers::managerID('general_manager'),

                                                                            ]);
                                                 },
                                                 'managers.user'
                                             ])
                ->orderBy('name', 'asc')
                ->get(),
            'categories'     => ComplaintCategory::orderBy('name')->get(),
            'types'          => ComplaintType::orderBy('name')->get(),
            'channels'       => ComplaintChannel::orderBy('name')->get(),
            // 'locations'      => Location::orderBy('name')->get(),
            'form'           => $form->load(['clinic', 'location', 'category', 'type', 'channel', 'severity']),
            'outcomeOptions' => OutcomeOptionsCategories::with(['options'])->get(),
            'severities'     => Severity::get(),
            'animals'        => Animal::get(),
            'aggressions'    => ComplaintForm::clientAggressionValues(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\ComplaintFormUpdateRequest $request
     * @param ComplaintForm $complaintForm
     * @return Response
     */
    public function update(ComplaintFormUpdateRequest $request, ComplaintForm $form)
    {
        if (!auth()->user()->admin) {
            $userClinics = ClinicManagers::where('user_id', '=', auth()->id())
                ->get()
                ->pluck('clinic_id')
                ->toArray();

            if (!\in_array($form->clinic_id, $userClinics)) {
                return redirect()->route('complaint-form.create');
            }

        }

        if (!auth()->user()->admin) {
            $request->request->remove('date_of_incident');
            $request->request->remove('date_of_client_complaint');
        }

        $data = $form->format($request->all(), true);

        $result = $form->update($data);

        $directory = 'documents/complaint_form_' . $form->id;

        if (request()->hasFile('documents')) {
            foreach (request()->file('documents') as $file) {
                $fileName =
                    \strtolower(
                        \str_replace(' ', '',
                                     \filter_var($file->getClientOriginalName(),
                                                 FILTER_SANITIZE_FULL_SPECIAL_CHARS,
                                                 FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                                     )
                        )
                    );

                Storage::putFileAs($directory,
                                   $file,
                                   $fileName);

            }
        }

        if ($result) {
            \DB::table('complaint_forms_reminder_sent')
                ->where('complaint_form_id', '=', $form->id)
                ->delete();
        }

        if ($request['date_to_respond_to_the_client']) {
            new \App\Mail\SendDateCompletedEmail($result);
        }

        return redirect()->route('complaint-form.manage')
            ->with([
                       'status' => [
                           'message' => "Form Updated",
                           'type'    => 'success',
                       ]
                   ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function delete(ComplaintForm $form)
    {
        return view('modals/partials/_delete', [
            'id'        => $form->id,
            'routeName' => route('complaint-form.destroy', $form->id),
            'itemName'  => "Complaint Form",
            'table'     => 'forms',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ComplaintForm $form
     * @return Response
     */
    public function destroy(ComplaintForm $form)
    {
        if (!auth()->user()->admin &&
            !auth()->user()->role->hasPermission('d')) {
            die;
        }

        if ($form->delete()) {
            \DB::table('complaint_forms_reminder_sent')
                ->where('complaint_form_id', '=', $form->id)
                ->delete();

            return response()->json([
                                        'Deleted'
                                    ], 200);
        }

        return response()->json([
                                    'Something went wrong!'
                                ], 500);
    }

    /** @return BinaryFileResponse */
    public function export()
    {
        return Excel::download(new FormsExport, 'forms.xlsx');
    }

    /**
     * Downloads the selected file
     *
     * @param ComplaintForm $form
     * @param string $file
     * @param extension $file
     * @return mixed
     */
    public function download(ComplaintForm $form)
    {

        if (!auth()->user()->admin) {
            $result = ClinicManagers::where('user_id', '=', auth()->id())
                ->where('clinic_id', '=', $form->clinic_id)
                ->get();

            if ($result->isEmpty()) {

                return redirect()->route('complaint-form.manage');
            }
        }

        $file = \filter_var(request()->get('file'));

        return Storage::download('documents/complaint_form_' . $form->id . '/' . $file);
    }

    /**
     * Create query for filters
     *
     * @param mixed $query
     * @param mixed $data
     * @return void
     */
    private function createQuery($query, $data): void
    {
        $search = \trim($data['search']);

        switch ($data['type']) {
            case 'text':

                if (\strlen($search) > 2) {
                    switch ($data['column']) {
                        case 'created_at':
                        case 'date_of_incident':
                        case 'date_of_client_complaint':
                        case 'date_to_respond_to_the_client':
                        case 'date_completed':

                            $dates = \explode('to', $data['search']);

                            if (count($dates) === 1) {
                                $date = Carbon::createFromFormat('d/m/Y', trim($dates[0]));

                                $query->whereDate($data['column'], '=', $date);
                            }

                            if (count($dates) === 2) {
                                $dateFrom = Carbon::createFromFormat('d/m/Y', trim($dates[0]));
                                $dateTo = Carbon::createFromFormat('d/m/Y', trim($dates[1]));

                                $query->whereBetween($data['column'], [$dateFrom, $dateTo]);
                            }

                            break;

                        case 'clinic_name';
                            $query->whereIn('clinic_id', function ($query) use ($search) {
                                return $query->select('id')
                                    ->from('clinics')
                                    ->where('name', 'like', '%' . $search . '%');
                            });
                            break;

                        case 'clinic_code';
                            $query->whereIn('clinic_id', function ($query) use ($search) {
                                return $query->select('id')
                                    ->from('clinics')
                                    ->where('code', 'like', '%' . $search . '%');
                            });
                            break;

                        case 'clinic_country';

                            if ($search !== 'all') {
                                $query->whereIn('clinic_id', function ($query) use ($search) {
                                    return $query->select('id')
                                        ->from('clinics')
                                        ->where('country', '=', $search);
                                });
                            }

                            break;

                        case 'regional_manager';
                            $userID = array_search($data['column'], ClinicManagers::$managerTypes);
                            $query->whereIn('clinic_id', function ($query) use ($userID, $search) {
                                return $query->select('clinic_id')
                                    ->from('clinic_managers')
                                    ->where('manager_type_id', '=', $userID)
                                    ->whereIn('user_id', function ($query) use ($search) {
                                        $query->select('id')
                                            ->from('users')
                                            ->where('name', 'like', '%' . $search . '%');
                                    });
                            });
                            break;

                        case 'general_manager';
                            $userID = array_search($data['column'], ClinicManagers::$managerTypes);
                            $query->whereIn('clinic_id', function ($query) use ($userID, $search) {
                                return $query->select('clinic_id')
                                    ->from('clinic_managers')
                                    ->where('manager_type_id', '=', $userID)
                                    ->whereIn('user_id', function ($query) use ($search) {
                                        $query->select('id')
                                            ->from('users')
                                            ->where('name', 'like', '%' . $search . '%');
                                    });
                            });
                            break;

                        case 'team_member';
                        case 'team_member_position';
                        case 'team_member_email';
                        case 'client_name';
                        case 'patient_name';
                        case 'pms_code';
                            $query->where($data['column'], 'like', '%' . $search . '%');
                            break;
                    }
                }

                break;

            case 'select':
                $search !== 'none' ?
                    $query->where($data['column'], '=', $search) :
                    $query->whereNull($data['column']);
                break;

            case 'options':
                $query->whereJsonContains('outcome_options', ['option_id' => (int)$data['option']]);
                break;

            case 'other';
                $search === 'other' ?
                    $query->whereNull($data['column'])
                    :
                    $query->where($data['column'], $search);
                break;
        }

    }
}
