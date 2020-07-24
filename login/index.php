<?php
// Conexão
include_once 'includes/header.php';
require_once 'db_conn.php';

// Sessão
session_start();

// Botão enviar
if(isset($_POST['btn-entrar'])):
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);
	if(isset($_POST['lembrar-senha'])):

		setcookie('login', $login, time()+3600);
		setcookie('senha', md5($senha), time()+3600);
	endif;

	if(empty($login) or empty($senha)):
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	else:
		// 105 OR 1=1 
	    // 1; DROP TABLE teste

		$sql = "SELECT login FROM users WHERE login = '$login'";
		$resultado = mysqli_query($connect, $sql);		

		if(mysqli_num_rows($resultado) > 0):
		$senha = md5($senha);       
		$sql = "SELECT * FROM users WHERE login = '$login' AND senha = '$senha'";

		$resultado = mysqli_query($connect, $sql);

			if(mysqli_num_rows($resultado) == 1):
				$dados = mysqli_fetch_array($resultado);
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['id_usuario'] = $dados['id'];
				header('Location: home.php');
			else:
				$erros[] = "<li> Usuário e senha não conferem </li>";
			endif;

		else:
			$erros[] = "<li> Usuário inexistente </li>";
		endif;

	endif;

endif;
?>

<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="row">
		<div class="col s12 m6 push-m3">
			<h2> Bem vindo! </h2>
			<?php 
			if(!empty($erros)):
			foreach($erros as $erro):
				echo $erro;
			endforeach;
			endif;
			?>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
				<div class="input-field col s12">
					Login: <input type="text" name="login" value="<?php echo isset($_COOKIE['login']) ? $_COOKIE['login'] : '' ?>"><br>
				</div>
				<div class="input-field col s12">
					Senha: <input type="password" name="senha" value="<?php echo isset($_COOKIE['senha']) ? $_COOKIE['senha'] : '' ?>"><br>
				</div>
				<label>
        			<input type="checkbox" name="lembrar-senha">
					<span>Lembrar senha</span>
				</label>
				  <button class="waves-effect waves-light btn" type="submit" name="btn-entrar"> Entrar </button>
			</form>
		</div>
	</div>
</body>
</html>
<?php
// Footer
include_once 'includes/footer.php';
?>