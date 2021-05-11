<!-- Users -->
<div class="tab-pane fade" id="users">
    <div class="d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 d-none d-md-block pt-2 pb-2" id="users-title">Showing {{ $users->count() }} out of {{ $users->total() }} result(s)</h6>
        <!-- Sort by-->
        <ul class="nav nav-pills">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle p-0 d-flex flex-row align-items-center" data-bs-toggle="dropdown"
                    href="#" role="button">
                    <span class="d-none d-sm-block">Sort by</span>
                    <i class="bi bi-filter-right"></i></a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/search?sortBy=most_points{{ $search_url }}#users">Most Points</a></li>
                    <li><a class="dropdown-item" href="/search?sortBy=least_point{{ $search_url }}s#users">Least Points</a></li>
                    <li><a class="dropdown-item" href="/search">-- No order --</a></li>
                </ul>
            </li>
        </ul>
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
