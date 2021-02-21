{{-- !-- Delete Warning Modal -->  --}}
<form action="{{ $routeName }}" method="post" id=delete-form>
    <div class="modal-body">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" value="{{ $id }}">
        <h5 class="text-center">Are you sure you want to delete {{ $itemName }} ?</h5>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger">Delete</button>
    </div>
</form>
