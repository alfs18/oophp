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

<table class="content-table2">
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Typ</th>
        <!-- <th>Status</th> -->
        <th>Publiserad</th>
        <th>Raderad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++;
    ?>
    <tr>
        <td><?= $row->id ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="contentId" value="<?= $row->id ?>">
                <input class="content-show-page" type="submit" name="toBlog" value="<?= $row->title ?>">
            </form>
        </td>
        <td><?= $row->type ?></td>
        <!-- <td><?#= $row->status ?></td> -->
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
