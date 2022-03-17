<?php

use App\Actor;

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
