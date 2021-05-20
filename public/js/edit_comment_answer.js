'use strict'

function editCommentAnswer(id, type) {

    let new_value = document.getElementById("Textarea-edit-" + type + '-' + id).value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            let comment = document.getElementById(type + '-' + id);
            if (this.status == 200) {
                comment.textContent = new_value;
            } else {
                comment.textContent = "Something went wrong while editing. Please try again.";
                comment.classList.add("text-danger");
            }
        }
    };

    xhttp.open("PATCH", "/api/comments/" + id, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhttp.send(encodeForAjax({
        id: id,
        body: new_value,
        csrf: document
            .querySelector("meta[name='csrf-token']")
            .getAttribute("content"),
    }));
}

function encodeForAjax(data) {
    return Object.keys(data).map(function (k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}
