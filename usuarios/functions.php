<?php

	include("../config.php");
	include(DBAPI);
	include(PDF);

	$usuarios = null;
	$usuario = null;

	/**
	 *  Listagem de Usuarios
	 */
	function index() {
		global $usuarios;
		if (!empty($_POST['users'])) {
			$search = $_POST['users'];
			$usuarios = filter("usuarios", "nome LIKE '%" . $search . "%'");
		} else {
			$usuarios = find_all("usuarios");
		}
	}
	
	function upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo) {
		try {
			 $nomearquivo = basename($arquivo_destino);
			 $uploadOk = 1;
			 
			if(isset($_POST["submit"])) {
				$check = getimagesize($nome_temp);
				if($check !== false) {
					$_SESSION['message'] = "File is an image - " . $check["mime"] . ".";
					$_SESSION['type'] = "info";
					$uploadOk = 1;
				} else {
					$uploadOk = 0;
					throw new Exception("O arquivo não é uma imagem!");
				}
			}
			
			if(file_exists($arquivo_destino)) {
				$uploadOk = 0;
				throw new Exception("Desculpe, o arquivo já existe!");
			}
			
			if($tamanho_arquivo > 5000000) {
				$uploadOk = 0;
				throw new Exception("Desculpe, o arquivo é muito grande!");
			}
			
			if($tipo_arquivo != "jpg" && $tipo_arquivo != "png" && $tipo_arquivo != "jpeg" && $tipo_arquivo != "gif")  {
				$uploadOk = 0;
				throw new Exception("Desculpe, só são permitidos arquivos de imagem JPG, JPEG, PNG e GIF!");
			}
			
			if($uploadOk == 0) {
				throw new Exception("Desculpe, o arquivo não pode ser enviado!");
			} else {
				if(move_uploaded_file($_FILES["foto"] ["tmp_name"], $arquivo_destino)) {
					$_SESSION['message'] = "O arquivo " . htmlspecialchars($nomearquivo) . " foi armazenado.";
					$_SESSION['type'] = "success";
				} else { 
					throw new Exception("Desculpe, o arquivo não pode ser enviado!");
				}
			}
		} catch (Exeception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	 *  Cadastro de Usuarios
	 */
	function add() {
		if (!empty($_POST['usuario'])) {
			try {
				$usuario = $_POST['usuario'];
				
				if (!empty($_FILES["foto"]["name"])) {
					$pasta_destino = "fotos/";
					$arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
					$nomearquivo = basename($_FILES["foto"]["name"]);
					$nome_temp = $_FILES["foto"]["tmp_name"];  // Corrigido para tmp_name
					$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
					$tamanho_arquivo = $_FILES["foto"]["size"];

					// Verifique se o arquivo foi carregado corretamente antes de usar getimagesize
					if ($nome_temp && getimagesize($nome_temp)) {
						upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
						$usuario['foto'] = $nomearquivo;
					} else {
						throw new Exception("Erro no carregamento da imagem.");
					}
				}

				if (!empty($usuario['password'])) {
					$senha = criptografia($usuario['password']);
					$usuario['password'] = $senha;
				}

				save("usuarios", $usuario);
				header("location: index.php");
			} catch (Exception $e) {
				$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
				$_SESSION['type'] = "danger";
			}
		}
	}

	/**
	 *	Atualizacao/Edicao de Usuario
	 */
	function edit() {

		//$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));
		try {
			
			if (isset($_GET['id'])) {

				$id = $_GET['id'];

				if (isset($_POST['usuario'])) {

					$usuario = $_POST['usuario'];
					//$usuario['modified'] = $now->format("Y-m-d H:i:s");

					if(!empty($usuario['password'])) {
						$senha = criptografia($usuario['password']);
						$usuario['password'] = $senha;
					}
					
					if (!empty($_FILES["foto"]["name"])) {
						$pasta_destino = "fotos/";
						$arquivo_destino = $pasta_destino . basename($_FILES["foto"]["name"]);
						$nomearquivo = basename($_FILES["foto"]["name"]);
						$nome_temp = $_FILES["foto"]["tmp_name"];  // Corrigido para tmp_name
						$tipo_arquivo = strtolower(pathinfo($arquivo_destino, PATHINFO_EXTENSION));
						$tamanho_arquivo = $_FILES["foto"]["size"];

						// Verifique se o arquivo foi carregado corretamente antes de usar getimagesize
						if ($nome_temp && getimagesize($nome_temp)) {
							upload($pasta_destino, $arquivo_destino, $tipo_arquivo, $nome_temp, $tamanho_arquivo);
							$usuario['foto'] = $nomearquivo;
						} else {
							throw new Exception("Erro no carregamento da imagem.");
						}
					}
					update('usuarios', $id, $usuario);
					
					header('location: index.php');
					
				} else {
	
					global $usuario;
					$usuario = find('usuarios', $id);
					
				} 
			} else {
				header('location: index.php');
			}
		} catch(Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->GetMessage();
			$_SESSION['type'] = "danger";
		}
	}
	
	/**
	 *  Visualização de um Usuario
	 */
	function view($id = null) {
		global $usuario;
		$usuario = find('usuarios', $id);
	}
		
	//Exclusão de um Usuario

	//function delete($id = null)
	//{

	//	global $usuario;
	//	$usuario = remove('usuarios', $id);

	//	header('location: index.php');
	//}
	
	function delete($id = null){
		try {
			if (isset($id)) {
				// Busca os dados do usuário antes de remover
				$usuario = find('usuarios', $id);

				if ($usuario) {
					// Verifica se o campo 'foto' existe e contém um nome válido
					if (!empty($usuario['foto'])) {
						$pasta_destino = "fotos/";
						$arquivo_foto = $pasta_destino . $usuario['foto'];

						// Apaga a foto se ela existir
						if (file_exists($arquivo_foto)) {
							unlink($arquivo_foto);
						}
					}

					// Remove o usuário do banco de dados
					remove('usuarios', $id);
				}

				// Redireciona após a exclusão
				header('location: index.php');
			} else {
				header('location: index.php');
			}
		} catch (Exception $e) {
			$_SESSION['message'] = "Aconteceu um erro: " . $e->getMessage();
			$_SESSION['type'] = "danger";
		}
	}



function pdf($p = null, $titulo = "LISTA DE USUÁRIOS DO SITE CINEPLAY")
{
    $pdf = new PDF();
    $pdf->titulo = $titulo; // Define o cabeçalho
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);

    $usuarios = $p ? filter("usuarios", "nome like '%" . $p . "%'") : find_all("usuarios");

    // Cabeçalho
    $pdf->SetTextColor(0, 0, 0); // Cor do texto preta (mais clara)
    $pdf->SetFillColor(220, 220, 220); // Fundo cinza claro (similar ao primeiro código)
    $pdf->SetFont('Times', 'B', 12);
    $pdf->Cell(20, 10, $pdf->converteTexto('ID'), 1, 0, 'C', true);
    $pdf->Cell(70, 10, $pdf->converteTexto('Nome'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, $pdf->converteTexto('Usuário'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, $pdf->converteTexto('Foto'), 1, 1, 'C', true);

    // Dados
    $pdf->SetTextColor(0, 0, 0); // Cor do texto preta (mais clara)
    $pdf->SetFont('Times', '', 12);
    $linha = 0;
    foreach ($usuarios as $usuario) {
        $cellHeight = 30;

        // Alternando entre cores claras para as linhas
        if ($linha % 2 == 0) {
            $pdf->SetFillColor(245, 245, 245); // Cor de fundo mais clara (alternando)
        } else {
            $pdf->SetFillColor(230, 230, 230); // Cor de fundo mais escura (alternando)
        }

        $pdf->Cell(20, $cellHeight, $usuario['id'], 1, 0, 'C', true);
        $pdf->Cell(70, $cellHeight, $pdf->converteTexto($usuario['nome']), 1, 0, 'C', true);
        $pdf->Cell(50, $cellHeight, $pdf->converteTexto($usuario['user']), 1, 0, 'C', true);

        $caminho_foto = "fotos/" . (!empty($usuario['foto']) ? $usuario['foto'] : null);
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

    $pdf->Output("D", "usuarios.pdf");
}
