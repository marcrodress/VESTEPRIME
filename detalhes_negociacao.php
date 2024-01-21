<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body table{
	background-color: #000;
	border:1px solid #333;
}
</style>
</head>

<body>
<h1><strong>DETALHE DE NEGOCIAÇÃO</strong></h1>
<hr style="border:1px solid #111;" />
<table width="1000" border="0">
  <tr>
    <td colspan="5" align="left"><h1 style="font:15px Arial, Helvetica, sans-serifr; margin:0; padding:0; color:#CCC;"><strong>NEGOCIA&Ccedil;&Atilde;O DE N&Uacute;MERO: </strong> <? echo $codigo_negociacao = $_GET['code_negociacao']; ?></h1></td>
  </tr>
  <tr>
    <td width="223" bgcolor="#666666">CLIENTE</td>
    <td width="166" bgcolor="#666666">CPF</td>
    <td width="158" bgcolor="#666666">RG</td>
    <td width="175" bgcolor="#666666">TELEFONE</td>
    <td width="256" bgcolor="#666666">E-MAIL</td>
  </tr>
<?
$telefone_cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){
?>
  <tr>
    <td><h3><? echo $res_cliente['nome']; ?></h3></td>
    <td><h3><? echo $res_cliente['cpf']; ?></h3></td>
    <td><h3><? echo $res_cliente['rg']; ?></h3></td>
    <td><h3><? echo $telefone_cliente = $res_cliente['celular_1']; ?></h3></td>
    <td><h3><? echo $res_cliente['email']; ?></h3></td>
  </tr>
<? } ?>
  <tr>
    <td colspan="5"><table class="table" width="996" border="0">
      <tr>
        <td colspan="8" align="left"><h1 style="font:15px Arial, Helvetica, sans-serifr; margin:0; padding:0; color:#CCC;"><strong>DÍVIDAS NEGOCIADAS </strong></h1></td>
      </tr>
      <tr>
        <td width="132" bgcolor="#666666">TIPO</td>
        <td width="193" bgcolor="#666666">VENCIMENTO</td>
        <td width="171" bgcolor="#666666">DIAS EM ATRASO</td>
        <td width="119" bgcolor="#666666">VL. TOTAL</td>
        <td width="105" bgcolor="#666666">SALDO</td>
        <td width="70" bgcolor="#666666">JUROS</td>
        <td width="67" bgcolor="#666666">MULTA</td>
        <td width="103" bgcolor="#666666">VL. ATUAL</td>
      </tr>
      <?
      $i = 0;
	  $sql_dividas = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao WHERE code_negociacao = '$codigo_negociacao'");
	   while($res_dividas = mysqli_fetch_array($sql_dividas)){ $i++;
	  ?>  
      <tr>
        <td><h3><? echo $res_dividas['tipo']; ?></h3></td>
        <td><h3><?
	 $sql_verifica_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_dividas['vencimento']."'");
	  while($res_verifica_data = mysqli_fetch_array($sql_verifica_data)){
		  echo $res_verifica_data['vencimento'];
	  }
	?></h3></td>
        <td><h3><? echo $res_dividas['dias_atraso']; ?> DIAS</h3></td>
        <td><h3><? echo  number_format($res_dividas['vl_total'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_dividas['saldo'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_dividas['saldo'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_dividas['multa'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_dividas['vl_atualizado'],2,',','.'); ?></h3></td>
      </tr>
      <? } ?>
      <tr>
        <td colspan="8" bgcolor="#666666">ADMINISTRA&Ccedil;&Atilde;O DO COTRATO</td>
      </tr>
     <?
	 $sql_negociacao = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao_fechado WHERE code_negociacao = '$codigo_negociacao'");
	  while($res_negociacao = mysqli_fetch_array($sql_negociacao)){
	 ?>      
      <tr>
        <td bgcolor="#666633">
         <a href="scripts/imprimir_termo_negociacao.php?valor=<? echo $res_negociacao['vl_pagar']; ?>&cliente=<? echo $res_negociacao['cliente']; ?>" target="_blank"><img src="img/imprimir.png" width="20" height="20" border="0" /></a> 
         <a href="scripts/imprimir_termo_confissao_divida.php?negociacao=<? echo $res_negociacao['code_negociacao']; ?>&cliente=<? echo $res_negociacao['cliente']; ?>" target="_blank"><img src="img/convisao_divida.png" width="20" height="20" border="0" /></a>
         <? if($res_negociacao['contrato'] == NULL){  ?>
         <a rel="superbox[iframe][380x100]" href="scripts/upload_confissao_divida.php?codigo_negociacao=<? echo $codigo_negociacao; ?>" target="_blank"><img src="img/upload.png" width="20" height="20" border="0" title="Enviar contrato e confissão de dívida" /> </a>
         <? } ?>   
         
         <? if($res_negociacao['contrato'] !=  NULL){  ?>
         <a href="contrato_dividas/<? echo $res_negociacao['contrato']; ?>" target="_blank"><img src="img/contratos.png" width="20" height="20" border="0" title="Consultar contrato" /></a>
         <? } ?>
         </td>
        <td colspan="2" bgcolor="#666633"><strong>DATA DA NEGOCIA&Ccedil;&Atilde;O:</strong> <? echo $res_negociacao['data'];  ?></td>
        <td colspan="5" bgcolor="#666633"><strong>OPERADOR:</strong> <? echo $res_negociacao['operador'];  ?> - 
     <?
	 $sql_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '".$res_negociacao['operador']."'");
	  while($res_operador = mysqli_fetch_array($sql_operador)){
		  echo $res_operador['nome'];
	  }
	 ?>           
        </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="5" align="left"><h1 style="font:15px Arial, Helvetica, sans-serifr; margin:0; padding:0; color:#CCC;"><strong>DETALHES DA NEGOCIAÇÃO</strong></h1></td>
  </tr>
  <tr>
    <td colspan="5"><table class="table" width="996" border="0">
      <tr>
        <td width="68" bgcolor="#666666">STATUS</td>
        <td width="105" bgcolor="#666666">N&deg; NEGO.</td>
        <td width="78" bgcolor="#666666">VL. TOTAL</td>
        <td width="87" bgcolor="#666666">DESCONTO</td>
        <td width="84" bgcolor="#666666">VL. PAGAR</td>
        <td width="115" bgcolor="#666666">FORM. PAG</td>
        <td width="104" bgcolor="#666666">VENCIMENTO</td>
        <td width="103" bgcolor="#666666">N&deg; PARCELAS</td>
        <td width="111" bgcolor="#666666">VL. PARCELA</td>
        <td width="97" bgcolor="#666666">VL. TOTAL</td>
      </tr>

      <tr>
        <td><h3><? echo $res_negociacao['status']; ?></h3></td>
        <td><h3><? echo $res_negociacao['total_dividas']; ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_total'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['desconto'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_pagar'],2,',','.'); ?></h3></td>
        <td><h3><? echo  $res_negociacao['forma_pag']; ?></h3></td>
        <td><h3><? echo  $res_negociacao['dia_vencimento']; ?></h3></td>
        <td><h3><? echo  $res_negociacao['parcelas']; ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['valor_parcela'],2,',','.'); ?></h3></td>
        <td><h3><? echo  number_format($res_negociacao['vl_total_negociado'],2,',','.'); ?></h3></td>
      </tr>
    </table></td>
  </tr>
  <? if($res_negociacao['forma_pag'] == 'BOLETO BANCARIO'){ ?>
  <tr>
    <td colspan="5" align="left"><h1 style="font:15px Arial, Helvetica, sans-serifr; margin:0; padding:0; color:#CCC;"><strong>PARCELAS</strong></h1></td>
  </tr>
  <tr>
    <td colspan="5"><table class="table" width="996" border="0">
      <tr>
        <td width="45" bgcolor="#666666">PARC.</td>
        <td width="63" bgcolor="#666666">STATUS</td>
        <td width="80" bgcolor="#666666">VALOR</td>
        <td width="66" bgcolor="#666666">MULTA</td>
        <td width="71" bgcolor="#666666">JUROS</td>
        <td width="60" bgcolor="#666666">SALDO</td>
        <td width="201" bgcolor="#666666">COD. BARRAS</td>
        <td width="110" bgcolor="#666666">LOCALIZADOR</td>
        <td width="104" bgcolor="#666666">VENCIMENTO</td>
        <td width="76" bgcolor="#666666">PAGT.</td>
        <td width="72" bgcolor="#666666">&nbsp;</td>
      </tr>
      <?
	  $i = 0;
	   $sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_negociacao WHERE proposta = '".$_GET['code_negociacao']."'");
	   while($res_boletos = mysqli_fetch_array($sql_boletos)){ $i++;
	  ?>
      <tr <? if($i%2 == 0){ echo "bgcolor='#444'"; }else{ echo "bgcolor='#222'"; } ?>>
        <td><? echo $res_boletos['parcela'] ?></td>
        <td><? echo $res_boletos['status'] ?></td>
        <td>R$ <? echo number_format($res_boletos['valor'],2,',','.'); ?></td>
        <td><? 
		$multa = 0;
		if($res_boletos['status'] == 'AGUARDA' && $code_vencimento_hoje > $res_boletos['vencimento']){
			$multa = $res_boletos['valor']*0.0999;
			echo number_format($multa,2,',','.');
		}
		?></td>
        <td><? 
		$juros = 0;
		if($res_boletos['status'] == 'AGUARDA' && ($code_vencimento_hoje > $res_boletos['vencimento'])){
			$juros = $res_boletos['valor']*0.003*($code_vencimento_hoje-$res_boletos['vencimento']);
			echo number_format($juros,2,',','.');
		}
		?></td>
        <td><? echo number_format($juros+$multa+$res_boletos['valor'],2,',','.'); ?></td>
        <td><? if($tipo == 'ADM'){ ?>
          <a rel="superbox[iframe][800x250]" style="text-decoration:none; font:10px Arial, Helvetica, sans-serif; color:#FFF;" href="scripts/postar_codigo_negociacao.php?id=<? echo $res_boletos['id']; ?>&amp;parcela=<? echo $res_boletos['parcela']; ?>&amp;vencimento=<? echo $res_boletos['vencimento']; ?>&amp;localizador=<? echo $res_boletos['localizador']; ?>&amp;codigo_barras=<? echo $res_boletos['codigo_barras']; ?>">
          <? if($res_boletos['codigo_barras'] == ''){?>
Postar c&oacute;digo
<? }else{echo $res_boletos['codigo_barras'];}; ?>
          </a>
          <? }else{ echo $res_boletos['codigo_barras']; } ?></td>
        <td><? echo $res_boletos['localizador'] ?></td>
        <td><? 
		
			$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res_boletos['vencimento']."'");
			 while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
				 echo $res_vencimento['vencimento'];
			 }
		
		 ?></td>
        <td><? echo $res_boletos['data_pagamento'] ?></td>
        <td>
        <? if($res_boletos['status'] != 'PAGO'){ ?>
        <a href="scripts/boleto_negociacao.php?id=<? echo $res_boletos['id']; ?>&amp;proposta=<? echo $res_boletos['proposta']; ?>" target="_blank"><img src="img/boletos.png" width="17" height="20" border="0" title="Emitir boleto de pagamento" /></a>    
        
          <? if($tipo == 'ADM'){ ?>
          <?
        
		 $telefone_cliente = 0;
		 $sql_dados_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_boletos['cliente']."'");
		  while($res_dados = mysqli_fetch_array($sql_dados_cliente)){
			  $telefone_cliente = $res_dados['celular_1'];
		  }
		
		?>
          <a rel="superbox[iframe][270x250]" href="scripts/confirmar_pagamento_confissao_divida.php?id=<? echo $res_boletos['id']; ?>&amp;valor=<? echo number_format($juros+$multa+$res_boletos['valor'],2); ?>&cpf=<? echo $res_boletos['cliente']; ?>&telefone_cliente=<? echo $telefone_cliente; ?>&amp;<? echo $res_boletos['cliente']; ?>&code_negociacao=<? echo $_GET['code_negociacao']; ?>&parcela=<? echo $res_boletos['parcela']; ?>"><img src="img/dinheiro.png" width="20" height="20" border="0" title="Confirmar pagamento" /></a>
          <? } ?>
          
                  <? } ?>

          
          </td>
      </tr>
      <? } ?>
    </table></td>
  </tr>
  <? }} ?>
</table>
</body>
</html>