<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/saque_de_cartao.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<hr />
<h1><strong>SAQUE - SOMENTE CARTÃO DE DÉBITO</strong></h1>
<table width="1000" border="0">
  <tr>
    <td width="187"><strong>DIGITE O VALOR</strong></td>
    </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield1">
        <input type="text" name="valor" autofocus />
        <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
  <tr>
    <td><strong>NOME DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield2">
      <label for="nome"></label>
      <input class="input2" type="text" name="cliente" id="nome" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
  </tr>
  <tr>
    <td><strong>BANCO EMISSOR DO CART&Atilde;O</strong></td>
  </tr>
  <tr>
    <td>
      <select name="banco_emissor_cartao" size="1" id="banco_emissor_cartao">
       <?
        $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo != '001'");
			while($res_1 = mysqli_fetch_array($sql_1)){
	   ?>
        <option value="<? echo $res_1['codigo']; ?>"><? echo $res_1['codigo']; ?> - <? echo $res_1['nome_banco']; ?></option>
        <? } ?>
      </select> 
      </td>
  </tr>
  <tr>
    <td><strong>BANDEIRA DO CARTAO</strong></td>
  </tr>
  <tr>
    <td><label for="select2">
      <select name="bandeira" size="1" id="bandeira">
        <option value="VISA">VISA</option>
        <option value="MASTERCARD">MASTERCARD</option>
        <option value="ELO">ELO</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td><input class="input" type="submit" name="button" id="button" value="Avançar" /></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$valor = $_POST['valor'];
$banco_emissor_cartao = $_POST['banco_emissor_cartao'];
$bandeira = $_POST['bandeira'];
$cliente = $_POST['cliente'];

echo "<script language='javascript'>window.location='?valor=$valor&banco=$banco_emissor_cartao&bandeira=$bandeira&cliente=$cliente&p=2';</script>";
}
?>
<? } ?>
  
  
  
<? if($_GET['p'] == '2'){ ?>
<hr />
<h1 style="color:#0CC;"><strong>Valor solicitado: <? echo @number_format($_GET['valor'], 2, ',', '.'); ?></strong></h1>
<hr />
<h2><strong>Valor do saque:</strong></h2><? echo @number_format($_GET['valor'], 2, ',', '.'); ?><br />
<h2><strong>Tarifa:</strong></h2><?
$tarifa = number_format($_GET['valor']*0.027); echo number_format(($_GET['valor']*0.027), 2, ',', '.'); ?><br />
<h2 style="color:#F00;"><strong>Valor a ser registrado:</strong></h2>
<span style="color:#F90;"><? echo number_format((($_GET['valor']*0.027)+$_GET['valor']), 2, ',', '.'); ?></span>
<br />
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="input" type="submit" name="confirmar" value="Confirmar" />
</form>
<? if(isset($_POST['confirmar'])){
	
$tarifa = 0;
$valor = $_GET['valor'];
$banco_emissor_cartao = $_GET['banco'];

$tarifa = $_GET['valor']*0.027;

$bandeira = $_GET['bandeira'];
$cliente = $_GET['cliente'];

$valor_cobrado = (($_GET['valor']*0.027)+$_GET['valor']);

$sql_saque = mysqli_query($conexao_bd, "INSERT INTO saques (codeCaixa, turno, dia, mes, ano, data, data_completa, ip, cliente, operador, valor, banco, bandeira_cartao, tarifa, valor_cobrado) VALUES ('$codeCaixa', '$turno', '$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$cliente', '$operador', '$valor', '$banco_emissor_cartao', '$bandeira', '$tarifa', '$valor_cobrado')");
echo "<script language='javascript'>window.location='?valor=$valor&banco=$banco_emissor_cartao&bandeira=$bandeira&cliente=$cliente&tarifa=$tarifa&p=3';</script>";
}


  $valor_pontos = $_GET['valor'];
  $novos_pontos = 0;
  $vestepoint = 0;
  $cliente = 0;
  
  
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente
  
  
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = $valor_pontos/2;
		}elseif($categoria == 'platinum'){
			$novos_pontos = $valor_pontos/3;
		}elseif($categoria == 'gold'){
			$novos_pontos = $valor_pontos/3.5;
		}else{
			$novos_pontos = $valor_pontos/5;
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'SAQUE NO CARTAO DE DEBITO', '$operador', '$novos_pontos', '$valor_pontos', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cliente'");
  
?>



<? } ?>



<? if($_GET['p'] == '3'){ ?>
<hr />
<br />
<br />
<br />
<br />
<br />
<script language="javascript">
		function dados_deposito(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=335,height=400');
		}
	</script>
<a class="a" onclick="dados_deposito('scripts/comprovante_saque.php?nome_operador=<? echo $nome; ?>&tarifa=<? echo $_GET['tarifa']; ?>&cliente=<? echo $_GET['cliente']; ?>&cpf_operador=<? echo $operador; ?>&valor=<? echo $_GET['valor']; ?>');" href="saque_de_cartao.php?p=">EMITIR COMPROVANTE DE SAQUE</a>
<? } ?>



</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>