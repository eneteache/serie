<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' );  ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title(''); ?></title>
<?php 
$favicon = of_get_options( 'favicon_upload', '');
$newfavion = str_replace("[site_url]", "".home_url()."", $favicon);
if(!empty($newfavion)){ ?>
<link rel="shortcut icon" href="<?= $newfavion; ?>" />
<?php }else{ ?>
<link rel="shortcut icon" href="<?php bloginfo('template_directory')?>/images/favicon.png" />
<?php } ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?>" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel='stylesheet' id='open-sans-css'  href='//fonts.googleapis.com/css?family=Open+Sans%3A300italic%2C400italic%2C600italic%2C300%2C400%2C600&#038;subset=latin%2Clatin-ext&#038;ver=4.1' type='text/css' media='all' />
<?php wp_head();?>
<!--[if IE]><script src="<?php bloginfo('template_directory')?>/js/html5.js"></script><![endif]-->
<?php 
$trakcd = of_get_options( 'google_analytics', '');if(!empty($trakcd)){echo $trakcd;}
$cssad = of_get_options( 'css_adicional', '');if(!empty($cssad)){echo '<style>'.$cssad.'</style>';}
?>
</head>
<body <?php body_class(); ?>>
<div id="loading"><div id="bowlG"><div id="bowl_ringG"></div></div></div>
<header id="menu_top" role="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div id="logo">
                    <?php if((!is_single()) && (!is_page()) && (!is_category()) && (!is_archive())){ $hetiq = "h1"; }else{$hetiq = "h2";} ?>
                    <a  class="dpnh1" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
		        <<?=$hetiq?>><?php bloginfo('name'); ?></<?=$hetiq?>>
		    </a>
                </div>
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menu_header_mt">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <?php wp_nav_menu( array('theme_location' => 'MenuPrincipal', 'container' => 'div', 'container_class' => 'collapse navbar-collapse', 'container_id' => 'menu_header_mt'  )); ?>
  			</div>
   			<div class="col-md-3">
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</header>
<div class="container contentweb">
	<div class="row">
        <?php if(is_home() || is_archive() || is_category()){ ?>
        <div class="sliderwrap">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="slider_top">
                        <?php 
						$canthome = of_get_options( 'canthome', '' );
                        if(is_category()){
							$sliderhome= single_cat_title("", false); 
							$idcat = get_cat_ID($sliderhome);
							$idcat .= '&meta_key=post_views_count&orderby=meta_value_num&order=DESC';
						}else{
							$sliderhome= of_get_options( 'sliderhome', '' ); 
							$idcat = get_cat_ID($sliderhome);
						}
                        $my_query = new WP_Query('showposts='.$canthome.'&ignore_sticky_posts=1&cat='.$idcat.''); 
                        while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; 
                        $poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
                        $vote_average = get_post_meta($post->ID, "vote_average", $single = true);
                        ?>
                        <div class="item">
                            <div class="poster-media-card">
                                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                    <div class="poster">
                                        <span class="rating">
                                            <i class="glyphicon glyphicon-star"></i><span class="rating-number"><?php show_info($vote_average); ?></span>
                                        </span>
                                        <div class="poster-image-container">
                                            <img width="185" height="263" src="<?php image_show($poster_path, "url", "w185"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <?php endwhile; wp_reset_query();  ?>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        <?php } ?>