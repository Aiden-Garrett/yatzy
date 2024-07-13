<?php
require_once('_config.php');

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Yatzy\Dice;
use Yatzy\YatzyGame;

// make game in session
session_start();
$_SESSION["game"] = new YatzyGame();
//$_SESSION["leaderBoard"] = array();


$app = AppFactory::create();

$app->get('/', function (Request $request, Response $response, $args) {
    $view = file_get_contents("{$GLOBALS["appDir"]}/views/game.html");
    $response->getBody()->write($view);
    return $response;
});

$app->get('/api/version', function (Request $request, Response $response, $args) {
    // fill me in
    $data = ["version" => "1.0"];
    $response->getBody()->write(json_encode($data));
    return $response->withHeader('Content-Type', 'application/json');
});

$app->get('/api/roll', function (Request $request, Response $response, $args) {
    // fill me in
//    $d = new Dice();
//    $data = ["value" => $d->roll()];
//    $response->getBody()->write(json_encode($data));
//    return $response->withHeader('Content-Type', 'application/json');
    $dice = $_SESSION["game"]->roll();

    for ($i = 0; $i < count($dice); $i++) {
        $dice[$i] = $dice[$i]->getState();
    }
    $response->getBody()->write(json_encode($dice));
    return $response->withHeader('Content-Type', 'application/json');
});


$app->get('/api/score', function (Request $request, Response $response, $args) {
    $score = $_SESSION["game"]->roll();
    $response->getBody()->write(json_encode($score));
});

// get info about state of game:
// rolls remaining for turn
// scorecard
// dice states + numbers
$app->get('/api/game', function (Request $request, Response $response, $args) {
    $data = [
        "score" => $_SESSION["game"]->getScore(),
        "rolls" => $_SESSION["game"]->getRolls(),
        "dice" => [$_SESSION["game"]->getDice(), $_SESSION["game"]->getDiceStates()]
    ];
//    $_SESSION["game"]->
});


//put
$app->put('/api/toggleDice/{id}', function (Request $request, Response $response, $args) {
    $_SESSION["game"]->toggleDice($args['id']);
});


// put methods to update score
$app->put('/api/choose${scoringMethod}', function (Request $request, Response $response, $args) {
    $_SESSION["game"]->chooseScoringMethod($args['id']);
});


$app->run();

//<!--// prev lab-->
//<!--//require_once('_config.php');-->
//<!--//-->
//<!--//use Yatzy\Dice;-->
//<!--//use Yatzy\YatzyGame;-->
//<!--//-->
//<!--////$d = new Dice();-->
//<!--//-->
//<!--////for ($i=1; $i<=5; $i++) {-->
//<!--////    echo "ROLL {$i}: {$d->roll()}<br>";-->
//<!--////}-->
//<!--//-->
//<!--//// testing the game-->
//<!--//$game = new YatzyGame();-->
//<!--//echo $game;-->
//<!--//$game->roll();-->
//<!--//echo $game;-->
//<!--//// note the function takes the index of the dice to toggle (different from the visual dice num).-->
//<!--//$game->toggleKeeper(1);-->
//<!--//$game->toggleKeeper(2);-->
//<!--//$game->roll();-->
//<!--//echo $game;-->
