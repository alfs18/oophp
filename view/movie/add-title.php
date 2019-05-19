<?php

namespace Anax\View;

?>
<form method="post">
    <fieldset>
    <legend>Add</legend>
    <input type="hidden" name="route" value="add-title">
    <p>
        <label>Title:<br>
            <input type="text" name="addTitle" value="<?= $addTitle ?: "Movie title" ?>"/>
        </label><br>
        <label>Year:<br>
            <input type="number" name="addYear" value="<?= $addYear ?: 2018 ?>"/>
        </label><br>
        <label>Image:<br>
            <input type="text" name="addImage" value="<?= $addImage ?: "img/noimage.png" ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doAdd" value="Add">
    </p>
    <p><a href="select">Tillbaka</a></p>
    </fieldset>
</form>
