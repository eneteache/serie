<?php
function extractmt($separador1,$separador2,$cadena){
	  if(strpos($cadena,$separador1)!==false){
		$pos=strpos($cadena,$separador1);
		$a=substr($cadena,$pos+strlen($separador1));
		if(strpos($a,$separador2)!==false){
		  $npos=strpos($a,$separador2);
		  $b=substr($a,0,$npos);
		  	return $b;
		}else
		  return $a;
	    }else
		  return false;
}
function dlmt_get($id, $type) {
	
	if($type == "1"){$titns = "Descargar";$titnw ="Tipo = 1";}else{$titns = "Ver Online"; $titnw = "(Tipo = 2 OR Tipo = 3)";}
	if($type == "1"){$idsh = "dlnmt"; $iconm = 'cloud-download';}else{$idsh = "olmt";$iconm ='play';}
	Global $wpdb;
	$table_name = $wpdb->prefix . 'dlmt';
	$pedir = $wpdb->get_results("SELECT * FROM $table_name WHERE PID = '".$id."' AND ".$titnw." ORDER BY LID",OBJECT);
	$html='';
	$contador = 1;
	foreach ($pedir as $fila){
		$extractor=ucfirst(extractmt("www.",".",$fila->Enlace));
		if(empty($extractor)){
			$extractor=ucfirst(extractmt("//",".",$fila->Enlace));
		}
		if(current_user_can( 'manage_options' )) {
			$showck = '
			<td class="deleenla">
				<input type="checkbox" class="checklid" name="currency[]" value="'.$fila->LID.'">
			</td>
			<td class="deleenla">
				<a class="editlink btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>
			</td>
			';
		}
		$html=$html.'
			<tr>
			<td><a href="'.$fila->Enlace.'" class="btn btn-xs btn-info" rel="nofollow" target="_blank" style="min-width: 86px;"><span style="margin-right: 2px;" class="glyphicon glyphicon-'.$iconm.'" aria-hidden="true"></span> Opcion '.$contador.'</a></td>
			<td><img src="http://www.google.com/s2/favicons?domain='.$fila->Enlace.'" title="'.$extractor.'" style="margin: 0 3px 0 0;" /><span>'.$extractor.'</span></td>
			<td>'.$fila->Idioma.'</td>
			<td>'.$fila->Calidad.'</td>
			'.$showck.'
			</tr>';
		$contador++;
	}
	echo '<h2 class="dlmt">';
	if($type == "1"){echo __('Download options', 'masthemes');}else{echo __('Online options', 'masthemes');}
?>
	</h2>
    <div class="clear"></div>
    <div class="table-responsive dlmt" id="<?=$idsh?>">
		<?php if(current_user_can( 'manage_options' )) { ?>
		<form>
		<?php } ?>
		<table class="table table-hover">
			<thead>
				<tr>
					<th width="20%"><?php  _e('Option', 'masthemes'); ?></th>
					<th width="25%"><?php  _e('Server', 'masthemes'); ?></th>
                    <th <?php if(current_user_can( 'manage_options' )){ echo 'width="20%"'; }else{ echo'width="25%"'; } ?>><?php  _e('Language', 'masthemes'); ?></th>
                    <th <?php if(current_user_can( 'manage_options' )){ echo 'width="20%"'; }else{ echo'width="25%"'; } ?>><?php  _e('Quality', 'masthemes'); ?></th>
                    <?php if(current_user_can( 'manage_options' )) { ?>
                    <th class="deleenla">
                    	<a class="diliti btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
                    </th>
                    <th class="deleenla">
                    	<?php if($type == "2"){ ?>
                    	<a class="starrepro btn btn-xs btn-warning"><span class="glyphicon glyphicon-facetime-video" aria-hidden="true"></span></a>
                    	<?php } ?>
                    </th>
                    <?php } ?>
                </tr>
			</thead>
			<tbody>
				<?php if ($html!=''){
				echo $html;
				}else{
				if(current_user_can( 'manage_options' )){$colasjq = "6";}else{$colasjq = "4";}
				echo '<td colspan="'.$colasjq.'" class="noexist'.$type.'">'.__('No links available at the moment.', 'masthemes').'</td>';	} ?>
			</tbody>
		</table>
		<?php if(current_user_can( 'manage_options' )) { ?>
		</form>
		<?php } ?>
	</div>
<?php
}
function repromt_get($id) {
	$name_fake = of_get_options( 'name_fake', ''); if(empty($name_fake)){$name_fake = __('Advertising', 'masthemes');} 
	$repas4 = of_get_options( 'repro_4', '' );if(empty($repas4)){$max_a = 3;}
	$repas3 = of_get_options( 'repro_3', '' );if(empty($repas3)){$max_a = 2;}
	$repas2 = of_get_options( 'repro_2', '' );if(empty($repas2)){$max_a = 1;}
	$num_repro = rand(1, $max_a);
	$repro_1 = of_get_options( 'repro_'.$num_repro, '' );
	$poster_path = get_post_meta($id, "poster_path", $single = true);
	$runtime = get_post_meta($id, "runtime", $single = true);
	$images = get_post_meta($id, "images", $single = true); 
	$estilos =  get_post_meta( $id, 'my_key', true );
	$trailers = get_post_meta($id, "trailers", $single = true);
	Global $wpdb;
	$table_name = $wpdb->prefix . 'dlmt';
	$pedir = $wpdb->get_results("SELECT * FROM $table_name WHERE PID = '".$id."' AND (Tipo = 3 OR Tipo = 4) ORDER BY LID",OBJECT);
	$html='';
	$html1='';
	$contador = 1;
	foreach ($pedir as $fila){
		$html1=$html1.'<li><a href="#embed'.$contador.'" data-toggle="tab">'.$fila->Idioma.'</a></li>';
		if($fila->Tipo == 3){
			$mostre = '<iframe src="'.$fila->Enlace.'" width="607" height="360" frameborder="0"></iframe>';
		}else{
			$mostre = stripslashes($fila->Enlace); 
		}
		$html=$html.'
			<div class="tab-pane reproductor repron" id="embed'.$contador.'">
			<div class="calishow">'.$fila->Calidad.'</div>
					'.$mostre.'
				<div class="clear"></div>
				<a class="diliti1" id="'.$fila->LID.'" style="position:relative">Eliminar reproductor</a>		
			</div>';
		$contador++;
	}
?>
<ul class="nav nav-pills reprobut">
	<li class="active"><a href="#repron" data-toggle="tab">
		<span class="glyphicon glyphicon-fire" aria-hidden="true" style="margin-right:5px"></span><?=$name_fake?></a>
	</li>
	<?php if($estilos == 'tipo3'){ ?>
		<?php if(!empty($trailers)){ ?>
			<li><a href="#trailerpro" data-toggle="tab"><?php  _e('Trailer', 'masthemes'); ?></a></li>
		<?php } ?>
	<?php } ?>
	<?php if ($html1!=''){ ?>
		<?=$html1?>
	<?php } ?>
</ul>
<div class="tab-content">
	<div class="tab-pane reproductor repron active" id="repron" style="background-image:url(<?php campturas_show2($images,"w500"); ?>);">
		<a href="<?php echo $repro_1; ?>" target="_blank" rel="nofollow">
			<span class="glyphicon glyphicon-play"></span>
			<div class="titlebar">
				<div class="poster">
					<img src="<?php image_show($poster_path, "url", "w90"); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>" />
				</div>
				<div id="title" class="title"><strong><?php the_title(); ?></strong></div>
				<div class="info">
					<div class="time">
						<span class="glyphicon glyphicon-time"></span> <?php show_info($runtime); ?> min
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</a>
	</div>
	<?php if ($html!=''){ ?>
		<?=$html?>
	<?php } ?>
	<?php if($estilos == 'tipo3'){ ?>
		<?php if(!empty($trailers)){ ?>
		<div class="tab-pane reproductor repron" id="trailerpro">
			<?php trailer_show($trailers) ?>
		</div>
		<?php } ?>
	<?php } ?>
	<div class="clear"></div>
</div>
<?php
}
if(current_user_can( 'manage_options' )) {
	add_action('wp_ajax_delmt', 'delmt');
	add_action( 'wp_ajax_nopriv_delmt', 'delmt');
	function delmt() {
		$return = $_POST;
		$LID= explode(";", $return["LID"]);
		$count = count($LID);
		global $wpdb;
		$table_name = $wpdb->prefix . 'dlmt';
		for($i = 0; $i <= $count; $i++){
			$wpdb->query("DELETE FROM ".$table_name." WHERE LID = '".$LID[$i]."'");		
		}
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
	
	add_action('wp_ajax_delmt1', 'delmt1');
	add_action( 'wp_ajax_nopriv_delmt1', 'delmt1');
	function delmt1() {
		$return = $_POST;
		$LID= $return["LID"];
		global $wpdb;
		$table_name = $wpdb->prefix . 'dlmt';
		$wpdb->query("DELETE FROM ".$table_name." WHERE LID = '".$LID."'");		
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
	
	
	add_action('wp_ajax_starrepro', 'starrepro');
	add_action( 'wp_ajax_nopriv_starrepro', 'starrepro');
	function starrepro() {
		$return = $_POST;
		$LID= explode(";", $return["LID"]);
		$count = count($LID);
		global $wpdb;
		$table_name = $wpdb->prefix . 'dlmt';
		for($i = 0; $i <= $count; $i++){
			$wpdb->query("UPDATE ".$table_name." SET Tipo=3 WHERE LID = '".$LID[$i]."'");		
		}
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
	
	
	add_action('wp_ajax_editnoew', 'editnoew');
	add_action( 'wp_ajax_nopriv_editnoew', 'editnoew');
	function editnoew(){
		$return = $_POST;
		global $wpdb;
		$table_name = $wpdb->prefix . 'dlmt';
		$wpdb->query("UPDATE ".$table_name." SET Enlace='".$return["Enlace"]."', Idioma='".$return["Idioma"]."', Calidad='".$return["Calidad"]."' WHERE LID=".$return["LID"]."");
		$extractor=ucfirst(extractmt("www.",".",$return["Enlace"]));
			if(empty($extractor)){
				$extractor=ucfirst(extractmt("//",".",$return["Enlace"]));
		}
		if ($return["Enlace"]){
			$return["Enlace"] = $extractor;
		}  
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
	add_action('wp_ajax_adddlm', 'adddlm');
	add_action( 'wp_ajax_nopriv_adddlm', 'adddlm');
	function adddlm(){
		$return = $_POST;
		global $wpdb;
		$table_name = $wpdb->prefix . 'dlmt';
		$wpdb->insert( $table_name, array( 'Idioma' => $return['Idioma'],'Calidad' => $return['Calidad'], 'Enlace' => $return['Enlace'], 'PID' => $return['PID'], 'Tipo' => $return['Tipo']));
		$extractor=ucfirst(extractmt("www.",".",$return['Enlace']));
		if(empty($extractor)){
			$extractor=ucfirst(extractmt("//",".",$return['Enlace']));
		}
		if( $return['Tipo'] == "1"){$titns = "Descargar";}else{$titns = "Ver Online";}
		$showck = '
			<td class="deleenla">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true" title="'.__('Reload the page to unlock this option', 'masthemes').'">
			</td>
			<td class="deleenla">
				<span class="glyphicon glyphicon-refresh" aria-hidden="true" title="'.__('Reload the page to unlock this option', 'masthemes').'">
			</td>
		';
		$return['full'] = '
		<tr>
			<td><a href="'.$return['Enlace'].'" class="btn btn-xs btn-info" rel="nofollow" target="_blank">Opcion 0</a></td>
			<td><img src="http://www.google.com/s2/favicons?domain='.$return['Enlace'].'" title="'.$extractor.'" style="margin: 0 3px 0 0;" /><span>'.$extractor.'</span></td>
			<td>'.$return['Idioma'].'</td>
			<td>'.$return['Calidad'].'</td>
			'.$showck.'
		</tr>';
		$return["json"] = json_encode($return);
		echo json_encode($return);
		exit;
	}
}