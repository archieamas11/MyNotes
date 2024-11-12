<?php

try {
<<<<<<< HEAD
    // Directly insert your database details here
    $conn = new PDO(
        "mysql:host=localhost;dbname=crud;port=3306",
        "root",       // Username
        "",           // Password (leave blank for XAMPP)
    );

    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Connected successfully"; // Optional, for testing only
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
=======
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

>>>>>>> upstream/main
?>