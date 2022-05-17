<?php

include_once("./conexao.php");

//SETANDO OS CARACTERES PARA UTF-8
setlocale(LC_ALL, 'pt_BR.utf8');

//SETANDO A HORA DE ACORDO COM BRASILIA SAO PAULO
date_default_timezone_set('America/Sao_Paulo');


class InsertItems{
	function __construct() {
	if (isset($_POST["nomeFuncionario"]) && isset($_POST["unidade"]) && isset($_POST["nomePlaca"]) && isset($_POST["viatura"])
		&& isset($_POST["acessorios"]) && isset($_POST["equipamentos"]) && isset($_POST["materiais"])
		&& isset($_POST["medicamento"]) && isset($_POST["nomeCargo"]) 
		&& isset($_POST["nomeKM"])) {

		$nomeFuncionario = filter_input(INPUT_POST,"nomeFuncionario",FILTER_SANITIZE_STRING);
		$unidade = filter_input(INPUT_POST,"unidade",FILTER_SANITIZE_STRING);
		$viatura = filter_input(INPUT_POST,"viatura",FILTER_SANITIZE_STRING);
		$nomePlaca = filter_input(INPUT_POST,"nomePlaca",FILTER_SANITIZE_STRING);
		$nomeKM = filter_input(INPUT_POST,"nomeKM",FILTER_SANITIZE_STRING);
		$nomeCargo = filter_input(INPUT_POST,"nomeCargo",FILTER_SANITIZE_STRING);
		$qtdA = filter_var_array($_POST["acessorios"],FILTER_SANITIZE_STRING);
		$qtdE = filter_var_array($_POST["equipamentos"],FILTER_SANITIZE_STRING);
		$qtdM = filter_var_array($_POST["materiais"],FILTER_SANITIZE_STRING);
		$qtdAlta = filter_var_array($_POST["medAlta"],FILTER_SANITIZE_STRING);
		$qtdMedic = filter_var_array($_POST["medicamento"],FILTER_SANITIZE_STRING);
	

		$this ->insert($nomeFuncionario, $unidade, $nomePlaca, $nomeKM, $nomeCargo, $viatura, $qtdA, $qtdE, $qtdM, $qtdAlta, $qtdMedic);
		
				
	} else {
		echo "<center><h1>Some the data is empty!</h1></center>";
	
	}

}




private function insert($nF, $nU, $nP, $nK, $nC, $nV, $qtdA, $qtdE, $qtdM, $qtdAlta, $qtdMedic) {

	global $conn;

	$data = date('d/m/Y H:i:s', time());
	
		
	try {

		$insert = "INSERT INTO checklist(unidade,nomeFuncionario,viatura,nomePlaca,nomeKm,nomeCargo,acessorios,equipamentos,materiais,medAlta,medicacao,datac)".
"VALUES(:unidade,:nomeFuncionario,:viatura,:nomePlaca,:nomeKm,:nomeCargo,:acessorios,:equipamentos,:materiais,:medAlta,:medicacao,:data)";
		$prepare = $conn -> prepare($insert);
		$prepare -> bindParam(":unidade", $nU);
		$prepare -> bindParam(":nomeFuncionario", $nF);
		$prepare -> bindParam(":viatura", $nV);
		$prepare -> bindParam(":nomePlaca", $nP);
		$prepare -> bindParam(":nomeKm", $nK);
		$prepare -> bindParam(":nomeCargo", $nC);
		$prepare -> bindParam(":acessorios", $qtdA);
		$prepare -> bindParam(":equipamentos", $qtdE);
		$prepare -> bindParam(":materiais", $qtdM);
		$prepare -> bindParam(":medAlta", $qtdAlta);
		$prepare -> bindParam(":medicacao", $qtdMedic);		
		$prepare -> bindParam(":data", $data);


		if ($prepare->execute()) {
			return "Data entered successfully in DB!";
		} else {
			return "Error the insert data in DB! ";
		}

	} catch (Exception $e) {
		return $e;
	}
}



}




?>