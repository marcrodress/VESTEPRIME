<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/dados_bancarios.css" rel="stylesheet" type="text/css" />
<? require "../config.php"; ?>

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? if(isset($_POST['button'])){

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$n_conta = $_POST['n_conta'];
$banco = $_POST['banco'];



}?>

<?
$cliente = $_GET['cliente'];
$id = $_GET['id'];
$n_proposta = $_GET['n_proposta'];
$valor = 0;

$sql_emprestimo_distribuicao_clientes = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta' AND cliente = '$cliente'");
	while($limite_cliente = mysqli_fetch_array($sql_emprestimo_distribuicao_clientes)){
		$valor = $limite_cliente['valor'];
	}
?>



<? if(isset($_POST['button'])){

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$n_conta = $_POST['n_conta'];
$banco = $_POST['banco'];

mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes SET cpf_conta = '$cpf', nome_conta = '$nome', tipo_conta = '$tipo_conta', agencia = '$agencia', n_conta = '$n_conta', banco = '$banco' WHERE n_proposta = '$n_proposta' AND cliente = '$cliente'");;

echo "<strong>Contratação realizada com sucesso!</strong>
<br><br>
Pressione F5 para mesclar a operação
";

die; 
}?>




<?

$sql_datalhe = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta' AND cliente = '$cliente'");
while($res_detalhe = mysqli_fetch_array($sql_datalhe)){
?>
<form name="" method="post" action="" enctype="multipart/form-data"> 
<table width="400" border="0">
  <tr>
    <td colspan="2"><strong>CLIENTE:</strong> 
      <? 
	  $nome = 0;
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $nome = $res_cliente['nome'];
			}
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><strong>VALOR A RECEBER: </strong> R$ <? echo number_format($valor,2,',','.'); ?></td>
  </tr>
  <tr>
    <td width="130" bgcolor="#66CCFF"><strong>CPF:</strong></td>
    <td width="260" bgcolor="#66CCFF"><strong>NOME:</strong></td>
  </tr>
  <tr>
    <td><label for="cpf"></label>
      <span id="sprytextfield1">
      <input name="cpf" type="text" id="cpf" size="15" value="<? if($res_detalhe['cpf_conta'] != ''){ echo $res_detalhe['cpf_conta']; }else{ echo $cliente; }?>" maxlength="11" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="nome"></label>
      <span id="sprytextfield2">
      <input name="nome" type="text" id="nome" value="<? if($res_detalhe['cpf_conta'] != ''){ echo $res_detalhe['nome_conta']; }else{ echo $nome; }?>" size="45" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td bgcolor="#66CCFF"><strong>TIPO DE CONTA:</strong></td>
    <td bgcolor="#66CCFF"><strong>AG&Ecirc;NCIA:</strong></td>
  </tr>
  <tr>
    <td>
      <select name="tipo_conta" size="1" id="tipo_conta">
        <option value="<? echo $res_detalhe['tipo_conta']; ?>"><? echo $res_detalhe['tipo_conta']; ?></option>
        <option value="CORRENTE">CORRENTE</option>
        <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
      </select></td>
    <td><label for="agencia"></label>
      <span id="sprytextfield3">
      <input name="agencia" type="text" id="agencia" size="10" value="<? echo $res_detalhe['agencia']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td bgcolor="#66CCFF"><strong>N&deg; DA CONTA</strong></td>
    <td bgcolor="#66CCFF"><strong>BANCO</strong></td>
  </tr>
  <tr>
    <td><label for="n_conta"></label>
      <span id="sprytextfield4">
      <input name="n_conta" type="text" id="n_conta" size="10" value="<? echo $res_detalhe['n_conta']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><select style="width:200px;" name="banco" id="banco">
        <option value="<? echo $res_detalhe['banco']; ?>"><? echo $res_detalhe['banco']; ?></option>
       <?
        $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos");
			while($res_1 = mysqli_fetch_array($sql_1)){
	   ?>
        <option value="<? echo $res_1['codigo']; ?> - <? echo $res_1['nome_banco']; ?>"><? echo $res_1['codigo']; ?> - <? echo $res_1['nome_banco']; ?></option>
        <? } ?>      
      
    </select></td>
  </tr>
  <tr>
    <td colspan="2"><input type="submit" name="button" id="button" value="Enviar" /></td>
  </tr>
</table>
</form>
<? } ?>

</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
</script>
</body>
</html>