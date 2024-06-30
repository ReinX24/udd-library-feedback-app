<?php

declare(strict_types=1);

namespace app\models;

use app\Database;

class Admin
{
    public ?int $id;
    public ?string $username;

    public ?string $password;
    public ?string $passwordRepeat;

    public ?string $passwordNew;
    public ?string $passwordNewRepeat;

    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function load(array $adminData)
    {
        $this->id = (int) $adminData["id"] ?? null;
        $this->username = $adminData["username"] ?? null;

        $this->password = $adminData["password"] ?? null;
        $this->passwordRepeat = $adminData["passwordRepeat"] ?? null;

        $this->passwordNew = $adminData["passwordNew"] ?? null;
        $this->passwordNewRepeat = $adminData["passwordNewRepeat"] ?? null;
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

        if ($this->password !== $this->passwordRepeat) {
            $errors["passwordsMismatchError"] = "Passwords are not the same!";
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

    public function addAdmin()
    {
        $errors = [];

        if (!$this->username) {
            $errors["emptyUsernameError"] = "Username is required.";
        }

        if (!$this->password) {
            $errors["emptyPasswordError"] = "Password is required.";
        }

        if (!$this->passwordRepeat) {
            $errors["emptyPasswordRepeatError"] = "Password repeat is required.";
        }

        if (
            $this->password !== $this->passwordRepeat &&
            !empty($this->password) && !empty($this->passwordRepeat)
        ) {
            $errors["passwordsMismatchError"] = "Passwords do not match.";
        }

        if (empty($errors)) {
            $this->db->addAdminAccount($this);
        }

        return $errors;
    }

    public function editAdmin()
    {
        $errors = [];

        // Check if the username is empty
        if (!$this->username) {
            $errors["emptyUsernameError"] = "Username is required.";
        }

        // Check if the password is empty
        if (!$this->password) {
            $errors["emptyPasswordError"] = "Password is required.";
        }

        if (!$this->passwordNew) {
            $errors["emptyPasswordNewError"] = "New password is required.";
        }

        if (!$this->passwordNewRepeat) {
            $errors["emptyPasswordRepeatNewError"] = "Repeat new password is required.";
        }

        // Get the account with the same id
        $accountData = $this->db->getAdminById($this->id);

        // Checks if the password is the same with the account
        if (!password_verify($this->password, $accountData["password"])) {
            $errors["wrongPasswordError"] = "Wrong password!";
        }

        // Check if the new passwords are the same
        if (
            $this->passwordNew !== $this->passwordNewRepeat &&
            !empty($this->passwordNew) && !empty($this->passwordNewRepeat)
        ) {
            $errors["passwordsNewMismatchError"] = "New passwords do not match.";
        }

        // TODO: if there are no errors, edit the data in database

        return $errors;
    }

    public function deleteAdmin()
    {
        $this->db->deleteAdminAccount($this);
    }

    public function getAdminAccounts()
    {
        return $this->db->getAdminAccounts();
    }

    public function getAdminAccountById(int $id)
    {
        return $this->db->getAdminById($id);
    }
}
