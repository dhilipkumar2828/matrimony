<?php
namespace Config;

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $dbname = "hmmattdk_matrimonialdb";
    
    private static $instance = null;
    private $conn;

    // Private constructor to prevent multiple instances (Singleton Pattern)
    private function __construct() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname . ";charset=utf8mb4";
            $options = [
                \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,       // Fetch associative arrays
                \PDO::ATTR_EMULATE_PREPARES   => false,                   // Disable emulation for real prepared statements
            ];
            
            $this->conn = new \PDO($dsn, $this->user, $this->pass, $options);
            
        } catch(\PDOException $e) {
            // Log the error securely instead of showing it to the user
            error_log("Database Connection Error: " . $e->getMessage());
            die("Database connection failed. Please try again later.");
        }
    }

    // Static method to get the single instance of the class
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method to get the PDO connection object
    public function getConnection() {
        return $this->conn;
    }

    // Prevent cloning and unserialization
    private function __clone() {}
    public function __wakeup() {}
}
?>