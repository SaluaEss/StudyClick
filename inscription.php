<?php 
/** Template Name: Inscription - Page */
get_header();
?>

<main>
  <div class="page-wrapper">
    <div class="form-wrapper">
      <?php echo do_shortcode(the_content()); ?>
      
      <form method="post" action="">
          <h2>Registration</h2>
          <input type="text" name="username" placeholder="User name" required>
          <input type="email" name="email" placeholder="E-mail" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit" name="register">Register</button>

          <!-- Lien vers connexion -->
          <div class="already-account">
              <a href="<?php echo get_permalink(get_page_by_path('connexion')); ?>">I already have an account</a>
          </div>
      </form>

      <!-- Message d'erreur ou de validation -->
      <?php
      if (isset($_POST['register'])) {
          global $wpdb;
          $username = sanitize_text_field($_POST['username']);
          $email = sanitize_email($_POST['email']);
          $password = $_POST['password'];
      
          if (!username_exists($username) && !email_exists($email)) {
              $user_id = wp_create_user($username, $password, $email);
      
              if (!is_wp_error($user_id)) {
                  wp_signon(array( // Connecte automatiquement l'utilisateur après inscription
                      'user_login'    => $username,
                      'user_password' => $password,
                      'remember'      => true,
                  ));
      
                  // Redirection vers la page d'accueil après inscription
                  wp_redirect(get_permalink(get_page_by_path('workspace'))); // Redirige vers une page après inscription
                  exit;
              } else {
                  echo "<p class='error-message'>Erreur lors de l'inscription : " . $user_id->get_error_message() . "</p>";
              }
          } else {
              echo "<p class='error-message'>Le nom d'utilisateur ou l'email existe déjà.</p>";
          }
      }
      if (!headers_sent()) {
          ob_start();
      }
      ?>
    </div>
  </div>
</main>

<style>
/* Styles généraux pour le body */
body {
    font-family: 'Inter', sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0;
}

/* Conteneur principal (page-wrapper) */
.page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

/* Formulaire */
form {
    width: 400px;
    background-color: #ffffff;
    border: 1px solid #b2d8b2;
    border-radius: 4px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Titre du formulaire */
form h2 {
    font-size: 24px;
    color: #333333;
    margin-bottom: 20px;
    font-weight: 400;
    font-family: 'Italiana', serif; /* Police Italiana */
}

/* Champs d'entrée */
form input[type="text"],
form input[type="email"],
form input[type="password"] {
    width: 90%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    background-color: #f9fff9;
    font-size: 16px;
    color: #333;
}

/* Boutons */
form button {
    width: 150px;
    padding: 15px;
    font-size: 16px;
    margin-top: 15px;
    border: 1px solid #b2d8b2;
    background-color: transparent;
    color: #333;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Effet au survol des boutons */
form button:hover {
    background-color: #b2d8b2;
    color: #fff;
}

/* Lien pour "J'ai déjà un compte" */
.already-account {
    margin-top: 15px;
    font-size: 12px;
}

.already-account a {
    color: #8DBD8B;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.already-account a:hover {
    color: #6CA46A;
}


</style>
