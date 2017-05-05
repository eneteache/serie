<?php 
/* Loop Name: Post Estilo 2 */ 
$backdrop_path = get_post_meta($post->ID, "backdrop_path", $single = true);
$vote_average = get_post_meta($post->ID, "vote_average", $single = true);
?>
<div class="col-md-4 loph2">
	<div class="poster-media-card">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="poster" style="border-radius: 5px;">
				<div class="title">
					<h2 class="under-title"><?php the_title(); ?></h2>
				</div>
				<span class="rating">
					<i class="glyphicon glyphicon-star"></i><span class="rating-number"><?php show_info($vote_average); ?></span>
				</span>
				<div class="poster-image-container">
					<img src="<?php image_show($backdrop_path, "url", "w396"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
				</div>
			</div>
		</a>
		<div class="info">
			<a href="<?php the_permalink(); ?>" class="info-title one-line"></a>
		</div>
	</div>
</div>