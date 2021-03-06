'use strict'

function addComment(answer_id, question_id) {
  removeError();
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Trim is used because the reponse text comes with new lines behind
      let response = xhttp.responseText.trim("\n");
      let form = document.getElementById("end-comment-" + (answer_id == null ? question_id : answer_id));
      let doc = new DOMParser().parseFromString(response, "text/html").body.childNodes[0]; //Get returned node from server
      form.parentNode.insertBefore(doc, form);
    }
  };

  let request_data;
  if (answer_id === null) {
    request_data = encodeForAjax({
      question_id: question_id,
      body: document.getElementById("Textarea" + (answer_id == null ? question_id : answer_id)).value,
      csrf: document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content"),
    });
  } else {
    request_data = encodeForAjax({
      answer_id: answer_id,
      body: document.getElementById("Textarea" + (answer_id == null ? question_id : answer_id)).value,
      csrf: document
        .querySelector("meta[name='csrf-token']")
        .getAttribute("content"),
    });
  }

  xhttp.open("post", "/ajax/comment", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  xhttp.send(request_data);
}

function removeError() {
  let commentError = document.getElementById("comment-error");
  if (commentError) {
    commentError.remove();
  }
}

function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}
