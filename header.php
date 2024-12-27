<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>
    <!-- Logo à gauche -->
    <div class="logo">
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri();?>/Logo StudyClick/Capture_d_écran_2024-12-06_à_14.54.26-removebg-preview.png" alt="Logo StudyClick" class="img-fluid">
        </a>
    </div>

    <!-- Menu au centre ou à droite -->
    <nav>
        <?php 
        wp_nav_menu( array(
            'theme_location' => 'menu-principale',
            'container' => 'ul',
            'menu_class' => 'menu',
        ) );
        ?>
    </nav>

    <!-- Image ajoutée à côté du menu avec lien vers le formulaire -->
    <div class="menu-icon">
        <a href="<?php echo get_permalink( get_page_by_title( 'Formulaire' ) ); ?>"> <!-- Remplace 'Formulaire' par le titre exact de ta page -->
            <img src="<?php echo get_template_directory_uri(); ?>/logo post/Capture_d_écran_2024-12-16_à_12.59.31-removebg-preview-removebg-preview.png" alt="Icon" class="small-icon">
        </a>
    </div>
    
</header>

<style>
   /* Applique un style uniforme au header sur toutes les pages */
   header {
    display: flex; /* Permet de garder un alignement pour les autres éléments */
    justify-content: flex-start; /* Garde le menu après le logo */
    align-items: center; /* Aligne verticalement */
    position: relative; /* Nécessaire pour que la position absolue du logo fonctionne */
    padding: 0 20px; /* Ajoute un peu de marge intérieure pour les autres éléments */
    height: 60px; /* Ajuste la hauteur du header */
}

header .logo {
    position: absolute; /* Permet de placer le logo indépendamment du reste */
    left: 0; /* Place le logo complètement à gauche */
    top: 50%; /* Centre verticalement */
    transform: translateY(-50%); /* Ajuste le centrage vertical */
}

header .logo img {
    height: 60px; /* Ajuste la taille du logo selon vos besoins */
    width: auto;
}

nav {
    flex-grow: 1; /* Le menu occupe l'espace restant */
    display: flex;
    justify-content: center; /* Centre le menu ou adaptez à vos besoins */
}

/* Menu Principal */
nav ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
}

nav ul li {
    margin: 0 15px;
}

nav ul li a {
    text-decoration: none;
    color: #333;
    font-size: 16px; /* Taille de la police pour le menu */
    padding: 10px 15px; /* Ajouter un peu d'espace autour du texte */
    display: inline-block; /* Assurer que le lien reste un bloc cliquable */
}

nav ul li a:hover {
    text-decoration: underline;
}

/* Assure-toi que le header n'est pas affecté par d'autres pages */
body.page .logo, body.page nav {
    font-size: 16px; /* S'assurer que le style reste cohérent même sur d'autres pages */
}
/* Style pour l'icône à côté du menu */
.menu-icon {
    margin-left: 5px; /* Réduit l'espacement entre le menu et l'image */
    display: flex; /* Assure l'alignement */
    align-items: center; /* Centre l'image verticalement */
}


.menu-icon img {
    width: 50px; /* Largeur fixe */
    height: 60px; /* Hauteur fixe */
    display: block; /* Évite les décalages inutiles */
}


</style>

<?php wp_footer(); ?>
</body>
</html>