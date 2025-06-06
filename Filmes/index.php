<?php
session_start();
include("functions.php");

// Verifica se foi feito um filtro via POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['filmes'])) {
    $filmes = filter("filmes", "nome like '%" . $_POST['filmes'] . "%'");
} else {
    index(); // Carrega todos os filmes
}

// Verifica se foi solicitada a geração de PDF
if (isset($_GET['pdf'])) {
    if ($_GET['pdf'] == "ok") {
        pdf(null, "LISTA DE FILMES DO SITE CINEPLAY");
    } else {
        pdf($_GET['pdf'], "LISTA DE FILMES DO SITE CINEPLAY");
    }
}
if (!isset($_SESSION)) session_start();

if (isset($_SESSION['user'])){ // Verifica se tem um usuário logado
//	if ($_SESSION['user'] != ) { // Verifica se o usuário é admin
//		$_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
//		$_SESSION['type'] = "danger";
//		header("Location:	" . BASEURL . "index.php");
//	}
}
 else {
	$_SESSION['message'] = "Algumas funcionalidades não funcionarão como esperado, pois é necessário estar logado!";
	$_SESSION['type'] = "danger";
	//header("Location:" . BASEURL. "index.php");
}
	
?>

<?php include(HEADER_TEMPLATE); ?>
<header class="mt-3 mb-4">
    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex flex-wrap align-items-center gap-3">
        <a class="btn btn-secondary btn-add" 
           style="color: #00ff88; background-color:#514869; border:none; min-width: 130px;" 
           href="add2.php">
            <i class="fa fa-plus"></i> Novo filme
        </a>
        <a class="btn btn-light" 
           style="color: #00ff88; background-color:#514869; border:none; min-width: 130px;" 
           href="index.php">
            <i class="fa fa-refresh"></i> Atualizar
        </a>

        <?php if (!empty($_SESSION['user'])): ?>
            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                <a class="btn" 
                   style="color: #f55; background-color:#514869; border:none; min-width: 130px;" 
                   href="index.php?pdf=<?php echo urlencode($_POST['filmes']); ?>" download>
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php else : ?>
                <a class="btn" 
                   style="color: #f55; background-color:#514869; border:none; min-width: 130px;" 
                   href="index.php?pdf=ok" download>
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</header>


<hr>

<div class="main-login">
    <div class="container">
        <div class="tbl_container">
            <h2>Gerenciar Filmes</h2>

            <!-- Formulário de filtro -->
            <form action="index.php" method="post" class="col-md-6 alg-right">
                <div class="form-group">
                    <div class="input-group mb-3 col-md-6">
                        <input type="text" class="form-control" style="color: #f0ffffde; background-color:#514869;" maxlength="50" name="filmes" required>
                        <button type="submit" class="btn btn-secondary" style="color: #00ff88; background-color:#514869; border: 1px solid white;">
                            <i class="fa-solid fa-magnifying-glass"></i> Consultar
                        </button>
                    </div>
                </div>
            </form>

            <table class="tbl">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Diretor</th>
                        <th>Ano</th>
                        <th>Preço</th>
                        <th>Foto</th>
                        <th>Atualizado em</th>
                        <th colspan="3">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($filmes) : ?>
                        <?php foreach ($filmes as $filme) : ?>
                            <tr>
                                <td data-lable="ID:"><?php echo $filme['id']; ?></td>
                                <td data-lable="Nome:"><?php echo $filme['nome']; ?></td>
                                <td data-lable="Diretor:"><?php echo $filme['diretor']; ?></td>
                                <td data-lable="Ano:"><?php echo $filme['ano']; ?></td>
                                <td data-lable="Preço">R$ <?php echo $filme['preco']; ?></td>
                                
                                <td data-lable="Foto:">
                                    <?php if (!empty($filme['foto'])): ?>
                                        <img src="img/<?php echo $filme['foto']; ?>" class="shadow p-1 mb-1 bg-body rounded" width="100px">
                                    <?php else: ?>
                                        <img src="img/SemImagem.png" class="shadow p-1 mb-1 bg-body rounded" width="100px">
                                    <?php endif; ?>
                                </td>

                                <?php $data = new DateTime($filme['modified'], new DateTimeZone("America/Sao_Paulo")); ?>
                                <td data-lable="Atualizado em: "><?php echo $data->format("d/m/Y - H:i:s"); ?></td>
                                <td data-lable="Vizualizar">
                                    <a href="view.php?id=<?php echo $filme['id']; ?>" class="btn_view"><i class="fa fa-eye"></i></a>
                                </td>
                                <td data-lable="Editar">
                                    <a href="edit.php?id=<?php echo $filme['id']; ?>" class="btn_edit"><i class="fa fa-pencil"></i></a>
                                </td>
                                <td data-lable="Excluir">
                                    <a href="#" class="btn_trash" data-bs-toggle="modal" data-bs-target="#delete-modal" data-customer="<?php echo $filme['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="10">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>
<?php clear_messages(); ?>
