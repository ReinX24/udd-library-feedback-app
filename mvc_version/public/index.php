<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\Router;
use app\controllers\FeedbackController;

$router = new Router();

$router->addGetRoute("/", [FeedbackController::class, "index"]);

$router->addGetRoute("/feedback/create", [FeedbackController::class, "feedback_create"]);

$router->addGetRoute("/feedback/admin_login", [FeedbackController::class, "admin_login"]);

$router->resolve();
