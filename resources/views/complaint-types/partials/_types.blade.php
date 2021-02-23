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
        <tbody>
            @foreach ($types as $type)
                @include('complaint-types/partials/_type')
            @endforeach
        </tbody>
    </table>
</div>
