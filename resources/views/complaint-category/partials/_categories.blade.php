<div class="tab-pane fade show active" id="categories" role="tabpanel" aria-labelledby="categories">
    <table class="table table-hover" id="complaint-category">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                @include('complaint-category/partials/_category')
            @endforeach
        </tbody>
    </table>
</div>

