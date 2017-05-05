<?php get_header();?>
<div id="primary" class="content-area page_area">
	<div class="container">
    	<div class="row">
            <section class="showpeliculas col-mt-8">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <span class="subth3"><?php _e('Posted', 'masthemes'); ?> <?php the_time('d F, Y', '', ''); ?></span>
                <div class="clear"></div>
                <?php get_template_part("static/social"); ?>
                <div class="clear"></div>
                <div class="col-xs-12 contentpag">
                	<?php the_content();?>
				</div>
            	<?php endwhile; endif; ?>
				<div class="clear"></div>
			</section>
	     	<?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>