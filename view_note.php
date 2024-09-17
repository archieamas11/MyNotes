<?php
// Include your database connection file
include('query/conn.php');

// Check if the note ID is provided
if(isset($_GET['view'])) {
    $noteID = $_GET['view'];

    // Prepare and execute the SQL query to fetch the note details
    $stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE `tbl_notes_id` = ?");
    $stmt->execute([$noteID]);
    $note = $stmt->fetch();

    // Check if the note exists
    if($note) {
        $noteTitle = $note['note_title'];
        $noteContent = $note['note'];
        $noteDateTime = $note['date_time'];

        // Convert the date_time value to a formatted date and time string
        $formattedDateTime = date('F j, Y H:i A', strtotime($noteDateTime));

        // Display the note details
        echo "<h2>Note Details</h2>";
        echo "<p><strong>Title:</strong> $noteTitle</p>";
        echo "<p><strong>Content:</strong> $noteContent</p>";
        echo "<p><strong>Created:</strong> $formattedDateTime</p>";
    } else {
        // If the note does not exist
        echo "<p>Note not found.</p>";
    }
} else {
    // If note ID is not provided
    echo "<p>Note ID is not provided.</p>";
}
?>
