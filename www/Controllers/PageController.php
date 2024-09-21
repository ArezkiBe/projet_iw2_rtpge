<?php

namespace App\Controllers;

use App\Core\View;
use App\Core\Verificator;
use App\Models\Review;
use App\Models\User;
use App\Forms\AddReview;
use App\Forms\UpdateReview;
use App\Forms\ManageReview;
use App\Models\Page;

class PageController
{
    public function menus(): void
    {
        $menus = new Page();
        $menus = $menus->getAllBy(['type' => 1]);
        $view = new View("Client/menu", "front");
        $view->assign("menus", $menus);

    }

    public function entrees(): void
    {
        $entrees = new Page();
        $entrees = $entrees->getAllBy(['type' => 2]);
        $view = new View("Client/entree", "front");
        $view->assign("entrees", $entrees);

    }

    public function plats(): void
    {
        $plats = new Page();
        $plats = $plats->getAllBy(['type' => 3]);
        $view = new View("Client/plat", "front");
        $view->assign("plats", $plats);

    }

    public function desserts(): void
    {
        $desserts = new Page();
        $desserts = $desserts->getAllBy(['type' => 4]);
        $view = new View("Client/dessert", "front");
        $view->assign("desserts", $desserts);

    }
}
