<?php
/* Loop Name: Post Estilo 2 */ 
$backdrop_path = get_post_meta($post->ID, "backdrop_path", $single = true);
$poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
$runtime = get_post_meta($post->ID, "runtime", $single = true);
$release_date = get_post_meta($post->ID, "release_date", $single = true); 
$status = get_post_meta($post->ID, "status", $single = true); 
$images = get_post_meta($post->ID, "images", $single = true); 
$genres = get_post_meta($post->ID, "genres", $single = true); 
?>
<div class="col-md-9 ladodos tipo2">
	<div id="bacmovt" class="background-pelicula" style="background-image:url(<?php image_show($backdrop_path, "url", "w600"); ?>)">
    		<h1 class="media-title"><?php the_title(); ?></h1>
    		<div class="clear"></div>
    		<?php get_template_part("static/social"); ?>
    		<div class="media-summary">
        		<span class="hz-text-indicator"><?php _e('Movie of', 'masthemes'); ?> <?php show_info($release_date); ?></span>
        		<span class="hz-text-indicator"><?php show_info($runtime); ?> min.</span>
       			<span class="hz-text-indicator"><?php show_info($status); ?></span>
		</div>
	</div>
	
	<div class="col-mt-2 ladouno">
	<div class="row">
	<figure>
		<img class="img-responsive" src="<?php image_show($poster_path, "url", "w396"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
	</figure>
	<div class="botoncitos">
		<ul class="nav nav-tabs baroptions">
			<li class="active"><a href="#enlaces" data-toggle="tab"><span class="glyphicon glyphicon-download"></span><?php _e('General', 'masthemes'); ?></a></li>
			<li><a href="#informacion" data-toggle="tab"><span class="glyphicon glyphicon-info-sign"></span><?php _e('Information', 'masthemes'); ?></a></li>
			<li><a href="#multimedia" data-toggle="tab"><span class="glyphicon glyphicon-film"></span><?php _e('Multimedia', 'masthemes'); ?></a></li>
			<li><a href="#produccion" data-toggle="tab"><span class="glyphicon glyphicon-facetime-video"></span><?php _e('Production', 'masthemes'); ?></a></li>
			<li><a href="#cometarios" data-toggle="tab"><span class="glyphicon glyphicon-comment"></span><?php _e('Comments', 'masthemes'); ?></a></li>
		</ul>
	</div>
	<div class="clear"></div>
	<?php get_template_part("static/stars"); ?>
	<div class="clear"></div>
	
	</div>
	</div>
	<?php /////////MASTHEMS//////// ?>
	<div class="col-mt-8 tab-content tabtipo2">
		<div id="enlaces" class="tab-pane active">
			<h2>Sinopsis</h2>
			<p><?php $overview = get_post_meta($post->ID, "overview", $single = true); show_info($overview); ?></p>
			<div class="clear"></div>
			<?php if(function_exists('repromt_get')){repromt_get($post->ID);} ?>
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
		</div>
		<div id="informacion" class="tab-pane">	                        
			<h2><?php _e('Title in English', 'masthemes'); ?></h2>
			<p><?php $title = get_post_meta($post->ID, "title", $single = true); show_info($title); ?></p>
			<h2><?php _e('Original title', 'masthemes'); ?></h2>
			<p><?php $original_title = get_post_meta($post->ID, "original_title", $single = true); show_info($original_title); ?></p>
			<h2><?php _e('Release year', 'masthemes'); ?></h2>
			<p><?php show_info($release_date); ?></p>
			<h2><?php _e('Genres', 'masthemes'); ?></h2>
			<p><?php genero("", "url"); ?></p>
			<h2><?php _e('Duration', 'masthemes'); ?></h2>
			<p><?php show_info($runtime); ?> min.</p>
			<h2><?php _e('Status', 'masthemes'); ?></h2>
			<p><?php show_info($status); ?></p>
			<h2><?php _e('Rating', 'masthemes'); ?></h2>
			<p><?php $vote_average = get_post_meta($post->ID, "vote_average", $single = true); $vote_count = get_post_meta($post->ID, "vote_count", $single = true); show_info($vote_average); ?> de <?php show_info($vote_count);  ?> <?php _e('votes', 'masthemes'); ?></p>
			<h2><?php _e('Writers', 'masthemes'); ?></h2>
			<p><?php escritores_show("", ""); ?></p>
			<h2><?php _e('Director', 'masthemes'); ?></h2>
			<p><?php directores_show("", ""); ?></p>
			<h2><?php _e('Actors', 'masthemes'); ?></h2>
			<p><?php actores_show("", ""); ?></p>
			<div class="clear"></div>
		</div>
		<div id="multimedia" class="tab-pane">
			<h2><?php _e('Screenshots', 'masthemes'); ?></h2>
			<ul id="captura_movie" class="carrucelcaratulas">
				<?php capturas_show($images,"w300"); ?>
			</ul>
			<i><?php _e('Screenshots of', 'masthemes'); ?> <?php the_title(); ?></i>
			<div class="clear"></div>
			<h2><?php _e('Trailer', 'masthemes'); ?></h2>
			<?php $trailers = get_post_meta($post->ID, "trailers", $single = true); trailer_show($trailers) ?>
			<div class="clear"></div>
		</div>
		<div id="produccion" class="tab-pane">
			<h2><?php _e('Actors', 'masthemes'); ?></h2>
			<?php $cast = get_post_meta($post->ID, "cast", $single = true); actores_show($cast , "img"); ?>
			<h2><?php _e('Director', 'masthemes'); ?></h2>
			<?php $crew_director = get_post_meta($post->ID, "crew_director", $single = true); directores_show($crew_director , "img"); ?>
			<h2><?php _e('Writers', 'masthemes'); ?></h2>
			<?php $crew_writ = get_post_meta($post->ID, "crew_writ", $single = true); escritores_show($crew_writ , "img"); ?>
			<div class="clear"></div>
		</div>
		<div id="cometarios" class="tab-pane">
			<?php comments_template( '', true ); ?>
			<div class="clear"></div>
		</div>
	</div>
	<div class="clear"></div>
</div>