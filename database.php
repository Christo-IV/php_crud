<?php
connect_db();

function connect_db() {
    global $db;

    //ühendus andmebaasiga
    $db = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

    //ühenduse kontroll
    if (!$db) {
        die("Failed to connect with MySQL: " . mysqli_connect_error());
    }
}

function get_all($sql) {
    global $db;

    $result = [];
    $q = mysqli_query($db, $sql) or db_error_out($sql);
    while (($result[] = mysqli_fetch_assoc($q)) || array_pop($result)) { ; }

    return $result;
}

function db_error_out ($sql) {
    global $db;

    var_dump(mysqli_error($db));
    var_dump($sql);
}