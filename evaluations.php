<?php 
/** Template Name: evaluations - Page */
get_header();
?>

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
    }

    .evaluation-card {
        display: flex;
        border: 1px solid #c0e2c8;
        border-radius: 8px;
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
        border-radius: 8px;
        margin-right: 20px;
        object-fit: cover;
    }

    .card-content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .card-content h2 {
        font-size: 24px;
        margin: 10px 0;
    }

    .card-content .location {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
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
            ?>
            <a href="<?php echo get_permalink(get_page_by_path('evaluations2')) . '?lieu_id=' . $lieu_id; ?>" style="text-decoration: none; color: inherit;">
                <section class="evaluation-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                    <?php endif; ?>
                    <div class="card-content">
                        <h2><?php the_title(); ?></h2>
                        <p class="location"><?php echo get_post_meta($lieu_id, 'adresse', true); ?></p>
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
