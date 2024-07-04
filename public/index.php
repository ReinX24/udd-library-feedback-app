<?php

// TODO: add virtual host for application

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

$router->addGetRoute("/admin/search", [AdminController::class, "admin_search"]);

$router->addGetRoute("/admin/search/details", [AdminController::class, "admin_search_details"]);

// Only master accounts can edit searches
$router->addGetRoute("/admin/search/edit", [AdminController::class, "admin_search_edit"]);
$router->addPostRoute("/admin/search/edit", [AdminController::class, "admin_search_edit"]);

// Only master accounts can delete searches
$router->addGetRoute("/admin/search/delete", [AdminController::class, "admin_search_delete"]);
$router->addPostRoute("/admin/search/delete", [AdminController::class, "admin_search_delete"]);

$router->addGetRoute("/admin/accounts", [AdminController::class, "admin_accounts"]);

// Editing the current account of the user
$router->addGetRoute("/admin/accounts/edit_account", [AdminController::class, "admin_current_edit"]);
$router->addPostRoute("/admin/accounts/edit_account", [AdminController::class, "admin_current_edit"]);

// Master accounts can only add accounts
$router->addGetRoute("/admin/accounts/add", [AdminController::class, "admin_add"]);
$router->addPostRoute("/admin/accounts/add", [AdminController::class, "admin_add"]);

// Master accounts can only delete accounts
$router->addGetRoute("/admin/accounts/delete", [AdminController::class, "admin_delete"]);
$router->addPostRoute("/admin/accounts/delete", [AdminController::class, "admin_delete"]);

// Master accounts can only edit accounts, can change username, password, and privileges
$router->addGetRoute("/admin/accounts/edit", [AdminController::class, "admin_edit"]);
$router->addPostRoute("/admin/accounts/edit", [AdminController::class, "admin_edit"]);

$router->addGetRoute("/admin/logout", [AdminController::class, "admin_logout"]);
$router->addPostRoute("/admin/logout", [AdminController::class, "admin_logout"]);

$router->resolve();