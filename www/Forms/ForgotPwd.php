<?php
namespace App\Forms;
class ForgotPwd
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"forgot-btn",
                "id"=>"",
                "submit"=>"Envoyer un e-mail",
                "error"=>"Email incorrect"
            ],
            "elements" => [
                "inputs"=>[
                    "email"=>[
                        "type"=>"email",
                        "id"=>"form-forgotPwd-email",
                        "label"=>"Email",
                        "required"=>true,
                        "placeholder"=>"Votre email",
                        "class"=>"",
                    ],
                ]
            ],
        ];
    }

}