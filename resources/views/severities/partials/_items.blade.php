<div class="tab-pane fade show" id="severities" role="tabpanel" aria-labelledby="severities">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="severities">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=severities-container>
                @include('severities/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-severities">
        @include('pagination', [
            'paginator' => $severities,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'severities',
            'container' => 'severities-container',
        ])
    </div>
</div>
