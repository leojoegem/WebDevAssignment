<?php
// Assuming you have a valid database connection
include "connect.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_SESSION["name"])) {
        $user_id = $_SESSION["id"];
        $email = $conn->real_escape_string($_POST["email"]);
        $inquiry_text = $conn->real_escape_string($_POST["inquiry"]);

        // Insert the inquiry into the database
        $insert_query = "INSERT INTO TravelAgency.inquiries (user_id, email, inquiry_text) VALUES ($user_id, '$email', '$inquiry_text')";
        $conn->query($insert_query);

        // Update the has_inquiry column in the users table
        $update_query = "UPDATE TravelAgency.users SET has_inquiry = TRUE WHERE id = $user_id";
        $conn->query($update_query);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore the World Travel Agency</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            background-color: #f0f0f0;
            color: #333;
        }

        .navbar {
            overflow: hidden;
            background-color: #3498db;
            display: flex;
            justify-content: space-around;
        }

        .tab {
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .tab:hover {
            background-color: #297fb8;
            color: white;
        }

        .content {
            padding: 20px;
            text-align: center;
        }

        .about-us {
            margin-top: 20px;
        }

        h1 {
            color: #3498db;
            font-size: 2em;
        }

        .service {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #3498db;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            transition: transform 0.3s ease-in-out;
        }

        .service:hover {
            transform: scale(1.1);
        }

        .service i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .contact-form {
            margin-top: 30px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 1.2em;
            margin-bottom: 8px;
            color: #333;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group button {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .form-group button:hover {
            background-color: #297fb8;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="index.php" id="home-tab" class="tab">Home</a>
    <a href="destinations.html" id="destinations-tab" class="tab">Destinations</a>
    <a href="booking.html" id="booking-tab" class="tab">Booking</a>
</div>

<div class="content">
    <h1>Explore the World Travel Agency</h1>
    <div class="about-us">
        <p>
            Welcome to our Travel Agency, where we help you explore the beauty of the world.
            Discover breathtaking destinations, plan your dream vacation, and create lasting memories with us.
        </p>
    </div>

    <!-- Placeholder images -->
    <img src="Images/beach.jpg" alt="Beach Image" width="300" height="200">
    <img src="Images/mountains.jpg" alt="Mountain Image" width="300" height="200">
    <!-- Add more placeholders as needed -->

    <!-- Services section -->
    <div class="services">
        <div class="service">
            <i class="fas fa-globe"></i>
            <p>Discover Destinations</p>
        </div>
        <div class="service">
            <i class="fas fa-plane"></i>
            <p>Book Your Flight</p>
        </div>
        <div class="service">
            <i class="fas fa-hotel"></i>
            <p>Find Accommodation</p>
        </div>
    </div>

    <!-- Contact Us form -->
    <div class="contact-form">
        <h2>Contact Us for Inquiries</h2>
        <form method="POST" action="index.php">
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="inquiry">Your Inquiry:</label>
                <textarea id="inquiry" name="inquiry" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Submit Inquiry</button>
            </div>
        </form>
    </div>
</div>

<script>
    // JavaScript to handle tab switching
    document.getElementById("home-tab").addEventListener("click", function () {
        loadPage("index.php");
    });

    document.getElementById("destinations-tab").addEventListener("click", function () {
        loadPage("destinations.html");
    });

    document.getElementById("booking-tab").addEventListener("click", function () {
        loadPage("booking.html");
    });

    // Check if the user is logged in and set the profile tab accordingly
    // Remove the PHP tags and fix the syntax errors
    if (true) {
        document.getElementById("profile-tab").href = "profileview.php";
    }

    function loadPage(page) {
        document.querySelector(".content").innerHTML = "Loading...";
        setTimeout(function () {
            fetch(page)
                .then(response => response.text())
                .then(data => {
                    document.querySelector(".content").innerHTML = data;
                })
                .catch(error => {
                    console.error("Error loading page:", error);
                    document.querySelector(".content").innerHTML = "Error loading page.";
                });
        }, 1000);
    }
</script>
</body>
</html>

