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


let notification_forms = document.querySelectorAll(".notification-form");
notification_forms.forEach(notification_form => {
    if (notification_form.addEventListener) {
        notification_form.addEventListener("submit", function (evt) {
            console.log("Hello");
            evt.preventDefault();

            let xhttp = new XMLHttpRequest();
            xhttp.open("delete", "/api/notifications/" + notification_form.getAttribute('id').split("-")[1], true);
            xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
            xhttp.send(
                encodeForAjax({
                    csrf: document
                        .querySelector("meta[name='csrf-token']")
                        .getAttribute("content"),
                })
            );
        }, true);
    }
});


function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}
