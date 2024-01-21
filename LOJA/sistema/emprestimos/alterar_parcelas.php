<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/alterar_parcelas.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? if(isset($_POST['send'])){

require "../../conexao.php";

$new = $_POST['new'];
$proposta = $_GET['proposta'];

mysql_query("UPDATE envio_de_propostas SET quantidade_parcelas = '$new' WHERE n_proposta = '$proposta' ");

echo "<h1>Alteração realizada com sucesso.</h1>";
die;
}?>
<h1>Novas parcelas</h1>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield1">
  <input type="text" name="new" size="10" />
  </span>
  <input type="submit" name="send" value="Confirmar" />
</form>
</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
</body>
</html>