<div class="modal fade" id="banModal" tabindex="-1" aria-labelledby="banModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Ban {{$user->username}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('ban_user')}}">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <!-- Reason Input -->
            <label for="reason" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="reason" name="reason" maxlength="100"
              placeholder="(Max: 100 characters)"></textarea>
          </div>
          <input type="hidden" name="user_id" value="{{$user->id}}">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Ban</button>
        </div>
      </form>
    </div>
  </div>
</div>

