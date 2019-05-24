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

<table class="content-table">
    <tr class="first">
        <th>Actions</th>
        <th>Rad</th>
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <th>Publiserad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Raderad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
    ?>
    <tr>
        <td>
            <form method="post">
                <input type="hidden" name="contentId" value="<?= $row->id ?>">
                <input type="submit" name="doEdit" value="Ä" title="Ändra innehåll">
                <input type="submit" name="doDelete" value="R" title="Radera innehåll">
            </form>
            <!-- <a href="edit-<?#= $row->id ?>" title="Ändra innehåll <?#= $row->id ?>">Ändra</a> -->
            <!-- <a href="delete" title="Ändra innehåll <?#= $row->id ?>">Radera</a> -->
        </td>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
