<?php
namespace App\Forms;
class Login
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"login-btn",
                "id"=>"form-login",
                "submit"=>"Se connecter",
                "error"=>"Identifiants incorrects"
            ],
            "elements" => [

                "inputs"=>[
                    "email"=>[
                        "type"=>"email",
                        "id"=>"form-login-email",
                        "label"=>"Email",
                        "required"=>true,
                        "placeholder"=>"Votre email",
                        "class"=>"email",
                    ],
                    "pwd"=>[
                        "type"=>"password",
                        "id"=>"form-login-pwd",
                        "label"=>"Mot de passe",
                        "required"=>true,
                        "placeholder"=>"Votre mot de passe",
                        "class"=>"password",
                    ]
                ],
            ],

        ];
    }

}