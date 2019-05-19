<?php

namespace Anax\View;

?>
<a href="movie">Alla filmer</a>
<a href="search-title">Sök titel</a>
<a href="search-year">Sök år</a>
<a href="select">Select</a>

<form method="post">
    <fieldset>
    <legend>Search</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Title (use % as wildcard):
            <!-- <input type="search" name="searchTitle" value="<?#= esc($searchTitle) ?>"/> -->
            <input type="search" name="searchTitle" value="<?= $searchTitle ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Search">
    </p>
    <p><a href="movie">Show all</a></p>
    </fieldset>
</form>
