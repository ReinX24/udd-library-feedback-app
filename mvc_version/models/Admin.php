<?php

declare(strict_types=1);

namespace app\models;

use app\Database;

class Admin
{
    public string $username;
    public string $password;
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function load(array $adminLoginData)
    {
        $this->username = $adminLoginData["username"];
        $this->password = $adminLoginData["password"];
    }

    public function login()
    {
        $errors = [];

        if (!$this->username) {
            $errors["usernameEmptyError"] = "Username empty!";
        }

        if (!$this->password) {
            $errors["passwordEmptyError"] = "Password empty!";
        }

        // Find the user and get record in database
        $adminCredentials = $this->db->getAdminCredentials($this);

        if (empty($adminCredentials)) {
            $errors["userNotFoundError"] = "User not found!";
        }

        if (
            isset($adminCredentials["password"])
            &&
            !password_verify($this->password, $adminCredentials["password"])
        ) {
            $errors["wrongPasswordError"] = "Wrong password!";
        }

        if (empty($errors)) {
            session_start();
            $_SESSION["userLoginInfo"] = $adminCredentials;
            $_SESSION["isLoggedIn"] = true;
        }

        return $errors;
    }

    public function getAdminAccounts()
    {
        return $this->db->getAdminAccounts();
    }
}
