<?php
// Conexão
require_once 'db_conn.php';

// Sessão
session_start();

// Verificação
if(!isset($_SESSION['logado'])):
	header('Location: index.php');
endif;

// Dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);

include_once 'includes/header.php';

?>

<html>
	<head>
		<title>Página restrita</title>
		<meta charset="utf-8">
	</head>
	<body>
		<h2> Olá <?php echo $dados['nome']; ?> </h2>
		<br>
		<a href="logout.php">Sair</a>
	</body>
</html>

<?php
// Footer
include_once 'includes/footer.php';
?>