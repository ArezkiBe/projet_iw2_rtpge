<?php

namespace App\Controllers;


use App\Core\View;
use App\Core\Verificator;
use App\Forms\DbVerif;
use App\Forms\AddUser;
use App\Includes\Functions;
use App\Models\User;

class Install{

    public function install(): void
    {
        $optionsJson = file_get_contents('./options.json');
        $optionsArray = json_decode($optionsJson, true);
        
        if ($optionsArray["is_installed"] == true) {
            echo "already installed";
        }elseif (isset($_GET["step"])) {

            if ($_GET["step"] == "1") {
                if (file_exists("./Constantes.php")) {
                    header('Location: /install?step=2');
                }
                $form = new DbVerif();
                $configForm = $form->getConfig();

                $errors = [];

                if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
                    $verificator = new Verificator();

                    $allRequestElements = $_REQUEST;
                    foreach ($_GET as $key => $value) {
                        unset($allRequestElements[$key]);
                    }
                    if($verificator->checkForm($configForm, $allRequestElements, $errors))
                    {
                        $result = $verificator -> is_db_valid($_REQUEST['db_host'],$_REQUEST['db_name'],$_REQUEST['db_userName'],$_REQUEST['db_pwd']);

                        if ($result == false) {
                            $errors[]="Erreur lors de la connexion à la base de données";
                        }else {
                            header('Location: /install?step=2');
                        }
                    }
                }

                $view = new View("Install/db", "neutral");
                $view->assign("form", $configForm);
                $view->assign("formErrors", $errors);


            }elseif ($_GET["step"] == "2") {
                if (!file_exists("./Constantes.php")) {
                    header('Location: /install?step=1');
                }
                $form = new AddUser();
                $configForm = $form->getConfig();

                $errors = [];



                if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
                    $verificator = new Verificator();
                    
                    $allRequestElements = $_REQUEST;
                    foreach ($_GET as $key => $value) {
                        unset($allRequestElements[$key]);
                    }
                    if($verificator->checkForm($configForm, $allRequestElements, $errors))
                    {
                        $add_user = new Functions();
                        $result = $add_user -> add_first_user($_REQUEST['username'], $_REQUEST['pwd'], $_REQUEST['email']);

                        if ($result == false) {
                            $errors[]="Identifiants invalides";
                        }else {
                            header('Location: /login');
                        }
                    }
                }

                $view = new View("Install/add_user", "neutral");
                $view->assign("form", $configForm);
                $view->assign("formErrors", $errors);


            }else {
                header('Location: /install?step=1');


            }
        }else {
            header('Location: /install?step=1');
        }
    }
}