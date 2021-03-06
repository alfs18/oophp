<h1>Guess my number</h1>

<p>Guess num between 1 & 100, you have <?= $tries ?> left.</p>

<form method="post">
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
<?= var_dump($_POST) ?> -->
