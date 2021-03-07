<?php
require_once '../templates/tpl_header.php';
require_once '../templates/tpl_footer.php';

$title="Leaderboard";
drawHeader($title);
?>

<main>
  <div class="container-fluid row p-5 justify-content-center">
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
          <tr>
            <th scope="row" class="text-center">1.</th>
            <td class="text-center">Smart Guy</td>
            <td class="text-center">300</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2.</th>
            <td class="text-center">Bazinga201</td>
            <td class="text-center">298</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">Arinator06</td>
            <td class="text-center">269</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">4.</th>
            <td class="text-center">OitentaEOito</td>
            <td class="text-center">139</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">5.</th>
            <td class="text-center">SmartGuy808</td>
            <td class="text-center">138</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">6.</th>
            <td class="text-center">IraoForca</td>
            <td class="text-center">137</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">7.</th>
            <td class="text-center">DogSkelozard</td>
            <td class="text-center">120</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">8.</th>
            <td class="text-center">Spinning3Plates</td>
            <td class="text-center">105</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">9.</th>
            <td class="text-center">MindaLartini</td>
            <td class="text-center">193</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">10.</th>
            <td class="text-center">GetALog</td>
            <td class="text-center">101</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">11.</th>
            <td class="text-center">InMinecraftSite30</td>
            <td class="text-center">97</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">12.</th>
            <td class="text-center">OutOfChars404</td>
            <td class="text-center">95</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">13.</th>
            <td class="text-center">EndOfMyFile</td>
            <td class="text-center">83</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">14.</th>
            <td class="text-center">LaughingLmao</td>
            <td class="text-center">57</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">15.</th>
            <td class="text-center">OrelhasDoLucas</td>
            <td class="text-center">56</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">16.</th>
            <td class="text-center">FogtaoAntum</td>
            <td class="text-center">50</td>
          </tr>
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
          <tr>
            <th scope="row" class="text-center">1.</th>
            <td class="text-center">Why do html pretifiers make code longer?</td>
            <td class="text-center">366</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">2.</th>
            <td class="text-center">How do I print a UTF-16 string in Zig?</td>
            <td class="text-center">355</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">How do I delete a Git branch locally and remotely?</td>
            <td class="text-center">354</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">Error including library in Zig</td>
            <td class="text-center">343</td>
          </tr>
          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">Why doesn't nvim support the mcfunction plugin?</td>
            <td class="text-center">233</td>
          </tr>          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">Why is processing a sorted array faster than processing an unsorted array? </td>
            <td class="text-center">211</td>
          </tr>          <tr>
            <th scope="row" class="text-center">3.</th>
            <td class="text-center">How do I remove ambiguity from a CFG?</td>
            <td class="text-center">209</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

</main>

<?php
drawFooter();
?>
