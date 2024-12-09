<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "librarymanagementsystemdict121";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch form data
$borrow_id = $_POST['borrow_id'];
$return_date = $_POST['return_date'];

// Update the database to mark the book as returned
$sql = "UPDATE borrowed_books SET return_date = ?, status = 'returned' WHERE borrow_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $return_date, $borrow_id);

if ($stmt->execute()) {
    echo "Book return processed successfully!";
} else {
    echo "Error: " . $stmt->error;
}

// Close the connection
$stmt->close();
$conn->close();
?>
