<?php

$localhost = "localhost";
$user = "root";
$pass = "";
$db = "schoolManagementSystem";

$db = new mysqli($localhost, $user, $pass, $db);
if (!$db) {
    echo "Connection to DB failed";
}