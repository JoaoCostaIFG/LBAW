<tr>
  <th scope="row" class="text-center">
    {{ $place }}
  </th>
  <td class="text-center">
    <a class="fw-bold" href="/question/{{ $question->id }}">
      {{ $question->title }}
    </a>
  </td>
  <td class="text-center">
    {{ $question->score }}
  </td>
</tr>
