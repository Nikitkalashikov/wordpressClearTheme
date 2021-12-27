<?php
/**
 * Function kalashnikof theme
 */

if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function kalashnikof_setup() {

	load_theme_textdomain( 'kalashnikof' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );
	
	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 */

	add_image_size( 'thumbnail', 300, 220, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(
		array(
			'top'    => __( 'Top Menu', 'kalashnikof' ),
			'social' => __( 'Social Links Menu', 'kalashnikof' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats',
		array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		)
	);

	// Add theme support for Custom Logo.
	add_theme_support(
		'custom-logo',
		array(
			'width'      => 153,
			'height'     => 40,
			'flex-width' => true,
		)
	);
	
	// Load regular editor styles into the new block-based editor.
	add_theme_support( 'editor-styles' );

	// Load default block styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for responsive embeds.
	add_theme_support( 'responsive-embeds' );

	// Define and register starter content to showcase the theme on new sites.
	$starter_content = array(
		// Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts'       => array(
			'home',
			'about'            => array(
				'thumbnail' => '{{image-sandwich}}',
			),
			'contact'          => array(
				'thumbnail' => '{{image-espresso}}',
			),
			'blog'             => array(
				'thumbnail' => '{{image-coffee}}',
			),
			'homepage-section' => array(
				'thumbnail' => '{{image-espresso}}',
			),
		),

		// Create the custom image attachments used as post thumbnails for pages.
		'attachments' => array(
			'image-espresso' => array(
				'post_title' => _x( 'Espresso', 'Theme starter content', 'kalashnikof' ),
				'file'       => 'assets/images/espresso.jpg', // URL relative to the template directory.
			)
		),

		// Default to a static front page and assign the front and posts pages.
		'options'     => array(
			'show_on_front'  => 'page',
			'page_on_front'  => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),

		// Set up nav menus for each of the two areas registered in the theme.
		'nav_menus'   => array(
			// Assign a menu to the "top" location.
			'top'    => array(
				'name'  => __( 'Top Menu', 'kalashnikof' ),
				'items' => array(
					'link_home', // Note that the core "home" page is actually a link in case a static front page is not used.
					'page_about',
					'page_blog',
					'page_contact',
				),
			),
		),
	);

	// Подключаем стили и скрипты
	add_action( 'wp_enqueue_scripts', 'kalashnikof_scripts' );
	function kalashnikof_scripts() {
		wp_enqueue_style( 'main-styles', get_template_directory_uri() .'/dist/css/styles.min.css', array(), '1.0.0' );
		wp_enqueue_script( 'jquery-lib', 'https://yastatic.net/jquery/3.3.1/jquery.min.js', array(), true );
    }

}
add_action( 'after_setup_theme', 'kalashnikof_setup' );

/* ===================== 
  	Register ajax scripts
======================== */
function include_front_ajax() {
	wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/dist/js/scripts.min.js', array(), '1.0.0', true );
    wp_localize_script( 'ajax-script', 'my_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
}
add_action( 'wp_enqueue_scripts', 'include_front_ajax', 99 );

/* ===================== 
  	Get unique ID
======================== */
function kalashnikof_unique_id( $prefix = '' ) {
	static $id_counter = 0;
	if ( function_exists( 'wp_unique_id' ) ) {
		return wp_unique_id( $prefix );
	}
	return $prefix . (string) ++$id_counter;
}

/* ===================== 
  	Use front-page.php when Front page displays is set to a static page
======================== */
function kalashnikof_front_page_template( $template ) {
	return is_home() ? '' : $template;
}
add_filter( 'frontpage_template', 'kalashnikof_front_page_template' );

/* ===================== 
  	Add a pingback url auto-discovery header for singularly identifiable articles
======================== */
function kalashnikof_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">' . "\n", esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kalashnikof_pingback_header' );

/* =====================
  	Add fields general setting
======================== */
add_action('admin_init', 'kalashnikof_general_section');  
function kalashnikof_general_section() {  
    add_settings_section(  
        'custom_settings_section', 
        'Контактные данные', 
        'contacts_options_callback', 
        'general' 
    );

    add_settings_field( 
        'phone', 
        'Телефон', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'phone' 
        )  
	); 

    add_settings_field( 
        'phone_2', 
        'Доп. Телефон', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'phone_2' 
        )  
	); 
	
	add_settings_field( 
        'whatsapp', 
        'WhatsApp', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'whatsapp' 
        )  
	); 

	add_settings_field( 
        'instagram', 
        'instagram', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'instagram' 
        )  
	); 

	add_settings_field( 
        'facebook', 
        'facebook', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'facebook' 
        )  
	); 

	add_settings_field( 
        'youtube', 
        'youtube', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'youtube' 
        )  
	); 

	add_settings_field( 
        'vk', 
        'vk', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'vk' 
        )  
	); 
	
	add_settings_field( 
        'address', 
        'Адрес', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'address' 
        )  
	); 

	add_settings_field( 
        'mail', 
        'Почта', 
        'custom_textbox_callback', 
        'general',
        'custom_settings_section', 
        array( 
            'mail' 
        )  
	);

    register_setting('general','phone', 'esc_attr');
    register_setting('general','phone_2', 'esc_attr');
    register_setting('general','mail', 'esc_attr');
    register_setting('general','address', 'esc_attr');
    register_setting('general','whatsapp', 'esc_attr');
    register_setting('general','instagram', 'esc_attr');
    register_setting('general','facebook', 'esc_attr');
    register_setting('general','youtube', 'esc_attr');
    register_setting('general','vk', 'esc_attr');
}

function contacts_options_callback() { 
    echo '<p>Company contacts</p>';  
}

function custom_textbox_callback($args) {  
    $option = get_option($args[0]);
	
    echo '<input type="text" id="'. $args[0] .'" name="'. $args[0] .'" value="' . $option . '" />';
}

/* =====================
  	Custom reading settings
======================== */
add_action('admin_init', 'kalashnikof_reading_section');  
function kalashnikof_reading_section(){  
    add_settings_section(  
        'custom_settings_section', 
        'Posts display settings', 
        '', 
        'reading' 
	);
	
	add_settings_field( 
        'example-post-count', 
        'Example post count per page', 
        'custom_textbox_callback', 
        'reading',
        'custom_settings_section', 
        array( 
            'example-post-count' 
        )  
	);

    register_setting('reading','example-post-count', 'esc_attr');
}

/* =====================
  	Register widget area
======================== */
function kalashnikof_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Catalog', 'kalashnikof' ),
			'id'            => 'shop-sidebar',
			'description'   => __( 'add new widget', 'kalashnikof' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<p class="widget-title">',
			'after_title'   => '</p>',
		)
	);
}
add_action( 'widgets_init', 'kalashnikof_widgets_init' );

/* =====================
  	Register custom post type
======================== */
add_action('init', 'example_custom_post_type');  
function example_custom_post_type(){  
    $labels = array(  
		 'name' => 'Example posts',
		 'singular_name' => 'Example post',
		 'add_new' => 'Add example posts',
		 'add_new_item' => 'Add post',
		 'edit_item' => 'Edit post',
		 'new_item' => 'New post',
		 'view_item' => 'View post',
		 'search_items' => 'Find post'  ,
		 'not_found' => 'Nothing find'  ,
		 'not_found_in_trash' => 'Nothing found in trush',
		 'parent_item_colon' => '' ,
		 'menu_name' => 'Example post'  
    );  
    $args = array(  
        'labels' => $labels,  
		'public' => true,  
		'publicly_queryable' => true,  
		'show_ui' => true,  
		'show_in_menu' => true,  
		'query_var' => false,  
		'rewrite' => array('slug' => 'example','with_front' => false),
		'capability_type' => 'post',  
		'has_archive' => true,  
		'hierarchical' => false,  
		'menu_position' => 5,
		'menu_icon' => 'dashicons-welcome-learn-more',
        'supports' => array('title','editor', 'thumbnail', 'custom-fields', 'excerpt')
     
    );  
	register_post_type( 'example', $args );  
	register_taxonomy("example_categories", array("example"), array("hierarchical" => true, "label" => "Example category", "singular_label" => "Categories", "rewrite" => array( 'slug' => 'example-categories', 'with_front'=> false )));
}

/* =====================
  	ACF add option page
======================== */
// add_action('acf/init', 'my_acf_op_init');
// function my_acf_op_init() {

//     // Check function exists.
//     if( function_exists('acf_add_options_page') ) {
		
// 		acf_add_options_page(array(
// 			'page_title' 	=> 'Настройка общих элементов',
// 			'menu_title'	=> 'Настройка общих элементов',
// 			'menu_slug' 	=> 'theme-other-settings',
// 			'capability'	=> 'edit_posts',
// 			'redirect'		=> false
// 		));
//     }
// }

/* =====================
  	Disabled admin bar
======================== */
show_admin_bar(false);

/* =====================
  	Function for post duplication. Dups appear as drafts. User is redirected to the edit screen
======================== */
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
	  wp_die('No post to duplicate has been supplied!');
	}
   
	/*
	 * Nonce verification
	 */
	if ( !isset( $_GET['duplicate_nonce'] ) || !wp_verify_nonce( $_GET['duplicate_nonce'], basename( __FILE__ ) ) )
	  return;
   
	/*
	 * get the original post id
	 */
	$post_id = (isset($_GET['post']) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original post data then
	 */
	$post = get_post( $post_id );
   
	/*
	 * if you don't want current user to be the new post author,
	 * then change next couple of lines to this: $new_post_author = $post->post_author;
	 */
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
   
	/*
	 * if post data exists, create the post duplicate
	 */
	if (isset( $post ) && $post != null) {
   
	  /*
	   * new post data array
	   */
	  $args = array(
		'comment_status' => $post->comment_status,
		'ping_status'    => $post->ping_status,
		'post_author'    => $new_post_author,
		'post_content'   => $post->post_content,
		'post_excerpt'   => $post->post_excerpt,
		'post_name'      => $post->post_name,
		'post_parent'    => $post->post_parent,
		'post_password'  => $post->post_password,
		'post_status'    => 'draft',
		'post_title'     => $post->post_title,
		'post_type'      => $post->post_type,
		'to_ping'        => $post->to_ping,
		'menu_order'     => $post->menu_order
	  );
   
	  /*
	   * insert the post by wp_insert_post() function
	   */
	  $new_post_id = wp_insert_post( $args );
   
	  /*
	   * get all current post terms ad set them to the new post draft
	   */
	  $taxonomies = get_object_taxonomies($post->post_type); // returns array of taxonomy names for post type, ex array("category", "post_tag");
	  foreach ($taxonomies as $taxonomy) {
		$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
		wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
	  }
   
	  /*
	   * duplicate all post meta just in two SQL queries
	   */
	  $post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
	  if (count($post_meta_infos)!=0) {
		$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
		foreach ($post_meta_infos as $meta_info) {
		  $meta_key = $meta_info->meta_key;
		  if( $meta_key == '_wp_old_slug' ) continue;
		  $meta_value = addslashes($meta_info->meta_value);
		  $sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
		}
		$sql_query.= implode(" UNION ALL ", $sql_query_sel);
		$wpdb->query($sql_query);
	  }
   
   
	  /*
	   * finally, redirect to the edit post screen for the new draft
	   */
	  wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
	  exit;
	} else {
	  wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
   
/* =====================
  	Add the duplicate link to action list for post_row_actions
======================== */
function rd_duplicate_post_link( $actions, $post ) {
if (current_user_can('edit_posts')) {
	$actions['duplicate'] = '<a href="' . wp_nonce_url('admin.php?action=rd_duplicate_post_as_draft&post=' . $post->ID, basename(__FILE__), 'duplicate_nonce' ) . '" title="Duplicate this item" rel="permalink">Duplicate</a>';
}
return $actions;
}

add_filter( 'post_row_actions', 'rd_duplicate_post_link', 10, 2 );

/* =====================
  	Child menu overlay
======================== */
class WPSE_78121_Sublevel_Walker extends Walker_Nav_Menu
{
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<div class='sub-menu-wrap'><ul class='sub-menu'>\n";
    }
    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul></div>\n";
    }
}