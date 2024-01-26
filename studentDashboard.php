<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
        }

        header {
            height: 70px;
            width: 100vw;
            padding: 0 30px;
            background-color: #fafaff;
            position: fixed;
            z-index: 100;
            box-shadow: 1px 1px 15px rgba(161, 182, 253, 0.825);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logosec {
            display: flex;
            gap: 60px;
        }

        .logo {
            font-size: 27px;
            font-weight: 600;
            color: rgb(47, 141, 70);
        }

        .menuicn {
            height: 30px;
        }

        .navcontainer {
            height: calc(100vh - 70px);
            width: 250px;
            position: relative;
            overflow-y: scroll;
            overflow-x: hidden;
        }

        .nav {
            min-height: 51vh;
            width: 250px;
            background-color: #ffffff;
            position: absolute;
            top: 0;
            left: 0;
            box-shadow: 1px 1px 10px rgba(198, 189, 248, 0.825);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
            padding: 30px 0 20px 10px;
            transition: all 0.5s ease-in-out;
        }

        .nav a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s;
        }

        .nav a:hover {
            background-color: #eee;
        }

        .main-container {
            display: flex;
            width: 100vw;
            position: relative;
            top: 70px;
            z-index: 1;
        }

        .main {
            height: calc(100vh - 70px);
            width: 100%;
            overflow-y: scroll;
            overflow-x: hidden;
            padding: 40px 30px 30px 30px;
        }

        .searchbar2 {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .searchbar2 input {
            width: 250px;
            height: 42px;
            border-radius: 50px 0 0 50px;
            background-color: #ededed;
            padding: 0 20px;
            font-size: 15px;
            outline: none;
            border: none;
        }

        .searchbtn {
            width: 50px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0 50px 50px 0;
            background-color: #0c007d;
            cursor: pointer;
        }

        .box-container {
            display: flex;
            justify-content: space-evenly;
            align-items: center;
            flex-wrap: wrap;
            gap: 50px;
        }

        .box {
            height: 130px;
            width: 230px;
            border-radius: 20px;
            box-shadow: 3px 3px 10px rgba(0, 30, 87, 0.751);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            cursor: pointer;
            transition: transform 0.3s ease-in-out;
        }

        .box:hover {
            transform: scale(1.08);
        }

        .box img {
            height: 50px;
        }

        .box .text {
            color: white;
        }

        .topic {
            font-size: 13px;
            font-weight: 400;
            letter-spacing: 1px;
        }

        .topic-heading {
            font-size: 30px;
            letter-spacing: 3px;
        }
            @media (max-width: 767px) {
            .navcontainer {
                height: 100vh;
                width: 100%;
                position: fixed;
                top: 70px;
                left: -100%;
                background-color: #fff;
                transition: left 0.5s ease-in-out;
            }

            .nav {
                width: 100%;
            }

            .menuicn {
                display: none;
            }

            .hamburger {
                display: block;
            }

            .hamburger div {
                width: 30px;
                height: 3px;
                background-color: #333;
                margin: 6px 0;
                transition: 0.4s;
            }

            .navclose .hamburger div:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }

            .navclose .hamburger div:nth-child(2) {
                opacity: 0;
            }

            .navclose .hamburger div:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }

            .navclose .nav {
                left: 0;
            }
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
                <a href="#" onclick="loadContent('')">Dashboard</a>
                <a href="" onclick="loadContent('profile')">Profile</a>
                <a href="#" onclick="loadContent('messages')">Messages</a>
                <a href="#" onclick="loadContent('settings')">Settings</a>
                <a href="#" onclick="loadContent('institute')">Attachment Institute</a>

                <!-- Add more sidebar links as needed -->
            </nav>
        </div>

        <div class="main">
            <div class="searchbar2">
                <input type="text" name="" id="" placeholder="Search">
                <div class="searchbtn">
                    <img src="path/to/your/search/icon.png" class="icn srchicn" alt="search-icon">
                </div>
            </div>
            

            <div id="dynamicContent" class="box-container">
                <!-- Dynamic content will be loaded here -->
                <div class="welcome-message">
                    <h2>Welcome to Your Dashboard!</h2>
                    <p>This is your personalized dashboard. Explore the links on the sidebar to access different features.</p>
                </div>

                <div class="dashboard-info">
                    <h3>Dashboard Information</h3>
                    <p>Here you can find useful information about your dashboard and its features.</p>
                </div>
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
                fetch(`${page}.php`)
                    .then(response => response.text())
                    .then(data => {
                        dynamicContent.innerHTML = data;
                    })
                    .catch(error => {
                        console.error('Error loading content:', error);
                        dynamicContent.innerHTML = '<h2>Error loading content</h2>';
                    });
            }
        
        else {
                // Load content from main.php
                dynamicContent.innerHTML = `<div class="welcome-message">
                        <h2>Welcome to Your Dashboard!</h2>
                        <p>This is your personalized dashboard. Explore the links on the sidebar to access different features.</p>
                    </div>

                    <div class="dashboard-info">
                        <h3>Dashboard Information</h3>
                        <p>Here you can find useful information about your dashboard and its features.</p>
                    </div>`;
            }
        }
    </script>
</body>

</html>
