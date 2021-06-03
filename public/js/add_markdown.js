console.log("HERE");
var parser = new md.Remarkable();
parser.block.ruler.disable(['heading']);

parser.set({
  breaks:  true,  // Convert '\n' in paragraphs into <br>
})

function convertToMarkdown(el) {
  el.innerHTML = parser.render(el.innerHTML);
}

function parseQuestionPage() {
  const question = document.getElementById("question-body-post");
  const answers = document.getElementsByClassName("answer-body");
  const comments = document.getElementsByClassName("comment-body");

  convertToMarkdown(question);
  for(let i=0; i<answers.length; ++i)
    convertToMarkdown(answers[i]);
  parser.set({ breaks: false});
  for(let i=0; i<comments.length; ++i)
    convertToMarkdown(comments[i]);
}

function parseSearchPage() {
  const questions = document.getElementsByClassName("question-body-search");
  for(let i=0; i<questions.length; ++i)
    convertToMarkdown(questions[i]);
}