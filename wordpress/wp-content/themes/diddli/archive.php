<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
    	<div class="row">
            <section class="showpeliculas col-mt-8">
				<h1><?php _e('movies of', 'masthemes'); ?> <?php the_archive_title(''); ?></h1>
				<span class="subth3"><?php _e('Find all movies and documentaries of this month.', 'masthemes'); ?></span>
				<div class="showpost4 posthome">
					<?php 
					$estlpc = of_get_options( 'estlpc', '');
					if ( have_posts() ) : while ( have_posts() ) : the_post();
					if(($estlpc == __("Cover + Category + Tittle", 'masthemes')) || empty($estlpc)){
					get_template_part("loop/loop"); 
					}else{
					get_template_part("loop/loop", "style2"); 
					}
					endwhile; endif; ?>
                    <div class="clear"></div>
				</div>
				<div class="clear"></div>
				<?php if(function_exists('pagenavi')) { pagenavi(); } ?> 
                <div class="clear"></div>     
            </section>
	     	<?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer() ?>