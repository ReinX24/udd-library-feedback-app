<?php

declare(strict_types=1);

namespace classes\Feedback;

class FeedbackController
{

    private string $name;
    private string $feedbackText;

    public function __construct(string $name, string $feedbackText)
    {
        $this->name = $name;
        $this->feedbackText = $feedbackText;
    }

    public function checkAnonymous()
    {
        if (empty($this->name)) {
            return "Anonymous";
        } else {
            return $this->name;
        }
    }

    public function validateInputs(): array
    {
        $errors = [];

        if (empty($this->feedbackText)) {
            $errors["feedbackEmptyMessage"] = "Feedback is required.";
        }

        return $errors;
    }
}
