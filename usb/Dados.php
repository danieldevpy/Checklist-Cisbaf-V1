<?php
//include_once("InsertItems.php");
include_once("GeraPDF.php");

if(!empty($_POST) || $_POST != null){

//$InsertItems = new InsertItems();		
$geraPDF = new GeraPDF;
$pdf = $geraPDF->gerarPDF();

if($pdf == "1"){
	header("Location:sucesso.php");
}else{
	echo $pdf;
}



}else{
	echo "Ocorreu um erro, por favor tente novamente mais tarde.";
}



?>