<?php 
/** Template Name: Index - Page */
get_header(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyClick - Most Recent</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        
        .most-popular-page {
            font-family: 'Inter', sans-serif;
            color: #000;
        }

        .most-popular-page h1 {
            text-align: center;
            margin: 40px 0 20px 0;
            font-family: 'Italiana', serif;
            font-size: 36px;
            color: #333;
            font-weight: normal;
        }

        .most-popular-page .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 0 10px;
        }

        .most-popular-page .image-container {
            position: relative;
            flex: 1 1 calc(33.33% - 20px);
            margin: 1px;
            max-width: calc(33.33% - 20px);
        }

        @media (max-width: 1024px) {
            .most-popular-page .image-container {
                flex: 1 1 calc(50% - 20px);
                max-width: calc(50% - 20px);
            }
        }

        @media (max-width: 768px) {
            .most-popular-page .image-container {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }

        .most-popular-page .custom-img {
    width: 100%;
    height: 600px; /* Hauteur fixe pour toutes les images */
    object-fit: cover; /* Adapte l'image à la taille sans déformation */
    display: block;
    border-radius: 0;
    background-color: #f0f0f0; /* Couleur de fond si une image ne remplit pas */
}



        .most-popular-page .hover-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 80px;
            background-color: rgba(255, 255, 255, 1);
            opacity: 0;
            transition: opacity 0.3s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 10px;
            box-sizing: border-box;
        }

        .most-popular-page .hover-overlay p {
            margin: 0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #000;
            line-height: 1.4;
        }

        .most-popular-page .image-container:hover .hover-overlay {
            opacity: 1;
        }
        

        
    </style>
</head>
<body>
    <div class="most-popular-page">
        <!-- Titre principal -->
        <h1>Most Recent</h1>

        <!-- Galerie d'images -->
        <section class="gallery">
            <?php
            $args = array(
                'post_type'      => 'lieu', // Custom Post Type
                'posts_per_page' => 3,     // Nombre de publications à afficher
                'orderby'        => 'date',
                'order'          => 'DESC',
            );

            $recent_posts = new WP_Query($args);

            if ($recent_posts->have_posts()) :
                while ($recent_posts->have_posts()) : $recent_posts->the_post(); ?>
                    <div class="image-container">
                        <a href="<?php the_permalink(); ?>">
                        <?php 
if (has_post_thumbnail()) { 
    the_post_thumbnail('large', ['class' => 'custom-img']); 
} else { 
    echo '<img src="' . get_template_directory_uri() . '/images/default.jpg" class="custom-img" alt="Default Image">';
} 
?>
                        </a>
                        <div class="hover-overlay">
                            <p><b><?php the_title(); ?></b><br><?php echo get_post_meta(get_the_ID(), 'adresse', true); ?></p>
                        </div>
                    </div>
                <?php endwhile;
            else : ?>
                <p>No recent posts found.</p>
            <?php endif;
            wp_reset_postdata(); ?>
        </section>
    </div>
</body>
</html>
<?php get_footer(); ?>