<?php

namespace Anax\View;

?>
<a class="content-a" href="../content">Alla inlägg</a>
<a class="content-a" href="admin">Admin</a>
<a class="content-a" href="create">Skapa</a>
<a class="content-a" href="show-pages">Visa sidor</a>
<a class="content-a" href="show-blog">Visa blogg</a>

<form method="post" id="edit-content">
    <fieldset>
    <legend>Ändra</legend>
    <input type="hidden" name="contentId" value="edit">
    <p>
        <!-- <?#= var_dump($resultset) ?> -->
        <!-- <?#= var_dump($id) ?> -->
        <label>Titel:</label><br>
        <input type="text" name="editTitle" value="<?= $editTitle ?>"></input><br>
        <label>Path:</label><br>
        <input type="text" name="editPath" value="<?= $editPath ?>"/><br>
        <label>Slug:</label><br>
        <input type="text" name="editSlug" value="<?= $editSlug ?>"/><br>
        <label>Text:</label><br>
        <textarea class="content-text" name="editText"><?= $editText ?></textarea><br>
        <label>Typ:</label><br>
        <input type="text" name="editType" value="<?= $editType ?>"/><br>
        <label>Filter:</label><br>
        <input type="text" name="editFilter" value="<?= $editFilter ?>"/><br>
    </p>
    <p>
        <input type="submit" name="doSave" value="Spara">
    </p>
    </fieldset>
</form>
