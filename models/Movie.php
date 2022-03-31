<?php

namespace App;

class Movie
{
    static function get($criteria = null): array
    {
        $result = [];
        $where = DB::buildWhere($criteria, "movie_id");
        $rows = DB::getAll("SELECT * FROM movies LEFT JOIN actors_in_movies USING (movie_id) LEFT JOIN actors USING (actor_id) $where");

        foreach ($rows as $row) {
            $result[$row["movie_id"]]["movie_id"] = $row["movie_id"];
            $result[$row["movie_id"]]["movie_name"] = $row["movie_name"];
            $result[$row["movie_id"]]["movie_release_date"] = $row["movie_release_date"];
            $result[$row["movie_id"]]["actors"][] = [
                "actor_id" => $row["actor_id"],
                "actor_name" => $row["actor_name"],
                "actor_dob" => $row["actor_dob"]
            ];
        }

        return $result;
    }

    static function create($name, $release_date): int|string
    {
        return DB::insert("movies", ["movie_name" => $name, "movie_release_date" => $release_date]);
    }

    static function delete($id)
    {
        DB::query("DELETE FROM movies WHERE movie_id='$id';");
        DB::query("DELETE FROM actors_in_movies WHERE movie_id='$id';");
    }

    static function edit($id, $values)
    {
        DB::query("UPDATE movies SET movie_name = '" . $values["name"] . "', movie_release_date = '" . $values["release_date"] . "' WHERE movie_id = '$id'");

        // Delete all pre-existing rows with given movie and insert new ones.
        DB::query("DELETE FROM actors_in_movies WHERE movie_id = '$id'");
        if (isset($values["credits"])) {
            foreach ($values["credits"] as $credit) {
                DB::query("INSERT INTO actors_in_movies (actor_id, movie_id) VALUES ($credit, $id)");
            }
        }
    }
}