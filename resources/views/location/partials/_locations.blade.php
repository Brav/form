<div class="tab-pane fade show" id="location" role="tabpanel" aria-labelledby="location">
    <table class="table table-hover" id="location">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id=complaint-type-container>
            @include('locationcs/partials/_container')
        </tbody>
    </table>

    <div id="pagination-type">
        @include('pagination', [
            'paginator' => $locations,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-type',
            'container' => 'complaint-type-container',
        ])
    </div>
</div>
