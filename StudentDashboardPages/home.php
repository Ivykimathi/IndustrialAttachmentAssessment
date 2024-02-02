<?php
// Start the session
session_start();

// Check if the user is logged in (you may need to modify this based on your authentication mechanism)
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Connect to your database (replace these values with your database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the session (assuming you store user ID in the session)
$user_id = $_SESSION['user_id'];

// Check if there are messages for the user
$sql = "SELECT * FROM messages WHERE user_id = $user_id";
$result = $conn->query($sql);

// Check if there are messages
if ($result->num_rows > 0) {
    // Fetch and display messages
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Subject:</strong> " . $row['subject'] . "<br>";
        echo "<strong>Message:</strong> " . $row['message'] . "</p>";
    }
} else {
    // No messages found
    echo "<p>No messages available. Check back later.</p>";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
    <!-- Add your additional styles or include a separate stylesheet -->
</head>
<body>
    <!-- Header Part -->
    <header>
        <div class="logosec">
            <div class="logo">Student Dashboard</div>
            <div class="menuicn">
                <div class="hamburger" onclick="toggleNav()">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="navcontainer">
            <!-- Your navigation content here -->
        </div>

        <div class="main">
            <!-- Your main content here -->
        </div>
    </div>

    <!-- Your additional HTML content or scripts here -->
</body>
</html>

