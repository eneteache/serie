<?php

/*
 * Clase para gestionar carrito de compras de una tienda online
 */
class Carrito{

	# Indice para el control de los items
	var $ind;

	# Array que contiene los ids de todos los items
	var $id;
	# Array con los precios de cada uno de los items
	var $precio;
	# Array de las cantidades de elementos por item
	var $cantidad;
	# Array de las imagenes
	var $imagen;
	# Array de los nombres de los elementos por item

	# Constructor de la clase inicializa variables de sesion
	function __construct(){
		if (!isset($_SESSION)) session_start();
		if (!isset($_SESSION['carrito'])) 
			$_SESSION['carrito'] = Array(
				'id' => [], 'ind' => 0, 'precio' => [], 'cantidad' => [], 'imagen'=>[], 'nombre'=>[]);

		$this->id = &$_SESSION['carrito']['id'];
		$this->ind = &$_SESSION['carrito']['ind'];
		$this->precio = &$_SESSION['carrito']['precio'];
		$this->cantidad = &$_SESSION['carrito']['cantidad'];
		$this->imagen =	&$_SESSION['carrito']['imagen'];
		$this->nombre = &$_SESSION['carrito']['nombre'];

	}

	# Metodo para añadir un nuevo elemento o actualizar la cantidad de uno existente
	function add($id, $nombre,$precio=0, $cantidad=0,$imagen){
		$clave = array_search($id, $this->id);
		if ($clave !== false){
			$this->cantidad[$clave]++;
		}else{
			$this->imagen[$this->ind] = $imagen;
			$this->id[$this->ind] = $id;
			$this->precio[$this->ind] = $precio;
			$this->cantidad[$this->ind] = $cantidad;
			$this->nombre[$this->ind]=$nombre;
			$this->ind++;
		}
	}

	# Metodo para obtener los datos de item del carrito mediante su id
	function get($id){
		$item = [];
		$clave = array_search($id, $this->id);
		$item['id'] = $this->id[$clave];
		$item['precio'] = $this->precio[$clave];
		$item['cantidad'] = $this->cantidad[$clave];
		$item['total'] = $this->cantidad[$clave] * $this->precio[$clave];
		$item['imagen'] = $this->imagen[$clave];
		$item['nombre'] = $this->nombre[$clave];
		return $item;
	}

	# Metodo que devuelve un array con todos los items del carrito
	function getAll($func=false){
		if (count($this->id) > 0) {	
		$items = [];
		foreach ($this->id as $key => $value) {
			$subtotal = $this->precio[$key] * $this->cantidad[$key];
			if ($func){
				$func($value, $this->nombre[$key],$this->precio[$key], $this->cantidad[$key],$this->imagen[$key], $subtotal);
				continue;
			}
			$items[$key]['id'] = $value;
			$items[$key]['nombre'] = $this->imagen[$key];
			$items[$key]['precio'] = $this->precio[$key]; 
			$items[$key]['cantidad'] = $this->cantidad[$key];
			$items[$key]['imagen'] = $this->imagen[$key];
			$items[$key]['subtotal'] = $subtotal;
		}
		return $items;
		}
		return false;
	}

	# Metodo para eliminar un elemento de un item del carrito
	function del($id){
		$clave = array_search($id, $this->id);
		if (!isset($this->cantidad[$clave])) return;
		if (!--$this->cantidad[$clave]) $this->delAll($id);
	}

	# Metodo para eliminar un item del carrito
	function delAll($id){
		$clave = array_search($id, $this->id);
		unset($this->id[$clave]);
		unset($this->precio[$clave]);
		unset($this->cantidad[$clave]);
	}

	# Metodo que devuelve la cantidad a pagar
	function precio(){
		function product($a, $b){
			return $a * $b;
		}
		return array_sum(array_map('product', $this->precio, $this->cantidad));
	}

	# Metodo que devuelve el numero total de elementos del carrito
	function count(){
		return array_sum($this->cantidad);
	}

	#Metodo que devuelve el numero de items del carrito
	function countItems(){
		return count($this->id);
	}
}