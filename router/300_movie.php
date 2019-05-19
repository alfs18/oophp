<?php
/**
 * Show all movies
 */
$app->router->get("movie", function () use ($app) {
    $data = [
        "title" => "Movie database ",
    ];

    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    // $sth = $app->pdo->prepare($sql);
    // $sth->execute();
    // $res = $sth->fetchAll();

    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("movie/index", $data);
    $app->page->render($data);
});

$app->router->get("select", function () use ($app) {
    $data = [
        "title" => "Movie database ",
        "movieId" => -1,
    ];

    $app->db->connect();

    $sql = "SELECT * FROM movie;";
    $res = $app->db->executeFetchAll($sql);

    $data["resultset"] = $res;

    $app->view->add("movie/select", $data);
    $app->page->render($data);
});

$app->router->get("search-title", function () use ($app) {
    $res = $_SESSION["result"] ?? null;

    $data = [
        "title" => "Movie database ",
        "searchTitle" => "",
        "resultset" => $res,
    ];

    $app->view->add("movie/search-title", $data);
    $app->page->render($data);
});

$app->router->get("search-year", function () use ($app) {
    $data = [
        "title" => "Movie database ",
        "year1" => "",
        "year2" => "",
    ];

    $app->db->connect();

    $search = $_GET["doSearch"] ?? "";

    if ($search) {
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $res = $app->db->executeFetchAll($sql, [$search]);

        $data["resultset"] = $res;
    }

    $app->view->add("movie/search-year", $data);
    $app->page->render($data);
});

$app->router->get("show-title", function () use ($app) {
    $result = $_SESSION["resultset"] ?? null;

    $app->db->connect();

    $sql = "SELECT * FROM movie WHERE title LIKE ?;";
    $res = $app->db->executeFetchAll($sql, [$result]);

    $data["resultset"] = $res;

    $data = [
        "title" => "Movie database ",
        "searchTitle" => "",
        "resultset" => $res,
    ];

    $app->view->add("movie/show-title", $data);
    $app->page->render($data);
});

$app->router->get("show-year", function () use ($app) {
    $year1 = $_SESSION["year1"];
    $year2 = $_SESSION["year2"];

    $app->db->connect();

    $sql = "SELECT * FROM movie WHERE year BETWEEN ? AND ?;";
    $res = $app->db->executeFetchAll($sql, [$year1, $year2]);

    $data["resultset"] = $res;

    $data = [
        "title" => "Movie database ",
        "searchTitle" => "",
        "resultset" => $res,
    ];

    $app->view->add("movie/show-year", $data);
    $app->page->render($data);
});

$app->router->get("add-title", function () use ($app) {

    $data = [
        "title" => "Movie database ",
        "addTitle" => "",
        "addYear" => "",
        "addImage" => "",
        // "resultset" => $res,
    ];

    $app->view->add("movie/add-title", $data);
    $app->page->render($data);
});

$app->router->get("edit-title", function () use ($app) {
    $id = $_SESSION["movieId"];

    $app->db->connect();

    $sql = "SELECT * FROM movie WHERE id = ?;";
    $res = $app->db->executeFetchAll($sql, [$id]);

    // $data["resultset"] = $res;

    $data = [
        "title" => "Movie database ",
        "editTitle" => "",
        "editYear" => "",
        "editImage" => "",
        "resultset" => $res,
    ];

    $app->view->add("movie/edit-title", $data);
    $app->page->render($data);
});

$app->router->get("smask", function () use ($app) {
    $movieId = $_SESSION["movieId"];

    $data = [
        "title" => "Movie database ",
        "searchTitle" => "",
        "movieId" => $movieId,
    ];

    $app->view->add("movie/smask", $data);
    $app->page->render($data);
});

$app->router->post("search-title", function () use ($app) {

    $res = $_POST["searchTitle"];
    $_SESSION["resultset"] = $res;

    return $app->response->redirect("show-title");
});

$app->router->post("search-year", function () use ($app) {

    $year1 = $_POST["year1"];
    $_SESSION["year1"] = $year1;

    $year2 = $_POST["year2"];
    $_SESSION["year2"] = $year2;

    return $app->response->redirect("show-year");
});

$app->router->post("select", function () use ($app) {
    $doAdd = $_POST["doAdd"] ?? null;
    $doEdit = $_POST["doEdit"] ?? null;
    $doDelete = $_POST["doDelete"] ?? null;
    $movieId = $_POST["movies"] ?? "bä";
    $_SESSION["movieId"] = $movieId;

    if ($doAdd) {
        return $app->response->redirect("add-title");
    } elseif ($doEdit) {
        return $app->response->redirect("edit-title");
    } elseif ($doDelete) {
        $app->db->connect();

        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);

        // return $app->response->redirect("smask");
    }

    return $app->response->redirect("select");
});

$app->router->post("add-title", function () use ($app) {
    $addTitle = $_POST["addTitle"];
    $addYear = $_POST["addYear"];
    $addImage = $_POST["addImage"];

    $app->db->connect();

    $sql = "INSERT INTO movie
        (title, year, image)
        VALUES (?, ?, ?);";

    $app->db->executeFetchAll($sql, [
        $addTitle,
        $addYear,
        $addImage
    ]);

    return $app->response->redirect("select");
});

$app->router->post("edit-title", function () use ($app) {
    $editTitle = $_POST["editTitle"];
    $editYear = $_POST["editYear"];
    $editImage = $_POST["editImage"];
    $movieId = $_SESSION["movieId"];

    $app->db->connect();

    $sql = "UPDATE movie
        SET
            title = ?,
            year = ?,
            image = ?
        WHERE
            id = ?;";

    $app->db->executeFetchAll($sql, [
        $editTitle,
        $editYear,
        $editImage,
        $movieId
    ]);

    return $app->response->redirect("select");
});
