<?php

// Start the session
session_start();

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    

    // Retrieve data from the form
    $institution_name = $_POST['institution_name'];
    $location = $_POST['location'];

     // Check if the user has already filled the form in the new table
     $username = $_SESSION['username'];
     $checkQuery = "SELECT * FROM student_data WHERE username = '$username'";
     $checkResult = $conn->query($checkQuery);
 
     if ($checkResult->num_rows > 0) {
         // User has already filled the form
         $formMessage = "You have already filled the form.";
     }


    // Check if the user has already filled the form
    // if (isset($_SESSION['form_filled'])) {
    //     $formMessage = "You have already filled the form. You cannot fill it twice.";
    // } 
     else {
        // Retrieve username from the session
        $username = $_SESSION['username'];

        // Fetch registration number corresponding to the username
        $regNumberQuery = "SELECT reg FROM student_registration WHERE username = '$username'";
        $regNumberResult = $conn->query($regNumberQuery);

        if ($regNumberResult->num_rows > 0) {
            $row = $regNumberResult->fetch_assoc();
            $reg_number = $row['reg'];

            // Insert data into the student_data table
            $sqlStudentData = "INSERT INTO student_data (username, reg_number, firm_name, location) 
                               VALUES ('$username', '$reg_number', '$institution_name', '$location')";

            if ($conn->query($sqlStudentData) === TRUE) {
                // Set a session variable to mark that the user has filled the form
                $_SESSION['form_filled'] = true;
                $formMessage = "Form submitted successfully!";
            } else {
                $formMessage = "Error inserting data into student_data table: " . $conn->error;
            }
        } else {
            $formMessage = "Error fetching registration number for the given username.";
        }
        $_SESSION['form_filled'] = true;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Institution Form</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
    <style>
       form {
            /* margin-top:200px; */
            width: 300px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
                <a href="" onclick="loadContent('updateDetails')">Attachment Institute</a>
                <a href="messages.php" onclick="loadContent('messages')">Messages</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="profile.php" onclick="loadContent('institute')">Profile</a>
                <a href="../logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>
   
        <div class="main">
<?php
// session_start();
// Display the form message if set
if (isset($formMessage)) {
    echo "<p style='color: red; font-weight: bold;'>$formMessage</p>";
}
?>
<h2>Where are you attached to?</h2>
<form  method="post">
    <label for="institution_name">Institution Name:</label>
    <input type="text" id="institution_name" name="institution_name" required><br>

    <label for="location">Location:</label>
    <input type="text" id="location" name="location" required><br>

    <input type="submit" value="Submit">
</form>
</div>
</div>


</body>
</html>