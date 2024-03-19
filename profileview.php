<?php
// profileview.php PHP code
session_start();

if (isset($_SESSION["name"])) {
    // Handle form submission
    if (isset($_POST["submit"])) {
        // Connect to your database (replace placeholders with your actual database details)
        $conn = new mysqli("your_host", "your_name", "your_password", "your_database");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get username from session
        $name = $_SESSION["username"];

        // Handle profile photo upload
        if (isset($_FILES["profile_photo"])) {
            $file_name = $_FILES["profile_photo"]["name"];
            $temp_name = $_FILES["profile_photo"]["tmp_name"];

            // Move the uploaded file to a directory (replace "uploads/" with your desired directory)
            move_uploaded_file($temp_name, "uploads/" . $file_name);

            // Update the profile photo in the database
            $update_sql = "UPDATE users SET profile_photo = '$file_name' WHERE name = '$name'";
            $conn->query($update_sql);
        }

        // Handle username change
        if (isset($_POST["new_username"])) {
            $new_username = $conn->real_escape_string($_POST["new_username"]);

            // Update the username in the database
            $update_name_sql = "UPDATE users SET name = '$new_name' WHERE name = '$name'";
            $conn->query($update_name_sql);

            // Update the username in the session
            $_SESSION["username"] = $new_name;

            // Update the current username
            $name = $new_name;
        }

        // Close the database connection
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .navbar {
            overflow: hidden;
            background-color: #333;
            display: flex;
            justify-content: space-around;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .tab {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .tab:hover {
            background-color: #ddd;
            color: black;
        }

        .file-input {
            margin-top: 20px;
        }

        .upload-btn-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .btn {
            border: 2px solid gray;
            color: gray;
            background-color: white;
            padding: 8px 20px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: bold;
        }

        .upload-btn-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" class="tab">Home</a>
    <a href="shop.html" class="tab">Shop</a>
    <a href="profileview.php" class="tab">Profile</a>
</div>

<div class="content">
    <div class="profile-container">
        <img src="path/to/profile-picture.jpg" alt="Profile Picture" class="profile-image">
        <div class="profile-details">
            <h2>Username: <?php echo $name; ?></h2>
            <!-- Add other user details here -->
        </div>

        <!-- Profile photo upload form -->
        <form method="POST" action="profileview.php" enctype="multipart/form-data" class="file-input">
            <div class="upload-btn-wrapper">
                <button class="btn">Upload Profile Photo</button>
                <input type="file" name="profile_photo" accept="image/*">
            </div>
            <button type="submit" name="submit">Save Changes</button>
        </form>

        <!-- Username change form -->
        <form method="POST" action="profileview.php" class="file-input">
            <label for="new_name">Change Username:</label>
            <input type="text" id="new_name" name="new_name" required>
            <button type="submit" name="submit">Change Username</button>
        </form>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Check if the URL contains a query parameter indicating a successful username change
        const urlParams = new URLSearchParams(window.location.search);
        const usernameChanged = urlParams.get('usernameChanged');

        // If the usernameChanged parameter is present, show an alert and remove it from the URL
        if (usernameChanged) {
            alert('Username changed successfully!');
            // Remove the parameter from the URL to avoid showing the alert on page refresh
            history.replaceState({}, document.title, window.location.pathname);
        }
    });
</script>

</script>
</body>
</html>
