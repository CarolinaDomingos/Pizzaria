<?php
include 'connections/conn.php';
$val = $_REQUEST["distrito"];
$concelhos = mysqli_query($conn,"SELECT * FROM concelhos WHERE distritoid = '$val' ");
while($concelho = mysqli_fetch_array($concelhos))
	{
		echo '<option value="'.$concelho["concelhoid"].'">'.$concelho["concelho"]
			 .'</option>';
	}
mysqli_close($conn);//fechar a ligação com a bd
?>