<?php
	require 'header.php';
?>

	<div class="mid">
		<div class="cadastro_box">
			<h1>Cadastro</h1><br/>
			<form method="POST" class="login_area">
				Nome:<br/>
				<input class="edit_box" type="text" name="name" autofocus/><br/><br/>
				Email:<br/>
				<input class="edit_box" type="email" name="email"/><br/><br/>
				Senha:<br/>
				<input class="edit_box" type="password" name="password"/><br/><br/>
				Confirmar Senha:<br/>
				<input class="edit_box" type="password" name="confirm_pass"/><br/><br/>
				<input type="submit" class="login_btn" value="Concluir"><br/>

<?php
	
	if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['confirm_pass'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_pass = $_POST['confirm_pass'];

		if($password == $confirm_pass){
			$sql = $pdo->prepare("INSERT INTO usuarios SET name = :name, email = :email, senha = :senha");
			$sql->bindValue(":name", $name);
			$sql->bindValue(":email", $email);
			$sql->bindValue(":senha", $password);
			$sql->execute(); 

				$session_id = $last_id + 1;
				$_SESSION['tai_jai'] = $session_id;

				header("location: http://127.0.0.1/projetos/tai_jai_beta");
			
				
		} else {
			echo '<div class="alert">';
				echo "Senhas não coincidem";
			echo '</div>';
		}
	}
?>

			</form>
		</div>
	</div>


<?php
	require 'footer.php';
?>