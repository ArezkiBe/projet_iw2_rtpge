<?php

namespace App\Controllers;


use App\Core\View;
use App\Core\Verificator;
use App\Core\EmailSender;
use App\Forms\DbVerif;
use App\Forms\ForgotPwd;
use App\Forms\ResetPwd;
use App\Includes\Functions;
use App\Models\User;
use App\Models\PasswordReset;

class PwdRecovery{

    public function forgotPwd(): void
    {
        $form = new ForgotPwd();
        $configForm = $form->getConfig();

        $errors = [];

        if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
            $verificator = new Verificator();
            //Est-ce que les données sont OK
            if($verificator->checkForm($configForm, $_REQUEST, $errors))
            {
                $result = $verificator -> doesEmailExists($_REQUEST['email']);
                
                if (!$result) {
                    $errors[]="L'email n'existe pas";
                }else {
                    $email = $_REQUEST['email'];
                    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
                    $expDate = date("Y-m-d H:i:s",$expFormat);
                    $key = bin2hex(random_bytes(20));

                    $reset = new PasswordReset();
                    $reset->setEmail($email);
                    $reset->setKey($key);
                    $reset->setExpDate($expDate);
                    $reset->save();

                    $output='<p>Cher utilisateur,</p>';
                    $output.='<p>Veuillez cliquer sur ce lien  afin de réinitialiser votre mot de passe</p>';
                    $output.='<p>-------------------------------------------------------------</p>';
                    $output.='<p><a href="http://localhost/resetPwd?key='.$key.'&email='.$email.'&action=reset" target="_blank">
                    http://localhost/resetPwd?key='.$key.'&email='.$email.'&action=reset</a></p>';		
                    $output.='<p>-------------------------------------------------------------</p>';
                    $output.='<p>Attention ! Ce lien n\'est valide que pour 24h.</p>';
                    $output.='<p>Si vous n\'êtes pas à l\'origine de cette demande de réinitialisation,
                    merci de ne pas prendre en compte cet email.</p>';   	
                    $output.='<p>Cordialement</p>';
                    $output.='<p>ProjetIW2</p>';
                    $body = $output; 
                    $subject = "Reinitialisation de mot de passe";

                    $mail = new EmailSender();
                    $mail->send_email($email, "john", $subject, $body);




                }
            }
        }

        $view = new View("User/forgotPwd", "neutral");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }

    public function resetPwd(): void
    {

        if (isset($_GET["key"]) && isset($_GET["email"])) {
            $email = $_GET['email'];
            $key = $_GET['key'];
            $verificator = new Verificator();
            $result = $verificator->doesEmailExists($_GET['email']);

            if (!$result) {
                die("l'url n'est pas valide");
            }

            $check = $verificator->doesKeyMatches($key, $email);

            if ($check != false) {
                $form = new ResetPwd();
                $configForm = $form->getConfig();

                $errors = [];

                if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
                    $verificator = new Verificator();
                    //Est-ce que les données sont OK

                    $allRequestElements = $_REQUEST;
                    foreach ($_GET as $key => $value) {
                        unset($allRequestElements[$key]);
                    }
                    if($verificator->checkForm($configForm, $allRequestElements, $errors))
                    {
                        $user = new User();
                        $timestamp = date('Y-m-d H:i:s');
                        $user->setId($check["id"]);
                        $user->setPwd($_REQUEST['pwd']);
                        $user->setUpdated($timestamp);
                        $user->save();

                        header('Location: /admin');
                    }
                }

                $view = new View("User/resetPwd", "neutral");
                $view->assign("form", $configForm);
                $view->assign("formErrors", $errors);
            }

        }else{
            header("Location: /");
        }
        
    }
}