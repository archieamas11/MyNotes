<?php

// Database configuration using environment variables
$servername = getenv('DB_HOST') ;
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$dbname = getenv('DB_DATABASE');
$port = getenv('DB_PORT') ?: "3306";

try {
    // Create a PDO connection with port
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);
    
    // Set the PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Connection successful
    echo "Connected successfully";
} catch (PDOException $e) {
    // Log the actual error message and show a user-friendly message
    error_log("Database connection failed: " . $e->getMessage(), 0);
    echo "Connection failed. Please try again later.";
}

?>