<?php 
    include "functions.php";

    if (!isset($_SESSION)) session_start();

    if (isset($_SESSION['user'])) { 
        // Aqui poderia ter validação de admin
    } else {
        $_SESSION['message'] = "Você precisa estar logado e ser administrador para acessar esse recurso!";
        $_SESSION['type'] = "danger";
    }

    add();
    include(HEADER_TEMPLATE); 
?>

<div class="main-login"> 
    <div class="left-login">
        <h1>Cadastre seu filme favorito!</h1>
        <img src="./img/animacaoIndex.svg" class="left-login-image">
    </div>
    <div class="right-login">
        <div class="card-login">
            <h1>FILMES</h1>
            <form action="add2.php" method="post" enctype="multipart/form-data">
                <div class="card-align">
                    <div class="left-card">
                        <div class="textfield">
                            <label for="nome">Filme</label>
                            <input type="text" name="filme[nome]" maxlength="50" placeholder="Ex: Jurassic Park">
                        </div>
                        <div class="textfield">
                            <label for="diretor">Diretor</label>
                            <input type="text" name="filme[diretor]" maxlength="50" placeholder="Ex: Steven Spielberg">
                        </div>
                        <div class="textfield">
                            <label for="classificacao">Gênero</label>
                            <input type="text" name="filme[classificacao]" maxlength="50" placeholder="Ex: Ficção científica">
                        </div>
                    </div>
                    <div class="right-card">
                        <div class="textfield">
                            <label for="ano">Ano</label>
                            <input type="number" name="filme[ano]" maxlength="4" placeholder="Ex: 1993">
                        </div>
                        <div class="textfield">
                            <label for="data_cadastro">Data de cadastro</label>
                            <?php 
                                date_default_timezone_set('America/Sao_Paulo');
                                $data_hoje = date('Y-m-d');
                            ?>
                            <input type="date" name="filme[data_cadastro]" value="<?php echo $data_hoje ?>">
                        </div>
                        <div class="textfield">
                            <label for="preco">Preço</label>
                            <input type="number" step="any" name="filme[preco]" placeholder="Ex: 29.99">
                        </div>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 30px; margin-top: 25px;">
                    <div class="textfield" style="flex-grow: 1; display: flex; flex-direction: column; align-items: center;">
                        <label for="foto" style="
                            font-weight: bold; 
                            color: white; 
                            font-size: 18px;
                            margin-bottom: 10px;
                        ">
                            <i class="fa-solid fa-image" style="color:#00ff88; font-size: 24px;"></i> 
                            Selecione a Imagem do Filme
                        </label>

                        <label for="foto" style="
                            display: inline-block;
                            padding: 10px 50px;
                            background-color: #514869;
                            color: #fff;
                            border: 1px solid #fff;
                            border-radius: 8px;
                            font-size: 16px;
                            font-weight: bold;
                            text-align: center;
                            cursor: pointer;
                            transition: background-color 0.3s ease, transform 0.2s ease;
                        ">
                            Escolher Arquivo
                        </label>
                        <input type="file" id="foto" name="foto" accept="image/*" style="display: none;">

                        <div style="
                            margin-top: 20px; 
                            width: 150px; 
                            height: 150px; 
                            border-radius: 10%; 
                            overflow: hidden;
                            border: 4px solid #fff; 
                            display: flex; 
                            justify-content: center; 
                            align-items: center;
                            background-color: #514869;
                            position: relative;
                            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
                        ">
                            <img id="imgPreview" src="<?php echo (!empty($foto) && file_exists('img/' . $foto)) ? 'img/' . $foto : 'img/SemImagem.png'; ?>" alt="Imagem do filme" style="
                                width: 100%; 
                                height: 100%; 
                                object-fit: cover;
                                transition: opacity 0.3s ease;
                            ">
                        </div>

                        <p id="error-msg" style="color: red; font-size: 14px; margin-top: 10px; display: none;">Por favor, selecione uma imagem válida.</p>
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
                        <button class="btn-login">Cadastrar</button>
                    <?php endif; ?>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Função para pré-visualizar a imagem e fazer validação
    document.getElementById('foto').addEventListener('change', function() {
        const file = this.files[0];
        const errorMsg = document.getElementById('error-msg');
        
        if (file) {
            // Verifica o tipo da imagem
            const validImageTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (validImageTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('imgPreview').setAttribute('src', event.target.result);
                    errorMsg.style.display = 'none';  // Esconde a mensagem de erro
                }
                reader.readAsDataURL(file);
            } else {
                // Se a imagem for inválida, exibe mensagem de erro
                document.getElementById('imgPreview').setAttribute('src', 'img/SemImagem.png');
                errorMsg.style.display = 'block';  // Exibe a mensagem de erro
            }
        } else {
            document.getElementById('imgPreview').setAttribute('src', 'img/SemImagem.png');
            errorMsg.style.display = 'none';  // Esconde a mensagem de erro
        }
    });
</script>

<?php 
    clear_messages();
    include(FOOTER_TEMPLATE); 
?>