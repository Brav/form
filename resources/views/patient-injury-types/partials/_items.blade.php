<div class="tab-pane fade show" id="patient-injury-type" role="tabpanel" aria-labelledby="patient-injury-type">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="patient-injury-type">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=patient-injury-type-container>
                @include('patient-injury-types/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-types">
        @include('pagination', [
            'paginator' => $types,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'types',
            'container' => 'types-container',
        ])
    </div>
</div>
