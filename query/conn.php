<?php

try {
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
?>