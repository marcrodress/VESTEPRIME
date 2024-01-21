<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
}
</style>
</head>

<body>
<? if(isset($_POST['button'])){ require "../config.php";

$comprovante = $_FILES['comprovante']['name'];

$comprovante = str_replace(" ", "-", $comprovante); $comprovante = str_replace(",", "-", $comprovante); $comprovante = str_replace("ã", "a", $comprovante);

if(file_exists("../comprovante_ted/$comprovante")){ $a = 1;while(file_exists("../comprovante_ted/[$a]$comprovante")){$a++;}$comprovante = "[".$a."]".$comprovante;}
(move_uploaded_file($_FILES['comprovante']['tmp_name'], "../comprovante_ted/".$comprovante));

mysqli_query($conexao_bd, "UPDATE transferencia_ted SET comprovante = '$comprovante', status = 'Efetivado' WHERE id = '".$_GET['id']."'");

echo "TED efetivado com sucesso!";
die;
}?>
<p><strong>Envie o comprovante</strong></p>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="fileField"></label>
  <input type="file" name="comprovante" id="fileField" />
  <input type="submit" name="button" id="button" value="Efetivar" />
</form>
<p>&nbsp;</p>
</body>
</html>