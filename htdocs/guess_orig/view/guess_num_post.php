<!doctype>
<html>
<head>
    <meta charset="utf-8">
    <title>Guess my number</title>

    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <div class="middle">
        <h1>Guess my number</h1>
        <p>Guess a number between 1 & 100, you have <b> <?= $game->tries(); ?>
        </b> tries left.</p>

        <form method="post">
            <input type="text" name="guess">
            <!-- dolt fält som skickar med rätt nummer varje runda -->

            <input type="hidden" name="number" value="<?= $game->number() ?>">
            <input type="hidden" name="tries" value="<?= $game->tries() ?>">
            <input type="submit" name="doGuess" value="Make a guess">
            <input type="submit" name="doInit" value="Start from beginning">
            <input type="submit" name="doCheat" value="Cheat">
        </form>

        <?php if ($doGuess) : ?>
            <p>Your guess <?= $guess ?> is <b><?= $game->makeGuess($guess) ?></b></p>
        <?php endif; ?>

        <?php if ($doCheat) : ?>
            <p>CHEAT: Current number is <?= $game->number() ?></p>
        <?php endif; ?>

        <!-- <pre>
        <?= var_dump($_POST) ?> -->
    </div>
</body>
</html>
