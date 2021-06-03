<li class="list-group-item @if ($is_selected)'active'@endif">
  <a href={{ $href }}>
    <i class="{{ 'bi ' . $icon }}"></i>@if ($is_selected)<b>{{ $text }}</b>@else{{ $text }}@endif
  </a>
</li>
