<?php

namespace App;

class Movie
{
    static function get($criteria = null): array
    {
        $where = DB::buildWhere($criteria, "movie_id");
        return DB::getAll("SELECT * FROM movies $where");
    }
}