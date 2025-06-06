<?php
include('functions.php');

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

view($_GET['id']);
include(HEADER_TEMPLATE);
?>

<style>
    .custom-card {
        background-color: #514869; /* fundo roxo escuro */
        color: white;
    }
    .custom-card p,
    .custom-card h5 {
        color: white;
    }
    .custom-icon {
        color: #00ff88; /* verde neon */
    }
    .btn-custom {
        color: #00ff88 !important;
        background-color: #514869 !important;
        border: none !important;
    }
    .btn-custom:hover {
        background-color: #3e3458 !important;
        color: #00ff88 !important;
    }
    .user-photo {
        max-height: 200px;
        border-radius: 8px;
        border: 1px solid #555;
        margin-top: 10px;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center"><?php echo htmlspecialchars($usuario['nome']); ?></h2>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm h-100 custom-card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-user me-2 custom-icon"></i>Dados Pessoais</h5>
                    <p><i class="fa-solid fa-id-card me-2 custom-icon"></i><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
                    <p><i class="fa-solid fa-user me-2 custom-icon"></i><strong>Usuário:</strong> <?php echo htmlspecialchars($usuario['user']); ?></p>
                    <p><i class="fa-solid fa-lock me-2 custom-icon"></i><strong>Senha:</strong> <?php echo criptografia($usuario['password']); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6 d-flex justify-content-center align-items-center">
            <?php
                $foto = empty($usuario['foto']) ? "SemImagem.png" : $usuario['foto'];
            ?>
            <img src="fotos/<?php echo htmlspecialchars($foto); ?>" alt="Foto do usuário" class="user-photo shadow p-2 bg-body rounded">
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn btn-secondary btn-custom me-2">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light btn-custom">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<?php
clear_messages();
include(FOOTER_TEMPLATE);
?>
