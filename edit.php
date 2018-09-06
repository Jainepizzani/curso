<!-- Puxando o cabeçalho -->
<?php
	require 'header.php';

	if(isset($_SESSION['tai_jai']) && !empty($_SESSION['tai_jai'])){
		if(($_SESSION['tai_jai'] != 1) && ($_SESSION['tai_jai'] != 2)){
			header("location: http://127.0.0.1/projetos/tai_jai_beta");
		}
	} else {
		header("location: http://127.0.0.1/projetos/tai_jai_beta");
	}
	
?>
<!-- Corpo do site -->
	<section>	
		<div class="mid">
<!-- Menu da esquerda -->	
			<nav class="menu_left">
				<div class="menu_left_title">
					<h1></h1>
				</div>
				<br/>
			</nav>
<!-- Variável que permite a navegação na página de edição --> 	
	<?php
		if(!empty($_GET['edit_materia'])){
			$edit_materia = $_GET['edit_materia'];
	?>
<!-- Página de edição da matéria -->
			<div class="container">
				<div class="container_title">
					<div class="container_title_mid">
						<h1>Editar</h1>
					</div>
					<a href="http://127.0.0.1/projetos/tai_jai_beta/edit.php"><h2>Voltar</h2></a>
				</div>

				<div class="container_edit_int">
					<h2>Editar Matéria: <?php echo $materia_name[$edit_materia]; ?></h2><br/><br/>
			
			<!-- Campos para edição da matéria -->
					<form method="POST">
						<h3>Novo nome:</h3>
						<input class="edit_box" type="text" name="update_subject" placeholder="Nome da Matéria..." /><br/><br/>
							<h3>Professor:</h3>
							<select name="teacher">
								<?php
									foreach($teacher_name as $teacher_name_inf) {
										if($teacher_id[$teacher_name_inf] == $materia_teacher_id[$edit_materia]){
											echo '<option selected>'.$teacher_name_inf.'</option>'; 
										} else{
											echo '<option>'.$teacher_name_inf.'</option>';
										}
									}
								?>
							</select>
						<input type="submit" name="enter" value="Confirmar"/><br/>
					</form>

			<!-- Fazendo o 	Update no Banco de dados -->

				<?php
					if(!empty($_POST['enter'])){
						$teacher = $_POST['teacher']; 
						$teacher = $teacher_id[$teacher];
							if(!empty($_POST['update_subject'])){
								$update_subject = $_POST['update_subject'];

								$sql = $pdo->prepare("UPDATE materias SET name = :name, teacher_id = :teacher_id WHERE id = :id");
								$sql->bindValue(":name", $update_subject);
								$sql->bindValue(":teacher_id", $teacher);
								$sql->bindValue(":id", $edit_materia);
								$sql->execute();

							} else {
								$sql = $pdo->prepare("UPDATE materias SET teacher_id = :teacher_id WHERE id = :id");
								$sql->bindValue(":teacher_id", $teacher);
								$sql->bindValue(":id", $edit_materia);
								$sql->execute();
							}

						echo '<br/><br/><h4>Matéria Editada com Sucesso</h4>';
					}

				?>


					<br/><br/><br/><br/><br/><br/><br/><br/><br/>
				</div>
			</div>
<!-- Página de edição geral --> 
	<?php
		} else {
	?>
 
			<div class="container">
				<div class="container_title">
					<h1>Editar</h1>
				</div>
<!-- Campo para adicionar matéria -->
				<div class="container_edit_int">
					<h2>Adicionar Matéria</h2><br/>
						<form method="POST">
							Nome:<br/>
							<input class="edit_box" type="text" name="new_subject" placeholder="Nome da Matéria..." /><br/><br/>
							Professor: <br/>
							<select class="edit_box" name="teacher">
								<?php
									foreach($teacher_name as $teacher_name_inf) {
										echo '<option>'.$teacher_name_inf.'</option>'; 
									}
								?>
							</select>
							<br/><br/>
							<input type="submit" value="Confirmar"/><br/>
						</form>
					<!-- Insere a matéria nova no Banco de Dados -->
							<?php
								if(!empty($_POST['new_subject'])){
									$new_subject = $_POST['new_subject'];
									$teacher = $_POST['teacher']; 

										$teacher = $teacher_id[$teacher];

									$sql = $pdo->prepare("INSERT INTO materias SET name = :name, teacher_id = :teacher_id");
									$sql->bindValue(":name", $new_subject);
									$sql->bindValue(":teacher_id", $teacher);
									$sql->execute();

									header("location: http://127.0.0.1/projetos/tai_jai_beta/edit.php");
								}

							?>

					<br/><hr/>

					<h2>Adicionar Professor</h2><br/>
						<form method="POST">
							Nome:<br/>
							<input class="edit_box" type="text" name="new_teacher" placeholder="Nome..." /><br/><br/>
							Email: <br/>
							<input class="edit_box" type="email" name="email" placeholder="Email..." /><br/><br/>
							<input type="submit" value="Confirmar"/><br/>
						</form>

					<!-- Insere a nova professor no Banco de Dados -->

							<?php
								if(!empty($_POST['new_teacher'])){
									$new_teacher = $_POST['new_teacher'];
									$new_email = $_POST['email'];

									$sql = $pdo->prepare("INSERT INTO professores SET name = :name, email = :email");
									$sql->bindValue(":name", $new_teacher);
									$sql->bindValue(":email", $new_email);
									$sql->execute();
									echo '<br/>';
									echo "Professor adicionado com sucesso.";
									echo '<br/>';
								}
							?>

					<br/><hr/>					
<!-- Função para editar ou excluir matérias -->
					<h2>Editar Matéria</h2><br/>
							<ul>
								<?php
									$sql = $pdo->prepare("SELECT * FROM materias");
									$sql->execute();

									if($sql->rowCount() > 0){
										foreach($sql->fetchAll() as $materia_inf){
											echo '<li>';
												echo $materia_inf['name'];
												echo '<div class="div_btns">';
													echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/edit.php?edit_materia='.$materia_inf['id'].'">';
												/* Botão de editar */
														echo '<input type="submit" class="btn_edit" value="Editar" />';
													echo '</a>';
													echo '<a href="http://127.0.0.1/projetos/tai_jai_beta/edit.php?excluir_materia='.$materia_inf['id'].'">';
												/* Botão de excluir */
														echo '<input class="btn_excluir" type="submit" value="Excluir" />';
													echo '</a>';
												echo '</div>'; 
											echo '</li>';
										}
									}
								?>
							</ul>
					<br/><hr/>
<!-- Adicionar novo assunto -->
						<h2>Adicionar Assunto</h2>
							<form method="POST">
								Nome:<br/>
							<!-- Campos para adicionar novo assunto -->
								<input type="text" placeholder="nome..." class="add_box" name="topic"/><br/><br/>
								Imagem:<br/>
								<input type="text" placeholder="Url..." class="add_box" name="img"/><br/><br/> 
								Matéria Relacionada:<br/>
								<select name="materia_rel" class="select_box">
							<!-- Selecionando matérias e criando opções -->
									<?php 
										$sql = $pdo->prepare("SELECT * FROM materias");
										$sql->execute();

											if($sql->rowCount() > 0){
												foreach($sql->fetchAll() as $materia_inf) {
													echo '<option>';
														echo $materia_inf['name'];
													echo '</option>';
												}
											}

									?>
								</select><br/><br/>
								Conteúdo:<br/>
								<textarea name="conteudo"></textarea><br/><br/>
								<input type="submit" value="Confirmar">
							</form>
<!-- Adicionando novo assunto no Bando de Dados -->
							<?php
								if(!empty($_POST['topic']) && !empty($_POST['materia_rel']) && !empty($_POST['conteudo'])){
									$topic = $_POST['topic'];
									$materia_rel = $_POST['materia_rel'];
									$conteudo = $_POST['conteudo'];

										if(!empty($_POST['img'])){
											$img = $_POST['img'];
										} else {
											$img = 0;
										}

									$mat_id = $materia_id[$materia_rel]; 

									$sql = $pdo->prepare("INSERT INTO assuntos SET name = :name, conteudo = :conteudo, img = :img, materia_id = :materia_id");
									$sql->bindValue(":name", $topic);
									$sql->bindValue(":conteudo", $conteudo);
									$sql->bindValue(":img", $img); 
									$sql->bindValue(":materia_id", $mat_id); 
									$sql->execute();

									echo '<br/>';
									echo "Assunto adicionado com sucesso!";							
								}
							?>


					<br/><hr/>
				</div>
<!-- Espaço entre a página e o rodapé -->
				<div class="space">
					
				</div>
			</div>
		<?php
			}
		?>
<!-- Menu da direita -->
			<nav class="menu_right"> 
	
			</nav>
		</div>
	</section>
<!-- Puxa o rodapé da pagina -->
<?php
	require 'footer.php';
?>
