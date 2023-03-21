<?php
session_start();
// var_dump($_SESSION);

require "autoload.php";

try {
    $router = new Router();
    
    if(isset($_GET['path']))
    {
        $request = $_GET['path'];
    }
    else
    {
        $request = "";
    }
    $router->checkroute($request);
    
}

catch(Exception $e)
{
    if($e->getCode() === 404)
    {

    }
}