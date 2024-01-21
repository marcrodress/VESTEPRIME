<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/gift_card.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>
<h1><strong>SELECIONE O GIFT CARD</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select class="select" name="gift" autofocus>
  <option value="GOOGLE PLAY">GOOGLE PLAY</option>
  <option value="XBOX LIVE">XBOX LIVE</option>
  <option value="XBOX LIVE - LEAGUE OF LEGENDS">XBOX LIVE - LEAGUE OF LEGENDS</option>
  <option value="XBOX LIVE - STEAM">XBOX LIVE - STEAM</option>
  <option value="LEVEL UP">LEVEL UP</option>
  <option value="LEVEL UP - LEAGUE OF LEGENDS">LEVEL UP - LEAGUE OF LEGENDS</option>
  <option value="LEVEL UP - STEAM">LEVEL UP - STEAM</option>
  <option value="RIXTY - LEAGUE OF LEGENDS">RIXTY - LEAGUE OF LEGENDS</option>
  <option value="RIXTY - STEAM">RIXTY - STEAM</option>
 </select>
 <input class="botao_avancar" type="submit" name="avancar" value="Avançar" />
</form>
<br />
<? if(isset($_POST['avancar'])){
	
$gift = $_POST['gift'];

echo "<script language='javascript'>window.location='?p=2&gift=$gift';</script>";

}?>

<? }// pagamentos 1 ?>







<? if($_GET['p'] == '2'){ ?>
<h1><strong>COMPLETE AS INFORMAÇÕES NECESSÁRIAS</strong></h1>
<hr />
<? if(isset($_POST['enviar'])){
	
$valor_recarga = $_POST['valor'];
$processamento = $_POST['processamento'];
$gift_card = $_POST['gift_card'];
$pagamento = $_POST['pagamento'];

$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente


$passa = 0;

	if($pagamento == 'VESTE PRIME'){
	 if($cliente == 0){
		echo "<script language='javascript'>window.alert('Cliente não encontrado!');</script>";
	 }else{
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_verifica_limite = mysqli_fetch_array($sql_cliente)){
			$limite_cliente = $res_verifica_limite['limite_loja_disponivel'];
			if($valor_recarga > $limite_cliente){
				echo "<script language='javascript'>window.alert('Cliente não possui limite disponível para efetuar essa compra!');</script>";
			}else{
				$passa = 1;
			}
	  }
	 }
	}

if($pagamento == 'VESTE PRIME' && $passa == 1){
  echo "<script language='javascript'>window.location='?p=3&valor_recarga=$valor_recarga&processamento=$processamento&gift_card=$gift_card&pagamento=$pagamento&cliente=$cliente';</script>";
}elseif($pagamento != 'VESTE PRIME'){
  echo "<script language='javascript'>window.location='?p=3&valor_recarga=$valor_recarga&processamento=$processamento&gift_card=$gift_card&pagamento=$pagamento&cliente=$cliente';</script>";
 }
}?>
<form name="enviar" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td align="right" colspan="2">VALOR</td>
    <td width="280">
        <? if($_GET['gift'] == 'GOOGLE PLAY'){ ?>
      <span id="sprytextfield111111">
        <input class="valores" type="number" name="valor" id="textfield3" autofocus />
      </span>
      <? }else{ ?>
      <select name="valor" size="1" id="pagamento">
      <?
      $sql_gift = mysqli_query($conexao_bd, "SELECT * FROM valores_gift_card WHERE gift = '".$_GET['gift']."'");
	  	while($res_gift = mysqli_fetch_array($sql_gift)){
	  ?>
        <option value="<? echo $res_gift['valor']; ?>"><? echo $res_gift['valor']; ?></option>
      <? } ?>
      </select>	
       <? } ?>      
      </td>
  </tr>
  <tr>
    <td align="right" colspan="2">GIFT CARD</td>
    <td>
      <select name="gift_card" size="1" id="pagamento">
        <option value="<? echo $_GET['gift']; ?>"><? echo $_GET['gift']; ?></option>
      </select>
   </td>
  </tr>
  <tr>
    <td align="right" colspan="2">FORMA DE PROCESSAMENTO</td>
    <td>
      <select name="processamento" size="1">
        <option value="RECARGAPAY">RECARGAPAY</option>
        <option value="CELCOIN">CELCOIN</option>
        <option value="PICPAY">PICPAY</option>
      </select>
    </td>
  </tr>
  <tr>
    <td align="right" colspan="2">VALOR DA RECARGA</td>
    <td>
      <select name="pagamento" size="1">
        <option value="DINHEIRO">DINHEIRO</option>
        <option value="VESTE PRIME">VESTE PRIME CARD</option>
        <option value="CARTAO DE CREDITO">CART&Atilde;O DE CR&Eacute;DITO</option>
        <option value="CARTAO DE DEBITO">CART&Atilde;O DE D&Eacute;BITO</option>
      </select>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center" width="354"><hr /><input class="botao_avancar2" type="submit" name="enviar" value="Enviar"></td>
  </tr>
</table>
</form>
<? } // FECHA SESSÃO 2 ?>








<? if($_GET['p'] == '3'){ ?>
<h1><strong>VERIFIQUE AS INFORMAÇÕES A SEGUIR E CONFIRME</strong></h1>
<hr />
<? if(isset($_POST['button'])){

$taxa = $_POST['taxa'];
$gift_card = $_GET['gift_card'];
$valor_recarga = $_GET['valor_recarga'];
$pagamento = $_GET['pagamento'];
$cliente = $_GET['cliente'];
$processamento = $_GET['processamento'];
$nsu = $_POST['nsu'];
$lucro = 0;
$senha = $_POST['senha'];
$valor_a_pagar = $_POST['valor_a_pagar'];


$lucro = $valor_recarga*0.02;


$autenticacao = md5($valor_recarga*$nsu);
$limite_atual = 0;
$novo_limite = 0;


$passa = 0;
if($pagamento == 'VESTE PRIME'){
 $sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
  if(mysqli_num_rows($sql_verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('Senha não confere!');</script>";
  }else{
	$sql_verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	if(mysqli_num_rows($sql_verifica_limite) == ''){
		echo "<script language='javascript'>window.alert('Ocorreu um erro ao localizar cliente, por favor, tente novamente!');</script>";
	}else{
		while($res_conta_corrente = mysqli_fetch_array($sql_verifica_limite)){
			$limite_atual = $res_conta_corrente['limite_loja_disponivel'];
			$novo_limite = $limite_atual-$valor_recarga;
			mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$novo_limite' WHERE cliente = '$cliente'");
			mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, 	valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$nsu', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'GIFT CARD', '$valor_a_pagar', '', '', '$valor_a_pagar', '$cliente', '$nsu', '', '$operador')");
			mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$nsu', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1', '1', '$valor_a_pagar', '$valor_a_pagar', '$cliente')");
			$passa = 1;
		}
  }
 }
}

if($pagamento != 'VESTE PRIME'){
	$passa = 1;
}



if($passa == 1){
$sql_taxas = mysqli_query($conexao_bd, "INSERT INTO gift_card (codeCaixa, turno, data, data_completa, dia, mes, ano, ip, operador, status, cliente, forma_pagamento, valor, tarifa, autenticacao, gift, pin, processamento, lucro) VALUES ('$codeCaixa', '$turno', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'Ativo', '$cliente', '$pagamento', '$valor_recarga', '$taxa', '$autenticacao', '$gift_card', '$nsu', '$processamento', '$lucro')");
if($sql_taxas == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao informar recarga, por favor, tente novamente!');</script>";
}else{
	mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$novo_limite' WHERE cliente = '$cliente'");
  ?>
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=450');
		}
	</script>
<a class="a" onclick="abrePopUps('scripts/comprovante_de_recarga_gift_card.php?cliente=<? echo $cliente; ?>&pagamento=<? echo $pagamento; ?>&autenticacao=<? echo $autenticacao; ?>&gift_card=<? echo $gift_card; ?>&nsu=<? echo $nsu; ?>&tarifa=<? echo $taxa; ?>&valor_recarga=<? echo $valor_recarga; ?>');" href="?p=">IMPRIMIR COMPROVANTE DE GIFTCARD</a>

    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=460');
		}
	</script>
<? die; } } } ?>
  
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td align="center"><strong>FORMA DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $pagamento = $_GET['pagamento']; ?></td>
  </tr>
  <tr>
    <td align="center"><strong>GIFT CARD</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $_GET['gift_card']; ?></td>
  </tr>
  <tr>
    <td align="center"><strong>VALOR</strong></td>
  </tr>
  <tr>
    <td align="center">R$ <? echo number_format($_GET['valor_recarga'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center"><strong>TAXAS/TARIFAS</strong></td>
  </tr>
  <tr>
    <td align="center">R$ 
	<? 
	if($pagamento == 'CARTAO DE CREDITO'){ 
		$taxa = $_GET['valor_recarga']*0.05; 
	}elseif($pagamento == 'CARTAO DE DEBITO'){ 
		$taxa = $_GET['valor_recarga']*0.03;
	}elseif($pagamento == 'VESTE PRIME'){ 
		$taxa = $_GET['valor_recarga']*0.07;
	}else{
		$taxa = $_GET['valor_recarga']*0.00;
	} 
		echo number_format($taxa, 2, ',', '.'); 		
	?></td>
  </tr><input type="hidden" name="taxa" value="<? echo $taxa; ?>" />
  <tr>
    <td align="center"><strong>VALOR A RECEBER</strong></td>
  </tr>
  <tr>
    <td align="center">R$ <? $valor_a_pagar = $_GET['valor_recarga']+$taxa;  echo number_format($valor_a_pagar, 2, ',', '.'); ?></td>
  </tr> <input type="hidden" name="valor_a_pagar" value="<? echo $valor_a_pagar; ?>" />
  <tr>
    <td align="center"><strong>PIN DA RECARGA</strong></td>
  </tr>
  <tr>
    <td align="center"><input name="nsu" type="text" size="8" autofocus/><hr /></td>
  </tr>
  <? if($pagamento == 'VESTE PRIME'){ ?>
  <tr>
    <td align="center"><strong>SENHA VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td align="center"><input name="senha" type="password" size="3" /><hr /></td>
  </tr>
  <? } ?>
  <tr>
    <td align="center">
    <input class="botao_avancar" type="submit" name="button" value="Confirmar">
    </td>
  </tr>
  </table>
</form>
<? } // FECHA SESSÃO 3 ?>



</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield111111", "custom", {useCharacterMasking:true});
</script>
</body>
</html>