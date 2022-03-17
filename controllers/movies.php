<?php

use App\Movie;

$app->get("#^movies$#", function ($app) {
    $app->props["movies"] = Movie::get();
    $app->view = "movies";
});
