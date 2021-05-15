'use strict'

function acceptEdit(proposal_id, accepted) {
  
  let xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log("success");
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

function rejectEdit() {
  console.log("Reject");
}

function encodeForAjax(data) {
  return Object.keys(data).map(function (k) {
    return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}