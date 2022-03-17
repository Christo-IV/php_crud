<?php

use App\App;

require_once "config.php";
require "database.php";
require "vendor/autoload.php";

$app = new App($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"], $_SERVER["SCRIPT_NAME"]);

$app->processEndpoints("endpoints/");
