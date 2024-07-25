<?php 
include "db_conn.php";
$id = $_GET['id'];

// Use prepared statements to prevent SQL injection
$sql = "DELETE FROM `books` WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

// Execute the query and check if successful
if ($stmt->execute()) {
    header("Location: index.php?msg=Record deleted successfully");
} else {
    echo "Failed: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
