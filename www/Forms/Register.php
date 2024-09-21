<?php

namespace App\Forms;

class Register
{

    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "register-btn",
                "id" => "form-register",
                "submit" => "S'inscrire",
                "error" => "Identifiants incorrects"
            ],
            "elements" => [

                "inputs" => [
                    "username" => [
                        "type" => "text",
                        "id" => "form-register-login",
                        "label"=>"Nom d'utilisateur",
                        "required" => true,
                        "placeholder" => "Nom d'utilisateur",
                        "class" => "",
                    ],
                    "email" => [
                        "type" => "email",
                        "id" => "form-register-email",
                        "label"=>"Email",
                        "required" => true,
                        "placeholder" => "Email",
                        "class" => "",
                    ],
                    "pwd" => [
                        "type" => "password",
                        "id" => "form-register-pwd",
                        "label"=>"Mot de passe",
                        "required" => true,
                        "placeholder" => "Mot de passe",
                        "class" => "",
                    ],
                    "pwd_val" => [
                        "type" => "password",
                        "id" => "form-register-pwd-val",
                        "label"=>"Confirmer mot de passe",
                        "required" => true,
                        "placeholder" => "Confirmer votre mot de passe",
                        "class" => "",
                    ],                    
                ],

                "dropdowns" => [
                    "role" => [
                        "id" => "form-register-role",
                        "label"=>"Role",
                        "required" => true,
                        "values" => ["Administrateur", "Modérateur" , "Editeur"],
                        "class" => "",
                    ],        
                ]
            ],
        ];
    }
}
