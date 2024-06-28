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
            exit;
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
            exit;
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

    public function admin_logout(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

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

    public function admin_accounts(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        $admin = new Admin();
        $adminData = $admin->getAdminAccounts();

        $router->renderView(
            "admin/admin_accounts",
            [
                "currentPage" => "adminAccounts",
                "adminData" => $adminData
            ]
        );
    }

    public function admin_search_details(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        $feedback = new Feedback();
        $feedbackData = $feedback->getFeedbackDetails((int) $_GET["feedbackId"]);

        $router->renderView(
            "admin/admin_search_details",
            [
                "currentPage" => "adminSearch",
                "feedback" => $feedbackData
            ]
        );
    }

    public function admin_search_delete(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        $feedback = new Feedback();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedbackData = [
                "id" => $_POST["feedbackId"]
            ];

            $feedback->load($feedbackData);
            $feedback->delete();

            header("Location: /admin/search");
            exit;
        }

        $feedbackData = $feedback->getFeedbackDetails((int) $_GET["feedbackId"]);

        $router->renderView(
            "admin/admin_search_delete",
            [
                "feedback" => $feedbackData
            ]
        );
    }

    public function admin_add(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        // TODO: only master_admin accounts can add admin accounts
        $errors = [];

        $adminData = [
            "username" => "",
            "password" => "",
            "passwordReapeat" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["username"] = $_POST["username"];
            $adminData["password"] = $_POST["password"];
            $adminData["passwordRepeat"] = $_POST["passwordRepeat"];

            $admin = new Admin();

            $admin->load($adminData);
            $errors = $admin->addAdmin();

            if (empty($errors)) {
                header("Location: /admin/accounts");
                exit;
            }
        }

        $router->renderView(
            "admin/admin_add",
            [
                "errors" => $errors,
                "adminData" => $adminData
            ]
        );
    }
}