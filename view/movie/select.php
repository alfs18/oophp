<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<a href="movie">Alla filmer</a>
<a href="search-title">Sök titel</a>
<a href="search-year">Sök år</a>
<a href="select">Select</a>

<form method="post">
    <fieldset>
    <legend>Select</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Movie:<br>
        <select name="movies">
            <option value="">-- Select movie --</option>
            <?php $id = 0; foreach ($resultset as $row) :
                $id++;
                ?>
            <option value="<?= $row->id ?>"><?= $row->title ?></option>
            <?php endforeach; ?>
        </select>
        </label>
    </p>
    <p>
        <input type="submit" name="doAdd" value="Add">
        <input type="submit" name="doEdit" value="Edit">
        <input type="submit" name="doDelete" value="Delete">
    </p>
    <p><a href="movie">Show all</a></p>
    </fieldset>
</form>

<!-- <pre><?#= $sql ?>

<pre>
<?#= print_r($resultset, true) ?>
</pre> -->
