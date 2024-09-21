<?php

namespace App;

echo ('<link rel="stylesheet" type="text/css" href="./dist/css/style.css" />');
echo ('    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">');

session_start();
if (file_exists("./Constantes.php")) {
    require_once("./Constantes.php");
} else {
    $optionsJson = file_get_contents('./options.json');
    $optionsArray = json_decode($optionsJson, true);

    if ($optionsArray["is_installed"] == true) {
        $optionsArray["is_installed"] = false;
        $updatedJsonData = json_encode($optionsArray, JSON_PRETTY_PRINT);
        file_put_contents('./options.json', $updatedJsonData);
    }
}


spl_autoload_register("App\myAutoloader");
function myAutoloader($class)
{
    //$class = App\Core\View
    $file = str_replace("App\\", "./", $class);
    $file = str_replace("\\", "/", $file);
    $file .= ".php";
    if (file_exists($file)) {
        include $file;
    }
}



$uri = strtolower($_SERVER["REQUEST_URI"]);
$uri = strtok($uri, "?");
if (strlen($uri) > 1) $uri = rtrim($uri, "/");

if ($uri == "/install") {
} else {
    include "./Includes/Functions.php";
    $controller = "App\\Includes\\Functions";
    $object = new $controller();
    $object->is_framework_installed();
}

//Récupérer le contenu du fichier routes.yaml
$fileRoute = "./Routes.yml";
if (file_exists($fileRoute)) {
    $listOfRoutes = yaml_parse_file($fileRoute);
} else {
    die("Le fichier de routing n'existe pas");
}

//Comparer son URI avec ce que l'on a dans le fichier routes et voir s'il y a une correspondance
//S'il y a une correspandance on doit récupérer le controller et l'action
//On fait toutes les vérifications nécessaires et on fait
//une instance du controller et l'appel de l'action

if (!empty($listOfRoutes[$uri])) {
    if (!empty($listOfRoutes[$uri]["Controller"])) {
        if (!empty($listOfRoutes[$uri]["Action"])) {

            $controller = $listOfRoutes[$uri]["Controller"];
            $action = $listOfRoutes[$uri]["Action"];

            if (file_exists("./Controllers/" . $controller . ".php")) {
                include "./Controllers/" . $controller . ".php";
                $controller = "App\\Controllers\\" . $controller;
                if (class_exists($controller)) {
                    $object = new $controller();
                    if (method_exists($object, $action)) {
                        $object->$action();
                    } else {
                        die("L'action' " . $action . " n'existe pas");
                    }
                } else {
                    die("Le class controller " . $controller . " n'existe pas");
                }
            } else {
                die("Le fichier controller " . $controller . " n'existe pas");
            }
        } else {
            die("La route " . $uri . " ne possède pas d'action dans le ficher " . $fileRoute);
        }
    } else {
        die("La route " . $uri . " ne possède pas de controller dans le ficher " . $fileRoute);
    }
} else {
    //S'il n'y a pas de correspondance => page 404
    //var_dump($uri);
    include "./Controllers/Error.php";
    $object = new Controllers\Error();
    $object->page404();
}
