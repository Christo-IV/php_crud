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

    static function create($name, $dob): int|string
    {
        return DB::insert("actors", ["actor_name" => $name, "actor_dob" => $dob]);
    }

    static function delete($id)
    {
        DB::query("DELETE FROM actors WHERE actor_id='$id';");
        DB::query("DELETE FROM actors_in_movies WHERE actor_id='$id';");
    }

    static function edit($id, $values)
    {
        DB::query("UPDATE actors SET actor_name = '" . $values["name"] . "', actor_dob = '" . $values["dob"] . "' WHERE actor_id = '$id'");

        // Delete all pre-existing rows with given actor and insert new ones.
        DB::query("DELETE FROM actors_in_movies WHERE actor_id = '$id'");
        if (isset($values["credits"])) {
            foreach ($values["credits"] as $credit) {
                DB::query("INSERT INTO actors_in_movies (actor_id, movie_id) VALUES ($id, $credit)");
            }
        }
    }
}