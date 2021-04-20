'use strict'

// Select notifications button
const toastBtn = document.querySelector("#notifications-btn");
// Select notifications
let notifications = document.querySelectorAll('.toast');
let toastsInstances = []; // Toasts instances
let active = false; 

// Fill toasts instances array
notifications.forEach(function (toastNode) {
  var toast = new bootstrap.Toast(toastNode, {
    autohide: false
  });
  toastsInstances.push(toast);
});

// Hide / Show notifications on button click
if (toastBtn != null) {
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
}