let textareas = document.getElementsByTagName("textarea");
let minLimitPx = 74;
let maxLimitPx = 150;

for (let i = 0; i < textareas.length; ++i) {
  let textarea = textareas[i];
  if (!textarea.classList.contains("no-resize-ta")) {
    textarea.style.height = minLimitPx + "px"; // initial height
    textarea.oninput = function () {
      textarea.style.height = ""; // reset height
      textarea.style.height = Math.min(textarea.scrollHeight, maxLimitPx) + "px";
    };
  }
}

