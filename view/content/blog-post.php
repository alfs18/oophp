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

<br>
<h2><?= $resultset[0]->title ?></h2>
<!-- <?#= $contentId ?> -->
<p>Publiserat: <?= $resultset[0]->published ?></p>
<p><?= $resultset[0]->data ?></p>
<?= $contentData ?>
<!-- <?#= var_dump($contFilter) ?> -->
