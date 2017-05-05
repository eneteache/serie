<div class="searchbm">
	<form action="<?php bloginfo('url'); ?>/" method="get" class="input-group serachmt">
		<input name="s" value="<?php the_search_query(); ?>" type="text" placeholder="<?php _e('Search movie', 'masthemes'); ?>..." class="form-control" autocomplete="off">
        <div class="input-group-btn">
        	<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
    	</div>
  	</form>
</div>