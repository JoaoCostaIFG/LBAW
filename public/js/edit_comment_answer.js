'use strict'

function editCommentAnswer(id, type) {

    let new_value = document.getElementById("Textarea-edit-" + type +"-"+ id).value;
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            let post = document.getElementById(type + "-" + id);
            if (this.status == 200) {
                post.textContent = new_value;
            } else {
                post.textContent = "Something went wrong while editing. Please try again.";
                post.classList.add("text-danger");
            }
        }
    };

    xhttp.open("PATCH", "/api/" + type + "s/" + id, true);
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

function editAnswer(id){
    editCommentAnswer(id, 'answer');
}

function editComment(id){
    editCommentAnswer(id, 'comment');
}