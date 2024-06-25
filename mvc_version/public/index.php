<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\Router;
use app\controllers\FeedbackController;
use app\controllers\AdminController;

$router = new Router();

$router->addGetRoute("/", [FeedbackController::class, "index"]);

$router->addGetRoute("/feedback/create", [FeedbackController::class, "feedback_create"]);
$router->addPostRoute("/feedback/create", [FeedbackController::class, "feedback_create"]);

$router->addGetRoute("/feedback/admin_login", [AdminController::class, "admin_login"]);
$router->addPostRoute("/feedback/admin_login", [AdminController::class, "admin_login"]);

$router->addGetRoute("/admin/dashboard", [AdminController::class, "admin_dashboard"]);
// $router->addGetRoute("/admin/search", []);

$router->resolve();
