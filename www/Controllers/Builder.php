<?php

namespace App\Controllers;

use App\Core\View;
use App\Models\Page;
use App\Core\Verificator;
use App\Forms\AddPage;
use App\Models\User;


class Builder
{
    public function list(): void
    {

        if (!isset($_SESSION['auth_user'])) {
            header('Location: /login');
            exit;
        }
        $userRoleId = $_SESSION['auth_user']['role'];
        if ($userRoleId == 3) {
            header('Location: /login');
            exit;
        }

        $pages = new Page();
        $pages = $pages->getAll();


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                $page = new Page();
                switch ($_POST['action']) {
                    case 'edit':
                        header("Location: /page-edit?id=".$_POST['id']);
                        break;
                    case 'delete':
                        $page->deleteBy(["id" => $_POST['id']]);
                        header('Location: /page-list');
                        break;
                    case 'add':
                        header('Location: /page-new');
                        break;
                }
            }
        }

        $view = new View("Page/list", "back");
        $view->assign("pages", $pages);

    }

    public function create(): void
    {
        if (!isset($_SESSION['auth_user'])) {
            header('Location: /login');
            exit;
        }
        $userRoleId = $_SESSION['auth_user']['role'];
        if ($userRoleId == 3) {
            header('Location: /login');
            exit;
        }

        $form = new AddPage();
        $configForm = $form->getConfig();
        $errors = [];

        $typeMapping = [
            'Menu' => 1,
            'Entrée' => 2,
            'Plat' => 3,
            'Dessert' => 4,
        ];

        if($_SERVER["REQUEST_METHOD"] == $configForm["config"]["method"]){
            $verificator = new Verificator();
            $type = $_POST['type'];
            $typeValue = $typeMapping[$type];
            if($verificator->checkForm($configForm, $_REQUEST, $errors))
            {
                $page = new Page;

                $page->settitle($_REQUEST['title']);
                $page->setContent("");
                $page->setType($typeValue);
                $page->save();

                header('Location: /page-list');
  
            }
        }

        $view = new View("Page/new", "back");
        $view->assign("form", $configForm);
        $view->assign("formErrors", $errors);
    }

    public function edit(): void
    {
        if (!isset($_SESSION['auth_user'])) {
            header('Location: /login');
            exit;
        }
        $userRoleId = $_SESSION['auth_user']['role'];
        if ($userRoleId == 3) {
            header('Location: /login');
            exit;
        }

        $page = Page::populate($_GET['id']);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $page->setTitle($_POST['title']);
            $page->setContent($_POST['content']);
            $page->save();

            header("Location: /page-list");
        }

        $view = new View("Page/edit", "back");
        $view->assign("page", $page);

    }

    public function show(): void
    {        
        $page = Page::populate($_GET['id']);
        $page =$page->getContent();

        $view = new View("Page/show", "neutral");
        $view->assign("page", $page);

    }

    
}
