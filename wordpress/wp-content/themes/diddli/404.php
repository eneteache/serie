<?php get_header(); ?>
<div id="primary" class="content-area content404">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><?php _e('¡Ups! Page not found', 'masthemes'); ?></h2>
				<h3><?php _e('[cod.404]', 'masthemes'); ?></h3>
				<p><?php _e('It seems that the section you are looking for does not exist or is not available at this time.', 'masthemes'); ?></p>
				<div>
                	<a href="javascript:history.back();"><?php _e('Back to previous page', 'masthemes'); ?></a> · <a href="<?php echo home_url(); ?>"><?php _e('Go to the homepage', 'masthemes'); ?></a>
                </div>
			</div>
		</div>
	</div>
</div>
<div class="sliderwrap">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="slider_top">
                <?php 
                $sliderhome= of_get_options( 'sliderhome', '' ); 
                $idcat = get_cat_ID($sliderhome);
                $canthome = of_get_options( 'canthome', '' ); 
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
                                    <img src="<?php image_show($poster_path, "url", "w300"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
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
<?php get_footer(); ?>