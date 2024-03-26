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
// $sql = "SELECT username, reg_number FROM student_data";
$sql1= "SELECT student_name, reg,lec_marks, sup_marks FROM assessment";
// $result = $conn->query($sql);
$result1= $conn->query($sql1);
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
                <a href="viewAllStudents.php" onclick="loadContent('updateDetails')">View All Students</a>
                <a href="" onclick="loadContent('viewAssessment')">View Assessments</a>
                <a href="viewAllLecturers.php" onclick="loadContent('messages')">View All Lecturers</a>
                <a href="assignLecturers.php" onclick="loadContent('settings')">Assign Lecturers</a>
                <a href="logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
        <h2>Assessment Marks</h2>
        <?php
        if ($result1-> num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Student Name</th><th>Registration</th><th>Lecturer (x/20)</th><th>Industry Supervisor (x/75)</th><th>Total (x/30)</th></tr>";

            while ( $marks = $result1-> fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $marks['student_name'] . "</td>";
                echo "<td>" . $marks['reg'] . "</td>";
                echo "<td>" . $marks['lec_marks'] . "</td>";
                echo "<td>" . $marks['sup_marks'] . "</td>";
                $lec_marks=($marks['lec_marks'] / 20) *30;
                // echo "<td>" . $lec_marks . "<td>";
                $sup_marks=($marks['sup_marks'] / 75) *30;
                // echo "<td>" . $sup_marks . "<td>";
                $total_marks=round(($lec_marks + $sup_marks) /2);
                echo "<td>". $total_marks."</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>No students marks found.</p>";
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