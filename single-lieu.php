<?php
/** Template Name: Single Lieu */
get_header();
?>
<div class="container my-5 single-lieu"> <!-- Ajouter la classe 'single-lieu' ici -->
<style>
    .single-lieu body {
        font-family: 'Inter', sans-serif;
        background-color: #fff;
    }
    .single-lieu .card {
        max-width: 800px;
        margin: auto;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        background: #fff;
        padding: 20px;
    }
    .single-lieu .card img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 8px;
    }
    
    .single-lieu .card h1 {
        font-size: 28px;
        font-weight: bold;
        margin: 20px 0 10px;
    }
    .single-lieu .card .adresse {
        font-size: 14px;
        color: #666;
        margin-bottom: 10px;
    }
    .single-lieu .card .rating {
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    .single-lieu .card .rating span {
        font-size: 20px;
        color: #CEE1B6;
        margin-right: 5px;
    }
    .single-lieu .card .rating span.empty {
        color: #ddd;
    }
    .single-lieu .card p {
        font-size: 14px;
        line-height: 1.6;
        color: #333;
    }
    .single-lieu .card .items {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin: 10px 0;
    }
    .single-lieu .card .items span {
        background-color: #f5f5f5;
        border-radius: 12px;
        padding: 5px 10px;
        font-size: 12px;
        color: #555;
    }

    .single-lieu .card .actions {
        display: flex;
        justify-content: flex-start;
        gap: 15px;
        margin-top: 15px;
    }
    .single-lieu .card .actions svg {
        width: 24px;
        height: 24px;
        fill: #666;
        cursor: pointer;
    }
    .single-lieu .card .actions svg:hover {
        fill: #333;
    }

    .single-lieu .card .like-button,
    .single-lieu .card .favorite-button {
        color: #FFFFFF; /* Couleur du texte et des icônes */
        background-color: #CEE1B6; /* Vert pour le fond du bouton */
        border-color: #CEE1B6; /* Vert pour les bordures */
        border-radius: 5px; /* Ajoutez un peu de courbure si souhaité */
        padding: 5px 10px; /* Taille réduite */
        display: flex; /* Pour aligner texte et icône */
        align-items: center;
        gap: 5px; /* Espace entre le texte et l'icône */
        font-size: 14px; /* Texte légèrement plus petit */
        font-weight: bold; /* Texte en gras */
        cursor: pointer; /* Change le curseur au survol */
    }

    .single-lieu .card .like-button svg,
    .single-lieu .card .favorite-button svg {
        fill: #FFFFFF; /* Couleur blanche pour les icônes SVG */
        width: 18px; /* Taille des icônes réduite */
        height: 18px;
    }

    .single-lieu .card .like-text,
    .single-lieu .card .favorite-text {
        color: #FFFFFF; /* Couleur blanche pour le texte */
    }
</style>


    <!-- Contenu principal de la page -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card">
            <!-- Image du lieu -->
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('large', ['class' => 'custom-img']); ?>
            <?php endif; ?>

            <!-- Titre et Adresse -->
            <h1><?php the_title(); ?></h1>
            <p class="adresse"><i class="fas fa-map-marker-alt"></i> <?php echo esc_html(get_post_meta(get_the_ID(), 'adresse', true)); ?></p>

            <!-- Note -->
            <div class="rating">
                <?php
                $rating = intval(get_post_meta(get_the_ID(), 'rating', true));
                for ($i = 1; $i <= 5; $i++) {
                    echo $i <= $rating ? '<span>&#9733;</span>' : '<span class="empty">&#9733;</span>';
                }
                ?>
            </div>

            <!-- Description -->
            <p><?php the_content(); ?></p>

            <!-- Items -->
            <div class="items">
                <?php
                $items = explode(', ', get_post_meta(get_the_ID(), 'items', true));
                foreach ($items as $item) {
                    echo '<span>' . esc_html($item) . '</span>';
                }
                ?>
            </div>
            <div class="actions">
    <!-- Bouton Like -->
    <button class="like-button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path></svg>
        <span class="like-text">Like</span>
    </button>

    <!-- Bouton Favoris -->
    <button class="favorite-button">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.435L23 9.168l-5.5 5.356L19.335 23 12 19.335 4.665 23 6.5 14.524 1 9.168l7.332-1.146L12 .587z"></path></svg>
        <span class="favorite-text">Favoris</span>
    </button>
</div>





        </div>
    <?php endwhile; else : ?>
        <p>Aucun contenu trouvé pour ce lieu.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>
