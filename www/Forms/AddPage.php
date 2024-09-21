<?php
namespace App\Forms;
class AddPage
{

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config"=>[
                "method"=>"POST",
                "action"=>"",
                "class"=>"addPage-btn",
                "id"=>"form-login",
                "submit"=>"Ajouter",
                "error"=>"Une erreur s'est produite"
            ],
            "elements" => [
                "inputs"=>[
                    "title"=>[
                        "type"=>"text",
                        "id"=>"form-addPage-title",
                        "label"=>"Email",
                        "required"=>true,
                        "placeholder"=>"Titre de la page",
                        "class"=>"email",
                    ],
                ],
                "dropdowns" => [
                    "type" => [
                        "id" => "form-addPage-type",
                        "label"=>"Type",
                        "required" => true,
                        "values" => ["Menu", "Entrée" , "Plat", "Dessert"],
                        "class" => "",
                    ],        
                ]
            ],

        ];
    }

}