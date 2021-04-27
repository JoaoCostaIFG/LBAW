@php
$is_selected = $text === $title
@endphp
<li class="list-group-item
@if ($is_selected)
    ' active'
@endif
">
    <a href= {{ $href }}>
      <i class="{{ 'bi ' . $icon }}"></i>
        @if ($is_selected)
            <b>
        @endif
        {{ " " . $text }}
        @if ($is_selected)
            </b>
        @endif
    </a>
  </li>
