<?php

declare(strict_types=1);

use classes\AdminLogin\AdminLoginModel;
use classes\AdminLogin\AdminLoginView;
use classes\AdminLogin\AdminLoginController;
use classes\Database\DatabaseConnect;

// Premade admin account
// $name = "admin";
// $password = "123";

require_once "bootstrap.php";

// TODO: finish creating admin login functionality
if (isset($_POST["login"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];

    $database = new DatabaseConnect();
    $pdo = $database->connectDatabase();

    // TODO: fix this tomorrow
    $adminModel = new AdminLoginModel($pdo);

    $storedPassword = $adminModel->getAdminPassword($name);
    echo $storedPassword;
    exit();

    $adminController = new AdminLoginController($name, $password);

    $errors = $adminController->validateInputs();
}
