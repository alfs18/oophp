<?php
namespace Alfs\Dice;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));


/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    // Init the game
    $_SESSION = [];
    $_SESSION["game"] = new DiceGraphic();
    $_SESSION["player1"] = $_SESSION["game"]->getPlayer1();
    $_SESSION["player2"] = $_SESSION["game"]->getPlayer2();
    $_SESSION["points"] = $_SESSION["game"]->getPoints();

    // init the session for the gamestart.
    return $app->response->redirect("dice/play");
});

/**
 * Play the game - show game status.
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    // Get current settings from the SESSION
    $game = $_SESSION["game"];
    $res = $_SESSION["res"] ?? null;
    $class = $_SESSION["class"] ?? null;
    $player1 = $_SESSION["player1"] ?? null;
    $player2 = $_SESSION["player2"] ?? null;

    $rollDice = $_SESSION["rollDice"] ?? null;
    $save = $_SESSION["save"] ?? null;
    $doInit = $_SESSION["doInit"] ?? null;

    if ($game->checkGameStatus() == "win") {
        return $app->response->redirect("dice/win");
    } elseif ($game->checkGameStatus() == "lose") {
        return $app->response->redirect("dice/end");
    }

    $data = [
        "game" => $game,
        "res" => $res ?? null,
        "class" => $class ?? null,
        "player1" => $player1 ?? null,
        "player2" => $player2 ?? null,
        "save" => $save ?? null,
        "rollDice" => $rollDice ?? null,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess.
 */
$app->router->post("dice/play", function () use ($app) {
    $title = "Play the game";

    // Deal with incoming variables
    $game = $_SESSION["game"] ?? null;
    $rollDice = $_POST["rollDice"] ?? null;
    $save = $_POST["save"] ?? null;
    $doInit = $_POST["doInit"] ?? null;

    // Get current settings from the SESSION
    // $player1 = $_POST["player1"] ?? null;
    // $player2 = $_POST["player2"] ?? null;
    $points = $_POST["points"] ?? 2;

    if ($rollDice) {
        // $rolls = 3;
        // $total = 0;
        // $res = [];
        // $class = [];
        // for ($i = 0; $i < $rolls; $i++) {
        //     $res[] = $game->getDice();
        //     $class[] = $game->graphic($i+1);
        //     // if ($game->checkDiceValue($res[$i]) == "no") {
        //     //     echo "smask";
        //     // }
        //     $total += $res[$i];
        //     // $game->setPoints($res[$i]);
        // }
        // $game->setPoints($total);
        // $status = $game->checkGameStatus();


        $game->roll();
        $player = $game->getPlayer();
        // $res = $game->getRes();
        // $class = $game->getClass();

        // $_SESSION["res"] = $res;
        $_SESSION["class"] = $game->getClass();
        // $_SESSION["total"] = $total;
        // $_SESSION["player1"] = $game->getPlayer1();
        // $_SESSION["player2"] = $game->getPlayer2();
    } elseif ($save) {
        // $_SESSION["res"] = [];
        $_SESSION["class"] = [];
        // $points = $game->getPoints();
        // $player = $game->getPlayer();
        $game->savePoints();
        // $game->changePlayer($player);
    } elseif ($doInit) {
        return $app->response->redirect("dice/init");
    }

    return $app->response->redirect("dice/play");
});

/**
 * Play the game - show win page.
 */
$app->router->get("dice/win", function () use ($app) {
    $title = "Play the game";

    $app->page->add("dice/win");
    // $app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - show lose page.
 */
$app->router->get("dice/end", function () use ($app) {
    $title = "Play the game";

    $app->page->add("dice/end");
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
