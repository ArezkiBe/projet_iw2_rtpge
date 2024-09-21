<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Forms\Login;
use App\Forms\Register;
use App\Models\User;

class Security
{

    public function login(): void
    {
        $form = new Login();
        $configForm = $form->getConfig();
        $errors = [];

        if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
            $verificator = new Verificator();
            //Est-ce que les données sont OK
            if($verificator->checkForm($configForm, $_REQUEST, $errors))
            {
                $user = new User;
                $user_data = $user->getOneBy(["email" => $_REQUEST["email"]]);

                if (!$user_data == 0 && !$user_data['is_deleted']) 
                {
                    
                    if (password_verify($_REQUEST["pwd"],$user_data["password"])) 
                    {
                        $_SESSION["auth_user"]["email"] = $user_data["email"];
                        $_SESSION["auth_user"]["login"] = $user_data["login"];
                        $_SESSION["auth_user"]["role"] = $user_data["role"];
                        header('Location: /');
                    } else {
                        $errors[] = "Identifiants inccorects";
                    }
                }else {
                    $errors[] = "Identifiants inccorects";
                }
  
            }
        }

        $view = new View("Security/login", "neutral");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }


    public function logout(): void
    {
        session_destroy();
        header('Location: /login');
    }


    public function register(): void
    {
        if (!isset($_SESSION['auth_user'])) {
            header('Location: /login');
            exit;
        }
        $userRoleId = $_SESSION['auth_user']['role'];
        if ($userRoleId !== 1 && $userRoleId !== 2) {
            header('Location: /login');
            exit;
        }

        $form = new Register();
        $configForm = $form->getConfig();

        $errors = [];

        $roleMapping = [
            'Administrateur' => 2,
            'Modérateur' => 3,
            'Editeur' => 4,
        ];

        if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){

            $role = $_POST['role'];
            $roleValue = $roleMapping[$role];
            $verificator = new Verificator();
            if($verificator->checkForm($configForm, $_REQUEST, $errors))
            {
                $user = new User();
                $exists = $verificator->doesEmailExists($_REQUEST['email']);
                if (!$exists) {
                    $user->setLogin($_REQUEST['username']);
                    $user->setEmail($_REQUEST['email']);
                    $user->setPwd($_REQUEST['pwd']);
                    $user->setRole($roleValue);
                    $user->save();
                    header('Location: /register');
                }else{
                    $errors[]= "cet email est déjà utilisé";
                }
                
            }
        }

        $view = new View("Security/register", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }



}
