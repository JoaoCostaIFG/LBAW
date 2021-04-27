<div class="container">

    @each('partials.posts.comment', $post->comments, 'comment')

    <div class="row">
        <a class="text-center dropdown-toggle" data-bs-toggle="dropdown"
         id="commentDropdownLink" aria-expanded="false">
            Add comment
        </a>
        <div class="dropdown-menu" aria-labelledby="commentDropdownLink">
            <form class="container">
                <h2>Your Comment</h2>
                <textarea class="form-control" id="Textarea" rows="7"></textarea>
                <label class="visually-hidden" for="Textarea">Add comment</label>
                <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
        </div>
    </div>
</div>
