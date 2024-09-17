<?php
include('../query/conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $noteTitle = $_POST["note_title"];
    $noteContent = $_POST["note_content"];
    $dateTime = date("Y-m-d H:i:s");

    try {
        $stmt = $conn->prepare("INSERT INTO tbl_notes (note_title, note, date_time) VALUES (:note_title, :note, :date_time)");
        $stmt->bindParam(':note_title', $noteTitle);
        $stmt->bindParam(':note', $noteContent);
        $stmt->bindParam(':date_time', $dateTime);
        $stmt->execute();
        // Echo JavaScript code to open the update note modal
        // echo "<script>openUpdateNoteModal('', '', '')</script>";
        // echo "<script>window.location.href = 'dashBoard.php';</script>";
        
        header("Location: ../dashBoard.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
