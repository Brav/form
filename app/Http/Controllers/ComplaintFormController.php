<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Http\Requests\ComplaintFormCreateRequest;
use App\Http\Requests\ComplaintFormUpdateRequest;
use App\Models\AutomatedResponse;
use App\Models\Clinic;
use App\Models\ClinicManagers;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Location;
use App\Models\Severity;
use App\Providers\ComplaintFilled;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class ComplaintFormController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clinics     = Clinic::$userFields;
        $userClinics = null;

        if(auth()->user()->admin !== 1)
        {
            $userClinics = ClinicManagers::where('user_id', '=', auth()->id())
                ->get()
                ->pluck('clinic_id')
                ->toArray();
        }

        $forms = ComplaintForm::when(auth()->user()->admin !== 1, function($query) use($userClinics){
            return $query->whereIn('clinic_id', $userClinics);
        })
        ->with(['clinic', 'location', 'category', 'type', 'channel'])
        ->paginate(20);

        $canEdit = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('w') ? true : false;

        $canDelete = auth()->user()->admin == 1 ||
                auth()->user()->role->hasPermission('d') ? true : false;

        if(!request()->ajax())
            return view('complaint-form/index', [
                'forms'      => $forms,
                'canEdit'    => $canEdit,
                'canDelete'  => $canDelete,
                'severities' => Severity::SEVERITIES,
            ]);

        return [
            'html' => view('complaint-form/partials/_forms', [
                'forms'      => $forms,
                'canEdit'    => $canEdit,
                'canDelete'  => $canDelete,
                'severities' => Severity::SEVERITIES,
            ])->render(),
            'pagination' => view('pagination', [
                'paginator' => $forms,
                'layout'    => 'vendor.pagination.bootstrap-4',
                'role'      => 'forms',
                'container' => 'forms-container',
            ])->render()
        ];
    }

    /**
     * Show the message after the form is sent.
     *
     * @return \Illuminate\Http\Response
     */
    public function sent()
    {

        if(rtrim(request()->server('HTTP_REFERER'), "/") != route('complaint-form.create'))
        {
            return redirect()->route('complaint-form.create');
        }

        return view('complaint-form/form-sent');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form', [
            'task'       => 'create',
            'view'       => 'complaint-form',
            'clinics'    => Clinic::with([
                'managers' => function($query){
                    return $query->where('manager_type_id', '=', ClinicManagers::managerID('regional_manager'));
                },
                'managers.user'])->get(),
            'categories' => ComplaintCategory::get(),
            'types'      => ComplaintType::get(),
            'channels'   => ComplaintChannel::get(),
            'locations'  => Location::get(),
            'severities' => Severity::SEVERITIES,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintFormCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComplaintFormCreateRequest $request)
    {
        $model = new ComplaintForm();
        $data  = $model->format($request->all());
        $model = $model->create($data);

        ComplaintFilled::dispatch($model);

        $directory = 'documents/complaint_form_' . $model->id;

        if(request()->hasFile('documents'))
        {
            foreach(request()->file('documents') as $file)
            {
                $fileName =
                \strtolower(
                    \str_replace(' ', '',
                        \filter_var($file->getClientOriginalName(),
                        FILTER_SANITIZE_STRING,
                        FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                        )
                    )
                );

                Storage::putFileAs($directory,
                    $file,
                    $fileName);

            }
        }

        $response = AutomatedResponse::whereJsonContains('scenario->categories', $model->complaint_category_id)
            ->whereJsonContains('scenario->types', $model->complaint_type_id)
            ->whereJsonContains('scenario->channels', $model->complaint_channel_id)
            ->first()
            ->response;

        return redirect()->route('complaint-form.sent')
            ->with([
                'status' => [
                    'message'  => "You have file the complaint successfully",
                ],
                'response' => $response,
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function show(ComplaintForm $complaintForm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ComplaintForm  $form
     * @return \Illuminate\Http\Response
     */
    public function edit(ComplaintForm $form)
    {
        if(!auth()->user()->admin &&
            !auth()->user()->role->hasPermission('w'))
        {
            return redirect()->route('complaint-form.create');
        }

        return view('form', [
            'task'       => 'edit',
            'view'       => 'complaint-form',
            'clinics'    => Clinic::with(['regionalManager'])->get(),
            'categories' => ComplaintCategory::get(),
            'types'      => ComplaintType::get(),
            'channels'   => ComplaintChannel::get(),
            'locations'  => Location::get(),
            'form'       => $form->load(['clinic', 'location', 'category', 'type', 'channel']),
            'severities' => Severity::SEVERITIES,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ComplaintFormUpdateRequest  $request
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function update(ComplaintFormUpdateRequest $request, ComplaintForm $form)
    {
        if(!auth()->user()->admin &&
            !auth()->user()->role->hasPermission('w'))
        {
            return redirect()->route('complaint-form.create');
        }

        $data = $form->format($request->all(), true);

        $form->update($data);

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
     * @return \Illuminate\Http\Response
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
     * @param  \App\Models\ComplaintForm  $form
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintForm $form)
    {
        if(!auth()->user()->admin &&
            !auth()->user()->role->hasPermission('d'))
        {
            die;
        }

        if($form->delete())
            return response()->json([
                'Deleted'
            ], 200);

        return response()->json([
            'Something went wrong!'
        ], 500);
    }

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
    public function download(ComplaintForm $form, string $file, string $extension)
    {
        return Storage::download('documents/complaint_form_' . $form->id . '/' . $file . '.' . $extension);
    }
}
