<?php

/**
  * Configuration for database connection
  *
  */

$host       = "localhost";
$username   = "id13143678_root";
$password   = "compsci3380@UH";
$dbname     = "id13143678_team15"; // will use later
$dsn        = "mysql:host=$host;dbname=$dbname"; // will use later
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );