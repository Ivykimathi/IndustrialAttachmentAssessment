<?php
session_start();


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

$query = "SELECT username, reg_number, firm_name, location FROM student_data WHERE username = ?";


$sessionUsername = $_SESSION["username"]; // Use a different variable name

$stmt = $conn->prepare($query);
$stmt->bind_param("s", $sessionUsername); // Use the new variable name here
$stmt->execute();
$stmt->bind_result($resultUsername, $reg_number, $firm_name, $location); // Use a different variable name
$stmt->fetch();
$stmt->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Form</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
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
<br>
    <div class="main-container">
        <div class="navcontainer">
            <nav class="nav">
                <a href="../studentDashboard.php" onclick="loadContent('')">Dashboard</a>
                <a href="updateDetails.php" onclick="loadContent('updateDetails')">Attachment Institute</a>
                <a href="messages.php" onclick="loadContent('messages')">Messages</a>
                <!-- <a href="#" onclick="loadContent('settings')">Settings</a> -->
                <a href="" onclick="loadContent('institute')">Profile</a>
                <a href="../logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>
   
        <div class="main">
        <h2>Welcome to your Profile, <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h2>

        <table>
        <tr>
                <th>Username</th>
                <td><?php echo htmlspecialchars($resultUsername); ?></td>
            </tr>
            <tr>
                <th>Registration Number</th>
                <td><?php echo htmlspecialchars($reg_number); ?></td>
            </tr>
            <tr>
                <th>Firm Attached to:</th>
                <td><?php echo htmlspecialchars($firm_name); ?></td>
            </tr>
            <tr>
                <th>Location</th>
                <td><?php echo htmlspecialchars($location); ?></td>
            </tr>
    </table>
</div>
</div>


</body>
</html>