<?php

declare(strict_types=1);

namespace classes\AdminLogin;

class AdminLoginController
{

    private string $username;
    private string $password;

    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
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

        // TODO: check if the passwords are the same

        return $errors;
    }

    public function checkPasswords(string $inputPassword, string $storedPassword)
    {
        return password_verify($inputPassword, $storedPassword);
    }
}
