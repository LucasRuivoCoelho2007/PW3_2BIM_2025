<?php 
include("functions.php"); 
session_start();

// Verifica se o usuário está logado e se é admin
if (isset($_SESSION['user']) && $_SESSION['user'] != "admin") { 
    $_SESSION['message'] = "Você precisa ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
} elseif (!isset($_SESSION['user'])) {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
}

if (isset($_GET['pdf'])) { // Gerar PDF
    if ($_GET['pdf'] == "ok") {
        pdf();
    } else {
        pdf($_GET['pdf']);
    }
}

index();
include(HEADER_TEMPLATE);
?>

<!-- Exibir mensagens -->
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        <a class="btn btn-light" style="color: #00ff88; background-color:#514869; border: none;" href="index.php">
            <i class="fa fa-refresh"></i> Atualizar
        </a>
    </div>
<?php endif; ?>

<!-- Conteúdo para administradores -->
<?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin") : ?>
    <header class="mt-3 mb-4">
        <div class="d-flex flex-wrap align-items-center gap-3">
            <a class="btn btn-secondary btn-add"
               style="color: #00ff88; background-color:#514869; border: none; min-width:130px;"
               href="add.php">
                <i class="fa fa-plus"></i> Novo usuário
            </a>

            <a class="btn btn-light"
               style="color: #00ff88; background-color:#514869; border: none; min-width:130px;"
               href="index.php">
                <i class="fa fa-refresh"></i> Atualizar
            </a>

            <?php if ($_SERVER["REQUEST_METHOD"] == "POST") : ?>
                <a class="btn"
                   style="color: #f55; background-color:#514869; border: none; min-width:130px;"
                   href="index.php?pdf=<?php echo urlencode($_POST['users']); ?>" download>
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php else : ?>
                <a class="btn"
                   style="color: #f55; background-color:#514869; border: none; min-width:130px;"
                   href="index.php?pdf=ok" download>
                    <i class="fa-solid fa-file-pdf"></i> Listagem
                </a>
            <?php endif; ?>
        </div>
    </header>

    <hr>

    <div class="container">
        <div class="tbl_container">
            <h2>Usuários</h2>

            <!-- Formulário de filtro -->
            <form action="index.php" method="post" class="col-md-6 alg-right">
                <div class="form-group">
                    <div class="input-group mb-3 col-md-6">
                        <input type="text" class="form-control"
                               style="color: #f0ffffde; background-color:#514869;"
                               maxlength="50" name="users" required>
                        <button type="submit" class="btn btn-secondary"
                                style="color: #00ff88; background-color:#514869; border: 1px solid white;">
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
                        <th>Usuário</th>
                        <th>Foto</th>
                        <th colspan="3">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($usuarios) : ?>
                        <?php foreach ($usuarios as $usuario) : ?>
                            <tr>
                                <td data-lable="ID:"><?php echo $usuario['id']; ?></td>
                                <td data-lable="Nome:"><?php echo $usuario['nome']; ?></td>
                                <td data-lable="Usuário:"><?php echo $usuario['user']; ?></td>
                                <td data-lable="Foto:">
                                    <?php if (!empty($usuario['foto'])): ?>
                                        <img src="fotos/<?php echo $usuario['foto']; ?>" class="shadow p-1 mb-1 bg-body rounded" width="100px">
                                    <?php else: ?>
                                        <img src="fotos/SemImagem.png" class="shadow p-1 mb-1 bg-body rounded" width="100px">
                                    <?php endif; ?>
                                </td>
                                <td data-lable="Vizualizar">
                                    <a href="view.php?id=<?php echo $usuario['id']; ?>" class="btn_view">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                                <td data-lable="Editar">
                                    <a href="edit.php?id=<?php echo $usuario['id']; ?>" class="btn_edit">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </td>
                                <td data-lable="Excluir">
                                    <a href="#" class="btn_trash" data-bs-toggle="modal" data-bs-target="#delete-modal-user" data-usuario="<?php echo $usuario['id']; ?>">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="7">Nenhum registro encontrado.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php endif; ?>

<?php include("modal.php"); ?>
<?php include(FOOTER_TEMPLATE); ?>
<?php clear_messages(); ?>
