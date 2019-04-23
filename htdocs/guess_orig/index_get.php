<?php
require __DIR__ . "/src/autoload.php";
require __DIR__ . "/src/config.php";

// Deal with incoming variables
$number = $_GET["number"] ?? null;
$tries = $_GET["tries"] ?? null;
$guess = $_GET["guess"] ?? null;    // kmr in när man gissat ngt & knapptryckt
$doInit = $_GET["doInit"] ?? null;
$doGuess = $_GET["doGuess"] ?? null;
$doCheat = $_GET["doCheat"] ?? null;

if ($doInit || $number === null) {
    // Init the game
    // denna initdel sker bara 1:a ggn el när Starta om trycks
    // slumpar fram siffra
    $number = rand(1, 100);
    // nollställer försöksräknaren, sätter den till 5 försök
    $tries = 5;
    // redirect tbx till spelet, lägger till spelets ställning, det efter ?
    header("Location: index_get.php?tries=$tries&number=$number");
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
?><h1>Guess my number</h1>

<p>Guess num between 1 & 100, you have <?= $tries ?> left.</p>

<form>
    <input type="text" name="guess">
    <!-- dolt fält som skickar med rätt nummer varje runda -->
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <p>Your guess <?= $guess ?> is <b><?= $res ?></b></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?></p>
<?php endif; ?>

<!-- <pre>
<?= var_dump($_GET) ?> -->
