<?php

require "autoload.php";                 // On charge le fichier autoload

try {

    $router = new Router();             // On instancie un nouveau router

    if(isset($_GET['path']))            // Si il y un une donnée associée à la clé 'path' de l'URL
    {
        $request = "/".$_GET['path'];   // On cré une valeur $request qui prend la valeur de path de l'URL
    }
    else
    {
        $request = "/";                 // Sinon on cré une valeur $request qui prend comme valeur /
    }
    $router->checkroute($request);  // On appelle la méthode route du Router en entrant les paramètres ($routes qui viens du autoload.php et $request)
}
catch(Exception $e)
{
    if($e->getCode() === 404)
    {
        
    }
}