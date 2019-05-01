<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?><h1>100-spelet</h1>
<p>Spelare 1: <?= $game->getPlayer1() ?? 0 ?> poäng</p>
<p class="dator">Datorn: <?= $game->getPlayer2() ?? 0 ?> poäng</p>
<!-- <p>?: <?#= $game->checkGameStatus() ?></p> -->
<p>Totalt: <?= $points = $game->getPoints() ?></p>
<p>Nu: <?= $game->getPlayer() ?></p>

<?php if ($class) : ?>
    <p class="dice-utf8">
    <?php foreach ($class as $value) : ?>
        <i class="<?= $value ?>"></i>
    <?php endforeach; ?>
    </p>
<?php endif; ?>

<form method="post">
    <!-- <input type="hidden" name="player1" value="<?= $game->getPlayer1() ?>"> -->
    <input type="hidden" name="points" value="<?= $points ?>">
    <input type="submit" name="rollDice" value="Slå ett slag">
    <input type="submit" name="save" value="Spara">
    <input type="submit" name="doInit" value="Starta om">
</form>

<!-- <pre>
<?= var_dump($_POST) ?> -->
