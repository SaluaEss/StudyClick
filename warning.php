<?php 
/** Template Name: warning - Page */
get_header();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restricted Access</title>
    <style>
    /* Appliquer uniquement au contenu de la page grâce à la classe "warning-page" */
    .warning-page {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    
    .warning-page .container {
        text-align: center;
        border: 1px solid #D0E3CE;
        padding: 40px;
        border-radius: 8px;
        background-color: #fff;
        width: 90%; /* Définit une largeur relative pour être responsive */
        max-width: 500px; /* Limite la largeur maximale */
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .warning-page .container p {
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
    }

    .warning-page .buttons {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .warning-page .button {
        padding: 10px 20px;
        border-radius: 5px;
        border: 1px solid #8DBD8B;
        font-size: 16px;
        text-decoration: none;
        text-align: center;
        display: inline-block;
        width: 120px; /* Fixe une largeur minimum pour une mise en page uniforme */
        transition: background-color 0.3s ease;
    }

    .warning-page .register {
        background-color: #fff;
        color: #333;
    }

    .warning-page .register:hover {
        background-color: #D0E3CE;
    }

    .warning-page .login {
        background-color: #8DBD8B;
        color: #fff;
        border: none;
    }

    .warning-page .login:hover {
        background-color: #6CA46A;
    }

    /* Styles pour les petits écrans */
    @media (max-width: 768px) {
        .warning-page .container {
            padding: 20px;
        }

        .warning-page .container p {
            font-size: 16px;
        }

        .warning-page .button {
            width: 100%; /* Les boutons occupent toute la largeur */
        }
    }
    </style>
</head>
<body>
    <div class="warning-page">
        <div class="container">
            <p>Sorry, you can't see this page if you are not registered</p>
            <div class="buttons">
                <!-- Register Button -->
                <a href="<?php echo get_permalink(get_page_by_path('inscription')); ?>" class="button register">Register</a>
                <!-- Login Button -->
                <a href="<?php echo get_permalink(get_page_by_path('connexion')); ?>" class="button login">Log in</a>
            </div>
        </div>
    </div>
</body>
</html>
<?php get_footer(); ?>
