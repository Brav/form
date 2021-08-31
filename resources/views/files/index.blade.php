@extends('layouts.app')

@section('content')

<div class="content">
    <div class="">

        <form
            id="file-upload"
            action="{{ route('file.store') }}"
            method="POST"
            class="col-md-4">
            @csrf
            <input type="hidden" name="table" id=table value="files">
            <input type="hidden" name="action" id=action value="create">

            <div class="form-row align-items-center">

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name=name id="title" value="{{ old('title') }}">

                    <div class="alert alert-danger alert-title d-none"></div>
                </div>

            </div>

            <div class="form-row align-items-center">

                <div class="form-group">

                    <div class="custom-file">
                        <label for="documents" class="custom-file-label">File</label>
                        <input type="file" name="file" id="file" class="custom-file-input">
                    </div>

                    <div class="alert alert-danger alert-file d-none"></div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">Upload</button>

        </form>

        <div class="my-5 col-md-4 block block-rounded p-0">
            <div class="block-header block-header-default">
                <h3 class="block-title">Files</h3>
            </div>
            <div class="block-content">
                <table class="table table-sm table-vcenter table-striped table-hover">
                    <tbody id="files">
                        @foreach ($files as $file)
                            @include('files/partials/_file')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js_after')
    <script>
        $('#file-upload').on('submit', function(e){
            e.preventDefault()

            let $this    = $(this)
            let formData = new FormData()
            let file     = $('#file')[0].files

            if(file.length !== 1)
            {
                return;
            }

            formData.append('file', file[0])
            formData.append('title', $('#title').val().trim())
            formData.append('_token', $('meta[name="csrf-token"]').attr("content"))

            $.ajax({
                type: "POST",
                url: $this.attr('action'),
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (response) {

                    $('#files').prepend(response.html)

                    $this[0].reset()
                }
            });


        })
    </script>
@endsection
