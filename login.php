<?php
	require 'header.php';
?>

	<div class="mid">
		<div class="login_box">
			<h1> Login </h1><br/>
			<form method="POST" class="login_area">
				Email:<br/>
				<input class="edit_box" type="email" name="email" autofocus/><br/><br/>
				Senha:<br/>
				<input class="edit_box" type="password" name="password"/><br/><br/>
				<input type="submit" class="login_btn" value="Entrar">
			</form>

			<?php
				if(!empty($_POST['email']) && !empty($_POST['password'])){
					$email = $_POST['email'];
					$senha = $_POST['password'];

					$sql = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
					$sql->bindValue(":email", $email);
					$sql->bindValue(":senha", $senha);
					$sql->execute();

					if($sql->rowCount() > 0){
						$sql_inf = $sql->fetch();
						$session_id = $sql_inf['id'];

						$_SESSION['tai_jai'] = $session_id;

						header("location: http://127.0.0.1/projetos/tai_jai_beta");
					} else {
						echo "usuario ou senha incorretos";
					}
				} 
			?>

			<br/><hr>
			<div class="link_box">
				<a href="http://127.0.0.1/projetos/tai_jai_beta/cadastro.php" class="link">Cadastrar</a>
				<a href="" class="margin_80 link">Esqueceu a Senha</a>
			</div>
		</div>
	</div>


<?php
	require 'footer.php';
?>













