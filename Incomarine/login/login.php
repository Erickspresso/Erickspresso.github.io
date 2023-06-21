<?php
// Database connection details
$host = "localhost"; // Your database host
$dbUsername = "root"; // Your database username
$dbPassword = ""; // Your database password
$dbName = "incomarine"; // Your database name

// Create a new MySQLi instance
$conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["pass"];

    // Prepare and execute a query to check the credentials
    $query = "SELECT * FROM login WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        // Authentication successful
        echo '<div class="alert alert-success" role="alert">Login successful! Welcome, '.$username.'!</div>';
    } else {
        // Authentication failed
        echo "Invalid username or password. Please try again.";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>