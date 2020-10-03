<?php
	
	//Conexão com o Banco de Dados (Futuramente podemos atribuir essa conexao a uma classe
	$banco = "mysql:host=localhost;dbname=import_excel";
	$usuario = 'root';
	$senha = '';
	$conn = new PDO($banco,$usuario,$senha,array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));

?>