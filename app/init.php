<?php

include('config/config.php');


// including the classes
include 'database/connection.php';
include 'classes/Object.php';
include 'classes/User.php';

//include the function
include 'functions.php';



// makeing global objects
global $pdo;
session_start();
$obj = new Objects($pdo);
$Ouser = new User($pdo);









?>
