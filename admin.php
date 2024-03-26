




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
                <a href="" onclick="loadContent('')">Dashboard</a>
                <a href="viewAllStudents.php" onclick="loadContent('viewAllStudents')">View All Students</a>
                <a href="viewAssessment.php" onclick="loadContent('viewAssessment')">View Assessments</a>
                <a href="viewAllLecturers.php" onclick="loadContent('messages')">View All Lecturers</a>
                <a href="assignLecturers.php" onclick="loadContent('settings')">Assign Lecturers</a>
                <!-- <a href="#" onclick="loadContent('institute')">Profile</a> -->
                <a href="../logout.php" onclick="loadContent('logout')">Logout</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
            <div class="searchbar2">
                <h2>Welcome to your Admin Dashboard!!</h2>
                <!-- <input type="text" name="" id="" placeholder="Search"> -->
                
            </div>
            

            <div id="dynamicContent" class="box-container">
                <!-- Dynamic content will be loaded here -->
                <div class="box">
    <img src="path/to/icon1.png" alt="Icon 1">
    <div class="text">
        <h2>View All Students </h2>
        <p>You are able to view all students registered in the system.</p>
    </div>
</div>
<div class="box">
                  <img src="path/to/icon1.png" alt="Icon 1">
                 <div class="text">
                 <h2>Assign Lecturers</h2>
                    <p>You can assign lecturers to students based on their location.</p>
               </div>
            </div>

<div class="box">
    <img src="path/to/icon2.png" alt="Icon 2">
    <div class="text">
    <h2>View All Lecurers</h2>
        <p>You are able to view all lecturers registered in the system.</p>
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

            // if (page) {
            //     // Load content dynamically from separate PHP files
            //     // fetch(`${page}.php`)
            //     //     .then(response => response.text())
            //     //     .then(data => {
            //     //         dynamicContent.innerHTML = data;
            //     //     })
            // //         .catch(error => {
            // //             console.error('Error loading content:', error);
            // //             dynamicContent.innerHTML = '<h2>Error loading content</h2>';
            // //         });
            // // }
        
        }
    </script>

    
</body>


</html>
