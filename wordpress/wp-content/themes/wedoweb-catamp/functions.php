<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('news-size', 480, 335, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    /*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_template_directory_uri() . '/img/bg.jpg'
    ));*/

    // Add Support for Custom Header - Uncomment below if you're going to use
    /*add_theme_support('custom-header', array(
	'default-image'			=> get_template_directory_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
    ));*/

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Localisation Support
    load_theme_textdomain('html5blank', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/
function display_navigation($menuKey)
{
    if (($locations = get_nav_menu_locations()) && isset($locations[$menuKey])) {
        $menu = wp_get_nav_menu_object($locations[$menuKey]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
//        var_dump($menu_items);
        $menu_list = '<ul>';
        foreach ($menu_items as $item) {
            $menu_list .= "<li><a href='{$item->url}'>{$item->title}</a></li>";
        }

        $menu_list .= '</ul>';

        echo $menu_list;
    }
}

function display_contact_navigation($menuKey)
{
    if (($locations = get_nav_menu_locations()) && isset($locations[$menuKey])) {
        $menu = wp_get_nav_menu_object($locations[$menuKey]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
//        var_dump($menu_items);
        $menu_list = '<ul class="about-as">';
        foreach ($menu_items as $item) {
            $menu_list .= "<li><a href='{$item->url}'>{$item->title}</a></li>";
        }

        $menu_list .= '</ul>';

        echo $menu_list;
    }
}
// HTML5 Blank navigation
function html5blank_nav()
{
	wp_nav_menu(
	array(
		'theme_location'  => 'header-menu',
		'menu'            => '',
		'container'       => 'div',
		'container_class' => 'menu-{menu slug}-container',
		'container_id'    => '',
		'menu_class'      => 'menu',
		'menu_id'         => '',
		'echo'            => true,
		'fallback_cb'     => 'wp_page_menu',
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul>%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
		)
	);
}

// Load HTML5 Blank scripts (header.php)
function html5blank_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    	wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        wp_enqueue_script('conditionizr'); // Enqueue it!

        wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        $js_version = file_get_contents("src/js-manifest.json", FILE_USE_INCLUDE_PATH);
        $js_manifest = json_decode($js_version, true);
//        var_dump($js_manifest);
        wp_register_script('wedowebcatampscripts', get_template_directory_uri() . '/js/vendor.js', array(), '1.0.0', true); // Custom scripts
        wp_enqueue_script('wedowebcatampscripts'); // Enqueue it!

        wp_register_script('wedowebcatampscripts2', get_template_directory_uri() . '/js/' . $js_manifest['app.js'], array(), '1.0.0', true); // Custom scripts
        wp_enqueue_script('wedowebcatampscripts2'); // Enqueue it!

//        wp_register_script('html5blankscripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
//        wp_enqueue_script('html5blankscripts'); // Enqueue it!
    }
}

// Load HTML5 Blank conditional scripts
function html5blank_conditional_scripts()
{
    if (is_page('pagenamehere')) {
        wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
        wp_enqueue_script('scriptname'); // Enqueue it!
    }
}

// Load HTML5 Blank styles
function html5blank_styles()
{
    $css_version = file_get_contents("src/css-manifest.json", FILE_USE_INCLUDE_PATH);
    $css_manifest = json_decode($css_version, true);

    wp_register_style('normalize', get_template_directory_uri() . '/normalize.css', array(), '1.0', 'all');
    wp_enqueue_style('normalize'); // Enqueue it!

    wp_register_style('html5blank', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('html5blank'); // Enqueue it!

    wp_register_style('wedowebcatamp', get_template_directory_uri() . '/css/' . $css_manifest['app.css'], array(), '1.0', 'all');
    wp_enqueue_style('wedowebcatamp'); // Enqueue it!
}

// Register HTML5 Blank Navigation
function register_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'catamp-menu' => __('Catamp Menu', 'html5blank'), // Main Navigation
        'cipet-menu' => __('Cipet Menu', 'html5blank'), // Sidebar Navigation
        'lnhcursos-menu' => __('LnhCursos Menu', 'html5blank') // Extra Navigation if needed (duplicate as many as you need!)
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
//    var_dump(get_post_meta($post->ID,'_wp_page_template',true));
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } else if (is_page_template('templates/template-home-lnh.php')) {
        $classes[] = 'lnh';
    } else if (is_page_template('templates/template-noticias-cipet.php')) {
        $classes[] = 'cipet inner';
    } else if (is_page_template('templates/template-noticias-lnh.php')) {
        $classes[] = 'lnh inner';
    } else if (is_page()) {
        $parentId = wp_get_post_parent_id($post->ID);
        $headerType = '';
        if($parentId) {
            $parentPage = get_post($parentId);
            $headerType = $parentPage->post_name;
        }
        if($headerType == 'cipet') {
            $classes[] = 'cipet inner';
        }
        else if($headerType == 'lnhcursos') {
            $classes[] = 'lnh inner';
        }
        $classes[] = sanitize_html_class($post->post_name);
    } else if (is_singular()) {

        if (is_singular('noticia')) {

            $isFromCatamp = 0;

            $newsGroup = get_field('news-group', $post->ID);
            if($newsGroup){

                $isFromCatamp = array_search('catamp', $newsGroup);
                if($isFromCatamp === 0 || count($newsGroup) > 1) {
                    $classes[] = 'index';
                }
                else {
                    if(array_search('cipet', $newsGroup) === 0) {
                        $classes[] = 'cipet inner';
                    }
                    else if(array_search('lnhcursos', $newsGroup) === 0) {
                        $classes[] = 'lnh inner';
                    }
                    else {
                        $classes[] = sanitize_html_class($post->post_name);
                    }
                }

            }

        }else if (is_singular('indices')) {



        }


    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'html5blank'),
        'description' => __('Description for this widget-area...', 'html5blank'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function html5wp_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function html5wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using html5wp_excerpt('html5wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using html5wp_excerpt('html5wp_custom_post');
function html5wp_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function html5wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function html5_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'html5blank') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function html5_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function html5blankgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function html5blankcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
    <!-- heads up: starting < for the html tag (li or div) in the next line: -->
    <<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

function remove_page_supports(){
//    var_dump(get_page_template_slug());
    $template = get_page_template_slug();

    if($template == 'templates/template-home-catamp.php' ||
        $template == 'templates/template-home-cipet.php' ||
        $template == 'templates/template-home-lnh.php' ||
        $template == 'templates/template-noticias-cipet.php' ||
        $template == 'templates/template-noticias-catamp.php' ||
        $template == 'templates/template-noticias-lnh.php' ||
        $template == 'templates/template-inner-common.php' ||
        $template == 'templates/template-agenda.php' ||
        $template == 'templates/template-estadisticas.php' ||
        $template == 'templates/template-boletin.php' ||
        $template == 'templates/template-about.php' ||
        $template == 'templates/template-licencia.php' ||
        $template == 'templates/template-calidad.php' ||
        $template == 'templates/template-join.php' ||
        $template == 'templates/template-material.php' ||
        $template == 'templates/template-questions.php') {
        remove_post_type_support('page', 'editor');
    }
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'html5blank_header_scripts'); // Add Custom Scripts to wp_head
add_action('wp_print_scripts', 'html5blank_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'html5blank_styles'); // Add Theme Stylesheet
add_action('init', 'register_menu'); // Add HTML5 Blank Menu
//add_action('init', 'create_post_type_html5'); // Add our HTML5 Blank Custom Post Type
//add_action( 'init', 'create_servicio_cpt', 0 );
add_action( 'init', 'create_noticia_cpt', 0 );
add_action( 'init', 'create_indice_cpt', 0 );
add_action('init', 'tag_rewrite', 10, 0);


add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'html5wp_pagination'); // Add our HTML5 Pagination
add_action('admin_head', 'remove_page_supports');
add_action( 'admin_menu', 'remove_menus' );

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'html5blankgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'html5_blank_view_article'); // Add 'View Article' button instead of [...] for Excerpts
add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'html5_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
add_shortcode('boton', 'content_button_shortcode');
add_shortcode('whatsapp', 'content_whatsapp_shortcode');
add_shortcode('iframe', 'content_iframe_shortcode');
add_shortcode('youtube', 'content_youtube_shortcode');

function tag_rewrite() {
    add_rewrite_rule(
        '^noticias/tag/([^/]*)/?', // p followed by a slash, a series of one or more digits and maybe another slash
        'index.php?pagename=noticias&tags=$matches[1]',
        'top'
    );
    add_rewrite_tag( '%tags%', '([^&]+)' );
}

function remove_menus() {
    remove_menu_page( 'edit-comments.php' );
}
/*------------------------------------*\
	Custom Post Types
\*------------------------------------*/
// Register Custom Post Type Servicio
// Post Type Key: servicio
function create_servicio_cpt() {

    $labels = array(
        'name' => __( 'Servicios', 'Post Type General Name', 'textdomain' ),
        'singular_name' => __( 'Servicio', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => __( 'Servicios', 'textdomain' ),
        'name_admin_bar' => __( 'Servicio', 'textdomain' ),
        'archives' => __( 'Archivos Servicio', 'textdomain' ),
        'attributes' => __( 'Atributos Servicio', 'textdomain' ),
        'parent_item_colon' => __( 'Padres Servicio:', 'textdomain' ),
        'all_items' => __( 'Todos los Servicios', 'textdomain' ),
        'add_new_item' => __( 'Añadir nuevo Servicio', 'textdomain' ),
        'add_new' => __( 'Añadir nuevo', 'textdomain' ),
        'new_item' => __( 'Nuevo Servicio', 'textdomain' ),
        'edit_item' => __( 'Editar Servicio', 'textdomain' ),
        'update_item' => __( 'Actualizar Servicio', 'textdomain' ),
        'view_item' => __( 'Ver Servicio', 'textdomain' ),
        'view_items' => __( 'Ver Servicios', 'textdomain' ),
        'search_items' => __( 'Buscar Servicio', 'textdomain' ),
        'not_found' => __( 'No se encontraron Servicios.', 'textdomain' ),
        'not_found_in_trash' => __( 'Ningún Servicio encontrado en la papelera.', 'textdomain' ),
        'featured_image' => __( 'Imagen destacada', 'textdomain' ),
        'set_featured_image' => __( 'Establecer imagen destacada', 'textdomain' ),
        'remove_featured_image' => __( 'Borrar imagen destacada', 'textdomain' ),
        'use_featured_image' => __( 'Usar como imagen destacada', 'textdomain' ),
        'insert_into_item' => __( 'Insertar en la Servicio', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Subido a esta Servicio', 'textdomain' ),
        'items_list' => __( 'Lista de Servicios', 'textdomain' ),
        'items_list_navigation' => __( 'Navegación por el listado de Servicios', 'textdomain' ),
        'filter_items_list' => __( 'Lista de Servicios filtradas', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Servicio', 'textdomain' ),
        'description' => __( '', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-schedule',
        'supports' => array(),
        'taxonomies' => array('category', ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => false,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'servicio', $args );

}

// Register Custom Post Type Noticia
// Post Type Key: noticia
function create_noticia_cpt() {

    $labels = array(
        'name' => __( 'Noticias', 'Post Type General Name', 'textdomain' ),
        'singular_name' => __( 'Noticia', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => __( 'Noticias', 'textdomain' ),
        'name_admin_bar' => __( 'Noticia', 'textdomain' ),
        'archives' => __( 'Archivos Noticia', 'textdomain' ),
        'attributes' => __( 'Atributos Noticia', 'textdomain' ),
        'parent_item_colon' => __( 'Padres Noticia:', 'textdomain' ),
        'all_items' => __( 'Todas las Noticias', 'textdomain' ),
        'add_new_item' => __( 'Añadir nueva Noticia', 'textdomain' ),
        'add_new' => __( 'Añadir nueva', 'textdomain' ),
        'new_item' => __( 'Nueva Noticia', 'textdomain' ),
        'edit_item' => __( 'Editar Noticia', 'textdomain' ),
        'update_item' => __( 'Actualizar Noticia', 'textdomain' ),
        'view_item' => __( 'Ver Noticia', 'textdomain' ),
        'view_items' => __( 'Ver Noticias', 'textdomain' ),
        'search_items' => __( 'Buscar Noticia', 'textdomain' ),
        'not_found' => __( 'No se encontraron Noticias.', 'textdomain' ),
        'not_found_in_trash' => __( 'Ningún Noticia encontrado en la papelera.', 'textdomain' ),
        'featured_image' => __( 'Imagen destacada', 'textdomain' ),
        'set_featured_image' => __( 'Establecer imagen destacada', 'textdomain' ),
        'remove_featured_image' => __( 'Borrar imagen destacada', 'textdomain' ),
        'use_featured_image' => __( 'Usar como imagen destacada', 'textdomain' ),
        'insert_into_item' => __( 'Insertar en la Noticia', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Subido a esta Noticia', 'textdomain' ),
        'items_list' => __( 'Lista de Noticias', 'textdomain' ),
        'items_list_navigation' => __( 'Navegación por el listado de Noticias', 'textdomain' ),
        'filter_items_list' => __( 'Lista de Noticias filtradas', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Noticia', 'textdomain' ),
        'description' => __( '', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-megaphone',
        'supports' => array('title', 'editor', 'excerpt'),
        'taxonomies' => array('post_tag'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'noticia', $args );

}

// Register Custom Post Type Indice
// Post Type Key: indices
function create_indice_cpt() {

    $labels = array(
        'name' => __( 'Índices', 'Post Type General Name', 'textdomain' ),
        'singular_name' => __( 'Índice', 'Post Type Singular Name', 'textdomain' ),
        'menu_name' => __( 'Índices', 'textdomain' ),
        'name_admin_bar' => __( 'Índice', 'textdomain' ),
        'archives' => __( 'Archivos Índice', 'textdomain' ),
        'attributes' => __( 'Atributos Índice', 'textdomain' ),
        'parent_item_colon' => __( 'Padres Índice:', 'textdomain' ),
        'all_items' => __( 'Todos los Índices', 'textdomain' ),
        'add_new_item' => __( 'Añadir nuevo Índice', 'textdomain' ),
        'add_new' => __( 'Añadir nuevo', 'textdomain' ),
        'new_item' => __( 'Nuevo Índice', 'textdomain' ),
        'edit_item' => __( 'Editar Índice', 'textdomain' ),
        'update_item' => __( 'Actualizar Índice', 'textdomain' ),
        'view_item' => __( 'Ver Índice', 'textdomain' ),
        'view_items' => __( 'Ver Índices', 'textdomain' ),
        'search_items' => __( 'Buscar Índice', 'textdomain' ),
        'not_found' => __( 'No se encontraron Índices.', 'textdomain' ),
        'not_found_in_trash' => __( 'Ningún Índice encontrado en la papelera.', 'textdomain' ),
        'insert_into_item' => __( 'Insertar en la Noticia', 'textdomain' ),
        'uploaded_to_this_item' => __( 'Subido a este índice', 'textdomain' ),
        'items_list' => __( 'Lista de Índics', 'textdomain' ),
        'items_list_navigation' => __( 'Navegación por el listado de índices', 'textdomain' ),
        'filter_items_list' => __( 'Lista de índices filtrados', 'textdomain' ),
    );
    $args = array(
        'label' => __( 'Índice', 'textdomain' ),
        'description' => __( '', 'textdomain' ),
        'labels' => $labels,
        'menu_icon' => 'dashicons-chart-pie',
        'supports' => array('title'),
        'taxonomies' => array('post_tag'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 6,
        'show_in_admin_bar' => false,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'exclude_from_search' => false,
        'show_in_rest' => true,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type( 'indices', $args );

}

// Create 1 Custom Post type for a Demo, called HTML5-Blank
/*function create_post_type_html5()
{
    register_taxonomy_for_object_type('category', 'html5-blank'); // Register Taxonomies for Category
    register_taxonomy_for_object_type('post_tag', 'html5-blank');
    register_post_type('html5-blank', // Register Custom Post Type
        array(
        'labels' => array(
            'name' => __('HTML5 Blank Custom Post', 'html5blank'), // Rename these to suit
            'singular_name' => __('HTML5 Blank Custom Post', 'html5blank'),
            'add_new' => __('Add New', 'html5blank'),
            'add_new_item' => __('Add New HTML5 Blank Custom Post', 'html5blank'),
            'edit' => __('Edit', 'html5blank'),
            'edit_item' => __('Edit HTML5 Blank Custom Post', 'html5blank'),
            'new_item' => __('New HTML5 Blank Custom Post', 'html5blank'),
            'view' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'view_item' => __('View HTML5 Blank Custom Post', 'html5blank'),
            'search_items' => __('Search HTML5 Blank Custom Post', 'html5blank'),
            'not_found' => __('No HTML5 Blank Custom Posts found', 'html5blank'),
            'not_found_in_trash' => __('No HTML5 Blank Custom Posts found in Trash', 'html5blank')
        ),
        'public' => true,
        'hierarchical' => true, // Allows your posts to behave like Hierarchy Pages
        'has_archive' => true,
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail'
        ), // Go to Dashboard Custom HTML5 Blank post for supports
        'can_export' => true, // Allows export in Tools > Export
        'taxonomies' => array(
            'post_tag',
            'category'
        ) // Add Category and Post Tags support
    ));
}*/

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function html5_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function html5_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

function content_button_shortcode($atts, $content = null) {
    $externo = array_search('externo', $atts);
    $colorClass = '';
    if(isset($atts['color'])){
        if($atts['color'] == 'verde') {
            $colorClass = 'btn-green';
        }
        else if($atts['color'] == 'rojo') {
            $colorClass = 'btn-red';
        }
    }
    $link = (isset($atts['link']))? $atts['link'] : '';
    $legend = (isset($atts['leyenda']))? "<span>{$atts['leyenda']}</span>" : '';

    $target = ($externo !== false)? '_blank': '_self';
    return "<a class='btn {$colorClass} wow fadeInUp'
                href='{$link}'
                target='{$target}'>".
                $content .
            "</a>
            {$legend}";
}

function content_iframe_shortcode($atts, $content = null) {
    $source = '';
    $width = '100%';
    $height = '100%';
    if(isset($atts['src'])){ $source = $atts['src']; }
    if(isset($atts['width'])){ $width = $atts['width']; }
    if(isset($atts['height'])){ $height = $atts['height']; }
    return "<iframe src='{$source}' width='{$width}' height='{$height}' style='border:0;'></iframe>";
}

function content_youtube_shortcode($atts, $content = null) {
    $source = '';
    $width = '100%';
    $height = '600';
    if(isset($atts['src'])){ $source = $atts['src']; }
    if(isset($atts['width'])){ $width = $atts['width']; }
    if(isset($atts['height'])){ $height = $atts['height']; }
    return "<iframe width='{$width}' height='{$height}' src='{$source}' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
}


function content_whatsapp_shortcode($atts, $content = null) {
    $phone = str_replace(' ', '', $content);
    $phone = (substr($phone, 0, 1) == '+')? substr($phone, 1) : $phone;

    return "<div class='whatsapp'>
                <a class='btn'
                    href='https://api.whatsapp.com/send?phone={$phone}'
                    target='_blank'>
                    <i class='fab fa-whatsapp'></i>{$content}
                </a>
                <span>{$atts['horarios']}</span>
            </div>";
}

/* Opciones de tema Settings Page */
class opcionesdetema_Settings_Page {
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_sections_cipet' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_sections_lnh' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields_cipet' ) );
        add_action( 'admin_init', array( $this, 'wph_setup_fields_lnh' ) );
    }
    public function wph_create_settings() {
        $page_title = 'Opciones de tema';
        $menu_title = 'Opciones de tema';
        $capability = 'edit_pages';
        $slug = 'opcionesdetema';
        $callback = array($this, 'wph_settings_content');
        $icon = 'dashicons-admin-generic';
        $position = 25;
        add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
    }
    public function wph_settings_content() { ?>
        <div class="wrap">
            <h1>Opciones de tema</h1>
            <?php settings_errors(); ?>
            <form method="POST" action="options.php">
                <?php
                settings_fields( 'opcionesdetema' );
                do_settings_sections( 'opcionesdetema' );
                submit_button();
                ?>
            </form>
        </div> <?php
    }
    public function wph_setup_sections() {
        add_settings_section( 'opcionesdetema_section', 'Catamp', array(), 'opcionesdetema' );
    }
    public function wph_setup_sections_cipet() {
        add_settings_section( 'opcionesdetema_section_cipet', 'Cipet', array(), 'opcionesdetema' );
    }
    public function wph_setup_sections_lnh() {
        add_settings_section( 'opcionesdetema_section_lnh', 'LNH Cursos', array(), 'opcionesdetema' );
    }
    public function wph_setup_fields() {
        $fields = array(
            array(
                'label' => 'Copyright',
                'id' => 'copyright_catamp',
                'type' => 'text',
                'section' => 'opcionesdetema_section',
                'placeholder' => '',
                'desc' => '',
            ),
            array(
                'label' => 'Facebook',
                'id' => 'facebook_catamp',
                'type' => 'text',
                'section' => 'opcionesdetema_section',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Instagram',
                'id' => 'instagram_catamp',
                'type' => 'text',
                'section' => 'opcionesdetema_section',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Twitter',
                'id' => 'twitter_catamp',
                'type' => 'text',
                'section' => 'opcionesdetema_section',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
        );
        foreach( $fields as $field ){
            add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'opcionesdetema', $field['section'], $field );
            register_setting( 'opcionesdetema', $field['id'] );
        }
    }
    public function wph_setup_fields_cipet() {
        $fields = array(
            array(
                'label' => 'Copyright',
                'id' => 'copyright_cipet',
                'type' => 'text',
                'section' => 'opcionesdetema_section_cipet',
                'placeholder' => '',
                'desc' => '',
            ),
            array(
                'label' => 'Facebook',
                'id' => 'facebook_cipet',
                'type' => 'text',
                'section' => 'opcionesdetema_section_cipet',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Instagram',
                'id' => 'instagram_cipet',
                'type' => 'text',
                'section' => 'opcionesdetema_section_cipet',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Twitter',
                'id' => 'twitter_cipet',
                'type' => 'text',
                'section' => 'opcionesdetema_section_cipet',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
        );
        foreach( $fields as $field ){
            add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'opcionesdetema', $field['section'], $field );
            register_setting( 'opcionesdetema', $field['id'] );
        }
    }
    public function wph_setup_fields_lnh() {
        $fields = array(
            array(
                'label' => 'Copyright',
                'id' => 'copyright_lnh',
                'type' => 'text',
                'section' => 'opcionesdetema_section_lnh',
                'placeholder' => '',
                'desc' => '',
            ),
            array(
                'label' => 'Facebook',
                'id' => 'facebook_lnh',
                'type' => 'text',
                'section' => 'opcionesdetema_section_lnh',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Instagram',
                'id' => 'instagram_lnh',
                'type' => 'text',
                'section' => 'opcionesdetema_section_lnh',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
            array(
                'label' => 'Twitter',
                'id' => 'twitter_lnh',
                'type' => 'text',
                'section' => 'opcionesdetema_section_lnh',
                'placeholder' => '',
                'desc' => 'Si el campo queda vacio, el icono no se mostrara',
            ),
        );
        foreach( $fields as $field ){
            add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'opcionesdetema', $field['section'], $field );
            register_setting( 'opcionesdetema', $field['id'] );
        }
    }
    public function wph_field_callback( $field ) {
        $value = get_option( $field['id'] );
        switch ( $field['type'] ) {
            default:
                printf( '<input class="regular-text" name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
                    $field['id'],
                    $field['type'],
                    $field['placeholder'],
                    $value
                );
        }
        if( $desc = $field['desc'] ) {
            printf( '<p class="description">%s </p>', $desc );
        }
    }
}
new opcionesdetema_Settings_Page();


//MENU REORDER
function wpse_custom_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php', // Dashboard

        'separator1', // First separator

        'upload.php', // Media
        'edit.php?post_type=page', // Pages
        'edit.php?post_type=noticia', // Noticias
        'edit.php?post_type=indices', // Indices

        'separator2', // Second separator

        'opcionesdetema', //Opciones del Tema
        'wpcf7', //Contact Form
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'wpse_custom_menu_order', 10, 1 );
add_filter( 'menu_order', 'wpse_custom_menu_order', 10, 1 );

//USER ROLES
add_action( 'admin_init', 'my_remove_menu_pages' );
function my_remove_menu_pages() {
    global $user_ID;
    if ( current_user_can( 'editor' ) ) {
        remove_menu_page( 'wpcf7' );
        remove_menu_page( 'themes.php' );
        remove_menu_page( 'plugins.php' );
        remove_menu_page( 'users.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'options-general.php' );
    }
    remove_menu_page( 'edit.php' );
}


?>
