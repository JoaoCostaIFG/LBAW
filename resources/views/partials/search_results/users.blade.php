<!-- Users -->
<div class="tab-pane fade" id="users">
  <div class="d-flex flex-column flex-md-row justify-content-between my-2 py-1">
    <h6 class="my-2 py-1" id="questions">Showing {{ $users->count() }} out of {{ $users->total() }} result(s)</h6>
    <!-- Filter -->
    <form id="search-filters-form" method="GET" class="d-flex flex-row m-0 gap-1">
      <!-- Sort By -->
      <select class="col-auto" aria-label="Sort by" name="sortBy">
        <option value="">Sort By: ---</option>
        <option value="most_points">Sort By: Most Points</option>
        <option value="least_points">Sort By: Least Points</option>
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
