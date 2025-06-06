<?php

include("../config.php");
include(DBAPI);
include(PDF);

$filmes = null;
$filme = null;

define('PASTA_IMAGENS', 'img/');

/**
 *  Listagem de Filmes
 */
function index() {
    global $filmes;
    $filmes = find_all('filmes');
}

/**
 * Upload centralizado e validado
 */
function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
    try {
        $nomearquivo = basename($arquivo_destino);

        $check = getimagesize($nome_temp);
        if($check === false) {
            throw new Exception("O arquivo não é uma imagem!");
        }

        if(file_exists($arquivo_destino)) {
            throw new Exception("Desculpe, o arquivo já existe!");
        }

        if($tamanho_arquivo > 5000000) {
            throw new Exception("Desculpe, o arquivo é muito grande!");
        }

        if(!in_array($tipo_arquivo, ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new Exception("Desculpe, só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
        }

        if(move_uploaded_file($nome_temp, $arquivo_destino)) {
            $_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
            $_SESSION['type'] = "success";
        } else { 
            throw new Exception("Desculpe, o arquivo não pode ser enviado!");
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
 *  Cadastro de Filmes
 */
function add() {
    if (!empty($_POST['filme'])) {
        try {
            $filme = $_POST['filme'];
            $today = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
            $filme['modified'] = $filme['created'] = $today->format("Y-m-d H:i:s");

            if (!empty($_FILES["foto"]["name"])) {
                $pasta_destino = PASTA_IMAGENS;
                $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                $nomearquivo = basename($_FILES["foto"]["name"]);
                $nome_temp = $_FILES["foto"]["tmp_name"];
                $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
                $tamanho_arquivo = $_FILES["foto"]["size"];

                if ($nome_temp && getimagesize($nome_temp)) {
                    upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                    $filme['foto'] = $nomearquivo;
                } else {
                    throw new Exception("Erro no carregamento da imagem.");
                }
            }

            save("filmes", $filme);
            header("Location: index.php");
            exit;

        } catch (Exception $e) {
            $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
            $_SESSION['type'] = "danger";
        }
    }
}

/**
 * Edição de Filme
 */
function edit() {
    global $filme;

    $now = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        if (isset($_POST['filme'])) {
            try {
                $filme = $_POST['filme'];
                $filme['modified'] = $now->format("Y-m-d H:i:s");

                $filme_existente = find('filmes', $id); // Pega os dados antigos

                // Se uma nova imagem foi enviada:
                if (!empty($_FILES["foto"]["name"])) {
                    $pasta_destino = PASTA_IMAGENS;
                    $arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
                    $nomearquivo = basename($_FILES["foto"]["name"]);
                    $nome_temp = $_FILES["foto"]["tmp_name"];
                    $tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
                    $tamanho_arquivo = $_FILES["foto"]["size"];

                    if ($nome_temp && getimagesize($nome_temp)) {
                        // Remove a imagem antiga, se existir e não for "SemImagem.png"
                        if (!empty($filme_existente['foto']) && $filme_existente['foto'] !== 'SemImagem.png') {
                            $imagem_antiga = PASTA_IMAGENS . $filme_existente['foto'];
                            if (file_exists($imagem_antiga)) {
                                unlink($imagem_antiga);
                            }
                        }

                        // Upload da nova imagem
                        upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
                        $filme['foto'] = $nomearquivo;
                    } else {
                        throw new Exception("Erro no carregamento da imagem.");
                    }
                } else {
                    // Se nenhuma imagem nova foi enviada, mantém a existente
                    if (!empty($filme_existente['foto'])) {
                        $filme['foto'] = $filme_existente['foto'];
                    }
                }

                update('filmes', $id, $filme);
                $_SESSION['message'] = "Filme atualizado com sucesso!";
                $_SESSION['type'] = "success";
                header('Location: index.php');
                exit;

            } catch (Exception $e) {
                $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
                $_SESSION['type'] = "danger";
            }
        } else {
            // Carrega os dados do filme no formulário
            $filme = find('filmes', $id);
        }
    } else {
        header('Location: index.php');
        exit;
    }
}

/**
 *  Exclusão de um Filme
 */
function delete($id = null) {
    try {
        if (isset($id)) {
            $filme = find('filmes', $id);

            if ($filme && !empty($filme['foto'])) {
                $arquivo_imagem = PASTA_IMAGENS . $filme['foto'];
                if (file_exists($arquivo_imagem)) {
                    unlink($arquivo_imagem);
                }
            }

            remove('filmes', $id);
            header('Location: index.php');
            exit;
        } else {
            header('Location: index.php');
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
        $_SESSION['type'] = "danger";
    }
}

/**
 *  Visualização de um Filme
 */
function view($id = null) {
    global $filme;
    $filme = find('filmes', $id);
}

/**
 *  Geração de PDF
 */
function pdf($p = null, $titulo = "LISTA DE FILMES DO SITE CINEPLAY")
{
    $pdf = new PDF();
    $pdf->titulo = $titulo;
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);

    $filmes = $p ? filter("filmes", "nome like '%" . $p . "%'") : find_all("filmes");

    // Cabeçalho
    $pdf->SetTextColor(40, 40, 40); 
    $pdf->SetFillColor(220, 220, 220); 
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(20, 10, $pdf->converteTexto('ID'), 1, 0, 'C', true);
    $pdf->Cell(70, 10, $pdf->converteTexto('Nome'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, $pdf->converteTexto('Classificação'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, $pdf->converteTexto('Foto'), 1, 1, 'C', true);

    // Dados
    $pdf->SetTextColor(50, 50, 50);
    $pdf->SetFont('Times', '', 12);
    $linha = 0;

    foreach ($filmes as $filme) {
        $cellHeight = 30;

        if ($linha % 2 == 0) {
            $pdf->SetFillColor(245, 245, 245);
        } else {
            $pdf->SetFillColor(230, 230, 230);
        }

        $pdf->Cell(20, $cellHeight, $filme['id'], 1, 0, 'C', true);
        $pdf->Cell(70, $cellHeight, $pdf->converteTexto($filme['nome']), 1, 0, 'C', true);
        $pdf->Cell(50, $cellHeight, $pdf->converteTexto($filme['classificacao']), 1, 0, 'C', true);

        $caminho_foto = PASTA_IMAGENS . (!empty($filme['foto']) ? $filme['foto'] : null);
        if ($caminho_foto && file_exists($caminho_foto)) {
            $extensao = pathinfo($caminho_foto, PATHINFO_EXTENSION);
            if (in_array(strtolower($extensao), ['jpg', 'jpeg', 'png', 'gif'])) {
                $x = $pdf->GetX();
                $y = $pdf->GetY();
                $pdf->Cell(50, $cellHeight, '', 1, 0, 'C', true);
                $pdf->Image($caminho_foto, $x + 15, $y + 5, 20, 20);
            } else {
                $pdf->Cell(50, $cellHeight, $pdf->converteTexto('SEM IMAGEM'), 1, 0, 'C', true);
            }
        } else {
            $pdf->Cell(50, $cellHeight, $pdf->converteTexto('SEM IMAGEM'), 1, 0, 'C', true);
        }

        $pdf->Ln();
        $linha++;
    }

    $pdf->Output("D", "filmes.pdf");
}
