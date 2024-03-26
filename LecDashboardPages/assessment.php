<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $student_name = $_POST['student_name'];
    $reg = $_POST['reg_number'];
    $lecturer_name = $_SESSION['username']; // Retrieve lecturer's name from session
    $marks = isset($_POST["marks"]) ? $_POST["marks"] : array();

    // Calculate the total score
    $lec_marks = array_sum($marks);

    // SQL to insert assessment into database
    // $sql = "INSERT INTO assessment (student_name, reg, lecturer, lec_marks) VALUES ('$student_name', '$reg', '$lecturer_name', '$lec_marks')";

    $sql_check = "SELECT * FROM assessment WHERE student_name = '$student_name' AND reg = '$reg'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    // Record exists, perform update
    $sql = "UPDATE assessment 
        SET lecturer = '$lecturer_name', lec_marks = '$lec_marks'
        WHERE student_name = '$student_name' AND reg = '$reg'";
} else {
    // Record does not exist, perform insert
    $sql = "INSERT INTO assessment (student_name, reg, lecturer, lec_marks) 
        VALUES ('$student_name', '$reg', '$lecturer', '$lec_marks')";
}

    if ($conn->query($sql) === TRUE) {
        // echo "Assessment saved successfully.";
        $formMessage="Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
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
            <div class="logo">Lecturer Dashboard</div>
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
                <a href="../lecturerDashboard.php" onclick="loadContent('')">Dashboard</a>
                <a href="viewStudent.php" onclick="loadContent('updateDetails')">View Students</a>  
                <a href="" onclick="loadContent('assessment')">Assessment</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="#" onclick="loadContent('institute')">Profile</a>
                <a href="../logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
        
        <?php
        if (isset($formMessage)) {
    echo "<p style='color: red; font-weight: bold;'>$formMessage</p>";
}
?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
               <!-- Fields for student name, registration number, place of attachment -->
    <label for="student_name">Student Name:</label>
    <input type="text" id="student_name" name="student_name">

    <label for="reg_number">Registration Number:</label>
    <input type="text" id="reg_number" name="reg_number">
<!-- 
    <label for="place_of_attachment">Place of Attachment:</label>
    <input type="text" id="place_of_attachment" name="place_of_attachment"> -->

    <br><br>
    <table border="1">
        <thead>
            <tr>
                <th>SN</th>
                <th>Rating scale: Excellent =5; Very good=4; Good =3; Fair =2; Poor =1;</th>
                <th>Marks</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Array of questions
            $questions = array(
                "Understanding of the existing network configuration and the internet 
                if exists (describe type of network and various tools that make up the 
                network(s) in the organization) and also be able to identify the various
                 servers used in assisting to connect to the local network and wide area 
                 network",
                "General ability to identify various operating systems environments used in the firm and security threats and be able to (troubleshooting and solve problems, designing solutions).",
                "Ability to identify various hardware and software tools used in the firm and be able to (troubleshooting and solve problems, designing solutions).",
                "The ability to show understanding of the organizational hierarchy, structure and culture (procedures and systems within the organization and how they contribute to success/failure of the organization)."
            );

            // Display questions in table rows
            $sn = 1;
            foreach ($questions as $question) {
                echo "<tr>";
                // SN
                echo "<td>$sn</td>";
                // Question
                echo "<td>$question</td>";
                // Marks
                echo "<td><input type='number' name='marks[]' value='0' min='0'></td>";
                echo "</tr>";
                $sn++; // Increment SN for the next question
            }
            ?>
        </tbody>
    </table>

    <br>

    <input type="submit" name="calculate" value="Assess">

</form>


    <?php
    // Check if the form is submitted
    if (isset($_POST["calculate"])) {
        // Get the marks array from the form
        $marks = isset($_POST["marks"]) ? $_POST["marks"] : array();

        // Calculate the total marks
        $totalMarks = array_sum($marks);

        // Display the total marks
        echo "<br>";
        // echo "<strong>Total Marks:</strong> $totalMarks";
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

</html>
