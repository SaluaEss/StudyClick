<?php
/** Template Name: Single Lieu */
get_header();
?>
<div class="container my-5">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
        }
        .card {
            max-width: 800px;
            margin: auto;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background: #fff;
            padding: 20px;
        }
        .card img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }
        .card h1 {
            font-size: 28px;
            font-weight: bold;
            margin: 20px 0 10px;
        }
        .card .adresse {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        .card .rating {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .card .rating span {
            font-size: 20px;
            color: #ffc107;
            margin-right: 5px;
        }
        .card .rating span.empty {
            color: #ddd;
        }
        .card p {
            font-size: 14px;
            line-height: 1.6;
            color: #333;
        }
        .card .items {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 10px 0;
        }
        .card .items span {
            background-color: #f5f5f5;
            border-radius: 12px;
            padding: 5px 10px;
            font-size: 12px;
            color: #555;
        }
        /* Masquer la section des commentaires */
        .comments-section {
            display: none;
        }
    </style>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="card">
            <!-- Image du lieu -->
            <?php if (has_post_thumbnail()) : ?>
                <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
            <?php endif; ?>

            <!-- Titre et Adresse -->
            <h1><?php the_title(); ?></h1>
            <p class="adresse"><?php echo esc_html(get_post_meta(get_the_ID(), 'adresse', true)); ?></p>

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

            <!-- Commentaires masqués -->
            <div class="comments-section">
                <?php comments_template(); ?>
            </div>
        </div>
    <?php endwhile; else : ?>
        <p>Aucun contenu trouvé pour ce lieu.</p>
    <?php endif; ?>
</div>
<?php get_footer(); ?>
