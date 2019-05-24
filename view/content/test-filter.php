<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

?>

<p><?= $firstText ?>
<?= $resultset ?>
<br><br>Till sist: <br>
<?= $resultset2 ?>
</p>
