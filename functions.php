<?php

function render_error ($code, $message) {
    http_response_code($code);
    $view = "error";
    $controller = "";
    include("views/templates/master_template.php");
    exit();
}