<?php
/* Inicio da sessão e config da sessão*/
	session_start(); 

	if(isset($_SESSION['tai_jai']) && !empty($_SESSION['tai_jai'])){
		$session = $_SESSION['tai_jai'];
	} else {
		$session = 0;
	}

/* Conexão com o Banco de Dados*/
	try { 
		$pdo = new PDO("mysql:dbname=tai_jai;host=127.0.0.1", "root", "");
	} catch(PDOException $e){ 
		echo "Erro: ".$e->getMessage();
		exit;
	}


/* Selecionando tudo da tabela matérias e armazenando nas variáveis*/
	$sql = $pdo->prepare("SELECT * FROM materias");
	$sql->execute();
		if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $materia_inf) {
				$materia_name[$materia_inf['id']] = $materia_inf['name'];
				$materia_id[$materia_inf['name']] = $materia_inf['id']; 
				$materia_teacher_id[$materia_inf['id']] = $materia_inf['teacher_id'];   
			}
		}

/* Selecionando tudo da tabela professores e armazenando nas variáveis */

	$sql = $pdo->prepare("SELECT * FROM professores");
	$sql->execute();

		if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $teacher_inf) {
				$teacher_id[$teacher_inf['name']] = $teacher_inf['id'];
				$teacher_name[$teacher_inf['id']] = $teacher_inf['name'];
				$teacher_email[$teacher_inf['id']] = $teacher_inf['email'];
			}
		}

/* Selecionando tudo da tabela usuarios e armazenando nas variáveis */

	$sql = $pdo->prepare("SELECT * FROM usuarios");
	$sql->execute();

		if($sql->rowCount() > 0){
			foreach ($sql->fetchAll() as $user_inf) {
				$user_id[$user_inf['name']] = $user_inf['id'];
				$user_name[$user_inf['id']] = $user_inf['name'];
				$user_email[$user_inf['id']] = $user_inf['email'];
				$last_id = $user_inf['id'];
			}
		}

/* Pegando a data atual */

	$date = date("d/m/y"); 
?> 