<?php

namespace Anax\View;

?>
<form method="post">
    <fieldset>
    <legend>Edit</legend>
    <input type="hidden" name="route" value="add-title">
    <p>
        <label>Title:<br>
            <input type="text" name="editTitle" value="<?= $editTitle ?: $resultset[0]->title ?>"/>
        </label><br>
        <label>Year:<br>
            <input type="number" name="editYear" value="<?= $editYear ?: $resultset[0]->year ?>"/>
        </label><br>
        <label>Image:<br>
            <input type="text" name="editImage" value="<?= $editImage ?: $resultset[0]->image ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doEdit" value="Edit">
    </p>
    <p><a href="select">Tillbaka</a></p>
    </fieldset>
</form>
