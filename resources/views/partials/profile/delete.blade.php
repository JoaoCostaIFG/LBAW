<div class="row justify-content-md-center">
    <button class="btn btn-danger col-2" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal"
        aria-controls="deleteModal" aria-expanded="false" aria-label="Open delete account box">
        Delete Account
    </button>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body text-center fw-bold">
                Are you sure?
            </div>
            <div class="modal-footer">
                <form method="POST" class="col-md text-center" action="{{ route('user') }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-sm btn-success mx-2">
                        <i class="bi bi-check2"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-danger mx-2" data-bs-dismiss="modal" data-bs-toggle="button">
                        <i class="bi bi-x"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
