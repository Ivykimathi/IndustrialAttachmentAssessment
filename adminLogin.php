
<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate admin credentials
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "admin" && $password == "admin123") {
        // Admin login successful
        $_SESSION["admin_loggedin"] = true;
        header("location: admin.php"); // Redirect to the admin dashboard
        exit;
    } else {
        // Invalid credentials
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
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
        <h2>Admin Login Form</h2>
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
        
        <!-- You can add additional links or content here -->

    </form>
    </section>
</body>
</html>
