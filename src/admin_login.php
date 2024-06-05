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

    $adminModel = new AdminLoginModel($pdo);

    $storedPassword = $adminModel->getAdminPassword($name);

    $adminController = new AdminLoginController($name, $password, $storedPassword);

    $errors = $adminController->validateInputs();

    $adminLoginView = new AdminLoginView($errors);

    session_start();

    if ($adminLoginView->errorsExist()) {
        // TODO: add errors to our admin_login_form
        $_SESSION["errors"] = $errors;
        header("Location: ../admin_login_form.php");
    } else {
        echo "Login successful";
    }
} else {
    header("Location: ../index.php");
}
