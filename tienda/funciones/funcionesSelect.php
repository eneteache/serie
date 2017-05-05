<?php

	function selectall() {
	$selectall = "select * from usuarios";
	return $selectall;
	}

	function selectallbyID($identificador) {
	$selectall = "select * from usuarios where id_user=$identificador";
	return $selectall;
	}

	function selectallPaises(){
	$selectallPaises ="select id_pais, pais from paises order by pais asc;";
	return $selectallPaises;
	}

	function selectallPaisesByID($campo) {
	$selectallPaisesByID = "select * from paises where id_pais=$campo";
	return $selectallPaisesByID;
	}

	function selectallCategorias () {
		$selectallCategorias  = "select * from categorias";
		return $selectallCategorias;
	}

	function selectallProductos () {
		$selectallProductos = "select * from productos";
		return $selectallProductos;
	}
?>