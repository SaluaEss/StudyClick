<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">

<body <?php body_class(); ?>>

<header class="container-fluid" style="background-color: white;">
    <div class="row align-items-center">
        <!-- Logo à gauche -->
        <div class="col-4 col-md-2 text-start">
            <a href="<?php echo home_url(); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/Logo StudyClick/Capture_d_écran_2024-12-06_à_14.54.26-removebg-preview.png" alt="Logo StudyClick" class="img-fluid">
            </a>
        </div>

        <!-- Menu au centre -->
        <div class="col-6 col-md-8">
            <nav class="navbar navbar-expand-md navbar-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainMenu" aria-controls="mainMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainMenu">
                <?php 
if (has_nav_menu('menu-principale')) {
    wp_nav_menu(array(
        'theme_location' => 'menu-principale',
        'container' => false,
        'menu_class' => 'navbar-nav mx-auto gap-3',
        'add_li_class' => 'nav-item',
        'link_class' => 'nav-link',
    ));
} else {
    echo '<p style="color: red;">Aucun menu assigné. Allez dans Apparence > Menus pour configurer le menu principal.</p>';
}
?>

                </div>
            </nav>
        </div>

        <!-- Image ajoutée à côté du menu avec lien vers le formulaire -->
        <div class="col-2 text-end">
            <a href="<?php echo get_permalink( get_page_by_title( 'Formulaire' ) ); ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/logo post/Capture_d_écran_2024-12-16_à_12.59.31-removebg-preview-removebg-preview.png" alt="Icon" class="img-fluid" style="max-width: 50px; height: auto;">
            </a>
        </div>
    </div>
</header>

<style>
a {
    color: inherit;
    text-decoration: none;
}
a:hover {
    text-decoration: underline; /* Ajoute le soulignement au survol */
}

header {
    background-color: white !important; /* Forcer le fond blanc */
}

.navbar-nav {
    gap: 20px; /* Ajoute un espace de 20px entre chaque rubrique */
}

.navbar-nav .nav-link {
    font-size: 16px;
    color: #000 !important; /* Texte noir */
    font-weight: 500;
    text-decoration: none; /* Retire le soulignement par défaut */
    padding: 10px 15px;
    transition: color 0.3s, text-decoration 0.3s; /* Transition pour un effet doux */
}

.navbar-nav .nav-link:hover {
    color: #CEE1B6 !important; /* Vert clair au survol */
    text-decoration: underline; /* Ajoute le soulignement au survol */
}

.navbar-toggler {
    border: none;
}

.navbar-toggler-icon {
    background-color: #FFFFFF ;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' fill='black' class='bi bi-list' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M3.5 12.5a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1h-9zM3.5 8a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1h-9zM3.5 3.5a.5.5 0 0 1 0-1h9a.5.5 0 0 1 0 1h-9z'/%3E%3C/svg%3E");
    background-size: 100% 100%;
}

@media (max-width: 768px) {
    .navbar-collapse {
        background-color: #FFFFFF ;
        padding: 10px;
    }
}
</style>

<?php wp_footer(); ?>
</body>
</html>
