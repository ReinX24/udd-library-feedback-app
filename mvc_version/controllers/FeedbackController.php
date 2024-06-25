<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\Feedback;

class FeedbackController
{
    public function index(Router $router)
    {
        $router->renderView(
            "feedback/index",
            ["currentPage" => "index"]
        );
    }

    public function feedback_create(Router $router)
    {
        $errors = [];
        $feedbackData = [
            "name" => "",
            "feedbackText" => ""
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $feedbackData["name"] = $_POST["name"];
            $feedbackData["feedbackText"] = $_POST["feedbackText"];

            $feedback = new Feedback();
            $feedback->load($feedbackData);
            $errors = $feedback->save();

            if (empty($errors)) {
                // If there are no errors, go back to the feedback_create page
                $router->renderView(
                    "feedback/feedback_create",
                    [
                        "currentPage" => "feedbackForm",
                    ]
                );
                exit;
            }
        }

        // If the request is a GET method, also returns errors and feedbackData
        $router->renderView(
            "feedback/feedback_create",
            [
                "currentPage" => "feedbackForm",
                "feedback" => $feedbackData,
                "errors" => $errors
            ]
        );
    }
}
