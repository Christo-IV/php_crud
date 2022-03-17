<?php

namespace App;

class Movie
{
    static function get() {
        return get_all("SELECT * FROM movies");
    }
}