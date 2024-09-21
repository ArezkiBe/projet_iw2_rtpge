<?php
namespace App\Forms;

class UpdateUser
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"update-btn",
                "id"=>"form-update-user",
                "submit"=>"Sauvegarder",
                "error"=>"Une erreur est survenue"
            ],
            "elements" => [

                "inputs"=>[
                    "username" => [
                        "type" => "text",
                        "id" => "form-update-user",
                        "label"=>"Nom d'utilisateur",
                        "required" => false,
                        "placeholder" => "Nouveau nom d'utilisateur",
                        "value" => "",
                        "class" => "",
                    ],
                    "email"=>[
                        "type"=>"email",
                        "id"=>"form-login-email",
                        "label"=>"Email",
                        "required"=>true,
                        "placeholder"=>"Votre email",
                        "value" => "",
                        "class"=>"",
                    ],
                ],
            ],
        ];
    }

}