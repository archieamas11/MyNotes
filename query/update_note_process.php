<?php
// Include the connection file
$conn_path = '../query/conn.php';
if (file_exists($conn_path)) {
    include($conn_path);

    // Check if the connection is successfully established
    if (!$conn) {
        // Redirect to the update.php page with an error message
        header("Location: update_note.php?error=1");
        exit();
    }
} else {
    // Redirect to the update.php page with an error message
    header("Location: update_note.php?error=1");
    exit();
}

// Process the form data if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteID = $_POST['note_id'];
    $newTitle = $_POST['note_title'];
    $newContent = $_POST['note_content'];

    // Update the note in the database
    $stmt = $conn->prepare("UPDATE `tbl_notes` SET note_title = :title, note = :content WHERE tbl_notes_id = :note_id");
    $stmt->bindParam(':title', $newTitle);
    $stmt->bindParam(':content', $newContent);
    $stmt->bindParam(':note_id', $noteID);

    if ($stmt->execute()) {
        // Redirect to the dashboard page with a success message
        header("Location: ../dashBoard.php");
        exit();
    } else {
        // Redirect to the update.php page with an error message
        header("Location: update_note.php?edit=$noteID&error=1");
        exit();
    }
} else {
    // Redirect to the update.php page if accessed directly without submitting the form
    header("Location: ../dashBoard.php");
    exit();
}
?>
