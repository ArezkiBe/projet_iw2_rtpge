<?php

namespace App\Forms;

class ManageReview
{
    public function __construct()
    {
    }

    public function getConfig(): array
    {
        return [
            "config" => [
                "method" => "POST",
                "action" => "/review/action", // L'action doit pointer vers la route qui gère les actions sur les critiques
                "class" => "form",
                "id" => "update_review", // L'ID du formulaire
                "submit" => "Modifier", // Texte du bouton de soumission
                "error" => "Erreur lors de la gestion des critiques" // Message d'erreur
            ],
            "elements" => [
                "selects" => [
                    "action" => [
                        "name" => "manage_review-action",
                        "class" => "form-select",
                        "id" => "manage_review-action",
                        "label" => "action",
                        "required" => true,
                        "options" => [
                         "approve" => "Approuver",
                         "delete" => "Supprimer"
                     ],
                    ],
    
                ],
            ]
        ];
    }
}
