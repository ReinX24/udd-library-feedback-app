<?php

declare(strict_types=1);

namespace app\models;

use app\Database;

class Feedback
{
    public string $name;
    public string $feedbackText;
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

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
            $this->db->createFeedback($this);
        }

        return $errors;
    }

    public function getAllFeedback()
    {
        return $this->db->getFeedback();
    }

    public function getFeedbackByText(string $searchText)
    {
        return $this->db->getTextMatchFeedback($searchText);
    }

    public function getFeedbackByMonthAndYear(string $monthYearString)
    {
        return $this->db->getMonthAndYearMatchFeedback($monthYearString);
    }

    public function getFeedbackByExactDate(string $date)
    {
        return $this->db->getDateFeedback($date);
    }
}
