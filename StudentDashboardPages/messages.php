
<?php
session_start();

//$servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "industriala";

// $conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }


// $query = "SELECT username, remarks, created_at FROM lrc_assessment WHERE username = ?";

// $sessionUsername = $_SESSION["username"];

// $stmt = $conn->prepare($query);
// $stmt->bind_param("s", $sessionUsername);
// $stmt->execute();
// $stmt->bind_result($sender, $messageContent, $timestamp);

// Fetch all messages into an array
// $messages = array();
// while ($stmt->fetch()) {
//     $messages[] = array(
//         'sender' => $sender,
//         'message_content' => $messageContent,
//         'timestamp' => $timestamp
//     );
// }
// $stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
    <style>
        .message-container {
            margin-top: 20px;
        }

        .message {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .no-messages {
            font-style: italic;
        }
    </style>
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
            <nav class="nav">
                <a href="../studentDashboard.php" onclick="loadContent('')">Dashboard</a>
                <a href="updateDetails.php" onclick="loadContent('updateDetails')">Attachment Institute</a>
                <a href="" onclick="loadContent('messages')">Messages</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="profile.php" onclick="loadContent('institute')">Profile</a>
                <a href="../logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
           
        <h2>No messages yet!!</h2>

               <!--   <div class="message-container">
                    <?php
                    if (!empty($messages)) {
                        foreach ($messages as $message) {
                            echo '<div class="message">';
                            echo '<p><strong>From:</strong> ' . htmlspecialchars($message['sender']) . '</p>';
                            echo '<p><strong>Message:</strong> ' . htmlspecialchars($message['message_content']) . '</p>';
                            echo '<p><strong>Timestamp:</strong> ' . htmlspecialchars($message['timestamp']) . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="no-messages">No messages available.</p>';
                    }
                    ?>
                </div> -->

        </div>
    </div>

    <!-- Your additional HTML content or scripts here -->
</body>
</html>

