function exibeAcessorios() {

	var acessorios = document.querySelector('div[name=acessorios]');

	if (acessorios.style.display == "none") {
		hideAll()
		acessorios.style.display = "inline";
	} else {
		acessorios.style.display = "none";
	}
}

function exibeEquipamentos() {
		
	
	var equipamentos = document.querySelector("div[name=equipamentos]");

	if (equipamentos.style.display == "none") {
		hideAll()
		equipamentos.style.display = "inline";
	} else {
		equipamentos.style.display = "none";
	}
}

function exibeMateriais() {
		

	var materiais = document.querySelector('div[name=materiais]');

	if (materiais.style.display == "none") {
		hideAll()
		materiais.style.display = "inline";
	} else {
		materiais.style.display = "none";
	}
}

function exibeMedicamentosAltos() {
	
	var materiais = document.querySelector('div[name=medicamentoalto]');

	if (materiais.style.display == "none") {
		hideAll()
		materiais.style.display = "inline";
	} else {
		materiais.style.display = "none";
	}
}

function exibeMedicamentos() {
		
	var materiais = document.querySelector('div[name=medicacao]');

	if (materiais.style.display == "none") {
		hideAll()
		materiais.style.display = "inline";
	} else {
		materiais.style.display = "none";
	}
}



function hideAll() {

	var acessorios = document.querySelector('div[name=acessorios]');
	var equipamentos = document.querySelector('div[name=equipamentos]');
	var materiais = document.querySelector('div[name=materiais]');
	var medicamentoalto = document.querySelector('div[name=medicamentoalto]');
	var medicacao = document.querySelector('div[name=medicacao]');
	
	acessorios.style.display = "none";
	equipamentos.style.display = "none";
	materiais.style.display = "none";
	medicacao.style.display = "none";

}

addEventListener("keypress",checkTable);

function checkTable(event){
	setTimeout(()=>{
		checkTables();
	},0200)	
}

function checkTables(){
	
	var listAcessorio = document.querySelectorAll("input[id='acessorios[]']");
	var listEquipamentos = document.querySelectorAll("input[id='equipamentos[]']");
	var listMateriais = document.querySelectorAll("input[id='materiais[]']");
	var listMedAlta = document.querySelectorAll("input[id='medAlta[]']");
	var listMedicamento = document.querySelectorAll("input[id='medicamento[]']");
	
	
	for(var i of listAcessorio){
		if(i.value == "" || i.value == null){			
			document.getElementsByClassName("btnc")[0].style.backgroundColor = "red";
			break;
		}else{
			document.getElementsByClassName("btnc")[0].style.backgroundColor = "#00FF00";
		}
	}
	
	for(var i of listEquipamentos){
		if(i.value == "" || i.value == null){			
			document.getElementsByClassName("btnc")[1].style.backgroundColor = "red";
			break;
		}else{
			document.getElementsByClassName("btnc")[1].style.backgroundColor = "#00FF00";
		}
	}
	
	for(var i of listMateriais){
		if(i.value == "" || i.value == null){			
			document.getElementsByClassName("btnc")[2].style.backgroundColor = "red";
			break;
		}else{
			document.getElementsByClassName("btnc")[2].style.backgroundColor = "#00FF00";
		}
	}
	
	
	for(var i of listMedicamento){		
		if(i.value == "" || i.value == null){			
			document.getElementsByClassName("btnc")[3].style.backgroundColor = "red";
			break;
		}else{
			document.getElementsByClassName("btnc")[3].style.backgroundColor = "#00FF00";
		}
	}
	
}

function sendForm(){

	
	checkTables();

	var form = document.getElementById("form");
	var formData = new FormData(form);
	form.addEventListener("submit", checkSend);
	
	function checkSend(event){
		for(var i of formData)
		{
			if(i[1] == "" || i[1] == null){
				event.preventDefault();
			}		
		}	
	}
	
}


function send(event) {


	event.preventDefault();

	var container = document.getElementById("container");
	container.style.display = 'none';
	var caixa = document.createElement("div");
	caixa.style = "margin:auto;text-align:center;";
	var img = document.createElement("img")
	var text = document.createElement("p");
	text.innerText = "Aguarde um minuto por favor, estamos enviando seu checklist...";
	text.style = "font-size:20px;text-align:center;margin-top:200px;"
	img.style = "margin:auto;";
	img.src = "assets\\images\\loading-buffering.gif";

	document.body.appendChild(caixa);
	caixa.appendChild(text);
	caixa.appendChild(img);


	
	(function () {
		var nomeAcessorios = document.querySelectorAll("td[id='nomeAcessorio']");
		var listAcessorio = document.querySelectorAll("input[id='acessorios[]']");
		var a = 0;
		var b = 0;

		for (var i of nomeAcessorios) {
			document.querySelectorAll("input[id='acessorios']")[a++].value = i.innerHTML + '=' + listAcessorio[b++].value;

		}

	})();



	(function () {
		var nomeEquipamentos = document.querySelectorAll("td[id='nomeEquipamentos']");
		var listEquipamentos = document.querySelectorAll("input[id='equipamentos[]']");
		var a = 0;
		var b = 0;

		for (var i of nomeEquipamentos) {
			document.querySelectorAll("input[id='equipamentos']")[a++].value = i.innerHTML + '=' + listEquipamentos[b++].value;

		}

	})();




	(function () {
		var nomeMateriais = document.querySelectorAll("td[id='nomeMateriais']");
		var listMateriais = document.querySelectorAll("input[id='materiais[]']");
		var a = 0;
		var b = 0;

		for (var i of nomeMateriais) {
			document.querySelectorAll("input[id='materiais']")[a++].value = i.innerHTML + '=' + listMateriais[b++].value;

		}

	})();

	
	(function () {
		var nomeMedicamento = document.querySelectorAll("td[id='nomeMedicamento']");
		var listMedicamento = document.querySelectorAll("input[id='medicamento[]']");
		var a = 0;
		var b = 0;


		for (var i of nomeMedicamento) {
			document.querySelectorAll("input[id='medicamentos']")[a++].value = i.innerHTML + '=' + listMedicamento[b++].value;

		}

	})();


	form.submit();

}