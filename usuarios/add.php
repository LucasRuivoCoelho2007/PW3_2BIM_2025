<?php 
include("functions.php");

if (!isset($_SESSION)) session_start();

// Verifica se o usuário está logado e se é admin
if (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: index.php");
    exit;
} elseif ($_SESSION['user'] != "admin") { 
    $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    header("Location: index.php");
    exit;
}

add();

include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
    <h2>Cadastro de Usuário</h2>

    <form action="add.php" method="post" enctype="multipart/form-data">
        <div class="row g-3">

            <div class="col-md-6 textfield">
                <label for="nome"><i class="fa-solid fa-user" style="color:#00ff88;"></i> Nome <span class="text-danger">*</span></label>
                <input type="text" id="nome" name="usuario[nome]" placeholder="Ex: Lucas Nascimento" maxlength="50" required>
            </div>

            <div class="col-md-6 textfield">
                <label for="user"><i class="fa-solid fa-user-circle" style="color:#00ff88;"></i> Usuário <span class="text-danger">*</span></label>
                <input type="text" id="user" name="usuario[user]" placeholder="lucasNascimento" maxlength="50" required>
            </div>

            <div class="col-md-6 textfield">
                <label for="senha"><i class="fa-solid fa-lock" style="color:#00ff88;"></i> Senha <span class="text-danger">*</span></label>
                <input type="password" id="senha" name="usuario[password]" maxlength="50" required>
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
                <img id="imgPreview" src="fotos/<?php echo $foto ?>" alt="Foto do usuário" style="max-height: 150px; border-radius: 8px; border: 1px solid #555;">
            </div>

        </div>

        <div class="text-center mt-4">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a href="add.php" class="btn btn-outline-light mt-2">
                    <i class="fa fa-refresh"></i> Atualizar
                </a>
            <?php else: ?>
                <button type="submit" class="btn-login larg-main-btn" style="background-color:#00ff88; color:#1c1c1c; border:none; padding:12px 30px; font-weight:bold;">
                    <i class="fa-solid fa-user-plus"></i> Cadastrar Usuário
                </button>
            <?php endif; ?>
        </div>
    </form>
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

<?php 
clear_messages();
include(FOOTER_TEMPLATE); 
?>
