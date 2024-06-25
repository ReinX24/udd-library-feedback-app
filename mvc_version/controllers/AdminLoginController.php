<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
// use app\models\Admin;

class AdminLoginController
{
    public function admin_login(Router $router)
    {
        // TODO: finish login functionality

        $router->renderView(
            "feedback/admin_login",
            ["currentPage" => "adminLoginForm"]
        );
    }
}
