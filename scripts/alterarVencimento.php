<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_cliente.css" rel="stylesheet" />
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<? require "../conexao.php"; ?>

</head>

<body>
<? 
$vencimento = 0;
$sqlBoleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id']."'");
	while($resBoleto = mysqli_fetch_array($sqlBoleto)){
		
		$vencimento = $resBoleto['vencimento'];
		
	}

?>


<? if(isset($_POST['enviar'])){
	
	$dataVencimento = $_POST['alterar'];
	$codeVencimento = 0;
	
	$sqlCodeVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$dataVencimento'");
	while($resCodeVencimento = mysqli_fetch_array($sqlCodeVencimento)){
		$codeVencimento = $resCodeVencimento['codigo'];
	}		

	mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET vencimento = '$dataVencimento', codeVencimento = '$codeVencimento' WHERE id = '".$_GET['id']."'");
	echo "<strong>Operação realizada com sucesso! <br></strong><em>Pressione F5</em>";
	die;


}?>




<span id="sprytextfield1">
<form name="" method="post" enctype="multipart/form-data">
<input type="text" name="alterar" style="padding:10px; width:150px; text-align:center; font:18px Arial, Helvetica, sans-serif; border-radius:5px; height:20px;" autofocus="autofocus" value="<? echo $vencimento; ?>"/>
<input type="submit" name="enviar" style="padding:10px; width:80px; text-align:center; font:18px Arial, Helvetica, sans-serif; border-radius:5px; height:44px;" value="Alterar"/>
<span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
</form>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>