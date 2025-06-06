<?php 
	
	include("functions.php"); 
	//esse é o delete.php
	if (!isset($_SESSION)) session_start();
	if (isset($_SESSION['user'])){ // Verifica se tem um usuário logado
		//if ($_SESSION['user'] != "admin") { // Verifica se o usuário é admin
		//	$_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
		//	$_SESSION['type'] = "danger";
			//header("Location:	" . BASEURL . "index.php");
		//}
		//else{
			header("Location: index.php");
		//}
	}
	 else {
		$_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
		$_SESSION['type'] = "danger";
		//header("Location:" . BASEURL. "index.php");
	}
		include(HEADER_TEMPLATE);
	 if (!empty($_SESSION['message'])): ?>
		<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
			<?php echo $_SESSION['message']; ?>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
		<a href="<?php echo BASEURL; ?>index.php" class="btn btn-light btn-view" style="color: #00ff88; background-color:#514869; border-style: none;">
			<i class="fa-solid fa-arrow-left"></i> Voltar
		</a>
	<?php else: 
	

	if (isset($_GET['id'])){
	delete($_GET['id']);
	} else {
	die("ERRO: ID não definido.");
  }

 endif; ?>
