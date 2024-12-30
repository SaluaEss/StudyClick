<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet"> <!-- Import de la police Italiana -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: white;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .profile-container {
            background-color: white;
            border: 1px solid #d3e0d3;
            width: 60%;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .form-section {
            width: 70%;
        }
        .form-section h2 {
            margin-top: 0;
            color: #4d4d4d;
            font-family: 'Italiana', serif; /* Application de la police Italiana */
            font-size: 2em;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #4d4d4d;
        }
        .form-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #d3e0d3;
            background-color: #f5fdf5;
        }
        .button-row {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .button-row button {
            padding: 10px 20px;
            border: 1px solid #d3e0d3;
            background-color: white;
            cursor: pointer;
            font-weight: bold;
            color: #4d4d4d;
        }

    </style>
</head>
<body>
    <?php
    // Gestion des mises à jour de profil
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = get_current_user_id();
        $name = sanitize_text_field($_POST['name']);
        $username = sanitize_text_field($_POST['username']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $country = sanitize_text_field($_POST['country']);
        $password = $_POST['password'];

        wp_update_user([
            'ID' => $user_id,
            'user_login' => $username,
            'user_email' => $email,
        ]);

        if (!empty($password)) {
            wp_set_password($password, $user_id);
        }

        wp_redirect(get_permalink(get_page_by_path('myaccount')));
        exit;
    }
    ?>
    <div class="main-content">
        <div class="profile-container">
            <div class="form-section">
                <h2>Edit Profile</h2> <!-- Titre ajouté -->
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Enter your username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <div class="button-row">
                        <button type="submit">Update</button>
                        <button type="button" onclick="window.history.back()">Cancel</button>
                    </div>
                    <div class="button-row">
                        <button type="button" onclick="window.location.href='<?php echo wp_logout_url(); ?>'">Log Out</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
