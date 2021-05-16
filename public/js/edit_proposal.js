'use strict'

function acceptEdit(proposal_id, accepted) {

  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    // Get edit proposal card
    let card = document.getElementById("edit-proposal-" + proposal_id);

    // Success
    if (this.readyState == 4 && this.status == 200) {
      // Create new element
      let feedback_msg = document.createElement("p");
      feedback_msg.classList.add("m-1");
      if (accepted)
        feedback_msg.appendChild(document.createTextNode("Proposal Accepted!"));
      else feedback_msg.appendChild(document.createTextNode("Proposal Rejected!"));
      // Replace
      card.replaceChild(feedback_msg, card.childNodes[1]);
    }
    else{ // Failed
      // Create new element
      let feedback_msg = document.createElement("div");
      feedback_msg.classList.add("invalid-feedback");
      feedback_msg.classList.add("d-block");
      feedback_msg.appendChild(document.createTextNode("An error occurred while processing your request."));
      // Add child
      card.appendChild(feedback_msg);
    }
  };

  let request_data = encodeForAjax({
    proposal_id: proposal_id,
    csrf: document
      .querySelector("meta[name='csrf-token']")
      .getAttribute("content"),
    accepted: accepted,
  });

  xhttp.open("post", "ajax/proposal", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  xhttp.send(request_data);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}