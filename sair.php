<?php
	session_start();
	
	unset($_SESSION['tai_jai']);
	header("location: http://127.0.0.1/projetos/tai_jai_beta");
	exit;
?>