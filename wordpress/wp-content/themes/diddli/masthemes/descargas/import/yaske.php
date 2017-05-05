<?php
function yaske_importer($return){
	global $wpdb;
	$table_name = $wpdb->prefix . 'dlmt';
	$url = $return['URL'];
	$i = 0;
	if(!empty($return['TipoIm'])) {
    		foreach($return['TipoIm'] as $check) {
            		$tipostoadd[$i] = $check;
            		$i++;
    		}
    	}
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	$data = curl_exec($ch);
	$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	curl_close($ch);
	preg_match_all("/<div class=\"table_info\">(.*?)<h3>(.*?)descargar<\/h3>(.*?)<table (.*?) class=\"table_links\">(.*?)<tbody>(.*?)<\/tbody>(.*?)<\/table>/s",$data,$mtdt);
	$data2 = $mtdt[6][0];
	preg_match_all("/<a (.*?) href=\"(.*?)\">(.*?)<\/a>/s",$data2,$enlace);
	preg_match_all("/<span (.*?)>(.*?)<\/span>/s",$data2,$calidad);
	preg_match_all("/<img src=\"(.*?)\/flags\/(.*?)\" width=\"22\">/s",$data2,$idioma);
	preg_match_all("/<td align=\"left\"><img (.*?)>(.*?)<\/td>/s",$data2,$serivdor);
	preg_match_all("/<div class=\"table_info\">(.*?)<h3>(.*?)online<\/h3>(.*?)<table (.*?) class=\"table_links\">(.*?)<tbody>(.*?)<\/tbody>(.*?)<\/table>/s",$data,$mtdt1);
	$data3 = $mtdt1[6][0];
	preg_match_all("/<a (.*?) href=\"(.*?)\">(.*?)<\/a>/s",$data3,$enlace1);
	preg_match_all("/<span (.*?)>(.*?)<\/span>/s",$data3,$calidad1);
	preg_match_all("/<img src=\"(.*?)\/flags\/(.*?)\" width=\"22\">/s",$data3,$idioma1);
	preg_match_all("/<td align=\"left\"><img (.*?)>(.*?)<\/td>/s",$data3,$serivdor1);
	$i = 0;
	$w = 0;
	foreach ($enlace[2] as $item)$i++; 
	foreach ($enlace1[2] as $item)$w++;
	if(($tipostoadd[0] == 1) || ($tipostoadd[1] == 1)){
	for($j = 0; $j < $i; $j++){
		$serv = str_replace(' ', '', $serivdor[2][$j]);
		if($idioma[2][$j] == 'en_es.png'){ $bandera = 'Subtitulado';}
		if($idioma[2][$j] == 'la_la.png'){ $bandera = 'Latino';}
		if($idioma[2][$j] == 'es_es.png'){ $bandera = 'Español';}
		if($serv != "adf"){
			$wpdb->insert(
				$table_name,
				array(
					'Idioma' => $bandera,
					'Calidad' => ucwords($calidad[2][$j]),
					'Enlace' => str_replace("http://api.ysk.pe/noref/?u=","",$enlace[2][$j]),
					'PID' => $return['ID'],
					'Tipo' => '1',
				)
			);
		}
	}
	}
	if(($tipostoadd[0] == 2) || ($tipostoadd[1] == 2)){
	for($j = 0; $j < $w; $j++){
		$serv = str_replace(' ', '', $serivdor1[2][$j]);
		if($idioma1[2][$j] == 'en_es.png') $bandera = 'Subtitulado';
		if($idioma1[2][$j] == 'la_la.png') $bandera = 'Latino';
		if($idioma1[2][$j] == 'es_es.png') $bandera = 'Español';
		if(($serv != "netu") && ($serv != "adf")){
			$wpdb->insert(
				$table_name,
				array(
					'Idioma' => $bandera,
					'Calidad' => ucwords($calidad1[2][$j]),
					'Enlace' => str_replace("http://api.ysk.pe/noref/?u=","",$enlace1[2][$j]),
					'PID' => $return['ID'],
					'Tipo' => '2',
				)
			);
		}
	}
	}
	return ($httpcode>=200 && $httpcode<300) ? $data : false;
}