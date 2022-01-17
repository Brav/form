<div class="table-responsive">
    <table class="table table-bordered table-striped table-vcenter" id=clinics>
        <thead>
            <tr>
                <th class="small">Clinic Name</th>
                <th class="small">Practice Manager Name</th>
                <th class="small">Practice Manager Email</th>
                <th class="small">Lead Vet Name</th>
                <th class="small">Lead Vet Email</th>
                <th class="small">Regional Manager Name</th>
                <th class="small">Regional Manager Email</th>
                <th class="small">Veterinary Manager Name</th>
                <th class="small">Veterinary Manager Email</th>
                <th class="small">General Manager Name</th>
                <th class="small">General Manager Email</th>
                <th class="small">GM Veterinary Operations Name</th>
                <th class="small">GM Veterinary Operations Email</th>
                <th class="small">GM Vet Services Name</th>
                <th class="small">GM Vet Services Email</th>
                <th class="small">Other Name</th>
                <th class="small">Other Email</th>
            </tr>

        </thead>
        <tbody id=clinics-container>
            @include('clinics/partials/_exportClinics')
        </tbody>
    </table>
</div>
