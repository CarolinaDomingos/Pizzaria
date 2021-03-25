<head>
	<link rel="stylesheet" type="text/css" href="./fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
	
</head>
<body>
<main id="main">
<section class="login">
<section>
	<div class="linha">
		<div class="col-50">
			<i class="fa fa-user" id="bt-log"></i>
		</div>
		<div class="col-50">
			<i class="fas fa-sign-in-alt" id="bt-reg"></i>
		</div>
	</div>
</section>

<section id="painel_login">
	<form method="post">
		<h2>Login</h2>
		<label>Email:</label>
		<input class="entrar" type="email" placeholder="Email:" name="log_email">
		<label>Senha:</label>
		<input class="entrar" type="password" placeholder="Senha:" name="log_senha">
		<!-- <input type="submit" name="registar" value="Entrar"> -->
		<button class="submeter" type="submit" name="login" value="Entrar">Login</button>
	</form>
</section>

<section id="painel_registo">
	<form method="post">
		<h2>Registar</h2>
		<label>Email:</label>
		<input class="entrar" type="email" placeholder="Email:" name="client_email">
		<label>Senha:</label>
		<input class="entrar" type="password" placeholder="Senha:" name="client_senha">
		<label>Nome:</label>
		<input class="entrar" type="text" placeholder="Nome:" name="client_nome">
		<label>Sobrenome:</label>
		<input class="entrar" type="text" placeholder="Sobrenome" name="client_sobrenome">
		<label>Morada:</label><br>
		<input type="text" placeholder="Morada:" name="client_morada"><br>
		<label>Distrito</label>
		<select class="morada" name="client_distrito" id="reg_distrito">
		
		<?php
		include 'connections/conn.php';
		$distritos = mysqli_query($conn,"SELECT * FROM distritos");
		while ($distrito = mysqli_fetch_array($distritos))
			{
				echo '<option value="'.$distrito["distritosid"].'">'.$distrito["distrito"]
					.'</option>';
			}
		mysqli_close($conn);//fechar a ligação com a bd
		?>

		</select>
		<label id="label_concelho">Concelho</label>
		<select class="morada" name="client_concelho" id="reg_concelho">
		</select>
		<label id="label_freguesia">Freguesia</label>
		<select class="morada" name="client_freguesia" id="reg_freguesia"></select>
		<label>Código Postal</label>
		<input class="login" type="text" name="client_cod_postal" placeholder="1010-100"><br>
		<label>Telef:</label>
		<input class="entrar" type="text" placeholder="Telef:" name="client_telef">
		<label>NIF:</label>
		<input class="entrar" type="text" placeholder="NIF:" name="client_nif">
		<button class="submeter" type="submit" name="novo_registo" value="Registar">Registar</button>
	</form>
</section>
<!--Chamada de scripts a utilizar com esta página-->
<script>
	//Iniciar JQuery
	$(document).ready(function()
	{
		//Ações a realizar aqui
		//$("section").hide();
		//$(".col-50").hide();
		//$("#painel_registo").hide();
		$("#bt-log").click(function()
		{ //detetar o click bo elemento e despoletar um acontecimento
			$("#painel_registo").hide();
			$("#painel_login").show();
		});

		$("#bt-reg").click(function()
		{ //detetar o click bo elemento e despoletar um acontecimento
			//$("#painel_login").hide();
			//$("#painel_registo").show();
			$("#painel_login").slideUp();
			$("#painel_registo").slideDown();
			/*$("#painel_registo").animate(
			{
				left:'100px', 
				opacity: '0.5', height: '250px', width: '250px'
			});*/
			$("client_concelho").hide();
			$("reg_freguesia").hide();
			$("label_concelho").hide();
			$("label_freguesia").hide();

			$(".teste").html("Preencha o Formulário sff.");
		});

		//Detetar Alterações a Distritos
		$("#reg_distrito").change(function()
		{
			//Guardar o valor do distrito
			var a= $("#reg_distrito").val();
			// Mostrar proxima caixa de seleção
			//Auxiliar de teste
			//alert('Variavel '+a);
			$("reg_concelho").show();
			$("label_concelho").show();
			//Ajax para chamar a função / ficheiro PHP
			$.post('lista_concelhos.php', {distrito: a}, function(data)
			{
				//alert('Ajax Completo: '+data);
				//Escrever o output da lista_concelhos para a caixa de concelhos
				$("#reg_concelho").html(data);
			});
		});
		$("#reg_concelho").change(function()
		{
			var a= $("#reg_concelho").val();
			$("reg_freguesia").show();
			$("label_freguesia").show();
			$.post('lista_freguesias.php', {concelho: a}, function(data)
			{
				$("#reg_freguesia").html(data);
			});
		});
	});
</script>
<?php
if (isset($_POST["login"])) {
	//ligar a BD
	include 'connections/conn.php';
	//Filtrar os campos submetidos, para evitar SQL Injections
	$log_email = mysqli_real_escape_string($conn, $_POST["log_email"]);
	$log_senha = mysqli_real_escape_string($conn, $_POST["log_senha"]);
	//codificar valor de senha em base 64
	$log_senha = base64_encode($log_senha);

	//$log_senha = base64_decode($log_senha);
	//Perguntar a BD se o user existe
	$logar = mysqli_query($conn, "SELECT * FROM logins WHERE log_email = '$log_email' AND log_senha = '$log_senha'");
	//Guardar a resposta da BD em Array
	$login = mysqli_fetch_array($logar);
	//Ver se há dados na resposta (login valido)
	//if($login["log_senha"] != ''){ fazer qq coisa}
	if (!$login) {
		echo 'Utilizador ou Senha errados. Tente novamente.';
	} else {
		//Existiu resposta por parte da BD (temos User)
		//Saber que tipo de user temos
		if ($login["log_type"] == '0') {
			//guardar o valor de log_type em variavel de sessão
			$_SESSION["log_type"] = $login["log_type"];
			//Temos um Admin
			echo '<meta http-equiv="refresh" content="0;url=painel_admin.php">';
		} else {
			//temos um utilizador
			echo '<meta http-equiv="refresh" content="0;url=cliente.php">';
		}
	}
	if($login["log_type"] != '0')
	{
		mysqli_query($conn, "INSERT INTO logins VALUES ('$_POST[log_id]'");
		//Saber O ID GERADO NESTA INSERÇÃO
		$log_id = mysqli_insert_id($conn);
		mysqli_query($conn, "INSERT INTO logins VALUES ('$_POST[log_id]', '$_POST[log_email]','$_POST[log_senha])','$_POST[log_type])'");
		echo '<meta http-equiv="refresh" content="0;url=cliente.php">';
	}
	
}
?>
</div>
    		<div class="col-lg-4"></div>
    	</div>


	</div>
<?php 
if (isset($_POST["novo_registo"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "INSERT INTO cliente VALUES ('$_POST[client_id]'");
	//Saber O ID GERADO NESTA INSERÇÃO
	$client_id = mysqli_insert_id($conn);
	mysqli_query($conn, "INSERT INTO cliente VALUES ('$_POST[client_id]', '$_POST[client_email]','$_POST[client_senha]','$_POST[client_nome]','$_POST[client_sobrenome]','$_POST[client_morada]','$_POST[client_distrito]', '$_POST[client_concelho]','$_POST[client_freguesia]','$_POST[client_cod_postal]','$_POST[client_telef]','$_POST[client_nif]')");
	echo '<meta http-equiv="refresh" content="0;url=cliente.php">';
}

	
?>
</section>
</main><!-- End #main -->



  <div id="preloader"></div>
  <a href="#" class="back-to-top"></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>