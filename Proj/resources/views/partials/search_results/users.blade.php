<!-- Users -->
<div class="tab-pane fade" id="users">
  <div class="row align-items-center justify-content-between my-2 py-1 gx-0">
    <h3 id="users-page-subtitle" class="col-12 col-lg-3 m-0 fs-5">
      Showing {{ $users->count() }} out of {{ $users->total() }} result(s)
    </h3>
    <!-- Sort by-->
    <form class="search-filters-form col-12 col-lg-9 row gx-0 gap-1" method="GET">
      <!-- Sort By -->
      <select class="col-auto" aria-label="Sort by" name="sortByU">
        <option value="">Sort By: ---</option>
        <option value="most_points" @if ($sortByU=='most_points' ) selected @endif>Sort By: Most Points</option>
        <option value="least_points" @if ($sortByU=='least_points' ) selected @endif>Sort By: Least Points</option>
      </select>
      @if ($errors->has('sortByU'))
        <div class="invalid-feedback">
          {{ $errors->first('sortBy') }}
        </div>
      @endif
      <!-- Search -->
      <input type="hidden" name="q" value="{{$q}}">
      <input type="hidden" name="sortByQ" value="{{ $sortByQ }}">
      <!-- Filter Button -->
      <button onclick="" type="submit" class="col-auto btn btn-success">Apply</button>
    </form>
  </div>
  <div class="container">
    @for ($i = 0; $i < count($users); $i += 2)
      <div class="row py-1 gap-2">
        @include('partials.search_results.user_card', ['user' => $users[$i]])
        @if (isset($users[$i + 1]))
          @include('partials.search_results.user_card', ['user' => $users[$i + 1]])
        @endif
      </div>
    @endfor
  </div>
  <!-- Pagination -->
  <div class="d-flex justify-content-end">
    {{ $users->links() }}
  </div>
</div>
