<?php 
/** Template Name: 404 - Page */
get_header(); ?>

<style>
    /* Styles spécifiques à la page 404 */
    .page-404 {
        text-align: center;
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
        background-color: #ffff;
        color: #333;
    }

    .page-404 img {
        max-width: 0%;
        height: auto;
        margin-bottom: 20px;
    }

    .page-404 h1 {
        font-size: 48px;
        color: #333;
        margin-bottom: 20px;
    }

    .page-404 p {
        font-size: 18px;
        color: #666;
        margin-bottom: 30px;
    }

    .page-404 a {
        display: inline-block;
        text-decoration: none;
        color: #fff;
        background-color: #CEE1B6;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
    }

    .page-404 a:hover {
        background-color: #CEE1B6;    
    }
</style>

<div class="page-404">
    <!-- Image de la page 404 -->
    <img src="<?php echo get_template_directory_uri(); ?>/images/404.png" alt="404 Image">

    <!-- Message principal -->
    <h1>Oops! Page non trouvée</h1>
    <p>La page que vous recherchez n'existe pas ou a été déplacée.</p>

    <!-- Lien vers la page d'accueil -->
    <a href="<?php echo home_url('/'); ?>">Retour à l'accueil</a>
</div>

<?php get_footer(); ?>
