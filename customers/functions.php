<?php

	include("../config.php");
	include(DBAPI);
	include(PDF);


	$customers = null;
	$customer = null;

	/**
	 *  Listagem de Clientes
	 */
function index() {
	global $customers;
	$customers = find_all('customers');

}

	
	/**
	 *  Cadastro de Clientes
	 */
	function add() {

		if (!empty($_POST['customer'])) {

			$today = 
			new DateTime("now", new DateTimeZone('America/Sao_Paulo'));

			$customer = $_POST['customer'];
			$customer['modified'] = $customer['created'] = $today->format("Y-m-d H:i:s");

			save("customers", $customer);
			header("location: index.php");
		}
	}
	function edit() {

		$now = date_create('now', new DateTimeZone('America/Sao_Paulo'));

		if (isset($_GET['id'])) {

			$id = $_GET['id'];

			if (isset($_POST['customer'])) {

				$customer = $_POST['customer'];
				$customer['modified'] = $now->format("Y-m-d H:i:s");

				update('customers', $id, $customer);
				header('location: index.php');
			} else {

				global $customer;
				$customer = find('customers', $id);
			} 
		} else {
			header('location: index.php');
		}
	}

/**
		*  Exclusão de um Cliente
		*/
	function delete($id = null) {
		
		global $customer;
		$customer = remove('customers', $id);

		header('location: index.php');
	}

	/**
	 *  Visualização de um Cliente
	 */
	function view($id = null) {
		
	  global $customer;
	  $customer = find('customers', $id);
	}
function pdf($p = null, $titulo = "LISTA DE CLIENTES DO SITE CINEPLAY")
{
    $pdf = new PDF('L'); // Paisagem
    $pdf->titulo = $titulo;
    $pdf->AliasNbPages();
    $pdf->AddPage();

    $pdf->SetFont('Arial', '', 12);

    $customers = $p ? filter("customers", "name like '%" . $p . "%'") : find_all("customers");

    // Cabeçalho
    $pdf->SetTextColor(0, 0, 0); // Cor de texto preta
    $pdf->SetFillColor(220, 220, 220); // Fundo claro
    $pdf->SetFont('Times', 'B', 12);

    $pdf->Cell(10, 10, $pdf->converteTexto('ID'), 1, 0, 'C', true);
    $pdf->Cell(35, 10, $pdf->converteTexto('Nome'), 1, 0, 'C', true);  // Reduzi para 35
    $pdf->Cell(30, 10, $pdf->converteTexto('CPF/CNPJ'), 1, 0, 'C', true);
    $pdf->Cell(20, 10, $pdf->converteTexto('Nascimento'), 1, 0, 'C', true);
    $pdf->Cell(20, 10, $pdf->converteTexto('CEP'), 1, 0, 'C', true);
    $pdf->Cell(50, 10, $pdf->converteTexto('Endereço'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, $pdf->converteTexto('Bairro'), 1, 0, 'C', true);
    $pdf->Cell(25, 10, $pdf->converteTexto('Cidade'), 1, 0, 'C', true);
    $pdf->Cell(10, 10, $pdf->converteTexto('UF'), 1, 0, 'C', true);
    $pdf->Cell(30, 10, $pdf->converteTexto('Telefone'), 1, 0, 'C', true);
    $pdf->Cell(25, 10, $pdf->converteTexto('Cadastro'), 1, 1, 'C', true);  // Aumentei um pouco aqui

    // Dados
    $pdf->SetTextColor(50, 50, 50); // Cor do texto (mais escuro para contraste)
    $pdf->SetFont('Times', '', 10);
    $linha = 0;

    foreach ($customers as $customer) {
        // Alterna a cor de fundo para linhas pares e ímpares
        if ($linha % 2 == 0) {
            $pdf->SetFillColor(245, 245, 245); // Linhas alternadas com fundo mais claro
        } else {
            $pdf->SetFillColor(255, 255, 255); // Linha branca
        }

        $pdf->Cell(10, 10, $customer['id'], 1, 0, 'C', true);
        $pdf->Cell(35, 10, $pdf->converteTexto($customer['name']), 1, 0, 'L', true);
        $pdf->Cell(30, 10, $pdf->converteTexto($customer['cpf_cnpj']), 1, 0, 'C', true);
        $pdf->Cell(20, 10, date('d/m/Y', strtotime($customer['birthdate'])), 1, 0, 'C', true);
        $pdf->Cell(20, 10, $customer['zip_code'], 1, 0, 'C', true);
        $pdf->Cell(50, 10, $pdf->converteTexto($customer['address']), 1, 0, 'L', true);
        $pdf->Cell(30, 10, $pdf->converteTexto($customer['hood']), 1, 0, 'L', true);
        $pdf->Cell(25, 10, $pdf->converteTexto($customer['city']), 1, 0, 'L', true);
        $pdf->Cell(10, 10, strtoupper($customer['state']), 1, 0, 'C', true);
        $pdf->Cell(30, 10, $pdf->converteTexto($customer['phone']), 1, 0, 'C', true);
        $pdf->Cell(25, 10, date('d/m/Y', strtotime($customer['created'])), 1, 1, 'C', true);

        $linha++;
    }

    $pdf->Output("D", "clientes.pdf");
}
