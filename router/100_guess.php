<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the game
    // $game = new Alfs\Guess\Guess();
    $_SESSION = [];
    $_SESSION["game"] = new Alfs\Guess\Guess();
    $_SESSION["number"] = $_SESSION["game"]->number();
    $_SESSION["tries"] = $_SESSION["game"]->tries();

    // init the session for the gamestart.
    return $app->response->redirect("guess/play");
});

/**
 * Play the game - show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Get current settings from the SESSION
    // $game = $_SESSION["game"] ?? new Alfs\Guess\Guess()
    $game = $_SESSION["game"] ?? null;
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;

    $number = $_SESSION["number"] ?? null;
    $doInit = $_SESSION["doInit"] ?? null;
    $doGuess = $_SESSION["doGuess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;

    $data = [
        "game" => $game,
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat,
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess.
 */
$app->router->post("guess/play", function () use ($app) {
    $title = "Play the game";

    // Deal with incoming variables
    $game = $_POST["game"] ?? null;
    $guess = $_POST["guess"] ?? null;    // kmr in när man gissat ngt & knapptryckt
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // Get current settings from the SESSION
    $number = $_POST["number"] ?? null;
    $tries = $_POST["tries"] ?? null;

    // if ($guess == null) {
    //     $game = new Alfs\Guess\Guess();
    //
    //     $_SESSION["tries"] = $game->tries();
    //     $_SESSION["res"] = $res;
    //     $_SESSION["guess"] = $guess;
    //     $_SESSION["number"] = $game->number();
    // }
    if ($doGuess) {
        // $tries -= 1;
        $_SESSION["tries"] -= 1;
        $tries = $_SESSION["tries"];

        $game = new Alfs\Guess\Guess(intval($number), intval($_SESSION["tries"]));
        $res = $game->makeGuess($guess);

        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
        $_SESSION["number"] = $game->number();
        $_SESSION["doCheat"] = null;

        if ($game->makeGuess($guess) == "END!") {
            // echo "bye";
            // $_SESSION = [];
            $data = [
                "number" => $number,
            ];
            return $app->response->redirect("guess/end", $data);
        } elseif ($game->makeGuess($guess) == "CORRECT") {
            $_SESSION = [];
            return $app->response->redirect("guess/win");
        }
    } elseif ($doCheat) {
        $doCheat = "smask";
        $_SESSION["doCheat"] = $doCheat;

        $data = [
            "doCheat" => $doCheat,
        ];

        $app->page->add("guess/play", $data);
        return $app->response->redirect("guess/play");
    } elseif ($doInit) {
        $_SESSION = [];
        return $app->response->redirect("guess/init");
    }

    return $app->response->redirect("guess/play");
});

/**
 * Play the game - show win page.
 */
$app->router->get("guess/win", function () use ($app) {
    $title = "Play the game";

    $app->page->add("guess/win");
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - show lose page.
 */
$app->router->get("guess/end", function () use ($app) {
    $title = "Play the game";

    $number = $_SESSION["number"] ?? null;

    $data = [
        "number" => $number,
    ];

    $app->page->add("guess/end", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});
