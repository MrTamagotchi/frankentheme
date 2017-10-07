<?php 

// A witches brew of functions from Bones Theme and Blankslate Theme
// The best of all worlds!

function head_cleanup() {
  // category feeds
  // remove_action( 'wp_head', 'feed_links_extra', 3 );
  // post and comment feeds
  // remove_action( 'wp_head', 'feed_links', 2 );
  // EditURI link
  remove_action( 'wp_head', 'rsd_link' );
  // windows live writer
  remove_action( 'wp_head', 'wlwmanifest_link' );
  // previous link
  remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
  // start link
  remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
  // links for adjacent posts
  remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
  // WP version
  remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'remove_wp_ver_css_js', 9999 );

}


function remove_wp_ver_css_js( $src ) {
  if ( strpos( $src, 'ver=' ) )
    $src = remove_query_arg( 'ver', $src );
  return $src;
}


function filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

function excerpt_more($more) {
  global $post;
  // edit here if you like
  return '...  <a class="excerpt-read-more" href="'. get_permalink( $post->ID ) . '" title="'. __( 'Read ', 'bonestheme' ) . esc_attr( get_the_title( $post->ID ) ).'">'. __( 'Read more &raquo;', 'bonestheme' ) .'</a>';
}

function rw_title( $title, $sep, $seplocation ) {
  global $page, $paged;

  // Don't affect in feeds.
  if ( is_feed() ) return $title;

  // Add the blog's name
  if ( 'right' == $seplocation ) {
    $title .= get_bloginfo( 'name' );
  } else {
    $title = get_bloginfo( 'name' ) . $title;
  }

  // Add the blog description for the home/front page.
  $site_description = get_bloginfo( 'description', 'display' );

  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title .= " {$sep} {$site_description}";
  }

  // Add a page number if necessary:
  if ( $paged >= 2 || $page >= 2 ) {
    $title .= " {$sep} " . sprintf( __( 'Page %s', 'dbt' ), max( $paged, $page ) );
  }

  return $title;

}

function rss_version() { return ''; }



function remove_wp_widget_recent_comments_style() {
  if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
    remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
  }
}


function remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
  }
}


function gallery_style($css) {
  return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
}


function blankslate_setup() {
  load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
  add_theme_support( 'title-tag' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  global $content_width;
  if ( ! isset( $content_width ) ) $content_width = 640;
  register_nav_menus(
    array( 
      'main-menu' => __( 'Main Menu', 'blankslate' ),
      'footer-menu' => __('Footer Menu', 'blankslate' )
    )
  );
}


function blankslate_enqueue_comment_reply_script() {
  if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );



function blankslate_widgets_init() {
  register_sidebar( array (
    'name' => __( 'Sidebar Widget Area', 'blankslate' ),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
    'after_widget' => "</li>",
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );


function blankslate_custom_pings( $comment ) {
  $GLOBALS['comment'] = $comment; 
  ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
  <?php 
}


function blankslate_comments_number( $count ) {
  if ( !is_admin() ) {
    global $id;
    $comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
    return count( $comments_by_type['comment'] );
  } else {
    return $count;
  }
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );



// COMPONENT
/**
 * Like get_template_part() put lets you pass args to the template file
 * Root folder is "resources/php-components"
 * Args are available in the tempalte as $template_args array
 * @param string filepart
 * @param mixed wp_args style argument list
 */

/* EXAMPLE:

  <?php component( 
    'thumbgrid', 
    [
      'query' => $query, 
      'size' => 'third',
      'top_row' => 'calendar',
      'excerpt' => 'true',
      'img_size' => 'thumbnail'
    ] 
  ); ?>

*/
function component( $component, $template_args = array(), $cache_args = array() ) {
  $file = 'resources/php-components/' . $component;

  $template_args = wp_parse_args( $template_args );
  $cache_args = wp_parse_args( $cache_args );
  if ( $cache_args ) {
    foreach ( $template_args as $key => $value ) {
      if ( is_scalar( $value ) || is_array( $value ) ) {
        $cache_args[$key] = $value;
      } else if ( is_object( $value ) && method_exists( $value, 'get_id' ) ) {
        $cache_args[$key] = call_user_method( 'get_id', $value );
      }
    }
    if ( ( $cache = wp_cache_get( $file, serialize( $cache_args ) ) ) !== false ) {
      if ( ! empty( $template_args['return'] ) )
        return $cache;
      echo $cache;
      return;
    }
  }
  $file_handle = $file;
  do_action( 'start_operation', 'hm_template_part::' . $file_handle );
  if ( file_exists( get_stylesheet_directory() . '/' . $file . '.php' ) )
    $file = get_stylesheet_directory() . '/' . $file . '.php';
  elseif ( file_exists( get_template_directory() . '/' . $file . '.php' ) )
    $file = get_template_directory() . '/' . $file . '.php';
  ob_start();
  $return = require( $file );
  $data = ob_get_clean();
  do_action( 'end_operation', 'hm_template_part::' . $file_handle );
  if ( $cache_args ) {
    wp_cache_set( $file, $data, serialize( $cache_args ), 3600 );
  }
  if ( ! empty( $template_args['return'] ) )
    if ( $return === false )
      return false;
    else
      return $data;
  echo $data;
}

?>