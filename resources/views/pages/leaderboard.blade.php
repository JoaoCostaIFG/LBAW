@extends('layouts.layout')

@section('title', 'Leaderboard')
    
@section('content')

<div class="container">
  <h2 class="page-title">Leaderboard</h2>
  <div class="container-fluid row justify-content-center mt-4">
    <div class="col-auto">
      <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" colspan="3" class="text-center"><h3><b>Top Users</b></h3></th>
          </tr>
          <tr class="text-center">
            <th scope="col" style="width:5%" class="text-center"><h5>Pos</h5></th>
            <th scope="col" class="text-center"><h5>Username</h5></th>
            <th scope="col" class="text-center"><h5>Score</h5></th>
          </tr>
        </thead>
        <tbody>

          <?php
            $usersLen = count($users);
            for($i = 0; $i < $usersLen; $i++){ ?>
              <tr>
                <th scope="row" class="text-center">
                  {{ $i + 1 }}
                </th>
                <td class="text-center">
                  {{ $users[$i]['username'] }}
                </td>
                <td class="text-center">
                  {{$users[$i]['reputation']}}
                </td>
              </tr>
            <?php }?>

        </tbody>
      </table>
    </div>

    <div class="col-auto align-self-center">
      <table class="table table-dark table-striped table-bordered align-middle">
        <thead>
          <tr>
            <th scope="col" colspan="3" class="text-center"><h3><b>Top Questions</b></h3></th>
          </tr>
          <tr class="text-center">
            <th scope="col" style="width:5%" class="text-center"><h5>Pos</h5></th>
            <th scope="col" class="text-center"><h5>Question</h5></th>
            <th scope="col" class="text-center"><h5>Score</h5></th>
          </tr>
        </thead>
        <tbody>
          <!-- TODO: Questions -->
          <tr>
            <th scope="row" class="text-center">1.</th>
            <td class="text-center">Why do html pretifiers make code longer?</td>
            <td class="text-center">366</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
