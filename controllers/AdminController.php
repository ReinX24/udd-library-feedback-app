<?php

declare(strict_types=1);

namespace app\controllers;

use app\models\Feedback;
use app\Router;
use app\models\Admin;
use \DateTime;

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
    public function admin_search(Router $router)
    {
        $this->check_logged_in();

        $feedback = new Feedback();

        $feedbackData = [
            "feedbackText" => "",
            "category" => "",
            "created_at"
        ];

        if (isset($_GET["search_text"]) && !empty($_GET["search_text"])) {
            // Search by text
            $feedbackData["feedbackText"] = $_GET["search_text"];
            $feedback->load($feedbackData);
            $feedbackData = $feedback->getFeedbackByText();
        } elseif (isset($_GET["search_month_and_year"]) && !empty($_GET["search_month_and_year"])) {
            // Search by month and year
            $feedbackData["created_at"] = $_GET["search_month_and_year"];
            $feedback->load($feedbackData);
            $feedbackData = $feedback->getFeedbackByMonthAndYear();
        } elseif (isset($_GET["search_date"]) && !empty($_GET["search_date"])) {
            // Search by exact date
            $feedbackData["created_at"] = $_GET["search_date"];
            $feedback->load($feedbackData);
            $feedbackData = $feedback->getFeedbackByExactDate();
        } elseif (isset($_GET["searchCategory"])) {
            // Search by category
            $feedbackData["category"] = $_GET["searchCategory"];
            $feedback->load($feedbackData);
            $feedbackData = $feedback->getFeedbackByCategory();
        } else {
            // Get all feedback from the database
            $feedbackData = $feedback->getAllFeedback();
        }

        // Getting the current dates for placeholders
        $currentDate = new DateTime();
        $currentYearMonth = $currentDate->format("Y-m");
        $currentDayMonthYear = $currentDate->format("Y-m-d");

        $router->renderView(
            "admin/admin_search",
            [
                "currentPage" => "adminSearch",
                "currentYearMonth" => $currentYearMonth,
                "currentDayMonthYear" => $currentDayMonthYear,
                "matchedFeedback" => $feedbackData
            ]
        );
    }

    public function admin_search_details(Router $router)
    {
        $this->check_logged_in();

        $feedbackData = [
            "id" => null
        ];

        $feedbackData["id"] = (int) $_GET["feedbackId"];

        $feedback = new Feedback();
        $feedback->load($feedbackData);

        $feedbackData = $feedback->getFeedbackById();

        $router->renderView(
            "admin/admin_search_details",
            [
                "currentPage" => "adminSearch",
                "feedback" => $feedbackData
            ]
        );
    }

    public function admin_search_edit(Router $router)
    {
        $this->check_master_logged_in();

        $errors = [];

        $feedbackData = [
            "id" => "",
            "name" => "",
            "feedback" => "",
            "category" => "",
            "is_edited" => "",
            "created_at" => ""
        ];

        $feedback = new Feedback();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedbackData["id"] = (int) $_POST["id"];
            $feedbackData["name"] = $_POST["name"];
            $feedbackData["category"] = $_POST["categorySelect"];
            $feedbackData["feedbackText"] = $_POST["feedbackText"];
            $feedbackData["created_at"] = $_POST["created_at"];

            $feedback->load($feedbackData);
            $errors = $feedback->edit();

            if (empty($errors)) {
                // Go back to details page with success message
                header("Location: /admin/search/details?feedbackId=$feedback->id&edited_success=true");
                exit;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $feedbackData["id"] = (int) $_GET["feedbackId"];

            $feedback = new Feedback();
            $feedback->load($feedbackData);

            $feedbackData = $feedback->getFeedbackById();
        }

        $router->renderView(
            "admin/admin_search_edit",
            [
                "errors" => $errors,
                "feedbackData" => $feedbackData
            ]
        );
    }

    public function admin_search_delete(Router $router)
    {
        $this->check_master_logged_in();

        $feedbackData = [
            "id" => ""
        ];

        $feedback = new Feedback();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedbackData["id"] = $_POST["id"];

            $feedback->load($feedbackData);
            $feedback->delete();

            header("Location: /admin/search?delete_success=true");
            exit;
        }

        $feedbackData["id"] = (int) $_GET["feedbackId"];

        $feedback = new Feedback();
        $feedback->load($feedbackData);

        $feedbackData = $feedback->getFeedbackById();

        $router->renderView(
            "admin/admin_search_delete",
            [
                "currentPage" => "adminSearch",
                "feedback" => $feedbackData
            ]
        );
    }
    //* END OF FEEDBACK SEARCH

    // TODO: debug admin accounts functions
    //* ADMIN ACCOUNTS 
    public function admin_accounts(Router $router)
    {
        $this->check_logged_in();

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

    // Adding an admin account, can only be used for master accounts
    public function admin_add(Router $router)
    {
        $this->check_master_logged_in();

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
                "currentPage" => "adminAccounts",
                "adminData" => $adminData,
                "errors" => $errors
            ]
        );
    }

    // Editing an admin account, can only be used for master accounts
    public function admin_edit(Router $router)
    {
        $this->check_master_logged_in();

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

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            // Get id from GET request and get account
            $id = (int) $_GET["id"];
            $adminData = $admin->getAdminAccountById($id);

            // Change password will be set to false
            $adminData["changePassword"] = false;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["id"] = (int) $_POST["id"];
            $adminData["username"] = $_POST["username"];
            // The password loaded is the password for the currently logged in account
            $adminData["password"] = $_POST["password"];
            $adminData["changePassword"] = isset($_POST["changePassword"]);
            $adminData["passwordNew"] = $_POST["passwordNew"];
            $adminData["passwordNewRepeat"] = $_POST["passwordNewRepeat"];
            $adminData["master_account"] = isset($_POST["master_account"]);

            $admin->load($adminData);
            $errors = $admin->editAdmin();

            if (empty($errors)) {
                // If we apply edits to current account, logout account
                if ($admin->id == $_SESSION["userLoginInfo"]["id"]) {
                    $this->admin_logout($router);
                }
                // If the edited account is not the current account
                header("Location: /admin/accounts?account_success_edit=true");
                exit;
            }
        }

        $router->renderView(
            "admin/admin_edit",
            [
                "currentPage" => "adminAccounts",
                "adminData" => $adminData,
                "errors" => $errors
            ]
        );
    }

    // Deleting an admin account as a master account
    public function admin_delete(Router $router)
    {
        $this->check_master_logged_in();

        $errors = [];

        $adminData = [
            "id" => ""
        ];

        $admin = new Admin();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $id = (int) $_GET["id"];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = (int) $_POST["id"];
            $adminData["id"] = $id;

            $admin->load($adminData);
            $errors = $admin->deleteAdmin();

            if (empty($errors)) {
                // If the current user is the one being deleted, return to index
                if ($_SESSION["userLoginInfo"]["id"] == $_POST["id"]) {
                    $this->admin_logout($router);
                }

                // Go to the accounts page with success message
                header("Location: /admin/accounts?account_success_delete=true");
            }
        }

        // Get the admin account info by their id
        $adminData = $admin->getAdminAccountById($id);

        $router->renderView(
            "admin/admin_delete",
            [
                "currentPage" => "adminAccounts",
                "adminData" => $adminData,
                "errors" => $errors
            ]
        );
    }
    //* END OF ADMIN ACCOUNTS

    // TODO: debug admin account functions
    //* ADMIN ACCOUNT (CURRENT ACCOUNT)
    /** 
     * Load current admin account credentials page
     */
    public function admin_account(Router $router)
    {
        $this->check_logged_in();

        $router->renderView(
            "admin/admin_account",
            [
                "currentPage" => "adminAccount",
            ]
        );
    }

    // Edit the currently logged in admin account
    public function admin_current_edit(Router $router)
    {
        $this->check_logged_in();

        $errors = [];

        $adminData = [
            "id" => "",
            "username" => "",
            "password" => "",
            "changePassword" => false,
            "passwordNew" => "",
            "passwordNewRepeat" => "",
            "master_account" => ""
        ];

        $admin = new Admin();

        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $adminData = $_SESSION["userLoginInfo"];
            $adminData["changePassword"] = false;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["id"] = $_SESSION["userLoginInfo"]["id"];
            $adminData["username"] = $_POST["username"];
            $adminData["password"] = $_POST["password"];
            $adminData["changePassword"] = isset($_POST["changePassword"]);
            $adminData["passwordNew"] = $_POST["passwordNew"];
            $adminData["passwordNewRepeat"] = $_POST["passwordNewRepeat"];

            // master_account status cannot be changed
            $adminData["master_account"] = $_SESSION["userLoginInfo"]["master_account"] ? true : false;

            $admin->load($adminData);
            $errors = $admin->editAdmin();

            if (empty($errors)) {
                // If there are no errors, logout the current account
                $this->admin_logout($router);
            }
        }

        $router->renderView(
            "admin/admin_current_edit",
            [
                "currentPage" => "adminAccount",
                "adminData" => $adminData,
                "errors" => $errors
            ]
        );
    }

    public function admin_current_delete(Router $router)
    {
        $this->check_logged_in();

        $errors = [];

        $adminData = [
            "id" => "",
        ];

        $admin = new Admin();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminData["id"] = $_SESSION["userLoginInfo"]["id"];

            $admin->load($adminData);
            $errors = $admin->deleteAdmin();

            if (empty($errors)) {
                // After deleting the current account, logout and go back to index
                $this->admin_logout($router);
            }
        }

        $router->renderView(
            "admin/admin_current_delete",
            [
                "currentPage" => "adminAccount",
                "errors" => $errors
            ]
        );
    }
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
