<?php
/* Loop Name: Post Estilo 3 */ 
$backdrop_path = get_post_meta($post->ID, "backdrop_path", $single = true);
$poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
$runtime = get_post_meta($post->ID, "runtime", $single = true);
$release_date = get_post_meta($post->ID, "release_date", $single = true); 
$status = get_post_meta($post->ID, "status", $single = true); 
$images = get_post_meta($post->ID, "images", $single = true); 
$genres = get_post_meta($post->ID, "genres", $single = true); 
?>
<div class="col-md-9 ladodos tipo3">
	<h1 class="media-title"><?php the_title(); ?></h1>
	<div class="subth3">
        	<span class="hz-text-indicator"><?php _e('Movie of', 'masthemes'); ?> <?php show_info($release_date); ?></span>
        	<span class="hz-text-indicator"><?php show_info($runtime); ?> min.</span>
       		<span class="hz-text-indicator"><?php show_info($status); ?></span>
	</div>
	<?php get_template_part("static/social"); ?>
	<div class="clear"></div>
	<div class="col-md-3 tip3a0">
		<figure>
			<img class="img-responsive" src="<?php image_show($poster_path, "url", "w396"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
			<div class="clear"></div>
		</figure>
		<div class="clear"></div>
	</div>
	<div class="col-md-9 tip3r0">
		<p><?php $overview = get_post_meta($post->ID, "overview", $single = true); show_info($overview); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Title in English', 'masthemes'); ?></h2>
		<p><?php $title = get_post_meta($post->ID, "title", $single = true); show_info($title); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Original title', 'masthemes'); ?></h2>
		<p><?php $original_title = get_post_meta($post->ID, "original_title", $single = true); show_info($original_title); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Genres', 'masthemes'); ?></h2>
		<p><?php genero("", "url"); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Writers', 'masthemes'); ?></h2>
		<p><?php escritores_show("", ""); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Director', 'masthemes'); ?></h2>
		<p><?php directores_show("", ""); ?></p>
		<div class="clear"></div>
		<h2 class="tip3"><?php _e('Actors', 'masthemes'); ?></h2>
		<p><?php actores_show("", ""); ?></p>
		<div class="clear"></div>
	</div>	
	<div class="clear"></div>
	<div id="reproductor">
		<div class="col-mt-8 tip3a0">
			<?php if(function_exists('repromt_get')){repromt_get($post->ID);} ?>
			<div class="clear"></div>
		</div> 
		<div class="col-mt-2 tip3r0">
			<?php get_template_part("static/stars"); ?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
	<?php if(function_exists('dlmt_get')) { dlmt_get($post->ID, "2"); } ?>
	<div class="advertisment advs3">
		<?php $banner_2 = of_get_options( 'banner_2', '' ); if(empty($banner_2)){  ?>
		<img src="<?php bloginfo('template_directory')?>/images/advertisment3.jpg" class="img-responsive" />
		<?php }else{echo $banner_2;} ?>
	</div>
	<?php if(function_exists('dlmt_get')) { dlmt_get($post->ID, "1"); } ?>
	<div class="clear"></div>
	<?php if(current_user_can( 'manage_options' )) { get_template_part("masthemes/descargas/modal"); } ?>
	<div class="clear"></div>
	<div id="multimedia">
		<h2><?php _e('Screenshots', 'masthemes'); ?></h2>
		<ul id="captura_movie" class="carrucelcaratulas">
			<?php capturas_show($images,"w300"); ?>
		</ul>
		<i><?php _e('Screenshots of', 'masthemes'); ?> <?php the_title(); ?></i>
		<div class="clear"></div>
	</div>
	<?php comments_template( '', true ); ?>
	<div class="clear"></div>
</div>