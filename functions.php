<?php
// Support de thème
add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('menus');
register_nav_menu('header', 'Menu En-tête');

// Chargement des styles et scripts
function styles_scripts() {
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/app.css');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', [], null, true);
    wp_enqueue_script('app-js', get_template_directory_uri() . '/assets/js/app.js', ['bootstrap-bundle'], null, true);
}
add_action('wp_enqueue_scripts', 'styles_scripts');

// Enregistrement du Custom Post Type "Lieu"
function register_lieu_post_type() {
    register_post_type('lieu', [
        'labels' => [
            'name' => 'Lieux',
            'singular_name' => 'Lieu',
            'add_new' => 'Ajouter un lieu',
            'add_new_item' => 'Ajouter un nouveau lieu',
            'edit_item' => 'Modifier le lieu',
            'new_item' => 'Nouveau lieu',
            'view_item' => 'Voir le lieu',
            'search_items' => 'Rechercher un lieu',
            'not_found' => 'Aucun lieu trouvé',
            'not_found_in_trash' => 'Aucun lieu trouvé dans la corbeille',
        ],
        'public' => true,
        'has_archive' => true,
        'supports' => ['title', 'editor', 'thumbnail'],
        'rewrite' => ['slug' => 'lieux'],
    ]);
}
add_action('init', 'register_lieu_post_type');

// Ajout des règles de réécriture et des variables pour evaluations2
add_action('init', function () {
    add_rewrite_rule(
        '^evaluations2/([0-9]+)/?$',
        'index.php?pagename=evaluations2&lieu_id=$matches[1]',
        'top'
    );
});

add_filter('query_vars', function ($query_vars) {
    $query_vars[] = 'lieu_id';
    return $query_vars;
});


// Ajout de métadonnées pour les lieux
function add_lieu_meta_boxes() {
    add_meta_box('lieu_details', 'Détails du lieu', 'lieu_meta_box_callback', 'lieu', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_lieu_meta_boxes');

function lieu_meta_box_callback($post) {
    $adresse = get_post_meta($post->ID, 'adresse', true);
    $rating = get_post_meta($post->ID, 'rating', true);

    echo '<label for="lieu_adresse">Adresse :</label>';
    echo '<input type="text" id="lieu_adresse" name="lieu_adresse" value="' . esc_attr($adresse) . '" class="widefat">';
    echo '<label for="lieu_rating">Note :</label>';
    echo '<input type="number" id="lieu_rating" name="lieu_rating" value="' . esc_attr($rating) . '" class="widefat" min="1" max="5">';
}

function save_lieu_meta($post_id) {
    if (array_key_exists('lieu_adresse', $_POST)) {
        update_post_meta($post_id, 'adresse', sanitize_text_field($_POST['lieu_adresse']));
    }
    if (array_key_exists('lieu_rating', $_POST)) {
        update_post_meta($post_id, 'rating', intval($_POST['lieu_rating']));
    }
}
add_action('save_post', 'save_lieu_meta');
// Handler AJAX pour enregistrer les avis
function save_review() {
    // Vérifiez si toutes les données nécessaires sont présentes
    if (
        isset($_POST['lieu_id']) &&
        isset($_POST['name']) &&
        isset($_POST['text']) &&
        isset($_POST['rating'])
    ) {
        $lieu_id = intval($_POST['lieu_id']);
        $name = sanitize_text_field($_POST['name']);
        $text = sanitize_textarea_field($_POST['text']);
        $rating = intval($_POST['rating']);

        // Vérifiez que l'ID de lieu est valide
        if (get_post_type($lieu_id) === 'lieu') {
            // Récupérez les avis existants
            $reviews = get_post_meta($lieu_id, 'lieu_reviews', true);
            if (!is_array($reviews)) {
                $reviews = [];
            }

            // Ajoutez le nouvel avis
            $reviews[] = [
                'name' => $name,
                'text' => $text,
                'rating' => $rating,
            ];

            // Enregistrez les avis dans la métadonnée
            update_post_meta($lieu_id, 'lieu_reviews', $reviews);

            // Répondez avec succès
            wp_send_json_success(['message' => 'Review saved successfully!']);
        } else {
            wp_send_json_error(['message' => 'Invalid lieu ID.']);
        }
    } else {
        wp_send_json_error(['message' => 'Missing required fields.']);
    }

    wp_die(); // Terminez la requête
}
add_action('wp_ajax_save_review', 'save_review');
add_action('wp_ajax_nopriv_save_review', 'save_review');
function my_comment_form_fields($fields) {
    $fields['rating'] = '<div class="stars">
                            <label for="rating">Note :</label>
                            <span data-value="1">★</span>
                            <span data-value="2">★</span>
                            <span data-value="3">★</span>
                            <span data-value="4">★</span>
                            <span data-value="5">★</span>
                          </div>
                          <input type="hidden" name="rating" id="rating" value="0">';
    return $fields;
}
add_filter('comment_form_default_fields', 'my_comment_form_fields');
// Ajouter un like
function add_like($post_id) {
    $current_likes = get_post_meta($post_id, '_likes', true);
    $current_likes = $current_likes ? $current_likes : 0;
    update_post_meta($post_id, '_likes', ++$current_likes);
}

// Ajouter un favori
function add_favorite($post_id) {
    $user_id = get_current_user_id();
    $favorites = get_user_meta($user_id, '_favorites', true);
    if (!$favorites) {
        $favorites = [];
    }
    if (!in_array($post_id, $favorites)) {
        $favorites[] = $post_id;
        update_user_meta($user_id, '_favorites', $favorites);
    }
}

// Utiliser ces fonctions dans ton template pour activer l'action
if (isset($_POST['like'])) {
    add_like(get_the_ID());
}

if (isset($_POST['favorite'])) {
    add_favorite(get_the_ID());
}
function add_custom_thumbnail_sizes() {
    add_theme_support('post-thumbnails');
    add_image_size('medium', 300, 200, true); // Taille pour les cartes
}
add_action('after_setup_theme', 'add_custom_thumbnail_sizes');
add_theme_support('post-thumbnails'); // Assurez-vous que les miniatures sont activées
add_image_size('custom-size', 400, 300, true); // 400x300 pixels, recadrage forcé






function create_cpt_lieu() {
    register_post_type('lieu', array(
        'labels' => array(
            'name' => 'Lieux',
            'singular_name' => 'Lieu',
            'add_new' => 'Ajouter un lieu',
            'add_new_item' => 'Ajouter un nouveau lieu',
            'edit_item' => 'Modifier le lieu',
            'new_item' => 'Nouveau lieu',
            'view_item' => 'Voir le lieu',
        ),
        'public' => true,
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'rewrite' => array('slug' => 'lieux'),
        'taxonomies' => array('category'), // Associer les catégories
        'show_in_rest' => true, // Activer l'éditeur Gutenberg si nécessaire
    ));
}
add_action('init', 'create_cpt_lieu');

function debug_post_meta($post_id) {
    error_log(print_r(get_post_meta($post_id), true));
}
add_action('save_post', 'debug_post_meta');


function register_my_menus() {
    register_nav_menus(
        array(
            'menu-principale' => __('Menu En-tête'),
        )
    );
}
add_action('init', 'register_my_menus');
function enqueue_styles_and_scripts() {
    // Ajout de Bootstrap
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-bundle', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array('jquery'), null, true);

    // Ajout des styles personnalisés
    wp_enqueue_style('theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');
function allow_heic_upload($mime_types) {
    $mime_types['heic'] = 'image/heic';
    return $mime_types;
}
add_filter('upload_mimes', 'allow_heic_upload');


function custom_mime_types($mime_types) {
    $mime_types['jpg|jpeg'] = 'image/jpeg'; // Ajout des fichiers JPEG
    $mime_types['gif'] = 'image/gif'; // Ajout des fichiers GIF
    $mime_types['heic'] = 'image/heic'; // Ajout des fichiers HEIC
    return $mime_types;
}
add_filter('upload_mimes', 'custom_mime_types');
function restrict_access_to_pages() {
    if (!is_user_logged_in()) {
        // Liste des pages protégées (remplace les slugs par ceux de tes pages)
        $protected_pages = ['workspace', 'evaluations'];

        if (is_page($protected_pages)) {
            wp_redirect(get_permalink(get_page_by_path('warning'))); // Redirige vers warning
            exit;
        }
    }
}

add_action('template_redirect', 'restrict_access_to_pages');
function register_review_post_type() {
    register_post_type('review', [
        'label' => 'Reviews',
        'public' => true,
        'show_in_menu' => true,
        'supports' => ['title', 'editor', 'custom-fields'],
        'capability_type' => 'post',
    ]);
}
add_action('init', 'register_review_post_type');
