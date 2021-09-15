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
                <a href="{{ route('automated-response.create') }}"
                        role="bigModal"
                        data-toggle="modal"
                        data-target="#bigModal"
                        data-table="response"
                        data-attr="{{ route('automated-response.create') }}"
                        class="btn btn-primary my-2">Create Response</a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter" id=response>
                    <thead>
                        <tr>
                            <th class="small">ID</th>
                            <th class="small">Name</th>
                            <th class="small">Response</th>
                            <th class="small">Scenario</th>
                            <th class="small">Actions</th>
                        </tr>
                    </thead>
                    <tbody id=responses-container>
                        @include('automated-response/partials/_responses')
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

        let items = []

        @foreach ($files as $file)
            items.push({
                type: 'checkbox',
                name: '{{ route("file.download", $file->name) }}|{{ $file->title }}',
                label: '{{ $file->title }}',
            })
        @endforeach

        let dialogConfig =  {
            title: 'Files',
            body: {
                type: 'panel',
                items: items
            },
            buttons: [
                {
                type: 'cancel',
                name: 'closeButton',
                text: 'Cancel'
                },
                {
                type: 'submit',
                name: 'submitButton',
                primary: true,
                text: 'Insert'
                }
            ],
            onSubmit: function (api) {

                let data  = api.getData();
                let links = []

                Object.entries(data).forEach(entry => {
                    const [key, value] = entry;
                    if(value === true)
                    {
                        let item = key.split('|')

                        let name = item[0].split('.')

                        links.push(`<a href="${name[0]}">${item[1]}</a>`)
                    }
                });

                if(links.length)
                {
                    tinymce.activeEditor.execCommand('mceInsertContent', false, links.join(' '));
                }
                api.close();
            }
        };

        $('body').on('input', '#default', function(e)
        {

            $(this).prop('checked') === true ? $('.scenario').addClass('d-none') : $('.scenario').removeClass('d-none')

        })

        $('#bigModal').on('shown.bs.modal', function () {
            tinymce.init({
                selector: "textarea:not(#additional_emails)",
                menubar: false,
                toolbar: "undo redo | paragraph bold italic | customInsertButton",
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

    </script>
<script>

</script>
@endsection
