<?php 
/** Template Name: myaccount - Page */
get_header();
?>


<style>
    
    html, body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    width: 100%;
}

    body {
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #ffffff;
        color: #333;
    }

    header {
        background-color: white;
        padding: 10px 20px;
        border-bottom: 1px solid #ffffff;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo img {
        width: auto;
        height: 60px;
        object-fit: contain;
    }

    .menu {
        text-align: center;
        list-style: none;
        display: flex;
        gap: 70px;
        margin: 0 auto;
        padding: 0;
    }

    .menu li {
        display: inline;
    }

    .menu li a {
        text-decoration: none;
        color: #333;
        font-size: 16px;
        transition: color 0.3s, text-decoration 0.3s;
    }

    .menu li a:hover {
        color: #333;
        text-decoration: underline;
    }

    .profile-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100vw; /* Utilise toute la largeur de la fenêtre */
    max-width: 100%; /* Supprime toute restriction de largeur */
    background-color: #dce8c9;
    border-radius: 0;
    padding: 10px 0; /* Ajustez si nécessaire */
    margin: 0; /* Supprime toute marge */
    box-sizing: border-box; /* Inclut les bordures et paddings */
}


    .profile-picture {
       display: none;
    }

    .profile-container {
    margin: 0;
    padding: 0;
    width: 100%;
}

   

    .profile-info { 
    flex: 1; /* Conserve la mise en page actuelle */
    padding: 0 20px; /* Ajoute un espace intérieur de 20px à gauche et à droite */
    margin-left: 10px; /* Ajoute un petit espace entre la photo de profil (si présente) et le texte */
    text-align: left; /* Garde le texte aligné à gauche */


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

    .profile-stats p {
        margin: 4px 0;
        font-size: 14px;
        color: #555;
    }

    .user-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        flex: 1;
        margin-left: 10px;
    }

    .centered-details {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-top: -100px;
    }

    .edit-profile {
    margin: 20px 40px; /* Ajoute un espace autour du bouton (20px en haut et bas, 40px à gauche et droite) */
    padding: 10px 20px; /* Ajoute un espace intérieur pour rendre le bouton plus agréable */
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 25px;
    color: #333;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease, color 0.3s ease;
    display: inline-block; /* Assure que le bouton conserve sa taille */
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

    .posts, .favorites, .likes {
        display: flex;
        gap: 15px;
        flex-wrap: nowrap;
    }

    
.post-card {
    scroll-snap-align: start; /* Aligne les cartes avec le snapping */
    background-color: rgb(255, 255, 255);
    border: 1px solid #ffffff;
    border-radius: 0px;
    width: 300px;
    flex-shrink: 0; /* Empêche les cartes de se rétrécir */
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    gap: 8px;
}

.post-card img {
    width: 300px;
    height: 300px;
    border-radius: 0px;
}

    .post-info {
        text-align: left; /* Aligne le texte à gauche */
        padding: 5px 0;
        font-size: 14px;
        color: #333;
        background-color: #e7ffec;
        height: 50px;
    }

    .icon {
        font-size: 18px;
        vertical-align: middle;
    }

    footer {
        background-color: white;
        padding: 10px;
        text-align: center;
        font-size: 14px;
        border-top: 1px solid #ddd;
    }

    .favorites {
    display: flex;
    gap: 15px;
    overflow-x: auto; /* Ajoute le défilement horizontal */
    padding: 10px;
    scroll-snap-type: x mandatory; /* Active le snapping si besoin */
    -webkit-overflow-scrolling: touch; /* Rend le scroll fluide sur mobile */
}
.likes {
    display: flex;
    gap: 15px;
    overflow-x: auto; /* Ajoute le défilement horizontal */
    padding: 10px;
    scroll-snap-type: x mandatory; /* Active le snapping si besoin */
    -webkit-overflow-scrolling: touch; /* Rend le scroll fluide sur mobile */
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
                <h2><?php echo $user_info->first_name . ' ' . $user_info->last_name; ?></h2>
                <p class="username">@<?php echo $user_info->user_login; ?></p>
                <div class="profile-stats">
                    <p>Joined <?php echo date('F Y', strtotime($user_info->user_registered)); ?></p>
                   
                </div>
            </div>
            <!-- Bouton "Edit profile" -->
<button id="edit-profile" class="edit-profile">Edit profile</button>

<script>
    document.getElementById('edit-profile').addEventListener('click', function() {
        window.location.href = '<?php echo get_template_directory_uri(); ?>/editprofil.php';
    });
</script>

        </div>
    </div>

    <section class="content-section">
    <h3>Historique Posts</h3>
    <div class="post-card">
    <img src="<?php echo get_template_directory_uri();?>/images/KBR.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            
        <p class="post-info">
            <span class="post-username">@StudyClick</span><br>
            <span class="post-location">BIBLIOTHEQUE ROYALE DE BELGIQUE</span>
        </p>
    </div>
    <div class="favorites-container">
        <?php
        $args = array(
            'author' => $user_id,
            'posts_per_page' => 5
        );
        $user_posts = new WP_Query($args);
        if ($user_posts->have_posts()) :
            while ($user_posts->have_posts()) : $user_posts->the_post();
        ?>
             
        <?php
            endwhile;
        endif;
        wp_reset_postdata();
        ?>
    </div>

    <h3>Favoris <span class="icon">🔖</span></h3>
    <div class="favorites">
       
        <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/KBR2.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            <p class="post-info">
                <span class="post-username">@StudyClick</span><br>
                <span class="post-location">BIBLIOTHEQUE ROYALE DE BELGIQUE</span>
            </p>
        </div>
        <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/bigcake.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            <p class="post-info">
                <span class="post-username">@StudyClick</span><br>
                <span class="post-location">BIG CAKE</span>
            </p>
        </div>
        <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/Penta.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            <p class="post-info">
                <span class="post-username">@StudyClick</span><br>
                <span class="post-location">PENTAHOTEL</span>
            </p>
        </div>
       
        <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/barkboy.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            <p class="post-info">
                <span class="post-username">@StudyClick</span><br>
                <span class="post-location">BARKBOY</span>
            </p>
        </div>
        <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/seasons.jpeg" alt="" class="img-fluid custom-img"> <!-- Ajout des classes manquantes -->
            <p class="post-info">
                <span class="post-username">@StudyClick</span><br>
                <span class="post-location">SEASONS</span>
            </p>
        </div>
        
    </div>

    <h3>Likes <span class="icon">❤️</span></h3>
<div class="likes">
    <div class="post-card">
        <img src="<?php echo get_template_directory_uri();?>/images/Cliff miroir.JPEG" alt="" class="img-fluid custom-img">
        <p class="post-info">
            <span class="post-username">@StudyClick</span><br>
            <span class="post-location">CLIFF</span>
        </p>
   
</div>

</section>


</main>




<?php get_footer(); ?>



<main>
  <div class="container">
    <?php echo do_shortcode(the_content()); ?>
  </div>
</main>

<?php get_footer(); ?>
