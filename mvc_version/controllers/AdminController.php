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

        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
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

        // Return the user to the admin dashboard if they are not a master account
        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
        }

        $errors = [];

        $adminData = [
            "username" => "",
            "password" => "",
            "passwordReapeat" => "",
            "master_account" => false
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["username"] = $_POST["username"];
            $adminData["password"] = $_POST["password"];
            $adminData["passwordRepeat"] = $_POST["passwordRepeat"];
            $adminData["master_account"] = isset($_POST["masterAccount"]);

            $admin = new Admin();

            $admin->load($adminData);
            $errors = $admin->addAdmin();

            if (empty($errors)) {
                header("Location: /admin/accounts?account_success_add=true");
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

    public function admin_edit(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        // Return the user to the admin dashboard if they are not a master account
        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
        }

        $errors = [];

        $adminData = [
            "id" => "",
            "username" => "",
            "password" => "",
            "changePassword" => false,
            "passwordNew" => "",
            "passwordNewRepeat" => "",
            "master_account" => null
        ];

        $admin = new Admin();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["id"] = (int) $_POST["id"];
            $adminData["username"] = $_POST["username"];
            $adminData["password"] = $_POST["password"];
            $adminData["changePassword"] = isset($_POST["changePassword"]);
            $adminData["passwordNew"] = $_POST["passwordNew"];
            $adminData["passwordNewRepeat"] = $_POST["passwordNewRepeat"];
            $adminData["master_account"] = isset($_POST["master_account"]);

            $admin->load($adminData);
            $errors = $admin->editAdmin();

            if (empty($errors)) {
                // If there are no errors, return to the accounts page
                header("Location: /admin/accounts");
                exit;
            }

            // If there are any errors, return the last entered data
            $router->renderView(
                "admin/admin_edit",
                [
                    "adminData" => $adminData,
                    "errors" => $errors
                ]
            );
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Get id from GET request and get account
            $id = (int) $_GET["id"];
            $adminData = $admin->getAdminAccountById($id);

            // Change password will be set to false
            $adminData["changePassword"] = false;
        }

        $router->renderView(
            "admin/admin_edit",
            [
                "adminData" => $adminData,
                "errors" => $errors
            ]
        );
    }

    // Edit the currently logged in admin account
    public function admin_current_edit(Router $router)
    {
        // TODO: get the current admin account
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        // Return the user to the admin dashboard if they are not a master account
        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
        }

        $errors = [];

        // Get the id of the currently logged in user
        $id = $_SESSION["userLoginInfo"]["id"];

        // TODO: finish account editing functionality

        $admin = new Admin();
        $adminData = $admin->getAdminAccountById($id);
        $adminData["changePassword"] = false; // false by default

        $router->renderView(
            "admin/admin_current_edit",
            [
                "currentPage" => "adminAccountEdit",
                "adminData" => $adminData
            ]
        );
    }

    // Deleting an admin account as a master account
    public function admin_delete(Router $router)
    {
        session_start();

        if (!$_SESSION["isLoggedIn"]) {
            header("Location: /");
            exit;
        }

        if (!$_SESSION["userLoginInfo"]["master_account"]) {
            header("Location: /admin/dashboard");
        }

        $admin = new Admin();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $admin->load($_POST);
            $admin->deleteAdmin();

            // If the current user is the one being deleted, return to index
            if ($_SESSION["userLoginInfo"]["id"] == $_POST["id"]) {
                header("Location: /");
            }

            header("Location: /admin/accounts");
        }

        $id = (int) $_GET["id"];
        $adminData = $admin->getAdminAccountById($id);

        $router->renderView(
            "admin/admin_delete",
            [
                "adminData" => $adminData
            ]
        );
    }
}
