<?php
// Include the connection from conn.php
require 'conn.php'; // Path to your conn.php file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are provided
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        try {
            // Use the $conn from conn.php

            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Prepare SQL statement to insert user data
            $sql = "INSERT INTO table_user (name, password) VALUES (:name, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->execute();   

            // Redirect back to the login page after successful registration
            header("Location: ../index.php");
            exit();
        } catch (PDOException $e) {
            // Log error to a file
            error_log('Error: ' . $e->getMessage(), 0);
            // Output error message
            echo "Error: There was a problem connecting to the database. Please try again later.";
        } finally {
            // Always close the connection
            if ($conn) {
                $conn = null;
            }
        }
    } else {
        // Output error message if form fields are missing
        echo "Error: Please provide both name and password.";
    }
}
?>
