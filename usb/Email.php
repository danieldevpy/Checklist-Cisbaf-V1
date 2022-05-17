<?php
include("..\\src\POP3.php");
include("..\\src\SMTP.php");
include("..\\src\PHPMailer.php");
include("..\\src\Exception.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use GeraPDF\GeraPDF\GeraPDF;


class Email{


	public function gerarEmail(){
	

		$nomeFuncionario = filter_input(INPUT_POST,"nomeFuncionario",FILTER_SANITIZE_STRING);
		$nomeCargo = filter_input(INPUT_POST,"nomeCargo",FILTER_SANITIZE_STRING);
		$unidade = filter_input(INPUT_POST,"unidade",FILTER_SANITIZE_STRING);
		$viatura = filter_input(INPUT_POST,"viatura",FILTER_SANITIZE_STRING);


		

	
	$caracteres_sem_acento = array(
    'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj',' '=>'Z', ' '=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
    'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
    'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
    'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
    'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
    'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
    'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
    'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
);


function email($para_email, $para_nome, $assunto, $html, $arquivo, $nomeArquivo, $resposta, $respostaNome) {

  $mail = new PHPMailer; 
  $mail->IsSMTP();  
  $mail->From = "ticisbaf@gmail.com"; 
  $mail->FromName = "Cisbaf Sistemas de Informacao";
  $mail->Host       = "smtp.gmail.com";
  $mail->Port       = 587;
  $mail->SMTPAuth   = true;
  $mail->Username =   "ticisbaf@gmail.com";
  $mail->Password =   "!@7890380!@Cisbaf!@";
  $mail->AddAttachment($arquivo, $nomeArquivo ); 
  
  $mail->addReplyTo($resposta, $respostaNome);

  $mail->Subject = $assunto;
  $mail->AltBody = "Para ver essa mensagem, use um programa compatível com HTML!";


  $emails = array("ticisbaf@gmail.com","coord.enf.cisbaf@gmail.com",$para_email);
  $forName = null;

  foreach($emails as $i => $value){
	  if($value == "ticisbaf@gmail.com"){
		  $forName = "Sistemas de Informacao do Cisbaf";
	  }else if($value == "coord.enf.cisbaf@gmail.com"){
		   $forName = "Coordenacao Samu";
	  }else if($value == $para_email){
		  $forName = $unidade;
	  }
	  
	  $mail->AddAddress($value,$forName);
  }

 

    $mail->MsgHTML($html);
  if (!$mail->Send()) {
    return "Lamento, ocorreu algum erro, tente novamente mais tarde.";
  }
}



//CORPO DO ENVIO DE EMAIL PARA O DESTINATARIO
$corpo_email = "
<html>
	<body >
	<img src='http://requerimento.cisbaf.com:8090/requerimento/imagens/cisbaf_suporte.jpg' alt='Cisbaf - Consorcio Intermunicipal de Saude da Baixada fluminense'>
		<h2>Novo CheckList preenchido:</h2>
		<h4>Funcionário: $nomeFuncionario</h4>		
		<h4>Cargo: $nomeCargo </h4>		
		<h4>Unidade:$unidade</h4>
		
		<h6>Email gerado automaticamente por favor não responder.</h6>

		</body>
</html>";



//DESTINO AUTOMATICO ESCOLHIDO PELO ASSUNTO
$destino = null;
$padrao = "ticisbaf@gmail.com";

if($unidade == "BELFORD ROXO"){
	//$destino = 'trocadeplantaosamubaixada@gmail.com';	
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "DUQUE DE CAXIAS" ){
	//$destino = 'salvandovida192@gmail.com';
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "ITAGUAI"){
	//$destino = 'coord.samu192@itaguai.rj.gov.br';	
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "JAPERI"){
	//$destino = 'elensouzah@gmail.com';	
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "MAGE"){
	//$destino = 'samumagecoordenacao@gmail.com';	
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "MESQUITA"){
	//$destino = 'marcelocostateixeira@yahoo.com';
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "NILOPOLIS"){
	$destino = 'basesamunilopolis@gmail.com';
	//$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "NOVA IGUACU"){
	//$destino = 'milenacatharina@gmail.com';	
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "PARACAMBI"){
	//$destino = 'samuparacambi@gmail.com';
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "QUEIMADOS"){
	$destino = 'queimadosbasesamu@gmail.com';
	//$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "SAO JOAO DE MERITI"){
	//$destino = 'juliana.o.dias@hotmail.com';
	$destino = 'ticisbaf@gmail.com';
	
}else if($unidade == "SEROPEDICA"){
	//$destino = 'marcio7275santos@gmail.com';
	$destino = 'ticisbaf@gmail.com';	

}else{
	$destino = 'ticisbaf@gmail.com';
}



$reply = "coord.enf.cisbaf@gmail.com";
$replyName = "P/: ";


$someDate = str_replace("/","-",date('d/m/Y'));
$file = ".\\unidades\\$unidade\\$unidade-$someDate.pdf";
$nameFile = "$unidade-$someDate.pdf";

try{

$controle =  email($destino, $unidade,"CheckList", $corpo_email, $file, $nameFile, $reply, $replyName);

}catch(Exception $err){
	echo "Lamento, ocorreu algum erro, tente novamente mais tarde.";
}
	

	}
}


?>