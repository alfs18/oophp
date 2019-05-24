<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<a class="content-a" href="../content">Alla inlägg</a>
<a class="content-a" href="admin">Admin</a>
<a class="content-a" href="create">Skapa</a>
<a class="content-a" href="show-pages">Visa sidor</a>
<a class="content-a" href="show-blog">Visa blogg</a>

<br><br>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
    ?>
    <form method="post">
        <input type="hidden" name="contentId" value="<?= $row->id ?>">
        <input class="content-show" type="submit" name="toBlog" value="<?= $row->title ?>">
    </form>
    <p>
    Publiserat: <?= $row->published ?><br>
    <?= $row->data ?>
    </p>
<?php endforeach; ?>
