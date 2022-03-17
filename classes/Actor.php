<?php

namespace App;

class Actor
{
    static function get() {
        return get_all("SELECT * FROM actors");
    }
}