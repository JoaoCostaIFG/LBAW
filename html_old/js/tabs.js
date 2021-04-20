'use strict'

// Get all tabs 
var tabs = [].slice.call(document.querySelectorAll('.nav-tabs li a'));

if (location.hash != "") // If hash is set
  setTabFromHash();
else // Hash not set
  updateTabAndHash(tabs[0]);

// Add click event listener for tabs
tabs.forEach(function (tab) {
  // Show Tab on click
  tab.addEventListener('click', function (event) {
    event.preventDefault();
    updateTabAndHash(tab); // update url based on tab
  })
})

// Update tab on hash change
window.addEventListener('hashchange', function () {
  setTabFromHash();
})

// Updates URL based in tabs href
function updateTabAndHash(tab) {
  location.hash = tab.getAttribute("href");
  new bootstrap.Tab(tab).show() // show tab
}

// Shows tab based on hash
function setTabFromHash() {
  let activeTab = document.querySelector('.nav-tabs li a[href="' + location.hash + '"]');
  new bootstrap.Tab(activeTab).show();
}