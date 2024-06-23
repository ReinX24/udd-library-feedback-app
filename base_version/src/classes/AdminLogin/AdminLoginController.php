<?php

declare(strict_types=1);

namespace classes\AdminLogin;

class AdminLoginController
{

    private string $username;
    private string $password;
    private mixed $storedPassword;

    public function __construct(string $username, string $password, mixed $storedPassword)
    {
        $this->username = $username;
        $this->password = $password;
        $this->storedPassword = $storedPassword;
    }

    public function validateInputs(): array
    {
        $errors = [];

        if (empty($this->username)) {
            $errors["emptyUsernameError"] = "Username is empty.";
        }

        if (empty($this->password)) {
            $errors["emptyPasswordError"] = "Password is empty.";
        }

        if ($this->checkPassword($this->password, $this->storedPassword)) {
            $errors["passwordMismatchError"] = "Wrong password!";
        }

        return $errors;
    }

    public function checkPassword(string $inputPassword, mixed $storedPassword): bool
    {
        if ($storedPassword) {
            $storedPassword = $storedPassword["password"];
        } else {
            $storedPassword = ""; // if a password is not found
        }

        return !empty($inputPassword) && !password_verify($inputPassword, $storedPassword);
    }
}
