<?php
// Start the session
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

// Query to get all students
$sql = "SELECT username, reg_number, firm_name, location FROM student_data";
$result = $conn->query($sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
</head>
<style>
        table {
            margin-left: 40px;
            width: 70%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
<body>

    <!-- Header Part -->
    <header>
        <div class="logosec">
            <div class="logo">Admin Dashboard</div>
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
                <a href="admin.php" onclick="loadContent('')">Dashboard</a>
                <a href="" onclick="loadContent('updateDetails')">View All Students</a>
                <a href="viewAllLecturers.php" onclick="loadContent('messages')">View All Lecturers</a>
                <a href="assignLecturers.php" onclick="loadContent('settings')">Assign Lecturers</a>
                <a href="logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
        <h2>All Students</h2>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Username</th><th>Reg</th><th>Firm</th><th>Location</th></tr>";

            while ($student = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $student['username'] . "</td>";
                echo "<td>" . $student['reg_number'] . "</td>";
                echo "<td>" . $student['firm_name'] . "</td>";
                echo "<td>" . $student['location'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No students found.</p>";
        }
        ?>
            

            
        </div>
    </div>

    <script>
       let menuicn = document.querySelector(".menuicn");
        let nav = document.querySelector(".navcontainer");
        let dynamicContent = document.getElementById("dynamicContent");


        menuicn.addEventListener("click", () => {
        nav.classList.toggle("navclose");
        loadContent('');
    });

    // Function to toggle the sidebar
    function toggleNav() {
        nav.classList.toggle("navclose");
    }

    // Function to load content based on the selected page
    function loadContent(page) {
        toggleNav(); // Close the sidebar when a link is clicked
    }
</script>
 
</body>
<?php
// Close the database connection
$conn->close();
?>

</html>