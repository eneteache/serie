<?php get_header(); ?>
<?php if(get_post_type( get_the_ID() ) ==  __('news', 'masthemes')){ ?>
<div id="primary" class="content-area page_area">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<ul class="destacnotivias">
		     		<?php $args = array( 'post_type' =>  __('news', 'masthemes'), 'posts_per_page' => 3,  'post__not_in' => array($post->ID) );
				$loop = new WP_Query( $args );
				while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li class="noticla_li">
					<a href="<?php the_permalink();?>">
						<?php the_post_thumbnail('medium');?>
						<h3><?php the_title(); ?></h3>
					</a>
				</li>
				<?php endwhile; wp_reset_query(); ?>
				</ul>
	     		</div>
	        	<section class="col-md-7 noticiasfull">
	        	<?php
	        	$argss = array(
				'before'           => '' .__('<span class="pages">Pages:</span> <div class="pag">', 'masthemes'),
				'after'            => '</div>',
				'link_before'      => '<span class="current">',
				'link_after'       => '</span>',
				'next_or_number'   => 'number',
				'pagelink'         => '%',
				'echo'             => 1
			);
			?>
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                	<h1><?php the_title(); ?></h1>
                	<span class="subth3"><?php _e('Posted', 'masthemes'); ?> <?php the_time('d F, Y', '', ''); ?></span>
                	<div class="clear"></div>
                	<?php get_template_part("static/social"); ?>
                	<div class="clear"></div>
                	<div class="pagenotc ">
	                	<div class="pagenavi_noticias">
					 <?php wp_link_pages( $argss ); ?>
				</div>
	                	<?php the_content();?>
	                	<div class="pagenavi_noticias">
					 <?php wp_link_pages( $argss ); ?>
				</div>
			</div>
			<?php comments_template( '', true ); ?>
            		<?php endwhile; endif; ?>
			<div class="clear"></div>
			</section>
	     		<div class="col-md-3">
	     			<div class="advertisment">
		            		<?php $banner_1 = of_get_options( 'banner_1', '' ); if(empty($banner_1)){  ?>
					<img src="<?php echo get_bloginfo('template_url') ?>/images/advertisment.jpg" class="img-responsive" />
					<?php }else{echo $banner_1;} ?>
				</div>
				<div class="widsin top_10">
		                	<h3><?php _e('Top 10', 'masthemes'); ?></h3>
		                    <ul class="tabtop10 nav btn-group" role="tablist">
		                        <li class="btn btn-default btn-xs active"><a href="#vistas10" role="tab" data-toggle="tab"><?php _e('Views', 'masthemes'); ?></a></li>
		                        <li class="btn btn-default btn-xs"><a href="#rating10" role="tab" data-toggle="tab"><?php _e('Rating', 'masthemes'); ?></a></li>
		                    </ul>
		                    <div class="tab-content">
		                        <ul id="vistas10" class="tab-pane active">
		                        <?php $my_query = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&showposts=10&ignore_sticky_posts=1');
		                        while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; ?>
		                        <li class="topli10">
		                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		                                <span class="title10"><?php the_title(); ?></span>
		                                <span class="cont10"><?php echo getPostViews(get_the_ID()); ?></span>
		                            </a>
		                        </li>
		                        <?php endwhile; wp_reset_query(); ?>
		                        </ul>
		                        <ul id="rating10" class="tab-pane">
		                        <?php query_posts(array('meta_key' => 'end_time','meta_compare' =>'>=','meta_value'=>time(),'meta_key' => 'vote_average',
		                        'post__not_in' => get_option( 'sticky_posts' ),'orderby' => 'meta_value_num','showposts' => '10','order' => 'DESC'));
		                        while ( have_posts() ) : the_post(); 
		                        $vote_average = get_post_meta($post->ID, "vote_average", $single = true); ?>
		                        <li class="topli10">
		                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		                                <span class="title10"><?php the_title(); ?></span>
		                                <span class="cont10"><?php show_info($vote_average); ?></span>
		                            </a>
		                        </li>
		                        <?php endwhile; wp_reset_query(); ?>
		                        </ul>
		                    </div>
		                </div>
	     		</div>
		</div>
	</div>
</div>
<?php }else { ?>
<div id="pelicula-full">
	<div class="container">
    	<div class="row">
        	<?php 
		while ( have_posts() ) : the_post(); setPostViews(get_the_ID());
		$estilos =  get_post_meta( $post->ID, 'my_key', true );
		if(($estilos == 'tipo1') || (empty($estilos))){
			get_template_part("loop/loop-single");
		}
		if($estilos == 'tipo2'){
			get_template_part("loop/loop-single2");
		}
		if($estilos == 'tipo3'){
			get_template_part("loop/loop-single3");
		}
		endwhile; ?>
            <div class="col-md-3 ladotres">
            	<div class="advertisment">
            		<?php $banner_1 = of_get_options( 'banner_1', '' ); if(empty($banner_1)){  ?>
			<img src="<?php echo get_bloginfo('template_url') ?>/images/advertisment.jpg" class="img-responsive" />
			<?php }else{echo $banner_1;} ?>
		</div>
            	<div class="widsin related-pelicula">
                	<h3><?php _e('Related movies', 'masthemes'); ?></h3>
                    <ul class="col-xs-12 relatedpost">
					<?php
					$categories = get_the_category($post->ID);
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args=array(
					  'category__in' => $category_ids,
					  'orderby' => 'date',
					  'order' => 'DESC',
					  'post__not_in' => array($post->ID),
					  'posts_per_page'=> 3,
					  'caller_get_posts'=>1
					);
					query_posts($args);
					if (have_posts()) : while (have_posts()) : the_post();
					$poster_path = get_post_meta($post->ID, "poster_path", $single = true);
					$overview = get_post_meta($post->ID, "overview", $single = true);
					 ?>
                    <li class="col-xs-12 recomend_posts">
                        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                            <img src="<?php image_show($poster_path, "url", "w90"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
                            <h3><?php the_title(); ?></h3>
                            <p><?php $newoverview = substr($overview,0,63).'...'; show_info($newoverview); ?></p>
                        </a>
                    </li>
                    <?php endwhile; endif; wp_reset_query(); ?>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="widsin top_10">
                	<h3><?php _e('Top 10', 'masthemes'); ?></h3>
                    <ul class="tabtop10 nav btn-group" role="tablist">
                        <li class="btn btn-default btn-xs active"><a href="#vistas10" role="tab" data-toggle="tab"><?php _e('Views', 'masthemes'); ?></a></li>
                        <li class="btn btn-default btn-xs"><a href="#rating10" role="tab" data-toggle="tab"><?php _e('Rating', 'masthemes'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <ul id="vistas10" class="tab-pane active">
                        <?php $my_query = new WP_Query('meta_key=post_views_count&orderby=meta_value_num&order=DESC&showposts=10&ignore_sticky_posts=1');
                        while ($my_query->have_posts()) : $my_query->the_post(); $do_not_duplicate = $post->ID; ?>
                        <li class="topli10">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <span class="title10"><?php the_title(); ?></span>
                                <span class="cont10"><?php echo getPostViews(get_the_ID()); ?></span>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_query(); ?>
                        </ul>
                        <ul id="rating10" class="tab-pane">
                        <?php query_posts(array('meta_key' => 'end_time','meta_compare' =>'>=','meta_value'=>time(),'meta_key' => 'vote_average',
                        'post__not_in' => get_option( 'sticky_posts' ),'orderby' => 'meta_value_num','showposts' => '10','order' => 'DESC'));
                        while ( have_posts() ) : the_post(); 
                        $vote_average = get_post_meta($post->ID, "vote_average", $single = true); ?>
                        <li class="topli10">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                <span class="title10"><?php the_title(); ?></span>
                                <span class="cont10"><?php show_info($vote_average); ?></span>
                            </a>
                        </li>
                        <?php endwhile; wp_reset_query(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } get_footer(); ?>