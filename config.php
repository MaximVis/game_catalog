<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'game_catalog_2');
define('DB_USER', 'postgres');
define('DB_PASS', '12345678');

function get_db_connection() {
    $connection_string = sprintf(
        "host=%s dbname=%s user=%s password=%s",
        DB_HOST, DB_NAME, DB_USER, DB_PASS
    );
    
    $dbconn = pg_connect($connection_string);
    
    if (!$dbconn) {
        return false;
    }
    
    return $dbconn;
}