<!-- profile.php -->
<!-- <h2>Profile Content Goes Here</h2> -->
<!-- update_profile.php -->
<div class="profile-update-form">
    <h2>Update Profile</h2>
    <form id="updateProfileForm">
        <!-- Add form fields for updating profile -->
        <label for="firmName">Firm Attached To:</label>
        <input type="text" id="firmName" name="firmName" required>

        <label for="location">location:</label>
        <input type="text" id="location" name="location" required>

        <button type="submit">Update Profile</button>
    </form>
</div>

<!-- <script src="update_profile.js"></script> -->
<?php
// update_profile.php

// Connect to the database (replace these with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "industriala";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and retrieve form data
    $firmName = mysqli_real_escape_string($conn, $_POST["firmName"]);
    $location = mysqli_real_escape_string($conn, $_POST["location"]);

    // Insert the data into the database
    $sql = "INSERT INTO students (firm_name, location) VALUES ('$firmName', '$location')";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<script>
    // update_profile.js
document.getElementById('updateProfileForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Send the form data to the server using fetch
    fetch('update_profile.php', {
        method: 'POST',
        body: new FormData(event.target),
    })
    .then(response => response.text())
    .then(message => {
        alert(message); // Display the server's response
    })
    .catch(error => {
        console.error('Error updating profile:', error);
        alert('Error updating profile. Please try again.'); // Display an error message
    });
});

</script>