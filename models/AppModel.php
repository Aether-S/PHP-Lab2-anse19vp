<?php
// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for apps-table in database
class AppModel {
    public $appId;
    public $appName;
    public $description;
    public $price;
}
