<header>
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.css">
	<link rel="stylesheet" type="text/css" href="./css/estilos.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>

</header>

<body>
        <?php
            include 'header.php'
        ?>
    <main id="main">

    <section id="client_data">

	<?php

	include 'connections/conn.php';
	$cliente = mysqli_query($conn, "SELECT * FROM cliente");
	while ($utilizador = mysqli_fetch_array($cliente))
	{
	echo'
	<form method="post" class="client_form">
		<h4 class="client_title">Edição de dados:</h4>
		<label>Email:</label>
		<input class="entrar" type="email" value="'.$utilizador["client_email"].'" name="client_email">
		<label>Senha:</label>
		<input class="entrar" type="password" value="'.$utilizador["client_senha"].'" name="client_senha">
		<label>Nome:</label>
		<input class="entrar" type="text" value="'.$utilizador["client_nome"].'" name="client_nome">
		<label>Sobrenome:</label>
		<input class="entrar" type="text" value="'.$utilizador["client_sobrenome"].'" name="client_sobrenome">
		<label>Morada:</label><br>
		<input type="text"  value="'.$utilizador["client_morada"].'" name="client_morada"><br>
		<label>Distrito</label>
		<select class="morada" value="'.$utilizador["client_distrito"].'" name="client_distrito" id="reg_distrito">' ;}
            

        include 'connections/conn.php';
        $distritos = mysqli_query($conn,"SELECT * FROM distritos");
        while ($distrito = mysqli_fetch_array($distritos))
            {
                echo '<option value="'.$distrito["distritosid"].'">'.$distrito["distrito"]
                    .'</option>';
            }
        mysqli_close($conn);//fechar a ligação com a bd
		{

		echo '
		</select>
		<label id="label_concelho">Concelho</label>
		<select class="morada" value="'.$utilizador["client_concelho"].'" name="client_concelho" id="reg_concelho">
		</select>
		<label id="label_freguesia">Freguesia</label>
		<select class="morada" value="'.$utilizador["client_freguesia"].'" name="client_freguesia" id="reg_freguesia"></select>
		<label>Código Postal</label>
		<input class="login" type="text" value="'.$utilizador["client_cod_postal"].'" name="client_cod_postal" placeholder="1010-100"><br>
		<label>Telef:</label>
		<input class="entrar" type="text" value="'.$utilizador["client_telef"].'" name="client_telef">
		<label>NIF:</label>
		<input class="entrar" type="text" value="'.$utilizador["client_nif"].'" name="client_nif">
		<button class="submeter" type="submit" name="client_new_data" value="Editar">Editar</button>
		
	</form>' ; }
?>
	<div class="container">

		<div class="section-title mb-5">
		<h2>Histórico de compras</h2>
		</div>
		<div class="container-fluid">
		<div class="row">
		<?php
		include 'connections/conn.php';
		$delivery = mysqli_query($conn, "SELECT * FROM encomenda");
		while($enc= mysqli_fetch_array($delivery))
		{
			echo '
				<div class="col-3">
					<div class="info">
						<p>'.$enc["enc_id"].'</p>
						<p>'.$enc["enc_nome"].'</p>
						<p>'.$enc["enc_morada"].'</p>
						<p>'.$enc["enc_cod_postal"].'</p>
						<p>'.$enc["enc_telef"].'</p>
						<p>'.$enc["enc_data"].'</p>
						<p>'.$enc["enc_tipo"].'</p>
						<p>'.$enc["enc_quant"].'</p>
						<p>'.$enc["enc_msg"].'</p>
					</div>
				</div> 
		';
		}       
		?>
		</div>
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
if (isset($_POST["client_new_data"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "UPDATE cliente SET client_email = '$_POST[client_email]', client_senha = '$_POST[client_senha]', client_nome = '$_POST[client_nome]', client_sobrenome = '$_POST[client_sobrenome]', client_morada = '$_POST[client_morada]', client_distrito = '$_POST[client_distrito]', client_concelho = '$_POST[client_concelho]', client_freguesia = '$_POST[client_freguesia]', client_cod_postal = '$_POST[client_cod_postal]', client_telef = '$_POST[client_telef]', client_nif = '$_POST[client_nif]' WHERE client_id = '$_POST[client_id]'");
	echo '<meta http-equiv="refresh" content="0;url=cliente.php">';
}
?>

		
</section>
    </main><!-- End #main -->

</body>

<?php
    include 'footer.php'
?>
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


