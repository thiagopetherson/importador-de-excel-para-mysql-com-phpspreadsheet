<?php  

require_once("conexao/conexao.php");
require ('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


//arquivo vindo do form ou de qualquer outro lugar
$arquivo = $_FILES['arquivo']['tmp_name'];

// read excel spreadsheet
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

$reader->setReadDataOnly(true);
$spreadsheet = $reader->load($arquivo);  
$sheetData = $spreadsheet->getActiveSheet()->toArray();



	//Esse contador é usado para pularmos a primeira linha da planilha (que no caso é o cabeçalho)
	//Se não houvesse cabeçalho, seria só tirar essa lógica do $i
	$i = 0; 

	foreach($sheetData as $key => $value)
	{		
	
		if($i === 0)
		{
			$i++;
			continue;
		}	

		$query = "INSERT INTO tbl_import_excel(nome,idade,sexo,estado_civil,cidade,uf)
				  VALUES(:nome,:idade,:sexo,:estado_civil,:cidade,:uf)";

		$stmt = $conn->prepare($query);
		$stmt->bindValue(':nome',trim($value[0]));
		$stmt->bindValue(':idade',trim($value[1]));
		$stmt->bindValue(':sexo',trim($value[2]));
		$stmt->bindValue(':estado_civil',trim($value[3]));
		$stmt->bindValue(':cidade',trim($value[4]));
		$stmt->bindValue(':uf',trim($value[5]));

		$result = $stmt->execute();

		if(!$result)
		{
			 print_r($stmt->errorInfo());
		}
			
		
	}

	$retorno = "sucesso";

	echo json_encode($retorno);
	die();

		


?>
