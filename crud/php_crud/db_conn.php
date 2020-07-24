<?php
// Conexão com banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$db_name = "ferclardb";

$conn = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($conn, "utf8");

if(mysqli_connect_error()):
	echo "Erro na conexão: ".mysqli_connect_error();
endif;

?>