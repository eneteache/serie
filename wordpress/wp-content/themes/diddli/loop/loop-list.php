<?php 
/* Loop Name: Post List */ 
$poster_path = get_post_meta($post->ID, "poster_path", $single = true); 
$vote_average = get_post_meta($post->ID, "vote_average", $single = true);
$release_date = get_post_meta($post->ID, "release_date", $single = true);
$overview = get_post_meta($post->ID, "overview", $single = true); 
?>
<li class="col-md-12 itemlist">
	<div class="list-score"><?php show_info($vote_average); ?></div>
	<div class="col-xs-2">
		<div class="row">
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php image_show($poster_path, "url", "w300"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
			</a>
		</div>
	</div>
	<div class="col-xs-10">
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<h2 class="title-list"><?php the_title(); ?></h2 >
		</a>
		<div class="clear"></div>
		<p class="main-info-list"><?php _e('Movie of', 'masthemes'); ?> <?php show_info($release_date); ?></p>
		<p class="text-list"><?php $newoverview = substr($overview,0,250).'...'; show_info($newoverview); ?></p>
	</div>
</li>