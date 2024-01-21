<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/aplicar_desconto.css" rel="stylesheet" type="text/css" />
<title></title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../config.php"; ?>

<? if($_GET['p'] == 'sucesso'){
	
	echo "Desconto aplicado com sucesso!<br><br>Pressione F5";
	die;


}?>

<? if($_GET['p'] == ''){ ?>



<? if(isset($_POST['button'])){
	
$tipo = $_POST['tipo'];
$desconto = $_POST['valor'];
$senha = $_POST['senha'];
$carinho = $_GET['code_carrinho'];
$cliente = $_GET['cliente'];
$produto_carrinho = $_GET['produto_carrinho'];
$valor_desconto = 0;
$novo_valor = 0;

$valida = 0;

$conta_desconto = strlen($desconto);
for($i=0; $i<=$conta_desconto; $i++){
	
	if($desconto[$i] == ','){
	$valida = 1;
	}
	
}

if($valida == '1'){
	echo "<script language='javascript'>window.alert('Para aplicar desconto não pode usar virgula, ou letras. Somente é permitido números e pontos para diferenciar as casas decimais!');</script>";
}else{

$verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE senha_autorizacao = '$senha'");
if(mysqli_num_rows($verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('Senha de autorização invalidade!');</script>";
}else{
	
	$verifica_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '$carinho' AND code_produto = '$produto_carrinho'");
		while($res_produto = mysqli_fetch_array($verifica_produto)){
			$quantidade = $res_produto['quant'];
			$valor = $res_produto['valor'];
			
			if($tipo == 'PERCENTUAL'){
				$valor_desconto = $valor*($desconto/100);
				$novo_valor = $valor-$valor_desconto;
	echo "<script language='javascript'>window.alert('$novo_valor');</script>";
			}else{
				$valor_desconto = $desconto;
				$novo_valor = $valor-$valor_desconto;
	echo "<script language='javascript'>window.alert('$novo_valor');</script>";
			}	
			
	} // while
	
	mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, status, ip, dia, mes, ano, data, data_completa, code_carrinho, form_pag, valor_total, cliente, operador, descontos, parcelas, cartao, valor_fornecido, valor_parcela, quant_parcelas, status_cheque, troco, code_dia, loja) VALUES ('$codeCaixa', '$turno', 'Ativo', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', '$carinho', 'DESCONTO LOJA', '$valor_desconto', '$cliente', '$operador', '$valor_desconto', '', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
	
	echo "<script language='javascript'>window.location='?p=sucesso';</script>";

	
	
} // verifica senha de autorização
}

}?>



<form name="" method="post" action="" enctype="multipart/form-data">
<table width="201" border="0">
  <tr>
    <td width="53" bgcolor="#00CC99"><strong>TIPO</strong></td>
    <td width="40" bgcolor="#00CC99"><strong>VALOR</strong></td>
    <td width="39" bgcolor="#00CC99"><strong>SENHA</strong></td>
    <td width="134" bgcolor="#00CC99">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="select"></label>
      <select name="tipo" size="1" id="select">
        <option value="VALOR">R$</option>
        <option value="PERCENTUAL">%</option>
    </select></td>
    <td><label for="."></label>
      <span id="sprytextfield1">
      <input name="valor" type="text" id="." size="5" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="textfield"></label>
      <span id="sprytextfield2">
      <input name="senha" type="password" id="textfield" size="3" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
  </table>
</form>
</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>

<? } ?>
</body>
</html>