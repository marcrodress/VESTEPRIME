<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? $code_conjunto = $_GET['code_conjunto']; $cliente = $_GET['cliente']; ?>


<? if($code_conjunto>=1){ ?>
<strong>Selecione o número de parcelas e digite a senha  <a class="a_volta" href="?code_conjunto=<? echo $code_conjunto; ?>">VOLTAR</a></strong><p></p>

<? if($_GET['limite_pagamento'] <  $_GET['valorusar']){ echo "<script language='javascript'>window.alert('LIMITE DE FINANCIAMENTO INSUFICIENTE! - DISPONÍVEL: R$ ".$_GET['limite_pagamento']."');window.location='?code_conjunto=$code_conjunto';</script>"; }else{ ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<input type="text" name="parcela" size="1"  autofocus/>
<input type="password" name="senha" size="4" />
<input class="botao_avancar" type="submit" name="confirmar" value="Confirmar" />
</form>
<br /><br />
<? if(isset($_POST['confirmar'])){

$parcela = $_POST['parcela'];
$senha = $_POST['senha'];
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];

$valor_parcela = 0;
$valor_transacao = 0;

$i = $parcela;


$limite_antes = 0;
$limite_consumido = 0;

  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $valorusar;
	}

$valorusar = (($_GET['taxa_juros']/100)*$_GET['valorusar'])+$_GET['valorusar'];
if($parcela == 1){
$valor_parcela = $valorusar;
$valor_transacao = $valorusar;
}else{
@$valor_parcela = (($valorusar*($_GET['juros_parcelamento']/100)*$i)+$valorusar)/$i;
@$valor_transacao = $valor_parcela*$i;
}


if($parcela <=0 || $parcela >12){
	echo "<script language='javascript'>window.alert('O número de parcela deve ser entre 1 a 12 parcelas');</script>";
}else{
  
 $sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE senha = '$senha' AND cpf 
 = '$cliente'");
 if(mysqli_num_rows($sql_verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('SENHA NÃO CONFERE!');</script>";	 
 }else{
 
 $code_transacao = rand()*547;
 
 if($_GET['limiteemergencial'] == 'sim'){
	 $code_transacao_em = rand()*2;

		$sql_lancamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND mes = '$mes' AND ano = '$ano' AND descricao = 'TARIFA EMERGENCIAL DE CREDITO'");
		
		if(mysqli_num_rows($sql_lancamento_fatura) == ''){
 		mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_transacao_em', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'TARIFA EMERGENCIAL DE CREDITO', '18.9', '$code_carrinho', '$cliente', '', '', '', '', '$operador')");

    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao_em', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1', '1', '1', '18.9', '')");
		
		}	 
 }
 
 
 		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'LIMITE EMERGENCIAL', '96')");
		 
		  $score = $score-20;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");
 
 
 if($parcela == 1){
	  
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'PAGAMENTO DE CONTAS', '$valorusar', '$code_boleto', '$cliente', '', '', '', '', '$operador')");
  
  for($k=1; $k<=$parcela; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$k/$parcela', '$k', '$parcela', '$valor_parcela', '')");
  }
  
  
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (
  codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, limite_antes, limite_consumido, cliente, troco, cheque_especial, conjunto) VALUES (
  '$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', 'VESTE PRIME', '".$_GET['valorusar']."', '$valor_parcela', '$valor_transacao', '$limite_antes', '$limite_consumido', '$cliente', '', '', '$code_conjunto')");
  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
  
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $_GET['valorusar'];
   
   $novo_limite = $limite_antes-$limite_consumido;

  	mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$novo_limite' WHERE cliente = '$cliente'");
	
	} // while que pega a conta corrente
?>

  <br /><br />
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
<a class="a" onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcela; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="?code_conjunto=<? echo $code_conjunto; ?>">Assinar comprovante de compra</a>  
  
 
<? die;  
 }else{
	 
 } // FECHA A VERIFICAÇÃO

  
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'PAGAMENTO DE CONTAS', '$valor_transacao', 'SIM', '$parcela', '$valor_parcela', '$cliente', '$code_boleto', '', '$operador')");
  
  for($k=1; $k<=$parcela; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$k/$parcela', '$k', '$parcela', '$valor_parcela', '')");
  }
  
  
	mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, limite_antes, limite_consumido, cliente, troco, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', 'VESTE PRIME', '".$_GET['valorusar']."', '$valor_parcela', '$valor_transacao', '$limite_antes', '$limite_consumido', '$cliente', '', '', '$code_conjunto')");

  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
  
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $_GET['valorusar'];
   
   $novo_limite = $limite_antes-$limite_consumido;
    
   mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$novo_limite' WHERE cliente = '$cliente'");
	}
  
?>

  <br /><br />
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
<a class="a" onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcela; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="?code_conjunto=<? echo $code_conjunto; ?>">Assinar comprovante de compra</a>  
  
  
<? die; } } }?>



<hr /> 
<table width="450" border="0">
<? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td width="372">
	 <? echo $i; ?> X - <? 
	 $valorusar = ($_GET['valorusar']*($_GET['taxa_juros']/100))+$_GET['valorusar']; 
	 if($i == 1){
		 echo number_format($valorusar, 2, ',', '.');
	 }else{
	 	echo number_format(($valorusar*(($_GET['juros_parcelamento']/100)*$i)+$valorusar)/$i, 2, ',', '.'); 
	 }
	 ?>    
    </td>
  </tr>
<? }// final do for do numero de parcelas ?>
</table>

<? } // verifica se o cliente tem limite de pagamento disponível ?>



















<? }else{?>
<strong>Selecione o número de parcelas e digite a senha  <a class="a_volta" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">VOLTAR</a></strong><p></p>

<? if($_GET['limite_pagamento'] <  $_GET['valorusar']){ echo "<script language='javascript'>window.alert('LIMITE DE FINANCIAMENTO INSUFICIENTE! - DISPONÍVEL: R$ ".$_GET['limite_pagamento']."');window.location='?p=4&code_boleto=".$_GET['code_boleto']."';</script>"; }else{ ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<input type="text" name="parcela" size="1"  autofocus/>
<input type="password" name="senha" size="4" />
<input class="botao_avancar" type="submit" name="confirmar" value="Confirmar" />
</form>
<br /><br />
<? if(isset($_POST['confirmar'])){

$parcela = $_POST['parcela'];
$senha = $_POST['senha'];
$pag_form = $_GET['pag_form'];
$valorusar = $_GET['valorusar'];
$cliente = $res_boleto['cliente'];

$valor_parcela = 0;
$valor_transacao = 0;

$i = $parcela;


$limite_antes = 0;
$limite_consumido = 0;

  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $valorusar;
	}

$valorusar = (($_GET['taxa_juros']/100)*$_GET['valorusar'])+$_GET['valorusar'];
if($parcela == 1){
$valor_parcela = $valorusar;
$valor_transacao = $valorusar;
}else{
@$valor_parcela = (($valorusar*($_GET['juros_parcelamento']/100)*$i)+$valorusar)/$i;
@$valor_transacao = $valor_parcela*$i;
}


if($parcela <=0 || $parcela >12){
	echo "<script language='javascript'>window.alert('O número de parcela deve ser entre 1 a 12 parcelas');</script>";
}else{
  
 $sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE senha = '$senha' AND cpf = '$cliente'");
 if(mysqli_num_rows($sql_verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('SENHA NÃO CONFERE!');</script>";	 
 }else{
 
 $code_transacao = rand()*547;
 
 if($_GET['limiteemergencial'] == 'sim'){
	 $code_transacao_em = rand()*2;

		$sql_lancamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE cliente = '$cliente' AND mes = '$mes' AND ano = '$ano' AND descricao = 'TARIFA EMERGENCIAL DE CREDITO'");
		
		if(mysqli_num_rows($sql_lancamento_fatura) == ''){
 		mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_transacao_em', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'TARIFA EMERGENCIAL DE CREDITO', '18.9', '$code_carrinho', '$cliente', '', '', '', '', '$operador')");

    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao_em', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1', '1', '1', '18.9', '')");
		
		}	 
 }
 
 
 		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'LIMITE EMERGENCIAL', '96')");
		 
		  $score = $score-20;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");
 
 
 if($parcela == 1){
	  
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'PAGAMENTO DE CONTAS', '$valorusar', '$code_boleto', '$cliente', '', '', '', '', '$operador')");
  
  for($k=1; $k<=$parcela; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$k/$parcela', '$k', '$parcela', '$valor_parcela', '')");
  }
  
  
  
  mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (
  codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, limite_antes, limite_consumido, cliente, troco, cheque_especial, conjunto) VALUES (
 '$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', 'VESTE PRIME', '".$_GET['valorusar']."', '$valor_parcela', '$valor_transacao', '$limite_antes', '$limite_consumido', '$cliente', '', '', '$code_conjunto')");
  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
  
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $_GET['valorusar'];
   
   $novo_limite = $limite_antes-$limite_consumido;

  	mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$novo_limite' WHERE cliente = '$cliente'");
	
	} // while que pega a conta corrente
?>

  <br /><br />
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
<a class="a" onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcela; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">Assinar comprovante de compra</a>  
  
 
<? die;  
 }else{
	 
 } // FECHA A VERIFICAÇÃO

  
  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code_transacao', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'PAGAMENTO DE CONTAS', '$valor_transacao', 'SIM', '$parcela', '$valor_parcela', '$cliente', '$code_boleto', '', '$operador')");
  
  for($k=1; $k<=$parcela; $k++){
    mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code_transacao', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$k/$parcela', '$k', '$parcela', '$valor_parcela', '')");
  }
  
  
	mysqli_query($conexao_bd, "INSERT INTO pagamento_boletos_opcoes (codeCaixa, turno, code_boleto, data, data_completa, dia, mes, ano, operador, status, forma_pagamento, n_parcelas, bandeira, valor, valor_parcela, valor_transacao, limite_antes, limite_consumido, cliente, troco, cheque_especial, conjunto) VALUES ('$codeCaixa', '$turno', '$code_boleto', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'Ativo', '$pag_form', '$parcela', 'VESTE PRIME', '".$_GET['valorusar']."', '$valor_parcela', '$valor_transacao', '$limite_antes', '$limite_consumido', '$cliente', '', '', '$code_conjunto')");

  
  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
  
	   $limite_antes = $res_conta_corrente['disponivel_pagamento_contas'];
	   $limite_consumido = $_GET['valorusar'];
   
   $novo_limite = $limite_antes-$limite_consumido;
    
   mysqli_query($conexao_bd, "UPDATE conta_corrente SET disponivel_pagamento_contas = '$novo_limite' WHERE cliente = '$cliente'");
	}
  
?>

  <br /><br />
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
<a class="a" onclick="abrePopUp('scripts/comprovante_compra.php?cliente=<? echo $cliente; ?>&parcela=<? echo $parcela; ?>&valor_parcela=<? echo $valor_parcela; ?>');" href="?p=4&code_boleto=<? echo $_GET['code_boleto']; ?>">Assinar comprovante de compra</a>  
  
  
<? die; } } }?>



<hr /> 
<table width="450" border="0">
<? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td width="372">
	 <? echo $i; ?> X - <? 
	 $valorusar = ($_GET['valorusar']*($_GET['taxa_juros']/100))+$_GET['valorusar']; 
	 if($i == 1){
		 echo number_format($valorusar, 2, ',', '.');
	 }else{
	 	echo number_format(($valorusar*(($_GET['juros_parcelamento']/100)*$i)+$valorusar)/$i, 2, ',', '.'); 
	 }
	 ?>    
    </td>
  </tr>
<? }// final do for do numero de parcelas ?>
</table>

<? } // verifica se o cliente tem limite de pagamento disponível ?>

<? } // verifica se é conjunto ?>
</body>
</html>