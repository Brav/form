<div class="tab-pane fade show" id="channel" role="tabpanel" aria-labelledby="channel">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="complaint-channel">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=complaint-channel-container>
                @include('complaint-channel/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-channel">
        @include('pagination', [
            'paginator' => $channels,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'complaint-channel',
            'container' => 'complaint-channel-container',
        ])
    </div>
</div>
