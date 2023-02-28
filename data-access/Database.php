<?php
// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "your_database_name";
    protected $connection;

    // Constructor connects to the database
    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    // Method to get all rows from a table
    public function getAll($table) {
        $result = $this->connection->query("SELECT * FROM " . $table);
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    // Close the database connection
    public function close() {
        $this->connection->close();
    }
}
