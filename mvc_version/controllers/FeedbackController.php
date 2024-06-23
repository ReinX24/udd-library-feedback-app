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
            "feedback/index"
        );
    }

    public static function feedback_create(Router $router)
    {
        $router->renderView(
            "feedback/feedback_create"
        );
    }
}
