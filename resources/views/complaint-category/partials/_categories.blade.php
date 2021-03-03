<div class="tab-pane fade show active" id="categories" role="tabpanel" aria-labelledby="categories">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="complaint-category">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=complaint-category-container>
                @include('complaint-category/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-categories">
        @include('pagination', [
            'paginator' => $categories,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-category',
            'container' => 'complaint-category-container',
        ])
    </div>
</div>

