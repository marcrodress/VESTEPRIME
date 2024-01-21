<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/jogos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<? if($_GET['p'] == 'fazer_pagamento_jogo'){ ?>
<div id="box_fazer_pagamento_jogo">
<h1><strong>Fazer pagamento de jogos - bolão da sorte</strong><hr /></h1>


 <? if($_GET['pp'] == '4'){ ?>
 <h2><strong>Pagamento efetuado com sucesso!</strong></h2>
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/pagamento_de_bolao_da_sorte.php?num_aposta=<? echo $_GET['num_aposta']; ?>&pag=<? echo $_GET['pag']; ?>&cliente=<? echo $_GET['cliente']; ?>');" href="">Assinar comprovante de recebimento</a>
 <? } ?>




 <? if($_GET['pp'] == '2' && $_GET['pag'] == '3'){ ?>
 <? if(isset($_POST['button'])){
 
 $cpf_cliente = $_POST['cpf_cliente'];	 
 $banco = $_POST['banco'];	 
 $agencia = $_POST['agencia'];	 
 $tipo_conta = $_POST['tipo_conta'];	 
 $conta = $_POST['conta'];	 
 
 
 $code_jogo = $_GET['code_jogo'];
 $n_aposta = $_GET['num_aposta'];
 $cpf_cliente = $_GET['cliente'];
 
 
 $atualiza_pagamento = mysqli_query($conexao_bd, "UPDATE bolaodasorte SET cliente = '$cpf_cliente', banco = '$banco', agencia = '$agencia', tipo_conta = '$tipo_conta', conta_bancaria = '$conta' WHERE num_aposta = '$n_aposta' AND code_jogo = '$code_jogo'");
 
 $pega_valor_premio = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$n_aposta' AND code_jogo = '$code_jogo'");
 	while($res_valor_premio = mysqli_fetch_array($pega_valor_premio)){
 
 		$valor_premio = $res_valor_premio['valor_premio']-(6.99);
 
 $emiti_ordem = mysqli_query($conexao_bd, "INSERT INTO emissao_doc_ted (status, dia, mes, ano, data, data_completa, cliente, finalidade, descricao, tipo_conta, agencia, conta, valor, banco) VALUES ('Aguarda', '$dia', '$mes', '$ano', '$data', '$data_completa', '$cpf_cliente', 'CRÉDITO EM CONTA', 'PAGAMENTO DE PRÊMIO BOLÃO DA SORTE', '$tipo_conta', '$agencia', '$conta', '$valor_premio', '$banco')");

 
 		$fluxo_de_caixa = mysqli_query($conexao_bd, "INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor) VALUES ('Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'SAÍDA', '$cpf_cliente', 'EMISSÃO DE ORDEM DE PAGAMENTO - PRÊMIO BOLÃO DA SORTE', 'ORDEM DE PAGAMENTO', '$valor_premio')");
		
  echo "<script language='javascript'>window.location='?p=fazer_pagamento_jogo&pp=4&pag=3&code_jogo=$code_jogo&num_aposta=$n_aposta&cliente=$cpf_cliente';</script>";

 
	}
 }?>
  
 <form name="" method="post" action="" enctype="multipart/form-data">
 <table width="990" border="0">
  <tr>
    <td width="214"><strong>CPF DO CLIENTE</strong></td>
    <td width="173"><strong>BANCO:</strong></td>
    <td width="172"><strong>AGÊNCIA</strong></td>
  </tr>
  <tr>
    <td><label for="banco"></label>
    <input type="text" name="cpf_cliente" id="textfield2" value="<? echo $_GET['cliente']; ?>"></td>
    <td><label for="agencia"></label>
    <input type="text" name="banco" id="textfield3"></td>
    <td><label for="tipo_conta"></label>
    <input type="text" name="agencia" id="textfield4"></td>
  </tr>
  <tr>
    <td><strong>TIPO DE CONTA</strong></td>
    <td><strong>CONTA DIGITO</strong></td>
    <td rowspan="2" bgcolor="#FFEAEA">Informe o cliente que existe uma tarifa de transferência bancaria DOC/TED para jogos no valor de R$ 6,99</td>
  </tr>
  <tr>
    <td><label for="tipo_conta"></label>
      <select class="select" name="tipo_conta" size="1" id="tipo_conta">
        <option value="CORRENTE">CORRENTE</option>
        <option value="POUPANÇA">POUPANÇA</option>
    </select></td>
    <td><input type="text" name="conta" id="textfield6"></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><hr /></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><input type="submit" name="button" id="button" value="Confirmar"></td>
  </tr>
</table>

 </form>
 
 <? } ?>




 <? if($_GET['pp'] == '2' && $_GET['pag'] == '2' || $_GET['pag'] == '4'){ ?>
 <h2><strong>Pagamento efetuado com sucesso!</strong></h2>
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/pagamento_de_bolao_da_sorte.php?num_aposta=<? echo $_GET['num_aposta']; ?>&pag=<? echo $_GET['pag']; ?>&cliente=<? echo $_GET['cliente']; ?>');" href="">Assinar comprovante de recebimento</a>
 <? } ?>










 <? if($_GET['pp'] == '1'){ ?>
 <? if(isset($_POST['button'])){
   
   $forma_pagamento = $_POST['forma_pagamento'];
   $code_jogo = $_GET['code_jogo'];
   $n_aposta = $_GET['num_aposta'];
   $cpf_cliente = $_GET['cliente'];
   $go = 0;
   
   if($forma_pagamento == 'Dinheiro no caixa da loja'){
	   $go = 2;
   }elseif($forma_pagamento == 'ORDEM DE PAGAMENTO'){
	   $go = 3;
   }else{
	   $go = 4;
   }
   
   
  echo "<script language='javascript'>window.location='?p=fazer_pagamento_jogo&pp=2&pag=$go&code_jogo=$code_jogo&num_aposta=$n_aposta&cliente=$cpf_cliente';</script>";
   
  
 } ?>
 
 <h2><strong>Informe a forma de pagamento</strong></h2>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <select name="forma_pagamento">
   <option value="Dinheiro no caixa da loja">Dinheiro no caixa da loja</option>
   <option value="ORDEM DE PAGAMENTO">ORDEM DE PAGAMENTO</option>
   <option value="Cheque">Cheque</option>
  </select><br />
  <input class="input2" type="submit" name="button" id="button" value="Avançar">
 </form> 
 <? }// fecha 1 ?>







 <? if($_GET['pp'] == ''){ ?>
 
 <? if(isset($_POST['button'])){
	 
 $code_jogo = $_POST['code_jogo'];
 $n_aposta = $_POST['n_aposta'];
 $cpf_cliente = $_POST['cpf_cliente'];
 
 $busca_bilhete = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE code_jogo = '$code_jogo' AND num_aposta = '$n_aposta' AND status = 'Ativo' AND situacao_pag = 'AGUARDA PAGAMENTO'");
 if(mysqli_num_rows($busca_bilhete) == ''){
  echo "<script language='javascript'>window.alert('Não foi encontrado bilhete com as informações digitadas ou o pagamento já foi efetuado!');</script>";
 }else{
  echo "<script language='javascript'>window.location='?p=fazer_pagamento_jogo&pp=1&code_jogo=$code_jogo&num_aposta=$n_aposta&cliente=$cpf_cliente';</script>";
 }
 }?>
 
 
 <form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td width="198" align="center"><strong>COD. JOGO</strong></td>
    <td width="318" align="center"><strong>N. BILHETE DA APOSTA</strong></td>
    <td width="194" align="center"><strong>CPF DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td><label for="code_jogo"></label>
    <input type="text" name="code_jogo" id="code_jogo"></td>
    <td><label for="n_aposta"></label>
    <input type="text" name="n_aposta" id="n_aposta"></td>
    <td><label for="cpf_cliente"></label>
    <input name="cpf_cliente" type="text" id="cpf_cliente" value="<? echo $cpf_cliente; ?>" maxlength="11"></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><input class="input" type="submit" name="button" id="button" value="Avançar"></td>
  </tr>
</table>
 </form>
 <? } ?>
</div><!-- box_fazer_pagamento_jogo -->
<? } //  ?>











<? if($_GET['p'] == 'verifica_proximos_jogos'){ ?>
<div id="box_verifica_proximos_jogos">
<h1><strong>Conferir próximos jogos</strong><hr /></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
 <table width="990" border="0">
  <tr>
    <td width="432"><strong>
      <label for="select">MÊS</label>
    </strong></td>
    <td width="313"><strong>
      <label for="select2">ANO</label>
    </strong></td>
    <td width="231"><strong>
      <label for="select3">SÉRIE</label>
    </strong></td>
  </tr>
  <tr>
    <td><select name="mes" size="1" id="select">
      <option value="JANEIRO">JANEIRO</option>
      <option value="FEVEREIRO">FEVEREIRO</option>
      <option value="MARÇO">MARÇO</option>
      <option value="ABRIL">ABRIL</option>
      <option value="MAIO">MAIO</option>
      <option value="JUNHO">JUNHO</option>
      <option value="JULHO">JULHO</option>
      <option value="AGOSTO">AGOSTO</option>
      <option value="SETEMBRO">SETEMBRO</option>
      <option value="OUTUBRO">OUTUBRO</option>
      <option value="NOVEMBRO">NOVEMBRO</option>
      <option value="DEZEMBRO">DEZEMBRO</option>
    </select></td>
    <td><select name="ano" id="select2">
      <option value="2018">2018</option>
      <option value="2019">2019</option>
      <option value="2020">2020</option>
      <option value="2021">2021</option>
      <option value="2022">2022</option>
    </select></td>
    <td><select name="serie" size="1" id="select3">
      <option value="A">SÉRIE A</option>
      <option value="B">SÉRIE B</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="3"><input class="input" type="submit" name="avan" value="Avançar" /></td>
  </tr>
</table>
 
 </form>
<? if(isset($_POST['avan'])){
	$mes = $_POST['mes'];
	$ano = $_POST['ano'];
	$serie = $_POST['serie'];
	echo "<script language='javascript'>window.location='jogos.php?p=verifica_proximos_jogos&pp=1&mes=$mes&ano=$ano&serie=$serie';</script>";
}?>

<? if($_GET['pp'] == '1'){ ?>
<?
$puxa_jogos = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE mes = '".$_GET['mes']."' AND ano = '".$_GET['ano']."' AND serie = '".$_GET['serie']."'");
if(mysqli_num_rows($puxa_jogos) == ''){
	echo "<h2>Não foi encontrado jogos para o período informado...</h2>";
}else{
?>
<hr />
<table width="990" border="0">
  <tr>
    <td align="center" width="43" bgcolor="#999999"><strong>COD.</strong></td>
    <td  align="center" width="128" bgcolor="#999999"><strong>DATA</strong></td>
    <td  align="center" width="47" bgcolor="#999999"><strong>HORA</strong></td>
    <td align="center"  width="132" bgcolor="#999999"><strong>TIME 1</strong></td>
    <td  align="center" width="55" bgcolor="#999999"><strong>GOL(S)</strong></td>
    <td  align="center" width="156" bgcolor="#999999"><strong>TIME 2</strong></td>
    <td  align="center" width="60" bgcolor="#999999"><strong>GOL(S)</strong></td>
    <td  align="center" width="92" bgcolor="#999999"><strong>Q. APOSTA</strong></td>
    <td  align="center" width="73" bgcolor="#999999"><strong>ACUM.</strong></td>
    <td align="center"  width="73" bgcolor="#999999"><strong>SAD.ANT.</strong></td>
    <td align="center"  width="85" bgcolor="#999999"><strong>Q.GANHA.</strong></td>
  </tr>
<? $i; while($res_puxa_jogo = mysqli_fetch_array($puxa_jogos)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#D9ECFF'"; }else{ echo "bgcolor='#FFECEC'"; } ?>>
    <td align="center" ><? echo $res_puxa_jogo['code']; ?></td>
    <td align="center" ><? echo $res_puxa_jogo['data']; ?></td>
    <td align="center" ><? echo $res_puxa_jogo['hora']; ?></td>
    <td align="center" ><? $time1 = $res_puxa_jogo['time1'];
	
	 		$sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
			while($res_time1 = mysqli_fetch_array($sql_time1)){
					echo $res_time1['time'];
				}
	 ?></td>
    <td align="center" ><? echo $res_puxa_jogo['gol1']; ?></td>
    <td align="center" ><? $time2 = $res_puxa_jogo['time2'];
	
	 		$sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
			while($res_time2 = mysqli_fetch_array($sql_time2)){
					echo $res_time2['time'];
				}	
	 ?></td>
    <td align="center" ><? echo $$res_puxa_jogo['gol2']; ?></td>
    <td align="center" ><? echo $res_puxa_jogo['quant_aposta']; ?></td>
    <td align="center" ><? echo number_format($res_puxa_jogo['v_acumulado'],2); ?></td>
    <td align="center" ><? echo number_format($res_puxa_jogo['s_anterior'],2); ?></td>
    <td align="center" ><? echo $res_puxa_jogo['quant_ganhador']; ?></td>
  </tr>
  <? } ?>
</table>
<? } ?>
<? } // pp 1 ?>




</div><!-- verifica_proximos_jogos -->
<? } // fecha  verifica_proximos_jogos ?>




<? if($_GET['p'] == 'buscador_numero_jogador'){ ?>
<div id="box_busca_bilhete_jogo">
<h1><strong>Buscar bilhete pelo cpf do apostador</strong><hr /></h1>
<? if(isset($_POST['enviar'])){
	
	$cpf = $_POST['cpf'];
	
	$busca_bilhete = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE cliente = '$cpf'");
	if(mysqli_num_rows($busca_bilhete) == ''){
  	echo "<script language='javascript'>window.alert('NÃO ENCONTRADO BILHETE COM O CPF INFORMADO!');</script>";
	}else{
		echo "<script language='javascript'>window.location='?p=buscador_numero_jogador&pp=1&cpf=$cpf';</script>";
	}

}?>

<? if($_GET['pp'] == '1'){ ?>
<?
$busca_cpf_bilhete = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE cliente = '".$_GET['cpf']."' ORDER BY id DESC");
if(mysqli_num_rows($busca_cpf_bilhete) == ''){
echo "Não encontrado bilhetes para o cpf informado!";
}else{
?>
<table width="990" border="0">
  <tr>
    <td align="center" width="60" height="23" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
    <td align="center" width="82" bgcolor="#CCCCCC"><strong>BILHETE</strong></td>
    <td align="center" width="54" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td align="center" width="50" bgcolor="#CCCCCC"><strong>JOGO</strong></td>
    <td align="center" width="130" bgcolor="#CCCCCC"><strong>DATA DA APOSTA</strong></td>
    <td align="center" width="60" bgcolor="#CCCCCC"><strong>PLACA 1</strong></td>
    <td align="center" width="60" bgcolor="#CCCCCC"><strong>PLACAR 2</strong></td>
    <td align="center" width="98" bgcolor="#CCCCCC"><strong>FORM.PGTO</strong></td>
    <td align="center" width="70" bgcolor="#CCCCCC"><strong>V. PRÊMIO</strong></td>
    <td align="center" width="2" bgcolor="#CCCCCC"><strong></strong></td>
  </tr>
 <? $i; while($res_bilhete_cpf = mysqli_fetch_array($busca_cpf_bilhete)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#D9ECFF'"; }else{ echo "bgcolor='#FFECEC'"; } ?>>
    <td align="center"><? echo $res_bilhete_cpf['status']; ?></td>
    <td align="center"><? echo $num_aposta = $res_bilhete_cpf['num_aposta']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['cliente']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['code_jogo']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['data_completa']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['placar1']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['placar2']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['forma_pagamento_aposta']; ?></td>
    <td align="center"><? echo $res_bilhete_cpf['valor_premio']; ?></td>
    <td align="center">
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/imprimir_comprovante_bolao_da_sorte.php?num_aposta=<? echo $res_bilhete_cpf['num_aposta']; ?>');" href=""><img src="img/imprimir.png" width="20" height="20" border="0" /></a>
    
    </td>
  </tr>
  <? } ?>
</table>




 <? die; }} ?>
 <? if($_GET['pp'] == ''){ ?>

 <form name="" method="post" action="" enctype="multipart/form-data">
 <h2><strong>Informe o cpf do cliente</strong></h2>
 <input type="text" name="cpf" value="<? echo $cpf_cliente; ?>" /><br />
 <input type="submit" class="input" name="enviar" value="Buscar" />
 </form>
 <? } ?>
</div><!-- box_busca_bilhete_jogo -->
<? } // fecha buscador_numero_jogador  ?>




<? if($_GET['p'] == 'conferir_jogo_premiacao'){ ?>
<div id="box_conferir_bilhete">
<h1><strong>Verificar bilhete de jogo</strong><hr /></h1>
<? if(isset($_POST['enviar'])){
	
	$bilhete = $_POST['bilhete'];
	
	$verifica_premio = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$bilhete' AND status = 'Ativo'");
	if(mysqli_num_rows($verifica_premio) == ''){
    	echo "<script language='javascript'>window.alert('BILHETE NÃO ENCONTRADO!');</script>";
	}else{
		while($res_premio = mysqli_fetch_array($verifica_premio)){
			
			$code_jogo = $res_premio['code_jogo'];
			$placar1 = $res_premio['placar1'];
			$placar2 = $res_premio['placar2'];
		
			$conferi_jogo = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '$code_jogo' AND gol1 = '$placar1' AND gol2 = '$placar2'");
			if(mysqli_num_rows($conferi_jogo) == ''){
				echo "<script language='javascript'>window.alert('BILHETE NÃO PREMIADO!');</script>";
			}else{
				echo "<script language='javascript'>window.alert('BILHETE PREMIADO!');</script>";		
			}
		}
	}
	
}?>

 <form name="" method="post" action="" enctype="multipart/form-data">
 <h2><strong>Informe o número do bilhete</strong></h2>
 <input type="text" name="bilhete" /><br />
 <input type="submit" class="input" name="enviar" value="Buscar" />
 </form>
</div><!-- conferir_jogo_premiacao -->
<? } ?>




<? if($_GET['p'] == 'verificar_resultado_jogo'){ ?>
<div id="box_reemprimir">
<h1><strong>Verificar resultado de jogo</strong><hr /></h1>
 <? if(isset($_POST['enviar'])){
	 
  $jogo = $_POST['jogo'];
  
  $sql_busca_jogo = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '$jogo'");
  if(mysqli_num_rows($sql_busca_jogo) == ''){
   	echo "<script language='javascript'>window.alert('Não foi encontrado nenhum jogo com os dados informados!');</script>";
  }else{
	echo "<script language='javascript'>window.location='?p=verificar_resultado_jogo&pp=1&jogo=$jogo';</script>";
  }
 }?>
 
 <? if($_GET['pp'] == '1'){ ?>
 <?
 
 $jogo = $_GET['jogo'];
 $sql_jogo = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '$jogo'");
 	while($res_jogo = mysqli_fetch_array($sql_jogo)){
 ?>
<table align="center" width="990" border="0">
  <tr>
    <td align="center" width="110" bgcolor="#009933"><strong>Código</strong></td>
    <td align="center" width="104" bgcolor="#009933"><strong>Status</strong></td>
    <td align="center" width="44" bgcolor="#009933"><strong>Série</strong></td>
    <td align="center" width="88" bgcolor="#009933"><strong>Data</strong></td>
    <td align="center" width="55" bgcolor="#009933"><strong>Hora</strong></td>
    <td align="center" width="165" bgcolor="#009933"><strong>Time 1</strong></td>
    <td align="center" width="149" bgcolor="#009933"><strong>Time 2</strong></td>
    <td align="center" width="112" bgcolor="#009933"><strong>Gols do time 1</strong></td>
    <td align="center" width="125" bgcolor="#009933"><strong>Gols do time 2</strong></td>
  </tr>
  <tr>
    <td align="center" ><? echo $res_jogo['code']; ?></td>
    <td align="center" ><? echo $res_jogo['status']; ?></td>
    <td align="center" ><? echo $res_jogo['serie']; ?></td>
    <td align="center" ><? echo $res_jogo['data']; ?></td>
    <td align="center" ><? echo $res_jogo['hora']; ?></td>
    <td align="center" ><? $time1 = $res_jogo['time1'];
	
		$sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
			while($res_time1 = mysqli_fetch_array($sql_time1)){
					echo $res_time1['time'];
				}
	
	 ?></td>
    <td align="center" ><? $time2 = $res_jogo['time2'];
	
		$sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
			while($res_time2 = mysqli_fetch_array($sql_time2)){
					echo $res_time2['time'];
				}
	
	 ?></td>   
    <td align="center" ><? echo $gol1 = $res_jogo['gol1']; ?></td>
    <td align="center" ><? echo $gol2 = $res_jogo['gol2']; ?></td>
  </tr>
  <tr>
    <td colspan="9"><hr></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#0099CC"><strong>Q. Apostas</strong></td>
    <td align="center" bgcolor="#0099CC"><strong>V. acumulado</strong></td>
    <td colspan="2" align="center" bgcolor="#0099CC"><strong>Sorteio Anterior</strong></td>
    <td align="center" colspan="2" bgcolor="#0099CC"><strong>Quant. Ganhadores</strong></td>
    <td align="center" colspan="3" bgcolor="#0099CC"><strong>V. a receber por cada ganhador</strong></td>
  </tr>
  <tr>
    <td align="center"><? echo $quant_aposta = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE code_jogo = '$jogo' AND status = 'Ativo'")); ?></td>
    <td align="center">R$ <? echo number_format($quant_aposta*0.5898,2); ?></td>
    <td colspan="2" align="center"><? echo number_format($res_jogo['s_anterior'],2); ?></td>
    <td colspan="2" align="center"><? echo (mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE code_jogo = '".$res_jogo['code']."' AND status = 'premiado'"))); ?></td>
    <td colspan="3" align="center">R$ 
    <?
	$sql_busca_premio = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE code_jogo = '".$res_jogo['code']."' AND status = 'premiado' LIMIT 1");
		while($res_premiado = mysqli_fetch_array($sql_busca_premio)){
			echo number_format($res_premiado['valor_premio'],2);
		}
	?>	
    </td>
  </tr>
  <tr>
    <td colspan="9"><hr></td>
  </tr>
</table>

 <? }// mostra jogo ?>
  
 <? die;} // mostra o resultado do jogo ?> 
 
 
 
 <form name="" method="post" action="" enctype="multipart/form-data">
 <h2><strong>Informe o código do jogo</strong></h2>
 <input type="text" name="jogo" /><br />
 <input type="submit" class="input" name="enviar" value="Buscar" />
 </form>
</div><!-- box_resultado_jogo -->

<? } //fecha verificar_resultado_jogo ?>




<? if($_GET['p'] == 'reempressao_bilhete_jogo'){ ?>
<div id="box_reemprimir">
 <h1><strong>Reimpressão de bilhete de jogo</strong><hr /></h1>
 <? if(isset($_POST['enviar'])){
	 
  $bilhete = $_POST['bilhete'];
  
  $sql_busca_bilhete = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$bilhete' OR autenticacao = '$bilhete'");
  if(mysqli_num_rows($sql_busca_bilhete) == ''){
   	echo "<script language='javascript'>window.alert('Não foi encontrado nenhuma aposta com os dados informados!');</script>";
  }else{
	echo "<script language='javascript'>window.location='?p=reempressao_bilhete_jogo&pp=1&num_aposta=$bilhete';</script>";
  }
 }?>


 <? if($_GET['pp'] == '1'){ ?>
 <h2><strong>Bilhete de aposta encontrado com sucessso!</strong></h2>
	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/imprimir_comprovante_bolao_da_sorte.php?num_aposta=<? echo $_GET['num_aposta']; ?>');" href=""><strong>IMPRIMIR Bilhete</strong></a><br />
 <? } // fecha o pp 1 ?>




 <? if($_GET['pp'] == ''){ ?>
 <form name="" method="post" action="" enctype="multipart/form-data">
 <h2><strong>Informe o número da aposta o código de atenticação</strong></h2>
 <input type="text" name="bilhete" /><br />
 <input type="submit" class="input" name="enviar" value="Buscar" />
 </form>
 <? } // fehca o pp 0 ?>
 </div><!-- box_reemprimir -->
<? }// reiprimir bilhete de jogo ?>





<? if($_GET['p'] == 'cancela_um_bilhete'){ ?>
<div id="box_cancela_jogo">
<? if(isset($_POST['button'])){

$n_bilhete = $_POST['n_bilhete'];
$code_partida = $_POST['code_partida'];
$cpf_cliente = $_POST['cpf_cliente'];


$verifica_jogo = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$n_bilhete' AND code_jogo = '$code_partida' AND cliente = '$cpf_cliente' AND status = 'Ativo'");
if(mysqli_num_rows($verifica_jogo) == ''){
   	echo "<script language='javascript'>window.alert('BILHETE DE JOGO NÃO ENCONTRADO OU O MESMO JÁ FOI CANCELADO!');</script>";
}else{
	
	while($res_jogo = mysqli_fetch_array($verifica_jogo)){
	
	$operador_bilhete = $res_jogo['operador'];

mysqli_query($conexao_bd, "UPDATE bolaodasorte SET status = 'CANCELADO' WHERE num_aposta = '$n_bilhete' AND code_jogo = '$code_partida' AND cliente = '$cpf_cliente'");

	mysqli_query($conexao_bd, "INSERT INTO comissao (data, data_completa, mes, ano, status, operador, descricao, valor, ip, cliente) VALUES ('$data', '$data_conpleta', '$mes', '$ano', 'DEBITO', '$operador_bilhete', 'CANCELAMENTO DE BILHETE DE APOSTA BOLÃO DA SORTE', '0.12', '$ip', '$cpf_cliente')");

	$sql_gera_score = mysqli_query($conexao_bd, "INSERT INTO score (code, cliente, data, operacao, descricao, seguranca, valor_score) VALUES ('$n_bilhete', '$cpf_cliente', '$data', 'DEBITO', 'CANCELAMENTO DE BILHETE BOLÃO DA SORTE', 'NO CAIXA DA LOJA', '2')");

	echo "<script language='javascript'>window.location='?p=cancela_um_bilhete&num_aposta=$n_bilhete&pp=1';</script>";
}}}
?>




<? if($_GET['pp'] == '1'){ ?>


<h2>Bilhete cancelado com sucesso!</h2>

	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/imprimir_comprovante_bolao_da_sorte.php?num_aposta=<? echo $_GET['num_aposta']; ?>');" href=""><strong>IMPRIMIR COMPROVANTE</strong></a><br /><br />
<? } // cancela um bilhete ?>






<? if($_GET['pp'] == ''){ ?>

<h1><strong>CANCELAR UM BILHETE DE APOSTA</strong><hr /></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td><strong>NÚMERO DO BILHETE</strong></td>
    <td><strong>CÓDIGO DO JOGO</strong></td>
    <td><strong>CPF DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input type="text" name="n_bilhete" id="textfield"></td>
    <td><label for="textfield2"></label>
    <input type="text" name="code_partida" id="textfield2"></td>
    <td><label for="textfield3"></label>
    <input name="cpf_cliente" type="text" id="textfield3" maxlength="11" value="<? echo $cpf_cliente; ?>"></td>
  </tr>
  <tr>
    <td align="center" height="23" colspan="3"><hr /></td>
  </tr>
  <tr>
    <td align="center" height="23" colspan="3"><input class="input" type="submit" name="button" id="button" value="CONFIRMAR"></td>
  </tr>
</table>
</form>
<hr />
<ul>
<li>Ao cancelar um jogo não será possível ativar novamente, para isso, você deve fazer um novo jogo</li>
<li>Lembre o cliente que ao cancelar um bilhete de aposta o mesmo não poderá receber o prêmio em caso de acerto do placar.</li>
<li>Informe o cliente que seu SCORE de crédito será prejudicado ao cancelar este jogo.</li>
</ul>
<? }// fecha ?>
</div><!-- box_cancela_jogo -->
<? }// cancela um bilhete de jogo ?>

<? if($_GET['p'] == ''){ ?>
<div id="box_corpo">
<h1><strong>Lista de códigos da SESSÃO DE JOGOS</strong><hr /></h1>
<ul>
<li><strong>200 - JOGOS</strong> - Mostra todos os códigos da operação de jogos<hr /></li>
<li><strong>201 - Fazer Bolão da Sorte</strong> - Fazer um jogo do Bolão da Sorte<hr />
	<ul>
    <li>2010 - Cancela um bilhete de aposta</li>
    <li>2011 - Reemprimir comprovante de jogo</li>
    <li>2012 - Conferir bilhete em caso de premiação</li>
    <li>2013 - Fazer pagamento de jogo</li>
    <li>2014 - Verificar resultado de jogo - Use este código para verificar acumulado que uma determinada partida obteve</li>
    <li>2015 - Buscar número do bilhete pelo jogador</li>
    <li>2017 - Próximos jogos do Bolão da Sorte</li>
    </ul>
</li>
<li><strong>208 - Verificar saldo com venda de jogos</strong> - Verificar o relatório de vendas de jogos<hr />
	<ul>
    <li>2010 - Cancela uma aposta</li>
    <li>2011 - Reemprimir comprovante de jogo</li>
    <li>2012 - Conferir bilhete em caso de premiação</li>
    <li>2013 - Fazer pagamento de jogo</li>
    <li>2014 - Verificar resultado de jogo</li>
    <li>2015 - Lista todos os apostadores</li>
    <li>2016 - Verificar valorees acumulados</li>
    <li>2017 - Próximos jogos do Bolão da Sorte</li>
    </ul>
</li>
</ul>
</div><!-- box_corpo -->
<? }// EXIBE O CÓDIGO DOS JOGOS  ?>




<? if($_GET['p'] == 'fazer_jogo_bolao_da_sorte'){ ?>
<div id="box_fazer_jogo_bolao_da_sorte">
<? if($_GET['p_fazer_bolao'] == ''){ ?>
<h1><strong>1º) ESCOLHA A DATA DO JOGO</strong></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprytextfield3">
  <input type="text" name="data" value="<? echo date("d/m/Y"); ?>" />
  <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
  <br />
 <input class="input" type="submit" name="avan" value="Avançar" />
 </form>
<? if(isset($_POST['avan'])){
	$data = base64_encode($_POST['data']);
	echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte&p_fazer_bolao=2&data=$data';</script>";
}?>
<? }//ESCOLHA A DATA DO JOGO ?>





<? if($_GET['p_fazer_bolao'] == '2'){ ?>
<h1><strong>2º) ESCOLHA A SÉRIE DOS TIMES DE FUTEBOL</strong></h1>
<h1>Data: <? echo base64_decode($_GET['data']); ?></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <input type="text" name="data" value="A" />
  <br />
 <input class="input" type="submit" name="avan" value="Avançar" />
 </form>
<? if(isset($_POST['avan'])){
	$serie = strtoupper($_POST['data']);
	$data = $_GET['data'];
	echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte&p_fazer_bolao=3&data=$data&serie=$serie';</script>";
}?>
<? }//ESCOLHA A DATA DO JOGO ?>



<? if($_GET['p_fazer_bolao'] == '3'){ ?>
<h1><strong>3º) ESCOLHA UMA DAS PARTIDAS - Data: <? echo $data = base64_decode($_GET['data']); ?></strong></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <input class="input2" type="text" name="code" value="" />
 <input class="input3" type="submit" name="avan" value="Avançar" />
 </form>
<? if(isset($_POST['avan'])){
	$serie = strtoupper($_POST['data']);
	$data = $_GET['data'];
	$code_jogo = $_POST['code'];
	
	echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte&p_fazer_bolao=4&code_jogo=$code_jogo';</script>";
}?>

<?

$sql_select = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE data = '$data' AND serie = '".$_GET['serie']."'");
if(mysqli_num_rows($sql_select) == ''){
	echo "Não foram encontradas partidas para essa data";
}else{
?>

<table width="990" border="0">
  <tr>
    <td width="45" bgcolor="#666666"><strong>COD.</strong></td>
    <td width="26" bgcolor="#666666">&nbsp;</td>
    <td width="338" bgcolor="#666666"><strong>TIME 1</strong></td>
    <td width="16" bgcolor="#666666">&nbsp;</td>
    <td width="22" bgcolor="#666666">&nbsp;</td>
    <td width="341" bgcolor="#666666"><strong>TIME 2</strong></td>
    <td bgcolor="#666666"><strong>DATA</strong></td>
    <td bgcolor="#666666"><strong>HORA</strong></td>
  </tr>
  <? $i=0; 
  while($res_sql = mysqli_fetch_array($sql_select)){  $i++;
  $time1 = $res_sql['time1']; 
  $time2 = $res_sql['time2'];
 
  ?>
  	
  <tr <? if($i%2 == 0){ echo "bgcolor='#D9ECFF'"; }else{ echo "bgcolor='#FFEFDF'"; }?>>
    <td>
	<? 
	
	 if($res_sql['status'] != 'Ativo'){
		 echo "AE";
	 }else{
		echo $res_sql['code'];
	}
	?>
    
    </td>
    <?
    
	$sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
	while($res_sql_time1 = mysqli_fetch_array($sql_time1)){ 
	
	?>
    <td width="26"><img src="<? echo $res_sql_time1['logo']; ?>" alt="" width="20" height="20"/></td>
    <td width="338"><? echo $res_sql_time1['time']; ?></td>
    <? } ?>
    
    <td width="16">X</td>
    
    
    <?
	$sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
	while($res_sql_time2 = mysqli_fetch_array($sql_time2)){ 
	?>
    <td width="26" ><img src="<? echo $res_sql_time2['logo']; ?>" alt="" width="20" height="20"/></td>
    <td width="341" ><? echo $res_sql_time2['time']; ?></td>
    <? } ?>
    
    <td width="94" ><? echo $res_sql['data']; ?></td>
    <td width="56"><? echo $res_sql['hora']; ?></td>
  </tr>
  <? } // fecha o wgile de exibição  ?>
  </table>
<? }// fecha a busca por partidas ?>

<? }//ESCOLHA A DATA DO JOGO ?>





<? if($_GET['p_fazer_bolao'] == '4'){ ?>
<h1><strong>4º) ESCOLHA O PLACAR DA PARTIDA</strong></h1>
<? if(isset($_POST['Apostar'])){
	$code_jogo = $_GET['code_jogo'];
	$placar1 = $_POST['placar1'];
	$placar2 = $_POST['placar2'];
	
	echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte&p_fazer_bolao=5&code_jogo=$code_jogo&placar1=$placar1&placar2=$placar2';</script>";

}?>

<?
$sql_select = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '".$_GET['code_jogo']."' AND status = 'Ativo'");
if(mysqli_num_rows($sql_select) == ''){
	echo "Não foram encontradas partidas para essa data";
}else{
	while($res_mostra_jogo = mysqli_fetch_array($sql_select)){
	
  $time1 = $res_mostra_jogo['time1']; 
  $time2 = $res_mostra_jogo['time2'];
	
?>
<h2><strong>data do jogo: <? echo $res_mostra_jogo['data']; ?>	- Série: <? echo $res_mostra_jogo['serie']; ?> - Código da partida: <? echo $res_mostra_jogo['code']; ?></strong></h2>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td width="44" bgcolor="#999999"><strong>PLACAR</strong></td>
    <td width="48" bgcolor="#999999">&nbsp;</td>
    <td width="351" bgcolor="#999999">&nbsp;</td>
    <td width="100" bgcolor="#999999">&nbsp;</td>
    <td width="69" bgcolor="#999999"><strong>PLACAR</strong></td>
    <td width="71" bgcolor="#999999">&nbsp;</td>
    <td width="261" bgcolor="#999999">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#DDFFFF"><label for="textfield"></label>
    <input class="input4" name="placar1" type="text" id="textfield" size="5"></td>
    <?
    
	$sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
	while($res_sql_time1 = mysqli_fetch_array($sql_time1)){ 
	
	?>
    <td bgcolor="#DDFFFF"><img src="<? echo $res_sql_time1['logo']; ?>" width="60" height="60" alt=""/></td>
    <td bgcolor="#DDFFFF"><? echo $res_sql_time1['time']; ?></td>
    <? } ?>
    <td bgcolor="#FFB66C">X</td>
    <td bgcolor="#FFD7D7"><input class="input4" name="placar2" type="text" id="textfield2" size="5"></td>
    <?
    
	$sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
	while($res_sql_time2 = mysqli_fetch_array($sql_time2)){ 
	
	?>
    <td bgcolor="#FFD7D7"><img src="<? echo $res_sql_time2['logo']; ?>" alt="" width="60" height="60"/></td>
    <td bgcolor="#FFD7D7"><? echo $res_sql_time2['time']; ?></td>
    <? } ?>
  </tr>
  <tr>
    <td colspan="7"><hr /></td>
  </tr>
  <tr>
    <td align="center" colspan="7"><input class="input5" type="submit" name="Apostar" value="Apostar"></td>
  </tr>
</table>
</form>

<? }} // fecha o while de encontrado ?>

<? } // não encontra jogo ?>







<? if($_GET['p_fazer_bolao'] == '5'){ ?>
<h1><strong>5º) INFORMAÇÕES DO JOGADOR</strong></h1>
<? if(isset($_POST['enviar'])){
	$cpf_cliente = $_POST['cpf_cliente'];
	$nacimento_cliente = $_POST['nacimento_cliente'];
	$telefone_cliente = $_POST['telefone_cliente'];
	$forma_pagamento = $_POST['forma_pagamento'];
	$code_jogo = $_GET['code_jogo'];
	$placar1 = $_GET['placar1'];
	$placar2 = $_GET['placar2'];

	
	$num_aposta = rand()+$ano+$mes+$dia+$cpf_cliente+$placar1+$placar2+$code_jogo+rand();
	$autenticacao = md5($num_aposta);
	$code_carrinho = rand();
	
	$faz_aposta = mysqli_query($conexao_bd, "INSERT INTO bolaodasorte (data, dia, mes, ano, data_completa, status, code_jogo, num_aposta, cliente, placar1, placar2, valor_aposta, forma_pagamento_aposta, autenticacao, operador) VALUES ('$data', '$dia', '$mes', '$ano', '$data_completa', 'Ativo', '$code_jogo', '$num_aposta', '$cpf_cliente', '$placar1', '$placar2', '1.00', '$forma_pagamento', '$autenticacao', '$operador')");

	mysqli_query($conexao_bd, "INSERT INTO comissao (data, data_completa, mes, ano, status, operador, descricao, valor, ip, cliente) VALUES ('$data', '$data_conpleta', '$mes', '$ano', 'CREDITO', '$operador', 'BILHETE DE APOSTA BOLÃO DA SORTE', '0.12', '$ip', '$cpf_cliente')");

	
	$verifica_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
	if(mysqli_num_rows($verifica_cliente) == ''){
	   mysqli_query($conexao_bd, "INSERT INTO clientes (cpf, nascimento, celular_1) VALUES ('$cpf_cliente', '$nacimento_cliente', '$telefone_cliente')");
	}else{
	}
	
	$sql_gera_score = mysqli_query($conexao_bd, "INSERT INTO score (code, cliente, data, operacao, descricao, seguranca, valor_score) VALUES ('$num_aposta', '$cpf_cliente', '$data', 'CREDITO', 'COMPRA DE JOGO BOLÃO DA SORTE', 'NO CAIXA DA LOJA', '1')");
	
	
	$verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
	if(mysqli_num_rows($verifica_carrinho) == ''){
		mysqli_query($conexao_bd, "INSERT INTO carrinho (ip, code_carrinho, hora_abertura, data, status, cliente, operador) VALUES ('$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$cpf_cliente', '$operador')");
		mysqli_query($conexao_bd, "INSERT INTO produtos_caixa (ip, code_carrinho, data, status, operador, cliente, tipo, quant, valor, code_produto) VALUES ('$ip', '$code_carrinho', '$data', 'Ativo', '$operador', '$cpf_cliente', 'SERVIÇO', '1', '1.0', '15937')");
	}else{
		while($res_carrinho = mysqli_fetch_array($verifica_carrinho)){
			
			$code_carrinho = $res_carrinho['code_carrinho'];
			$cliente = $res_carrinho['cliente'];
			$valor = $res_carrinho['valor'];
			$ip_c = $res_carrinho['ip'];
			
			$verifica_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE ip = '$ip_c' AND code_carrinho = '$code_carrinho' AND status = 'Ativo' AND code_produto = '15937'");
			if(mysqli_num_rows($verifica_produtos) == ''){
			mysqli_query($conexao_bd, "INSERT INTO produtos_caixa (ip, code_carrinho, data, status, operador, cliente, tipo, quant, valor, code_produto) VALUES ('$ip', '$code_carrinho', '$data', 'Ativo', '$operador', '$cpf_cliente', 'SERVIÇO', '1', '1.0', '15937')");

			}else{
				
				while($res_produtos_carrinho = mysqli_fetch_array($verifica_produtos)){
					
						$quant = $res_produtos_carrinho['quant']+1;
						$valor = $res_produtos_carrinho['valor']+1;
						$id_produto = $res_produtos_carrinho['id'];
						
						mysqli_query($conexao_bd, "UPDATE produtos_caixa SET quant = 	'$quant', valor = '$valor' WHERE id = '$id_produto'");
						
					}
				
			}
		}
	}
	
		
	echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte&p_fazer_bolao=7&num_aposta=$num_aposta';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr bgcolor="#B7FFFF">
    <td width="306"><strong>CPF</strong></td>
    <td width="390"><strong>DATA DE NASCIMENTO</strong></td>
    <td width="272"><strong>TELEFONE</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield3333">
      <input name="cpf_cliente" type="text" class="input6" value="<? echo $cpf_cliente; ?>" maxlength="11">
</span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield111111">
      <input class="input6" type="text" name="nacimento_cliente" value="<? echo $nacimento_cliente; ?>">
      </span></td>
    <td><label for="textfield3"></label>
      <span id="sprytextfield2222">
      <input class="input6" type="text" name="telefone_cliente" value="<? echo $telefone_cliente; ?>">
    <span class="textfieldRequiredMsg"> </span></span></td>
  </tr>
  <tr>
    <td colspan="3"><strong>FORMA DE PAGAMENTO:</strong><br />
    <select name="forma_pagamento">
     <option value="Easy Card">1 - Easy Card</option>
     <option value="Dinhero">2 - Dinheiro</option>
     <option value="Cartão de Crédito">3 - Cartão de Crédito</option>
     <option value="Cartão de débito">4 - Cartão de débito</option>
     <option value="Cheque">5 - Cheque</option>
     <option value="Débito em conta">6 - Débito em conta</option>
    </select>
    </td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
   <tr>
    <td colspan="3"><input class="input5" type="submit" name="enviar" id="button" value="Apostar"></td>
  </tr>
</table>
</form>
<? } // FECHA OS DADOS DO CLIENTE ?>




<? if($_GET['p_fazer_bolao'] == '7'){ ?>
<h1><strong>6º) JOGO EFETUADO COM SUCESSO</strong></h1>
	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/imprimir_comprovante_bolao_da_sorte.php?num_aposta=<? echo $_GET['num_aposta']; ?>');" href=""><strong>IMPRIMIR BILHETE</strong></a><br /><br />
<?
$num_aposta = $_GET['num_aposta'];

$sql_select = mysqli_query($conexao_bd, "SELECT * FROM bolaodasorte WHERE num_aposta = '$num_aposta'");
if(mysqli_num_rows($sql_select) == ''){
	echo "Não foram encontradas apostas com o número";
}else{
	while($res_mostra_aposta = mysqli_fetch_array($sql_select)){
	
  $time1 = $res_mostra_aposta['time1']; 
  $time2 = $res_mostra_aposta['time2'];
  
	
  $placar1 = $res_mostra_aposta['placar1']; 
  $placar2 = $res_mostra_aposta['placar2'];
  

  
 $sql_partida = mysqli_query($conexao_bd, "SELECT * FROM partida WHERE code = '".$res_mostra_aposta['code_jogo']."'");
	while($res_partida = mysqli_fetch_array($sql_partida)){

	  $data_jogo = $res_partida['data'];
	  $code_jogo = $res_partida['code'];	

	  $time1 = $res_partida['time1'];	
	  $time2 = $res_partida['time2'];	

  
 $sql_time1 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time1'");
	while($res_time1 = mysqli_fetch_array($sql_time1)){

	  $nome_time1 = $res_time1['time'];	

  
 $sql_time2 = mysqli_query($conexao_bd, "SELECT * FROM time WHERE id = '$time2'");
	while($res_time2 = mysqli_fetch_array($sql_time2)){
		
	  $nome_time2 = $res_time2['time'];	

	
?>
<table class="table" width="990" border="0">
  <tr>
    <td align="center" colspan="3"><p><strong>EASY LOAN
    </strong></p>
    <p><strong>BILHETE DE APOSTA - BOLÃO DA SORTE</strong></p>      <hr></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="74">CLIENTE</td>
    <td width="93">DATA</td>
    <td width="91">STATUS</td>
  </tr>
  <tr>
    <td><? echo $res_mostra_aposta['cliente']; ?></td>
    <td><? echo $res_mostra_aposta['data_completa']; ?></td>
    <td><? echo $res_mostra_aposta['status']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC" colspan="3">AUTENTICAÇAO</td>
  </tr>
  <tr>
    <td colspan="3"><? echo $res_mostra_aposta['autenticacao']; ?></td>
  </tr>
  <tr bgcolor="#CCC">
    <td>D. JOGO</td>
    <td>COD.JOGO</td>
    <td>V. APOSTA</td>
  </tr>
  <tr>
    <td><? echo $data_jogo; ?></td>
    <td><? echo $code_jogo; ?></td>
    <td>R$ <? echo number_format($res_mostra_aposta['valor_aposta'],2); ?></td>
  </tr>
  <tr>
    <td bgcolor="#999900" colspan="3"><strong><? echo $placar1; ?> <? echo $nome_time1; ?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#999900" colspan="3"><strong><? echo $placar2; ?> <? echo $nome_time2; ?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#FFF" align="center" colspan="3"><hr>
      <p>ATENÇÃO: SE O SEU BILHETE FOR SORTEADO, O VALOR DA SUA PREMIAÇÃO IRÁ PARA SUA CONTA EASY LOAN, CASO O CLIENTE NÃO POSSUIR CONTA, A APRESENTAÇÃO DESTE BILHETE É OBRIGATÓRIA PARA REGATE DO PRÊMIO.</p>
      <p>PARA REGATE DO PRÊMIO </p></td>
  </tr>
</table>
<? }}}}}// fecha a busca por aposta ?>


<? } // fecha o 7 ?>

</div><!-- fazer_jogo_bolao_da_sorte -->
<? }// fazer_jogo_bolao_da_sorte  ?>





<? require "rodape.php"; ?>
<script type="text/javascript">
var sprytextfield111111 = new Spry.Widget.ValidationTextField("sprytextfield111111", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2222 = new Spry.Widget.ValidationTextField("sprytextfield2222", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000"});
var sprytextfield3333 = new Spry.Widget.ValidationTextField("sprytextfield3333", "none");
</script>
</body>
</html>