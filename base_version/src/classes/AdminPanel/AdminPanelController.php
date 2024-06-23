<?php

declare(strict_types=1);

namespace classes\AdminPanel;

class AdminPanelController
{
    private string $username;
    private string $password;
    private string $repeatPassword;

    public function __construct(string $username, string $password, string $repeatPassword)
    {
        $this->username = $username;
        $this->password = $password;
        $this->repeatPassword = $repeatPassword;
    }

    public function validateInputs(): array
    {
        $errors = [];

        if (empty($this->username)) {
            $errors["emptyUsernameError"] = "Username is required.";
        }

        if (empty($this->password)) {
            $errors["emptyPasswordError"] = "Password is required.";
        }

        if (empty($this->repeatPassword)) {
            $errors["emptyRepeatPassword"] = "Repeat password is required.";
        }

        if ($this->password !== $this->repeatPassword && !empty($this->password) && !empty($this->repeatPassword)) {
            $errors["passwordsMismatch"] = "Passwords are not the same.";
        }

        return $errors;
    }
}
