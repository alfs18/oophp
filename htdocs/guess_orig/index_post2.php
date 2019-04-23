<?php
require __DIR__ . "/src/autoload.php";
require __DIR__ . "/src/config.php";

// Deal with incoming variables
$number = $_POST["number"] ?? null;
$tries = $_POST["tries"] ?? null;
$guess = $_POST["guess"] ?? null;    // kmr in när man gissat ngt & knapptryckt
$doInit = $_POST["doInit"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;


if ($doInit || $number === null) {
    $game = new Guess();
    $game->random();
    // var_dump($game);

    $number = $game->number();
    // $_POST["number"] = $number;
    $tries = $game->tries();
    // var_dump($game);
    // var_dump($number);
} elseif ($doGuess) {
    $tries -= 1;
    // echo "smask " . $number . " " . $tries . " end ";
    // echo $_POST["number"] . $_POST["tries"] . "<pre>";
    $game = new Guess(intval($number), intval($tries));
    // var_dump($game);
    // var_dump("bä " . $game->tries());
    // $game->makeGuess($guess);
} elseif ($doCheat) {
    $game = new Guess(intval($number), intval($tries));
    // var_dump($game);
}
// // $object = new Guess(intval($number), intval($tries));
// if ($doInit || $number === null) {
//     // Init the game
//     // $object = new Guess();
//     $number = $object->random();
//     echo "num" . $number;
// } elseif ($doGuess) {
//     // Do a guess
//     $res = $object->makeGuess($guess);
//     echo "num" . $number;
// }

// Render the page
require __DIR__ . "/view/guess_post2.php";
