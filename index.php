<?php

use App\App;

require "config.php";
require "functions.php";
require "vendor/autoload.php";

$app = new App($_SERVER["REQUEST_METHOD"], $_SERVER["REQUEST_URI"], $_SERVER["SCRIPT_NAME"]);

$app->processEndpoints("controllers/");
