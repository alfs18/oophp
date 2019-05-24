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
    <legend>Skapa</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Titel:<br>
            <input type="text" name="addTitle" value="<?= $addTitle ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doCreate" value="Skapa">
    </p>
    </fieldset>
</form>
