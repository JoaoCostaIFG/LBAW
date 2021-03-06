<div class="col-12 col-lg-11 offset-lg-1">
  @each('partials.posts.comment', $post->comments, 'comment')

  @auth
    <div id="end-comment-{{$post->id}}" class="row gx-0 justify-content-center mt-1">
      <button class="col-auto btn btn-outline-success text-center dropdown-toggle"
       data-bs-toggle="dropdown" aria-expanded="false" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Use comments to ask for more information or suggest improvements. Avoid answering questions in comments.">
        Add comment
      </button>
      <div class="dropdown-menu w-100 p-2" >
        <form class="container">
          <h4>Your Comment</h4>
          <textarea id="Textarea{{$post->id}}" class="form-control"></textarea>
          <label class="visually-hidden" for="Textarea{{$post->id}}">Add comment</label>
          <br>
          <div class="text-end">
            <a class="btn btn-primary" onclick="addComment({{$answer_id ?? 'null'}}, {{$question_id ?? 'null'}})">
              Post Comment
            </a>
          </div>
        </form>
      </div>
    </div>
  @endauth
</div>
