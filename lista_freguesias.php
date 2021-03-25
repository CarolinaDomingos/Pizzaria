<?php
include 'connections/conn.php';
$val = $_REQUEST["concelho"];
$freguesias = mysqli_query($conn,"SELECT * FROM freguesias WHERE concelhoid = '$val' ");
while($freguesia = mysqli_fetch_array($freguesias))
	{
		echo '<option value="'.$freguesia["freguesiaid"].'">'.$freguesia["freguesia"]
			 .'</option>';
	}
mysqli_close($conn);//fechar a ligação com a bd
?>