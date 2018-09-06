<!-- Puxando o cabeçalho da página -->
<?php
	require 'header.php';
?>
	<section>	
		<div class="mid">

		<!-- Menu da esquerda -->
			<nav class="menu_left">
				<div class="menu_left_title">
					<h1>Matérias</h1>
				</div>
				<br/><hr/>
			<!-- Puxando o nome das matérias do Banco de Dados -->
					<ul>
						<?php
						 	foreach($materia_name as $materia_name_inf){
						 		echo '<a href="http://127.0.0.1/projetos/tai_jai_beta?materia='.$materia_id[$materia_name_inf].'"><li>'.$materia_name_inf.'<hr/></li></a>';
						 	}
						 ?>
					</ul>	 
			</nav>

<!-- Conteúdo principal da página -->
			<div class="container">
				<div class="container_title">
					<?php
					/* Verifica qual matéria foi selecionada a partir do menu */
						if(!empty($_GET['materia'])){
							$materia = $_GET['materia'];
						} else {
							$materia = 0;
						}
					/* Escreve o nome da matéria e do professor referente à matéria selecionada */
						if($materia > 0){
							echo '<div class="teacher_name">';
								if(!empty($materia_teacher_id[$materia])){	
									echo "Professor(a): ".$teacher_name[$materia_teacher_id[$materia]];
								} else {
									echo "Professor(a): Não cadastrado";
								}
							echo '</div>';
							echo '<h1>'.$materia_name[$materia].'</h1>';   
						} else {
							echo '<h1>Recentes</h1>';
						}
					?>
				</div>
				
						<?php
						/* Seleciona os assunto referentes à materia selecionada */
							if($materia > 0){
								$sql = $pdo->prepare("SELECT * FROM assuntos WHERE materia_id = :materia_id ORDER BY id DESC");
								$sql->bindValue(":materia_id", $materia);
								$sql->execute();

									if($sql->rowCount() > 0){
										foreach ($sql->fetchAll() as $assunto_inf) {
											echo '<div class="container_int">';
												/* Nome do Matéria */
													echo '<div class="container_int_right">';
														echo '<div class="subject_name">';
															echo '<br/>';
															echo $materia_name[$assunto_inf['materia_id']];
														echo '</div>';
												/* Imagem do Assunto */
														echo '<div class="container_img">';
															echo '<img class="topic_img" src="'.$assunto_inf['img'].'" />';
														echo '</div>';
													echo '</div>';
												/* Nome do Assunto */
													echo '<br>';
														echo '<div class="topic">';
															echo '<div class="topic_name">';
																echo '<h3>'.$assunto_inf['name'].'</h3>';
															echo '</div>';
												/* Conteúdo */			
															echo '<p>';
																echo $assunto_inf['conteudo'];
															echo '</p>';					
													echo '</div>'; 
											echo '</div>';
										}
									} else {
										/* Caso o assunto não seja encontrado no Banco de Dados */
										echo '<div class="container_int">';
											echo '<br/><br/>';
											echo '<div class="topic_name"><h2>Não existe assunto desta matéria.</h2></div>';
										echo '</div>';
									}								 
							} else {
								/* Seleciona assuntos recentes */
								$sql = $pdo->prepare("SELECT * FROM assuntos ORDER BY id DESC"); 
								$sql->execute();

									if($sql->rowCount() > 0){
										foreach ($sql->fetchAll() as $assunto_inf) {
											echo '<div class="container_int">';
												echo '<div class="container_int_right">';
														echo '<div class="subject_name">';
															echo '<br/>';
												/* Nome do Matéria */
															echo $materia_name[$assunto_inf['materia_id']];
														echo '</div>';

												/* Imagem do Assunto */
														echo '<div class="container_img">';
															echo '<img class="topic_img" src="'.$assunto_inf['img'].'" />';
														echo '</div>';
													echo '</div>';
												echo '<br>';
													echo '<div class="topic">';
												/* Nome do Assunto */
														echo '<div class="topic_name">';
															echo '<h3>'.$assunto_inf['name'].'</h3>';
														echo '</div>';
												/* Conteúdo */
														echo '<p>';
															echo $assunto_inf['conteudo'];
														echo '</p>';					
												echo '</div>'; 
											echo '</div>';
										}
									}
							}
						?>
					<!-- Dá uma margem até o footer -->
						<div class="space">
						
						</div>
					</div>

		<!-- Lado direito do site --> 
			<nav class="menu_right"> 
				
			</nav>
		</div>
	</section>
<!-- Puxando o rodapé da página -->
<?php
	require 'footer.php';
?>