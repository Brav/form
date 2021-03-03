<div class="tab-pane fade show" id="location" role="tabpanel" aria-labelledby="location">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="location">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=location-container>
                @include('location/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-type">
        @include('pagination', [
            'paginator' => $locations,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'location',
            'container' => 'location-container',
        ])
    </div>
</div>
