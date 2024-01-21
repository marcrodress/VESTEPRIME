<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/verificar_analise_credito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">
<hr />
<h1><strong>Setor de cr&eacute;dito</strong></h1>
<?

$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente


$sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
?>
<table width="1010" border="0">
  <tr>
    <td width="119" bgcolor="#999999"><strong>Data de envio</strong></td>
    <td width="84" bgcolor="#999999"><strong>Status</strong></td>
    <td width="170" bgcolor="#999999"><strong>Resultado</strong></td>
    <td width="404" bgcolor="#999999"><strong>Justificativa</strong></td>
    <td width="201" bgcolor="#999999">&nbsp;</td>
  </tr>
<? 	while($rs_conta = mysqli_fetch_array($sql_conta_corrente)){ ?>
  <tr>
    <td><? echo $rs_conta['data']; ?></td>
    <td><? if($rs_conta['status'] == 'INATIVO'){?> <a style="background:#06C; color:#FFF;" href="?pg=ativar&cliente=<? echo $rs_conta['cliente']; ?>">Ativar</a> <? }else{ ?><? echo $rs_conta['status']; }?></td>
    <td><? echo $rs_conta['proposta_credito']; ?></td>
    <td><? echo $rs_conta['justificativa']; ?></td>
    <td>
    <? if($rs_conta['proposta_credito'] == 'NEGADO' || $rs_conta['status'] == 'CANCELADO'){ ?>
    <a rel="superbox[iframe][900x250]" href="scripts/reenviar_analise_credito.php?cliente=<? echo $cliente; ?>">Reanálise</a>
    <? } ?>
    <? if($rs_conta['proposta_credito'] == 'APROVADO'){ ?>
    <a target="_blank" href="scripts/imprimir_contato_de_adesao.php?cpf=<? echo $cliente; ?>">Contrato</a>
    
	<? if($rs_conta['proposta_credito'] == 'APROVADO'){ ?>
    | <a rel="superbox[iframe][900x250]" href="scripts/reenviar_analise_credito.php?cliente=<? echo $cliente; ?>">Atualizar documentos</a>
	<? } ?>  
      
    <? if($rs_conta['status'] == 'PENDENTE'){ ?> | 
    <a rel="superbox[iframe][350x100]" href="scripts/confirmar_ativacao_cliente.php?cliente=<? echo $cliente; ?>&plano=<? echo $rs_conta['categoria']; ?>">Confirmar</a>
    <? } ?>
       
    
    
    <? } ?>
    </td>
  </tr>
<? } ?>
</table>		
<hr />

<table width="1010" border="0">
<?
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
?>
  <tr>
    <td colspan="4" rowspan="3" bgcolor="#666666"><h1 style="font:50px Arial, Helvetica, sans-serif; color:#CCC;"><strong>SCORE</strong></h1>
      
      <? $score = $res_cliente['score']; ?>
      
      <? if($score <0){ ?>
      <h1 style="font:35px Arial, Helvetica, sans-serif; color:#F00;"><strong>88</strong></h1>
      <? }elseif($score <400){ ?>
      <h1 style="font:35px Arial, Helvetica, sans-serif; color:#F00;"><strong><? echo number_format($res_cliente['score']); ?></strong></h1>
      <? }elseif($score >=400 && $score <600){ ?>
      <h1 style="font:35px Arial, Helvetica, sans-serif; color:#F60;"><strong><? echo number_format($res_cliente['score']); ?></strong></h1>
      <? }elseif($score >=600 && $score <800){ ?>
      <h1 style="font:35px Arial, Helvetica, sans-serif; color:#333;"><strong><? echo number_format($res_cliente['score']); ?></strong></h1>
      <? }elseif($score >=800){ ?>
      <h1 style="font:35px Arial, Helvetica, sans-serif; color:#060;"><strong><? if($res_cliente['score'] >= 1000){ echo "822"; }else{ echo number_format($res_cliente['score']); }?></strong></h1>
      <? } ?>
      
      
      
      </td>
    <td colspan="7" bgcolor="#000000"><h1><strong>DISTRIBUI&Ccedil;&Atilde;O DOS LIMITES DE CR&Eacute;DITO</strong></h1></td>
    </tr>
  <tr>
    <td width="104" bgcolor="#999999"><strong>PRIVATE LABEL EXCLUSIVO</strong></td>
    <td width="117" bgcolor="#999999"><strong>LIMITE FINANCIAMENTO</strong></td>
    <td width="105" bgcolor="#999999"><strong>CREDITO PESSOAL BOLETO</strong></td>
    <td width="114" bgcolor="#999999"><strong>CREDITO PESSOAL PRIVATE LABEL</strong></td>
    <td width="117" bgcolor="#999999"><strong>CREDITO PESSOAL CART&Atilde;O DE CR&Eacute;DITO</strong></td>
    <td width="106" bgcolor="#999999"><strong>FINANCIAMENTO BANDEIRADO</strong></td>
    <td width="81" bgcolor="#999999"><strong>TOTAL</strong></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_cliente['limite_loja'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_cliente['pagamento_contas'],2,',','.'); ?></td>
    <td rowspan="3" bgcolor="#333333">R$ <? 
	$limite_boleto = 0;
	$sql_limite_boleto = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente'");
		while($res_boleto = mysqli_fetch_array($sql_limite_boleto)){
			$limite_boleto = $res_boleto['limite'];
		}
			echo number_format($limite_boleto,2,',','.');
	
	 ?></td>
    <td>R$ <? echo number_format($res_cliente['credito_pessoal'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_cliente['credito_pessoal_cartao_credito'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_cliente['limite_bandeirado'],2,',','.'); ?></td>
    <td rowspan="3" bgcolor="#333333">R$ <? echo number_format($res_cliente['limite_loja']+$res_cliente['pagamento_contas']+$res_cliente['credito_pessoal']+$res_cliente['credito_pessoal_cartao_credito']+$res_cliente['limite_bandeirado']+$limite_boleto,2,',','.'); ?></td>
    </tr>
  <tr>
    <td width="64" bgcolor="#000000"><strong>SERASA</strong></td>
    <td width="50" bgcolor="#000000"><strong>QUOD</strong></td>
    <td width="51" bgcolor="#000000"><strong>SPC</strong></td>
    <td width="55" bgcolor="#000000"><strong>SCPC</strong></td>
    <td rowspan="2" align="center"><hr />
      R$ <? echo number_format($res_cliente['limite_loja_disponivel'],2,',','.'); ?></h1></td>
    <td rowspan="2" align="center"><hr />
      R$ <? echo number_format($res_cliente['disponivel_pagamento_contas'],2,',','.'); ?></td>
    <td rowspan="2" align="center"><hr />
      R$ <? echo number_format($res_cliente['credito_pessoal_disponivel'],2,',','.'); ?></td>
    <td rowspan="2" align="center"><hr />
      R$ <? echo number_format($res_cliente['credito_pessoal_cartao_credito'],2,',','.'); ?></td>
    <td rowspan="2" align="center"><hr />
      R$ <? echo number_format($res_cliente['limite_bandeirado_disponivel'],2,',','.'); ?></td>
    </tr>
  <tr>
    <td rowspan="2" bgcolor="#000000"><? echo $res_cliente['serasa']; ?></td>
    <td rowspan="2" bgcolor="#000000"><? echo $res_cliente['quod']; ?></td>
    <td rowspan="2" bgcolor="#000000"><? echo $res_cliente['spc']; ?></td>
    <td rowspan="2" bgcolor="#000000"><? echo $res_cliente['scpc']; ?></td>
    </tr>
  <tr>
    <td colspan="7" align="left"><? if($res_cliente['status'] == 'ATIVO'){ ?>
      <a href="scripts/aumentar_limites.php?cliente=<? echo $cliente; ?>&score=<? echo $res_cliente['score']; ?>&limite_loja=<? echo $res_cliente['limite_loja']; ?>&limite_loja_disponivel=<? echo ($res_cliente['limite_loja']*0.33)+$res_cliente['limite_loja_disponivel']; ?>&pagamento_contas=<? echo $res_cliente['pagamento_contas']; ?>&disponivel_pagamento_contas=<? echo ($res_cliente['pagamento_contas']*0.2)+$res_cliente['disponivel_pagamento_contas']; ?>" rel="superbox[iframe][300x220]" style="font:12px Arial, Helvetica, sans-serif; color:#CCC; background:#033; padding:5px; text-decoration:none; border:2px solid #000;">SOLICITAR AUMENTO DE LIMITE</a>

      <a href="scripts/transferencia_de_limites.php?cliente=<? echo $cliente; ?>&score=<? echo $res_cliente['score']; ?>" rel="superbox[iframe][350x220]" style="font:12px Arial, Helvetica, sans-serif; color:#CCC; background:#630; padding:5px; text-decoration:none; border:2px solid #000;">TRANSFERÊNCIA DE LIMITES</a>

      <a href="scripts/autorizar_limite_emergencial_credito.php?cliente=<? echo $cliente; ?>&autoizar=<? echo $res_cliente['limite_emergencial']; ?>&score=<? echo $res_cliente['score']; ?>" rel="superbox[iframe][350x270]" style="font:12px Arial, Helvetica, sans-serif; color:#CCC; background:#069; padding:5px; text-decoration:none; border:3px solid #000;">AUTORIZAR LIMITE EMERGENCIAL</a>
     <? } ?>      

      <a href="scripts/alterar_vencimento.php?cliente=<? echo $cliente; ?>&autoizar=<? echo $res_cliente['limite_emergencial']; ?>&score=<? echo $res_cliente['score']; ?>" rel="superbox[iframe][350x270]" style="font:10px Arial, Helvetica, sans-serif; color:#000; background:#693; padding:5px; text-decoration:none; border:3px solid #000;">ALTERAR VENCIMENTO</a>

      </td>
    </tr>
<? } ?>
</table>
<hr />
<strong>Atenção aos limites de crédito</strong><br />
<ul>
<li>O limite de crédito é de forma automática e ocorre sempre de acordo com a pontualidade dos pagamentos.</li>
<li>A cada 30 dias o cliente passará por uma analise de crédito automática para verificar a possibilidade de aumento.</li>
<li>Peça ao cliente para atualizar seus dados sempre que for modificado, evitando assim, bloqueio do cadastro.</li>
<li>20 dias de atraso no pagamento ocasionará na inscrição do cliente nos orgãos de proteção ao crédito.</li>
<li>30 dias de atraso no pagamento ocasionará no bloqueio automático de todos os limites de crédito.</li>
</ul>
<hr />
<table width="1010" border="0">
  <tr>
    <td width="503" bgcolor="#000000"><table width="476" border="0">
      <tr>
        <td colspan="2" bgcolor="#000000"><strong>INFORMA&Ccedil;&Otilde;ES EXTERNAS</strong>
          <hr /></td>
        </tr>
      <tr>
        <td width="115"><strong>DATA</strong></td>
        <td width="338"><strong>INFORMA&Ccedil;&Atilde;O</strong></td>
        </tr>
        
      <?
       $sql_informacoes_financeiras = mysqli_query($conexao_bd, "SELECT * FROM informacoes_financeiras_externas WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 20");
	    while($res_informcoes = mysqli_fetch_array($sql_informacoes_financeiras)){ 
	  ?>
      <tr>
        <td bgcolor="#000000"><? echo $res_informcoes['data']; ?></td>
        <td bgcolor="#000000"><? echo strtoupper($res_informcoes['informacao']); ?></td>
        </tr>
      <? } ?>
      </table></td>
    <td width="500" bgcolor="#000000"><table width="490" border="0">
      <tr>
        <td colspan="5" bgcolor="#000000"><strong>CART&Otilde;ES BANDEIRADOS LIBERADOS EXTERNAMENTE</strong>
          <hr /></td>
      </tr>
      <tr>
        <td width="66"><strong>DATA</strong></td>
        <td width="79"><strong>FINANCEIRA</strong></td>
        <td width="69"><strong>LIM INICIAL</strong></td>
        <td width="74"><strong>LIM ATUAL</strong></td>
        <td width="180"><strong>INFORMAÇÕES</strong></td>
      </tr>
      <?
       $sql_cartoes = mysqli_query($conexao_bd, "SELECT * FROM cartoes_bandeirados_liberados WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 20");
	    while($res_cartoes = mysqli_fetch_array($sql_cartoes)){ 
	  ?>      
      <tr>
        <td bgcolor="#000000"><? echo $res_cartoes['data']; ?></td>
        <td bgcolor="#000000"><? echo $res_cartoes['financeira']; ?></td>
        <td bgcolor="#000000">R$ <? echo number_format($res_cartoes['limite_inicial'],2,',','.'); ?></td>
        <td bgcolor="#000000">R$ <? echo number_format($res_cartoes['limite_atual'],2,',','.'); ?></td>
        <td bgcolor="#000000"><? echo $res_cartoes['codigo']; ?></td>
      </tr>
      <? } ?>      
    </table></td>
  </tr>
  </table>
<p>&nbsp;</p>
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['pg'] == 'ativar'){
	
$cliente = $_GET['cliente'];

mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = 'ATIVO' WHERE cliente = '$cliente'");

echo "<script language='javascript'>window.location='?';</script>";

}?>
