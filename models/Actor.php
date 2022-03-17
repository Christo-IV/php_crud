<?php

namespace App;

class Actor
{
    static function get($criteria = null): array
    {
        $result = [];
        $where = DB::buildWhere($criteria, "actor_id");
        $rows = DB::getAll("SELECT * FROM actors LEFT JOIN actors_in_movies USING (actor_id) LEFT JOIN movies USING (movie_id) $where");
        foreach ($rows as $row) {
            $result[$row["actor_id"]]["actor_id"] = $row["actor_id"];
            $result[$row["actor_id"]]["actor_name"] = $row["actor_name"];
            $result[$row["actor_id"]]["actor_dob"] = $row["actor_dob"];
            $result[$row["actor_id"]]["movies"][] = [
                "movie_id" => $row["movie_id"],
                "movie_name" => $row["movie_name"],
                "movie_release_date" => $row["movie_release_date"]
            ];
        }

        return $result;
    }
}