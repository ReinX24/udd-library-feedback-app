<?php

declare(strict_types=1);

namespace classes\Feedback;

class FeedbackView
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
