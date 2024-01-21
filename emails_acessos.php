<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emails_acessos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">
<h1><strong>CÓDIGOS DE ACESSO DO CLIENTE</strong></h1>
<hr />

<? if($_GET['p'] == 'edita'){ ?>

<? if(isset($_POST['enviar'])){
	
$email = $_POST['email'];
$senha = $_POST['senha'];
$site = $_POST['site'];
$observacao = $_POST['observacao'];

mysqli_query($conexao_bd, "UPDATE emails_acesso SET email = '$email', senha = '$senha', site = '$site', observacao = '$observacao' WHERE id = '".$_GET['id']."'");

echo "<script language='javascript'>window.location='?p=';</script>";

}?>


<?
$sql_update = mysqli_query($conexao_bd, "SELECT * FROM emails_acesso WHERE id = '".$_GET['id']."'");
	while($res_update = mysqli_fetch_array($sql_update)){
?>
<form name="" method="post" enctype="multipart/form-data" action="">
<table width="1000" border="0">
  <tr>
    <td><strong>E-MAIL/USUÁRIO</strong></td>
    <td><strong>SENHA</strong></td>
    <td><strong>SITE</strong></td>
    <td><strong>OBSERAÇÃO</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="email"></label>
    <input name="email" type="text" id="email" size="30" value="<? echo $res_update['email']; ?>"></td>
    <td><label for="senha"></label>
    <input name="senha" type="text" id="senha" size="20" value="<? echo $res_update['senha']; ?>"></td>
    <td><label for="site"></label>
    <input name="site" type="text" id="site" size="20" value="<? echo $res_update['site']; ?>"></td>
    <td><label for="observacao"></label>
    <input name="observacao" type="text" id="observacao" size="55" value="<? echo $res_update['observacao']; ?>"></td>
    <td><input class="botao_avancar" type="submit" name="enviar" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<br />
<? die;}} ?>










<?
$cliente = 0;

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

if($cliente == 0){
	echo "<script language='javascript'>window.alert('CLIENTE NÃO FOI INFORMADO');window.location='carrinho.php';</script>";
}else{
}

?>


<form name="" method="post" enctype="multipart/form-data" action="">
<table width="1000" border="0">
  <tr>
    <td><strong>E-MAIL/USUÁRIO</strong></td>
    <td><strong>SENHA</strong></td>
    <td><strong>SITE</strong></td>
    <td><strong>OBSERAÇÃO</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="email"></label>
    <input name="email" type="text" id="email" size="30"></td>
    <td><label for="senha"></label>
    <input name="senha" type="text" id="senha" size="20"></td>
    <td><label for="site"></label>
    <input name="site" type="text" id="site" size="20"></td>
    <td><label for="observacao"></label>
    <input name="observacao" type="text" id="observacao" size="55"></td>
    <td><input class="botao_avancar" type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<hr />
<? if(isset($_POST['button'])){
	
$email = $_POST['email'];
$senha = $_POST['senha'];
$site = $_POST['site'];
$observacao = $_POST['observacao'];

mysqli_query($conexao_bd, "INSERT INTO emails_acesso (dia, mes, ano, data, data_completa, cliente, status, email, senha, site, observacao, operador) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$cliente', 'Ativo', '$email', '$senha', '$site', '$observacao', '$operador')");

echo "<script language='javascript'>window.location='';</script>";

}?>


















<?
$sql_acessos = mysqli_query($conexao_bd, "SELECT * FROM emails_acesso WHERE cliente = '$cliente'");
if(mysqli_num_rows($sql_acessos) == ''){
	echo "<em><br>Não foi cadastrado nenhum e-mail a nenhum sistema de acesso!<br><br></em>";
}else{
?>
<form name="" method="post" enctype="multipart/form-data" action="">
<table width="1000" border="0">
  <tr>
    <td width="325" height="17" bgcolor="#999999"><strong>STATUS</strong></td>
    <td width="325" bgcolor="#999999"><strong>E-MAIL/USUÁRIO</strong></td>
    <td width="118" bgcolor="#999999"><strong>SENHA</strong></td>
    <td width="242" bgcolor="#999999"><strong>SITE</strong></td>
    <td width="196" bgcolor="#999999"><strong>OBSERAÇÃO</strong></td>
    <td width="97" bgcolor="#999999">&nbsp;</td>
  </tr>
  <? while($res_acesssos = mysqli_fetch_array($sql_acessos)){ ?>
  <tr>
    <td><? echo $res_acesssos['status']; ?></td>
    <td><? echo $res_acesssos['email']; ?></td>
    <td><? echo $res_acesssos['senha']; ?></td>
    <td><? echo $res_acesssos['site']; ?></td>
    <td><? echo $res_acesssos['observacao']; ?></td>
    <td>
    <a href="?p=edita&status=edita&id=<? echo $res_acesssos['id']; ?>"><img src="img/cadastro.jpg" width="20" height="20" /><a
    <? if($res_acesssos['status'] == 'Ativo'){ ?>
    <a href="?p=altera&status=Inativo&id=<? echo $res_acesssos['id']; ?>"><img src="img/bloquea.png" width="20" height="20" /></a>
    <? }else{ ?>
    <a href="?p=altera&status=Ativo&id=<? echo $res_acesssos['id']; ?>"><img src="img/correto.jpg" width="20" height="20" /></a>
    <? } ?>
    </td>
  </tr>
  <? } ?>
</table>
</form>
<? } ?>
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['p'] == 'altera'){

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conexao_bd, "UPDATE emails_acesso SET status = '$status' WHERE id = '$id'");

echo "<script language='javascript'>window.location='emails_acessos.php?p=';</script>";


}?>