<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title> Estudo </title>
	<meta charset="UTF-8"/>
	<meta name="description" content="Estudo"/>
	<meta name="authors" content="Thales - Jaine"/>
	<link rel="stylesheet" href="style.css"/> 
</head>
<body>
<!-- Puxando o arquivo com as configurações do Banco de Dados -->
<?php
	require 'config.php';
?>
	<header>
		<div class="top">
			<div class="top_int">
				<div class="top_left">
		<!-- Título do site -->
					<h1>Cursos ADS e SI</h1>
				</div>
				<div class="top_menu">
		<!-- Menu de Links do topo da página -->
					<ul>
						<a href="http://127.0.0.1/projetos/tai_jai_beta"><li>Home</li></a>
						<a href=""><li>Aulas</li></a> 
						<a href=""><li>Trabalhos</li></a>
						<?php
							if($session > 0){
								echo '<a href=""><li>Notas</li></a>';
							}
						?>
						<a href="http://127.0.0.1/projetos/tai_jai_beta?teacher=1"><li>Professores</li></a> 
						<?php
							if($session > 0){
								if(($session == 1) or ($session == 2)){
									echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/edit.php"><li>Editar</li></a>';
								}
							}
						?>
					</ul>
				</div>
		<!-- Imagens linkadas no topo -->
				<div class="top_right">
					<div class="sites">
						<a href="https://sia.estacio.br/sianet/logon" target="_blank"><img class="site_img" src="http://127.0.0.1/projetos/tai_jai_beta/images/estacio.png" /></a>
						<a href="https://www.google.com/" target="_blank"><img class="site_img" src="http://127.0.0.1/projetos/tai_jai_beta/images/google.png"/></a>
					</div>

		<!-- Campo de pesquisa -->
					<div class="search">
						<form method="GET">
							<input type="text" class="search_box" placeholder="Pesquisar..." name="search"/>
							<div class="img_aling">
								<input type="image" class="search_img" name="look" src="http://127.0.0.1/projetos/tai_jai_beta/images/lupa.png"/>
							</div>
						</form>
					</div>

		<!-- Links para cadastro e login -->
					<div class="top_login">
						<ul>
					<?php 	
							if(isset($_SESSION['tai_jai']) && !empty($_SESSION['tai_jai'])){
								echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/"><li>'.$user_name[$_SESSION['tai_jai']].'</li></a>';
								echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/sair.php"><li>Sair</li></a>';
							} else {
								echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/login.php"><li>Login</li></a>';
								echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/cadastro.php"><li>Cadastro</li></a>';
							}
					?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</header>

