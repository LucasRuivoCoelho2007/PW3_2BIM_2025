<?php 
	include('functions.php'); 
	view($_GET['id']);
	 include(HEADER_TEMPLATE);
	 
	 
	 if (empty($filme['foto'])){
				$imagem = 'SemImagem.png';
			}else{
				$imagem = $filme['foto'];
			}
?>
			<div class="main-login"> 
				<div class="left-login half">
					<div class="card-login"> 
						<h1 class="mt-2"><?php echo $filme['nome']; ?></h2>
						<hr>

						<?php if (!empty($_SESSION['message'])) : ?>
							<div class="alert alert-<?php echo $_SESSION['type']; ?>">
								<?php echo $_SESSION['message'] . "\n"; ?>
							</div>
						<?php endif; ?>
						<div class="card-align">
							<div class="left-card">
								<div class="textfield">
									<label><strong>Nome do Filme:</strong></label>
									<label><?php echo $filme['nome']; ?></label>
								</div>
								<div class="textfield">
									<label><strong>Diretor:</strong></label>
									<label><?php echo $filme['diretor']; ?></label>
								</div>
								<div class="textfield">
									<label><strong>Gênero:</strong></label>
									<label><?php echo $filme['classificacao']; ?></label>
								</div>
							</div>
							<div class="right-card">
								<div class="textfield">
									<label><strong>Ano:</strong></label>
									<label><?php echo $filme['ano']; ?></label>
								</div>
								<div class="textfield">
									<label><strong>Data de cadastro:</strong></label>
									<label><?php echo formatadata($filme['data_cadastro'], "d/m/Y - H:i:s"); ?></label>
								</div>
								<div class="textfield">
									<label><strong>Preço:</strong></label>
									<label><?php echo $filme['preco']; ?></label>
								</div>
							</div>
						</div>
						<div id="actions" class="align-btn">
							  <a href="edit.php?id=<?php echo $filme['id']; ?>" class="btn btn-secondary btn-view" style="color: #00ff88; background-color:#514869; border-style: none;" ><i class="fa-solid fa-pen-to-square "></i></i> Editar</a>
							  <a href="index.php" class="btn btn-light btn-view" style="color: #00ff88; background-color:#514869; border-style: none;" ><i class="fa-solid fa-arrow-left "></i> Voltar</a>
						</div>
					</div>
				</div>
				<div class="right-login half2">
					<img src="../img/<?php echo $imagem ?>" class="img-view" alt="...">
				</div>
			</div>

<?php include(FOOTER_TEMPLATE); ?>