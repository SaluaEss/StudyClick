<?php 
/** Template Name: Connexion - Page */
get_header();
?>

<main>
  <div class="page-wrapper">
    <div class="form-wrapper">
      <form method="post" action="">
          <h2>Connection</h2> <!-- Le titre affiché avec la police Italiana -->
          <input type="text" name="username" placeholder="User name" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit" name="login">Log in</button>
      </form>

      <!-- Lien vers inscription -->
      <div class="no-account">
          <a href="<?php echo get_permalink(get_page_by_path('inscription')); ?>">I don't have an account</a>
      </div>

      <?php
      if (isset($_POST['login'])) {
          // Récupération des identifiants
          $creds = array(
              'user_login'    => sanitize_text_field($_POST['username']),
              'user_password' => $_POST['password'],
              'remember'      => true,
          );

          // Connexion utilisateur
          $user = wp_signon($creds, false);

          if (is_wp_error($user)) {
              echo "<p class='error-message'>Incorrect username or password.</p>";
          } else {
              // Redirection vers la page d'accueil après connexion
              wp_safe_redirect(get_permalink(get_page_by_path('workspace'))); // Redirige vers une page après connexion
              exit; // Assurez-vous de quitter après la redirection
          }
      }
      ?>
    </div>
  </div>
</main>

<style>
/* Reprend le style général */
.page-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.form-wrapper {
    width: 400px;
    background-color: #ffffff;
    border: 1px solid #b2d8b2;
    border-radius: 4px;
    padding: 30px;
    text-align: center;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Appliquer la police Italiana au titre */
form h2 {
    font-size: 24px;
    color: #333333;
    margin-bottom: 20px;
    font-weight: 400;
    font-family: 'Italiana', serif; /* Police Italiana */
}

form input[type="text"],
form input[type="password"] {
    width: 90%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #e0e0e0;
    border-radius: 4px;
    background-color: #f9fff9;
    font-size: 16px;
}

form button {
    width: 150px;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #b2d8b2;
    background-color: transparent;
    color: #333;
    border-radius: 4px;
    cursor: pointer;
    transition: all 0.3s ease;
}

form button:hover {
    background-color: #b2d8b2;
    color: #fff;
}

.error-message {
    color: red;
    font-size: 14px;
    margin-top: 10px;
}


/* Lien pour "Je n'ai pas de compte" */
.no-account {
    margin-top: 20px;
    font-size: 12px;
    color: #333;
}

.no-account a {
    color: #8DBD8B;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

.no-account a:hover {
    color: #6CA46A;
}
</style>
