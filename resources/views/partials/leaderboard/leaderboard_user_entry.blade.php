<tr>
  <th scope="row" class="text-center">
    {{ $place }}
  </th>
  <td class="text-center">
    <a class="fw-bold" href="/profile/{{ $user->id }}">
      {{ $user->username }}
    </a>
  </td>
  <td class="text-center">
    {{ $user->reputation }}
  </td>
</tr>
