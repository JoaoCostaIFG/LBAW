<?php
function drawFooter()
{
?>

  <a class="btn btn-secondary" id="go-up-button" href="#" role="button">
    <i class="bi bi-arrow-up"></i>
  </a>

  <footer class="container">
    <br>
    <hr>
    <div class="row">
      <p class="col-8 text-muted">&#169; 2021 Segmentation Fault, Inc.</p>
      <a class="col-4 text-end" href="#">go to top</a>
    </div>
  </footer>

  <!-- Bootstrap + Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })
  </script>
  </body>

  </html>
<?php
} ?>