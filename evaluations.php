<?php 
/** Template Name: evaluations - Page */
get_header();
?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(get_page_by_path('warning'))); // Redirige vers la page warning
    exit; // Arrête l'exécution pour éviter d'afficher du contenu
}
?>
<div class="search-bar">
    <input id="searchInput" type="text" placeholder="Rechercher..." onkeyup="filterCards()">
    <button>        <img src="<?php echo get_template_directory_uri();?>/Loupe icon/loupe-removebg-preview.png" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->

    </button>
</div>

<script>
    function filterCards() {
        const searchInput = document.getElementById("searchInput").value.toLowerCase();
        const cards = document.getElementsByClassName("evaluation-card");

        Array.from(cards).forEach(card => {
            const name = card.querySelector("h2").innerText.toLowerCase();
            if (name.includes(searchInput)) {
                card.style.display = "flex";
            } else {
                card.style.display = "none";
            }
        });
    }
</script>

<style>

    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        color: #333;
    }

    h1 {
        text-align: center;
        font-size: 36px;
        margin: 20px 0;
        font-family: 'Italiana', serif; /* Applique la police Italiana */
    }

    .evaluation-card {
        display: flex;
        border: 1px solid #c0e2c8;
        border-radius: 0px;
        margin: 20px auto;
        padding: 15px;
        max-width: 800px;
        transition: transform 0.2s;
    }

    .evaluation-card:hover {
        transform: scale(1.02);
    }

    .evaluation-card img {
        width: 300px;
        height: 230px;
        border-radius: 0px;
        margin-right: 20px;
        margin-left: 0px;
        object-fit: cover;
        padding: 0px;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
        gap: 5px; /* Réduit l'espace entre les enfants */
    }

    .card-content h2 {
        font-size: 24px;
        margin: 5px 0; /* Réduction des marges verticales */
        font-family: 'Italiana', serif; /* Applique la police Italiana à h2 */
        text-transform: uppercase; /* Met le texte en majuscules */
    }

    .card-content .location {
        font-size: 14px;
        color: #666;
        margin: 2px 0; /* Réduction de la marge entre l'adresse et les autres éléments */
    }

    .features {
        font-size: 14px;
        margin-top: 10px;
        color: #333;
    }

    .features span {
        margin-right: 15px;
        font-weight: bold;
    }

    .rating {
        display: flex;
        align-items: center;
        margin: 5px 0; /* Réduction de la marge au-dessus et en dessous */
    }

    .rating span {
        font-size: 18px;
        color: #ffc107;
        margin-right: 3px; /* Réduit l'espace entre les étoiles */
    }

    .rating span.empty {
        color: #CEE1B6;
    }

    .search-bar {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 40px;
    }

    .search-bar input {
        width: 60%;
        padding: 10px 15px;
        border: 2px solid #c0e2c8;
        border-radius: 20px;
        font-size: 16px;
    }

    .search-bar button {
        background: none;
        border: none;
        cursor: pointer;
        margin-left: -40px;
        padding: 0;
    }

    .search-bar img {
        width: 25px;
        height: 25px;
    }


</style>

<h1>Evaluations</h1>

<main>
    <?php
    // Récupération des lieux
    $args = [
        'post_type' => 'lieu',
        'posts_per_page' => -1,
    ];
    
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $lieu_id = get_the_ID(); // Récupère l'ID du lieu

            // Récupération des champs personnalisés
            $wifi = get_post_meta($lieu_id, 'wifi', true);
            $pc = get_post_meta($lieu_id, 'pc', true);
            $prises = get_post_meta($lieu_id, 'prises', true);
            $note_generale = intval(get_post_meta($lieu_id, 'note_generale', true));
            ?>
<a href="<?php echo get_permalink(get_page_by_title('Evaluations2')) . '?lieu_id=' . $lieu_id; ?>" style="text-decoration: none; color: inherit;">
<section class="evaluation-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', ['class' => 'custom-img']); ?>
                    <?php endif; ?>
                    <div class="card-content">
                        <h2><?php the_title(); ?></h2>
                        <p class="location"><?php echo get_post_meta($lieu_id, 'adresse', true); ?></p>


                        <!-- Affichage de la note -->
                        <div class="rating">
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo $i <= $note_generale ? '<span>&#9733;</span>' : '<span class="empty">&#9733;</span>';
                            }
                            ?>
                        </div>
                        
                    </div>
                    
                </section>
            </a>


            
        <?php
        endwhile;
        wp_reset_postdata();
    else :
        echo '<p>Aucun lieu trouvé.</p>';
    endif;
    ?>
</main>

<?php get_footer(); ?>
