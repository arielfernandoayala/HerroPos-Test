<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=herrero_test",
			            "poma",//poma
			            "Pomadb1994*");//Rivarola8011

		$link->exec("set names utf8");

		return $link;

		/*
		$link = new PDO("mysql:host=localhost;dbname=pos-copia3",
			            "root",	
			            "");

		$link = new PDO("mysql:host=localhost;dbname=pos-copia3",
			            "root",
			            "poma");	            
			            */

	}

}