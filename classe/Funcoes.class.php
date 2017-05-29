<?php
//BUSCANDO A CLASSE
require_once 'PHPMailer-master/PHPMailerAutoload.php';
//INICIANDO A CLASSE
class Funcoes{
	//ATRIBUTOS
	private $objmail;
	//CONTRUTOR
	public function __construct(){
		$this->objmail = new PHPMailer();		
	}
	//METODO RESPONWSAVEL POR TRATAR OS CARACTERES DOS DADOS
	public function tratarCaracter($vlr, $tipo){
		switch($tipo){
			case 1: $rst = utf8_decode($vlr); break;
			case 2: $rst = htmlentities($vlr, ENT_QUOTES, "ISO-8859-1"); break; 
		}
		return $rst;
	}
	//RESPONSAVEL POR ENVIAR O E-MAIL
	public function enviarEmail($dados){

		$this->objmail->IsSMTP();
		$this->objmail->SMTPAuth = true;
		$this->objmail->SMTPSecure = 'tls';
		$this->objmail->Port = 587;
		$this->objmail->Host = 'Smtp.live.com';
		$this->objmail->Username = 'edsonbastos2@hotmail.com';
		$this->objmail->Password = 'redhot271185';
		$this->objmail->ContentType = 'text/html; charset=utf-8';
		$this->objmail->SetFrom('edsonbastos2@hotmai.com', 'Contato');
		$this->objmail->AddAddress('edsonbastos2@hotmail.com', 'Teste de envio de e-mail');
		$this->objmail->Subject = ''.$this->tratarCaracter($dados['assunto'], 1).'';
		
		$html = '<p><strong>Nome:</strong> '.$this->tratarCaracter($dados['nome'], 1).'<br>';
		$html .= '<strong>E-mail:</strong> '.$dados['email'].'<br>';
		$html .= '<strong>Assunto:</strong> '.$this->tratarCaracter($dados['assunto'], 1).'<br>';
		$html .= '<strong>Mensagem:</strong><br>';
		$html .= $this->tratarCaracter($dados['mensagem'], 1).'</p>';
		
		$this->objmail->MsgHTML($html);
		
		if (!$this->objmail->Send()) {
			echo "Falhar ao enviar e-mail: " . $this->objmail->ErrorInfo;
		} else {
			echo "Mensagem enviada com sucesso ";
		}

	}
}

?>
