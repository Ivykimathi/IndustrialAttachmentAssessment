<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle automatic assignment on button click
$lecturersAssigned = false; // Variable to track whether lecturers are assigned
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['assignLecturers'])) {
        // Your logic to assign lecturers based on student location

        // Query to get available lecturers
        $availableLecturersQuery = "SELECT username FROM lecturer_reg";
        $availableLecturersResult = $conn->query($availableLecturersQuery);
//         echo "<pre>";
// var_dump($availableLecturersResult->fetch_all());
// echo "</pre>";

if ($availableLecturersResult->num_rows > 0) {
    // Fetch all available lecturers
    $lecturers = $availableLecturersResult->fetch_all(MYSQLI_ASSOC);

    foreach ($lecturers as $lecturer) {
        $lecturerUsername = $lecturer['username'];

        // Query to fetch students randomly (adjust the number as needed)
        $randomStudentsQuery = "SELECT username, reg_number, location
                                FROM student_data
                                WHERE lecturer_id IS NULL
                                ORDER BY RAND()
                                LIMIT 5";

        $randomStudentsResult = $conn->query($randomStudentsQuery);

        while ($studentRow = $randomStudentsResult->fetch_assoc()) {
            $studentUsername = $studentRow['username'];

            // Query to assign the student to the lecturer
            $assignmentQuery = "UPDATE student_data 
                                SET lecturer_id = '$lecturerUsername'
                                WHERE username = '$studentUsername'
                                AND lecturer_id IS NULL";

                if ($conn->query($assignmentQuery) === TRUE) {
                    // echo "Lecturer $lecturerUsername assigned students based on location successfully.<br>";
                    $lecturersAssigned = true;
                } else {
                    echo "Error assigning students to lecturer $lecturerUsername: " . $conn->error . "<br>";
                }
            }
        }} else {
            echo "No available lecturers.";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
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
                <a href="viewAllLecturers.php" onclick="loadContent('messages')">View All Lecturers</a>
                <a href="" onclick="loadContent('settings')">Assign Lecturers</a>
                <!-- <a href="#" onclick="loadContent('institute')">Profile</a> -->
                <a href="logout.php" onclick="loadContent('logout')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
            <div class="searchbar2">
                <h2>Welcome to your Admin Dashboard!!</h2>
                <!-- <input type="text" name="" id="" placeholder="Search"> -->
                
            </div>
             
            <!-- Form to assign lecturers based on student location -->
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button type="submit" name="assignLecturers">Assign Lecturers Based on Student Location</button>
            </form>

 <!-- Display assigned lecturers and locations in a table if the button is clicked -->
 <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <p>Students assigned to lecturers based on location successfully.</p>
    <table border="1">
        <thead>
            <tr>
                <th>Student</th>
                <th>Registration Number</th>
                <th>Location</th>
                <th>Lecturer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetch and display assigned lecturers, locations, and students
            $result = $conn->query("SELECT location, lecturer_id, username, reg_number FROM student_data WHERE lecturer_id IS NOT NULL");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['username']}</td>";
                echo "<td>{$row['reg_number']}</td>";
                echo "<td>{$row['location']}</td>";
                echo "<td>{$row['lecturer_id']}</td>";
               
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
<?php endif; ?>

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
            dynamicContent.innerHTML = ''; // Clear existing content

            if (page) {
                // Load content dynamically from separate PHP files
                // fetch(`${page}.php`)
                //     .then(response => response.text())
                //     .then(data => {
                //         dynamicContent.innerHTML = data;
                //     })
                    .catch(error => {
                        console.error('Error loading content:', error);
                        dynamicContent.innerHTML = '<h2>Error loading content</h2>';
                    });
            }
        
        }
    </script>
</body>

</html>
