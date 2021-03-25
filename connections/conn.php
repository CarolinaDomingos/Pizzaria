<?php

/* "Chave" de acesso à base de dados 'tpsi0620' */

$servername = "localhost";
$username   = "root";
$password   = "";

/* CRIAR A LIGAÇÃO */
$conn = mysqli_connect($servername, $username, $password);
// mysqli_connect('localhost','root','');

//Verificar se há ligação ao SQL
if (!$conn) {
	die("Erro de Ligação: ".mysqli_connect_error());
}
//mysql_connect("pizzaria",$conn);
mysqli_select_db($conn, "pizzaria");
mysqli_set_charset($conn, "utf8");

?>