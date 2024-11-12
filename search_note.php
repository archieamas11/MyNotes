<?php
include('query/conn.php');

// Check if search query is provided
if (isset($_GET['search'])) {
    // Sanitize the search query to prevent SQL injection
    $searchQuery = '%' . $_GET['search'] . '%'; // Enclose search query in wildcard characters

    // Prepare SQL statement to search for notes with matching title
    $stmt = $conn->prepare("SELECT * FROM `tbl_notes` WHERE is_archived = 0 AND note_title LIKE :searchQuery");
    $stmt->bindParam(':searchQuery', $searchQuery);

    // Execute the prepared statement
    if ($stmt->execute()) {
        // Fetch search results as associative array
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return search results as JSON
        echo json_encode($result);
    } else {
        // Handle query execution error
        echo json_encode(['error' => 'Error executing query']);
    }
} else {
    // If search query is not provided, return empty JSON array
    echo json_encode([]);
}
?>
