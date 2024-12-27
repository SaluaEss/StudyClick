<?php 
/** Template Name: About - Page */
get_header();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - StudyClick</title>
    <?php wp_head(); ?>
    <style>
        /* Style global */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        h1 {
            text-align: center;
            margin: 40px 0 20px 0;
            font-family: 'Italiana', serif;
            font-size: 36px;
            color: #333;
            font-weight: normal;
        }

        /* Section principale */
        .about-section {
    display: flex;
    flex-direction: column;
    align-items: center; /* Centre les éléments horizontalement */
    gap: 20px; /* Espacement entre les paragraphes */
}

        .about-section p {
            margin: 15px 0;
        }

        .left-aligned {
    width: 50%;
    text-align: left; /* Aligne le texte à gauche */
    margin: 0 auto; /* Centre horizontalement le bloc */
}

.right-aligned {
    width: 50%;
    text-align: right; /* Aligne le texte à droite */
    margin: 0 auto; /* Centre horizontalement le bloc */
}

.highlight {
    font-weight: bold; /* Met en gras ou ajoute du style */
    color: #000; /* Personnalise la couleur si nécessaire */
}
        .quote-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 50px 0;
        }

        .quote-text {
            font-family: 'Italiana', serif;
            font-size: 40px;
            flex: 1;
            padding: 20px;
            line-height: 1.8;
            margin: 50px
        }

        .quote-image img {
            max-width: 300%;
            border-radius: 0px;
            width: 700px;
            height:400px;
            margin: 0px;
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px 10px;
            margin-top: 40px;
            background-color: #f8f8f8;
            font-size: 0.9em;
            border-top: 1px solid #ddd;
        }

/* rendre responsive*/
/* Responsive pour mobiles */
@media (max-width: 480px) {
    h1 {
        font-size: 24px; /* Réduction du titre */
        margin: 20px 0;
    }

    .about-section {
        gap: 10px; /* Réduction de l'espacement entre les paragraphes */
        padding: 10px; /* Ajout de padding pour aérer */
    }

    .left-aligned, .right-aligned {
        width: 100%; /* Texte prend toute la largeur */
        text-align: left; /* Aligne tout à gauche */
        margin: 0; /* Supprime les marges */
    }

    .quote-section {
        flex-direction: column; /* Empile le texte et l'image */
        text-align: center; /* Centre le contenu */
        padding: 10px; /* Ajout d'un petit padding */
    }

    .quote-text {
        font-size: 16px; /* Taille plus petite pour la citation */
        line-height: 1.4;
        padding: 0 10px; /* Ajout de marges intérieures */
    }

    .quote-image img {
        max-width: 90%; /* Image adaptée à l'écran */
        height: auto; /* Conserve les proportions */
        margin: 10px auto 0; /* Centre l'image avec espace en haut */
    }

    footer {
        font-size: 0.8em;
        padding: 10px;
    }
}



    </style>
</head>
<body>

    <!-- Titre principal -->
    <h1>About Us</h1>

    <!-- Section "About" principale -->
    <section class="about-section">
    <p class="left-aligned">
        <?php echo esc_html__('StudyClick is a platform created by ', 'textdomain'); ?> 
        <span class="highlight">
            <?php echo esc_html__('students, for students', 'textdomain'); ?>
        </span>. 
        <?php echo esc_html__('Our goal is to make finding the perfect study spot easier and more inspiring. We believe that a good study environment can make all the difference, so we’ve built this space to connect you with others who are passionate about finding the right places to learn. Join a community of like-minded learners and start exploring StudyClick today!', 'textdomain'); ?>
    </p>

    <p class="right-aligned">
        <?php echo esc_html__('At StudyClick, discovery is at the heart of what we do. Whether you\'re looking for a ', 'textdomain'); ?> 
        <span class="highlight">
            <?php echo esc_html__('cozy café', 'textdomain'); ?>
        </span>
        <?php echo esc_html__(' to enjoy a cup of coffee while ', 'textdomain'); ?> 
        <span class="highlight">
            <?php echo esc_html__('studying', 'textdomain'); ?>
        </span>
        <?php echo esc_html__(' or a quiet corner in the library for ', 'textdomain'); ?> 
        <span class="highlight">
            <?php echo esc_html__('intense focus', 'textdomain'); ?>
        </span>. 
        <?php echo esc_html__('Our platform lets you explore an array of study-friendly locations. You can easily browse through spaces based on different criteria, read other students\' reviews, and find a spot that suits your style. If you find a new favorite spot, don’t keep it to yourself—share it with the community!', 'textdomain'); ?>
    </p>
</section>

    <!-- Section citation + image -->
    <section class="quote-section">
        <div class="quote-text">
            <p>“<br><i>Because EVERY STUDENT<br> deserves a place to thrive,<br> StudyClick is here to guide you.<i><br>”</p>
        </div>
        <div class="quote-image">
        <img src="<?php echo get_template_directory_uri();?>/images/bigcake.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
        </div>

    </section>

    <!-- Section "détaillée" -->
    <section class="about-section">
    <p class="left-aligned">
        <?php echo esc_html__('Knowing what to expect is essential, and that’s why we prioritize honest, detailed reviews. Our community is committed to giving you accurate feedback on each study location, from ambiance and accessibility to specific amenities like Wi-Fi and charging points. With our reviews, you can confidently choose where to study without any surprises, making it easier to dive into your work in a comfortable environment.', 'textdomain'); ?>
    </p>

    <p class="right-aligned">
        <?php echo esc_html__('To make sure you never miss out on exciting new spots or updates, StudyClick lets you follow specific categories that interest you most. From popular cafés to quiet libraries and everything in between, you can customize your feed and get updates about the types of locations you’re looking for. Staying in the loop has never been easier, helping you keep track of the best study places in your area.', 'textdomain'); ?>
    </p>
</section>



    <?php wp_footer(); ?>
</body>
</html>



<main>
  <div class="container">
    <?php echo do_shortcode(the_content()); ?>
  </div>
</main>

<?php get_footer(); ?>