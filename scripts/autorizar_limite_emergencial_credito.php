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

$tarifa = $_POST['tarifa'];
$senha = $_POST['senha'];
$autorizacao = $_POST['autorizacao'];

$cliente = $_GET['cliente'];


if($tarifa == ''){
	echo "<script language='javascript'>window.alert('O cliente precisa concordar com a tarifa para iniciar a avaliação automática de crédito!');window.location='';</script>";
}elseif($senha == ''){
	echo "<script language='javascript'>window.alert('Peça ao cliente que digite sua senha para iniciar a avaliação de crédito!');window.location='';</script>";
}else{

	$sql_confere_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
	if(mysqli_num_rows($sql_confere_senha) == ''){
		echo "<script language='javascript'>window.alert('Senha não confere!');window.location='';</script>";
	}else{
		
		$sql = mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_emergencial = '$autorizacao' WHERE cliente = '$cliente'");
		echo "<strong>Prezado cliente!</strong><br><br>As alterações foram realziadas com sucesso.<br><br><em>Pressione F5 para mesclar a operação.</em>.";
		
		die;
		
  } 
 }
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprycheckbox1">
  <input type="checkbox" name="tarifa" id="checkbox" />
  <span class="checkboxRequiredMsg">O cliente precisar concordar com a cobran&ccedil;a da tarifa.</span></span>
  <label for="checkbox"></label> 
Concordo que após autorizar a avaliação emergencial de crédito, será cobrado uma tarifa única mensal no valor de <strong style="font:15px Arial, Helvetica, sans-serif;"><strong>R$ 18,90</strong></strong> na fatura do cliente, caso o limite seja ultrapassado e a transação seja aprovada.</p>
<p><hr />
 <select name="autorizacao" size="1">
   <? if($_GET['autoizar'] == 'CANCELAR'){ ?>
   <option value="AUTORIZAR">AUTORIZAR TRANSAÇÕES</option>
   <? } ?>
   <? if($_GET['autoizar'] == 'AUTORIZAR'){ ?>
   <option value="CANCELAR">CANCELAR</option>
   <? } ?>
 </select>
  <p>Digite a senha para confirmar</p>
  <p>
  <input name="senha" type="password" id="textfield" style="font:20px Arial, Helvetica, sans-serif; color:#F90; text-align:center; border-radius:5px; border:1px solid #000;" size="5" maxlength="6" autofocus />
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