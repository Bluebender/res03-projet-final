<?php
session_start();
var_dump($_SESSION);
// var_dump($_GET);
// var_dump($_POST);

require "autoload.php";

$router = new Router();
$router->checkroute();
