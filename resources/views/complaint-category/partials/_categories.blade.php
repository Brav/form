<div class="tab-pane fade show active" id="categories" role="tabpanel" aria-labelledby="categories">
    <table class="table table-hover" id="complaint-category">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id=complaint-category-container>
            @include('complaint-category/partials/_container')
        </tbody>
    </table>

    <div id="pagination-categories">
        @include('pagination', [
            'paginator' => $categories,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-category',
            'container' => 'complaint-category-container',
        ])
    </div>
</div>

