<?php
// Sessão
session_start();
// Conexão
require_once 'db_conn.php';

if(isset($_POST['btn-editar'])):
	$nome = mysqli_escape_string($conn, $_POST['nome']);
	$sobrenome = mysqli_escape_string($conn, $_POST['sobrenome']);
	$email = mysqli_escape_string($conn, $_POST['email']);
	$cpf = mysqli_escape_string($conn, $_POST['cpf']);

	$id = mysqli_escape_string($conn, $_POST['id']);

	$sql = "UPDATE usuarios SET nome = '$nome', sobrenome = '$sobrenome', email = '$email', cpf = '$cpf' WHERE id = '$id'";

	if(mysqli_query($conn, $sql)):
		$_SESSION['mensagem'] = "Atualizado com sucesso!";
		header('Location: ../list.php');
	else:
		$_SESSION['mensagem'] = "Erro ao atualizar";
		header('Location: ../list.php');
	endif;
endif;