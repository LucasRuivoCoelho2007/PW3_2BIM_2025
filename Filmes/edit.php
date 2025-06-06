<?php 
include("functions.php");

if (!isset($_SESSION)) session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: login.php"); // redireciona se não estiver logado
    exit;
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
                            <input type="text" name="filme[nome]" value="<?php echo $filme['nome']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="diretor">Diretor</label>
                            <input type="text" name="filme[diretor]" value="<?php echo $filme['diretor']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="classificacao">Classificação</label>
                            <input type="text" name="filme[classificacao]" value="<?php echo $filme['classificacao']; ?>">
                        </div>
                    </div>
                    <div class="right-card">
                        <div class="textfield">
                            <label for="ano">Ano</label>
                            <input type="number" name="filme[ano]" value="<?php echo $filme['ano']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="data_cadastro">Data de cadastro</label>
                            <?php $data_atual = formatadata($filme['data_cadastro'], 'Y-m-d'); ?>
                            <input type="date" name="filme[data_cadastro]" value="<?php echo $data_atual; ?>">
                        </div>
                        <div class="textfield">
                            <label for="preco">Preço</label>
                            <input type="number" name="filme[preco]" step="0.01" value="<?php echo $filme['preco']; ?>">
                        </div>
                        <div class="textfield">
                            <label for="foto">Imagem do Filme</label>
                            <input type="file" name="foto" id="foto" accept="image/*">

                            <br><small>Pré-visualização:</small><br>
                            <?php 
                                $foto = (!empty($filme['foto'])) ? $filme['foto'] : 'SemImagem.png';
                            ?>
                            <img id="imgPreview" src="img/<?php echo htmlspecialchars($foto); ?>" alt="Imagem do Filme" style="max-width:150px; margin-top:5px; border-radius:6px; border:1px solid #555;">
                        </div>
                    </div>
                </div>

                <div id="actions">
                    <?php if (!empty($_SESSION['message'])): ?>
                        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
                            <?php echo $_SESSION['message']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <a class="btn btn-light" style="color: #00ff88; background-color:#514869; border-style: none;" href="edit.php?id=<?php echo $filme['id']; ?>">
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

<script>
document.getElementById('foto').addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('imgPreview').setAttribute('src', event.target.result);
        }
        reader.readAsDataURL(file);
    }
});
</script>

<?php clear_messages(); ?>
<?php include(FOOTER_TEMPLATE); ?>
