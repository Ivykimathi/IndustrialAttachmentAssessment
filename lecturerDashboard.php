<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Dashboard</title>
    <link rel="stylesheet" href="css/dashboardStyle.css">
</head>

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
                <a href="" onclick="loadContent('')">Dashboard</a>
                <a href="LecDashboardPages/viewStudent.php" onclick="loadContent('viewStudents')">View Students</a>
                <a href="LecDashboardPages/assessment.php" onclick="loadContent('assessment')">Assessment</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="#" onclick="loadContent('institute')">Profile</a>
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
        <h2>View Students assigned to</h2>
        <p>You are able to know students assigned to you based on their location.</p>
    </div>
</div>

<!-- Card 2 -->
<div class="box">
    <img src="path/to/icon2.png" alt="Icon 2">
    <div class="text">
        <h2>Assign Marks</h2>
        <p>You will now assign student their marks here..</p>
    </div>
</div>
                <div class="box">
                  <img src="path/to/icon1.png" alt="Icon 1">
                 <div class="text">
                 <h2>Assess their performance</h2>
                    <p>You can now asssess weekly performance.</p>
               </div>
            </div>

                

                <!-- Card 1 -->


<!-- Add more cards as needed -->

            </div>
            
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

            // if (page) {
                // Load content dynamically from separate PHP files
                // fetch(`${page}.php`)
                //     .then(response => response.text())
                //     .then(data => {
                //         dynamicContent.innerHTML = data;
                //     })
            //         .catch(error => {
            //             console.error('Error loading content:' error);
            //             dynamicContent.innerHTML = '<h2>Error loading content</h2>';
            //         });
            // }
        
        }
    </script>
</body>

</html>
