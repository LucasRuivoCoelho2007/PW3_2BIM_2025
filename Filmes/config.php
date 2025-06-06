<?php

	include("../config.php");
	include(DBAPI);

	$filmes = null;
	$filme = null;

	/**
	 *  Listagem de Clientes
	 */
	function index() {
		global $filmes;
		$filmes = find_all('filmes');
	}
	
	