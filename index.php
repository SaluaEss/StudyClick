<!-- Formulaire (formulaire.php) -->
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
    <label for="name">Nom du lieu:</label>
    <input type="text" id="name" name="name" required><br>

    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea><br>

    <label for="address">Adresse:</label>
    <input type="text" id="address" name="address" required><br>

    <label for="rating">Évaluation (1 à 5):</label>
    <input type="number" id="rating" name="rating" min="1" max="5" required><br>

    <label for="photo">Ajouter des photos:</label>
    <input type="file" id="photo" name="photo" required><br>

    <input type="submit" name="submit" value="Envoyer">
</form>

<?php
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $description = $_POST['description'];
    $address = $_POST['address'];
    $rating = $_POST['rating'];
    $photo = $_FILES['photo'];

    // Créer une publication dans WordPress
    $post_id = wp_insert_post([
        'post_title' => $name,
        'post_content' => $description,
        'post_type' => 'post',
        'post_status' => 'publish',
        'meta_input' => [
            'address' => $address,
            'rating' => $rating,
            'photo' => $photo['name']
        ]
    ]);
}
?>
