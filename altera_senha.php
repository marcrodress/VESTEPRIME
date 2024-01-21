<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/altera_senha.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == 'informar_cliente'){ ?>
<h1><strong>Informações importantes antes de alterar a senha do cliente</strong></h1>
<hr />

<?


$cliente = 0;
$carrinho = 0;
$code_carrinho = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
		$code_carrinho = $res_cliente['code_carrinho'];
		$carrinho = $res_cliente['code_carrinho'];
	if($cliente == 0){
		echo "<script language='javascript'>window.alert('Cliente não informado! Entre no cadastro do cliente!');window.location='carrinho.php';</script>";
	}else{
		
		$sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM alteracao_senha WHERE cliente = '$cliente' AND mes = '$mes' AND ano = '$ano'");
		if(mysqli_num_rows($sql_verifica_senha) >= 1){
		echo "<script language='javascript'>window.alert('Não é possível alterar a senha do cliente ainda não fez 30 dias que o cliente alterou a senha!');window.location='carrinho.php';</script>";
		}else{
				
		}
	} // verifica se o cliente está logado!
		
} // fecha busca cliente

?>


<? if(isset($_POST['button'])){
	
$senha = $_POST['senha'];
$repita_senha = $_POST['repita_senha'];
if($senha == ''){
echo "<script language='javascript'>window.alert('Informe a senha!');</script>";
}elseif($repita_senha == ''){
echo "<script language='javascript'>window.alert('Repita a senha!');</script>";
}elseif($senha != $repita_senha){
echo "<script language='javascript'>window.alert('As senhas não conferem, por favor, insira outra senha!');</script>";
}else{
	mysqli_query($conexao_bd, "UPDATE clientes SET senha = '$senha' WHERE cpf = '$cliente'");
	
	mysqli_query($conexao_bd, "INSERT INTO alteracao_senha (ip, operador, cliente, dia, mes, ano, data, data_completa) VALUES ('$ip', '$operador', '$cliente', '$dia', '$mes', '$ano', '$data', '$data_completa')");
	
		echo "<script language='javascript'>window.alert('Senha alterada com sucesso!');window.location='carrinho.php';</script>";
	
	
}

}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td colspan="4"><ul>
      <li>O cliente só poderar a alterar a senha uma vez a cada 30 dias.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="4"><ul>
      <li>O cliente é obrigado a mostrar o RG para comprovar sua identidade.</li>
    </ul></td>
  </tr>
  <tr>
    <td width="243">&nbsp;</td>
    <td width="243" bgcolor="#E8F3FF"><strong>Informe a nova senha</strong></td>
    <td width="247" bgcolor="#E8F3FF"><strong>Confirme a nova senha</strong></td>
    <td width="247">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td bgcolor="#E8F3FF"><label for="textfield"></label>
    <input name="senha" type="password" id="textfield" maxlength="4"></td>
    <td bgcolor="#E8F3FF"><label for="textfield2"></label>
    <input name="repita_senha" type="password" id="textfield2" maxlength="4"></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" colspan="4"><hr /><input class="botao_avancar" type="submit" name="button" id="button" value="Confirmar"></td>
  </tr>
</table>
</form>
<? } ?>
</div><!-- box_pagamento_1 -->

</body>
</html>