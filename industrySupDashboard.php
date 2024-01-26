<?php
echo"hey there"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            display: flex;
        }

        #sidebar {
            width: 250px;
            background-color: #333;
            color: white;
            padding-top: 20px;
            height: 100vh;
        }

        #content {
            flex: 1;
            padding: 20px;
        }

        #sidebar a {
            display: block;
            padding: 10px;
            color: white;
            text-decoration: none;
            border-bottom: 1px solid #555;
        }

        #sidebar a:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <a href="#" onclick="loadContent('profile')">Profile</a>
        <a href="#" onclick="loadContent('messages')">Messages</a>
        <a href="#" onclick="loadContent('settings')">Settings</a>
        <!-- Add more sidebar links as needed -->
    </div>

    <div id="content">
        <h1>Welcome to the Dashboard</h1>
        <div id="dynamicContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>

    <script>
        function loadContent(page) {
            // Simulate loading content from the server
            var contentDiv = document.getElementById('dynamicContent');
            
            switch (page) {
                case 'profile':
                    contentDiv.innerHTML = '<h2>Profile Information</h2><p>Your profile details go here.</p>';
                    break;
                case 'messages':
                    contentDiv.innerHTML = '<h2>Messages</h2><p>Your messages will be displayed here.</p>';
                    break;
                case 'settings':
                    contentDiv.innerHTML = '<h2>Settings</h2><p>Adjust your settings here.</p>';
                    break;
                // Add more cases for additional pages
                default:
                    contentDiv.innerHTML = '<h2>Invalid Page</h2>';
                    break;
            }
        }
    </script>
</body>
</html>
