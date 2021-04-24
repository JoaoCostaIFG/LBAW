<?php
function drawLeaderboardUserEntry($place, $user){?>
  <tr>
    <th scope="row" class="text-center">
        {{ $place }}
    </th>
    <td class="text-center">
        {{ $user['username'] }}
    </td>
    <td class="text-center">
        {{$user['reputation']}}
    </td>
  </tr>
<?php }?>

<?php
function drawLeaderboardQuestionEntry($place, $question){?>
  <tr>
    <th scope="row" class="text-center">
      {{ $place }}
    </th>
    <td class="text-center">
      {{ $question->title }}
    </td>
    <td class="text-center">
      {{ $question->score }}
    </td>
  </tr>
<?php }?>