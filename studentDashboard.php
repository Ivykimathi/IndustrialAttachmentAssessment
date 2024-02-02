<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
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
                <a href="" onclick="loadContent('')">Dashboard</a>
                <a href="StudentDashboardPages/updateDetails.php" onclick="loadContent('updateDetails')">Attachment Institute</a>
                <a href="StudentDashboardPages/messages.php" onclick="loadContent('messages')">Messages</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="StudentDashboardPages/profile.php" onclick="loadContent('profile')">Profile</a>
                <a href="logout.php" onclick="loadContent('institute')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
            <div class="searchbar2">
                <h2>Hey&nbsp;<?php echo htmlspecialchars($_SESSION["username"]); ?>&nbsp;,Welcome to your Dashboard!!</h2>
                <!-- <input type="text" name="" id="" placeholder="Search"> -->
                
            </div>
            

            <div id="dynamicContent" class="box-container">
                <!-- Dynamic content will be loaded here -->
                <div class="box">
    <img src="path/to/icon1.png" alt="Icon 1">
    <div class="text">
        <h2>Update your Profile</h2>
        <p>Let us know where you are attached to so that you can be allocated a supervisor.</p>
    </div>
</div>

<!-- Card 2 -->
<div class="box">
    <img src="path/to/icon2.png" alt="Icon 2">
    <div class="text">
        <h2>View Assessment Marks</h2>
        <p>You will now have the chance to view the marks awarded to you by your supervisor.</p>
    </div>
</div>
                <div class="box">
                  <img src="path/to/icon1.png" alt="Icon 1">
                 <div class="text">
                 <h2>Uploading your Logbook</h2>
                    <p>You can now upload your Industrial Attachment Logbook here😀.</p>
               </div>
            </div>

                <div class="box">
                  <img src="path/to/icon1.png" alt="Icon 1">
                 <div class="text">
                    <h2>Uploading your Report</h2>
                    <p>You can now upload your Industrial Attachment Report here😀.</p>
                 </div>
            </div>

                <!-- Card 1 -->


<!-- Add more cards as needed -->

            </div>
            
        </div>
    </div>

    <script src="./index.js"></script>
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
