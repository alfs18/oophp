<?php

namespace Alfs\MyTextFilter;

// Get essentials
require "../src/Content/Content.php";

/**
 * Show all contents
 */
$app->router->get("content", function () use ($app) {
    $data = [
        "title" => "Content database",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("content/index", $data);
    $app->page->render($data);
});

$app->router->get("content/admin", function () use ($app) {
    $data = [
        "title" => "Content database",
        "contentId" => -1,
    ];

    $ct = $_SESSION["contentText"] ?? null;

    if ($ct) {
        $data["contentText"] = $ct;
    }

    $app->db->connect();

    $sql = "SELECT * FROM content;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("content/admin", $data);
    $app->page->render($data);
});

$app->router->get("content/create", function () use ($app) {
    $data = [
        "title" => "Content database",
        "addTitle" => "",
        "addYear" => "",
        "addImage" => "",
        // "resultset" => $res,
    ];

    $app->view->add("content/create", $data);
    $app->page->render($data);
});

$app->router->get("content/show-pages", function () use ($app) {
    $data = [
        "title" => "Content database",
        "contentId" => -1,
    ];

    $app->db->connect();

    $sql = "SELECT * FROM content WHERE type = ?;";
    $res = $app->db->executeFetchAll($sql, ["page"]);

    $data["resultset"] = $res;

    $app->view->add("content/show-pages", $data);
    $app->page->render($data);
});

$app->router->get("content/show-blog", function () use ($app) {
    $data = [
        "title" => "Content database",
        "contentRoute" => "",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM content WHERE type = ?;";
    $res = $app->db->executeFetchAll($sql, ["post"]);

    $data["resultset"] = $res;

    $app->view->add("content/show-blog", $data);
    $app->page->render($data);
});

$app->router->get("content/edit", function () use ($app) {
    $id = $_SESSION["contentId"];

    $app->db->connect();
    // $cont = new Content();
    // $id = $cont->getContentId();

    $sql = "SELECT * FROM content WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$id]);

    $data = [
        "title" => "Content database",
        "editTitle" => $res[0]->title,
        "editPath" => $res[0]->path,
        "editSlug" => $res[0]->slug,
        "editText" => $res[0]->data,
        "editType" => $res[0]->type,
        "editFilter" => $res[0]->filter,
    ];

    $data["resultset"] = $res;
    $data["id"] = $id;

    $app->view->add("content/edit", $data);
    $app->page->render($data);
});

$app->router->get("content/delete", function () use ($app) {
    $id = $_SESSION["contentId"];

    $app->db->connect();

    $sql = "SELECT * FROM content WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$id]);

    $data = [
        "title" => "Content database",
        "delTitle" => $res[0]->title,
        "contentId" => $id,
    ];

    // $data["resultset"] = $res;

    $app->view->add("content/delete", $data);
    $app->page->render($data);
});

$app->router->get("content/blog-post", function () use ($app) {
    $contentId = $_SESSION["contentId"] ?? 0;

    $filter = new MyTextFilter();

    $app->db->connect();
    $sql = "SELECT * FROM content WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$contentId]);

    $contFilter = explode(",", $res[0]->filter);
    $text = $res[0]->data;
    $html = $filter->parse($text, $contFilter);

    $data = [
        "title" => "Content database",
        "contentId" => $contentId,
        "resultset" => $res,
        "contentData" => $html,
        "contFilter" => $contFilter,
    ];

    $app->view->add("content/blog-post", $data);
    $app->page->render($data);
});

$app->router->get("content/test-filter", function () use ($app) {
    $filter = new MyTextFilter();

    $contFilter = ["bbcode", "link", "markdown", "nl2br"];
    $text = "Först lite vanlig text följt av en tom rad.

    Då tar vi ett nytt stycke med lite bbcode med [b]bold[/b] och [i]italic[/i] samt en [url=https://dbwebb.se]länk till dbwebb[/url].

    Sen testar vi en länk till https://dbwebb.se som ska bli klickbar.

    Avslutningsvis blir det en [länk skriven i markdown](https://dbwebb.se) och länken leder till dbwebb.

    Avslutar med en lista som formatteras till ul/li med markdown.

    * Item 1
    * Item 2";
    $html = $filter->showParse($text, $contFilter);

    $contFilter2 = ["bbcode", "link", "nl2br"];
    $html2 = $filter->parse($text, $contFilter2);

    $data = [
        "title" => "Content database",
        "firstText" => $text,
        "resultset" => $html,
        "resultset2" => $html2,
    ];

    $app->view->add("content/test-filter", $data);
    $app->page->render($data);
});

$app->router->post("content/admin", function () use ($app) {
    $doEdit = $_POST["doEdit"] ?? null;
    $doDelete = $_POST["doDelete"] ?? null;
    $_SESSION["contentId"] = $_POST["contentId"];

    if ($doEdit) {
        return $app->response->redirect("content/edit");
    }

    return $app->response->redirect("content/delete");
});

$app->router->post("content/edit", function () use ($app) {
    $id = $_SESSION["contentId"];
    // $_SESSION["contentText"] = $_POST["editText"];

    $editPath = checkPath($_POST["editPath"]);
    $editSlug = checkSlug($_POST["editSlug"], $app->db);

    $app->db->connect();
    $sql = "UPDATE content
        SET
            title = ?,
            path = ?,
            slug = ?,
            data = ?,
            type = ?,
            filter = ?
        WHERE
            id = ?;";
    $res = $app->db->executeFetchAll($sql, [
        $_POST["editTitle"],
        $editPath,
        $editSlug,
        $_POST["editText"],
        $_POST["editType"],
        $_POST["editFilter"],
        $id
    ]);

    return $app->response->redirect("content/admin");
});

$app->router->post("content/create", function () use ($app) {
    $addTitle = $_POST["addTitle"];

    $app->db->connect();
    $sql = "INSERT INTO content
        (title)
        VALUES (?);";

    $app->db->executeFetchAll($sql, [$addTitle]);

    return $app->response->redirect("content/admin");
});

$app->router->post("content/show-blog", function () use ($app) {
    $_SESSION["contentId"] = $_POST["contentId"];
    // $data["contentRoute"] = $_POST["contentRoute"];

    return $app->response->redirect("content/blog-post");
});

$app->router->post("content/show-pages", function () use ($app) {
    $_SESSION["contentId"] = $_POST["contentId"];
    // $data["contentRoute"] = $_POST["contentRoute"];

    return $app->response->redirect("content/blog-post");
});

$app->router->post("content/delete", function () use ($app) {
    $contentId = $_POST["contentId"];

    $app->db->connect();
    $sql = "UPDATE content
            SET
                deleted = NOW()
            WHERE
                id = ?;";

    $app->db->executeFetchAll($sql, [$contentId]);

    return $app->response->redirect("content/admin");
});
