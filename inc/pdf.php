<?php
	// Este e o pdf.php
	include("fpdf.php");

	class PDF extends FPDF
	{
		public $titulo = "LISTA DE USUÁRIOS DO SITE CINEPLAY"; // valor padrão

		function converteTexto($str){
			return iconv("UTF-8", "windows-1252", $str);		
		}

		function Header()
		{
			// Fundo da página (agora um cinza claro)
			$this->SetFillColor(240, 240, 240); // Cinza muito claro para o fundo da página
			$this->Rect(0, 0, $this->GetPageWidth(), $this->GetPageHeight(), 'F');

			// Título
			$this->SetFont('Arial', 'B', 15);
			$this->SetTextColor(0, 0, 0); // Texto do título preto
			$this->Cell(0, 10, $this->converteTexto($this->titulo), 0, 1, 'C');
			$this->Ln(10);
		}

		function Footer()
		{
			$this->SetY(-15);
			$this->SetFont('Arial', 'I', 8);
			$this->SetTextColor(50, 50, 50); // Texto do rodapé cinza escuro
			$this->Cell(0, 10, $this->converteTexto('Página ') . $this->PageNo() . ' de {nb}', 0, 0, 'C');
		}
	}
?>