<?php

declare(strict_types=1);

namespace app\controllers;

use app\Router;
use app\models\Feedback;

class FeedbackController
{
    public static function index(Router $router)
    {
        $router->renderView(
            "feedback/index",
            ["currentPage" => "index"]
        );
    }

    public static function feedback_create(Router $router)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // TODO: finish POST method
        }

        $router->renderView(
            "feedback/feedback_create",
            ["currentPage" => "feedbackForm"]
        );
    }

    public static function admin_login(Router $router)
    {
        $router->renderView(
            "feedback/admin_login",
            ["currentPage" => "admingLoginForm"]
        );
    }
}
