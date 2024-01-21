<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SISTEMA DE CAIXA - VESTE PRIME</title>
<? require "config.php"; ?>
<link href="img/logo.png" rel="shortcut icon" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<link href="../img/index.png" rel="shortcut icon" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
</head>

<body>
<? //mysqli_query($conexao_bd, "DELETE FROM produtos WHERE titulo LIKE '%CAPINHA%'"); ?>





<script>
    // Função para abrir o pop-up
   
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
			window.location='carrinho.php';
		}

    // Função para verificar a tecla pressionada
    function verificarTecla(event) {
        // Verifica se a tecla pressionada é a tecla 'F'
        if ((event.key === 'F1' || event.key === 'f1') && !event.shiftKey) {
            window.location='carrinho.php';
        }else if ((event.key === 'F2' || event.key === 'f2') && !event.shiftKey) {
			window.location='pesquisa_de_produto.php';
        }else if ((event.key === 'F3' || event.key === 'f3') && !event.shiftKey) {
			window.location='fazer_pagamento.php';
		}
		
    }
	
	document.addEventListener('keydown', function(event) {
    // Verifica se a tecla pressionada é a letra 'N' (maiúscula ou minúscula)
    if ((event.key === 'x' || event.key === 'X') && document.activeElement.tagName !== 'INPUT') {
   // Coloca o foco no input com id "opcoes"
        document.getElementById('opcoes').focus();
        // Prevenir a tecla 'N' de ser inserida no campo de entrada
        event.preventDefault();
    }
    if ((event.key === 'N' || event.key === 'n') && document.activeElement.tagName !== 'INPUT') {
   // Coloca o foco no input com id "opcoes"
        document.getElementById('numberCard').focus();
        // Prevenir a tecla 'N' de ser inserida no campo de entrada
        event.preventDefault();
    }	
	
	
	
});

    // Adiciona um ouvinte de eventos para capturar as teclas pressionadas
    document.addEventListener('keydown', verificarTecla);
</script>








<?

$code_carrinho = 0; $carrinho_cliente = 0;
$puxa_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
if(mysqli_num_rows($puxa_carrinho) == ''){
	$code_carrinho = rand();
	mysqli_query($conexao_bd, "INSERT INTO carrinho (turno, codeCaixa, ip, code_carrinho, hora_abertura, data, status, operador, cliente, code_dia, loja) VALUES ('$turno', '$codeCaixa', '$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$operador', '', '$code_vencimento_hoje', '$filial')");
 }else{
	while($res_carrinho = mysqli_fetch_array($puxa_carrinho)){
		$cliente = $res_carrinho['cliente'];
		$carrinho_cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];
  }
}
?>


<div id="topo_geral">
<? if($_GET['p'] == 'index' && $filial == 'JERI'){ ?>
 <h1 style="font:12px Arial, Helvetica, sans-serif; text-align:center; color:#FF0;"><strong>Valor do alivio: R$ 
 <?
  
  $alivio_pagamento_contas = 0;
  
  $sql_alivio_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE data = '$data' AND operador = '$operador' AND status != 'CANCELADO'");
    while($res_alivio_pagamento = mysqli_fetch_array($sql_alivio_pagamento)){
		$alivio_pagamento_contas = $alivio_pagamento_contas+$res_alivio_pagamento['valor']+$res_alivio_pagamento['juros']+$res_alivio_pagamento['boleto_vencido']+$res_alivio_pagamento['boleto_tarifado']+1;
	}
	
  $sql_alivio_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
    while($res_alivio_ted = mysqli_fetch_array($sql_alivio_ted)){
		$alivio_pagamento_contas = ($alivio_pagamento_contas+$res_alivio_ted['valor']+$res_alivio_ted['tarifa'])-1;
	}
	
	
	
	$sql_verifica_saldo = mysqli_query($conexao_bd, "SELECT * FROM saldo_filial WHERE filial = 'JERI' AND data = '$data'");
	 if(mysqli_num_rows($sql_verifica_saldo) == ''){
	  mysqli_query($conexao_bd, "INSERT INTO saldo_filial (filial, saldo, data) VALUES ('JERI', '$alivio_pagamento_contas', '$data')");
		 }else{
		 while($res_saldo_alivio = mysqli_fetch_array($sql_verifica_saldo)){
			 mysqli_query($conexao_bd, "UPDATE saldo_filial SET saldo = '$alivio_pagamento_contas' WHERE filial = 'JERI' AND data = '$data'");
		 }
	 }
	
	echo number_format($alivio_pagamento_contas,2,',','.');
	
 ?>
 </strong><hr /></h1>
 <? } ?>
 
 
 
 <div id="logo_topo">
  <img src="img/logo.png" width="150" height="80" />
 </div><!-- logo_topo -->
 
 <div id="busca_principal">
  <form name="" method="post" enctype="multipart/form-data">
    <span id="sprytextfield1">
    <input id="opcoes" style="background:#000; font:18px Arial, Helvetica, sans-serif; border:1px solid #666;" class="input1" type="text" name="key1"  <? if($_GET['p'] == ''){ echo ""; } ?> />
    </span>
    <input class="input2" type="submit" name="go" value="" />
  </form>
  
  <? if(isset($_POST['go'])){
   
   $key1 = $_POST['key1'];
   
   $verifica_pag = mysqli_query($conexao_bd, "SELECT * FROM paginas WHERE codigo = '$key1'");
   if(mysqli_num_rows($verifica_pag) == ''){
    	echo "<script language='javascript'>window.alert('CÓDIGO ($key1) NÃO ENCONTRADO!');</script>";
	}else{
	echo "<script language='javascript'>window.location='index.php?pack=$key1';</script>";
	}
	
	
   
   
   
  }?>
  
 </div><!-- busca_principal -->
 
 <div id="cliente_info">
<?
$nome_cliente_inf = 0;
$saldo_conta_inf = 0;
$limite_inf = 0;
$finan_inf = 0;
$saque_inf = 0;

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
	if(mysqli_num_rows($sql_cliente) == ''){
	}else{
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$saldo_conta_inf = $res_cliente['saldo'];
			$limite_inf = $res_cliente['limite_loja_disponivel'];
			$finan_inf = $res_cliente['disponivel_pagamento_contas'];
			$saque_inf = $res_cliente['credito_pessoal_disponivel'];
			$busca_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
			while($res_nome = mysqli_fetch_array($busca_nome_cliente)){
				$nome_cliente_inf = $res_nome['nome'];
	        }
	}
   }
  }
 }
?> 
 <? if($nome_cliente_inf == NULL){ ?>
 
    <h1><strong><br />NUMBER CARD</strong>
     <form name="" method="post" action="" enctype="multipart/form-data">
       <span id="sprytextfield2_cpf">
       <input id="numberCard" name="cpf" type="text" style="padding:5px; border:1px solid #666; text-align:center; color:#F60; background:#000;" size="30" />
       </span>
     </form>
    </h1>
    ";
    
<? if(isset($_POST['cpf'])){

$key = $_POST['cpf'];

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$key' OR cartao = '$key'");
if(mysqli_num_rows($sql_cliente) == ''){
echo "<script language='javascript'>window.alert('CLIENTE NÃO ENCONTRADO!');</script>";
}else{
  while($res_cliente = mysqli_fetch_array($sql_cliente)){
	  
	  $cpf_cliente = $res_cliente['cliente'];
	  
	$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	if(mysqli_num_rows($sql_carrinho) == ''){
		$code_carrinho = rand();
	 mysqli_query($conexao_bd, "INSERT INTO carrinho (turno, codeCaixa, ip, code_carrinho, hora_abertura, data, status, cliente, operador, code_dia, loja) VALUES ('$turno', '$codeCaixa', '$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$cpf_cliente', '$operador', '$code_dia', '$loja')");
	 echo "<script language='javascript'>window.location='carrinho.php?p=';</script>";
	}else{
	 mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '$cpf_cliente' WHERE ip = '$ip' AND status = 'Ativo'");
	 echo "<script language='javascript'>window.location='carrinho.php?p=';</script>";
   }
  }
 }
}?>
 
 <? }else{ ?>
  <h1><strong>CLIENTE<br /></strong><span class="h1"><? echo $nome_cliente_inf; ?></span></h1>
  <h1>
  	  <strong>Saldo:</strong><span class="h1"> R$ <? echo number_format($saldo_conta_inf, 2, ',','.'); ?></span>
  	  <strong>Limite:</strong><span class="h1"> R$ <? echo number_format($limite_inf, 2, ',','.'); ?></span> <br />
      <strong>Finaciamento:</strong><span class="h1"> R$ <? echo number_format($finan_inf, 2, ',','.'); ?></span> <strong>SAQUE:</strong><span class="h1"> R$ <? echo number_format($saque_inf, 2, ',','.'); ?></span>
  </h1>
  <? } ?>
 </div><!-- cliente_info -->
 
 <div id="informacoe">
  <h1><strong>OPERADOR:<br /></strong><? echo $nome; ?><br /><br />
  <strong>Data:</strong> <? echo date("d/m/Y"); ?><br />
  <strong style="color:#FF0;">SALDO EM CAIXA: <? 

$soma_caixa_inicial = 0;
$id_do_caixa = 0;

$sql_abertura = mysqli_query($conexao_bd, "SELECT * FROM abertura_de_caixa WHERE operador = '$operador' AND status = 'Aberto' AND data = '$data'  ORDER BY id DESC LIMIT 1");
 while($res_abertura = mysqli_fetch_array($sql_abertura)){
	 
$id_do_caixa =  $res_abertura['id'];
	 
$soma_caixa_inicial = $res_abertura['valor_caixa']+$soma_caixa_inicial;
  
  	$caixa_inicial = ($res_abertura['bb']*200)+($res_abertura['notas100']*100)+($res_abertura['notas50']*50)+($res_abertura['notas20']*20)+($res_abertura['notas10']*10)+($res_abertura['notas5']*5)+($res_abertura['notas2']*2)+($res_abertura['moeda1']*1)+($res_abertura['moeda50']*0.5)+($res_abertura['moeda25']*0.25)+($res_abertura['moeda10']*0.1)+($res_abertura['moeda5']*0.05);
 }

$saldo_rifas = 0;
$sql_rifas = mysqli_query($conexao_bd, "SELECT * FROM rifas_cupons WHERE forma_pagamento = 'DINHEIRO' AND operador = '$operador' AND data = '$data'");
 while($res_rifas = mysqli_fetch_array($sql_rifas)){
	 $saldo_rifas = $res_rifas['valor']+$saldo_rifas;
}


$pagamentos_dinheiro = 0;
$sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE operador = '$operador' AND data = '$data'");
while($res_boletos = mysqli_fetch_array($sql_boletos)){
	
	$code_boleto = $res_boletos['code_boleto'];
	
  if($res_boletos['status'] != 'CANCELADO'){
	  $total++;
   $sql_busca_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
   	while($res_pagamento = mysqli_fetch_array($sql_busca_pagamentos)){
   
	if($res_pagamento['forma_pagamento'] == 'DINHEIRO'){
		$pagamentos_dinheiro += $res_pagamento['valor_transacao'];
	}
}

	
}}
  
$carrinho_dinheiro = 0;
$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE data = '$data' AND operador = '$operador'");
while($res_produtos = mysqli_fetch_array($sql_produtos)){
	if($res_produtos['form_pag'] == 'DINHEIRO'){ 
	  if($res_produtos['troco'] == 0){
		$carrinho_dinheiro = $res_produtos['valor_total']+$carrinho_dinheiro;
	  }else{
		$carrinho_dinheiro = $res_produtos['valor_fornecido']+$carrinho_dinheiro;
	  }
}}
  
  $transferencia_ted = 0;
  $sql_transferencia_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
  	while($res_ted = mysqli_fetch_array($sql_transferencia_ted)){
		$transferencia_ted = $res_ted['valor']+$res_ted['tarifa']+$transferencia_ted;
	}

  $deposito_bb = 0;
  $sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM deposito_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
  	while($res_deposito = mysqli_fetch_array($sql_deposito)){
		$deposito_bb = $res_deposito['valor']+$deposito_bb;
	}  
  
  $recebimento_faturas = 0;
  $sql_recebimento_faturas = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado' AND forma_pagamento = 'DINHEIRO'");
  	while($res_recebimento_faturas = mysqli_fetch_array($sql_recebimento_faturas)){
		$recebimento_faturas = $res_recebimento_faturas['valor']+$recebimento_faturas;
	}  

  $emissao = 0;
  $sql_emite = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE data = '$data' AND operador = '$operador' AND status != 'CANCELADO'");
  	while($res_emite = mysqli_fetch_array($sql_emite)){
		$emissao = $res_emite['valor']+$emissao;
	}

$soma_recarga_dinheiro = 0;

$sql_recargas = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_recargas)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_dinheiro = $res_recargas['valor']+$soma_recarga_dinheiro;
}}


$soma_recarga_tv_prepago_dinheiro = 0;

$sql_recargas_tv = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_recargas_tv)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_recarga_tv_prepago_dinheiro = $res_recargas['valor']+$soma_recarga_tv_prepago_dinheiro;
}}

$soma_giftcard_dinheiro = 0;

$sql_giftcard = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");
	while($res_recargas = mysqli_fetch_array($sql_giftcard)){
		if($res_recargas['forma_pagamento'] == 'DINHEIRO'){
			$soma_giftcard_dinheiro = $res_recargas['valor']+$soma_giftcard_dinheiro;
}}

$valor_dinheiro_loja_virtual = 0;

  
       $sql_pagamento_carrinho = mysqli_query($conexao_bd, "SELECT * FROM loja_online_pagamentos WHERE code_carrinho = '".$res_sql_online_carrinho['code_carrinho']."'");
	    while($res_pagamento = mysqli_fetch_array($sql_pagamento_carrinho)){ $i++;
		
		if($res_pagamento['forma_pagamento'] == 'DINHEIRO'){ 
			$valor_dinheiro_loja_virtual = $valor_dinheiro_loja_virtual+($res_pagamento['valor']-$res_pagamento['troco']); 
		}  
		}

$capitalizacao = 0;

$sql_capitalizacao = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE data_pagt = '$data' AND operador_pgto = '$operador'");
	while($res_capitalizacao = mysqli_fetch_array($sql_capitalizacao)){
		$capitalizacao = $res_capitalizacao['vl_recebido']+$capitalizacao;
}

$$valor_caixa_emprestimo = 0;
$sql_puxa = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_cartao WHERE data = '$data' AND operador = '$operador'");
while($res_produtos = mysqli_fetch_array($sql_puxa)){
	if($res_produtos['forma_pagamento'] == 'CAIXA'){
	$valor_caixa_emprestimo = $res_produtos['valor']+$valor_caixa_emprestimo;
	
}}
  
  
$saque_caixa_debito = 0;

$sql_saque = mysqli_query($conexao_bd, "SELECT * FROM saques WHERE data = '$data' AND operador = '$operador'");
	while($res_saque = mysqli_fetch_array($sql_saque)){
		$saque_caixa_debito = $res_saque['valor']+$saque_caixa_debito;	
}  
  

	$saque_bb = 0;
	
	$sql_saque_debito = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data = '$data' AND operador = '$operador' AND status = 'Ativo'");	
		while($res_saque = mysqli_fetch_array($sql_saque_debito)){
				$saque_bb = $res_saque['valor']+$saque_bb;
			}


  $alivio = 0;
  $sql_alivio = mysqli_query($conexao_bd, "SELECT * FROM sangria_caixa WHERE data = '$data' AND operador = '$operador'");
  	while($res_alivio = mysqli_fetch_array($sql_alivio)){
		$alivio = $res_alivio['valor']+$alivio;
	}


  $retirada_dinheiro = 0;
  $sql_comercial = mysqli_query($conexao_bd, "SELECT * FROM retirada_dinheiro WHERE data = '$data' AND operador = '$operador' AND finalidade != 'MULTA'");
  	while($res_comercial = mysqli_fetch_array($sql_comercial)){
		$retirada_dinheiro = $res_comercial['valor']+$retirada_dinheiro;
	}

  $resgate = 0;
  $sql_resgate = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE dia_resgate = '$data' AND operador_regaste = '$operador' AND status = 'RESGATADO'");
  	while($res_resgate = mysqli_fetch_array($sql_resgate)){
		$resgate = ($res_resgate['valor']+$res_resgate['juros_rendidos'])+$resgate;
	}

$soma_transferencia = 0;
$sql_transferencia = mysqli_query($conexao_bd, "SELECT * FROM saque_transferencia WHERE data = '$data' AND operador = '$operador' AND status != 'Cancelado'");
	while($res_saue_transferencia = mysqli_fetch_array($sql_transferencia)){
		$soma_transferencia = $res_saue_transferencia['valor']+$soma_transferencia;
}

$saque_facil = 0;
$sql_saque_facil = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE data = '$data' AND operador = '$operador' AND status = 'APROVADO' AND recebimento = 'PAGAMENTO NO CAIXA'");
	while($res_saque_facil = mysqli_fetch_array($sql_saque_facil)){
		$saque_facil = $res_saque_facil['valor']+$saque_facil;
}  

$aporte = 0;
$sqlAporte = mysqli_query($conexao_bd, "SELECT * FROM aporte_financeiro WHERE operador = '$operador' AND data = '$data'");
 while($resAporte = mysqli_fetch_array($sqlAporte)){
	 $aporte+=$resAporte['valor'];
}

$disponivel_em_caixa = ($caixa_inicial+$aporte+$saldo_rifas+$pagamentos_dinheiro+$carrinho_dinheiro+$transferencia_ted+$deposito_bb+$recebimento_faturas+$emissao+$soma_recarga_dinheiro+$soma_recarga_tv_prepago_dinheiro+$soma_giftcard_dinheiro+$valor_dinheiro_loja_virtual+$capitalizacao)-($resgate+$saque_bb+$saque_caixa_debito+$soma_transferencia+$valor_caixa_emprestimo+$alivio+$retirada_dinheiro+$saque_facil);

if($_GET['p'] != '1'){
if($disponivel_em_caixa >= 5000 && $_GET['code_conjunto'] == '' && $_GET['code_boleto'] == '' && $_GET['p'] != '4' && $_GET['p'] != 'confirmar_efetivacao' && $_GET['p'] != '5' && $_GET['p'] != '6'){
	echo "<script language='javascript'>window.alert('Alerta de sagria de caixa atingido!');window.location='sagria_para_banco.php?p=1';</script>";
}
}

  echo number_format($disponivel_em_caixa,2,',','.'); ?></strong> 
  
<?
$sql_sorteio = mysqli_query($conexao_bd, "SELECT * FROM rifas WHERE status = 'ATIVO'");
while($res_sorteio = mysqli_fetch_array($sql_sorteio)){
?> 
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=360');
		}
	</script>
  <a onclick="abrePopUps('scripts/cupom_rifa.php?id=<? echo $res_sorteio['id']; ?>');"><img style="border-radius:5px; cursor:pointer;" src="img/sortear.jpg" width="18" height="18" /></a>
<? } ?>  
  </h1>
 </div><!-- informacoe -->

</div><!-- topo_geral -->
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2_cpf");
</script>
</body>
</html>
