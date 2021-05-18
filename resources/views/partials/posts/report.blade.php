<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger">Report User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ url('/user/report') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="mb-3">
            <!-- Reason Input -->
            <label for="reason" class="col-form-label">Reason:</label>
            <textarea class="form-control" id="reason" name="reason" maxlength="100"
              placeholder="(Max: 100 characters)"></textarea>
          </div>
          <!-- Post ID input -->
          <input id="post-id-input" type="hidden" name="post_id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Report</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  var reportModal = document.getElementById('reportModal')
  reportModal.addEventListener('show.bs.modal', function(event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-user')
    var post_id = button.getAttribute('data-bs-post')
    // Update the modal's content.
    // Update title
    var modalTitle = reportModal.querySelector('.modal-title')
    modalTitle.textContent = 'Report ' + recipient
    // Update input
    let postIdInput = reportModal.querySelector("#post-id-input")
    postIdInput.setAttribute('value', post_id);
  })
</script>
