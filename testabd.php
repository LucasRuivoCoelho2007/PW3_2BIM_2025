<?php include "config.php"; ?>
<?php include DBAPI; ?>
<meta charset="utf-8">
<?php 
	$db = open_database(); 
	
	if ($db) {
		echo "<h1>Banco de Dados Conectado!</h1>";
	} else {
		echo "<h1>ERRO: Não foi possível Conectar!</h1>";
	}
?>