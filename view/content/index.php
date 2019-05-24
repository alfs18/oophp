<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?>
<a class="content-a" href="content">Alla inlägg</a>
<a class="content-a" href="content/admin">Admin</a>
<a class="content-a" href="content/create">Skapa</a>
<a class="content-a" href="content/show-pages">Visa sidor</a>
<a class="content-a" href="content/show-blog">Visa blogg</a>

<table class="content-table">
    <tr class="first">
        <th>Rad</th>
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Path</th>
        <th>Slug</th>
        <th>Publiserad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Raderad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
    ?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <!-- <td><?#= $row->data ?></td> -->
        <!-- <td><?#= $row->filter ?></td> -->
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
