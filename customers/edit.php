<?php 
    include("functions.php");

    if (!isset($_SESSION)) session_start();

    if (isset($_SESSION['user'])) {
        // Aqui pode verificar se o usuário é admin
    } else {
        $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
        // header("Location:" . BASEURL. "index.php");
    }

    edit();
    include(HEADER_TEMPLATE);
?>

<div class="container mt-5">
    <h2>Editando <?php echo $customer['name']; ?>...</h2>

    <form action="edit.php?id=<?php echo $customer['id']; ?>" method="post">
        <div class="row g-3">
            <div class="col-md-6 textfield">
                <label>Nome / Razão Social</label>
                <input type="text" name="customer[name]" value="<?php echo $customer['name']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>CNPJ / CPF</label>
                <input type="text" name="customer[cpf_cnpj]" value="<?php echo $customer['cpf_cnpj']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Data de Nascimento</label>
                <?php $data_atual = formatadata($customer['birthdate'], 'Y-m-d'); ?>
                <input type="date" name="customer[birthdate]" value="<?php echo $data_atual; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Endereço</label>
                <input type="text" name="customer[address]" value="<?php echo $customer['address']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Bairro</label>
                <input type="text" name="customer[hood]" value="<?php echo $customer['hood']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>CEP</label>
                <input type="text" name="customer[zip_code]" value="<?php echo $customer['zip_code']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Município</label>
                <input type="text" name="customer[city]" value="<?php echo $customer['city']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Telefone</label>
                <input type="tel" name="customer[phone]" value="<?php echo $customer['phone']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Celular</label>
                <input type="text" name="customer[mobile]" value="<?php echo $customer['mobile']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>UF</label>
                <input type="text" name="customer[state]" value="<?php echo $customer['state']; ?>">
            </div>

            <div class="col-md-6 textfield">
                <label>Inscrição Estadual</label>
                <input type="text" name="customer[ie]" value="<?php echo $customer['ie']; ?>">
            </div>

            <div class="col-md-6 textfield">
				<label>Data de Cadastro</label>
				<?php $data_atual2 = formatadata($customer['created'], 'Y-m-d'); ?>
				<input type="date" name="customer[created]" value="<?php echo $data_atual2; ?>" disabled>
			</div>

        </div>

        <div class="text-center mt-4">
            <?php if (!empty($_SESSION['message'])): ?>
                <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
                    <?php echo $_SESSION['message']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a class="btn btn-outline-light mt-2" href="edit.php?id=<?php echo $customer['id']; ?>">
                    <i class="fa fa-refresh"></i> Atualizar
                </a>
            <?php else: ?>
                <button type="submit" class="btn-login larg-main-btn">
                    Editar Cliente
                </button>
            <?php endif; ?>
        </div>
    </form>
</div>

<?php clear_messages(); ?>
<?php include(FOOTER_TEMPLATE); ?>
