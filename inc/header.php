<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>CinePlay</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.2/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo BASEURL; ?>css/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/awesome.all.min.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/estilo.css">
		<link rel="stylesheet" href="<?php echo BASEURL; ?>css/footer.css">
        <link rel="icon" href="<?php echo BASEURL; ?>img/video-camera.png" type="image/png">

		<style>
			body {
				padding-top: 50px;
				padding-bottom: 20px;
			}
			.btn-light {
				background-color: #999;
				color: #FFF;
				border-color: #999
			}
			.btn-light:hover {
				background-color: #777;
				color: #FFF;
				border-color: #777
			}
		</style>
	</head>
	<body class="body">
<!-- Início do menu-->
		<!-- Navbar -->
<?php
// Inicia a sessão se ainda não foi iniciada
if (!isset($_SESSION)) session_start();
?>

<nav class="navbar navbar-expand-lg fixed-top navbar-color">
    <div class="container-fluid">
        <a class="navbar-brand navbar-color-text" href="<?php echo BASEURL; ?>" style="color: #77ffc0; font-weight: 800; font-size: 1.6rem;">
            <i class="fa-solid fa-clapperboard"></i> CinePlay
        </a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #fff; font-size: 1.2rem;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Filmes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>Filmes"><i class="fa-solid fa-film"></i> Gerenciar Filmes</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>Filmes/add2.php"><i class="fa-solid fa-video"></i> Novo Filme</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: #fff; font-size: 1.2rem;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers"><i class="fa-solid fa-users"></i> Gerenciar Clientes</a></li>
                        <li><a class="dropdown-item" href="<?php echo BASEURL; ?>customers/add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a></li>
                    </ul>
                </li>

                <!-- Dropdown de Usuários para Admin -->
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" style="color: #fff; font-size: 1.2rem;" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Usuários
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios"><i class="fa-solid fa-user-gear"></i> Gerenciar Usuários</a></li>
                            <li><a class="dropdown-item" href="<?php echo BASEURL; ?>usuarios/add.php"><i class="fa-solid fa-user-plus"></i> Novo Usuário</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Dropdown de Login ou Logout -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php if (isset($_SESSION['user'])) : ?>
                    <!-- Se o usuário estiver logado -->
                    <li class="nav-item">
                        <a class="nav-link" style="color: #fff; font-size: 1.2rem;" href="<?php echo BASEURL; ?>inc/logout.php">
                            Bem-vindo, <?php echo $_SESSION['nome']; ?>! <i class="fa-solid fa-person-walking-arrow-right"></i> Desconectar
                        </a>
                    </li>
                <?php else : ?>
                    <!-- Dropdown de Login -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #fff; font-size: 1.2rem;">
                            <i class="fa-solid fa-users"></i> Login
                        </a>
                        <div class="dropdown-menu dropdown-menu-end p-4" style="min-width: 300px;">
                            <form action="<?php echo BASEURL; ?>inc/valida.php" method="post">
                                <div class="mb-3">
                                    <label for="login" class="form-label">Usuário</label>
                                    <input type="text" class="form-control" id="login" name="login" placeholder="Digite seu usuário" required>
                                </div>
                                <div class="mb-3">
                                    <label for="senha" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha" required>
                                </div>
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-secondary"><i class="fa-solid fa-user-check"></i> Conectar</button>
                                    <a href="<?php echo BASEURL; ?>" class="btn btn-light"><i class="fa-solid fa-rotate-left"></i> Cancelar</a>
                                </div>
                            </form>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

		<!-- Fim do menu-->

z