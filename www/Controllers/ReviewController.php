<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Models\Review;
use App\Models\User;
use App\Forms\AddReview;
use App\Forms\UpdateReview;
use App\Forms\ManageReview;

class ReviewController
{
    public function show(): void
    {
        $reviews = new Review();
        $reviews = $reviews->getAll();
        $view = new View("Review/allReviews", "back");
        $view->assign("reviews", $reviews);

        if (isset($_REQUEST['action'])) {
            $review = new Review();
            if ($_REQUEST['action'] == 'delete') {
                $review->deleteBy(["id" => $_REQUEST['id']]);
                header('Location: /reviews');
            } else {
                $errors[] = "Action non valide.";
                header('Location: /reviews');
                exit;
            }
        }
    }

    public function createReview(): void
    {
        $form = new AddReview();
        $configForm = $form->getConfig();
        $errors = [];


        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["auth_user"]) && !empty($_SESSION["auth_user"]["email"])) {
            // Récupérer l'utilisateur par son email depuis la session
            $user = new User();
            $user_data = $user->getOneBy(["email" => $_SESSION["auth_user"]["email"]]);

            // Vérifier si l'utilisateur existe
            if ($_SESSION["auth_user"]["email"]) {

                if ($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]) {
                    $verificator = new Verificator();
                    //Est-ce que les données sont OK
                    if ($verificator->checkForm($configForm, $_REQUEST, $errors)) {

                        // Créer une nouvelle instance de Review
                        $review = new Review();
                        //var_dump($user_data);
                        // Définir l'ID de l'utilisateur pour la review
                        $review->setUserName($_REQUEST["userName"] ? $_REQUEST["userName"] : "anonyme");

                        // Définir le contenu de la review
                        $review->setContent($_REQUEST["content"]);

                        $review->setApproved(0);

                        // Enregistrer la review en base de données
                        $review->save();

                        // Rediriger vers la page des reviews
                        header('Location:/review-list');
                    }
                }
            } else {
                // Définir un message d'erreur
                $error = "Vous devez être connecté pour poster une critique.";

                // Afficher la vue avec le message d'erreur
                $this->showAddReviewForm($error);
            }
        } else {
            // Rediriger vers la page de connexion
            header('Location:/login');
        }
        $view = new View("Review/addreview", "neutral");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);

        self::showApprovedReview();
    }

    public function showApprovedReview(): void
    {
        $review = new Review();
        $review = $review->getAllBy(['approved' => 1]);
        $view = new View("Review/approve", "neutral");
        $view->assign("review", $review);
    }


    public function manageReview(): void
    {
        $form = new ManageReview();
        $configForm = $form->getConfig();
        $errors = []; // Initialisation de la variable $errors
        $Allreview = new Review();
        $Allreview = $Allreview->getAllBy(['approved' => 0]);
        //var_dump($Allreview);

        // Vérifier si l'utilisateur est connecté
        if (isset($_SESSION["auth_user"]) && !empty($_SESSION["auth_user"]["email"])) {
            // Récupérer l'utilisateur par son email depuis la session
            $user = new User();
            $user_data = $user->getOneBy(["email" => $_SESSION["auth_user"]["email"]]);

            // Vérifier si l'utilisateur existe
            if ($user_data) {
                // Vérifier si la requête est de type POST

                // Vérifier si les données du formulaire sont valides
                $verificator = new Verificator();
                //if ($verificator->checkForm($configForm, $_REQUEST, $errors, 1)) {
                // Récupérer l'action sélectionnée


                // Récupérer l'ID de la critique à gérer


                // Créer une instance de la critique
                $review = new Review();

                if (isset($_REQUEST['action'])) {
                    if ($_REQUEST['action'] == 'approve') {
                        $review->setId($_REQUEST['id']);
                        $review->setApproved(1);
                        $review->save();
                        header('Location: /review-manager');
                    } elseif ($_REQUEST['action'] == 'delete') {
                        $review->deleteBy(["id" => $_REQUEST['id']]);
                        header('Location: /review-manager');
                    } else {
                        $errors[] = "Action non valide.";
                        // Rediriger vers la page appropriée après avoir effectué l'action
                        header('Location: /review-list');
                        exit;
                    }
                }
                //}

            } else {
                // L'utilisateur n'est pas trouvé dans la base de données
                // Vous pouvez rediriger vers une page d'erreur ou afficher un message d'erreur approprié
                // header('Location: /error-page');
                // exit;
            }
        } else {
            // L'utilisateur n'est pas connecté
            // Vous pouvez rediriger vers la page de connexion ou afficher un message d'erreur approprié
            header('Location: /login');
            // exit;
        }

        // Afficher la vue avec le formulaire de gestion et les éventuelles erreurs
        $view = new View("Review/manage", "back");
        $view->assign("review", $Allreview);
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }
}
