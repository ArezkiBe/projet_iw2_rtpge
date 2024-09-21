<?php

namespace App\Forms;

class Comment
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
                "class" => "formComment",
                "id" => "form-comment",
                "submit" => "Envoyer",
                "error" => "Erreur lors de l'envoi du message"
            ],
            "inputs" => [
                "message" => [
                    "type" => "text",
                    "id" => "form-comment-message",
                    "label" => "Message",
                    "required" => true,
                    "placeholder" => "Votre message",
                    "class" => "form-input",
                ],
            ]
        ];
    }
}