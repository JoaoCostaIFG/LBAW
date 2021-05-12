<div class="col-9 offset-3 col-md-10 offset-md-2 col-lg-11 offset-lg-1">
  @each('partials.posts.comment', $post->comments, 'comment')
  @auth
    <div id="end-comment-{{$post->id}}" class="row gx-0 justify-content-center mt-1">
      <button id="commentDropdownLink" class="col-auto btn btn-outline-success text-center dropdown-toggle"
       data-bs-toggle="dropdown" aria-expanded="false">
        Add comment
      </button>
      <div class="col-12 dropdown-menu" aria-labelledby="commentDropdownLink">
        <form class="container">
          <h4>Your Comment</h4>
          <textarea class="form-control" id="Textarea{{$post->id}}" rows="7"></textarea>
          <label class="visually-hidden" for="Textarea{{$post->id}}">Add comment</label>
          <br>
          <div class="text-end">
            <button class="btn btn-primary" type="submit"
             onclick="addComment({{$answer_id ?? 'null'}}, {{$question_id ?? 'null'}})">
              Post Comment
            </button>
          </div>
        </form>
      </div>
      <script src="/js/add_comment.js"></script>
    </div>
  @endauth
</div>
