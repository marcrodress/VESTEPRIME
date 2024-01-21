<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
<script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>
<? if(isset($_POST['enviar'])){

require "../conexao.php";

$id = $_GET['id'];
$contrato = $_FILES['contrato']['name'];

$contrato = str_replace(" ", "-", $contrato); $contrato = str_replace(",", "-", $contrato); $contrato = str_replace("ã", "a", $contrato);
if(file_exists("../contrato_emprestimo_carne/$contrato")){ $a = 1;while(file_exists("../contrato_emprestimo_carne/[$a]$contrato")){$a++;}$contrato = "[".$a."]".$contrato;}
(move_uploaded_file($_FILES['contrato']['tmp_name'], "../contrato_emprestimo_carne/".$contrato));	
		
mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET contrato = '$contrato' WHERE id = '$id'");

echo "
<strong>Envio de contrato realizado com sucesso!</strong>
<br><br>
<p>Pressione F5 para mesclar a operação</p>

";
		
die;
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprycheckbox1">
  <input type="checkbox" name="tarifa" id="checkbox" />
  <span class="checkboxRequiredMsg">Confira que todas as páginas foram assinadas</span></span>
  <label for="checkbox"></label> 
Concordo que sou o único responsável e confirmo que verifiquei que todas as páginas estão devidamente assinadas pelo cliente.</strong></strong></p>
<p><hr />
  <p>
    <label for="textfield"></label>
    Selecione abaixo contrato</p>
  <p>
    <label for="fileField"></label>
  <input type="file" name="contrato" id="fileField" />
    </p>
  </p>
<p>
  <input style="font:12px Arial, Helvetica, sans-serif; color:#666; padding:5px; border-radius:3px; border:1px solid #000;" type="submit" name="enviar" id="button" value="Confirmar" />
</form>
</p>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>
</body>
</html>