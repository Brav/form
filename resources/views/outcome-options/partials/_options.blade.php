<div class="tab-pane fade show active" id="outcome-options"
role="tabpanel"
aria-labelledby="outcome-options">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="outcome-options-table">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Category</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=outcome-options-container>
                @include('outcome-options/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-categories">
        @include('pagination', [
            'paginator' => $categories,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'outcome-options',
            'container' => 'outcome-options-container',
        ])
    </div>
</div>

