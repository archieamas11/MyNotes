<?php
include 'query/conn.php';

if (isset($_GET['note_id'])) {
    $noteID = $_GET['note_id'];
    // Update the is_archived field in the database for the note with the given ID
    $stmt = $conn->prepare("UPDATE tbl_notes SET is_archived = 1 WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':note_id', $noteID);
    $stmt->execute();
    // You can return a response if needed
    // For example, you could return JSON indicating success or failure
    // echo json_encode(['success' => true]);
}
?>
