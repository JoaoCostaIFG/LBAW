'use strict'

function toggleVoteIcon(node, type) {
  let hasVote = node.classList.contains("bi-caret-" + type + "-fill");
  if (!hasVote) {
    node.classList.remove("bi-caret-" + type);
    node.classList.add("bi-caret-" + type + "-fill");
  } else {
    node.classList.remove("bi-caret-" + type + "-fill");
    node.classList.add("bi-caret-" + type);
  }
}

function changeScore(node, deltaScore) {
  node.innerHTML = parseInt(node.innerHTML) + deltaScore;
}

function addVote(post_id, is_upvote) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //Trim is used because the reponse text comes with new lines behind
        let response = xhttp.responseText.trim("\n");
        let doc = new DOMParser().parseFromString(response, "text/html").body.childNodes[0]; //Get returned node from server
        // TODO Display errors?
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

function removeVote(post_id) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //Trim is used because the reponse text comes with new lines behind
        let response = xhttp.responseText.trim("\n");
        let doc = new DOMParser().parseFromString(response, "text/html").body.childNodes[0]; //Get returned node from server
        // TODO Display errors?
      }
    };

    xhttp.open("delete", "/api/" + post_id + "/vote", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
    xhttp.send(
        encodeForAjax({
            post_id: post_id,
            csrf: document
              .querySelector("meta[name='csrf-token']")
              .getAttribute("content"),
        })
    );

}

function updateVote(post_id, is_upvote) {
    removeError();
    let score = document.getElementById("score-" + post_id);
    let upvote = document.getElementById("btn-upvote-" + post_id);
    let downvote = document.getElementById("btn-downvote-" + post_id);
    let upvoteWasVoted = upvote.classList.contains('bi-caret-up-fill');
    let downvoteWasVoted = downvote.classList.contains('bi-caret-down-fill');
    if (is_upvote) {
      if (upvoteWasVoted) {
        removeVote(post_id);
        toggleVoteIcon(upvote, "up");
        changeScore(score, -1);
      }
      else {
        toggleVoteIcon(upvote, "up");
        if (downvoteWasVoted) {
          toggleVoteIcon(downvote, "down");
          changeScore(score, 1);
        }
        addVote(post_id, is_upvote);
        changeScore(score, 1);
      }
    } else {
      if (downvoteWasVoted) {
        removeVote(post_id)
        toggleVoteIcon(downvote, "down");
        changeScore(score, 1);
      }
      else {
        toggleVoteIcon(downvote, "down");
        if (upvoteWasVoted) {
          toggleVoteIcon(upvote, "up");
          changeScore(score, -1);
        }
        addVote(post_id, is_upvote);
        changeScore(score, -1);
      }
    }
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
