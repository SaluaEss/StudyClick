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
        .mentions-legales {
            font-family: Arial, sans-serif;
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
                <li><strong>Numéro BCE :</strong> N/A (Non applicable, projet étudiant)</li>
                <li><strong>BCE/TVA :</strong> BE 0738.456.123</li>
            </ul>

            <h2>2. Hébergement du site</h2>
            <ul>
                <li><strong>Hébergeur :</strong> [Nom de l'hébergeur utilisé]</li>
                <li><strong>Adresse :</strong> [Adresse de l’hébergeur]</li>
                <li><strong>Téléphone :</strong> [Téléphone de l’hébergeur]</li>
            </ul>

            <h2>3. Propriété intellectuelle</h2>
            <p>
                Tous les contenus présents sur le site (textes, images, graphismes, logo) sont la propriété exclusive de StudyClick, sauf mention contraire.
                Toute reproduction ou représentation totale ou partielle du site sans autorisation écrite est interdite.
            </p>

            <h2>4. Protection des données personnelles</h2>
            <p>
                Le site StudyClick s’engage à respecter la réglementation RGPD (Règlement Général sur la Protection des Données).
                Les données collectées (e-mails, commentaires, préférences d’utilisateur) sont utilisées uniquement dans le cadre des fonctionnalités du site.
                Pour toute question ou demande de suppression de données, contactez : contact@studyclick.com.
            </p>

            <h2>5. Responsabilité</h2>
            <p>
                StudyClick est un projet étudiant et n’engage aucune responsabilité commerciale.
                Les contenus ajoutés par les utilisateurs (adresses, commentaires, avis) sont sous leur entière responsabilité.
            </p>

            <h2>6. Contact</h2>
            <p>
                Pour toute question relative aux mentions légales ou au fonctionnement du site, contactez-nous : <br>
                <strong>E-mail :</strong> contact@studyclick.com
            </p>
        </div>
    </div>
</body>
</html>

<?php get_footer(); ?>
