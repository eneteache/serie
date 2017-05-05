<?php get_header(); ?>
<div id="primary" class="content-area">
	<div class="container">
    	<div class="row">
            <section class="showpeliculas col-mt-8">
                <h3><?php _e('Last movies', 'masthemes'); ?></h3>
                <span class="subth3"><?php _e('Find all movies, tv shows and documentaries.', 'masthemes'); ?></span>
                <div class="clear"></div>
				<div class="showpost4 posthome">
					<?php 
					$estlpi = of_get_options( 'estlpi', '');
					if ( have_posts() ) : query_posts($query_string .'ignore_sticky_posts=1'); while ( have_posts() ) : the_post();
					if(($estlpi == __("Cover + Category + Tittle", 'masthemes')) || empty($estlpi)){
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