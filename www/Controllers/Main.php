<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Page;
use App\Core\View;


class Main
{
    public function home(): void
    {

        $view = new View("Main/home", "front");

    }

    public function dashBoard(): void
    {
        if (!isset($_SESSION['auth_user'])) {
            header('Location: /login');
            exit;
        }


        $users = new User();
        $users = count($users->getAll());
        $pages = new Page();
        $pages = count($pages->getAll());


        $totalUsers = $users;
        $totalPages = $pages;

        $view = new View("Main/dashboard", "back");

        $view->assign("totalUsers", $totalUsers);
        $view->assign("totalPages", $totalPages);
    }
}
