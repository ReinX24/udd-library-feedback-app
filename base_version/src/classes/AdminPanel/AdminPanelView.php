<?php

declare(strict_types=1);

namespace classes\AdminPanel;

class AdminPanelView
{

    private array $errors;

    public function __construct(array $errors)
    {
        $this->errors = $errors;
    }

    public function errorsExist(): bool
    {
        return !empty($this->errors);
    }
}
