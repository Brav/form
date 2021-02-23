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
        <tbody id=complaint-channel-container>
            @include('complaint-channel/partials/_container')
        </tbody>
    </table>

    <div id="pagination-channel">
        @include('pagination', [
            'paginator' => $channels,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-channel',
            'container' => 'complaint-channel-container',
        ])
    </div>
</div>
