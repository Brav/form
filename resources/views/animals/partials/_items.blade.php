<div class="tab-pane fade show" id="animals" role="tabpanel" aria-labelledby="animals">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-vcenter" id="animals">
            <thead>
                <tr>
                    <th class="small">ID</th>
                    <th class="small">Name</th>
                    <th class="small">Actions</th>
                </tr>
            </thead>
            <tbody id=animals-container>
                @include('animals/partials/_container')
            </tbody>
        </table>
    </div>

    <div id="pagination-animals">
        @include('pagination', [
            'paginator' => $animals,
            'layout'    => 'vendor.pagination.bootstrap-4',
            'role'      => 'animals',
            'container' => 'animals-container',
        ])
    </div>
</div>
