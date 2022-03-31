<?php

use App\Actor;
use App\Movie;

$app->get("#^actors$#", function (&$app) {
    $app->props["actors"] = Actor::get();
    $app->view = "actors";
});

$app->get("#^actors\/(?<id>\d+)#", function (&$app) {
    $actors = Actor::get($app->queryParams["id"]);

    if (empty($actors)) {
        render_error(404, "Actor not found");
    } else {
        $app->view = "actor";
    }

    $app->props["actor"] = array_shift($actors);
});

$app->get("#^actors\/new#", function (&$app) {
    $app->view = "create_actor";
});

$app->post("#^actors\/new#", function (&$app) {
    if (empty($_POST["name"]) || empty($_POST["dob"])) {
        render_error(400, "Invalid name or date of birth");
    }

    $id = Actor::create($_POST["name"], $_POST["dob"]);
    header("Location: /crud_php/actors/$id", 201);
    exit();
});


$app->get("#^actors\/delete\/(?<id>\d+)#", function (&$app) {
    Actor::delete($app->queryParams["id"]);

    header("Location: /crud_php/actors");
    exit();
});

$app->get("#^actors\/edit\/(?<id>\d+)#", function (&$app) {
    $actors = Actor::get($app->queryParams["id"]);

    if (empty($actors)) {
        render_error(404, "Actor not found");
    } else {
        $app->view = "edit_actor";
    }

    $app->props["actor"] = array_shift($actors);

    $movies = Movie::get();
    foreach ($movies as $movie) {
        unset($movie["actors"]);
        $movies[$movie["movie_id"]] = $movie;
    }

    $app->props["movies"] = $movies;
});

$app->post("#^actors\/edit\/(?<id>\d+)#", function (&$app) {
    if (empty($_POST["name"]) || empty($_POST["dob"])) {
        render_error(400, "Invalid name or date of birth");
    }

    Actor::edit($app->queryParams["id"], $_POST);
    header("Location: /crud_php/actors");
    exit();
});