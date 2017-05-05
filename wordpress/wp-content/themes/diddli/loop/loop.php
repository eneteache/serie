<?php 
/* Loop Name: Post */ 
$poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
$vote_average = get_post_meta($post->ID, "vote_average", $single = true);
?>
<div class="col-mt-5 postsh">
	<div class="poster-media-card">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<div class="poster">
				<div class="title">
					<span class="under-title"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>
				</div>
				<span class="rating">
					<i class="glyphicon glyphicon-star"></i><span class="rating-number"><?php show_info($vote_average); ?></span>
				</span>
				<div class="poster-image-container">
					<img width="300" height="428" src="<?php image_show($poster_path, "url", "w185"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
				</div>
			</div>
		</a>
		<div class="info">
			<a href="<?php the_permalink(); ?>" class="info-title one-line"><h2><?php the_title(); ?></h2></a>
		</div>
	</div>
</div>