<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Add your CSS styles here -->
    <style>
        body{
             background: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/652/confectionary.png);
        }
        /* Example CSS styles */
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 1rem;
               background: linear-gradient(to bottom, #D5DEE7 0%, #E8EBF2 50%, #E2E7ED 100%), linear-gradient(to bottom, rgba(0,0,0,0.02) 50%, rgba(255,255,255,0.02) 61%, rgba(0,0,0,0.02) 73%), linear-gradient(33deg, rgba(255,255,255,0.20) 0%, rgba(0,0,0,0.20) 100%);
 background-blend-mode: normal,color-burn;
 box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .profile-info label {
            font-weight: bold;
        }
        .profile-image {
            max-width: 200px;
            height: auto;
            border-radius: 50%;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h2>User Profile</h2>
        <div class="profile-info">
            <?php
           
            $username = "royal_rajput";
            $email = "gr@example.com";
            $dob = "1990-01-01"; 
            $skills = "PHP, HTML, CSS";
            $favorites = "Reading, Hiking, Coding";
            $thoughts = "Life is what you make it.";
            $education = "Bachelor's Degree in Computer Science";
            $status = "Online";

          
            $profileImage = "images.jpeg"; 
            ?>
            <img src="<?php echo $profileImage; ?>" alt="Profile Image" class="profile-image">
            <p><label>Username:</label></p>
            <p><?php echo $username; ?></p>
            <label>Email:</label>
            <p><?php echo $email; ?></p>
            <label>Date of Birth:</label>
            <p><?php echo $dob; ?></p>
            <label>Skills:</label>
            <p><?php echo $skills; ?></p>
            <label>Favorites:</label>
            <p><?php echo $favorites; ?></p>
            <label>Thoughts:</label>
            <p><?php echo $thoughts; ?></p>
            <label>Education:</label>
            <p><?php echo $education; ?></p>
            <label>Status:</label>
            <p><?php echo $status; ?></p>
        </div>
        
    </div>
</body>
</html>
