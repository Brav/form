@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="block-content">

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-{{ session('status.type') }}" role="alert">
                            {{ session('status.message') }}
                        </div>
                    @endif
                </div>
        </div>

        <form action="{{ route('user-import.import') }}"
            method="post"
            enctype="multipart/form-data">
            @csrf

            <h3>User Import</h3>

            <div class="form-group">
              <label for="document">User Import</label>
              <input type="file" name="document" id="document">
              <small id="fileHelpId" class="form-text text-muted">Only excel files are supported</small>
            </div>


            <button type="submit" class="btn btn-primary">Import</button>
        </form>
    </div>
@endsection
