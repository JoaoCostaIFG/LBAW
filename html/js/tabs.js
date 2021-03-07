'use strict'

// Get all tabs 
var tabs = [].slice.call(document.querySelectorAll('.nav-tabs li a'))
tabs.forEach(function (tab) {
  var tabInstance = new bootstrap.Tab(tab) // Tab instance
  // Show Tab on click
  tab.addEventListener('click', function (event) {
    event.preventDefault()
    tabInstance.show()
  })
})