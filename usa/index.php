<?php

session_start();

header("Cache-Control: no-cache, must-revalidate");

if($_SESSION["acess"] != "usa"){
	header("Location:/");
}

include_once("SelectItems.php");

use SelectItems\SelectItems\SelectItems;

SelectItems::selectAllAcessorios();


setlocale(LC_ALL, 'pt_BR.utf8');

//SETANDO A HORA DE ACORDO COM BRASILIA SAO PAULO
date_default_timezone_set('America/Sao_Paulo');

$data = date('d/m/Y');

include_once("./conex.php");
			
// SQL para selecionar os registro no Banco de Dados
$query = "SELECT datac FROM checklist ORDER BY id DESC";
	
//Selecionar os registros
	$prepare = $conn->prepare($query);
	$prepare->execute();
	$result = $prepare->fetch(PDO::FETCH_ASSOC);   
	


	

?>

<!DOCTYPE HTML>
<HTML lang='pt-br'>

<HEAD>
<meta name="Cache-Control" content="no-cache">
<meta charset='utf-8'/>
<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
<title>Insumos Cisbaf</title>

<link rel="stylesheet" href="estilo.css">
<script src="srx.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>

</HEAD>

<BODY>

<main>
        <div class="container" id="container">
            <div class="caixa1">
				
                <div class="div1">
					
				<a onclick="AtivarDesativarFS()"><img id="btnind" src="./img/ful2.png" style="width:50px"></a>
                <h1>Checklist Diário USA</h1>
                <h2 id="h1x">07/07/2022</h2>
				<?php
				if ($result AND $result == 'ok'){
					foreach($result as $key){
						$key;
						if ($key == $data){
							echo"<span style='color:green;'>O checklist de hoje ja foi preenchido!</span>";
						}
						else{
							echo"<span style='color:red;'>O checklist de hoje ainda não foi preenchido!</span>";
						}
					}
				}
				?>
                </div>
                <span class="Insumos">Insumos</span>
                <div class="div2">
                    <div class="quadrado">
                        <div class="qd1"><input class="btnc" required=required type="button" value="ACESSÓRIOS"onClick="exibeAcessorios()"></div>
                        <div class="qd1"><input class="btnc" required=required type="button" value="EQUIPAMENTOS" onClick="exibeEquipamentos()"></div>
                        <div class="qd1"><input class="btnc" required=required type="button" value="MATERIAIS" onClick="exibeMateriais()"></div>
                        <div class="qd1"><input class="btnc" required=required type="button" value="MED.ALTOS" onClick="exibeMedicamentosAltos()"></div>
                        <div class="qd1"><input class="btnc" required=required type="button" value="MEDICAMENTOS" onClick="exibeMedicamentos()"></div>
                         

                    </div>

                </div>
                <div class="div3">
                    <div class="divscr">
                    <form id="form" method="post" action="dados.php" ectype='multipart/form-data'>
                   <!-- ACESSÓRIOS -->
						<div name='acessorios' style='display:hidden;'>
						<h3>ACESSÓRIOS</h3>
						<table id="example" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;table-layout:fixed">
							<tr>
								<th>NOME</th>		
								<th>CARGA</th>
								<th>QUANTIDADE DIÁRIA</th>
							</tr>	

						<?php 

						$acessorios = SelectItems::selectAllAcessorios();

						foreach($acessorios as $value => $key){
							echo "
							<tr>
								<td id='nomeAcessorio'>$key[2]</td>
								<td name='nomeCarga'>$key[3]</td>
								<td><input id='acessorios[]' name='acessorios[]'  class='inputprincipal' required=required   type='text' multiple='multiple'></td>
																			
							</tr>	

							";


							echo "<input id='acessorios' name='totalAcessorios[]' style='display:none' type='text'>";

						}
						
						?>

							
							</table>

							</div>



							<!-- EQUIPAMENTOS -->	
						<div name='equipamentos' style='display:none;'>
						<h3>EQUIPAMENTOS</h3>
						<table id="example" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;table-layout:fixed">
							<tr>
								<th>NOME</th>		
								<th>CARGA</th>
								<th>QUANTIDADE DIÁRIA</th>
							</tr>	

						<?php 

						$equipamentos = SelectItems::selectAllEquipamentos();

						foreach($equipamentos as $value => $key){
							echo "
							<tr>
								<td id='nomeEquipamentos'>$key[2]</td>
								<td>$key[3]</td>
								<td><input id='equipamentos[]' name='equipamentos[]' required=required   type='text' multiple='multiple'></td>
											
							</tr>	

							";

							echo "<input id='equipamentos' name='totalEquipamentos[]' style='display:none' type='text'>";

						}

						

						?>

						</table>
						</div>






							<!-- MATERIAIS -->	
						<div name='materiais' style='display:none;'>
						<h3>MATERIAIS</h3>
						<table id="example" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;table-layout:fixed">
							<tr>
								<th>NOME</th>		
								<th>CARGA</th>
								<th>QUANTIDADE DIÁRIA</th>
							</tr>	

						<?php 

						$materiais = SelectItems::selectAllMateriais();

						foreach($materiais as $value => $key){	
							echo "
							<tr>
								<td id='nomeMateriais'>$key[2]</td>
								<td>$key[3]</td>
								<td><input id='materiais[]' name='materiais[]' required=required   type='text' multiple='multiple'></td>
											
							</tr>	

							";


							echo "<input id='materiais' name='totalMateriais[]' style='display:none' type='text'>";

						}

						
						?>
							
							</table>

							</div>



							<!-- MED. ALTA VIGILÂNCIA -->	
						<div name='medicamentoalto' style='display:none;'>
						<h3>MED ALTA VIGILANCIA</h3>
						<table id="example" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;table-layout:fixed">	
							<tr>
								<th>NOME</th>		
								<th>CARGA</th>
								<th>QUANTIDADE DIÁRIA</th>
							</tr>	

						<?php 

						$medicamentoalto = SelectItems::selectAllMedicamentosAltos();

						foreach($medicamentoalto as $value => $key){	
							echo "
							<tr>
								<td id='medAlta'>$key[2]</td>
								<td>$key[3]</td>
								<td><input id='medAlta[]' name='medAlta[]' required=required   type='text' multiple='multiple'></td>
											
							</tr>	

							";

							echo "<input id='medicacaoAlta' name='totalMedAlta[]' style='display:none' type='text'>";


						}

						

						?>	
							</table>

							</div>




							<!-- MEDICACAO -->	
						<div name='medicacao' style='display:none;'>
						<h3>MEDICAMENTOS</h3>
						<table id="example" class="display dataTable dtr-inline" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%;table-layout:fixed">
							<tr>
								<th>NOME</th>		
								<th>CARGA</th>
								<th>QUANTIDADE DIÁRIA</th>
							</tr>	

						<?php 

						$medicamentos = SelectItems::selectAllMedicamentos();

						foreach($medicamentos as $value => $key){	
							echo "
							<tr>
								<td id='medicamento'>$key[2]</td>
								<td>$key[3]</td>
								<td><input id='medicamento[]' name='medicamento[]' required=required   type='text' multiple='multiple'></td>
											
							</tr>	

							";

							echo "<input id='medicamentos' name='totalMedicamento[]' style='display:none' type='text'>";

						}
							
						?>	
							</table>
							</div>

                    </div>
                </div>
                <div class="div4">
					<div class="boxnome">
					<span>Dados do preenchente</span>
					</div>
					<div class="boxinput">
						<div class="dsinput">
							<span>Nome Completo</span>
							<td><input required=required name='nomeFuncionario' type='text'></td>
						</div>
						<div class="dsinput">
							<span>Cargo:</span>
							<td><input required=required name='nomeCargo' type='text'></td>
						</div>
						<div class="dsinput">
							<span>Unidade:</span>
							<td><select id="estados" required=required name="unidade"><option disabled selected value>Escolha...</option></select></td>
						</div>
						<div class="dsinput">
						<span>VTR:</span>
							<td><select id="cidade" required=required name="viatura"><option disabled selected value>Escolha...</option></select></td>
						</div>
						<div class="dsinput">
						<span>KM:</span>
							<td><input required=required name='nomeKM' type='text'></td>
						</div>
						<div class="dsinput">
						<span>Placa:</span>
							<td><input required=required name='nomePlaca' type='text' multiple='multiple'></td>
						</div>
						<div class="dsinput">
						<span style="visibility: hidden;">.</span>					
						<input class="inpthover" type='submit' onclick='sendForm()'>
						</div>
					</div>

					</form>				
				</div>
            </div>
            <div class="caixa2">
                <div class="txtmn">
                <span>Baixar Check-Lists</span>
				<select id="baixarestado" name="baixarestado">
				<option value="Nilopolis">Nilopolis</option>
				<option value="Queimados">Queimados</option>
				</select>
                </div>
				<div class="flexminibox">

				<?php
					try
					{    
						$pesq = "SELECT * FROM checklist ORDER BY id ASC";
						
						//Selecionar os registros
						  $preparar = $conn->prepare($pesq);
						  $preparar->execute(); 
					
							if(($preparar)){
								while($rows = $preparar->fetch(PDO::FETCH_ASSOC)){
									$nvrows = $rows['datac'];
									echo "                <div class='box'>
									<span>$nvrows</span>
									</div>";
									
								}
							}
				
						}
						catch (PDOException $e)
						{
							var_dump($e);
						}
				?>
				</div>

        </div>

    </main>
</BODY>
<script>


	var selectEstados = document.getElementById("estados");
	var selectCidades = document.getElementById("cidade");
	var cidades = {
	"BELFORD ROXO": ["USA 1"],
	"DUQUE DE CAXIAS": ["USA 1","USA 2"],
	"ITAGUAI": ["USA 1"],
	"JAPERI": ["USA 1"],
	"MAGE": ["USA 1","USA 2"],
	"MESQUITA": ["USA 1"],
	"NILOPOLIS": ["USA 1", "USA 2"],
	"NOVA IGUACU": ["USA 1", "USA 2"],
	"PARACAMBI": ["NENHUMA"],
	"QUEIMADOS": ["USA 3"],
	"SAO JOAO DE MERITI": ["USA 1"],
	"SEROPEDICA": ["NENHUMA"],

	};

	function adicionarOptions(select, options, chosen) {
	select.innerHTML = options.reduce((html, option) => {
		return html + `<option value="${option}">${option}</option>`;
	}, '<option disabled selected value>Escolha...</option>')
	}

	var estados = Object.keys(cidades);
	const estadoInicial = estados[0];
	adicionarOptions(selectEstados, estados, estadoInicial);
	selectEstados.addEventListener('change', function() {
	adicionarOptions(selectCidades, cidades[this.value]);
	});

        data = new Date()
	var ano = data.getFullYear();
	var mes = data.getMonth()+1;
	var dia = data.getDate();
	var hora = data.getHours();
	var minuto = data.getMinutes();
	var segundo = data.getSeconds();

	if(dia.toString().length == 1) dia = '0'+dia;
	if(mes.toString().length == 1) mes = '0'+mes;
	if(ano.toString().length == 1) ano = '0'+ano;

	if(hora.toString().length == 1) hora = '0'+hora;
	if(minuto.toString().length == 1) minuto = '0'+minuto;
	if(segundo.toString().length == 1) segundo = '0'+segundo;

	


	var element = document.getElementById('h1x');
	var datacompleta = ''+dia+'/'+mes+'/'+ano

	element.innerHTML = ''+datacompleta

	console.log(datacompleta);


	var form = document.getElementById("form");
	form.onsubmit = send;

	
        </script>
		<script>

//Criando uma variável global para nos dizer em qual estado a tela atual se encontra.
isFullScreen = true;
var elem = document.documentElement;
function AtivarDesativarFS() {
    //Se o estado atual for "FullScreen", desativá-lo.
    //Note que para as verificações é feito uma validação para todos os possíveis navegadores, facilitando a sua vida.
      if (document.exitFullscreen) {
      document.exitFullscreen();
      isFullScreen = false;
    } else if (document.mozCancelFullScreen) { /* Firefox */
      document.mozCancelFullScreen();
      isFullScreen = false;
    } else if (document.webkitExitFullscreen) { /* Chrome, Safari & Opera */
      document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) { /* IE/Edge */
      document.msExitFullscreen();
      isFullScreen = false;
    }


  if (elem.requestFullscreen) {
     elem.requestFullscreen();
     isFullScreen = true;
  } else if (elem.mozRequestFullScreen) { /* Firefox */
     elem.mozRequestFullScreen();
      isFullScreen = true;
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
    elem.webkitRequestFullscreen();
     isFullScreen = true;
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
     isFullScreen = true;
  }

}
</script>

</HTML>
