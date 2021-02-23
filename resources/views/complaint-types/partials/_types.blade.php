<div class="tab-pane fade show" id="types" role="tabpanel" aria-labelledby="types">
    <table class="table table-hover" id="complaint-types">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Complaint Category</th>
                <th scope="col">Level</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody id=complaint-type-container>
            @include('complaint-types/partials/_container')
        </tbody>
    </table>

    <div id="pagination-type">
        @include('pagination', [
            'paginator' => $types,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-type',
            'container' => 'complaint-type-container',
        ])
    </div>
</div>
