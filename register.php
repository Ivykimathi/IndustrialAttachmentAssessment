<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = $confirm_password = $mobile_number = "";
$username_err = $password_err = $confirm_password_err = $mobile_number_err = "";
$registration_success_msg = ""; // New variable to track registration success

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))) {
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM credentials WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                /* store result */
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate mobile number
    if (empty(trim($_POST["mobile_number"]))) {
        $mobile_number_err = "Please enter your mobile number.";
    } else {
        // Add validation for the mobile number here, if necessary
        // For example, you could check the format or length of the mobile number.
        // For now, we'll assume any input is valid.
        $mobile_number = trim($_POST["mobile_number"]);
    }

    // Check input errors before inserting into the database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($mobile_number_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO credentials (username, password, mobile_number) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_username, $param_password, $param_mobile_number);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_mobile_number = $mobile_number;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // User registered successfully
                $registration_success_msg = "Registration successful. You can now <a href='login.php'>login</a>.";

                // You may also redirect the user to the login page after a successful registration:
                // header("location: login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    // Close connection
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="style.css">
   <style>
      #containercontent {
            font: 14px sans-serif;
            display: flex;
            justify-content: center; /* Center the wrapper div horizontally */
            align-items: center; /* Center the wrapper div vertically */
            height: 100vh; /* Set the wrapper div to the full height of the viewport */
        }

        .wrapper {
            width: 360px;
            padding: 20px;
        }
        
        
    </style>
</head>

<body>

<header id="header" class="fixed-top ">
    <div class="container d-flex align-items-center">

      <h1 class="logo"><a class="nav-link scrollto">Naskiza Mental Health Awareness</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav id="navbar" class="navbar">
        <ul>
          <!-- <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li class="dropdown"><a class="nav-link scrollto"><span>Accounts</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="login.php">login</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>
          </li> -->
       
          <li><a  class="nav-link scrollto" href="adminlogin.php">Admin</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<div id="containercontent">
    <div class="wrapper"><br><br><br><br><br><br><br>
        <h2 class="text-center">Sign Up</h2>
        <p class="text-center">Please fill this form to create an account.</p>

        <!-- Display the registration success message -->
        <?php if (!empty($registration_success_msg)) : ?>
            <div class="alert alert-success"><?php echo $registration_success_msg; ?></div>
        <?php endif; ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="text" name="mobile_number" class="form-control <?php echo (!empty($mobile_number_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile_number; ?>">
                <span class="invalid-feedback"><?php echo $mobile_number_err; ?></span>
            </div>
            <div class="form-group text-center">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-secondary ml-2" value="Reset">
            </div>
            <p class="text-center">Already have an account? <a href="login.php">Login here</a>.</p>
            <a href="index.html">Go back</a>
        </form>
    </div>
    </div>
</body>

</html>
