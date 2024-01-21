<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/adiantar_parcelas.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>

</head>

<body>
<div id="box">

<? if(isset($_POST['button'])){

$desconto = $_POST['desconto'];
$parcela = $_POST['parcela'];
$valor_parcela = $_POST['valor_parcela'];
$senha = $_POST['senha'];

$novo_valor = $_POST['valor_parcela']-$_POST['desconto'];

$id = $_GET['id'];
$code_transacao = $_GET['code_transacao'];
$cliente = 0;

$sql_lancamento = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE id = '$id'");
while($res_lancamento = mysqli_fetch_array($sql_lancamento)){
	$cliente = $res_lancamento['cliente'];
}

$code_transacoes = $code_transacao+date("d")+date("m")+date("s");

 $sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE senha = '$senha' AND cpf = '$cliente'");
 if(mysqli_num_rows($sql_verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('SENHA NÃO CONFERE!');</script>";	 
 }else{

mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela) VALUES ('$code_transacoes', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'ADIANAMENTO DE PARCELA: $code_transacao', '$novo_valor', '$code_transacoes', '$cliente', '', '', '')");

mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacoes', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1/1', '1', '$parcela', '$novo_valor', '')");

	
  mysqli_query($conexao_bd, "UPDATE compras_parceladas SET status = 'Lancada' WHERE code_transacao = '$code_transacao' AND parcela = '$parcela'");

  echo "<img src='../img/correto.jpg'/>Sucesso!<br><br>A parcela foi adiantada com sucesso.<br><br><strong>Att.</strong><br>Veste Prime";	 
 die;
 }

}?>


  <table width="432" border="0">
    <tr>
      <td colspan="6" bgcolor="#66CCFF" align="center"><strong>TRANSA&Ccedil;&Atilde;O</strong></td>
    </tr>
    <tr>
      <td bgcolor="#FF9900">&nbsp;</td>
      <td bgcolor="#FF9900"><strong> PARCELA</strong></td>
      <td bgcolor="#FF9900"><strong>DESCONTO</strong></td>
      <td bgcolor="#FF9900"><strong>SENHA</strong></td>
      <td bgcolor="#FF9900">&nbsp;</td>
    </tr>
    <? 
	
	$id = $_GET['id'];
	$code_transacao = $_GET['code_transacao'];
	$parcelas = $_GET['parcela'];
	
	$sql_lancamento = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE id = '$id'");
	$sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE n_parcela = '$parcelas' AND code_transacao = '$code_transacao' AND status = 'Aguarda'");
	if(mysqli_num_rows($sql_parcela) == ''){
		$parcelas++;
		echo "<script language='javascript'>window.location='?id=78&code_transacao=$code_transacao&parcela=$parcelas&id=$id';</script>";
	}else{
	while($res_parcela = mysqli_fetch_array($sql_parcela)){ 
	?>
    <form name="" method="post" action="" enctype="multipart/form-data">
  	<tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
      <td width="30"><input type="radio" name="radio" id="radio" value="radio" />
      <label for="radio"></label></td>
      <td width="115"><strong style="font:10px Arial, Helvetica, sans-serif;">PARCELA <? echo $res_parcela['parcela']; ?></strong></td>
      <td width="74">R$ <? echo number_format($res_parcela['valor_parcela']*((10+$parcelas)/100),2); ?></td>
      <td width="52"><input name="senha" type="password" id="textfield" size="5" autofocus /></td>
      <td width="95"><input type="submit" name="button" id="button" value="Confirmar" /></td>
    </tr>
    <input type="hidden" name="desconto" value="<? echo $res_parcela['valor_parcela']*((10+$i)/100); ?>" />
    <input type="hidden" name="parcela" value="<? echo $res_parcela['parcela']; ?>" />
    <input type="hidden" name="valor_parcela" value="<? echo $res_parcela['valor_parcela']; ?>" />
    </form>
    
    <? }} ?>
  </table>
</div><!-- box -->
</body>
</html>