<?php
//INCLUINDO O COMPOSER PARA IMPORTAR TODAS AS CLASSES NECESSÁRIAS
require_once '..\vendor\autoload.php';
include_once("Email.php");

//SETANDO A HORA DE ACORDO COM BRASILIA SAO PAULO
date_default_timezone_set('America/Sao_Paulo');



 class GeraPDF{
		

public function gerarPDF(){
		
if (isset($_POST["nomeFuncionario"]) && isset($_POST["unidade"]) && isset($_POST["nomePlaca"]) && isset($_POST["viatura"])
		&& isset($_POST["totalAcessorios"])
		&& isset($_POST["totalEquipamentos"])
		&& isset($_POST["totalMateriais"])
		&& isset($_POST["totalMedAlta"])
		&& isset($_POST["totalMedicamento"])){

		$nomeFuncionario = filter_input(INPUT_POST,"nomeFuncionario",FILTER_SANITIZE_STRING);
		$nomePlaca = filter_input(INPUT_POST,"nomePlaca",FILTER_SANITIZE_STRING);
		$nomeKM = filter_input(INPUT_POST,"nomeKM",FILTER_SANITIZE_STRING);
		$nomeCargo = filter_input(INPUT_POST,"nomeCargo",FILTER_SANITIZE_STRING);
		$unidade = filter_input(INPUT_POST,"unidade",FILTER_SANITIZE_STRING);
		$viatura = filter_input(INPUT_POST,"viatura",FILTER_SANITIZE_STRING);
		$qtdA = filter_var_array($_POST["totalAcessorios"],FILTER_SANITIZE_STRING);
		$qtdE = filter_var_array($_POST["totalEquipamentos"],FILTER_SANITIZE_STRING);
		$qtdM = filter_var_array($_POST["totalMateriais"],FILTER_SANITIZE_STRING);
		$qtdAlta =  filter_var_array($_POST["totalMedAlta"],FILTER_SANITIZE_STRING);  
		$qtdMedic = filter_var_array($_POST["totalMedicamento"],FILTER_SANITIZE_STRING);
		

	}else{			

		return "Os dados inseridos estão incorretos!";
	}
	
	
	$dateAndHour = date('d/m/Y H:i:s', time());
	$someDate = str_replace("/","-",date('d/m/Y'));
	
	$style = "<style>
	table,td,tr{ border: 1px solid black; margin:auto; width:300px; margin-top:20px;font-size:13px; padding: 5px;}
	th{margin:auto;text-align:center;font-size:30px;}	
	</style> ";
	
	
		
		try{	
			
		
		$arquivo = "$unidade-$someDate.pdf";
		$mpdf = new \Mpdf\Mpdf(); 
		$mpdf->WriteHTML($style);	
		
		
	
	//#####################################################################################		
		
		$mpdf->WriteHTML("<img style='margin-bottom:50px' src='./assets/images/cisbaf_suporte.jpg' alt='Cisbaf - Consorcio Intermunicipal de Saude da Baixada fluminense'>");
		$mpdf->WriteHTML("Nome do Funcionário:".$nomeFuncionario);	
		$mpdf->WriteHTML("Função: ". $nomeCargo);	
		$mpdf->WriteHTML("Unidade: ". $unidade);	
		$mpdf->WriteHTML("Viatura: ". $viatura);	
		$mpdf->WriteHTML("Placa da viatura: ". $nomePlaca);
		$mpdf->WriteHTML("Kilometragem da viatura: ". $nomeKM);		
		$mpdf->WriteHTML("<br><br><br>");
		
		$mpdf->WriteHTML("<p style='margin:auto;text-align:center;'>Checklist do dia: $dateAndHour</p>");
		$mpdf->WriteHTML("<table>");
		
		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<th>Acessórios</th>");
		$mpdf->WriteHTML("</tr>");
		
		
		foreach($qtdA as $i => $value){
			$nome = explode("=",$value);
			$mpdf->WriteHTML("<tr>");
			$mpdf->WriteHTML("<td>$nome[0]</td>");
			$mpdf->WriteHTML("<td>Total: $nome[1]</td>");
			$mpdf->WriteHTML("</tr>");
		}		
			
		
		
					
	//#####################################################################################	
		
				
		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<th>Equipamentos</th>");
		$mpdf->WriteHTML("</tr>");
		
		foreach($qtdE as $i => $value){	
			$nome = explode("=",$value);
			$mpdf->WriteHTML("<tr>");
			$mpdf->WriteHTML("<td>$nome[0]</td>");
			$mpdf->WriteHTML("<td>Total: $nome[1]</td>");
			$mpdf->WriteHTML("</tr>");

			
		}		
	
		
		
		
	//#####################################################################################	
		
		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<th>Materiais</th>");
		$mpdf->WriteHTML("</tr>");
		
		foreach($qtdM as $i => $value){		
			$nome = explode("=",$value);
			$mpdf->WriteHTML("<tr>");
			$mpdf->WriteHTML("<td>$nome[0]</td>");
			$mpdf->WriteHTML("<td>Total: $nome[1]</td>");
			$mpdf->WriteHTML("</tr>");
		}		
		
	
		
	//#####################################################################################		
		
		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<th>Medicação Alta</th>");
		$mpdf->WriteHTML("</tr>");

		foreach($qtdAlta as $i => $value){		
			$nome = explode("=",$value);
			$mpdf->WriteHTML("<tr>");
			$mpdf->WriteHTML("<td>$nome[0]</td>");
			$mpdf->WriteHTML("<td>Total: $nome[1]</td>");
			$mpdf->WriteHTML("</tr>");

						
		}		
		
		
	
		
	//#####################################################################################			
		
		$mpdf->WriteHTML("<tr>");
		$mpdf->WriteHTML("<th>Medicamentos</th>");
		$mpdf->WriteHTML("</tr>");
		
		foreach($qtdMedic as $i => $value){	
			$nome = explode("=",$value);
			$mpdf->WriteHTML("<tr>");
			$mpdf->WriteHTML("<td>$nome[0]</td>");
			$mpdf->WriteHTML("<td>Total: $nome[1]</td>");
			$mpdf->WriteHTML("</tr>");
		}		
		
	
		
	//#####################################################################################		
		
		
		$mpdf->WriteHTML("</table>");	
		
		$mpdf->Output(".\\unidades\\$unidade\\$arquivo", \Mpdf\Output\Destination::FILE);
		
	
		$email = new Email;
		$email->gerarEmail();

		return "1";
		
		}catch(Exception $err){
			return "Algo de errado aconteceu, tente novamente mais tarde";
		}
		
				
		
		
	} 

} 



?>
  