<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establish a connection to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "industriala";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Process the form submission
    $username = $_POST["username"];
    $phone = $_POST["phone"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security

    // Insert data into the database
    $sql = "INSERT INTO industrysupreg (username, phone, password) VALUES ('$username', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful! You can now <a href='industrySupLogin.php'>login</a>.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
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
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: rgb(223, 222, 222);;
            color: #3498db;
            text-align: center;
            padding: 5px;
        }

        nav {
            margin-top: 1px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 20px;
            font-weight: bold;
        }

        section {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #3498db;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }
        /* Footer styles */
#footer {
  background-color: rgb(223, 222, 222);;
  color: black;
  text-align: center;
  padding: 10px 0;
}
@media screen and (max-width: 608px) {
    h1, form, label, input{
        width: 280px;
        margin-top:20px;
    }
    body{
        width:390px;
    }
}
    </style>
</head>
<body>
    <header>
        <h1>Register with us</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header><br>
    <?php
        // Display the message if it's set
        if (isset($message)) {
            echo '<div style="text-align: center;">' . $message . '</div>';
        }
        ?>
    <section>
        <h2>Supervisor Registration Form</h2>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="phone">phone:</label>
            <input type="phone" name="phone" id="phone" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <input type="submit" value="Register">
            <h3>Already have an Account? Login <a href="industrySupLogin.php">Here</a></h3>
        </form>
    </section>
     <!-- ======= Footer ======= -->
  <centre>
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <p>Thanks for visiting</p>
           <p>copyrights &copy;2024 All Rights Reserved</p>
          </div>
          </div>
          </div>
          </div>

    

          
  </footer><!-- End Footer -->
  </centre>
</body>
</html>

