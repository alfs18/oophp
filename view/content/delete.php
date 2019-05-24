<?php

namespace Anax\View;

?>
<a class="content-a" href="../content">Alla inlägg</a>
<a class="content-a" href="admin">Admin</a>
<a class="content-a" href="create">Skapa</a>
<a class="content-a" href="show-pages">Visa sidor</a>
<a class="content-a" href="show-blog">Visa blogg</a>

<form method="post">
    <fieldset>
    <legend>Radera</legend>
    <input type="hidden" name="contentId" value="<?= $contentId ?>"/>
    <p>
        <label>Titel:<br>
            <input type="text" name="delTitle" value="<?= $delTitle ?>" readonly/>
        </label>
    </p>
    <p>
        <input type="submit" name="doDelete" value="Radera">
    </p>
    </fieldset>
</form>
