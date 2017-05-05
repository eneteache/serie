<?php
/*
Template Name: Lista de Peliculas
*/
get_header(); ?>
<div id="primary" class="content-area page_area listall_area">
	<div class="container">
    	<div class="row">
            <section class="showpeliculas col-mt-8">
                <h1><?php _e('List of movies', 'masthemes'); ?></h1>
                <span class="subth3"><?php _e('See our full repertoire of movies.', 'masthemes'); ?></span>
                <div class="boxsearch col-xs-12">
                	<input placeholder="Busqueda instantanea" id="busqbox" type="text" class="form-control" /> 
				</div>
				<?php 
                $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'");
				if (0 < $numposts) $numposts = number_format($numposts);
                $myposts = get_posts('numberposts=-1&orderby=title&order=ASC'); 
				echo '<ul class="navlistpeliculas">';
				foreach($myposts as $post){
				$vote_average = get_post_meta($post->ID, "vote_average", $single = true);
				$release_date = get_post_meta($post->ID, "release_date", $single = true); 
				$poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
				?>
                <li class="liasds col-xs-12">
                    <div class="media-row-card col-xs-12">
                    	<div class="event-time">
							<div class="ratings"><?php show_info($vote_average); ?></div>
							<span class="time"><?php _e('Rate', 'masthemes'); ?></span>
						</div>
                        <div class="infom">
                            <img src="<?php image_show($poster_path, "url", "w45"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><h2 class="titlelist"><?php the_title(); ?></h2></a>
                            <b><?php _e('Movie of', 'masthemes'); ?> <?php show_info($release_date); ?></b>
                            <p><b><?php _e('Director:', 'masthemes'); ?></b> <?php directores_show("", ""); ?></p>
                    	</div>
                	</div>
                </li>
                <?php
				}
				echo '</ul>';
				?>
				<div class="clear"></div>
			</section>
	     	<?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>