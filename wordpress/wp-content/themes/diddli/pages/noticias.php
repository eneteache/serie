<?php 
/**
* @package WordPress
* @subpackage Diddli
*/
/*
Template Name: Noticias
*/
?>
<?php get_header();   ?>
<div id="primary" class="content-area page_area">
	<div class="container">
    	<div class="row">
            <section class="col-mt-8">
                <h3><?php the_title(); ?></h3>
                <span class="subth3"><?php _e('Check out latest developments of', 'masthemes'); ?> <?php bloginfo('name'); ?></span>
                <div class="clear"></div>
		<ul id="listalln">
<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;query_posts(array('post__not_in' => get_option( 'sticky_posts' ),'showposts' => '10','order' => 'DESC','post_type' =>  __('news', 'masthemes'),'paged' => $paged));?>
<?php while ( have_posts() ) : the_post(); ?>
				<li class="col-md-12 itemlist">
						<div class="col-xs-3"><?php the_post_thumbnail('medium');?></div>
						<div class="col-xs-9">
						<a href="<?php the_permalink();?>"><h2 class="txt"><?php the_title(); ?></h2></a>
						<?php the_excerpt() ?>
						<span class="subth3"><?php _e('Posted', 'masthemes'); ?> <?php the_time('d F, Y', '', ''); ?></span>
						</div>
				</li>
			<?php endwhile; ?>
		</ul>
		<div class="clear"></div>
		<?php if(function_exists('pagenavi')) { pagenavi(); } ?> 
                <div class="clear"></div>     
            </section>
	     <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer() ?>