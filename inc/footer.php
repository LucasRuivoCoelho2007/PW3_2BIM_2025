	</body>

	<footer class="footer-info"style="height: 100%;">
	
		<div class="footer-width about">
			<h2 class="a">Sobre</h2>
			<p class="a">
				Somos uma plataforma especializada em catalogar e organizar filmes de todos os gêneros, oferecendo uma experiência completa para os amantes do cinema. Nosso objetivo é facilitar a busca por informações detalhadas sobre filmes, desde clássicos até lançamentos recentes. Com uma base de dados em constante crescimento, conectamos você às suas produções favoritas de forma rápida e simples.
			</p>
			<div class="social-media">
				<ul>
					<li><a href="https://www.facebook.com/etecfernando/" class="a"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="https://br.linkedin.com/in/anderson-roque-02522910a" class="a"><i class="fab fa-linkedin-in"></i></a></li>
					<li><a href="https://www.instagram.com/etecfernandoprestes/" class="a"><i class="fab fa-instagram"></i></a></li>
				</ul>
			</div>
		</div>
		<div class="footer-width link">
			<h2 class="a">Links</h2>
			<ul>
				<li><a href="#" class="a">home</a></li>
				<li><a href="#" class="a">gerenciar filmes</a></li>
				<li><a href="#" class="a">gerenciar clientes</a></li>
			</ul>
		</div>
		<div class="footer-width contact">
			<h2 class="a">Contate-nos</h2>
				<ul>
					<li>
						<span><i class="fas fa-map-marker-alt"></i></span>
						<a href="#" class="a"> Etec Fernando Prestes, R. Natal, 340 - Jardim Paulistano, Sorocaba - SP</a>
					</li>
					<li>
						<span><i class="fas fa-envelope"></i></span>
						<a href="#" class="a">etec@etec.sp.gov.br</a>
					</li>
					<li>
						<span><i class="fas fa-phone-volume"></i></span>
						<a href="#" class="a"> (15) 3221-9677</a>
					</li>
				</ul>
		</div>
	</footer>
	<div class="copy-right">
		<?php $data = new DateTime("now", new DateTimeZone("America/Sao_Paulo"));?>
		<p>&copy;2024 - <?php echo $data->format("Y")?> - Lucas e Renan</p>
	</div>
	
	 <?php include(COOKIE_TEMPLATE); //linha incluida ?> 
  	
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="<?php echo BASEURL; ?>js/jquery-1.11.2.min.js"><\/script>')</script>

    <script src="<?php echo BASEURL; ?>js/jquery-3.7.1.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/awesome/all.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="<?php echo BASEURL; ?>js/main.js"></script>
</html>