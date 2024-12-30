<?php 
/** Template Name: Mentions légales - Page */
get_header();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentions Légales - StudyClick</title>
    <style>
         body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            min-height: 100vh; /* Assure que le body prend toute la hauteur de l'écran */
            display: flex;
            flex-direction: column;
        }

        footer {
            margin-top: auto; /* Pousse le footer vers le bas */
        }

        
        .mentions-legales {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }

        .mentions-legales header {
            background-color: #fff;
            color: black;
            padding: 10px 20px;
            text-align: center;
        }

        .mentions-legales .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .mentions-legales h1, .mentions-legales h2 {
            color: #93d29d;
            font-family: 'Italiana', serif; /* Police Italiana */
            font-size: 25px;
        }

        .mentions-legales ul {
            list-style-type: disc;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <div class="mentions-legales">
        <header>
            <h1>Mentions Légales</h1>
        </header>
        <div class="container">
            <h2>1. Identité et coordonnées de l'éditeur responsable</h2>
            <ul>
                <li><strong>Nom de la société :</strong> StudyClick (projet étudiant)</li>
                <li><strong>Forme juridique :</strong> Société à Résponsabilité Limitée (SRL)</li>
                <li><strong>Adresse postale du siège social :</strong> Rue de la Poste 111, 1030 Schaerbeek</li>
                <li><strong>Téléphone et e-mail :</strong> +32 (0)2 123 45 / contact@studyclick.com</li>
                <li><strong>BCE/TVA :</strong> BE 0738.456.123</li>
            </ul>

        </div>
    </div>
</body>
</html>

<?php get_footer(); ?>
