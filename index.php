<?php
require "config.php"; 
include(DBAPI); 
include(HEADER_TEMPLATE); 
$db = open_database();

 ?>

	<?php if ($db) : ?>
		<div class="main-login"> 
			<div class="left-login">
				<h1>Seja bem-vindo(a) ao CinePlay!</h1>
				<img src="img/heroi.svg" class="left-login-image">
			</div>
			<div class="right-login">
				<div class="container2">
					<div class="pos1">
						
						<a class="a-container" href="Filmes/add2.php">
							<div class="carde">
								<h3>Novo filme</h3>
								<i class="fa-solid fa-video fa-5x mag-top-icon"></i>
								
							</div>
						</a>
						<a class="a-container"href="Filmes">
							<div class="carde">
								<h3>Filmes</h3>
								<i class="fa-solid fa-film fa-5x mag-top-icon"></i>

							</div>
						</a>
					</div>

					<div class="pos2">

						<a class="a-container"href="customers/add.php">
							<div class="carde">
								<h3>Novo cliente</h3>
								<i class="fa-solid fa-5x fa-user-plus mag-top-icon"></i>
								
							</div>
						</a>
						<a class="a-container"href="customers">
							<div class="carde">
								<h3>Clientes</h3>
								<i class="fa-solid fa-users fa-5x mag-top-icon"></i>

							</div>
						</a>
					</div>
					

					<?php if (isset($_SESSION['user'])) : //Verifica se está existe usuário ?>
						<?php if ($_SESSION['user'] == "admin") : //Verifica se está logado como admin ?>
							<div class="pos2">
								<a class="a-container" href="usuarios/add.php">
									<div class="carde">
										<h3>Novo usuário</h3>
										<i class="fa-solid fa-5x fa-user-plus mag-top-icon"></i>
										
									</div>
								</a>

								<a class="a-container"href="usuarios">
									<div class="carde">
										<h3>Usuários</h3>
										<i class="fa-solid fa-users fa-5x mag-top-icon"></i>									
									</div>
								</a>
							</div>
							<?php endif; ?>
						<?php endif; ?>
						

					
										
				</div>
	
			</div>

		</div>
		<?php else : ?>
		<!-- Comentei a DIV abaixo -->
		<!--
		<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
		</div> -->
		<?php if (!empty($_SESSION['message'])): ?>
			<div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
				<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!<br>
				<?php echo $_SESSION['message']; ?></p>
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php clear_messages(); ?>
			<?php endif; ?>
		<?php endif; ?>
							


<?php include(FOOTER_TEMPLATE); ?>