<?php

declare(strict_types=1);

namespace app\controllers\traits;

use app\Router;
use app\models\Feedback;
use \DateTime;

trait AdminSearch
{
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
}
