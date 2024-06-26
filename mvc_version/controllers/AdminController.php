<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Feedback;
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
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
        }

        $router->renderView(
            "admin/admin_dashboard",
            [
                "currentPage" => "adminIndex",
            ]
        );
    }

    public function admin_search(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
        }

        $feedback = new Feedback();
        $feedbackData = $feedback->getAllFeedback();

        if (isset($_GET["search_text"]) && !empty($_GET["search_text"])) {
            // Search by text
            $feedbackData = $feedback->getFeedbackByText($_GET["search_text"] ?? "");
        }

        if (isset($_GET["search_month_and_year"]) && !empty($_GET["search_month_and_year"])) {
            // Search by month and year
            $feedbackData = $feedback->getFeedbackByMonthAndYear($_GET["search_month_and_year"]);
        }

        if (isset($_GET["search_date"]) && !empty($_GET["search_date"])) {
            // Search by exact date
            $feedbackData = $feedback->getFeedbackByExactDate($_GET["search_date"]);
        }

        $router->renderView(
            "admin/admin_search",
            [
                "currentPage" => "adminSearch",
                "matchedFeedback" => $feedbackData
            ]
        );
    }

    public function admin_logout()
    {
        // TODO: logout the logged in admin account
    }

    public function admin_accounts()
    {
        // TODO: get the admins and implement add account functionality
    }
}
