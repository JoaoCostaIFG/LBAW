// Select .toast-canvas that will wrap all .toast elements
const toastBtn = document.querySelector("#add-toast-btn");
let notifications = document.querySelectorAll('.toast');
let toastsInstances = [];
let active = false;

notifications.forEach(function (toastNode) {
  var toast = new bootstrap.Toast(toastNode, {
    autohide: false
  });
  toastsInstances.push(toast);
});

toastBtn.addEventListener("click", () => {
  if (active) {
    active = false;
    toastsInstances.forEach(function (toast) {
      toast.hide();
    });
  } else {
    active = true;
    toastsInstances.forEach(function (toast) {
      toast.show();
    });

  }
});