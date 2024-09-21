<?php
namespace App\Controllers;

class Error {
    public function page404(): void
    {
        http_response_code(404);
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Page non trouvée</title>
            <style>
                body {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0;
                    font-family: Arial, sans-serif;
                }
                .error-message {
                    text-align: center;
                    font-size: 24px;
                    color: #FF0000;
                }
            </style>
        </head>
        <body>
            <div class="error-message">
                <p>Oops! Erreur 404</p>
            </div>
        </body>
        </html>
        <?php
        exit; // Arrête l'exécution du script après avoir affiché la page 404
    }
}


