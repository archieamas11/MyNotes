<?php
// Include database connection
include 'query/conn.php';

// Check if note_id parameter is set
if (isset($_GET['note_id'])) {
    // Retrieve note_id from GET parameters
    $noteID = $_GET['note_id'];

    try {
        // Prepare SQL statement to update the note's archive status
        $stmt = $conn->prepare("UPDATE `tbl_notes` SET is_archived = 0 WHERE tbl_notes_id = :note_id");
        $stmt->bindParam(':note_id', $noteID);
        
        // Execute the statement
        if ($stmt->execute()) {
            // Return success message
            echo 'success';
        } else {
            // Return error message
            echo 'error';
        }
    } catch (PDOException $e) {
        // Handle database error
        echo 'error';
    }
} else {
    // Return error message if note_id parameter is not set
    echo 'error';
}
?>
