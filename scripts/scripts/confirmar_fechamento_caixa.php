<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/confirmar_fechamento_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){
	
$id_caixa = $_GET['id_caixa'];
$checkbox = @$_POST['checkbox'];

require "../config.php";

if($checkbox == ''){
	echo "<script language='javascript'>window.alert('VOC� DEVE DECLARAR QUE TODAS AS INFORMA��ES CONTIDAS NO FORMUL�RIO S�O DE SUA RESPONSABILIDADE!');</script>";	
}else{
	mysqli_query($conexao_bd, "UPDATE fechamento_de_caixa SET status = 'FECHAMENTO CONFIRMADO' WHERE id_caixa = '$id_caixa'");
	mysqli_query($conexao_bd, "UPDATE abertura_de_caixa SET status = 'FECHADO' WHERE id = '$id_caixa'");
	
	echo "
	Caixa fechado com sucesso!<br><br>Pressione F5 para mesclar a opera��o.
	";
	die;
}


}?>
<form name="" method="post" enctype="multipart/form-data" action="">
 <table width="700" border="0">
  <tr>
    <td width="20"><input type="checkbox" name="checkbox" id="checkbox">
    <label for="checkbox"></label></td>
    <td width="670">Declaro que todas as informa��es acima contidas no formul�rio de FECHAMENTO DE CAIXA s�o verdadeiras e tenho plena e total ci�ncia de minhas responsabilidades quanto as informa��es fornecidas</td>
  </tr>
  </table>
<p>
  <input type="submit" name="button" id="button" value="Confirmar">
</p>
</form>
</div><!-- box -->
</body>
</html>