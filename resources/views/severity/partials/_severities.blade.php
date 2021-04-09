<div class="tab-pane fade show" id="severity" role="tabpanel" aria-labelledby="severity">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="severity-table">
            <thead>
                <tr>
                    <th class="small">Name</th>
                </tr>
            </thead>
            <tbody id=complaint-channel-container>
                @foreach ($severities as $severity)
                    <tr>
                        <th>{{ \ucwords($severity) }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
