<?php

namespace App;

class DB
{
    /**
     * @var false|\mysqli|void|null
     */
    private static $connection;

    static function connect()
    {
        $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if (!$connection) {
            die("Failed to connect with MySQL: " . mysqli_connect_error());
        }

        DB::$connection = $connection;
    }

    static function getAll($sql): array
    {
        $result = [];
        try {
            $q = mysqli_query(DB::$connection, $sql);
            while (($result[] = mysqli_fetch_assoc($q)) || array_pop($result)) {
                ;
            }
        } catch (\Exception $e) {
            DB::errorOut($sql);
        }
        return $result;
    }

    static function query($sql)
    {
        try {
            mysqli_query(DB::$connection, $sql);
        } catch (\Exception $e) {
            DB::errorOut($sql);
        }
    }

    static function errorOut($sql)
    {
        $error = mysqli_error(DB::$connection);
        render_error(404, "Database error:<br>$sql<br>$error");
    }

    static function escape(array $data): array
    {
        $values = array();
        $IN_regex = '/^\s*IN\s*\(/i'; // IN(foo, bar)

        if (!empty($data)) {

            // Loop over all members of $data
            foreach ($data as $field => $value) {

                // Escape field names containing database name
                $field = str_replace('.', '`.`', $field);

                // Skip escaping if field is numeric (user must escape)
                if (is_numeric($field)) {
                    $values[] = $value;
                } // If value is supposed to be NULL
                elseif ($value === NULL) {
                    $values[] = "`$field`=NULL";

                    // If value is array and has a member called no_escape then skip this member
                } elseif (is_array($value) && isset($value['no_escape'])) {
                    $values[] = "`$field`=" . addslashes($value['no_escape']);

                    // If value begins with IN(, do not escape
                } elseif (preg_match($IN_regex, $value)) {
                    $values[] = "`$field` " . $value;

                    // All other cases
                } else {
                    $values[] = "`$field`='" . addslashes($value) . "'";
                }
            }
        }
        return $values;
    }

    public static function buildWhere($criteria, $id_field = null): string
    {
        $where = '';
        if (!empty($criteria)) {
            if (is_array($criteria)) {
                $where = "WHERE " . implode(' AND ', escape($criteria));
            } else if (is_numeric($criteria)) {
                $where = "WHERE $id_field = $criteria";
            } else {
                $where = "WHERE $criteria";
            }
        }

        return $where;
    }

    public static function insert(string $table, array $data)
    {
        $columns = implode(",", array_keys($data));

        // Escape values
        $values = array_map(function($value) {
            return addslashes($value);
        }, array_values($data));

        $values = "'".implode("','", array_values($data))."'";

        DB::query("INSERT INTO $table ($columns) VALUES ($values)");
        return mysqli_insert_id(DB::$connection);
    }
}
