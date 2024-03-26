
<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Retrieve student's assessments
$student_name = $_SESSION['username']; 

$query = "SELECT lecturer, lec_marks , supervisor, sup_marks FROM assessment WHERE student_name = ?";

$student_name = $_SESSION["username"]; 
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $student_name);
$stmt->execute();
$stmt->store_result();

 // Use a different variable name

// $stmt = $conn->prepare($query);
// $stmt->bind_param("s", $student_name); // Use the new variable name here
// $stmt->execute();
// $stmt->bind_result($lecturer, $lec_marks,$supervisor,$sup_marks); // Use a different variable name
// $stmt->fetch();
// $stmt->close();

// Initialize variables
$lecturer = "";
$lec_marks = "";
$supervisor = "";
$sup_marks = "";

// Check if assessment data is available
if ($stmt->num_rows > 0) {
    $stmt->bind_result($lecturer, $lec_marks, $supervisor, $sup_marks);
    $stmt->fetch();
}
$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
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
        <?php if ($lecturer !== "" || $supervisor !== ""): ?>
    <h2>Hey <?php echo htmlspecialchars($_SESSION["username"]); ?>, Here are your Results!</h2>
    <?php if ($lecturer !== ""): ?>
        <table>
            <tr>
                <th>Lecturer Name</th>
                <td><?php echo htmlspecialchars($lecturer); ?></td>
            </tr>
            <tr>
                <th>Score out of 20</th>
                <td><?php echo htmlspecialchars($lec_marks); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p style="color:red">Your Lecturer has not assessed you yet.</p>
    <?php endif; ?>

    <?php if ($supervisor !== ""): ?>
        <table>
            <tr>
                <th>Supervisor Name</th>
                <td><?php echo htmlspecialchars($supervisor); ?></td>
            </tr>
            <tr>
                <th>Score out of 75</th>
                <td><?php echo htmlspecialchars($sup_marks); ?></td>
            </tr>
        </table>
    <?php else: ?>
        <p style="color:red">Your Firm Supervisor has not assessed you yet.</p>
    <?php endif; ?>

<?php else: ?>
    <h2>Hey <?php echo htmlspecialchars($_SESSION["username"]); ?>,</h2>
    <p style="color:red"> Opps!!!You have not been assessed by lecturers or supervisors yet. Please wait for the assessments to be completed.</p>
<?php endif; ?>

                

        </div>
    </div>

    <!-- Your additional HTML content or scripts here -->
</body>
</html>

