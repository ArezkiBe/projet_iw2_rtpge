<?php

namespace App\Forms;

class AddUser {


    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "addFirst-btn",
                "id" => "",
                "submit" => "Ajouter",
                "error" => "Identifiants incorrects"
            ],
            "elements" => [
                "inputs" => [
                    "username" => [
                        "type" => "text",
                        "id" => "first-user-username",
                        "label"=>"Nom d'utilisateur",
                        "required" => true,
                        "placeholder" => "Votre nom d'utilisateur",
                        "class" => "",
                    ],
                    "email" => [
                        "type" => "email",
                        "id" => "first-user-email",
                        "label"=>"Email",
                        "required" => true,
                        "placeholder" => "Votre email",
                        "class" => "",
                    ],
                    "pwd" => [
                        "type" => "password",
                        "id" => "add_user-pwd",
                        "label"=>"Mot de passe",
                        "required" => true,
                        "placeholder" => "Votre mot de passe",
                        "class" => "",
                    ],
                    "pwd_val" => [
                        "type" => "password",
                        "id" => "add_user-pwd-val",
                        "label"=>"Confirmation du mot de passe",
                        "required" => true,
                        "placeholder" => "Confirmation du MDP",
                        "class" => "",
                    ],           
                ],
                
            ]
            
        ];
    }

}