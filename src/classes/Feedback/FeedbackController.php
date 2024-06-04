<?php

declare(strict_types=1);

namespace classes\Feedback;

class FeedbackController
{

    private string $feedbackText;

    public function __construct($feedbackText)
    {
        $this->feedbackText = $feedbackText;
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
