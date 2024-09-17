<?php
include('query/conn.php');

$stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE is_archived = 0");
$stmt->execute();

$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
?>
