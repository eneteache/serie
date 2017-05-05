<?php
$vote_average = get_post_meta($post->ID, "vote_average", $single = true);
$vete_num = get_post_meta($post->ID, "vote_count", $single = true); 
$strellas ="";
$nestar = round($vote_average);
$nestar1 = explode(".",$vote_average);
for($i = 1; $i <= 10; $i++){
	if($i <= $nestar1[0]){
		$strellas .= '<img src="'.get_bloginfo('template_directory').'/images/rating_on.gif" alt="'.$i.' Estrella" />';
	}
	if($i == ($nestar1[0] + 1)){
		if($nestar1[1] >= 5){
			$strellas .= '<img src="'.get_bloginfo('template_directory').'/images/rating_half.gif" alt="'.$i.' Estrella" />';
		}else{
			$strellas .= '<img src="'.get_bloginfo('template_directory').'/images/rating_off.gif" alt="'.$i.' Estrella" />';
		}

	}
	if($i > ($nestar1[0]+1)){
		$strellas .= '<img src="'.get_bloginfo('template_directory').'/images/rating_off.gif" alt="'.$i.' Estrella" />';
	}
}
?>
<div class="menu_votos">
	<div class="votos_izq">
		<h4 style=""><?php _e('IMDB Rate', 'masthemes'); ?></h4>
		<span class="valoracion"><?php show_info($vote_average); ?></span>
        	<span class="num_votos"><?php _e('Total votes:', 'masthemes'); ?>: <?php show_info($vete_num); ?></span>
        	<span class="titulo"><?=$strellas?></span>
    	</div>
	<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
</div>