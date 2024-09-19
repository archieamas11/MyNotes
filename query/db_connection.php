<?php

try {
    // Create a PDO connection using environment variables
    $conn = new PDO(
        "mysql:host=" . getenv("DB_HOST") . ";dbname=" . getenv("DB_DATABASE") . ";port=" . (getenv("DB_PORT") ?: "3306"),
        getenv("DB_USERNAME"),
        getenv("DB_PASSWORD")
    );

    // Set the PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected successfully"; // You can remove this in production
} catch (PDOException $e) {
    // If connection fails, display an error message
    die("Connection failed: " . $e->getMessage());
}

?>