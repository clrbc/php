<?php
// Sessão
session_start();
// Conexão
require_once 'db_conn.php';

if(isset($_POST['btn-deletar'])):
	
	$id = mysqli_escape_string($conn, $_POST['id']);

	$sql = "DELETE FROM usuarios WHERE id = '$id'";

	if(mysqli_query($conn, $sql)):
		$_SESSION['mensagem'] = "Deletado com sucesso!";
		header('Location: ../list.php');
	else:
		$_SESSION['mensagem'] = "Erro ao deletar";
		header('Location: ../list.php');
	endif;
endif;