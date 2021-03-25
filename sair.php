<?php
//Arranca a sesssão pq este ficheiro não está agregado a nada no site
session_start();
//apos identificação da sessão destruimos a mesma
session_destroy();
//redirecionamos o user para qq lado.
echo '<meta http-equiv="refresh" content="0;url=index.php">';
?>