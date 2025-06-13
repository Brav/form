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

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-vcenter" id=response>
                        <thead>
                        <tr>
                            <th class="small">Emails</th>
                            <th class="small">Actions</th>
                        </tr>
                        </thead>
                        <tbody id=responses-container>
                        @include('automated-date-completed-email/partials/_responses')
                        </tbody>
                    </table>
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
            });
        })

        $('#bigModal').on('hide.bs.modal', function () {
            tinymce.remove('textarea');
        });

        $(document).on('focusin', function (e) {
            e.stopImmediatePropagation();
        });


    </script>

@endsection

