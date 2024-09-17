<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

include 'query/conn.php';

// Check if the note ID is provided
if (!isset($_GET['note_id'])) {
    // Handle the case where note ID is not provided
    exit('Note ID not provided');
}

$noteID = $_GET['note_id'];

// Update the note in the database to mark it as not favorite
$stmt = $conn->prepare("UPDATE `tbl_notes` SET is_favorite = 0 WHERE tbl_notes_id = :note_id");
$stmt->bindParam(':note_id', $noteID);
$stmt->execute();

// Check if the update was successful
if ($stmt->rowCount() > 0) {
    // Return a success response
    echo 'success';
} else {
    // Return an error response
    echo 'error';
}
?>
