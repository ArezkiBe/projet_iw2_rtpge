<?php

namespace App\Forms;

class AddReview {

    public function __construct(){

    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/addreview",
                "class" => "newReview-btn",
                "id" => "add_review",
                "submit" => "Ajouter",
                "error" => "Erreur lors de l'ajout du commentaire"
            ],
            "elements" => [
                "inputs" => [
                    "userName" => [
                        "type" => "text",
                        "id" => "add_review-content",
                        "label"=>"Votre nom",
                        "required" => false,
                        "placeholder" => "Nom",
                        "class" => "",
                    ],
                    "content" => [
                        "type" => "text",
                        "id" => "add_review-content",
                        "label"=>"Commentaire",
                        "required" => true,
                        "placeholder" => "Votre critique",
                        "class" => "",
                    ],
                ],
            ]
        ];
    }
}
