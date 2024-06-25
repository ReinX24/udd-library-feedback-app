<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\Admin;

class AdminController
{
    public function admin_login(Router $router)
    {
        $errors = [];
        $adminLoginData = [
            "username" => "",
            "password" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminLoginData["username"] = $_POST["name"];
            $adminLoginData["password"] = $_POST["password"];

            $admin = new Admin();
            $admin->load($adminLoginData);
            $errors = $admin->login();

            if (empty($errors)) {
                header("Location: /admin/dashboard");
                exit;
            }
        }

        $router->renderView(
            "feedback/admin_login",
            [
                "currentPage" => "adminLoginForm",
                "adminLoginData" => $adminLoginData,
                "errors" => $errors
            ]
        );
    }

    public function admin_dashboard(Router $router)
    {
        $router->renderView(
            "admin/admin_dashboard",
            [
                "currentPage" => "adminIndex",
            ]
        );
    }
}
