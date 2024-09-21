<?php


namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Forms\UpdateUser;
use App\Models\User;
use App\Core\DB;



class UserController
{

    public function delete(): void
    {
        echo 'hi';
    }
    public function show(): void
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


        $users = new User();
        $users = $users->getAllBy(['is_deleted' => 0]);
        $users = array_filter($users, function ($user) {
            return in_array($user['role'], [2, 3, 4]);
        });

        if ($userRoleId == 1) {
            $users = array_filter($users, function ($user) {
                return in_array($user['role'], [2, 3, 4]);
            });
        } else {
            $users = array_filter($users, function ($user) {
                return in_array($user['role'], [3, 4]);
            });
        }

        $roleMapping = [
            'Administrateur' => 2,
            'Modérateur' => 3,
            'Editeur' => 4,
        ];

        if (isset($_REQUEST['action'])) {
            $user = new User();
            if ($_REQUEST['action'] == 'edit') {
                $user->setId($_REQUEST['id']);
                $user->setRole($_POST['role']);
                $user->save();
                header('Location: /user-list');
            } elseif ($_REQUEST['action'] == 'delete') {
                $user->setId($_REQUEST['id']);
                $user->setIsDeleted(1);
                $user->save();
                header('Location: /user-list');
            } else {
                $errors[] = "Action non valide.";
                // Rediriger vers la page appropriée après avoir effectué l'action
                header('Location: /user-list-list');
                exit;
            }
        }

        $view = new View("User/list", "back");
        $view->assign("users", $users);
    }

    public function edit(): void
    {
        if (isset($_SESSION["auth_user"]["email"])) {
            $form = new UpdateUser();
            $configForm = $form->getConfig();

            $configForm['elements']['inputs']['username']['value'] =  $_SESSION["auth_user"]["login"];
            $configForm['elements']['inputs']['email']['value'] =  $_SESSION["auth_user"]["email"];

            $errors = [];

            if ($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]) {
                $verificator = new Verificator();
                if ($verificator->checkForm($configForm, $_REQUEST, $errors)) {
                    $login = $_REQUEST['username'];
                    $email = $_REQUEST['email'];

                    if ($login !== '') {
                        if ($login === "CONFIRMER") {

                            $db = new DB();
                            $sql = "DELETE FROM " . PREFIX . "_user WHERE email = :email";
                            $email = $_SESSION["auth_user"]["email"];

                            $db->select($sql, ["email" => $email]);


                            session_destroy();
                            header('Location: /');
                        } else {
                            $errors[] = "Vous devez bien taper 'CONFIRMER' afin de valider la suppression";
                        }
                    }

                    if ($login !== '' && $login !== $_SESSION["auth_user"]["login"]) {
                        $user = new User();
                        $user_data = $user->getOneBy(["email" => $_SESSION["auth_user"]["email"]]);
                        $user->setId($user_data["id"]);
                        $timestamp = date('Y-m-d H:i:s');
                        $user->setLogin($_REQUEST["username"]);
                        $user->setUpdated($timestamp);
                        $user->save();

                        $_SESSION["auth_user"]["login"] = $login;
                    }

                    if ($email !== '' && $email !== $_SESSION["auth_user"]["email"]) {
                        $user = new User();
                        $user_data = $user->getOneBy(["email" => $_SESSION["auth_user"]["email"]]);
                        $user->setId($user_data["id"]);
                        $timestamp = date('Y-m-d H:i:s');
                        $user->setEmail($_REQUEST["email"]);
                        $user->setUpdated($timestamp);
                        $user->save();

                        $_SESSION["auth_user"]["email"] = $email;
                    }

                    header('Location: /admin');
                }
            }

            $view = new View("User/update", "neutral");
            $view->assign("form", $configForm);
            $view->assign("formErrors", $errors);
        } else {
            header('Location: /connection-error');
        }
    }

    public function list(): void {}
}
