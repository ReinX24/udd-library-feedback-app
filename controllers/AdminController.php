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
            "password" => "",
            "passwordRepeat" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminLoginData["username"] = $_POST["name"];
            $adminLoginData["password"] = $_POST["password"];
            $adminLoginData["passwordRepeat"] = $_POST["passwordRepeat"];

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
        $this->check_logged_in();

        $router->renderView(
            "admin/admin_dashboard",
            [
                "currentPage" => "adminIndex",
            ]
        );
    }

    //* FEEDBACK SEARCH
    use traits\AdminSearch;
    //* END OF FEEDBACK SEARCH

    //* ADMIN ACCOUNTS 
    use traits\AdminAccounts;
    //* END OF ADMIN ACCOUNTS

    //* ADMIN ACCOUNT (CURRENT ACCOUNT)
    use traits\AdminCurrentAccount;
    //* END OF ADMIN ACCOUNT (CURRENT ACCOUNT)

    public function admin_logout(Router $router)
    {
        $this->check_logged_in();

        // Destroy all session variables and return to index page
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            session_start();

            session_unset();
            session_destroy();

            header("Location: /");
            exit;
        }

        $router->renderView("admin/admin_logout");
    }

    // Starts the session and checks if the user is logged in
    public function check_logged_in()
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }
    }

    // Checks if the current logged in account is a master account
    public function check_master_logged_in()
    {
        $this->check_logged_in();

        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
        }
    }
}
