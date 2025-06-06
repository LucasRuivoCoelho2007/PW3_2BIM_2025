<?php 
include("functions.php");

if (!isset($_SESSION)) session_start();

// Verifica se o usuário está logado e se é admin
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "index.php");
    exit;
} elseif ($_SESSION['user'] != "admin") {
    $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: " . BASEURL . "index.php");
    exit;
}

edit();

include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <h2>Editando usuário: <?php echo htmlspecialchars($usuario['nome']); ?></h2>

    <form action="edit.php?id=<?php echo $usuario['id']; ?>" method="post" enctype="multipart/form-data">
        <div class="row g-3">

            <div class="col-md-6 textfield">
                <label for="nome"><i class="fa-solid fa-user" style="color:#00ff88;"></i> Nome</label>
                <input type="text" id="nome" name="usuario[nome]" value="<?php echo htmlspecialchars($usuario['nome']); ?>" maxlength="50" placeholder="Ex: Lucas Nascimento" required>
            </div>

            <div class="col-md-6 textfield">
                <label for="user"><i class="fa-solid fa-user-circle" style="color:#00ff88;"></i> Usuário</label>
                <input type="text" id="user" name="usuario[user]" value="<?php echo htmlspecialchars($usuario['user']); ?>" maxlength="50" placeholder="lucasNascimento" required>
            </div>

            <div class="col-md-6 textfield">
                <label for="senha"><i class="fa-solid fa-lock" style="color:#00ff88;"></i> Senha</label>
                <input type="password" id="senha" name="usuario[password]" placeholder="Digite a senha" maxlength="50" required>
            </div>

            <div class="col-md-6 textfield">
                <label for="foto"><i class="fa-solid fa-image" style="color:#00ff88;"></i> Foto</label>
                <input type="file" id="foto" name="foto" accept="image/*">
            </div>

            <div class="col-md-6 textfield">
                <label><i class="fa-solid fa-eye" style="color:#00ff88;"></i> Pré-visualização</label><br>
                <?php 
                    $foto = (!empty($usuario['foto'])) ? $usuario['foto'] : "SemImagem.png"; 
                ?>
                <img id="imgPreview" src="fotos/<?php echo htmlspecialchars($foto); ?>" alt="Foto do usuário" style="max-height: 150px; border-radius: 8px; border: 1px solid #555;">
            </div>

        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn-login larg-main-btn" style="background-color:#00ff88; color:#1c1c1c; border:none; padding:12px 30px; font-weight:bold;">
                <i class="fa-solid fa-user-pen"></i> Editar Usuário
            </button>
            <a href="<?php echo BASEURL; ?>index.php" class="btn btn-light btn-view ms-3" style="color: #00ff88; background-color:#514869; border:none;">
                <i class="fa-solid fa-arrow-left"></i> Voltar
            </a>
        </div>
    </form>
</div>

<?php 
clear_messages();
include(FOOTER_TEMPLATE); 
?>

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
