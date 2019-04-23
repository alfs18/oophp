<?php
require __DIR__ . "/src/autoload.php";
require __DIR__ . "/src/config.php";

// session_name("alfs18");
// session_start();

// Deal with incoming variables
// $game = $_POST["game"] ?? null;
$number = $_POST["number"] ?? null;
$tries = $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;    // kmr in när man gissat ngt & knapptryckt
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;


if ($doInit || $number === null) {
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setCookie(
            session_name(alfs),
            '',
            time() - 42000,
            $params["path"],
            $params["domain"],
            $params["secure"],
            $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();
    // echo "The session is destroyed.";

    $game = new Guess();
    $game->random();

    $number = $game->number();
    $tries = $game->tries();
    // echo "one " . $game->tries() . " " . $tries;
    require __DIR__ . "/view/guess_num_post.php";
} elseif ($doGuess) {
    $tries -= 1;
    $game = new Guess(intval($number), intval($tries));
    // echo "smask" . $game->tries() . " " . $tries;
    if ($game->makeGuess($guess) == "END!") {
        // echo "bye";
        require __DIR__ . "/view/end.php";
    } elseif ($game->makeGuess($guess) == "CORRECT") {
        require __DIR__ . "/view/win.php";
    } else {
        require __DIR__ . "/view/guess_num_post.php";
    }
} elseif ($doCheat) {
    $game = new Guess(intval($number), intval($tries));
    // echo blö;
    require __DIR__ . "/view/guess_num_post.php";
}

// if ($game->makeGuess($guess) == "END!") {
//     echo blä;
// } else {
//     // Render the page
//     require __DIR__ . "/view/guess_num_post.php";
// }
