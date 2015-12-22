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
	<h1>Chaves de Acesso</h1>
</center>
<form method="post">
	<div class="containter">
		<div class="row" style="margin-top: 30px">
			<div class="col-lg-2"></div>
			<div class="col-lg-2">
				<a href="index.php" class="btn btn-default btn-lg">Home</a>
			</div>
			<div class="col-lg-2"><a href="consulta-sintegra.php" class="btn btn-default btn-lg">Consultar CNPJ</a></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>
			<div class="col-lg-2"></div>

		</div>
		<div class="row" style="margin-top: 30px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div id="return" name="return"></div>
			</div>
			<div class="col-lg-3"></div>
		</div>
		<div class="row" style="margin-top: 50px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="col-lg-4">
					<label>Informe seu email</label>
				</div>
				<div class="col-lg-8">
					<input type="email" id="email" name="email" class="form-control"
						required>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>

		<div class="row" style="margin-top: 30px">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<input type="submit" class="form-control" name="send"
					value="Gerar Chave">
			</div>
			<div class="col-lg-3"></div>
		</div>

	</div>
</form>
<script>
$("form").on('submit',function(e){
	$.ajax({
		type : "post",
		url : "genaccesskey.php",
		dataType : 'json',
		data : $("form").serialize(),			
		success : function(data) {
			console.log(data);
			if(data.success){
				$("#return").empty();
				$("#return").append(data.message);
			}else{
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