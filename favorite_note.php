<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'query/conn.php';

if (isset($_GET['note_id'])) {
    $noteID = $_GET['note_id'];

    // Prepare and execute the SQL query to update the note as favorite in the database
    $stmt = $conn->prepare("UPDATE tbl_notes SET is_favorite = 1 WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':note_id', $noteID);

    if ($stmt->execute()) {
        // If the query is successful, return a success message
        echo "Note favorited successfully";
    } else {
        // If there's an error with the query, return an error message
        echo "Error favoriting note";
    }
} else {
    // If note_id is not set in the request, return an error message
    echo "Note ID not provided";
}
?>
