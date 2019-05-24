<?php

// namespace Alfs\Content;

function checkPath($editPath)
{
    if ($editPath == "") {
        $editPath = null;
    }
    return $editPath;
}

function checkSlug($editSlug, $connection)
{
    $connection->connect();
    $sql1 = "SELECT * FROM content;";
    $res1 = $connection->executeFetchAll($sql1);

    if ($editSlug == "") {
        $editSlug = null;
    } else {
        foreach ($res1 as $row) {
            if ($editSlug == $row->slug) {
                if (is_int($row->slug[0])) {
                    $num = $row->slug[0] + 1;
                    $editSlug = $num . $editSlug;
                } else {
                    $editSlug = 1 . $editSlug;
                }
            }
        }
    }
    return $editSlug;
}
