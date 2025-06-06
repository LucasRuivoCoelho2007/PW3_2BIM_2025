<?php 
    include('functions.php'); 
    view($_GET['id']);
    include(HEADER_TEMPLATE);
?>

<style>
    .custom-card {
        background-color: #514869; /* cinza escuro para o card */
        color: white;
    }
    .custom-card p, 
    .custom-card h5 {
        color: white;
    }
    .custom-icon {
        color: #00ff88; /* verde atual */
    }
    .btn-custom {
        color: #00ff88 !important;
        background-color:#514869 !important;
        border: none !important;
    }
    .btn-custom:hover {
        background-color: #3e3458 !important;
        color: #00ff88 !important;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center"><?php echo htmlspecialchars($customer['name']); ?></h2>

    <?php if (!empty($_SESSION['message'])) : ?>
        <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="row g-4">

        <div class="col-md-6">
            <div class="card shadow-sm h-100 custom-card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-user me-2 custom-icon"></i>Dados Pessoais</h5>
                    <p><i class="fa-solid fa-id-card me-2 custom-icon"></i><strong>Nome / Razão Social:</strong> <?php echo htmlspecialchars($customer['name']); ?></p>
                    <p><i class="fa-solid fa-file-invoice me-2 custom-icon"></i><strong>CPF / CNPJ:</strong> <?php echo htmlspecialchars($customer['cpf_cnpj']); ?></p>
                    <p><i class="fa-solid fa-calendar-days me-2 custom-icon"></i><strong>Data de Nascimento:</strong> <?php echo formatadata($customer['birthdate'], "d/m/Y"); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100 custom-card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-location-dot me-2 custom-icon"></i>Endereço</h5>
                    <p><i class="fa-solid fa-road me-2 custom-icon"></i><strong>Endereço:</strong> <?php echo htmlspecialchars($customer['address']); ?></p>
                    <p><i class="fa-solid fa-building me-2 custom-icon"></i><strong>Bairro:</strong> <?php echo htmlspecialchars($customer['hood']); ?></p>
                    <p><i class="fa-solid fa-envelope me-2 custom-icon"></i><strong>CEP:</strong> <?php echo format_cpf_cnpj($customer['zip_code']); ?></p>
                    <p><i class="fa-solid fa-city me-2 custom-icon"></i><strong>Cidade:</strong> <?php echo htmlspecialchars($customer['city']); ?></p>
                    <p><i class="fa-solid fa-flag-usa me-2 custom-icon"></i><strong>UF:</strong> <?php echo htmlspecialchars($customer['state']); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100 custom-card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-phone me-2 custom-icon"></i>Contato</h5>
                    <p><i class="fa-solid fa-phone-volume me-2 custom-icon"></i><strong>Telefone:</strong> <?php echo telefone($customer['phone']); ?></p>
                    <p><i class="fa-solid fa-mobile-screen-button me-2 custom-icon"></i><strong>Celular:</strong> <?php echo telefone($customer['mobile']); ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100 custom-card">
                <div class="card-body">
                    <h5 class="card-title mb-3"><i class="fa-solid fa-info-circle me-2 custom-icon"></i>Outros Dados</h5>
                    <p><i class="fa-solid fa-file-invoice-dollar me-2 custom-icon"></i><strong>Inscrição Estadual:</strong> <?php echo number_format($customer['ie'], 0,",","."); ?></p>
                    <p><i class="fa-solid fa-hashtag me-2 custom-icon"></i><strong>ID:</strong> <?php echo htmlspecialchars($customer['id']); ?></p>
                    <p><i class="fa-solid fa-calendar-plus me-2 custom-icon"></i><strong>Data de Cadastro:</strong> <?php echo formatadata($customer['created'], "d/m/Y - H:i:s"); ?></p>
                    <p><i class="fa-solid fa-calendar-check me-2 custom-icon"></i><strong>Data de Alteração:</strong> <?php echo formatadata($customer['modified'], "d/m/Y"); ?></p>
                </div>
            </div>
        </div>

    </div>

    <div class="text-center mt-4">
        <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-secondary btn-custom me-2">
            <i class="fa-solid fa-pen-to-square"></i> Editar
        </a>
        <a href="index.php" class="btn btn-light btn-custom">
            <i class="fa-solid fa-arrow-left"></i> Voltar
        </a>
    </div>
</div>

<?php include(FOOTER_TEMPLATE); ?>
