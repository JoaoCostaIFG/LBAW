function openEditor(el, description) {
  const stackedit = new Stackedit();
  stackedit.on('fileChange', function onFileChange(file) {
    el.value = file.content.text;
  });
  stackedit.openFile({
    name: description,
    content: {
      text: el.value
    }
  });
}

const question_body = document.getElementById("form-question-body");
const answer_body = document.getElementById("form-answer-body");

if (question_body != undefined) {
  openEditorQuestion = openEditor.bind(null, question_body, 'Question Body');
}
else {
  openEditorQuestion = function() {};
}

if (answer_body != undefined) {
  console.log(answer_body);
  openEditorAnswer = openEditor.bind(null, answer_body, 'Answer Body');
  console.log(openEditorAnswer)
}
else {
  openEditorAnswer = function() {};
}