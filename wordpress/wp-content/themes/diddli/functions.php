<?php
load_theme_textdomain( 'masthemes', TEMPLATEPATH.'/languages' );
$locale = get_locale();
$locale_file = TEMPLATEPATH."/localization/$locale.php";
if (is_readable($locale_file))
    require_once($locale_file);
function prefix_theme_updater() {
	require( get_template_directory() . '/masthemes/theme-updater.php' );
}
add_action( 'after_setup_theme', 'prefix_theme_updater' );
require_once ('admin/index.php');
$idiomaof = of_get_options( 'language_a', '');
function change_locale(){ return $idiomaof; }
load_default_textdomain();
load_textdomain('masthemes', get_template_directory().'/idiomas/'.$idiomaof.'.mo');
function og_head() {
global $post;
if(is_single()){
	while(have_posts()):the_post();
        $poster_path = get_post_meta($post->ID, "poster_path", $single = true);
        $backdrop_path = get_post_meta($post->ID, "backdrop_path", $single = true); 
        endwhile;  
?>
<?php if(!empty($poster_path)){ ?><meta property="og:image" content="<?php image_show($poster_path, "url", "w300") ?>" /><?php } ?>
<?php if(!empty($backdrop_path)){ ?><meta property="og:image" content="<?php image_show($backdrop_path , "url", "w300") ?>" /><?php } ?>
<?php  
    }
}
add_action( 'wp_head', 'og_head', 2 );
function wd_load_script() {
    wp_deregister_script( 'jquery' );
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_register_script('jquery', '//code.jquery.com/jquery-1.11.2.min.js');
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	     wp_enqueue_script( 'comment-reply' ); 
	}
	wp_register_script('owl', get_template_directory_uri() . '/js/owl.carousel.min.js'); 
	wp_register_script('script', get_template_directory_uri() . '/js/script.js');	
	wp_register_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js');
	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'owl' );
        wp_enqueue_script( 'script' );
	if(is_single()){
		if(current_user_can( 'manage_options' )) {
			wp_enqueue_script('dlsmt', get_template_directory_uri().'/js/dlsmt.js', array('jquery'), '1.0', true );
			wp_localize_script('dlsmt', 'ajax_var', array('url' => admin_url('admin-ajax.php'),'nonce' => wp_create_nonce('ajax-nonce')));
		}		
	}
	wp_enqueue_script( 'bootstrap' );
}    
add_action('wp_enqueue_scripts', 'wd_load_script');
function _remove_query_strings_1( $src ){	
	$rqs = explode( '?ver', $src );
    return $rqs[0];
}
if(is_admin()){
}else{
	add_filter( 'script_loader_src', '_remove_query_strings_1', 15, 1 );
	add_filter( 'style_loader_src', '_remove_query_strings_1', 15, 1 );
}
function _remove_query_strings_2( $src ){
	$rqs = explode( '&ver', $src );
	return $rqs[0];
}
if ( is_admin() ) {
}else{
	add_filter( 'script_loader_src', '_remove_query_strings_2', 15, 1 );
	add_filter( 'style_loader_src', '_remove_query_strings_2', 15, 1 );
}
function admin_init(){
	remove_post_type_support('post', 'editor');
}
add_action("admin_init", "admin_init");
if(function_exists('register_nav_menus')){
	register_nav_menus(array(
		'MenuPrincipal' => __( 'Principal menu', 'masthemes'),
		'MenuFooter' => __( 'Footer menu', 'masthemes'),
	));
}
if ( function_exists('register_sidebar') ) {
   register_sidebar(array(
     'name' => 'Sidebar',
     'before_widget' => '<div id="%1$s" class="col-xs-12 widget %2$s"><div class="row">', 
     'after_widget' => '</div></div>', 
     'before_title' => '<h3 class="widget-title"><span class="glyphicon glyphicon-film" aria-hidden="true"></span>', 
     'after_title' => '</h3>',
   ));
}
function getPostViews($postID){
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0";
	}
	return $count.'';
}
function setPostViews($postID) {
	$count_key = 'post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if($count==''){
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	}else{
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
function round_num($num, $to_nearest) { 
   return floor($num/$to_nearest)*$to_nearest; 
} 
function pagenavi($before = '', $after = '') {
    global $wpdb, $wp_query;
    $pagenavi_options = array();
    $pagenavi_options['pages_text'] = ('');
    $pagenavi_options['current_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['page_text'] = '%PAGE_NUMBER%';
    $pagenavi_options['first_text'] = ('Primera');
    $pagenavi_options['last_text'] = ('Última');
    $pagenavi_options['next_text'] = '<i class="glyphicon glyphicon-chevron-right" aria-hidden="true"></i>';
    $pagenavi_options['prev_text'] = '<i class="glyphicon glyphicon-chevron-left" aria-hidden="true"></i>';
    $pagenavi_options['dotright_text'] = '...';
    $pagenavi_options['dotleft_text'] = '...';
    $pagenavi_options['num_pages'] = 5; 
    $pagenavi_options['always_show'] = 0;
    $pagenavi_options['num_larger_page_numbers'] = 0;
    $pagenavi_options['larger_page_numbers_multiple'] = 5;
    if (!is_single()) {
        $request = $wp_query->request;
        $posts_per_page = intval(get_query_var('posts_per_page'));
        $paged = intval(get_query_var('paged'));
        $numposts = $wp_query->found_posts;
        $max_page = $wp_query->max_num_pages;
        if(empty($paged) || $paged == 0) {
            $paged = 1;
        }
        $pages_to_show = intval($pagenavi_options['num_pages']);
        $larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
        $larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
        $pages_to_show_minus_1 = $pages_to_show - 1;
        $half_page_start = floor($pages_to_show_minus_1/2);
        $half_page_end = ceil($pages_to_show_minus_1/2);
        $start_page = $paged - $half_page_start;
        if($start_page <= 0) {
            $start_page = 1;
        }
        $end_page = $paged + $half_page_end;
        if(($end_page - $start_page) != $pages_to_show_minus_1) {
            $end_page = $start_page + $pages_to_show_minus_1;
        }
        if($end_page > $max_page) {
            $start_page = $max_page - $pages_to_show_minus_1;
            $end_page = $max_page;
        }
        if($start_page <= 0) {
            $start_page = 1;
        }
        $larger_per_page = $larger_page_to_show*$larger_page_multiple;
        $larger_start_page_start = (round_num($start_page, 10) + $larger_page_multiple) - $larger_per_page;
        $larger_start_page_end = round_num($start_page, 10) + $larger_page_multiple;
        $larger_end_page_start = round_num($end_page, 10) + $larger_page_multiple;
        $larger_end_page_end = round_num($end_page, 10) + ($larger_per_page);
        if($larger_start_page_end - $larger_page_multiple == $start_page) {
            $larger_start_page_start = $larger_start_page_start - $larger_page_multiple;
            $larger_start_page_end = $larger_start_page_end - $larger_page_multiple;
        }
        if($larger_start_page_start <= 0) {
            $larger_start_page_start = $larger_page_multiple;
        }
        if($larger_start_page_end > $max_page) {
            $larger_start_page_end = $max_page;
        }
        if($larger_end_page_end > $max_page) {
            $larger_end_page_end = $max_page;
        }
        if($max_page > 1 || intval($pagenavi_options['always_show']) == 1) {
            $pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
            $pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
            echo $before.'<div class="pagenavi">'."\n";
            if(!empty($pages_text)) {
                echo $pages_text;
            }
            previous_posts_link($pagenavi_options['prev_text']);
            if ($start_page >= 2 && $pages_to_show < $max_page) {
                $first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
                echo '<a href="'.esc_url(get_pagenum_link()).'" class="first" title="'.$first_page_text.'">1</a>';
                if(!empty($pagenavi_options['dotleft_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotleft_text'].'</span>';
                }
            }
            if($larger_page_to_show > 0 && $larger_start_page_start > 0 && $larger_start_page_end <= $max_page) {
                for($i = $larger_start_page_start; $i < $larger_start_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            for($i = $start_page; $i  <= $end_page; $i++) {
                if($i == $paged) {
                    $current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
                    echo '<span class="current">'.$current_page_text.'</span>';
                } else {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            if ($end_page < $max_page) {
                if(!empty($pagenavi_options['dotright_text'])) {
                    echo '<span class="expand">'.$pagenavi_options['dotright_text'].'</span>';
                }
                $last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
                echo '<a href="'.esc_url(get_pagenum_link($max_page)).'" class="last" title="'.$last_page_text.'">'.$max_page.'</a>';
            }
            next_posts_link($pagenavi_options['next_text'], $max_page);
            if($larger_page_to_show > 0 && $larger_end_page_start < $max_page) {
                for($i = $larger_end_page_start; $i <= $larger_end_page_end; $i+=$larger_page_multiple) {
                    $page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
                    echo '<a href="'.esc_url(get_pagenum_link($i)).'" class="single_page" title="'.$page_text.'">'.$page_text.'</a>';
                }
            }
            echo '</div>'.$after."\n";
        }
    }
}
add_filter('wp_list_categories', 'cat_count_span');
function cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>', $links);
  $links = str_replace(')', '</span>', $links);
  return $links;
}
add_filter('get_archives_link', 'archive_count_inline');
function archive_count_inline($links) {
$links = str_replace('</a>&nbsp;(', '</a> <span>', $links);
$links = str_replace(')', '</span>', $links);
return $links;
}
if ( ! function_exists( 'masthemes_comment' ) ) :
function masthemes_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	if ( 'pingback' == $comment->comment_type || 'trackback' == $comment->comment_type ) : ?>
	<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
		<div class="comment-body">
			<?php _e( 'Pingback:', 'masthemes' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'masthemes' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
	<?php else : ?>
<li <?php comment_class(); ?> id="div-comment-<?php comment_ID(); ?>" itemtype="http://schema.org/Comment" itemprop="comment">
	<div class="clearfix">
		<div class="comment-avatar left">
			<?php $avatar_size = 40; if ( '0' != $comment->comment_parent ) $avatar_size = 40; echo get_avatar( $comment, $avatar_size ); ?>
		</div>
		<div class="comment-body">
			<span class="author" itemprop="creator"><b><?php printf( __( '%1$s %2$s', 'masthemes' ), sprintf( '%s', get_comment_author_link() ),sprintf(sprintf( __( '', 'masthemes' ), get_comment_date(), get_comment_time() ))); ?></b>  <?php if ( $comment->comment_approved == '0' ) : ?><em class="comment-awaiting-moderation"><?php _e( '(Your comment is awaiting moderation)', 'masthemes' ); ?></em><?php endif; ?></span>
			<?php edit_comment_link( __( 'Edit', 'masthemes' ), '<span class="edit-link">', '</span>' ); ?>
			<div class="comment-meta right">
                		<?php
				comment_reply_link( array_merge( $args, array(
					'add_below' => 'div-comment',
					'depth'     => $depth,
					'max_depth' => $args['max_depth'],
					'before'    => '<div class="reply">',
					'after'     => '</div>',
				) ) );
				?>
			</div>
			<div class="comment-content" itemprop="text">
				<?php comment_text(); ?>
			</div>
		</div>
	</div>
<?php
	endif;
}
endif; 
$sp_boxes = array (
	__( 'General - MasThemes', 'masthemes' ) => array (
		array( 'imdbLink',  __( 'ID de IMDB (Example: http://www.imdb.com/title/tt2310332/ the ID is "tt2310332")', 'masthemes' )),
		array( 'generarmt',  __( 'Generate', 'masthemes' ), 'button' ),
	),
    'Informacion Generada - MasThemes' => array (
		array( 'title',  __( 'English tittle:', 'masthemes' ) ),
		array( 'original_title',  __( 'Original tittle:', 'masthemes' ) ),
		array( 'crew_writ', __( 'Writers:', 'masthemes' ) ),
		array( 'crew_director',  __( 'Director:', 'masthemes' ) ),
		array( 'cast', __( 'Actors:', 'masthemes' ), 'textarea' ),
		array( 'release_date',  __( 'Release year:', 'masthemes' ) ),
		array( 'genres',  __( 'Genres:', 'masthemes' ) ),
		array( 'overview', __( 'Sinopsis:', 'masthemes' ) ),
		array( 'backdrop_path',  __( 'Backdrop:', 'masthemes' ) ),
		array( 'poster_path',  __( 'Poster:', 'masthemes' ) ), 
		array( 'runtime', __( 'Runtime:', 'masthemes' ) ),
		array( 'status', __( 'Status:', 'masthemes' ) ),
        array( 'vote_average', __( 'Vote average:', 'masthemes' )  ),
		array( 'vote_count', __( 'Vote count:', 'masthemes' ) ),
		array( 'images', __( 'Captures (add one  Under the other):', 'masthemes' ), 'textarea' ), //
		array( 'trailers', __( 'Youtube ID:', 'masthemes' ) ),
    ),
);
add_action( 'admin_menu', 'sp_add_custom_box' );
add_action( 'save_post', 'sp_save_postdata', 1, 2 );
function sp_add_custom_box() {
    global $sp_boxes;
    if ( function_exists( 'add_meta_box' ) ) {
        foreach ( array_keys( $sp_boxes ) as $box_name ) {
            add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'post', 'normal', 'high' );
        }
    }
}
function sp_post_custom_box ( $obj, $box ) {
    global $sp_boxes;
    static $sp_nonce_flag = false;
    if ( ! $sp_nonce_flag ) {
        echo_sp_nonce();
        $sp_nonce_flag = true;
    }
    foreach ( $sp_boxes[$box['id']] as $sp_box ) {
        echo field_html( $sp_box );
    }
}
function field_html ( $args ) {
    switch ( $args[2] ) {
        case 'textarea':
            return text_area( $args );
		case 'select':
			return select_field($args);
        case 'checkbox':
        case 'radio':
		case 'button':
        case 'text':
			return text_button( $args );
        default:
            return text_field( $args );
    }
}
function text_field ( $args ) {
    global $post;
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );
    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<input style="width: 95%%;" type="text" name="%1$s" value="%3$s" /><br /><br />';
    return vsprintf( $label_format, $args );
}
function text_button ( $args ) {
    $label_format = '<input id="generarmt" type="button" value="'.__( 'Generate', 'masthemes' ).'" /><br /><br />';
    return vsprintf( $label_format, $args );
}
function text_area ( $args ) {
    global $post;
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );
    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';
    return vsprintf( $label_format, $args );
}
function wdm_add_meta_box() {
        add_meta_box(
                'wdm_sectionid', __( 'Design of post', 'masthemes' ), 'wdm_meta_box_callback', 'post'
        ); 
}
add_action( 'add_meta_boxes', 'wdm_add_meta_box' );
function wdm_meta_box_callback( $post ) {
        wp_nonce_field( 'wdm_meta_box', 'wdm_meta_box_nonce' );
        $value = get_post_meta( $post->ID, 'my_key', true );
        $estsin = of_get_options( 'estsin', '' ); 
        if(empty($value)){ 
        	if(($estsin == __('Style 1', 'masthemes')) || empty($estsin)){
        		$checes1 ='checked="checked"';
        	} 
        	if($estsin == __('Style 2', 'masthemes')){
        		$checes2 ='checked="checked"';
        	} 
        	if($estsin == __('Style 3', 'masthemes')){
        		$checes3 ='checked="checked"';
        	}  
        } 
        ?>
        <input type="radio" name="tiposingle" value="tipo1" <?php checked( $value, 'tipo1' ); ?> <?=$checes1?>><?php _e('Style 1', 'masthemes'); ?><br>
        <input type="radio" name="tiposingle" value="tipo2" <?php checked( $value, 'tipo2' ); ?> <?=$checes2?>><?php _e('Style 2', 'masthemes'); ?><br>
        <input type="radio" name="tiposingle" value="tipo3" <?php checked( $value, 'tipo3' ); ?> <?=$checes3?>><?php _e('Style 3', 'masthemes'); ?><br>
        <?php
}
function wdm_save_meta_box_data( $post_id ) {
        if ( !isset( $_POST['wdm_meta_box_nonce'] ) ) {
                return;
        }
        if ( !wp_verify_nonce( $_POST['wdm_meta_box_nonce'], 'wdm_meta_box' ) ) {
                return;
        }
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
                return;
        }
        if ( !current_user_can( 'edit_post', $post_id ) ) {
                return;
        }
        $new_meta_value = ( isset( $_POST['tiposingle'] ) ? sanitize_html_class( $_POST['tiposingle'] ) : '' );
        update_post_meta( $post_id, 'my_key', $new_meta_value );
}
add_action( 'save_post', 'wdm_save_meta_box_data' );
function sp_save_postdata($post_id, $post) {
    global $sp_boxes;
    if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
        return $post->ID;
    }
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post->ID ))
            return $post->ID;
    } else {
        if ( ! current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
    }
    foreach ( $sp_boxes as $sp_box ) {
        foreach ( $sp_box as $sp_fields ) {
            $my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
        }
    }
    foreach ($my_data as $key => $value) {
        if ( 'revision' == $post->post_type  ) {
            return;
        }
        $value = implode(',', (array)$value);
        if ( get_post_meta($post->ID, $key, FALSE) ) {
            update_post_meta($post->ID, $key, $value);
        } else {
            add_post_meta($post->ID, $key, $value);
        }
        if (!$value) {
            delete_post_meta($post->ID, $key);
        }
    }
}
function echo_sp_nonce () {
    echo sprintf(
        '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
        'sp_nonce_name',
        wp_create_nonce( plugin_basename(__FILE__) )
    );
}
if ( !function_exists('get_custom_field') ) {
    function get_custom_field($field) {
       global $post;
       $custom_field = get_post_meta($post->ID, $field, true);
       echo $custom_field;
    }
} 
function taxonomias_init() {
	register_taxonomy(__('director', 'masthemes'), 'post', array(
	'hierarchical' => false,  'label' => __('Director', 'masthemes'),
	'query_var' => true, 'rewrite' => true));
	register_taxonomy(__('writer', 'masthemes'), 'post', array(
	'hierarchical' => false,  'label' => __('Writer', 'masthemes'),
	'query_var' => true, 'rewrite' => true));
	register_taxonomy(__('actor', 'masthemes'), 'post', array(
	'hierarchical' => false,  'label' => __('Actor', 'masthemes'),
	'query_var' => true, 'rewrite' => true));
	register_taxonomy(__('year_relase', 'masthemes'), 'post', array(
	'hierarchical' => false,  'label' => __('Year', 'masthemes'),
	'query_var' => true, 'rewrite' => true));
}    
add_action( 'init', 'taxonomias_init', 0 ); 
function masthemes_js() {
$api_tmdb = of_get_options( 'api_tmdb', '' ); 
$lang_tmdb = of_get_options( 'lang_tmdb', '' ); 
global $post_type;
if( $post_type == 'post' ){
?>
<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
<script type="text/javascript">// <![CDATA[
$(document).ready(function() {
    $("#generarmt").click(function() {
    	masthemes();
    });
});
function masthemes(){
var url = 'http://api.themoviedb.org/3/movie/';
var imdbLink = $('input[name=imdbLink]').get(0).value;
var mod = '?append_to_response=images,trailers';
var lang = '&language=<?php if(!empty($lang_tmdb)){echo $lang_tmdb;}else{echo "es";} ?>&include_image_language=<?php if(!empty($lang_tmdb)){echo $lang_tmdb;}else{echo "es";} ?>,null';
var key_api = '&api_key=<?php echo $api_tmdb; ?>';
$.getJSON( url + imdbLink + mod + lang + key_api, function(masthemes) {
	$.each(masthemes, function(key, val) {
		if(key == "genres"){
			var genr = "";
			$.each( masthemes.genres, function( i, item ) {
       	 		genr += "" + item.name + ", ";
				genr1 = item.name;
				$('input[name=newcategory]').val( genr1 );
				$('#category-add-submit').trigger('click');
				 $('#category-add-submit').prop("disabled", false);
				$('input[name=newcategory]').val("");
    		});
			$('input[name=' +key+ ']').val( genr );
		}else if(key == "trailers"){
			var tral = "";
			$.each( masthemes.trailers.youtube, function( i, item ) {
       	 		tral += "[" + item.source + "]";
    		});
			$('input[name=' +key+ ']').val( tral );
		}else if(key == "images"){
			var imgt = "";
			$.each( masthemes.images.backdrops, function( i, item ) {
				imgt += item.file_path + "\n";	
    		});
			$('textarea[name=' +key+ ']').val( imgt );
		}else if(key == "release_date"){
			$('input[name=' +key+ ']').val( val.slice(0,4) );
			$('#new-tag-fecha').val( val.slice(0,4) );
		
		}else if(key == "title"){
			$('input[name=' +key+ ']').val(val);
			$('label#title-prompt-text').addClass('screen-reader-text');
			$('input[name=post_title]').val(val);		
		}else{
			$('input[name=' +key+ ']').val(val);	
		}
	});
});
$.getJSON( url + imdbLink + "/credits?" + key_api, function(masthemes) {
	$.each(masthemes, function(key, val) {
		if(key == "cast"){
			var cstm = cstml = "";
			$.each( masthemes.cast, function( i, item ) {
       	 		cstm += "[" + item.profile_path + ";" + item.name + "," + item.character + "]";
				cstml += "" + item.name + ", "; //
    		});
			$('textarea[name=' +key+ ']').val( cstm );
			$('#new-tag-actor').val( cstml );
		}else{
			var crew_d = crew_dl = "";
			var crew_w = crew_wl = "";
			$.each( masthemes.crew, function( i, item ) {
				if(item.department == "Directing"){
					crew_d += "[" + item.profile_path + ";" + item.name + "]";
					crew_dl += "" + item.name + ", "; //
				}
       	 		if(item.department == "Writing"){
					crew_w += "[" + item.profile_path + ";" + item.name + "]";
					crew_wl += "" + item.name + ", "; //
				}
    		});
			$('input[name=crew_director]').val( crew_d );
			$('input[name=crew_writ]').val( crew_w );
			$('#new-tag-director').val( crew_dl );
			$('#new-tag-escritor').val( crew_wl );
		}
	});
	
});
}
// ]]></script>
<?php
}} add_action('admin_footer', 'masthemes_js');
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails', array( __('news', 'masthemes') ) );
}
add_action('init', 'noticias_register'); 
function noticias_register() {
	$labels = array(
		'name' => __('News', 'masthemes'),
		'singular_name' =>__('News', 'masthemes'),
		'add_new' => __('Add news', 'masthemes'),
		'add_new_item' => __('Add new news', 'masthemes'),
		'edit_item' => __('Edit news', 'masthemes'),
		'new_item' => __('New news', 'masthemes'),
		'view_item' => __('View news', 'masthemes'),
		'search_items' => __('Search news', 'masthemes'),
		'not_found' =>   __('No news', 'masthemes'),
		'not_found_in_trash' =>  __('No news in the trash', 'masthemes'),
		'parent_item_colon' => ''
	);
	$args = array(
		'exclude_from_search' => true, 
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','comments','excerpt'),
	  ); 
	register_post_type( __('news', 'masthemes') , $args );
}
function show_info($name){ if(!empty($name)){echo $name;}else{echo "N/A";}}
function escritores_show($name ,$type){	if(!empty($name)){if($type == "img"){$val = str_replace(array('[null','[/',';',']',),array('<div class="
castItem col-xs-4"><img alt="Escritor" src="'.get_bloginfo('template_directory').'/images/sin-foto.jpg','<div class="castItem col-xs-4"><img alt="'.__('Writer', 'masthemes').'" src="http://image.tmdb.org/t/p/w90/','" /><span>','</span><br /><span class="typesp">'.__('Writer', 'masthemes').'</span></div>',),$name);echo '<div class="escritores_crew col-sm-12">'.$val.'</div>';}else{if( get_the_term_list($post->ID, __('writer', 'masthemes'), true) ){echo get_the_term_list($post->ID,  __('writer', 'masthemes'), '', ', ', '');}}}else{echo "N/A";}}
function directores_show($name,$type){	if($type == "img"){$val = str_replace(array('[null','[/',';',']',),array('<div class="castItem col-xs-4"><img alt="'.__('Director', 'masthemes').'" src="'.get_bloginfo('template_directory').'/images/sin-foto.jpg','<div class="castItem col-xs-4"><img alt="'.__('Director', 'masthemes').'" src="http://image.tmdb.org/t/p/w90/','" /><span>','</span><br /><span class="typesp">'.__('Director', 'masthemes').'</span></div>',),$name);echo '<div class="escritores_crew col-sm-12">'.$val.'</div>';}else{if( get_the_term_list($post->ID, __('director', 'masthemes'), true) ){echo get_the_term_list($post->ID, __('director', 'masthemes'), '', ', ', '');}else{echo "N/A";}}}
function actores_show($name,$type){	if($type == "img"){$val = str_replace(	array('[null','[/',';',']',",",),array('<div class="castItem col-xs-4"><img alt="'.__('Actor', 'masthemes').'" src="'.get_bloginfo('template_directory').'/images/sin-foto.jpg','<div class="castItem col-xs-4"><img alt="'.__('Actor', 'masthemes').'" src="http://image.tmdb.org/t/p/w90/','" /><span>','</span></div>','</span><br /><span class="typesp">',),$name); echo '<div class="escritores_crew col-sm-12">'.$val.'</div>';}else{if( get_the_term_list($post->ID, __('actor', 'masthemes'), true) ){echo get_the_term_list($post->ID, __('actor', 'masthemes'), '', ', ', '');}else{echo "N/A";}}}
function trailer_show($id){if(!empty($id)){$val = str_replace(array("[","]",),array('<iframe width="854" height="510" src="//www.youtube.com/embed/','" frameborder="0" allowfullscreen></iframe><i>'.__('Trailer of','masthemes').' '.get_the_title().'</i>	',),$id);echo '<div class="container_trailer">'.$val.'</div>';}else{echo '<p>'.__('Trailers not exist to date.', 'masthemes').'</p>';}}
function image_show($name, $type, $size){if($type == "img"){if(!empty($name)){echo '<img src="http://image.tmdb.org/t/p/'.$size.$name.'" title="'.get_the_title().'" />';}else{echo '<img src="'.get_bloginfo('template_directory').'/images/no-image.jpg" />';}}else{if(!empty($name)){echo 'http://image.tmdb.org/t/p/'.$size.$name;}else{echo ''.get_bloginfo('template_directory').'/images/no-image.jpg';}}}
function capturas_show($Capturas, $size){$val = str_replace(array("/",".jpg",),array('<li class="imagc"><div class="col-xs-12"><img width="235" height="132" src="http://image.tmdb.org/t/p/'.$size.'/','.jpg" alt="'.__('Capture of', 'masthemes').' '.get_the_title().'" /></div></li>',),$Capturas);echo $val;}
function genero($genero, $type){if($type == "url"){the_category(', ');}else{if(!empty($genero)){echo $genero;}else{echo "N/A";}}}
function campturas_show2($name, $size){$val = explode("\n", $name);$passer = array();foreach( $val as $valor ) { if( !empty($valor) ) {$tmp = explode(' ', $valor); $passer[] = $tmp;} }$ftsa=$passer[1][0];if(empty($ftsa)){$ftsa=$passer[0][0];};$nshowf = preg_replace('/\s+/', '', $ftsa);echo 'http://image.tmdb.org/t/p/'.$size.''.$nshowf.'';}
function cw_create_widget(){    
    register_widget('cw_widget');
}
add_action('widgets_init','cw_create_widget'); 
class cw_widget extends WP_Widget {
     function cw_widget(){
        $widget_ops = array('classname' => 'cw_widget', 'description' => __('Show the last news', 'masthemes') );
        $this->WP_Widget('cw_widget', __('Last news - MasThemes', 'masthemes'), $widget_ops);
    }
    function widget($args,$instance){
        echo $before_widget;    
?>
<div class="col-xs-12 widget">
	<div class="row">
		<?php if(!empty($instance["cw_texto"])){ ?><h3 class="widget-title"><span class="glyphicon glyphicon-book" aria-hidden="true"></span><?=$instance["cw_texto"]?></h3><?php } ?>
    		<ul class="destacnotivias">
		     		<?php $args = array( 'post_type' =>  __('news', 'masthemes'), 'posts_per_page' => 5 );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li class="noticla_li">
					<a href="<?php the_permalink();?>"><?php the_title(); ?></a>
				</li>
				<?php endwhile; wp_reset_query(); ?>
		</ul>
	</div>
</div>
<?php
	echo $after_widget;
   }
    function update($new_instance, $old_instance){ 
        $instance = $old_instance;
        $instance["cw_texto"] = strip_tags($new_instance["cw_texto"]);
        return $instance;     
    } 
    function form($instance){
        ?>
<p>
  <label for="<?php echo $this->get_field_id('cw_texto'); ?>"><?php echo  __('Title:', 'masthemes'); ?> </label>
  <input class="widefat" id="<?php echo $this->get_field_id('cw_texto'); ?>" name="<?php echo $this->get_field_name('cw_texto'); ?>" type="text" value="<?php echo esc_attr($instance["cw_texto"]); ?>" />
</p>
<?php
    }
} 
///////////////////////MASTHEMES///////////////////////////////
include_once ('masthemes/descargas/configuracion.php');