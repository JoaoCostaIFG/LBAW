'use strict'

function addVoteIcon(node, type, isFill) {
  if (isFill) {
    node.classList.remove("bi-caret-" + type);
    node.classList.add("bi-caret-" + type + "-fill");
  } else {
    node.classList.remove("bi-caret-" + type + "-fill");
    node.classList.add("bi-caret-" + type);
  }
}

function addVote(post_id, is_upvote) {
    removeError();
    let upvote = document.getElementById("btn-upvote-" + post_id);
    let downvote = document.getElementById("btn-downvote-" + post_id);
    if (is_upvote) {
      addVoteIcon(upvote, "up", true);
      addVoteIcon(downvote, "down", false);
    } else {
      addVoteIcon(upvote, "up", false);
      addVoteIcon(downvote, "down", true);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //Trim is used because the reponse text comes with new lines behind
        let response = xhttp.responseText.trim("\n");
        let doc = new DOMParser().parseFromString(response, "text/html").body.childNodes[0]; //Get returned node from server
        console.log(doc);
      }
    };

    xhttp.open("put", "/api/" + post_id + "/vote", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhttp.send(
        encodeForAjax({
            post_id: post_id,
            value: is_upvote ? 1 : -1,
            csrf: document
              .querySelector("meta[name='csrf-token']")
              .getAttribute("content"),
        })
    );
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
