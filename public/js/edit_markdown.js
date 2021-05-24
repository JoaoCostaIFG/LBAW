const el = document.getElementById("body");

function openEditor() {
  const stackedit = new Stackedit();
  stackedit.on('fileChange', function onFileChange(file) {
    el.value = file.content.text;
  });
  stackedit.openFile({
    name: 'Question Body',
    content: {
      text: el.value
    }
  });
}