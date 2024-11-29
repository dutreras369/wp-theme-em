<?php
/**
 * blog-theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package blog-theme
 */

 if ( ! defined( '_S_VERSION' ) ) {
    define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function blog_theme_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on blog-theme, use a find and replace
		* to change 'blog-theme' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'blog-theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'blog-theme' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'blog_theme_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'blog_theme_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function blog_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'blog_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'blog_theme_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function blog_theme_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'blog-theme' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'blog-theme' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'blog_theme_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function blog_theme_scripts() {
    wp_enqueue_style( 'blog-theme-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_enqueue_style( 'blog-theme-main', get_template_directory_uri(). '/assets/css/main.css', array(), _S_VERSION );

    wp_style_add_data( 'blog-theme-style', 'rtl', 'replace' );
    wp_enqueue_style( 'bootstrap-icon', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css', array(), '1.10.5' );

	// CSS de Lightbox minificado
	wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3');


    // Encolar jQuery correctamente (viene con WordPress)
    wp_enqueue_script('jquery');
    
    // Encolar Popper y Bootstrap JS después de jQuery
    wp_enqueue_script( 'bootstrap-popper', 'https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', array('jquery'), '2.9.2', true);
    wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', array('jquery'), '5.0.2', true );

    // Script personalizado que depende de jQuery
    wp_enqueue_script( 'blog-script', get_template_directory_uri() . '/assets/js/script.js', array('jquery'), _S_VERSION, true );

    // Localizar la variable ajax_object después de registrar el script
    wp_localize_script( 'blog-script', 'ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

	// Forms
	wp_enqueue_script('forms-script', get_template_directory_uri() . '/assets/js/forms.js', array('jquery'), _S_VERSION, true);
	wp_localize_script('forms-script', 'formData', array(
		'jsonUrl' => get_template_directory_uri() . '/assets/data/chile-regiones.json',
	));

	// JS de Lightbox minificado
	wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '2.11.3', true);

}
add_action( 'wp_enqueue_scripts', 'blog_theme_scripts' );

// Admin Enque
function enqueue_admin_bootstrap() {
    wp_enqueue_style('cpt-style', plugin_dir_url(__FILE__) . 'assets/css/admin/style.css', array(), '1.0.0');
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_admin_bootstrap');


/**
 * Custom Fonts.
 */

function enqueue_custom_fonts(){
	if (!is_admin()) {
		// Registrar las nuevas fuentes relacionadas con la identidad
		wp_register_style('custom-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&display=swap');
	
		// Encolar las nuevas fuentes
		wp_enqueue_style('custom-fonts');
	}	
}

add_action( 'wp_enqueue_scripts', 'enqueue_custom_fonts' );


/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Implement blocks.
 */
//require get_template_directory() . '/inc/blocks-registration.php';

/**
 * Implement shortcodes.
 */
require get_template_directory() . '/inc/shortcodes.php';

/**
 * Implement Queries.
 */
require get_template_directory() . '/inc/queries.php';

/**
 * Implement Emails.
 */
require get_template_directory() . '/inc/emails.php';

/**
 * Implement Calendar.
 */

 require get_template_directory() . '/inc/calendar.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

// Footer Widget One
function custom_footer_widget_one(){
	$args = array(
		'id' 			=> 'footer-widget-col-one',
		'name'			=> __('Footer Column One', 'text_domain'),
		'description' 	=> __('Column One', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
}
add_action('widgets_init', 'custom_footer_widget_one');


// Footer Widget two
function custom_footer_widget_two(){
	$args = array(
		'id' 			=> 'footer-widget-col-two',
		'name'			=> __('Footer Column Two', 'text_domain'),
		'description' 	=> __('Column Two', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
 }
add_action('widgets_init', 'custom_footer_widget_two');


// Footer Widget two
function custom_footer_widget_three(){
	$args = array(
		'id' 			=> 'footer-widget-col-three',
		'name'			=> __('Footer Column Three', 'text_domain'),
		'description' 	=> __('Column Three', 'text_domain'),
		'before_title'	=> '<h3 class="title">',
		'after_title'	=> '</h3>',
		'before_widget' => '<div id="%1$s" class="widget %2$s" >',
		'after_widget'	=> '</div>'																							

	);
	register_sidebar($args);
}
add_action('widgets_init', 'custom_footer_widget_three');


