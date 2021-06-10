<div class="tab-pane fade show" id="types" role="tabpanel" aria-labelledby="types">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="complaint-types">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Complaint Category</th>
                    <th class="small">Channels Settings</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=complaint-type-container>
                @include('complaint-types/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-type">
        @include('pagination', [
            'paginator' => $types,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-type',
            'container' => 'complaint-type-container',
        ])
    </div>
</div>
