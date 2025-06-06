<?php 

include("functions.php");

if (!isset($_SESSION)) session_start();

if (isset($_SESSION['user'])) {
    // Aqui pode colocar validação de admin se quiser
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
}

edit();

include(HEADER_TEMPLATE); 
?>

<div class="main-login"> 
    <div class="left-login">
        <h1>Editando <?php echo $filme['nome']; ?>...</h1>
        <img src="./img/animacaoEditar.svg" class="left-login-image">
    </div>
    <div class="right-login">
        <div class="card-login">
            <h1>EDITAR FILME</h1>
            <form action="edit.php?id=<?php echo $filme['id']; ?>" method="post" enctype="multipart/form-data">
                <div class="card-align">
                    <div class="left-card">
                        <div class="textfield">
                            <label for="nome">Filme</label>
                            <input type="text" name="filme['nome']" value="<?php echo $filme['nome']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="diretor">Diretor</label>
                            <input type="text" name="filme['diretor']" value="<?php echo $filme['diretor']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="classificacao">Classificação</label>
                            <input type="text" name="filme['classificacao']" value="<?php echo $filme['classificacao']; ?>">
                        </div>
                    </div>
                    <div class="right-card">
                        <div class="textfield">
                            <label for="ano">Ano</label>
                            <input type="number" name="filme['ano']" value="<?php echo $filme['ano']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="data_cadastro">Data de cadastro</label>
                            <?php $data_atual = formatadata($filme['data_cadastro'], 'Y-m-d'); ?>
                            <input type="date" name="filme['data_cadastro']" value="<?php echo $data_atual; ?>">
                        </div>
                        <div class="textfield">
                            <label for="preco">Preço</label>
                            <input type="number" name="filme['preco']" value="<?php echo $filme['preco']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="foto">Imagem do Filme</label>
                            <input type="file" name="foto">
                            <?php if (!empty($filme['foto'])): ?>
                                <br>
                                <small>Imagem atual:</small><br>
                                <img src="fotos/<?php echo $filme['foto']; ?>" alt="Imagem atual" style="max-width:100px; margin-top:5px;">
                            <?php else: ?>
                                <br><small>Sem imagem cadastrada.</small>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div id="actions">
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
                            <?php echo $_SESSION['message']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <a class="btn btn-light" style="color: #00ff88; background-color:#514869; border-style: none;" href="add2.php">
                                <i class="fa fa-refresh"></i> Atualizar
                            </a>
                        </div>
                    <?php else: ?>
                        <button class="btn-login">Editar</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<?php clear_messages(); ?>

<?php include(FOOTER_TEMPLATE); ?>
