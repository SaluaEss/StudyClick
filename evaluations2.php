<?php 
/** Template Name: evaluations2 - Page */
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

    h1, h2 {
        font-family: 'Italiana', serif;
        text-align: center;
    }

    .lieu-details {
        max-width: 800px;
        margin: 40px auto;
        padding: 20px;
        background-color: #ffffff;
    }

    .lieu-details h1 {
        font-size: 28px;
        margin-bottom: 10px;
    }

    .review-form {
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        background-color: #ffffff;
    }

    .review-form h2 {
        font-family: 'Italiana', serif;
        font-size: 24px;
    }

    .review-form .stars {
        font-size: 24px;
        color: #7ba983;
        margin-bottom: 10px;
        display: flex;
        gap: 5px;
        justify-content: center;
    }

    .review-form textarea {
        width: 100%;
        height: 100px;
        border: 1px solid #c0e2c8;
        border-radius: 5px;
        padding: 10px;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .review-form button {
        background-color: #94c89c;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
    }

    .review-form button:hover {
        background-color: #7ba983;
    }

    .what-they-say {
        max-width: 800px;
        margin: 40px auto;
        text-align: center;
    }

    .what-they-say h2 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .reviews {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .review-card {
        padding: 15px;
        width: 200px;
        background-color: #ffffff;
        text-align: center;
        font-family: 'Inter', sans-serif;
    }

    .review-card h3 {
        font-size: 16px;
        margin-bottom: 10px;
    }

    .review-card p {
        font-size: 14px;
        margin-bottom: 10px;
        color: #555;
        line-height: 1.4;
    }

    .review-card .stars {
        font-size: 20px;
        color: #7ba983;
    }

    .error-message {
        text-align: center;
        color: red;
        font-size: 18px;
    }
</style>

<div class="lieu-details">
    <?php
    if (isset($_GET['lieu_id'])) {
        $lieu_id = intval($_GET['lieu_id']);
        $lieu_post = get_post($lieu_id);

        if ($lieu_post && $lieu_post->post_type === 'lieu') {
            echo '<h1>' . esc_html($lieu_post->post_title) . '</h1>';
            if (has_post_thumbnail($lieu_id)) {
                echo get_the_post_thumbnail($lieu_id, 'large', ['class' => 'img-fluid']);
            }

            ?>
            <div class="review-form">
                <h2>Donnez votre avis</h2>
                <form method="post" action="">
                    <div class="stars">
                        <?php for ($i = 1; $i <= 5; $i++) : ?>
                            <span class="star" data-value="<?php echo $i; ?>">★</span>
                        <?php endfor; ?>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                    <textarea name="review_content" placeholder="Écrivez votre avis ici..." required></textarea>
                    <input type="hidden" name="lieu_id" value="<?php echo $lieu_id; ?>">
                    <button type="submit" name="submit_review">Poster un avis</button>
                </form>
            </div>
            <?php

            if (isset($_POST['submit_review']) && isset($_POST['review_content']) && isset($_POST['rating'])) {
                $review_content = sanitize_text_field($_POST['review_content']);
                $review_rating = intval($_POST['rating']);
                $lieu_id = intval($_POST['lieu_id']);

                if ($review_rating >= 1 && $review_rating <= 5) {
                    $review = [
                        'post_type' => 'review',
                        'post_title' => 'Avis pour ' . get_the_title($lieu_id),
                        'post_content' => $review_content,
                        'post_status' => 'publish',
                        'meta_input' => [
                            'lieu_id' => $lieu_id,
                            'rating' => $review_rating,
                        ],
                    ];

                    $review_id = wp_insert_post($review);
                    if ($review_id) {
                        echo '<p style="color: green; text-align: center;">Votre avis a été enregistré avec succès !</p>';
                    } else {
                        echo '<p class="error-message">Erreur lors de l\'enregistrement de l\'avis.</p>';
                    }
                } else {
                    echo '<p class="error-message">La note doit être entre 1 et 5 étoiles.</p>';
                }
            }

            ?>
            <div class="what-they-say">
                <h2>What they say</h2>
                <div class="reviews">
                    <?php
                    $args = [
                        'post_type' => 'review',
                        'meta_query' => [
                            [
                                'key' => 'lieu_id',
                                'value' => $lieu_id,
                                'compare' => '=',
                            ],
                        ],
                    ];
                    $reviews_query = new WP_Query($args);

                    if ($reviews_query->have_posts()) :
                        while ($reviews_query->have_posts()) : $reviews_query->the_post();
                            $rating = get_post_meta(get_the_ID(), 'rating', true) ?: 0;
                            ?>
                            <div class="review-card">
                                <h3><?php the_title(); ?></h3>
                                <p><?php the_content(); ?></p>
                                <div class="stars">
                                    <?php for ($i = 1; $i <= 5; $i++) : ?>
                                        <?php echo $i <= $rating ? '★' : '☆'; ?>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        echo '<p>Aucun avis pour ce lieu.</p>';
                    endif;
                    ?>
                </div>
            </div>
            <?php
        } else {
            echo '<p class="error-message">Lieu introuvable ou invalide.</p>';
        }
    } else {
        echo '<p class="error-message">Aucun lieu sélectionné.</p>';
    }
    ?>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const stars = document.querySelectorAll(".star");
        const ratingInput = document.getElementById("rating");

        stars.forEach(star => {
            star.addEventListener("click", function () {
                const value = this.getAttribute("data-value");
                ratingInput.value = value;
                stars.forEach(s => s.style.color = s.getAttribute("data-value") <= value ? "#7ba983" : "#ccc");
            });
        });
    });
</script>

<?php get_footer(); ?>
