<?php

namespace App\Forms;

class UpdateReview {

    public function __construct(){

    }


    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/review/manage", // L'action doit pointer vers la route qui gère la création d'une critique
                "class" => "form",
                "id" => "update_review", // L'ID du formulaire
                "submit" => "Modifier", // Texte du bouton de soumission
                "error" => "Erreur lors de l'ajout de la critique" // Message d'erreur
            ],
            "elements" => [
                "inputs" => [
                    "content" => [ // Champ pour le contenu de la critique
                        "type" => "text", // Utilisation d'un text pour le contenu
                        "id" => "update_review-content",
                        "label"=>"Nouvelle critique",
                        "required" => true,
                        "placeholder" => "Votre critique",
                        "class" => "form-input",
                    ],
                ],
            ]
        ];
    }
}
