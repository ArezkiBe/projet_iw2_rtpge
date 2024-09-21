<?php

namespace App\Forms;

class DbVerif {


    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "",
                "class" => "install-btn",
                "id" => "",
                "submit" => "Soumettre",
                "error" => "Base de données incorrecte"
            ],
            "elements" => [
                "inputs" => [
                    "db_host" => [
                        "type" => "text",
                        "id" => "host",
                        "label"=>"Hôte",
                        "required" => true,
                        "placeholder" => "Nom de l'hôte",
                        "class" => "",
                    ],
                    "db_name" => [
                        "type" => "text",
                        "id" => "dbname",
                        "label"=>"Nom de la base de données",
                        "required" => true,
                        "placeholder" => "Nom de la DB",
                        "class" => "",
                    ],
                    "db_userName" => [
                        "type" => "text",
                        "id" => "dbuser",
                        "label"=>"Nom d'utilisateur",
                        "required" => true,
                        "placeholder" => "Nom d'utilsateur",
                        "class" => "",
                    ],
                    "db_pwd" => [
                        "type" => "password",
                        "id" => "dbpassword",
                        "label"=>"MOT DE PASSE BDD",
                        "required" => true,
                        "placeholder" => "DB Pwd",
                        "class" => "",
                    ],             
                ],
            ],
        ];
    }

}