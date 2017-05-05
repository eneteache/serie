<?php
include_once ('yaske.php');
function cargar_js() {
	if(is_single()){
		if(current_user_can( 'manage_options' )) {
			wp_enqueue_script('import', get_template_directory_uri().'/js/import.js', array('jquery'), '1.0', true );
		}		
	}
}    
add_action('wp_enqueue_scripts', 'cargar_js');
function import_mt($id){
	echo '<h2>'.__('Import', 'masthemes').'</h2>';
	echo '<form id="importermts">';
	echo '<div class="lbltopb btn-group btn-group-sm" data-toggle="buttons">';
  	echo '<label class="btn btn-primary active"><input type="checkbox" autocomplete="off" name="TipoIm[]" value="1" checked>'.__('Download', 'masthemes').'</label>';
  	echo '<label class="btn btn-primary"><input type="checkbox" autocomplete="off" name="TipoIm[]" value="2">'.__('Online', 'masthemes').'</label>';
  	echo '</div>';
	echo '<div class="input-group">';
	echo '<input name="URL" type="url" placeholder="'.__('Link', 'masthemes').'" class="form-control" />';
	echo '<div class="input-group-btn" style="width: 20%;">';
	echo '<select name="Server" class="form-control">';
	$directorio=opendir(dirname(__FILE__).'/'); 
	while ($archivo = readdir($directorio)){
		if (($archivo<>".")&& ($archivo<>"..")){
			if((@$archivo != "index.php") && (@$archivo != "configuracion.php"))
				echo '<option value="'.@$archivo.'">'.@ucwords(substr($archivo,0,-4)).'</option>'; 
		}
	}
	echo '</select></div>';
	echo '<div class="input-group-btn"><button class="btn btn-default" id="importermt" type="button">'.__('Import', 'masthemes').'</button></div>';
	echo '</div>';
	echo '<br /><a href="https://masthemes.com/" rel="nofollow">'.__('For more importers contact to masthemes.com', 'masthemes').'</a>';
	echo '<input type="hidden" name="ID" value="'.$id.'" id="id" >';
	echo '</form>';
}
if(current_user_can( 'manage_options' )) {
	add_action('wp_ajax_importermts', 'importermts');
	add_action( 'wp_ajax_nopriv_importermts', 'importermts');
	function importermts(){
		$return = $_POST;
		if($return['Server'] == 'yaske.php') yaske_importer($return);
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
}