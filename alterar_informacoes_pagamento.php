<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/alterar_informacoes_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<? if($_GET['pg'] == 'cancela'){
	
$code_carrinho = $_GET['code_carrinho'];
mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status = 'CANCELADO', status_pagamento = 'CANCELADO', status_entrega = 'CANCELADO' WHERE code_carrinho = '$code_carrinho'");

echo "<script language='javascript'>window.alert('COMPRA CANCELADA COM SUCESSO!!!');window.location='pedidos_da_loja_virtual.php?cate=8415';</script>";

}?>

 <?
 
$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente 
 
 $code_carrinho = $_GET['carrinho'];
 $id_produto = $_GET['produto'];
  $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM loja_online_produto WHERE id = '$id_produto'");
  while($res_produto = mysqli_fetch_array($sql_produtos)){
	$valor_produto = $res_produto['valor_venda'];
  $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM loja_online_carrinho WHERE code_carrinho = '$code_carrinho'");
  if(mysqli_num_rows($sql_carrinho) == ''){
	  echo "<script language='javascript'>window.location='';</script>";
  }else{
 	while($res_carrinho = mysqli_fetch_array($sql_carrinho)){ $code_carrinho = $res_carrinho['code_carrinho'];
 ?>
<div id="box_pagamento_1">
<?
  $soma_pagamentos = 0;
   $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '$code_carrinho'");
    while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ $i++;
	$soma_pagamentos = $res_pagamento['valor']+$soma_pagamentos;
	}
?>
<table style="margin:5px;" width="1000" border="0">
  <tr>
    <td width="154" rowspan="2"><img src="<? echo $res_produto['img']; ?>" width="150" height="150" /></td>
    <td colspan="3"><h1 style="font:30px Arial, Helvetica, sans-serif; color:#09C; text-transform:none; text-align:justify;"><strong><? echo $res_produto['titulo']; ?></strong></h1></td>
  </tr>
  <tr>
    <td width="269">Quantidade: <? echo $res_carrinho['quantidade']; ?></td>
    <td width="327">Valor unit&aacute;rio: R$ <? echo number_format($res_produto['valor_venda'],2,',','.'); ?></td>
    <td width="232">Valor total: R$ <? echo number_format($res_carrinho['valor_total'],2,',','.'); ?></td>
  </tr>
</table>
<hr />

<div id="box_pagamento">
 
 <div id="box_pagamento_right">
 
 <? if($_GET['pag_form'] == ''){ ?>
 
 <? if(isset($_POST['valor_pag'])){
  	 
  $pag_form = $_POST['pag_form']; 	 
  $valor_pag = $_POST['valor_pag'];
  $id_produto = $_GET['produto'];
  $falta = $_POST['falta'];
  $troco = $valor_pag-$falta;
  if($troco <=0){
  	$troco = 0;
  }else{
	  $troco = $troco;
  }
  $salda_devedor = $res_carrinho['valor_total']-$soma_pagamentos;
  
  if(($valor_pag > $salda_devedor && $pag_form == 'VESTE PRIME') || ($valor_pag > $salda_devedor && $pag_form == 'CARTAO DE CREDITO')){
	  echo "<script language='javascript'>window.alert('NÃO É POSSÍVEL PAGAR MAIS QUE O SALDO DEVEDOR!');</script>";
  }elseif(($salda_devedor <=0 && $pag_form == 'VESTE PRIME') || ($salda_devedor <=0 && $pag_form == 'CARTAO DE CREDITO')){
	  echo "<script language='javascript'>window.alert('PRODUTO JÁ FOI PAGO!');</script>";
  }else{
	  
	  if($pag_form == 'DINHEIRO'){
	   mysqli_query($conexao_bd, "INSERT INTO loja_online_pagamentos (data, dia, mes, ano, status, operador, forma_pagamento, code_carrinho, cliente, valor, valor_parcela, valor_total, bandeira, parcela, numero_cartao, vencimento, ccv, troco) VALUES ('$data', '$dia', '$mes', '$ano', 'AGUARDA', '$operador', 'DINHEIRO', '$code_carrinho', '$cliente', '$valor_pag', '$valor_parcela', '$valor_total', 'VESTE PRIME', '$parcela', '$numero_cartao', '$vencimento', '$ccv', '$troco')");
	   
	   echo "<script language='javascript'>window.location='?produto=$id_produto&carrinho=$code_carrinho';</script>";
	   
	  }elseif($pag_form == 'VESTE PRIME'){
		$limite_bandeirado = 0;
		$sql_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_limite = mysqli_fetch_array($sql_limite)){
			 $limite_bandeirado = $res_limite['limite_bandeirado_disponivel'];
		 }
		 if($valor_pag > $limite_bandeirado){
		  echo "<script language='javascript'>window.alert('LIMITE INSUFICIENTE!');</script>";
		 }else{
			 $limite_bandeirado_disponivel = $limite_bandeirado-$valor_pag;
		  echo "<script language='javascript'>window.location='?produto=$id_produto&pag_form=$pag_form&valor=$valor_pag&limite_bandeirado=$limite_bandeirado_disponivel&carrinho=$code_carrinho';</script>";
		 }
	  }elseif($pag_form == 'CARTAO DE CREDITO'){
		  echo "<script language='javascript'>window.location='?produto=$id_produto&pag_form=$pag_form&valor=$valor_pag&carrinho=$code_carrinho';</script>";
	  }
    } // VERICA SE O CLIENTE QUER PAGAR UM SALDO MENOR QUE O DEVEDOR
  }?> 
 
  <form name="" method="post" action="" enctype="multipart/form-data">
   <h1 style="font:15px Arial, Helvetica, sans-serif; margin:5px;"><strong>Forma de pagamento</strong></h1>
   <select style="font:18px Arial, Helvetica, sans-serif; width:360px; color:#F90; padding:10px; margin:5px; border-radius:5px; border:1px solid #999;" name="pag_form" size="1">
     <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
     <?
      
	  $limite_bandeirado = 0;
  	$sql_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	 while($res_limite = mysqli_fetch_array($sql_limite)){
		 $limite_bandeirado = $res_limite['limite_bandeirado_disponivel'];
	 }
	 if($limite_bandeirado >=1){
	 ?>
     <option value="VESTE PRIME">VESTE PRIME</option>
     <? } ?>
     
     
     <option value="DINHEIRO">DINHEIRO</option>
   </select>
   <input  style="font:18px Arial, Helvetica, sans-serif; width:80px; text-align:center; color:#F90; padding:10px; margin:5px; border-radius:5px; border:1px solid #999;" type="text" name="valor_pag" value="<? if($res_carrinho['valor_total']-$soma_pagamentos <=0){echo "0.00";}else{ echo $res_carrinho['valor_total']-$soma_pagamentos; }?>" />
   <input type="hidden" name="falta" value="<? if($res_carrinho['valor_total']-$soma_pagamentos <=0){echo "0.00";}else{ echo $res_carrinho['valor_total']-$soma_pagamentos; }?>" />
  </form>
  <? }else{?>  <a style="font:15px Arial, Helvetica, sans-serif; padding:5px; background:#090; text-transform:none; text-decoration:none; border:1px solid #000; color:#FFF;" href="?produto=<? echo $_GET['produto']; ?>&carrinho=<? echo $_GET['carrinho']; ?>">Voltar</a> <? }?>
  
  <hr />

  <? if($_GET['pag_form'] == 'VESTE PRIME'){ $valor_pag = $_GET['valor']; ?>
  
  <? if(isset($_POST['avancar'])){
   
   $parcela = $_POST['parcela'];
   if($parcela <13){
   $valor_parcela = (($valor_pag*0.025*$parcela)+$valor_pag)/$parcela;
   }else{
   $valor_parcela = (($valor_pag*0.05*$parcela)+$valor_pag)/$parcela;
   }
   
   
   $valor_total = $valor_parcela*$parcela;
   $limite_bandeirado = $_GET['limite_bandeirado'];
   
   
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela) VALUES ('$code_carrinho', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'FINANCIAMENTO DE PRODUTOS: $code_carrinho', '$valor_total', '$code_carrinho', '$cliente', '', '', '')");

  for($k=1; $k<=$parcela; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_carrinho', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME ONLINE', '$k/$parcela', '$k', '$parcela', '$valor_parcela', '')");
  }   
   
   mysqli_query($conexao_bd, "INSERT INTO loja_online_pagamentos (data, dia, mes, ano, status, operador, forma_pagamento, code_carrinho, cliente, valor, valor_parcela, valor_total, bandeira, parcela, numero_cartao, vencimento, ccv, troco) VALUES ('$data', '$dia', '$mes', '$ano', 'AGUARDA', '$operador', 'VESTE PRIME', '$code_carrinho', '$cliente', '$valor_pag', '$valor_parcela', '$valor_total', 'VESTE PRIME', '$parcela', '$numero_cartao', '$vencimento', '$ccv', '0')");
   
   mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_bandeirado_disponivel = '$limite_bandeirado' WHERE cliente = '$cliente'");
	
	$produto = $_GET['produto'];
	
	

  ?>
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a style="font:12px Arial, Helvetica, sans-serif; float:left; padding:10px; margin:50px 10px 10px 0; background:#960; text-decoration:none; color:#FFF; border:2px solid #000;" onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcela; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="?produto=<? echo $_GET['produto']; ?>&carrinho=<? echo $code_carrinho; ?>">Assinar comprovante</a>
  
  <? die;}?>
  
  <form action="" enctype="multipart/form-data" method="post">
  <h1 style="font:12px Arial, Helvetica, sans-serif; color:#960;">
  <? for($i=9; $i<=24; $i++){ ?>
    <? if($i <13){ ?>
	<input type="radio" name="parcela" value="<? echo $i; ?>" /><strong> <? echo $i; ?> X <? echo number_format((($valor_pag*0.025*$i)+$valor_pag)/$i,2,',','.'); ?>  fixas</strong>
    <br />
    <? }else{ ?>
	<input type="radio" name="parcela" value="<? echo $i; ?>" /><strong> <? echo $i; ?> X <? echo number_format((($valor_pag*0.05*$i)+$valor_pag)/$i,2,',','.'); ?>  fixas</strong>
    <br />    
    <? } ?>
    
  <? } ?></h1>
  <input style="width:100px; padding:10px; cursor:pointer; border:1px solid #000; border-radius:5px;" type="submit" name="avancar" value="Avançar" />
  </form>  
  
  <? } ?>












  <? if($_GET['pag_form'] == 'CARTAO DE CREDITO'){ $valor_pag = $_GET['valor']; $code_carrinho = $_GET['carrinho']; ?>
  
  <? if(isset($_POST['avancar'])){
	  
   $bandeira = $_POST['bandeira'];
   $parcela = $_POST['parcela'];
   
    echo "<script language='javascript'>window.location='?produto=$id_produto&pag_form=CARTAO DE CREDITO2&valor=$valor_pag&bandeira=$bandeira&parcela=$parcela&carrinho=$code_carrinho';</script>";


  }?>
  <form action="" enctype="multipart/form-data" method="post">
  <select style="font:15px Arial, Helvetica, sans-serif; width:490px; color:#090; padding:10px;" name="bandeira" size="1">
    <option value="MASTERCARD">MASTERCARD</option>
    <option value="VISA">VISA</option>
    <option value="ELO">ELO</option>
    <option value="HIPERCARD">HIPERCARD</option>
    <option value="AMERICA EXPRESS">AMERICA EXPRESS</option>
    <option value="DINERS">DINERS</option>
  </select>
  <h1 style="font:19px Arial, Helvetica, sans-serif; color:#960;">
  <? for($i=1; $i<=10; $i++){ if($valor_pag/$i >=20){ ?>
    
	<input type="radio" name="parcela" value="<? echo $i; ?>" /> <? echo $i; ?> X <? echo number_format($valor_pag/$i,2,',','.'); ?>  sem juros
    <br />
  <? }} ?></h1>
  <input style="width:100px; padding:10px; cursor:pointer; border:1px solid #000;" type="submit" name="avancar" value="Avançar" />
  </form>
  <? } // CARTAO DE CREDITO ?>
  
  
  
  
  
  
  <? if($_GET['pag_form'] == 'CARTAO DE CREDITO2'){ $valor_pag = $_GET['valor']; $bandeira = $_GET['bandeira']; $parcela = $_GET['parcela']; ?>
  <? if(isset($_POST['avancar'])){
	  
   $numero_cartao = $_POST['numero_cartao'];
   $vencimento = $_POST['vencimento'];
   $ccv = $_POST['ccv'];
   
   mysqli_query($conexao_bd, "INSERT INTO loja_online_pagamentos (data, dia, mes, ano, status, operador, forma_pagamento, code_carrinho, cliente, valor, bandeira, parcela, numero_cartao, vencimento, ccv, troco) VALUES ('$data', '$dia', '$mes', '$ano', 'AGUARDA', '$operador', 'CARTAO DE CREDITO', '$code_carrinho', '$cliente', '$valor_pag', '$bandeira', '$parcela', '$numero_cartao', '$vencimento', '$ccv', '0')");
    
	$produto = $_GET['produto'];
    echo "<script language='javascript'>window.location='?produto=$produto&carrinho=$code_carrinho';</script>";
	
	
  
  }?>
  
  
    <form name="" method="post" enctype="multipart/form-data" action="">
    <h1 style="font:15px Arial, Helvetica, sans-serif; color:#999;">
    <strong> Número do cartão:</strong><br />
    <span id="sprytextfield161665df">
    <input style="border:1px solid #CCC; font:25px Arial, Helvetica, sans-serif; width:400px; padding:20px; color:#F90; border-radius:10px;" type="text" name="numero_cartao" /><br />
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
    <strong>Data de validade do cartão:</strong><br />
    <span id="sd651f5sdf">
    <input style="border:1px solid #CCC; font:25px Arial, Helvetica, sans-serif; width:100px; padding:20px; color:#F90; border-radius:10px;" type="text" name="vencimento" />
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span><br />
    <strong>Código de segurança:</strong><br />
    <span id="sadf4s">
    <input style="border:1px solid #CCC; font:25px Arial, Helvetica, sans-serif; width:50px; padding:20px; color:#F90; border-radius:10px;" type="text" name="ccv" />
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">.</span></span></h1>
  	<input style="border:1px solid #CCC; font:25px Arial, Helvetica, sans-serif; width:150px; padding:20px; color:#F90; border-radius:10px;" type="submit" name="avancar" value="Confirmar" />   
    </form>
  <? } // informar os dados do cartao de credito ?>  
  
  
  
  
  
 </div><!-- box_pagamento_1 -->
 
 <div id="box_pagamento_left">
<table width="450" style="text-align:center;" border="0">
  <tr>
    <td colspan="2" bgcolor="#009900"><h1 style="font:30px Arial, Helvetica, sans-serif; text-transform:uppercase; margin:0;"><strong>VALOR TOTAL: R$ <? echo number_format($res_carrinho['valor_total'],2,',','.'); ?></strong></h1></td>
  </tr>
  <tr>
    <td width="218" bgcolor="#FFFFC6"><strong>VALOR PAGO</strong></td>
    <td width="222" bgcolor="#FFFFC6"><strong>DESCONTOS</strong></td>
  </tr>
  <?
  $soma_pagamentos = 0;
   $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '$code_carrinho'");
    while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ $i++;
	$soma_pagamentos = $res_pagamento['valor']+$soma_pagamentos;
	}
  ?>  
  <tr>
    <td height="21"><strong>R$ <? echo number_format($soma_pagamentos,2,',','.'); ?></strong></td>
    <td><strong>R$ <? echo number_format($res_carrinho['valor_total']*0.3,2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFFFC6"><strong>FALTA PAGAR: R$ <? if($res_carrinho['valor_total']-$soma_pagamentos <=0){echo "0,00";}else{  echo number_format($res_carrinho['valor_total']-$soma_pagamentos,2,',','.'); } ?></strong></td>
  </tr>
  <tr>
    <td height="20" colspan="2"><strong>TROCO: R$ <? if($soma_pagamentos-$res_carrinho['valor_total'] >0){echo number_format($soma_pagamentos-$res_carrinho['valor_total'],2,',','.'); }else{echo number_format(0,2,',','.');} ?></strong></td>
  </tr>
  </table>
  
 <hr />
  <table width="450" style="text-align:center;" border="0">
  <tr>
    <td width="151" bgcolor="#CEE7FF"><strong>FORMA DE PAGAMENTO</strong></td>
    <td width="68" bgcolor="#CEE7FF"><strong>VALOR</strong></td>
    <td width="60" bgcolor="#CEE7FF"><strong>PARCELA</strong></td>
    <td width="56" bgcolor="#CEE7FF"><strong>TROCO</strong></td>
    <td width="66" bgcolor="#CEE7FF"><strong>STATUS</strong></td>
    <td width="23" bgcolor="#CEE7FF">&nbsp;</td>
  </tr>
  <?
  $soma_pagamentos = 0;
   $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '$code_carrinho'");
    while($res_pagamento = mysqli_fetch_array($sql_pagamento)){ $i++;
	$soma_pagamentos = $res_pagamento['valor']+$soma_pagamentos;
  ?>  
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_pagamento['forma_pagamento']; ?></td>
    <td>R$ <? echo number_format($res_pagamento['valor'],2,',','.'); ?></td>
    <td><? echo $res_pagamento['parcela']; ?></td>
    <td>R$ <? echo number_format($res_pagamento['troco'],2,',','.'); ?></td>
    <td><? echo $res_pagamento['status']; ?></td>
    <td>
    
    <? if($res_pagamento['status'] != 'APROVADO'){ ?>
    <a href="?produto=<? echo $_GET['produto']; ?>&pg=excluir&id_pag=<? echo $res_pagamento['id']; ?>&forma_pagamento=<? echo $res_pagamento['forma_pagamento']; ?>&valor=<? echo $res_pagamento['valor']; ?>&carrinho=<? echo $code_carrinho; ?>"><img src="img/deleta.jpg" width="18" height="18" border="0"></a>
    <? } ?>
    
    
    </td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td>
    <? if($soma_pagamentos <=0){ ?>
    <a style="font:15px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:10px; background:#F00; color:#FFF; text-decoration:none; float:left; border:2px solid #666;" href="?produto=<? echo $_GET['produto']; ?>&code_carrinho=<? echo $code_carrinho; ?>&pg=cancela" title="Cancelar compra e voltar a loja online">Cancelar</a>
    <? } ?>    
    </td>
    <td colspan="5">
     <? if($soma_pagamentos-$res_carrinho['valor_total'] >=0.001){ ?>
    <a style="font:15px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:10px; background:#090; color:#FFF; text-decoration:none; float:right; border:2px solid #666;" href="?pg=confirma&code_carrinho=<? echo $code_carrinho; ?>" title="Finalizar compra do produto">Finalizar</a>
    <? } ?>
    </td>
  </tr>
 </table>
 </div><!-- box_pagamento_left -->
 
</div><!-- box_pagamento -->

</div><!-- box_pagamento_1 -->


<? if($_GET['pg'] == 'excluir'){
	
$id_pag = $_GET['id_pag'];
$produto = $_GET['produto'];
$forma_pagamento = $_GET['forma_pagamento'];
$code_carrinho = $_GET['carrinho'];
$valor = $_GET['valor'];

		$limite_bandeirado = 0;
		$sql_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_limite = mysqli_fetch_array($sql_limite)){
			 $limite_bandeirado = $res_limite['limite_bandeirado_disponivel'];
		 }
		$limite_bandeirado = $limite_bandeirado+$valor;

mysqli_query($conexao_bd, "DELETE FROM compras_parceladas WHERE code_transacao = '$code_carrinho'");
mysqli_query($conexao_bd, "DELETE FROM lancamento_fatura WHERE code_transacao = '$code_carrinho'");
mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_bandeirado_disponivel = '$limite_bandeirado' WHERE cliente = '$cliente'");
mysqli_query($conexao_bd, "DELETE FROM loja_online_pagamentos WHERE id = '$id_pag'");

echo "<script language='javascript'>window.location='?produto=$produto&carrinho=$code_carrinho';</script>";

}?>


<? }}}// descricao do produto ?>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield161665df", "custom", {pattern:"0000.0000.0000.0000", useCharacterMasking:true, validateOn:["blur"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sd651f5sdf", "custom", {pattern:"00/0000", useCharacterMasking:true, validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sadf4s", "custom", {useCharacterMasking:true, pattern:"000", validateOn:["blur"]});
</script>
</body>
</html>





<? if($_GET['pg'] == 'confirma'){
	
$code_carrinho = $_GET['code_carrinho'];

mysqli_query($conexao_bd, "UPDATE loja_online_carrinho SET status = 'ENVIADO', status_pagamento = 'AGUARDA CONFIRMACAO', status_entrega = 'AGUARDA PAGAMENTO' WHERE code_carrinho = '$code_carrinho'");
echo "<script language='javascript'>window.alert('DADOS ATUALIZADOS COM SUCESSO, O PRÓXIMO PASSO AGORA É AGUARDAR A CONFIRMAÇÃO DO PAGAMENTO DO BANCO EMISSOR DO CARTÃO DE CRÉDITO E A DISPONIBILIDADE DO ESTOQUE!');window.location='pedidos_da_loja_virtual.php';</script>";

}?>