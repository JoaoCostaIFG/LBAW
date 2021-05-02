<div class="container">

    @each('partials.posts.comment', $post->comments, 'comment')
    @auth
        <div class="row" id="end-comment-{{$post->id}}">
            <a class="text-center dropdown-toggle" data-bs-toggle="dropdown"
            id="commentDropdownLink" aria-expanded="false">
                Add comment
            </a>
            <div class="dropdown-menu" aria-labelledby="commentDropdownLink">
                <form class="container">
                    <h2>Your Comment</h2>
                    <textarea class="form-control" id="Textarea{{$post->id}}" rows="7"></textarea>
                    <label class="visually-hidden" for="Textarea{{$post->id}}">Add comment</label>
                    <a class="btn btn-primary" onclick="addComment({{$answer_id ?? 'null'}}, {{$question_id ?? 'null'}})">Post Comment</a>
                </form>
            </div>
            <script src="/js/add_comment.js"></script>
        </div>
    @endauth
</div>
