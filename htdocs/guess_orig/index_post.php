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
    // Init the game
    // denna initdel sker bara 1:a ggn el när Starta om trycks
    // slumpar fram siffra
    $number = rand(1, 100);
    // nollställer försöksräknaren, sätter den till 5 försök
    $tries = 5;
    // redirect tbx till spelet, lägger till spelets ställning, det efter ?
    // header("Location: index_get.php?tries=$tries&number=$number");
} elseif ($doGuess) {
    // Do a guess
    $tries -= 1;
    if ($guess === $number) {
        $res = "CORRECT";
    } elseif ($guess > $number) {
        $res = "TOO HIGH";
    } else {
        $res = "TOO LOW";
    }
}

// Render the page
require __DIR__ . "/view/guess_post.php";
