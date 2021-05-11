<!-- Questions Tab -->
<div class="tab-pane fade show active" id="questions">
    <div class="row align-items-center justify-content-between my-2 py-1 gx-0">
        <h6 id="questions" class="col-12 col-lg-3 m-0">
            Showing {{ $questions->count() }} out of {{ $questions->total() }} result(s)
        </h6>
        <!-- Filter -->
        <form id="search-filters-form" method="GET" class="col-12 col-lg-9 row gx-0 gap-1">
            <!-- From: -->
            <div class="col-12 col-md-auto">
                <label for="start-date" class="form-label m-0"><b>From:</b></label>
                <input type="date" name="start_date"
                    class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" value="" id="start_date"
                    placeholder="mm/dd/yyyy">
                @if ($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
            </div>
            <!-- To: -->
            <div class="col-12 col-md-auto">
                <label for="end-date" class="form-label m-0"><b>To:</b></label>
                <input type="date" name="end_date"
                    class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" value="" id="end_date"
                    placeholder="mm/dd/yyyy">
                @if ($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
            </div>
            <!-- Sort By -->
            <select class="col-auto" aria-label="Sort by" name="sortBy">
                <option value="">Sort By: ---</option>
                <option value="most_recent">Sort By: Most Recent</option>
                <option value="oldest">Sort By: Oldest</option>
                <option value="best_score">Sort By: Best Score</option>
                <option value="worst_score">Sort By: Worst Score</option>
            </select>
            @if ($errors->has('sortBy'))
                <div class="invalid-feedback">
                    {{ $errors->first('sortBy') }}
                </div>
            @endif
            <!-- Filter Button -->
            <button onclick="" type="submit" class="col-auto btn btn-success">Apply</button>
        </form>
    </div>
    @foreach ($questions as $question)
        @include('partials.question_card')
    @endforeach
    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $questions->links() }}
    </div>
</div>