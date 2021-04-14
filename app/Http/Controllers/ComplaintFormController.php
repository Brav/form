<?php

namespace App\Http\Controllers;

use App\Exports\FormsExport;
use App\Http\Requests\ComplaintFormCreateRequest;
use App\Http\Requests\ComplaintFormUpdateRequest;
use App\Models\Clinic;
use App\Models\ComplaintCategory;
use App\Models\ComplaintChannel;
use App\Models\ComplaintForm;
use App\Models\ComplaintType;
use App\Models\Location;
use App\Models\Severity;
use App\Providers\ComplaintFilled;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
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
            $userID  = auth()->id();
            $clinics = Clinic::query();

            foreach ($clinics as $field )
            {
                $clinics->orWhere($field, '=', $userID);
            }

            $userClinics = $clinics->get();
        }

        $forms = ComplaintForm::when(auth()->user()->admin !== 1, function($query) use($userClinics){
            return $query->whereIn('clinic_id', $userClinics->pluck('id')->toArray());
        })
        ->with(['clinic', 'location', 'category', 'type', 'channel'])
        ->paginate(20);

        if(!request()->ajax())
            return view('complaint-form/index', [
                'forms'      => $forms,
                'severities' => Severity::SEVERITIES,
            ]);

        return [
            'html' => view('complaint-form/partials/_forms', [
                'forms'      => $forms,
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
            'clinics'    => Clinic::with(['regionalManager'])->get(),
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

        return redirect()->route('complaint-form.sent')
            ->with([
                'status' => [
                    'message' => "You have file the complaint successfully"
                ]
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ComplaintForm  $complaintForm
     * @return \Illuminate\Http\Response
     */
    public function destroy(ComplaintForm $complaintForm)
    {
        //
    }

    public function export()
    {
        return Excel::download(new FormsExport, 'forms.xlsx');
    }
}
