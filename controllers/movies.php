<?php

use App\Movie;
use App\Actor;

$app->get("#^movies$#", function ($app) {
    $app->props["movies"] = Movie::get();
    $app->view = "movies";
});

$app->get("#^movies\/(?<id>\d+)#", function (&$app) {
    $movies = Movie::get($app->queryParams["id"]);
    if (empty($movies)) {
        render_error(404, "Movie not found");
    } else {
        $app->view = "movie";
    }

    $app->props["movies"] = array_shift($movies);
});

$app->get("#^movies\/new#", function (&$app) {
    $app->props["movies"] = Movie::get();
    $app->view = "create_movie";
});

$app->post("#^movies\/new#", function (&$app) {
    if (empty($_POST["name"]) || empty($_POST["release_date"])) {
        render_error(400, "Invalid name or release date");
    }

    $id = Movie::create($_POST["name"], $_POST["release_date"]);
    header("Location: /crud_php/movies/$id", 201);
    exit();
});

$app->get("#^movies\/delete\/(?<id>\d+)#", function (&$app) {
    Movie::delete($app->queryParams["id"]);

    header("Location: /crud_php/movies");
    exit();
});

$app->get("#^movies\/edit\/(?<id>\d+)#", function (&$app) {
    $movies = Movie::get($app->queryParams["id"]);

    if (empty($movies)) {
        render_error(404, "Movie not found");
    } else {
        $app->view = "edit_movie";
    }

    $app->props["movie"] = array_shift($movies);

    $actors = Actor::get();
    foreach ($actors as $actor) {
        unset($actor["movies"]);
        $actors[$actor["actor_id"]] = $actor;
    }

    $app->props["actors"] = $actors;
});

$app->post("#^movies\/edit\/(?<id>\d+)#", function (&$app) {
    if (empty($_POST["name"]) || empty($_POST["release_date"])) {
        render_error(400, "Invalid name or release date");
    }

    Movie::edit($app->queryParams["id"], $_POST);
    header("Location: /crud_php/movies");
    exit();
});