<?php 
 
/**
 * Template Name: Formulaire - Page
 */

get_header(); ?>
<?php
if (!is_user_logged_in()) {
    wp_redirect(get_permalink(get_page_by_path('warning'))); // Redirige vers la page warning
    exit; // Arrête l'exécution pour éviter d'afficher du contenu
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add a location</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
        }


        .container {
            max-width: 700px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
            font-size: 1.8rem;
            font-family: 'Italiana', serif; /* Applique la police Italiana */

        }

        label {
            display: block;
            font-weight: bold;
            color: #000000
            ;
            margin: 15px 0 8px;
        }

        input[type="text"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            background-color: #fafafa;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        textarea:focus {
            border-color: #5c9f5c;
            outline: none;
        }

        textarea {
            resize: none;
            height: 120px;
        }

        .photo-upload {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .photo-upload-label {
            font-weight: bold;
            color: #000000
            ;
            cursor: pointer;
        }

        .rating {
            display: flex;
            gap: 8px;
            justify-content: center;
            margin: 15px 0 20px;
        }

        .rating span {
            font-size: 30px;
            color: #cccccc;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .rating span.active {
            color: #CEE1B6;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button.cancel {
            background-color: #f2f2f2;
            color: #CEE1B6;
            margin-right: 10px;
        }

       
        button.submit {
            background-color: #CEE1B6;
            color: #ffffff;
        }

        button.submit:hover {
            background-color: #CEE1B6;
        }

        .items-list {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin: 10px 0 20px;
        }

        .items-list label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background-color: #f9f9f9;
            padding: 5px 10px;
            border-radius: 20px;
            border: 1px solid #dddddd;
            cursor: pointer;
            font-size: 14px;
        }

        .items-list input[type="checkbox"] {
            display: none;
        }

        .items-list input[type="checkbox"]:checked + span {
            font-weight: bold;
            color: #4a804a;
        }

        

    </style>
</head>
<body>
    <div class="container">
        <h1>Add a location</h1>
        <form method="POST" action="<?php echo esc_url(get_permalink()); ?>" enctype="multipart/form-data">


            <!-- Nom -->
            <label for="nom">Name *</label>
            <input type="text" id="nom" name="nom" placeholder="Enter the name of the place" required>

            <!-- Adresse -->
            <label for="adresse">Address *</label>
            <input type="text" id="adresse" name="adresse" placeholder="Enter the address of the place" required>

            <!-- Description -->
            <label for="description">Description *</label>
            <textarea id="description" name="description" placeholder="Describe the place!" required></textarea>

            <!-- Items -->
            <label>Equipment available:</label>
            <div class="items-list">
                <label>
                    <input type="checkbox" name="items[]" value="Wi-Fi">
                    <span>Wi-Fi</span>
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Prises">
                    <span>Electrical outlets</span>
                </label>
                <label>
                    <input type="checkbox" name="items[]" value="Ordinateurs">
                    <span>Computers</span>
                </label>
            </div>

            <!-- Photo -->
            <div class="photo-upload">
                <label for="photos" class="photo-upload-label">Add photos:</label>
                <input type="file" id="photos" name="photos[]" multiple accept="image/*">
            </div>

            <!-- Note -->
            <label>Note :</label>
            <div class="rating">
                <span data-value="1">&#9733;</span>
                <span data-value="2">&#9733;</span>
                <span data-value="3">&#9733;</span>
                <span data-value="4">&#9733;</span>
                <span data-value="5">&#9733;</span>
                <input type="hidden" name="rating" id="rating" value="3">
            </div>

            <!-- Boutons -->
            <div>
                <button type="button" class="cancel" onclick="window.location.href='<?php echo site_url('/'); ?>'">Cancel</button>
                <button type="submit" class="submit">Submit</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = sanitize_text_field($_POST['nom']);
            $adresse = sanitize_text_field($_POST['adresse']);
            $description = sanitize_textarea_field($_POST['description']);
            $rating = intval($_POST['rating']);
            $items = isset($_POST['items']) ? implode(', ', $_POST['items']) : 'Aucun';

            $lieu_id = wp_insert_post(array(
                'post_title'   => $nom,
                'post_content' => $description,
                'post_type'    => 'lieu',
                'post_status'  => 'publish',
                'meta_input'   => array(
                    'adresse' => $adresse,
                    'rating'  => $rating,
                    'items'   => $items,
                ),
            ));

            if ($lieu_id && !empty($_FILES['photos']['name'][0])) {
                require_once(ABSPATH . 'wp-admin/includes/file.php');
                require_once(ABSPATH . 'wp-admin/includes/image.php');
            
                foreach ($_FILES['photos']['name'] as $key => $value) {
                    $file = [
                        'name' => $_FILES['photos']['name'][$key],
                        'type' => $_FILES['photos']['type'][$key],
                        'tmp_name' => $_FILES['photos']['tmp_name'][$key],
                        'error' => $_FILES['photos']['error'][$key],
                        'size' => $_FILES['photos']['size'][$key],
                    ];
            
                    $upload = wp_handle_upload($file, ['test_form' => false]);
            
                    if (isset($upload['file'])) {
                        // Ajouter l'image comme pièce jointe
                        $attachment_id = wp_insert_attachment([
                            'post_mime_type' => $upload['type'],
                            'post_title'     => sanitize_file_name($file['name']),
                            'post_content'   => '',
                            'post_status'    => 'inherit',
                        ], $upload['file'], $lieu_id);
            
                        // Générer les métadonnées pour l'image et l'associer
                        if (!is_wp_error($attachment_id)) {
                            $attachment_data = wp_generate_attachment_metadata($attachment_id, $upload['file']);
                            wp_update_attachment_metadata($attachment_id, $attachment_data);
            
                            // Associer comme image à la une
                            set_post_thumbnail($lieu_id, $attachment_id);
                        } else {
                            error_log("Failed to insert attachment for post ID: $lieu_id");
                        }
                    } else {
                        error_log("Upload failed for file: " . $file['name']);
                    }
                }
            }

            if ($lieu_id) {
                echo '<p>Your location has been successfully published!</p>';
            } else {
                echo '<p>An error has occurred. Please try again.</p>';
            }
        }
        // Ajout à la page "Évaluations"
      
        if (isset($lieu_id) && $lieu_id) { // Vérification si $lieu_id est défini et valide
            // Associer tous les lieux à la catégorie "Évaluations"
            $evaluation_category = get_term_by('name', 'Évaluations', 'category');
            if (!$evaluation_category) {
                $evaluation_category = wp_insert_term('Évaluations', 'category');
            }
        
            if (!is_wp_error($evaluation_category)) {
                wp_set_post_terms($lieu_id, $evaluation_category['term_id'], 'category', true);
            }
        }
        if (empty($nom) || empty($adresse) || empty($description)) {
            echo '<p>Please fill in all required fields.</p>';
            return;
        }
        
        ?>
    </div>



    <script>
        // Gestion de la notation par étoiles
        const stars = document.querySelectorAll('.rating span');
        const ratingInput = document.getElementById('rating');

        stars.forEach((star) => {
            star.addEventListener('click', () => {
                stars.forEach((s) => {
                    s.classList.remove('active');
                    if (parseInt(s.getAttribute('data-value')) <= parseInt(star.getAttribute('data-value'))) {
                        s.classList.add('active');
                    }
                });
                ratingInput.value = star.getAttribute('data-value');
            });
        });

        

    </script>

    
</body>
</html>

<?php get_footer(); ?>