<footer style="background-color: #F2FBEF; padding: 30px 0; text-align: center; color: #333;">
    <div class="container">

        <!-- Icônes réseaux sociaux -->
        <div style="margin-bottom: 20px;">
    <img src="<?php echo get_template_directory_uri();?>/Logo réseaux sociaux/tiktok-logo-thin.svg" 
         alt="" 
         class="img-fluid custom-img" 
         style="width: 20px; height: auto;"> <!-- Taille réduite -->
         
    <a href="https://www.instagram.com/study._.click?igsh=MTZvb2JmbjVvMG53Yw==" target="_blank" style="text-decoration: none;">
        <img src="<?php echo get_template_directory_uri();?>/Logo réseaux sociaux/logo-instagram-noir-png.webp" 
             alt="" 
             class="img-fluid custom-img" 
             style="width: 20px; height: auto;"> <!-- Taille réduite -->
    </a>
</div>


        <!-- Citation cliquable -->
        <p style="margin: 10px auto; font-size: 18px; line-height: 1.6; max-width: 600px; font-family: 'Italiana', serif;">
            <a href="<?php echo get_permalink(get_page_by_title('about')); ?>" style="text-decoration: none; color: inherit;">
                Because every student deserves a place to thrive,<br>
                StudyClick is here to guide you.
            </a>
        </p>

        <!-- Logo principal -->
        <div style="margin: 10px auto;">
            <img src="<?php echo get_template_directory_uri(); ?>/Logo StudyClick/Capture_d_écran_2024-12-06_à_14.54.26-removebg-preview.png" 
                 alt="StudyClick Logo" 
                 class="img-fluid custom-img" 
                 style="width: 200px; height: auto;"> <!-- Taille ajustée -->
        </div>
        <br>
        <!-- Mentions légales -->
        <div style="margin-top: 20px; font-size: 14px;">
            <p>
                © StudyClick2024 
                <a href="#" style="text-decoration: none; color: #333;">Conditions générales</a> / 
                <a href="<?php echo get_permalink(get_page_by_title('Mentions légales')); ?>" style="text-decoration: none; color: #333;">Mentions légales</a>
            </p>
        </div>

    </div>
</footer>
