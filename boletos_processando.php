<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/boletos_processando.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<?

require "espiaBoleto.php";

mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET confirma_boleto_vencido = '' WHERE status = 'Aguarda'");

$vencimento_boleto = 0;
$code_boleto = 0;
$code_vencimento_hoje = 0;
$id_boleto = 0;

$verifica_code_vencimento_hoje = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	while($res_code_boleto = mysqli_fetch_array($verifica_code_vencimento_hoje)){
			$code_vencimento_hoje = $res_code_boleto['codigo'];
	}

$verifica_boleto =  mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE status = 'Aguarda'");
	while($res_verifica_boleto = mysqli_fetch_array($verifica_boleto)){
			$vencimento_boleto = $res_verifica_boleto['vencimento'];
			$id_boleto = $res_verifica_boleto['id'];
			
			
			$verifica_code_vencimento_hoje = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$vencimento_boleto'");
				while($res_code_boleto = mysqli_fetch_array($verifica_code_vencimento_hoje)){
						$code_boleto = $res_code_boleto['codigo'];
				}
				
				if($code_vencimento_hoje >= $code_boleto){ 
					mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET confirma_boleto_vencido = 'SIM' WHERE id = '$id_boleto'");
				}
			
	}



?>





<div id="box_pagamento_1">
<hr />
<h1><strong>LISTA DE BOLETOS QUE AGUARDAM SER EFETIVADOS</strong> <a target="_blank" href="scripts/relatorio_de_boletos.php"><img title="IMPRIMIR RELATÓRIO DE BOLETOS" class="img" src="img/imprimir.png" border="0" width="25" height="25" /></a></a></h1>
 <?
 
 $sql_boleto = 0;
 if($operador == '05379839371'){
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE status = 'Aguarda' ORDER BY codeVencimento ASC");
 }else{
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE status = 'Aguarda' AND operador = '$operador' AND data = '$data'");
 } 
 if(mysqli_num_rows($sql_boleto) == ''){
 }else{
 ?>
 <em>Existe <? echo mysqli_num_rows($sql_boleto); ?> pagamentos aguardando serem efetivados...</em>
<hr />
<table class="table table-bordered table-dark table-hover" style="border-radius:10px; font:10px Arial, Helvetica, sans-serif; border:2px solid #666;" width="1000" border="0">
  <tr>
    <td width="59" bgcolor="#006699"><strong>tipo</strong></td>
    <td width="130" bgcolor="#006699"><strong>BENEFICIÁRIO</strong></td>
    <td width="250" bgcolor="#006699"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="60" bgcolor="#006699"><strong>VALOR</strong></td>
    <td width="46" bgcolor="#006699"><strong>JUROS</strong></td>
    <td colspan="2" bgcolor="#006699"><strong>FORM. PAGT</strong></td>
    <td width="68" bgcolor="#006699"><strong>VENCIMENTO</strong></td>
    <td width="44" bgcolor="#006699"><strong>CLIENTE</strong></td>
    <td width="91" bgcolor="#006699"><strong>TELEFONE</strong></td>
    <td width="119" bgcolor="#006699"><strong>OPÇÕES</strong></td>
  </tr>
  <?
  $i = 0; $total = 0;
   	$totalDae = 0;
	$totalConvenio = 0;
	$totalTitulo = 0;
	
   while($res_boleto = mysqli_fetch_array($sql_boleto)){  

	

   	
	if($res_boleto['invisivel'] == 'SIM' && $tipo != 'ADM'){
	}else{
   
   	if($res_boleto['confirma_boleto_vencido'] == 'SIM' || $res_boleto['vencimento'] == $data || $res_boleto['boleto_vencido'] > 0){

	if($res_boleto['banco'] == 'DAE ESTADO CEARA'){ $totalDae += $res_boleto['valor']; }
	if($res_boleto['tipo'] == 'CONVENIO'){ $totalConvenio += $res_boleto['valor']; }
	if($res_boleto['tipo'] == 'BOLETO'){ $totalTitulo += $res_boleto['valor']+$res_boleto['juros']-$res_boleto['desconto']; }
	
	   $i++;
   ?>
  <? if($tipo == 'ADM' && $res_boleto['operador'] == '60425441369'){  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
  <? } ?>
    <td><? echo $res_boleto['tipo']; ?></td>
    <td>
	<?
	if($res_boleto['tipo'] == 'CONVENIO'){
		echo $res_boleto['banco'];
	}else{
    $banco = $res_boleto['banco'];
	if($banco == 'VESTEPRIMECARD'){
		echo "VESTE PRIME CARD";
	}elseif($banco == 'CREDIMAIS'){
		echo "CREDIMAIS";
	}else{
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
	  }
	 }
	}
	?>	
    </td>
    <td><? echo $res_boleto['code_barras']; ?></td>
    <td><? $total = $res_boleto['valor']+$total+$res_boleto['juros']; echo number_format($res_boleto['valor']-$res_boleto['desconto'], 2, ',', '.'); ?></td>
    <td><? echo number_format($res_boleto['juros'],2,',','.'); ?></td>
    <td colspan="2"><? 

	
		$conjunto = 0;
		if($res_boleto['conjunto'] >= 1){
			$conjunto = 1;
		}
		
		if($conjunto >= 1){
			$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '".$res_boleto['conjunto']."'");
			if(mysqli_num_rows($sql_verifica_pagamentos) >= 1){
				echo "CONJUNTO";
			}else{
				echo "NAO PAGO";
			}
			
		}else{
		
	
	$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '".$res_boleto['code_boleto']."' LIMIT 1");
		while($res_verifica_pagamento = mysqli_fetch_array($sql_verifica_pagamentos)){
				echo $res_verifica_pagamento['forma_pagamento'];
				$convenio = 0;
			}
		}
	 ?></td>
    <td><a rel="superbox[iframe][300x70]" href="scripts/alterarVencimento.php?id=<? echo $res_boleto['id']; ?>"><? if($res_boleto['vencimento'] == ''){ echo "Adicionar"; }else{echo $res_boleto['vencimento']; } ?></a>
    </td>
    <td><a rel="superbox[iframe][300x70]" href="scripts/mostrar_cliente.php?cliente=<? echo $res_boleto['cliente']; ?>"><? echo $res_boleto['cliente']; ?></a></td>
    <td><? echo $res_boleto['telefone']; ?></td>
    <td>
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    
     <a onclick="abrirCodigoBarrasBoleto(<? echo $res_boleto['id']; ?>);" style="float:center; margin:-5px 0 0 10px;" href="#"><img width="15" title="Gerar código de barras desse produto" height="12" src="https://cdn.icon-icons.com/icons2/179/PNG/128/barcode_reader_128x128-32_22291.png" /></a>
    
    <? 
	if($operador == '05379839371'){?>
    <a onclick="abrePopUp('scripts/comprovante_de_pagamento_de_titulos.php?code_boleto=<? echo $res_boleto['code_boleto']; ?>');" href=""><img src="img/imprimir.png" width="15" height="15" border="0" title="EMITIR 2º VIA DO COMPROVANTE" /></a>
    <a rel="superbox[iframe][975x300]" href="scripts/cancela_boleto.php?id=<? echo $res_boleto['id']; ?>"><img src="img/deleta.fw.png" width="15" height="15" border="0" title="Cancelar boleto" /></a>
    <? } ?>
    
    
    <a rel="superbox[iframe][920x250]" href="scripts/informacoes_pagamento.php?id=<? echo $res_boleto['id']; ?>"><img src="img/mais_informacoes.png" width="15" height="15" border="0" title="VERIFICAR INFORMAÇÕES DO PAGAMENTO" /></a>
    <a rel="superbox[iframe][1050x410]" href="scripts/efetivar_pagamento.php?banco=<? echo $res_boleto['banco']; ?>&id=<? echo $res_boleto['id']; ?>&operador=<? echo $operador; ?>&code_barras=<? echo $res_boleto['code_barras']; ?>"><img src="img/correto.fw.png" width="15" height="15" border="0" title="EFETIVAR PAGAMENTOS" /></a>
    
    </td>
  </tr>
  <? }}} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR</strong></td>
    <td><? echo number_format($total, 2, ',', '.'); ?></td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr class="table-success">
    <td colspan="3" align="left" bgcolor="#666600"><strong>TOTAL EM DAE:</strong> R$ <? echo number_format($totalDae, 2, ',', '.'); ?></td>
    <td colspan="3" align="left" bgcolor="#0099CC"><strong>CONVENIO:</strong> R$ <? echo number_format($totalConvenio-$totalDae, 2, ',', '.'); ?></td>
    <td colspan="5" align="left" bgcolor="#009900"><strong>TITULOS:</strong> R$ <? echo number_format($totalTitulo, 2, ',', '.'); ?></td>
    </tr>
  </table>
<? } ?>


<script>
  function abrirCodigoBarrasBoleto(id){
	  	var url = "scripts/barcode/example/codigoBarrasBoleto.php?id="+id;
        var width = 400;
        var height = 400;
        var left = (window.innerWidth - width) / 2;
        var top = (window.innerHeight - height) / 2;
        
        window.open(url, "Popup", "width=" + width + ",height=" + height + ",left=" + left + ",top=" + top);
 }
</script>



<hr />
 <?
 
 $sql_boleto = 0;
 $totalDae = 0;
 $totalConvenio = 0;
 $totalTitulo = 0;
 
 
 if($tipo == 'ADM'){
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE status = 'Aguarda' AND vencimento != '$data' AND confirma_boleto_vencido != 'SIM' ORDER BY codeVencimento ASC");
 }else{
 $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE operador = '$operador' AND status = 'Aguarda' AND data = '$data' AND vencimento != '$data' AND confirma_boleto_vencido != 'SIM' ORDER BY STR_TO_DATE(vencimento, '%d/%m/%Y') ASC");
 }
  
 if(mysqli_num_rows($sql_boleto) == ''){
	 echo "Não tem nenhum boleto na fila aguardando efetivação!";
 }else{
 ?>
<table width="1000" class="table table-bordered table-dark table-hover" style="border-radius:10px; font:10px Arial, Helvetica, sans-serif; border:2px solid #666;" border="0">
  <tr>
    <td width="64"><strong>TIPO</strong></td>
    <td width="132"><strong>BENEFICIÁRIO</strong></td>
    <td width="215"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="48"><strong>VALOR</strong></td>
    <td width="48"><strong>JUROS</strong></td>
    <td width="126"><strong>FORM. PAGT</strong></td>
    <td width="68"><strong>VENCIMENTO</strong></td>
    <td width="44"><strong>CLIENTE</strong></td>
    <td width="87"><strong>TELEFONE</strong></td>
    <td width="122"><strong>OPÇÕES</strong></td>
  </tr>
  <?
  $i = 0; $total = 0;
   while($res_boleto = mysqli_fetch_array($sql_boleto)){ $i++;
   
   	if($res_boleto['banco'] == 'DAE ESTADO CEARA'){ $totalDae += $res_boleto['valor']; }
	if($res_boleto['tipo'] == 'CONVENIO'){ $totalConvenio += $res_boleto['valor']; }
	if($res_boleto['tipo'] == 'BOLETO'){ $totalTitulo += ($res_boleto['valor']+$res_boleto['juros']-$res_boleto['desconto']); }
	
   
	if($res_boleto['invisivel'] == 'SIM' && $tipo != 'ADM'){
	}else{   
   
   ?>
  <? if($tipo == 'ADM' && $res_boleto['operador'] == '60425441369'){  ?>
  <tr <? if($i%2 == 0){ echo "class='table-primary'"; }else{ echo "class='table-secondary'"; } ?>>
  <? } ?>
    <td><? echo $res_boleto['tipo']; ?></td>
    <td>
	<?
	if($res_boleto['tipo'] == 'CONVENIO'){
		echo $res_boleto['banco'];
	}else{
    $banco = $res_boleto['banco'];
	
	if($banco == 'VESTEPRIMECARD'){
		echo "VESTE PRIME CARD";
	}elseif($banco == 'CREDIMAIS'){
		echo "CREDIMAIS";
	}else{
	
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
	  }
	 }
	}
	?>	
    </td>
    <td><? echo $res_boleto['code_barras']; ?></td>
    <td><? $total = $res_boleto['valor']+$total+$res_boleto['juros']; echo number_format($res_boleto['valor']-$res_boleto['desconto'], 2, ',', '.'); ?></td>
    <td><? echo number_format($res_boleto['juros'],2,',','.'); ?></td>
    <td><? 
	$convenio = 0;
	
		$conjunto = 0;
		if($res_boleto['conjunto'] >= 1){
			$conjunto = 1;
		}
		
		if($conjunto >= 1){
			$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE conjunto = '".$res_boleto['conjunto']."'");
			if(mysqli_num_rows($sql_verifica_pagamentos) >= 1){
				echo "CONJUNTO";
			}else{
				echo "NAO PAGO";
			}
			
		}else{
		
	
	$sql_verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '".$res_boleto['code_boleto']."' LIMIT 1");
		while($res_verifica_pagamento = mysqli_fetch_array($sql_verifica_pagamentos)){
				echo $res_verifica_pagamento['forma_pagamento'];
				$convenio = 0;
			}
		}
	 ?></td>    
    <td><a rel="superbox[iframe][300x70]" href="scripts/alterarVencimento.php?id=<? echo $res_boleto['id']; ?>"><? if($res_boleto['vencimento'] == ''){ echo "Adicionar"; }else{echo $res_boleto['vencimento']; } ?></a></td>
    <td><a rel="superbox[iframe][300x70]" href="scripts/mostrar_cliente.php?cliente=<? echo $res_boleto['cliente']; ?>"><? echo $res_boleto['cliente']; ?></a></td>
    <td><? echo $res_boleto['telefone']; ?></td>
    <td>
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script><a onclick="abrirCodigoBarrasBoleto(<? echo $res_boleto['id']; ?>);" style="float:center; margin:-5px 0 0 10px;" href="#"><img width="15" title="Gerar código de barras desse produto" height="12" src="https://cdn.icon-icons.com/icons2/179/PNG/128/barcode_reader_128x128-32_22291.png" /></a>
	
	<? 
	if($operador == '05379839371'){?>
    <a onclick="abrePopUp('scripts/comprovante_de_pagamento_de_titulos.php?code_boleto=<? echo $res_boleto['code_boleto']; ?>');" href=""><img src="img/imprimir.png" width="15" height="15" border="0" title="EMITIR 2º VIA DO COMPROVANTE" /></a>      
    <a rel="superbox[iframe][975x300]" href="scripts/cancela_boleto.php?id=<? echo $res_boleto['id']; ?>"><img src="img/deleta.fw.png" alt="" width="15" height="15" border="0" title="Cancelar boleto" /></a>
    <? } ?>
    
    
    
    <a rel="superbox[iframe][920x250]" href="scripts/informacoes_pagamento.php?id=<? echo $res_boleto['id']; ?>"><img src="img/mais_informacoes.png" width="15" height="15" border="0" title="VERIFICAR INFORMAÇÕES DO PAGAMENTO" /></a>
    <a rel="superbox[iframe][1050x410]" href="scripts/efetivar_pagamento.php?banco=<? echo $res_boleto['banco']; ?>&id=<? echo $res_boleto['id']; ?>&operador=<? echo $operador; ?>&code_barras=<? echo $res_boleto['code_barras']; ?>"><img src="img/correto.fw.png" alt="" width="15" height="15" border="0" title="EFETIVAR PAGAMENTOS" /></a>
    
    </td>
  </tr>
  <? }} ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR</strong></td>
    <td><? echo number_format($total, 2, ',', '.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
    <tr class="table-success">
    <td colspan="3" align="left" bgcolor="#666600"><strong>TOTAL EM DAE:</strong> R$ <? echo number_format($totalDae, 2, ',', '.'); ?></td>
    <td colspan="3" align="left" bgcolor="#0099CC"><strong>CONVENIO:</strong> R$ <? echo number_format($totalConvenio-$totalDae, 2, ',', '.'); ?></td>
    <td colspan="5" align="left" bgcolor="#009900"><strong>TITULOS:</strong> R$ <? echo number_format($totalTitulo, 2, ',', '.'); ?></td>
    </tr>
  </table>
<? } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</div><!-- box_pagamento_1 -->
</body>
</html>