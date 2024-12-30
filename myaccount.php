<?php 
/** Template Name: myaccount - Page */
get_header();
?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(get_page_by_path('warning'))); // Redirige vers la page warning
    exit; // Arrête l'exécution pour éviter d'afficher du contenu
}
?>



<main>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-picture">
                <?php 
                $user_id = get_current_user_id(); 
                $user_info = get_userdata($user_id);
                $avatar_url = get_avatar_url($user_id);
                ?>
            </div>
            <div class="profile-info">
                <h2><?php echo esc_html($user_info->first_name . ' ' . $user_info->last_name); ?></h2>
                <p class="username">@<?php echo esc_html($user_info->user_login); ?></p>
                <div class="profile-stats">
                    <p>Joined <?php echo date('F Y', strtotime($user_info->user_registered)); ?></p>
                </div>
            </div>
            <button id="edit-profile" class="edit-profile">Edit profile</button>
            <script>
                document.getElementById('edit-profile').addEventListener('click', function() {
                    window.location.href = '<?php echo site_url('/editprofil'); ?>';
                });
            </script>
        </div>
    </div>

    <!-- Section pour afficher les publications de l'utilisateur -->
    <section class="content-section">
        <h3>Your Posts</h3>
        <div class="grid-container">
            <?php
            // Récupérer les publications de l'utilisateur connecté
            $args = [
                'post_type' => 'lieu', // Type de publication
                'posts_per_page' => -1, // Récupérer toutes les publications
                'author' => $user_id // Filtrer par l'auteur connecté
            ];
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    ?>
                    <div class="card">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/placeholder.png" alt="No Image">
                        <?php endif; ?>
                        <div class="card-body">
                            <h4 class="card-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h4>
                            <p class="card-meta"><?php echo get_the_date(); ?></p>
                        </div>
                    </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>You haven\'t posted anything yet.</p>';
            endif;
            ?>
        </div>
    </section>

<!-- Section pour afficher les favoris -->
<section class="content-section">
    <h3>Favorites</h3>
    <div class="grid-container">
        <p>No posts have been added to favorites yet.</p>
    </div>
</section>

<!-- Section pour afficher les likes -->
<section class="content-section">
    <h3>Likes</h3>
    <div class="grid-container">
        <p>No posts have been liked yet.</p>
    </div>
</section>


            <!-- Bouton "Edit profile" -->

<script>
    document.getElementById('edit-profile').addEventListener('click', function() {
        window.location.href = '<?php echo get_template_directory_uri(); ?>/editprofil.php';
    });
</script>
    
</main>
<style>
/* Styles utilisés */
html, body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    width: 100%;
}

body {
    font-family: 'Inter', sans-serif;
    background-color: #ffffff;
    color: #333;
}

.profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100vw;
    background-color: #dce8c9;
    padding: 10px 0;
    box-sizing: border-box;
}

.profile-info {
    flex: 1;
    padding: 0 20px;
    text-align: left;
}

.profile-info h2 {
    margin: 0;
    font-size: 20px;
    color: #333;
}

.profile-info .username {
    margin: 4px 0;
    color: #888;
    font-size: 14px;
}

.edit-profile {
    margin: 20px 40px;
    padding: 10px 20px;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 25px;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.edit-profile:hover {
    background-color: #c7ddb5;
    color: #111;
}

.content-section {
    padding: 10px;
}

.content-section h3 {
    font-size: 20px;
    margin-bottom: 10px;
    color: #333;
}

.grid-container {
    display: flex;
    gap: 20px;
    overflow-x: auto; /* Défilement horizontal */
    padding: 10px;
    scroll-snap-type: x mandatory; /* Effet de snap au scroll */
    -webkit-overflow-scrolling: touch;
}

.grid-container::-webkit-scrollbar {
    height: 8px;
}

.grid-container::-webkit-scrollbar-thumb {
    background: #c7ddb5;
    border-radius: 8px;
}

.grid-container::-webkit-scrollbar-track {
    background: #f0f0f0;
}

.card {
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 6px;
    width: 260px;
    overflow: hidden;
    transition: transform 0.3s ease;
    scroll-snap-align: start; /* Alignement des cartes lors du scroll */
    flex-shrink: 0;
}

.card:hover {
    transform: translateY(-5px);
}

.card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}

.card-body {
    padding: 15px;
    text-align: left;
}

.card-title {
    font-size: 18px;
    margin: 0;
}

.card-title a {
    text-decoration: none;
    color: #333;
}

.card-title a:hover {
    color: #5692B2;
}

.card-meta {
    margin: 10px 0;
    font-size: 14px;
    color: #666;
}

h3 {
    text-align: left;
    margin: 40px 0 20px 0;
    font-family: 'Italiana', serif;
    font-size: 36px;
    color: #333;
    font-weight: normal;
}
</style>

<?php get_footer(); ?>
