<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/recarga_de_celular.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>
<h1><strong>SELECIONE A OPERADORA</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select class="select" name="operadora" autofocus>
  <option value="CLARO">CLARO</option>
  <option value="VIVO">VIVO</option>
  <option value="TIM">TIM</option>
 </select>
 <input class="botao_avancar" type="submit" name="avancar" value="Avançar" />
</form>
<br />
<? if(isset($_POST['avancar'])){
	
$operadora = $_POST['operadora'];

echo "<script language='javascript'>window.location='?p=2&operadora=$operadora';</script>";

}?>

<? }// pagamentos 1 ?>


<? if($_GET['p'] == '2'){ ?>
<? if(isset($_POST['enviar'])){
	
$numero1 = $_POST['numero1'];
$nsu = $_POST['nsu'];
$valor_recarga = $_POST['valor_recarga'];
$processamento = $_POST['processamento'];
$pagamento = $_POST['pagamento'];
$operadora = $_GET['operadora'];

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
echo "<script language='javascript'>window.location='?p=3&operadora=$operadora&numero1=$numero1&nsu=$nsu&valor_recarga=$valor_recarga&processamento=$processamento&pagamento=$pagamento&cliente=$cliente';</script>";
}elseif($pagamento != 'VESTE PRIME'){
echo "<script language='javascript'>window.location='?p=3&operadora=$operadora&numero1=$numero1&nsu=$nsu&valor_recarga=$valor_recarga&processamento=$processamento&pagamento=$pagamento&cliente=$cliente';</script>";
 }
}?>
<h1><strong>DIGITE O NÚMERO DO CELULAR QUE RECEBERÁ O CRÉDITO</strong></h1>
<hr />
<form name="enviar" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td align="right" colspan="2">NÚMERO DO CELULAR</td>
    <td width="280"><label for="textfield"></label>
      <span id="sprytextfield111111">
        <input class="valores" type="text" name="numero1" id="textfield3" autofocus />
      </span></td>
  </tr>
  <tr>
    <td align="right" colspan="2">VALOR DA RECARGA</td>
    <td>
      <select name="valor_recarga" size="1" id="pagamento">
      <?
      $sql_recarga = mysqli_query($conexao_bd, "SELECT * FROM valores_recarga  WHERE operadora = '".$_GET['operadora']."'");
	  	while($res_recarga = mysqli_fetch_array($sql_recarga)){
	  ?>
        <option value="<? echo $res_recarga['valor']; ?>"><? echo $res_recarga['valor']; ?></option>
      <? } ?>
      </select>
   </td>
  </tr>
  <tr>
    <td align="right" colspan="2">PROCESSAMENTO DE RECARGA</td>
    <td><label for="select"></label>
      <select name="processamento" size="1" id="select">
        <option value="MAQUINA BANCO DO BRASIL">1 - MAQUINA BANCO DO BRASIL</option>
        <option value="RECARGAPAY">2 - RECARGAPAY</option>
        <option value="OUTROS">3 - OUTROS</option>
      </select></td>
  </tr>
  <tr>
    <td align="right" colspan="2">FORMA DE PAGAMENTO</td>
    <td>
      <select name="pagamento" size="1">
        <option value="VESTE PRIME">1- VESTE PRIME CARD</option>
        <option value="DINHEIRO">2 - DINHEIRO</option> 
        <option value="TRANSFERENCIA">3 - PIX/TRANSFERENCIA</option>
        <option value="CARTAO DE CREDITO">4 - CART&Atilde;O DE CR&Eacute;DITO</option>
        <option value="CARTAO DE DEBITO">5 - CART&Atilde;O DE D&Eacute;BITO</option>
        <option value="M12">6 - AUTORIZA&Ccedil;&Atilde;O M12</option>
      </select></td>
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

$valor_a_pagar = $_POST['valor_a_pagar'];
$taxa = $_POST['taxa'];
$valor_recarga = $_POST['valor_recarga'];
$pagamento = $_POST['pagamento'];
$cliente = $_GET['cliente'];
$processamento = $_GET['processamento'];
$operadora = $_GET['operadora'];
$nsu = $_POST['nsu'];
$numero1 = $_GET['numero1'];
$lucro = 0;
$senha = $_POST['senha'];

if($nsu <=0 || $nsu == NULL){
	echo "<script language='javascript'>window.alert('O NSU deve ser informado!');</script>";
}else{

if($processamento == 'RECARGAPAY'){
	if($operadora == 'OI'){
	  $lucro = $valor_recarga*0.02;
	}elseif($operadora == 'CLARO'){
	  $lucro = $valor_recarga*0.02;
	}else{
	  $lucro = $valor_recarga*0.05;
	}
}else{
	$lucro = $valor_recarga*0.02;
}

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
			mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, 	valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$nsu', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'RECARGA DE CELULAR PRÉ-PAGO', '$valor_a_pagar', '', '', '$valor_a_pagar', '$cliente', '$nsu', '', '$operador')");
			mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$nsu', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1', '1', '$valor_a_pagar', '$valor_a_pagar', '')");
			$passa = 1;
		}
  }
 }
}

if($pagamento != 'VESTE PRIME'){
	$passa = 1;
}

if($passa == 1){
$sql_taxas = mysqli_query($conexao_bd, "INSERT INTO recarga_prepago (codeCaixa, turno, data, data_completa, d, m, a, ip, processamento, nsu, operador, status, cliente, forma_pagamento, valor, tarifa, autenticacao, operadora, numero, lucro) VALUES ('$codeCaixa', '$turno', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$processamento', '$nsu', '$operador', 'Ativo', '$cliente', '$pagamento', '$valor_recarga', '$taxa', '$autenticacao', '$operadora', '$numero1', '$lucro')");

if($sql_taxas == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao informar recarga, por favor, tente novamente!');</script>";
}else{
	   mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'RECARGA DE CELULAR', 'Informado a recarga de celular $valor_recarga para o telefone $numero1', '$url')");

	
  ?>
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=450');
		}
	</script>
<a class="a" onclick="abrePopUps('scripts/comprovante_de_recarga_prepago.php?cliente=<? echo $cliente; ?>&pagamento=<? echo $pagamento; ?>&autenticacao=<? echo $autenticacao; ?>&operadora=<? echo $operadora; ?>&numero=<? echo $numero1; ?>&nsu=<? echo $nsu; ?>&tarifa=<? echo $taxa; ?>&valor_recarga=<? echo $valor_recarga; ?>');" href="?p=">IMPRIMIR COMPROVANTE DE RECARGA</a>    	

    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=460');
		}
	</script>
<? die; } }} }?>
  
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td align="center"><strong>OPERADORA</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $operadora = $_GET['operadora']; ?></td>
  </tr>
  <tr>
    <td align="center"><strong>NÚMERO PARA RECARGA</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $numero1 = $_GET['numero1']; ?></td>
  </tr>
  <tr>
    <td align="center"><strong>FORMA DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $pagamento = $_GET['pagamento']; ?></td>
  </tr><input type="hidden" name="pagamento" value="<? echo $_GET['pagamento']; ?>" />
  <tr>
    <td align="center"><strong>VALOR</strong></td>
  </tr>
  <tr>
    <td align="center">R$ <? echo number_format($_GET['valor_recarga'], 2, ',', '.'); ?></td>
  </tr>
  <tr><input type="hidden" name="valor_recarga" value="<? echo $_GET['valor_recarga']; ?>" />
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
  </tr>  <input type="hidden" name="valor_a_pagar" value="<? echo $valor_a_pagar; ?>" />
  <tr>
    <td align="center"><strong>NSU DA RECARGA</strong></td>
  </tr>
  <tr>
    <td align="center"><input name="nsu" type="text" size="8" autofocus /><hr /></td>
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
var sprytextfield500 = new Spry.Widget.ValidationTextField("sprytextfield500", "custom", {useCharacterMasking:true, pattern:"00000.00000 00000.000000 00000.000000 0 00000000000000"});
var sprytextfield0616151 = new Spry.Widget.ValidationTextField("sprytextfield0616151", "custom", {pattern:"00000000000-0 00000000000-0 00000000000-0 00000000000-0", useCharacterMasking:true});
var sprytextfield151515 = new Spry.Widget.ValidationTextField("sprytextfield151515", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield260000165412 = new Spry.Widget.ValidationTextField("sprytextfield260000165412", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield111111", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield222222", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
</script>
</body>
</html>