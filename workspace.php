<?php 
/** Template Name: Workspace - Page */
get_header();
?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(get_page_by_path('warning'))); // Redirige vers la page warning
    exit; // Arrête l'exécution pour éviter d'afficher du contenu
}
?>
<main>
  <style>
   /* Chargement de la police Italiana */
@import url('https://fonts.googleapis.com/css2?family=Italiana&display=swap');

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #fff;
}

.container {
    padding: 20px;
}


.rectangle {
    width: 100%;
    height: 200px;
    background-color: #D7E2D1;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white; /* Texte en blanc */
    font-size: 24px;
    text-align: center;
    font-family: 'Italiana', serif; /* Application de la police Italiana */
    margin-bottom: 20px; /* Ajoute une marge sous le rectangle */
}

.card {
    background-color: #fff; /* Fond blanc pour la carte */
    border: 1px solid #ddd; /* Bordure discrète */
    border-radius: 8px; /* Coins arrondis */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden; /* Empêche les débordements */
}

.card:hover {
    background-color: transparent; /* Ou une autre couleur souhaitée */
    border: 1px solid #ddd; /* Réapplique la bordure si nécessaire */
    transition: none; /* Évite des animations non désirées */
}


.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Assure un espace équilibré entre les éléments */
    align-items: flex-start; /* Par défaut, aligne les éléments à gauche */
    background-color: transparent;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
}

.card-text {
    display: none;
}


.btn {
    align-self: flex-end; /* Aligne le bouton à droite */
    margin-top: 10px; /* Ajoute un espace en haut du bouton */
    background-color: #D7E2D1; /* Couleur de fond */
    color: #fff; /* Couleur du texte */
    text-decoration: none; /* Pas de soulignement */
    border: none; /* Pas de bordure */
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.btn:hover {
    background-color: #A8C8A1; /* Fond plus sombre au survol */
    transform: scale(1.05); /* Légère mise en avant */
    color: #fff
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
    border-radius: 50px;
    font-size: 16px;
}

  </style>

  <div class="rectangle">
      <p>Welcome to the Workspace section!<br>
         Explore and discover the best study spaces curated by students, for students.</p>
  </div>

  <div class="search-bar">
    <input id="searchInput" type="text" placeholder="Research..." onkeyup="filterCards()">
</div>


  
  <div class="container my-4">

     
      <div class="row">
          <?php
          $query = new WP_Query(array(
              'post_type' => 'lieu',
              'posts_per_page' => -1,
          ));

          if ($query->have_posts()) :
              while ($query->have_posts()) : $query->the_post();
                  $adresse = get_post_meta(get_the_ID(), 'adresse', true);
                  $rating = get_post_meta(get_the_ID(), 'rating', true);
                  $items = get_post_meta(get_the_ID(), 'items', true);
                  ?>
                  <div class="col-md-4 mb-4">
                      <div class="card shadow-sm">
                          <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" class="card-img-top img-fluid" alt="<?php the_title(); ?>" style="height: 200px; object-fit: cover;">

                          <?php endif; ?>
                          <div class="card-body">
                              <h5 class="card-title"><?php the_title(); ?></h5>
                              <p class="card-text"><strong>Adress :</strong> <?php echo esc_html($adresse); ?></p>
                              <p class="card-text"><strong>Note :</strong> <?php echo esc_html($rating); ?> / 5</p>
                              <p class="card-text"><strong>Items :</strong> <?php echo esc_html($items); ?></p>
                              
                              <a href="<?php the_permalink(); ?>" class="btn">See more</a>

                          </div>
                      </div>
                  </div>
              <?php endwhile;
              wp_reset_postdata();
          else :
              echo '<p>Aucun lieu trouvé.</p>';
          endif;
          ?>
      </div>
  </div>
</main>

<script>
    // Fonction de filtrage dynamique des cartes
    function filterCards() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const adresse = card.querySelector('.card-text').textContent.toLowerCase();
            if (title.includes(filter) || adresse.includes(filter)) {
                card.parentElement.style.display = ''; // Affiche la carte
            } else {
                card.parentElement.style.display = 'none'; // Masque la carte
            }
        });
    }
</script>


<?php get_footer(); ?>
