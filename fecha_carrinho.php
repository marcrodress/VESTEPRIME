<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fecha_carrinho.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? require "topo.php"; $ainfa_falta_pagar = 0;   ?>


<? if($_GET['p'] == '21'){ ?>
<div id="box_fecha_carrinho">


<?


/*
$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos");
while($res = mysqli_fetch_array($sql_produtos)){
	mysqli_query($conexao_bd, "INSERT INTO estoque (produto, loja, estoque) VALUES ('".$res['code']."', '$filial', '1')");
}
*/



$valor_carrinho = 0;
$pagamento_carrinho = 0;
$carrinho = 0;

$puxa_valor_carrinho = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE ip = '$ip' AND status = 'Ativo'");
	while($res_valor_carrinho = mysqli_fetch_array($puxa_valor_carrinho)){
			
			$valor_carrinho = $res_valor_carrinho['valor'];
			$carrinho = $res_valor_carrinho['code_carrinho'];
			
		}
		

$puxa_pagamento_carrinho = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$carrinho'");
	while($res_pagamento_carrinho = mysqli_fetch_array($puxa_pagamento_carrinho)){
			
			$pagamento_carrinho = $res_pagamento_carrinho['valor_total']+$pagamento_carrinho;
	}
	
	if($pagamento_carrinho<$valor_carrinho){
		echo "<script language='javascript'>window.alert('Nem todos os produtos foram pagos!');window.location='fecha_carrinho.php?p=';</script>";
	}else{
	
?>


<h1 class="h1"><strong>Carrinho fechado com sucesso!</strong><hr /></h1>
  <br /><br />
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
    <form name=""><input class="a" type="submit"  onclick="abrePopUp('scripts/encerra_carrinho.php?cliente=<? echo @$cliente; ?>&valor=<? echo @$valor; ?>&cheque_especial=<? echo @$valor_debito_conta; ?>');" value="Imprimir comprovante de compra" autofocus/></form>

  <br /><br /> <br /><br />
  
  <? } ?>
  
</div><!-- box_fecha_carrinho -->
<? } ?>




<? if($_GET['p'] == ''){ $disponivel_cheque_especial = 0; $limite_loja_disponivel = 0; $saldo = 0; $code_carrinho = 0; $cliente = 0; ?>

 <?
 $seleciona_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
 if(mysqli_num_rows($seleciona_carrinho) == ''){
	 echo "<script language='javascript'>window.alert('NÃO EXISTE PRODUTO NO CARRINHO PARA SER PAGO!');window.location='carrinho.php?p=';</script>";
 }else{
    while($res_seleciona_carrinho = mysqli_fetch_array($seleciona_carrinho)){
		$code_carrinho = $res_seleciona_carrinho['code_carrinho'];
		
		$verifica_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_carrinho = '$code_carrinho' AND status = 'Ativo'");
		if(mysqli_num_rows($verifica_produtos) == ''){
	 echo "<script language='javascript'>window.alert('NÃO EXISTE PRODUTO NO CARRINHO PARA SER PAGO!');window.location='carrinho.php?p=';</script>";
		}else{
	 
 ?>









 <?
 $status_cliente = 0;
 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];
		
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
	if(mysqli_num_rows($sql_cliente) == ''){
	}else{
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$cliente = $res_cliente['cliente'];
			$status_cliente = $res_cliente['status'];

		
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
	if(mysqli_num_rows($sql_nome_cliente) == ''){
	}else{
		while($res_nome_cliente = mysqli_fetch_array($sql_nome_cliente)){
			$nome_cliente = $res_nome_cliente['nome'];	
 ?>
 <h1><strong> </strong><strong class="strong"><?  $nome_cliente; ?></strong>
<strong></strong><strong class="strong"><? $res_cliente['categoria']; ?></strong>         <strong class="strong2"><strong></strong></strong><strong class="strong"><? $limite_loja_disponivel = $res_cliente['limite_loja_disponivel']; number_format($res_cliente['limite_loja_disponivel'],2); ?></strong></h1>
 <h1><strong></strong><strong class="strong"> 
 <? 
  
 $saldo = number_format($res_cliente['saldo'],2);  
 $saldo2 = number_format($res_cliente['saldo'],2);  
 number_format($res_cliente['saldo'],2);
 
 if($saldo2 <0){
 	$saldo2 = 0;
 }else{
	 $saldo2 = $saldo2;
 }
 
 
 ?>
 </strong> <strong></strong><strong class="strong"><? $disponivel_cheque_especial = number_format($res_cliente['disponivel_cheque_especial'],2); ?></strong> <strong></strong><strong class="strong"><? number_format($res_cliente['disponivel_credito_pessoal'],2); ?></strong> <strong></strong><strong class="strong"><? number_format($res_cliente['disponivel_saque_facil'],2); ?></strong></h1>
 <? }}}}}} ?>


<div id="box_corpo">
 <div id="pagamento">


 <? if($_GET['pag'] == '6'){ // CARTÃO DE CRÉDITO ?>
 
 <? if(isset($_POST['avancars'])){
 
 $parcelas = $_POST['parcelas'];
 $bandeira = $_POST['bandeira'];
 $valor = $_GET['valor'];
 $valor_parcela = 0;
 
 if($valor == ''){
	mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, cartao, valor_total, cliente, operador, parcelas, valor_fornecido, valor_parcela, quant_parcelas, status_cheque, troco, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', 'CARTÃO DE CRÉDITO', '$bandeira', '$valor_pag', '$cliente', '$operador', '', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";
 }else{
 $total = $valor+($valor*0.0535)+(0.0231*$parcelas*$valor);
 $valor_parcela = number_format($total/$parcelas,2); 
	mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, cartao, valor_total, parcelas, valor_parcela, cliente, operador, valor_fornecido, quant_parcelas, status_cheque, troco, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', 'CARTÃO DE CRÉDITO', '$bandeira', '$valor', '$parcelas', '$valor_parcela', '$cliente', '$operador', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
	
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";
  }
 }?>
 
<h1><strong>ESCOLHA AS PARCELAS</strong></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
  <select class="select" name="bandeira">
  <option value="MASTERCARD">1- MASTERCARD</option>
  <option value="VISA">2- VISA</option>
  <option value="ELO">3 - ELO</option>
  <option value="AMERICAN EXPRESS">4 - AMERICAN EXPRESS</option>
  <option value="DINERS">5 - DINERS</option>
  <option value="FORTBRASIL">6 - FORTBRASIL</option>
  <option value="HIPERCARD">7 - HIPERCARD</option>
  <option value="OUTROS">8 - OUTROS</option>
  </select>
  <input class="input5" type="text" name="parcelas" />
  <input class="input" type="submit" name="avancars" value="Confirmar" />
 </form> 
 <hr />
 <table width="480" border="0">
  <tr>
    <td width="45">&nbsp;</td>
    <td width="339"><strong>ESCOLHA AS PARCELAS: R$ <? echo number_format($_GET['valor'],2,',','.'); ?></strong></td>
  </tr>
  <tr>
   <td colspan="2"><hr /></td>
  </tr>
  <? for($i=1; $i<=12; $i++){ ?>
  <tr>
    <td align="center"><? echo $i; ?> X </td>
    <td>R$ <? 
	
	if($i>1){
	$total = $_GET['valor']+($_GET['valor']*0.03)+(0.008*$i*$_GET['valor']);
	echo $valor_total = number_format(($total/$i)*$i,2,',','.');
	echo " em $i fixas de R$ ";
	$valor_total = ($total/$i)*$i;
	echo number_format($valor_total/$i,2,',','.');
	}else{
	echo number_format($_GET['valor']/$i,2,',','.');
	echo " SEM JUROS";
	}
	?>
    </td>
  </tr>
  <? } ?>
</table>


 <? } // fecha CARTÃO DE CRÉDITO ?>








 <? if($_GET['pag'] == '5'){ // CARTÃO DÉBITO ?>
 <h1><strong>SELECIONE A BANDEIRA DO CARTÃO</strong></h1>
 <? if(isset($_POST['confirmar_tra'])){
 
 $bandeira = $_POST['bandeira'];
 $valor_pag = $_GET['valor_pag'];
 
	mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, cartao, valor_total, cliente, operador, parcelas, valor_fornecido, valor_parcela, quant_parcelas, status_cheque, troco, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', 'CARTÃO DE DÉBITO', '$bandeira', '$valor_pag', '$cliente', '$operador', '', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
		
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";
 
 }?>
 
 <form name="" method="post" action="" enctype="multipart/form-data">
 <select name="bandeira">
  <option value="MASTERCARD">1- MASTERCARD</option>
  <option value="VISA">2- VISA</option>
  <option value="ELO">3 - ELO</option>
  <option value="AMERICAN EXPRESS">4 - AMERICAN EXPRESS</option>
  <option value="DINERS">5 - DINERS</option>
  <option value="FORTBRASIL">6 - FORTBRASIL</option>
  <option value="HIPERCARD">7 - HIPERCARD</option>
  <option value="OUTROS">8 - OUTROS</option>
 </select>
 <input class="input2" type="submit" name="confirmar_tra" value="Confirmar" />
 </form>
 <? } // fecha cartão de débito ?>



 <? if($_GET['pag'] == '1'){ // Easy Card ?>
 
 <? if(isset($_POST['avancars'])){
 
 $parcelas = $_POST['parcelas'];
 $senha = $_POST['senha'];
 $valor = $_GET['valor'];
 $valor_parcela = 0;
 
 if($parcelas <1 || $parcelas >16){
 echo "<script language='javascript'>window.alert('Número de parcelas incorreta!');</script>"; 
 }else{ 
 
 $verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
 if(mysqli_num_rows($verifica_senha) == ''){
 echo "<script language='javascript'>window.alert('A senha não confere!');</script>"; 
 }else{
 
 	
	if($_GET['extra'] == 'sim'){
		$sql_lancamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND mes = '$mes' AND ano = '$ano' AND descricao = 'TARIFA EMERGENCIAL DE CREDITO'");
		
		if(mysqli_num_rows($sql_lancamento_fatura) == ''){
 		mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_carrinho', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'TARIFA EMERGENCIAL DE CREDITO', '15.9', '$code_carrinho', '$cliente', '', '', '', '', '$operador')");

    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_carrinho', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1', '1', '1', '15.9', '')");
		
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'LIMITE EMERGENCIAL', '5')");
		 
		  $score = $score-100;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");
		}
	}
 
 
 
	if($parcelas>3){
	$valor_parcela = (($_GET['valor']*(0.029)*$parcelas)+$_GET['valor'])/$parcelas;
	}else{
	$valor_parcela = number_format($_GET['valor']/$parcelas,2);
	}
 
 if($parcelas == 1){
	 
   $code_transacao = rand();
 
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'COMPRA VESTE PRIME: $code_carrinho', '$valor', '$code_carrinho', '$cliente', '', '', '', '', '$operador')");
  
  for($k=1; $k<=$parcelas; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$k/$parcelas', '$k', '$parcelas', '$valor_parcela', '')");
  }
 
  mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, parcelas, cartao, valor_total, valor_parcela, cliente, operador, quant_parcelas, valor_fornecido, status_cheque, troco, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', 'VESTE PRIME', '$parcelas', 'VESTE PRIME', '$valor', '$valor_parcela', '$cliente', '$operador', '$parcelas', '', '', '', '', '$code_vencimento_hoje', '$filial')");
  
   $consome_limite = $limite_loja_disponivel-$valor_parcela;

  mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$consome_limite' WHERE cliente = '$cliente'");
  
  ?>
  
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcelas; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="fecha_carrinho.php?p=">Assinar comprovante de compra</a>  
  
 
 <? die;
 }else{
 
  $code_transacao = rand();

 
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'COMPRA VESTE PRIME: $code_carrinho', '$valor', 'SIM', '$parcelas', '$valor_parcela', '$cliente', '$code_carrinho', '', '$operador')");
  
  for($k=1; $k<=$parcelas; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'EASY LOAN', '$k/$parcelas', '$k', '$parcelas', '$valor_parcela', '')");
  }
  
  $consome_limite = $limite_loja_disponivel-($parcelas*$valor_parcela);
  
  mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja_disponivel = '$consome_limite' WHERE cliente = '$cliente'");


  mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, parcelas, cartao, valor_total, valor_parcela, cliente, operador, quant_parcelas, valor_fornecido, status_cheque, troco, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', 'VESTE PRIME', '$parcelas', 'VESTE PRIME', '$valor', '$valor_parcela', '$cliente', '$operador', '$parcelas', '', '', '', '', '$code_vencimento_hoje', '$filial')");

?>

    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcelas; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="fecha_carrinho.php?p=">Assinar comprovante de compra</a>  

 <? die;
  }}}
 }?>
 
<h1><strong>ESCOLHA AS PARCELAS</strong></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
  <input type="text" name="parcelas" />
  <input name="senha" type="password" value="" maxlength="6" />
  <input class="input" type="submit" name="avancars" value="Confirmar" />
 </form> 
<table width="480" border="0">
  <tr>
    <td colspan="2"><h4 style="color:#CC0; font:10px Arial, Helvetica, sans-serif; padding:0; margin:-3px 0 -2px 2px;"><strong>ESCOLHA AS PARCELAS: R$ <? echo number_format($_GET['valor'],2); ?></strong></h4></td>
  </tr>

  <? for($i=1; $i<=16; $i++){ ?>
  <tr style="font:11px Arial, Helvetica, sans-serif; margin:-5px 0 -5px 0;">
    <td width="39" align="center"><strong><? echo $i; ?> X </strong></td>
    <td width="431"><strong>R$ <? 
	
	if($i>3){
	$total = (($_GET['valor']*(0.039)*$i)+$_GET['valor'])/$i;
	echo number_format($total,2);
	echo " FIXAS";
	}else{
	echo number_format($_GET['valor']/$i,2);
	echo " SEM JUROS";
	}
	?></strong>
    </td>
  </tr>
  <? } ?>
</table>


 <? } // fecha pag 1 VESTE PRIME ?>


 <? if($_GET['pag'] == ''){ ?>
 
 <? if(isset($_POST['valor_pag'])){
	 
  $pag_forma = $_POST['pag_forma'];
  $valor_pag = $_POST['valor_pag'];
  $falta_pagar = $_POST['falta_pagar'];
  $valor_compras = $_POST['valor_compras'];
  $valor_inserir = 0;
  
	
  if($valor_pag == 0){
	  echo "<script language='javascript'>window.location='fecha_carrinho.php?p=21';</script>";
  }
  
  if($valor_pag > $falta_pagar && $pag_forma == 'VESTE PRIME'){
	echo "<script language='javascript'>window.alert('Não é possível pagar valor maior que o devedor!');</script>";
  }elseif($valor_pag > $falta_pagar && $pag_forma == 'DEBITO EM CONTA'){
	echo "<script language='javascript'>window.alert('Não é possível pagar valor maior que o devedor!');</script>";
  }elseif($valor_pag > $falta_pagar && $pag_forma == 'CARTAO DE DEBITO'){
	echo "<script language='javascript'>window.alert('Não é possível pagar valor maior que o devedor!');</script>";
  }elseif($valor_pag > $falta_pagar && $pag_forma == 'CARTAO DE CREDITO'){
	echo "<script language='javascript'>window.alert('Não é possível pagar valor maior que o devedor!');</script>";	  
  }elseif($pag_forma == 'VESTE PRIME'){
	  
	  while($res_limite = mysqli_fetch_array($sql_verifica_limite_emergencial)){
		$limite_loja_disponivel = $res_limite['limite_loja_disponivel'];
	  }

	if($limite_loja_disponivel >= $valor_pag){
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=&pag=1&valor=$valor_pag';</script>"; 
	}else{
		
		$sql_verifica_limite_emergencial = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE limite_emergencial	= 'AUTORIZAR' AND cliente = '$cliente'");
		if(mysqli_num_rows($sql_verifica_limite_emergencial) == ''){
			echo "<script language='javascript'>window.alert('Não há saldo disponível no cartão VESTE PRIME CARD, autorize a avaliação emergencial de crédito!');</script>"; 
		}else{
			
			while($res_limite = mysqli_fetch_array($sql_verifica_limite_emergencial)){
				$limite_loja = $res_limite['limite_loja'];
				$limite_loja_disponivels = $res_limite['limite_loja_disponivel'];
				$limite_verifica = ($limite_loja*0.4)+$limite_loja_disponivels;
				
				if($limite_verifica >= $valor_pag){
					$sql_verifica_faturas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE cliente = '$cliente' AND sit_pag = 'REFATURADO' ORDER BY id DESC LIMIT 6");
					if(mysqli_num_rows($sql_verifica_faturas) >= 1){
 						echo "<script language='javascript'>window.alert('Não há saldo disponível no cartão VESTE PRIME CARD, autorize a avaliação emergencial de crédito!');</script>"; 
					}else{
						echo "<script language='javascript'>window.location='fecha_carrinho.php?p=&pag=1&valor=$valor_pag&extra=sim';</script>";
					}
				}else{
 					echo "<script language='javascript'>window.alert('Não há saldo disponível no cartão VESTE PRIME CARD, autorize a avaliação emergencial de crédito!');</script>"; 

				}
				
			}
			
		}
		
	}
	  
  }elseif($pag_forma == 'DINHEIRO' || $pag_forma == 'PIX' || $pag_forma == 'M12' || $pag_forma == 'TRANSFERENCIA'){
	  	
		$verifica_saldo_devedor = ($falta_pagar-$valor_pag);
		if($verifica_saldo_devedor >= 0){
			$verifica_saldo_devedor = $verifica_saldo_devedor;
		}else{
			$verifica_saldo_devedor = $verifica_saldo_devedor;
		}
		
		$pagamento_selecionado = $_POST['pag_forma'];
		
		if($falta_pagar > $valor_pag){
    	 $valor_inserir = $valor_pag;
		}elseif($valor_pag > $falta_pagar){
    	 $valor_inserir = $falta_pagar;
		}

		
		
	    $troco = ($valor_pag-$falta_pagar);
		$falta_pagar = $falta_pagar-$valor_pag;
		if($troco <= 0){
			$troco = 0;
		}else{
			$troco=$troco;
		}		
		
				
		mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, code_carrinho, form_pag, valor_fornecido, valor_total, cliente, troco, operador, parcelas, cartao, valor_parcela, quant_parcelas, status_cheque, descontos, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$code_carrinho', '$pagamento_selecionado', '$valor_inserir', '$valor_pag', '$cliente', '$troco', '$operador', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");	
		
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";   
  
  }elseif($pag_forma == 'DEBITO EM CONTA'){
	  if(($disponivel_cheque_especial >= $valor_pag) || ($saldo >= $valor_pag) || ($saldo+$disponivel_cheque_especial >= $valor_pag)){
		echo "<script language='javascript'>window.location='fecha_carrinho.php?p=&pag=3&valor=$valor_pag';</script>";  
	  }else{
		echo "<script language='javascript'>window.alert('Não há saldo disponível e nem limite de cheque especial para fazer a compra!');</script>"; 
	  }
  }elseif($pag_forma == 'CARTAO DE DEBITO'){
	 echo "<script language='javascript'>window.location='fecha_carrinho.php?p=&pag=5&valor_pag=$valor_pag';</script>";
  }elseif($pag_forma == 'CARTAO DE CREDITO'){
	  echo "<script language='javascript'>window.location='fecha_carrinho.php?p=&pag=6&valor=$valor_pag';</script>";
  }elseif($pag_forma == 'CUPOM'){
	  require "cupom_desconto.php";
  }else{
  }
 }?>
 
 <form name="" method="post" action="" enctype="multipart/form-data">
 <h1><strong>FORMA DE PAGAMENTO</strong></h1><br />
 <select name="pag_forma" size="1" autofocus>
   <? 
   $verifica_cliente_ativo = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente' AND status = 'ATIVO'");
   if(mysqli_num_rows($verifica_cliente_ativo) >= 1){
   ?> <option value="VESTE PRIME">1 - VESTE PRIME CARD</option> <? } ?>
   <option value="DINHEIRO">2 - DINHEIRO</option>
   <option value="TRANSFERENCIA">3 - PIX/TRANSFERENCIA</option>
   <option value="CARTAO DE DEBITO">4 - CARTAO DE DEBITO</option>
   <option value="CARTAO DE CREDITO">5 - CARTAO DE CREDITO</option>
   <option value="CUPOM">6 - CUPOM DE DESCONTO</option>
   <option value="M12">7 - AUTORIZA&Ccedil;&Atilde;O M12</option>
 </select> 
 <input type="text" name="valor_pag" style="text-transform:uppercase;" value="<? 
 
 $verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE status = 'Ativo' AND ip = '$ip'");
 $valor_compras = 0;
 while($res_produtos_carrinho = mysqli_fetch_array($verifica_carrinho)){
	 $valor_compras = $res_produtos_carrinho['valor']+$valor_compras;
 }
 
   $valor_pago = 0;
  $pega_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$code_carrinho' AND status = 'Ativo'");
  	while($res_pago = mysqli_fetch_array($pega_pagamento)){
			$valor_pago = $res_pago['valor_total']+$valor_pago;
		}
		
	$ainfa_falta_pagar = str_replace(",","",$ainfa_falta_pagar);
 
 $ainfa_falta_pagar = number_format($valor_compras-$valor_pago,2);
 if($ainfa_falta_pagar <=0){echo "0.00";}else{ $ainfa_falta_pagar = str_replace(",","",$ainfa_falta_pagar); echo $ainfa_falta_pagar; }?>" />
 <input type="hidden" name="falta_pagar" value="<? if($ainfa_falta_pagar <=0){echo "0.00";}else{ $ainfa_falta_pagar = str_replace(",","",$ainfa_falta_pagar); echo $ainfa_falta_pagar; } ?>" />
 <input type="hidden" name="valor_compras" value="<? echo $valor_compras; ?>" />
 </form>
 <hr />
 
 <? } ?>
 </div><!-- pagamento -->
 
 
 
 
 
 <script>
    // Função para abrir o pop-up
   
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
			window.location='carrinho.php';
		}

    // Função para verificar a tecla pressionada
    function verificarTecla(event) {
        // Verifica se a tecla pressionada é a tecla 'F'
        if ((event.key === 'F' || event.key === 'f') && !event.shiftKey) {
			<? if($ainfa_falta_pagar <=0){ ?>
            abrePopUp('scripts/encerra_carrinho.php?cliente=<? echo @$cliente; ?>&valor=<? echo @$valor; ?>&cheque_especial=<? echo @$valor_debito_conta; ?>');
			<? } ?>
        }else if ((event.key === 'P' || event.key === 'p') && !event.shiftKey) {
			abrePopUps('scripts/abre_pagamento.php?code_carrinho=<? echo $code_carrinho; ?>');
		}
    }

    // Adiciona um ouvinte de eventos para capturar as teclas pressionadas
    document.addEventListener('keydown', verificarTecla);
</script>
 
 
 
 
 
 
 
 
 
 
 
 
 <div id="box_compras">
 <?
 $verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
 if(mysqli_num_rows($verifica_carrinho) == ''){
	echo "Não existe nenhum produto/serviço adicionado ao carrinho.";	 
 }else{
	 	 
 $verifica_produtos_carrinho = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE status = 'Ativo' AND ip = '$ip'");
  ?>
  <table width="500" border="0">
  <tr>
    <td colspan="5"><strong>DESCRIÇÃO DO CARRINHO</strong></td>
    <td width="69">
    
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=300,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=710,height=400');
		}
	</script>
<a onclick="abrePopUps('scripts/abre_pagamento.php?code_carrinho=<? echo $code_carrinho; ?>');" href="fecha_carrinho.php?p=">PAGAMENTO</a>     
    
    </td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="42"><strong>ITEM</strong></td>
    <td width="48"><strong>COD.</strong></td>
    <td width="207"><strong>DESCRIÇÃO</strong></td>
    <td width="60"><strong>QUANT.</strong></td>
    <td width="58"><strong>V.UNIT.</strong></td>
    <td width="69"><strong>V.TOTAL</strong></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <? 
  	$produtos = 0;
	$servicoes = 0;
	$item = 0;
	$valor_compras = 0;
  	while($res_produtos_carrinho = mysqli_fetch_array($verifica_produtos_carrinho)){ $item++;
	
	if($res_produtos_carrinho['tipo'] == 'PRODUTO'){
	$produtos++;
	}else{
	$servicoes++;
	}
	
	$valor_compras = $res_produtos_carrinho['valor']+$valor_compras;
	
  ?>
  <tr>
    <td height="29"><? echo $item; ?></td>
    <td><? echo $res_produtos_carrinho['code_produto']; ?></td>
    <td><? $code_produto = $res_produtos_carrinho['code_produto']; 
	
	$busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE status = 'Ativo' AND code = '$code_produto'");
		while($res_produto = mysqli_fetch_array($busca_produto)){
				echo $res_produto['titulo_resumido'];
			
	
	?></td>
    <td>
    
    <form name="" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="code_produto" value="<? echo $res_produtos_carrinho['code_produto']; ?>" />
    <input type="hidden" name="quant_produto" value="<? echo $res_produtos_carrinho['quant']; ?>" />
    <input type="text" value="<? echo $res_produtos_carrinho['quant']; ?>" name="quant" width="2" />
    </form>
    
    </td>
    <td><? 
	
	$valor_venda = 0;
	if($filial == 'JERI'){
	$valor_venda = $res_produto['valor_venda2'];
	}else{
	$valor_venda = $res_produto['valor_venda'];
	}		
	
	echo number_format($valor_venda,2); ?></td>
    <td><a class="a_desconto" rel="superbox[iframe][240x100]" href="scripts/aplicar_desconto.php?produto_carrinho=<? echo $res_produtos_carrinho['code_produto']; ?>&cliente=<? echo $res_produtos_carrinho['cliente']; ?>&code_carrinho=<? echo $res_produtos_carrinho['code_carrinho']; ?>&quantidade=<? echo $res_produtos_carrinho['quant']; ?>"><? echo number_format($res_produtos_carrinho['valor'],2); ?></a></td>
  </tr>
  <? }} ?>
  
 <? if(isset($_POST['quant'])){ // code_produto 
  
  $quant = $_POST['quant'];
  $quant_produto = $_POST['quant_produto'];
  $code_produto = $_POST['code_produto'];
 
 if($quant == $quant_produto){
	echo "<script language='javascript'>window.alert('NÃO HOUVE ALTERAÇÃO DE QUANTIDADE!');</script>";
 }else{
 
 if($quant == 0){
  	mysqli_query($conexao_bd, "DELETE FROM produtos_caixa WHERE code_produto = '$code_produto' AND code_carrinho = '$code_carrinho'");
	echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";
 }else{
	 
	  $busca_preco = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_produto'");
	  	while($res_preco = mysqli_fetch_array($busca_preco)){
			
				$valor = 0;
				if($filial == 'JERI'){
				$valor = $res_preco['valor_venda2'];
				}else{
				$valor = $res_preco['valor_venda'];
				}
			$estoque = $res_preco['estoque'];
			
			$valor_produto = $valor*$quant;
			
			mysqli_query($conexao_bd, "UPDATE produtos_caixa SET quant = '$quant', valor = '$valor_produto' WHERE code_produto = '$code_produto' AND code_carrinho = '$code_carrinho'");
			
			
			
			
			if($quant_produto > $quant){
				$novo_estoque = $estoque+($quant_produto-$quant);
			}else{
				$novo_estoque = $estoque-$quant;
			}
			
			if($novo_estoque < 0){
				$novo_estoque = 0;
			}else{
				$novo_estoque = $novo_estoque;
			}
					
			echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";

		} // busca_preco
  	}
  }
 }?>
  </table>
<? }// fecha a verificação do carrinho ?>
 </div><!-- box_compras -->
 
 <div id="valor_compras">
  <h1><strong>VALOR A SER PAGO: </strong> <strong class="strong3">R$ <? echo number_format($valor_compras,2); ?></strong></h1>
  <hr />
  <h2><strong>VALOR PAGO:</strong> R$ <? 
  $valor_pago = 0;
  $troco = $troco;
  $pega_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$code_carrinho' AND status = 'Ativo'");
  	while($res_pago = mysqli_fetch_array($pega_pagamento)){
			$valor_pago = $res_pago['valor_total']+$valor_pago;
			$troco = $res_pago['troco']+$troco;
		}
  
  echo number_format($valor_pago,2); ?> - <strong>FALTA:</strong> R$ <? $ainda_falta_pagar = number_format($valor_compras-$valor_pago,2); if($ainda_falta_pagar <= 0){ echo "0,00"; }else{ echo $ainda_falta_pagar; }?> 
  <br /><strong>TROCO:</strong> <? echo number_format($troco,2); ?> - <strong>DESCONTO:</strong>
  
  <?
  
  $sql_verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE cliente = '$cliente' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");
  if(mysqli_num_rows($sql_verifica_carrinho) == 0){
    if($cliente == 0){
	}else{
	  $desconto = $valor_compras*0;
	  
	  if($carrinho_cliente != NULL){
	  
	  mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, form_pag, valor_total, cliente, code_carrinho, operador, descontos, parcelas, cartao, valor_fornecido, valor_parcela, quant_parcelas, status_cheque, troco, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'DESCONTO CLIENTE CADASTRADO', '$desconto', '$cliente', '$code_carrinho', '$operador', '$desconto', '', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
	  }
	  echo "<script language='javascript'>window.location='';</script>";
	} // verifica se o cliente já recebeu o desconto
  }else{	  	  
	  $sql_verifica_desconto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE cliente = '$cliente' AND code_carrinho = '$code_carrinho' AND form_pag = 'DESCONTO CLIENTE CADASTRADO'");
	  if(mysqli_num_rows($sql_verifica_desconto) >= 1){
	   	$desconto = $valor_compras*0;
		 $faz_atualizacao = mysqli_query($conexao_bd, "UPDATE pagamento_carrinho SET valor_total = '$desconto', descontos = '$desconto' WHERE form_pag = 'DESCONTO CLIENTE CADASTRADO' AND cliente = '$cliente' AND code_carrinho = '$code_carrinho' AND descontos != '$desconto'");
		 if($faz_atualizacao == ''){
		 }else{
		 }
	  }else{
		  	  
	  $desconto = $valor_compras*0;
	  
	  mysqli_query($conexao_bd, "INSERT INTO pagamento_carrinho (codeCaixa, turno, ip, dia, mes, ano, data, data_completa, status, form_pag, valor_total, cliente, code_carrinho, operador, descontos, parcelas, cartao, valor_fornecido, valor_parcela, quant_parcelas, status_cheque, troco, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'DESCONTO CLIENTE CADASTRADO', '$desconto', '$cliente', '$code_carrinho', '$operador', '$desconto', '', '', '', '', '', '', '', '$code_vencimento_hoje', '$filial')");
	  echo "<script language='javascript'>window.location='';</script>";
   }
  }
  
  $valor_descontos = 0;
  $sql_verifica_desconto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE code_carrinho = '$code_carrinho'");
  	while($res_desconto = mysqli_fetch_array($sql_verifica_desconto)){
		$valor_descontos = $valor_descontos+$res_desconto['valor_total'];
	}
  	
	 echo number_format($valor_descontos, 2, ',', '.'); 
  
  
  ?>
  
  </h2>
 </div><!-- valor_compras -->

</div><!-- box_corpo -->
<? }// box_menu  ?>

<? }}} // fecha a verificação se existe produto no carrinho ?>




<? require "rodape.php"; ?>
</body>
</html>