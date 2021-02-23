<div class="tab-pane fade show" id="channel" role="tabpanel" aria-labelledby="channel">
    <table class="table table-hover" id="complaint-channel">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Complaint Channel</th>
                <th scope="col">Level</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($channels as $channel)
                @include('complaint-channel/partials/_channel')
            @endforeach
        </tbody>
    </table>
</div>
