<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="language" content="pt-br" />
<meta name="distribution" content="Global">
<meta name="rating" content="general" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<link
	href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
	rel="stylesheet"
	integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw=="
	crossorigin="anonymous">
<script
	src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
	integrity="sha256-KXn5puMvxCw+dAYznun+drMdG1IFl3agK0p/pqT9KAo= sha512-2e8qq0ETcfWRI4HJBzQiA3UoyFk6tbNyG+qSaIBZLyW9Xf3sWZHN/lxe9fTh1U45DpPf07yj94KsUHHWe4Yk1A=="
	crossorigin="anonymous"></script>
</head>
<center>
	<h1>Consulta dados CNPJ</h1>
</center>
<form method="post">
	<div class="containter">
		<div class="row" style="margin-top: 30px">
			<div class="col-lg-2"></div>
			<div class="col-lg-2">
				<a href="index.php" class="btn btn-default btn-lg">Home</a>
			</div>
			<div class="col-lg-2">
				<a href="cria-acesso.php" class="btn btn-default btn-lg">Chave de
					Acesso</a>
			</div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>

		</div>
		<div class="row" style="margin-top: 30px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div id="return" name="return"></div>				
				<p id="cnpj" name="cnpj"></p>
				<p id="ie" name="ie"></p>
				<p id="razao" name="razao"></p>
				<p id="logradouro" name="logradouro"></p>
				<p id="numero" name="numero"></p>
				<p id="complemento" name="complemento"></p>
				<p id="bairro" name="bairro"></p>
				<p id="cidade" name="cidade"></p>
				<p id="uf" name="uf"></p>
				<p id="cep" name="cep"></p>
				<p id="telefone" name="telefone"></p>
				<p id="atividade" name="atividade"></p>
				<p id="inicio" name="inicio"></p>
				<p id="situacao" name="situacao"></p>
				<p id="data_situacao" name="data_situacao"></p>
				<p id="regime" name="regime"></p>
				<p id="nfe" name="nfe"></p>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row" style="margin-top: 50px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="col-lg-4">
					<label>Informe o CNPJ</label>
				</div>
				<div class="col-lg-8">
					<input type="text" id="cnpj" name="cnpj" class="form-control"
						required>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row" style="margin-top: 20px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="col-lg-4">
					<label>Informe a chave de acesso</label>
				</div>
				<div class="col-lg-8">
					<input type="text" id="key" name="key" class="form-control"
						required>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>

		<div class="row" style="margin-top: 30px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<input type="submit" class="form-control" name="send"
					value="Consultar Dados">
			</div>
			<div class="col-lg-3"></div>
		</div>

	</div>
</form>
<script>
$("form").on('submit',function(e){
	$.ajax({
		type : "post",
		url : "getsintegrainformation.php",
		dataType : 'json',
		data : $("form").serialize(),			
		success : function(data) {
			console.log(data);
			if(data.success){
				$("#return").empty();
				$("#cnpj").empty();
				$("#cnpj").append('CNPJ: <b>' + data.cnpj + '</b>');
				$("#ie").empty();
				$("#ie").append('Inscrição Estadual: <b>' + data.ie + '</b>');
				$("#razao").empty();
				$("#razao").append('Razão Social: <b>' + data.razao_social + '</b>');
				$("#logradouro").empty();
				$("#logradouro").append('Logradouro: <b>' + data.logradouro + '</b>');
				$("#numero").empty();
				$("#numero").append('Número: <b>' + data.numero + '</b>');
				$("#complemento").empty();
				$("#complemento").append('Complemento: <b>' + data.complemento + '</b>');
				$("#bairro").empty();
				$("#bairro").append('Bairro: <b>' + data.bairro + '</b>');
				$("#cidade").empty();
				$("#cidade").append('Município: <b>' + data.municipio + '</b>');
				$("#uf").empty();
				$("#uf").append('UF: <b>' + data.estado + '</b>');
				$("#cep").empty();
				$("#cep").append('CEP: <b>' + data.cep + '</b>');
				$("#telefone").empty();
				$("#telefone").append('Telefone: <b>' + data.telefone + '</b>');
				$("#atividade").empty();
				$("#atividade").append('Atividade Econômica: <b>' + data.atividade + '</b>');
				$("#inicio").empty();
				$("#inicio").append('Data de Início de Atividade: <b>' + data.inicio + '</b>');
				$("#situacao").empty();
				$("#situacao").append('Situação Cadastral Vigente: <b>' + data.situacao + '</b>');
				$("#data_situacao").empty();
				$("#data_situacao").append('Data desta Situação Cadastral: <b>' + data.data_situacao + '</b>');
				$("#regime").empty();
				$("#regime").append('Regime de Apuração: <b>' + data.regime + '</b>');
				$("#nfe").empty();
				$("#nfe").append('Emitente de NFe desde: <b>' + data.nfe + '</b>');
				
				
				
			}else{
				$("#cnpj").empty();
				$("#ie").empty();
				$("#razao").empty();
				$("#logradouro").empty();
				$("#numero").empty();
				$("#complemento").empty();
				$("#bairro").empty();
				$("#cidade").empty();
				$("#uf").empty();
				$("#cep").empty();
				$("#telefone").empty();
				$("#atividade").empty();
				$("#inicio").empty();
				$("#situacao").empty();
				$("#data_situacao").empty();
				$("#regime").empty();
				$("#nfe").empty();
				$("#return").empty();
				$("#return").append(data.message);
			}
							
		}		
	});
	e.preventDefault();
	return false;
});
</script>
</html>