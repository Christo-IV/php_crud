<?php

use App\Movie;
use App\App;

$app->get("#^movies$#", function ($params) use ($app) {
    $movies = Movie::get();
    $app->render("movies", ['movies' => $movies]);
});

$app->get("#^movies\/(?<id>\d+)#", function ($params) {
    var_dump($params["id"]);

    $movie = "";
});
