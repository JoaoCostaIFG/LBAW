'use strict'

function editComment(comment_id) {

    let new_value = document.getElementById("Textarea-edit-" + comment_id).value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            let comment = document.getElementById("comment-" + comment_id);
            if (this.status == 200) {
                comment.textContent = new_value;
            } else {
                comment.value = "Something went wrong editing this comment. Please try again.";
            }
        }
    };

    xhttp.open("PATCH", "/api/comments/" + comment_id, true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhttp.send(encodeForAjax({
        comment_id: comment_id,
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
