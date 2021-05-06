'use strict'

var href = location.search;

if(href != ""){
  href = href.substring(3, href.length); // remove ?q=
  var sortOption = document.querySelector("li a[href*=" + href + "]").parentElement; // get li
  sortOption.style.backgroundColor = "#263f59"; // change color
}