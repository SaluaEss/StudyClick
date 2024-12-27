<!-- Page Lieux (lieux.php) -->
<div class="locations">
    <?php
    $args = [
        'post_type' => 'post',
        'posts_per_page' => -1,
    ];
    $locations = new WP_Query($args);
    if ($locations->have_posts()) :
        while ($locations->have_posts()) : $locations->the_post();
            $rating = get_post_meta(get_the_ID(), 'rating', true);
            $photo = get_post_meta(get_the_ID(), 'photo', true);
            ?>
            <div class="location">
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id()); ?>" alt="Lieu photo">
                <h2><?php the_title(); ?></h2>
                <p>Évaluation : <?php echo $rating; ?> / 5</p>
                <a href="<?php the_permalink(); ?>">Voir plus</a>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
