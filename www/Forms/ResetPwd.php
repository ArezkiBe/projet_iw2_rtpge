<?php
namespace App\Forms;

class ResetPwd
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"reset-btn",
                "id"=>"form-login",
                "submit"=>"Reinitialiser ",
                "error"=>"Mot de passe incorrect"
            ],
            "elements" => [

                "inputs"=>[
                    "pwd" => [
                        "type" => "password",
                        "id" => "form-resetPwd-pwd",
                        "label"=>"MOT DE PASSE",
                        "required" => true,
                        "placeholder" => "Votre mot de passe",
                        "class" => "",
                    ],
                    "pwd_val" => [
                        "type" => "password",
                        "id" => "form-resetPwd-pwd-val",
                        "label"=>"CONFIRMATION DU MOT DE PASSE",
                        "required" => true,
                        "placeholder" => "Confirmer votre mot de passe",
                        "class" => "",
                    ],
                ]
            ],
        ];
    }

}