<?php

declare(strict_types=1);

namespace app\models;

use app\Database;

class Feedback
{
    public string $name;
    public string $feedbackText;

    public function load(array $feedbackData)
    {
        $this->name = $feedbackData["name"];

        // If the name is empty, set name as "Anonymous"
        if (empty($this->name)) {
            $this->name = "Anonymous";
        }

        $this->feedbackText = $feedbackData["feedbackText"]; // required
    }

    public function save()
    {
        $errors = [];

        if (!$this->feedbackText) {
            $errors["feedbackTextError"] = "Feedback is required!";
        }

        if (empty($errors)) {
            // TODO: add the feedback to our database
        }

        return $errors;
    }
}
