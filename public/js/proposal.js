'use strict'

function processProposal(proposal_id, accepted, proposal_type) {
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    // Get edit proposal card
    let card = document.getElementById(proposal_type + "-proposal-" + proposal_id);

    // Success
    if (this.readyState == 4) {
      if (this.status == 200) {
        positiveFeedback(card, accepted);
      }
      else { // Failed
        negativeFeedback(card);
      }
    }
  };

  let request_data = encodeForAjax({
    proposal_id: proposal_id,
    csrf: document
      .querySelector("meta[name='csrf-token']")
      .getAttribute("content"),
    accepted: accepted,
  });

  xhttp.open("post", "ajax/" + proposal_type + "_proposal", true);
  xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhttp.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
  xhttp.send(request_data);
}

function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function positiveFeedback(card, accepted) {
  // Create new element
  let feedback_msg = document.createElement("span");
  card.classList.add("alert");
  if (accepted){
    card.classList.add("alert-success");
    feedback_msg.appendChild(document.createTextNode("Proposal Accepted!"));
  }
  else{
    card.classList.add("alert-danger");
    feedback_msg.appendChild(document.createTextNode("Proposal Rejected!"));
  }
  // Replace
  card.replaceChild(feedback_msg, card.childNodes[1]);
}

function negativeFeedback(card) {
  // Create new element
  let feedback_msg = document.createElement("div");
  feedback_msg.classList.add("invalid-feedback");
  feedback_msg.classList.add("d-block");
  feedback_msg.appendChild(document.createTextNode("An error occurred while processing your request."));
  // Add child
  card.appendChild(feedback_msg);
}