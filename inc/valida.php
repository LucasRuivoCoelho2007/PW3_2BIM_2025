<?php
// valida.php

// Início da sessão (sempre antes de qualquer saída)
if (!isset($_SESSION)) session_start();

include("../config.php");
require_once(DBAPI);

// Tenta se conectar a um banco de dados MySQL usando PDO
$bd = open_database();

// Verifica se houve POST e se o usuário ou a senha é(são) vazio(s)
if (!empty($_POST) && (empty($_POST['login']) || empty($_POST['senha']))) {
    header("Location: " . BASEURL . "index.php");
    exit;
}

try {
    // Captura o login e senha do formulário
    $usuario = $_POST['login'];
    $senha = $_POST['senha'];

    if (!empty($usuario) && !empty($senha)) {
        // Criptografar a senha
        $senha = criptografia($senha);

        // Validação do usuário/senha
        // Prepara a consulta SQL com o PDO (usando prepared statements)
        $sql = "SELECT id, nome, user, password FROM usuarios WHERE user = :usuario AND password = :senha LIMIT 1";
        $stmt = $bd->prepare($sql);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);

        // Executa a consulta
        $stmt->execute();

        // Verifica se o usuário foi encontrado
        if ($stmt->rowCount() > 0) {
            $dados = $stmt->fetch(PDO::FETCH_ASSOC);
            $id = $dados['id'];
            $nome = $dados['nome'];
            $user = $dados['user'];

            if (!empty($user)) {
                // Configura a sessão
                $_SESSION['message'] = "Bem-vindo " . $nome;
                $_SESSION['type'] = "info";
                $_SESSION['id'] = $id;
                $_SESSION['nome'] = $nome;
                $_SESSION['user'] = $user;

                // Redireciona para a página inicial após login
                header("Location: " . BASEURL . "index.php");
                exit;
            } else {
                throw new Exception("Usuário inválido. Verifique seu login.");
            }
        } else {
            throw new Exception("Usuário ou senha incorretos.");
        }
    } else {
        throw new Exception("Os campos de login e senha são obrigatórios.");
    }
} catch (Exception $e) {
    // Configura a mensagem de erro na sessão
    $_SESSION['message'] = "Ocorreu um erro: " . $e->getMessage();
    $_SESSION['type'] = "danger";

    // Redireciona para a página inicial em caso de erro
    header("Location: " . BASEURL . "index.php");
    exit;
}
?>

<!-- Somente inclui o template após o processamento -->
<?php include(HEADER_TEMPLATE); ?>

<!-- Exibe mensagens de erro ou sucesso -->
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert" id="actions">
        <?php echo $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php clear_messages(); ?>
<?php endif; ?>

<header>
    <a href="<?php echo BASEURL; ?>index.php" class="btn btn-light">
        <i class="fa-solid fa-rotate-left"></i> Voltar
    </a>
</header>

<?php include(FOOTER_TEMPLATE); ?>
