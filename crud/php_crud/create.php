<?php
// Sessão
session_start();
// Conexão
require_once 'db_conn.php';
// Clear
function clear($input) {
	global $conn;
	// sql
	$var = mysqli_escape_string($conn, $input);
	// xss
	$var = htmlspecialchars($var);
	return $var;
}

if(isset($_POST['btn-cadastrar'])):
	$nome = clear($_POST['nome']);
	$sobrenome = clear($_POST['sobrenome']);
	$email = clear($_POST['email']);
	$cpf = clear($_POST['cpf']);

	$sql = "INSERT INTO usuarios (nome, sobrenome, email, cpf) VALUES ('$nome', '$sobrenome', '$email', '$cpf')";

	if(mysqli_query($conn, $sql)):
		$_SESSION['mensagem'] = "Cadastrado com sucesso!";
		header('Location: ../list.php');
	else:
		$_SESSION['mensagem'] = "Erro ao cadastrar";
		header('Location: ../list.php');
	endif;
endif;