<?php
function draw_notifications()
{ ?>

  <div class="container-fluid p-3" id="toast-container" style="z-index: 5;">
    <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-exclamation-circle-fill p-1"></i>
        <strong class="me-auto">New Vote</strong>
        <small>11 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        PantufaRGB has upvoted to your question.
      </div>
    </div>
    <div class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="bi bi-exclamation-circle-fill p-1"></i>
        <strong class="me-auto">New Reply</strong>
        <small>34 mins ago</small>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body">
        PantufaRGB has repied to your question.
      </div>
    </div>
  </div>

  <script src="/js/notifications.js"></script>

<?php
} ?>