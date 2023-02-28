<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/AppModel.php";

class AppsDatabase extends Database {

    // Get all apps from the apps table in the database.
    public function getAll(){
        $result = $this->getAllRowsFromTable("apps");

        $apps = array();

        while ($row = $result->fetch_assoc()) {
            $app = new AppModel();

            $app->setAppId($row["app_id"]);
            $app->setAppName($row["app_name"]);
            $app->setDescription($row["description"]);
            $app->setPrice($row["price"]);

            $apps[] = $app;
        }

        return $apps;
    }
}
