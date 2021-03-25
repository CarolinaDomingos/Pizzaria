
<header>
    <link rel="stylesheet" type="text/css" href="./fontawesome/css/all.css">
	  <link rel="stylesheet" type="text/css" href="./css/estilos.css">
	  <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous" defer></script>
  </header>

<body>

<?php
session_start();
?>

<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
    <div class="box"><a class="navbar-brand" href="index.php">#pizzeria.</a></div>
      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li>Inicio</li>
          <li><a href="?opt=1">Gerir Menu</a></li>
          <li><a href="?opt=2">Users</a></li>
          <li><a href="?opt=3">Pratos mais pedidos</a></li>
          <li><a href="?opt=4">Gastos</a></li>
        </ul>
      </nav>
</div>
</header>
<br>
<br>
<main id="main">
<!-- Area de apresentacao dos conteudos de gestao -->
<section>
<?php
/* RECEBER OPCAO DO ADMIN */
@$opt = $_REQUEST["opt"];
switch ($opt) {
	case '1':
		//Opção de gerir Menus: 1 - Listar Menus, Editar Menus e Apagar Menus
		echo '
    <div class="container">
      <div class="section-title">
        <h2>Gestão do Menu</h2>
        <p>São apresentados os menus existentes. Pode editar ou eliminar cada um deles.</p>
      </div>
      <div class="row">'	;
		include 'connections/conn.php';
		$menu = mysqli_query($conn, "SELECT * FROM menu");
		while ($men = mysqli_fetch_array($menu)) {
			echo '<div class="col-lg-12 painel_admin">
        <form method="post">
          <table>
            <tr>
              <td>
                <label class="gestao_menu">Nome do Menu: </label>
                <input type="text" name="men_nome"
                value="'	.$men["men_nome"].'">
                <input type="hidden" value="'	.$men["men_id"].'" name="men_id">
              </td>
              <td>
                <label  class="gestao_menu" >Preço do Menu: </label>
                <input type="text" name="men_price"
                value="'	.$men["men_price"].'">
                <input type="hidden" value="'	.$men["men_id"].'" name="men_id">
              </td>
              <td>
              <input type="submit" name="update_menu" value="Atualizar" style="background-color:orange;">
              </td>
              <td>
              <input type="submit" name="del_menu" value="Apagar" style="background-color:red;">
              </td>
            </tr>
          </table>
        </form>
        </div>'	;
		}
		echo '</div>
    </div>'	;

		break;
    case '2':
      echo '
      <div class="container">
        <div class="section-title">
          <h2>Users</h2>
          <p>É apresentada a listagem dos utilizadores(clientes) existentes.</p>
        </div>
        <div class="row">'	;
      include 'connections/conn.php';
      $cliente = mysqli_query($conn, "SELECT * FROM cliente");
      while ($user = mysqli_fetch_array($cliente)) {
        echo '
          <form method="post">
            <table>
            <tr>
                <td>
                <label class="gestao_users">Id: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_id"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Email: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_email"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Senha: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_senha"].'</p>
                </td>
              </tr>
              <tr>
                <label class="gestao_users">Nome: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_nome"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Sobrenome: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_sobrenome"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Morada: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_morada"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Distrito: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_distrito"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Concelho: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_concelho"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Freguesia: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_freguesia"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Código-postal: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_cod_postal"].'</p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">Nº de telef.: </label>
                <p class="gestao_content" type="text" name="client_content">'.$user["client_telef"].' </p>
                </td>
              </tr>
              <tr>
                <td>
                <label class="gestao_users">NIF: </label>
                <p class="gestao_content" type="text"  name="client_content">'.$user["client_nif"].'</p>
                </td>
              </tr>
            </table>
          </form>
          '	;
      }
      echo '</div>
      </div>'	; 
    break;  
    case '3':
      echo '
      <div class="container">
        <div class="section-title">
          <h2>Pratos mais pedidos</h2>
          <p>É apresentada a listagem dos pratos mais pedidos.</p>
        </div>
        <div class="row">'	;
      include 'connections/conn.php';
      $delivery = mysqli_query($conn, "SELECT * FROM encomenda");
      while ($enc = mysqli_fetch_array($delivery)) {
        echo '
          <form method="post">
            <table>
              <tr>
                <td>
                <label class="gestao_pedidos">Pratos mais pedidos: </label>
                <p class="gestao_pratos" name="client_pratos">'.$enc["enc_tipo"].'</p>
                </td>
              </tr>
            </table>
          </form>
          '	;
      }
      echo '</div>
      </div>'	; 
    break; 
    case '4':
      echo '
      <div class="container">
        <div class="section-title">
          <h2>Média de gastos</h2>
          <p>É apresentada a média dos gastos.</p>
        </div>
        <div class="row">'	;
      include 'connections/conn.php';
      $delivery = mysqli_query($conn, "SELECT AVG (enc_quant * men_price) AS 'estatistica' FROM encomenda JOIN menu ON  menu.men_price WHERE encomenda.enc_id = menu.men_id");
      while ($enc = mysqli_fetch_array($delivery)) {
        echo '
          <form method="post">
            <table>
              <tr>
                <td>
                <label class="gestao_gastos">Média de gastos: </label>
                <p class="gestao_media" name="client_media">'.$enc["estatistica"].'€</p>
                </td>
              </tr>
            </table>
          </form>
          '	;
      }
      echo '</div>
      </div>'	; 
    break; 
	default:
		echo 'Home Page do Admin';
		break;
}
//if isset - permite verificar se foi ativado um submit ao formulario
if (isset($_POST["update_menu"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "UPDATE menu SET men_nome = '$_POST[men_nome]', men_price = '$_POST[men_price]' WHERE men_id = '$_POST[men_id]'");
	//reencaminhar user para a pagina
	echo '<meta http-equiv="refresh" content="0;url=painel_admin.php?opt=1">';
}
if (isset($_POST["del_menu"])) {
	include 'connections/conn.php';
	//extrair os dados do menu que se pretende apagar
	$filtro = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM menu WHERE men_id = '$_POST[men_id]'"));
	//condicionar operacao de apagar
	mysqli_query($conn, "DELETE FROM menu WHERE men_id = '$_POST[men_id]' ");
	//reencaminhar user para a pagina
	echo '<meta http-equiv="refresh" content="0;url=painel_admin.php?opt=1">';


}
if (isset($_POST["client_content"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "SELECT * FROM cliente WHERE client_id = '$_POST[client_id]'");
	//reencaminhar user para a pagina
  mysqli_query($conn, "SELECT cliente.* FROM cliente WHERE client_id = '$_POST[client_id]', client_email = '$_POST[client_email]', client_senha = '$_POST[client_senha]', client_nome = '$_POST[client_nome]', client_sobrenome = '$_POST[client_sobrenome]', client_morada = '$_POST[client_morada]', client_distrito = '$_POST[client_distrito]', client_concelho = '$_POST[client_concelho]', client_freguesia = '$_POST[client_freguesia]', client_cod_postal = '$_POST[client_cod_postal]', client_telef = '$_POST[client_telef]',client_nif = '$_POST[client_nif]' ");
	echo '<meta http-equiv="refresh" content="0;url=painel_admin.php?opt=1">';

}
if (isset($_POST["client_pratos"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "SELECT enc_tipo FROM encomenda ORDER BY enc_tipo DESC LIMIT 1");
	//reencaminhar user para a pagina
	echo '<meta http-equiv="refresh" content="0;url=painel_admin.php?opt=1">';

}
if (isset($_POST["client_media"])) {
	include 'connections/conn.php';
	mysqli_query($conn, "SELECT AVG (enc_quant * men_price) AS 'estatistica' FROM encomenda JOIN menu ON  menu.men_price WHERE encomenda.enc_id = menu.men_id");
	//reencaminhar user para a pagina
	echo '<meta http-equiv="refresh" content="0;url=painel_admin.php?opt=1">';

}

?>
</section>

</main><!-- End #main -->

<?php include 'footer.php';?>


</body>

