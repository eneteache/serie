<?php get_header(); ?>
<div id="primary" class="content-area searchnow">
	<div class="container">
    	<div class="row">
            <section class="showpeliculas col-mt-8">
				<?php get_search_form() ?>
                <p class="num-resultados">
                <?php $allsearch = &new WP_Query("s=$s&showposts=-1");
                $key = wp_specialchars($s, 1);
                $count = $allsearch->post_count; _e('');
                echo $count . ' ';
                _e('Sorry , we cant find results of your term search.', 'masthemes');
                wp_reset_query(); ?>
                </p>
                <div class="clear"></div>
                <?php if ( have_posts() ) : ?>
				<ul class="search-results-content infinite">
					<?php  while ( have_posts() ) : the_post();
                    get_template_part("loop/loop-list");
                    endwhile; ?>
				</ul>
                <?php
				else:  ?>
				<?php endif; ?>
				<div class="clear"></div>
				<?php if(function_exists('pagenavi')) { pagenavi(); } ?> 
                <div class="clear"></div>     
            </section>
	     <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer() ?>