<a data-toggle="collapse" href="#showalltoa" aria-expanded="false" aria-controls="showalltoa" style="margin:10px 0; float:right;" class="btn btn-default btn-sm"><?php _e('Add link', 'masthemes'); ?></a>
<div id="showalltoa" class="formaddla collapse well">
<h2><?php _e('Add link', 'masthemes'); ?></h2>
<form id="addnowen">
	<div class="lbltopb btn-group btn-group-sm" data-toggle="buttons">
		<label class="btn btn-primary active"><input type="radio" name="Idioma" value="<?php _e('Latin', 'masthemes'); ?>" autocomplete="off" checked><?php _e('Latin', 'masthemes'); ?></label>
  		<label class="btn btn-primary"><input type="radio" name="Idioma" value="<?php _e('Spanish', 'masthemes'); ?>" autocomplete="off"> <?php _e('Spanish', 'masthemes'); ?></label>
  		<label class="btn btn-primary"><input type="radio" name="Idioma" value="<?php _e('Subtitled', 'masthemes'); ?>" autocomplete="off"> <?php _e('Subtitled', 'masthemes'); ?></label>
  		<label class="btn btn-primary"><input type="radio" name="Idioma" value="<?php _e('English', 'masthemes'); ?>" autocomplete="off"> <?php _e('English', 'masthemes'); ?></label>
  		<label class="btn btn-primary"><input type="radio" name="Idioma" value="<?php _e('Russian', 'masthemes'); ?>" autocomplete="off"> <?php _e('Russian', 'masthemes'); ?></label>
	</div>
	<div class="lbltopb btn-group btn-group-sm" data-toggle="buttons">
		<label class="btn btn-primary active"><input type="radio" name="Calidad" value="Cam" autocomplete="off" checked>Cam</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="Ts Screener" autocomplete="off"> Ts Screener</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="Dvd Screener" autocomplete="off"> Dvd Screener</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="Dvd Rip" autocomplete="off"> Dvd Rip</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="BR-Screener" autocomplete="off">BR-Screener</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="HD Rip 320" autocomplete="off">HD Rip 320</label>
  		<label class="btn btn-primary"><input type="radio" name="Calidad" value="HD Real 720" autocomplete="off">HD Real 720</label>
	</div>
	<div class="lbltopb btn-group btn-group-sm" data-toggle="buttons">
		<label class="btn btn-primary active inputxt"><input type="radio" name="Tipo" value="1" autocomplete="off" checked> <?php _e('Download', 'masthemes'); ?></label>
  		<label class="btn btn-primary inputxt"><input type="radio" name="Tipo" value="2" autocomplete="off"> <?php _e('Online', 'masthemes'); ?></label>
        <label class="btn btn-primary iframechg"><input type="radio" name="Tipo" value="4" autocomplete="off"> <?php _e('iFrame', 'masthemes'); ?></label>
	</div>
	<div class="lbltopb input-group">
    		<input type="url" name="Enlace" id="enlace" class="form-control" placeholder="<?php _e('Link', 'masthemes'); ?>..." required="required" autocomplete="off">
    		<input type="hidden" name="PID" value="<?php the_ID(); ?>" id="pid" >
		<div class="input-group-btn"><button type="button" class="btn btn-default" id="addnewk"><?php _e('Add', 'masthemes'); ?></button></div>
	</div>
</form>
<div class="clear"></div>
<hr style="border-top: 1px solid #ccc" />
<?php  if(function_exists('import_mt')) { import_mt($post->ID); } ?>
<div class="clear"></div>
</div>
<div class="clear"></div>