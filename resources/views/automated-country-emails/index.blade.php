@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-{{ session('status.type') }}" role="alert">
                        {{ session('status.message') }}
                    </div>
                @endif
            </div>

            <div class="float-right">
                <a href="{{ route('automated-country-emails.create') }}"
                        role="bigModal"
                        data-toggle="modal"
                        data-target="#bigModal"
                        data-table="response"
                        data-attr="{{ route('automated-country-emails.create') }}"
                        class="btn btn-primary my-2">Add Country</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter" id=response>
                    <thead>
                        <tr>
                            <th class="small">ID</th>
                            <th class="small">Country</th>
                            <th class="small">Client Text</th>
                            <th class="small">Clinic Text</th>
                            <th class="small">Emails</th>
                            <th class="small">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=responses-container>
                        @include('automated-country-emails/partials/_responses')
                    </tbody>
                </table>
            </div>

            <div id="pagination">
                @include('pagination', [
                    'paginator' => $responses,
                    'layout'    => 'vendor.pagination.bootstrap-4',
                    'role'      => 'responses',
                    'container' => 'responses-container',
                ])
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_after')
    <script src="{{ asset('js/tinymce.js') }}"></script>
    <script>

        $('#bigModal').on('shown.bs.modal', function () {
            tinymce.init({
                selector: ".body",
                menubar: false,
                plugins: 'link',
                toolbar: "undo redo | paragraph bold italic | link",

                setup: function (editor) {

                    editor.ui.registry.addButton('customInsertButton', {

                        tooltip: 'Insert File For Donwload',
                        icon: 'document-properties',
                        onAction: function (_) {
                            editor.windowManager.open(dialogConfig)
                    }

                });
                }
            });
        })

        $('#bigModal').on('hide.bs.modal', function () {
            tinymce.remove('textarea');
        });

        $(document).on('focusin', function(e)
        {
            e.stopImmediatePropagation();
        });


    </script>

@endsection

