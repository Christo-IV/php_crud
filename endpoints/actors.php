<?php

use App\Actor;
use App\App;

$app->get("#^actors$#", function ($params) use ($app) {
    $actors = Actor::get();
    $app->render("actors", ['actors' => $actors]);
});

$app->get("#^actors\/(?<id>\d+)#", function ($params) {
    var_dump($params["id"]);

    $actor = "";
});
