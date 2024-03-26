<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
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
</head>
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
                <a href="viewAllStudents.php" onclick="loadContent('viewAllStudents')">View All Students</a>
                <a href="viewAssessment.php" onclick="loadContent('viewAssessment')">View Assessments</a>
                <a href="viewAllLecturers.php" onclick="loadContent('messages')">View All Lecturers</a>
                <a href="" onclick="loadContent('settings')">Assign Lecturers</a>
                <a href="logout.php" onclick="loadContent('logout')">Logout</a>
            </nav>
        </div>
        <div class="main">
            <div class="searchbar2">
                <h2>Welcome to your Admin Dashboard!!</h2>
            </div>
            <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to assign lecturers to locations based on student locations
function assignLecturersToLocations($conn) {
    // Step 1: Retrieve student locations and their counts from the database
    $sql_students = "SELECT location, COUNT(*) as num_students FROM student_data GROUP BY location";
    $result_students = $conn->query($sql_students);

    // Step 2: Retrieve lecturers from the database
    $sql_lecturers = "SELECT id, location_assigned FROM lecturer_reg";
    $result_lecturers = $conn->query($sql_lecturers);

    // Store student counts for each location in an associative array
    $location_students = [];
    while ($row_students = $result_students->fetch_assoc()) {
        $location_students[$row_students['location']] = $row_students['num_students'];
    }

    // Assign lecturers to locations based on student location
    while ($row_lecturer = $result_lecturers->fetch_assoc()) {
        $lecturer_id = $row_lecturer['id'];
        $location_assigned = $row_lecturer['location_assigned'];

        // If the lecturer is already assigned a location, continue to the next lecturer
        if ($location_assigned !== null) {
            continue;
        }

        // Find the location with the fewest students
        $min_location = array_keys($location_students, min($location_students))[0];

        // Assign the lecturer to the location with the fewest students
        $location_assigned = $min_location;
        unset($location_students[$min_location]); // Remove assigned location from consideration

        // Update the database with the assigned location for the lecturer
        $sql_update = "UPDATE lecturer_reg SET location_assigned = '$location_assigned' WHERE id = $lecturer_id";
        $conn->query($sql_update);

        if ($conn->query($sql_update) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Inform user that lecturers have been successfully assigned
    echo "<p>Lecturers have been successfully assigned to locations.</p>";
   
}

// Check if the form is submitted for assigning lecturers
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["assign_lecturers"])) {
    // Call the function to assign lecturers to locations
    assignLecturersToLocations($conn);
}
?>

    <h2>Assign Lecturers to Locations</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="submit" name="assign_lecturers" value="Assign Lecturers">
    </form>
        </div>
    </div>
</body>
</html>





    <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="submit" name="assign_lecturers" value="Assign Lecturers">
</form> -->
    <?php
    
  // Display assigned locations for each lecturer
//   echo "<h2>Assigned Locations</h2>";
//   echo "<table border='1'>";
//   echo "<tr><th>Lecturer Name</th><th>Assigned Location</th></tr>";

//   $sql_assigned_locations = "SELECT username, location_assigned FROM lecturer_reg";
//   $result_assigned_locations = $conn->query($sql_assigned_locations);

//   if ($result_assigned_locations->num_rows > 0) {
//       while ($row = $result_assigned_locations->fetch_assoc()) {
//           echo "<tr><td>" . $row["username"] . "</td><td>" . $row["location_assigned"] . "</td></tr>";
//       }
//   } else {
//       echo "<tr><td colspan='2'>No data available</td></tr>";
//   }

//   echo "</table>";

    ?>
    