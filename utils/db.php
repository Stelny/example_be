<?php

    define("dbserver", "db-mysql-fra1-07589-do-user-9512241-0.b.db.ondigitalocean.com:25060");
    define("dbuser", "doadmin");
    define("dbpass", "gfuv8zp0ejazbazu");
    define("dbname", "defaultdb");

    global $db;

    $db = new PDO("mysql:host=" .dbserver. ";dbname=" .dbname,dbuser,dbpass,
            array(
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET CHARACTER SET utf8"
            )
    );