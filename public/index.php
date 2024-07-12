<?php


require_once('_config.php');
?>

<div id="output">--</div>
<button id="version">Version</button>

<script>
    const output = document.getElementById("output");
    const version = document.getElementById("version");
    version.onclick = function (e) {
        const xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == XMLHttpRequest.DONE) {
                if (xmlhttp.status == 200) {
                    output.innerHTML = xmlhttp.responseText;
                }
            }
        };

        xmlhttp.open("GET", "/public/api.php", true);
        xmlhttp.send();
    }
</script>

<!--// prev lab-->
<!--//require_once('_config.php');-->
<!--//-->
<!--//use Yatzy\Dice;-->
<!--//use Yatzy\YatzyGame;-->
<!--//-->
<!--////$d = new Dice();-->
<!--//-->
<!--////for ($i=1; $i<=5; $i++) {-->
<!--////    echo "ROLL {$i}: {$d->roll()}<br>";-->
<!--////}-->
<!--//-->
<!--//// testing the game-->
<!--//$game = new YatzyGame();-->
<!--//echo $game;-->
<!--//$game->roll();-->
<!--//echo $game;-->
<!--//// note the function takes the index of the dice to toggle (different from the visual dice num).-->
<!--//$game->toggleKeeper(1);-->
<!--//$game->toggleKeeper(2);-->
<!--//$game->roll();-->
<!--//echo $game;-->
