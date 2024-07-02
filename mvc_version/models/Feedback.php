<?php

declare(strict_types=1);

namespace app\models;

use app\Database;

class Feedback
{
    public ?int $id;
    public ?string $name;
    public ?string $feedbackText;
    public ?string $category;
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function load(array $feedbackData)
    {
        $this->id = array_key_exists("id", $feedbackData) ? (int) $feedbackData["id"] : null;
        $this->name = $feedbackData["name"] ?? null;
        $this->category = $feedbackData["category"] ?? null;

        // If the name is empty, set name as "Anonymous"
        if (empty($this->name)) {
            $this->name = "Anonymous";
        }

        $this->feedbackText = $feedbackData["feedback"] ?? null; // required
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

    public function edit()
    {
        $errors = [];

        if (!$this->feedbackText) {
            $errors["feedbackTextError"] = "Feedback is required!";
        }

        if (empty($errors)) {
            $this->db->editFeedback($this);
        }

        return $errors;
    }

    public function delete()
    {
        $this->db->deleteFeedback($this);
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

    public function getFeedbackByCategory(string $category)
    {
        if ($category == "all") {
            return $this->db->getFeedback();
        }

        return $this->db->getFeedbackByCategory($category);
    }

    public function getFeedbackById(int $feedbackId)
    {
        return $this->db->getFeedbackById($feedbackId);
    }
}
