<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Business logic layer:
// Class for fetching data from data access layer and returning it to presentation layer

class AppsService {
    
    private $database;

    // Inject an instance of the Database class in the constructor
    public function __construct($database) {
        $this->database = $database;
    }

    // Get all apps from the database
    public function getAllApps() {
        $result = $this->database->getAllRowsFromTable("apps");
        $apps = array();

        while ($row = $result->fetch_assoc()) {
            $app = new AppModel();
            $app->appId = $row["app_id"];
            $app->appName = $row["app_name"];
            $app->description = $row["description"];
            $app->price = $row["price"];
            array_push($apps, $app);
        }

        return $apps;
    }
}
