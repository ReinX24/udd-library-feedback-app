<?php

declare(strict_types=1);

namespace app;

use app\Database;

class Router
{
    // GET and POST routes
    public array $getRoutes = [];
    public array $postRoutes = [];
    public Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addGetRoute(string $url, array $fn)
    {
        $this->getRoutes[$url] = ["controller" => $fn[0], "method" => $fn[1]];
    }

    public function addPostRoute(string $url, array $fn)
    {
        $this->postRoutes[$url] = ["controller" => $fn[0], "method" => $fn[1]];
    }

    public function resolve()
    {
        $currentUrl = $_SERVER["REQUEST_URI"] ?? "/";

        // Removing the query string from the url
        if (strpos($currentUrl, "?")) {
            $currentUrl = substr($currentUrl, 0, strpos($currentUrl, "?"));
        }

        // Checking if the request is a GET or POST request
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        if ($requestMethod == "GET") {
            $fn = $this->getRoutes[$currentUrl] ?? null;
        } else {
            $fn = $this->postRoutes[$currentUrl] ?? null;
        }

        if ($fn) {
            // Create a controller for the class
            $controlller = new $fn["controller"]();
            $method = $fn["method"];
            $controlller->$method($this);
        } else {
            echo "Page not found";
        }
    }

    public function renderView($view, $params = [])
    {
        // Converts key value array items into variables and values
        extract($params);

        // Starts buffering, loads the entire page before being sent to browser
        ob_start();

        include_once __DIR__ . "/views/{$view}.php";

        // Get the contents inside the buffer
        $content = ob_get_clean();

        include_once __DIR__ . "/views/_layout.php";
    }
}
