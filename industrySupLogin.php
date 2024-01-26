<?php
session_start();

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

    $entered_username = $_POST["username"];
    $entered_password = $_POST["password"];

    // Retrieve user data from the database based on the entered username
    $sql = "SELECT id, username, password FROM industrysupreg WHERE username = '$entered_username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, verify the password
        $row = $result->fetch_assoc();
        $hashed_password = $row["password"];
        
        // Hash the entered password
        $hashed_entered_password = password_hash($entered_password, PASSWORD_DEFAULT);

        if (password_verify($entered_password, $hashed_password)) {
            // Password is correct, redirect to the dashboard or desired page
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["username"] = $row["username"];
            header("Location: industrySupDashboard.php");
            exit();
        } else {
            $error_message = "Incorrect password. Please try again.";
        }
    } else {
        $error_message = "Username not found. Please register or enter a valid username.";
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
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: rgb(223, 222, 222);
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

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Industrial Attachment Assessment Platform</h1>
        <nav>
            <a href="index.php">Home</a>
        </nav>
    </header><br>

    <section>
        <h2>Supervisor Login Form</h2>
        <?php
        if (isset($error_message)) {
            echo '<div class="error-message">' . $error_message . '</div>';
        }
        ?>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" value="Login">
            
            <h3>Don't have an Account? Register <a href="industrySupReg.php">Here</a></h3>
            
        </form>
    </section>
</body>
</html>
