<?php 
include("functions.php");

if (!isset($_SESSION)) session_start();

if (isset($_SESSION['user'])) {
    // Aqui pode verificar se o usuário é admin
} else {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
    $_SESSION['type'] = "danger";
    // header("Location:" . BASEURL . "index.php");
}

add();
include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
    <h2>Cadastro de Cliente</h2>

    <form action="add.php" method="post">
        <div class="row g-3">
            <div class="col-md-6 textfield">
                <label>CEP <span class="text-danger">*</span></label>
                <input type="text" name="customer[zip_code]" id="cep" placeholder="Ex: 18087-655" maxlength="9" required>
            </div>

            <div class="col-md-6 textfield">
                <label>Nome / Razão Social <span class="text-danger">*</span></label>
                <input type="text" name="customer[name]" placeholder="Ex: Lucas Nascimento" maxlength="100" required>
            </div>

            <div class="col-md-6 textfield">
                <label>CNPJ / CPF</label>
                <input type="text" name="customer[cpf_cnpj]" placeholder="Ex: 123.456.789-00" maxlength="18">
            </div>

            <div class="col-md-6 textfield">
                <label>Data de Nascimento</label>
                <?php date_default_timezone_set('America/Sao_Paulo'); $data_hoje = date('Y-m-d'); ?>
                <input type="date" name="customer[birthdate]" value="<?php echo $data_hoje; ?>">
            </div>

            <!-- Espaçamento antes dos campos preenchidos pelo CEP -->
            <div class="w-100 mt-4"></div>

            <div class="col-md-6 textfield">
                <label>Endereço</label>
                <input type="text" name="customer[address]" id="logradouro" placeholder="Ex: Rua da Web" maxlength="150">
            </div>

            <div class="col-md-6 textfield">
                <label>Bairro</label>
                <input type="text" name="customer[hood]" id="bairro" placeholder="Ex: Vila dos Reis" maxlength="50">
            </div>

            <div class="col-md-6 textfield">
                <label>Município</label>
                <input type="text" name="customer[city]" id="localidade" placeholder="Ex: Sorocaba" maxlength="50">
            </div>

            <div class="col-md-6 textfield">
                <label>UF</label>
                <input type="text" name="customer[state]" id="uf" placeholder="Ex: SP" maxlength="2">
            </div>

            <div class="col-md-6 textfield">
                <label>Telefone <span class="text-danger">*</span></label>
                <input type="tel" name="customer[phone]" placeholder="Ex: 15 98829-6269" maxlength="15" required>
            </div>

            <div class="col-md-6 textfield">
                <label>Celular</label>
                <input type="text" name="customer[mobile]" placeholder="Ex: 15 98829-6269" maxlength="15">
            </div>

            <div class="col-md-6 textfield">
                <label>Inscrição Estadual<span class="text-danger">*</span></label>
                <input type="text" name="customer[ie]" placeholder="Ex: 128.893.456" maxlength="9" required>
            </div>

            <div class="col-md-6 textfield">
                <label>Data de Cadastro</label>
                <?php $data_hoje = date('Y-m-d'); ?>
                <input type="date" name="customer[created]" value="<?php echo $data_hoje; ?>" disabled>
            </div>
        </div>

        <div class="text-center mt-4">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a class="btn btn-outline-light mt-2" href="add.php">
                    <i class="fa fa-refresh"></i> Atualizar
                </a>
            <?php else: ?>
                <button type="submit" class="btn-login larg-main-btn">
                    Cadastrar Cliente
                </button>
            <?php endif; ?>
        </div>
    </form>
</div>

<script>
document.getElementById('cep').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');

    if (cep.length === 8) {
        fetch('https://viacep.com.br/ws/' + cep + '/json/')
            .then(response => response.json())
            .then(data => {
                if (!data.erro) {
                    document.getElementById('logradouro').value = data.logradouro;
                    document.getElementById('bairro').value = data.bairro;
                    document.getElementById('localidade').value = data.localidade;
                    document.getElementById('uf').value = data.uf;
                } else {
                    alert('CEP não encontrado!');
                }
            })
            .catch(() => {
                alert('Erro ao consultar o CEP!');
            });
    } else {
        alert('CEP inválido! Insira um CEP com 8 dígitos.');
    }
});
</script>

<?php clear_messages(); ?>
<?php include(FOOTER_TEMPLATE); ?>
