<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_detalhado_capitalizacao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
require "../conexao.php";
$id = $_GET['id'];
  $sql_parcela = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE id = '$id'");
	while($res_parcela = mysqli_fetch_array($sql_parcela)){
?>
<table width="305" border="0">
  <tr>
    <td colspan="2" align="center" bgcolor="#0033CC"><h1><img src="../img/logo.png" width="229" height="95" /></h1>
      <h2>PAGAMENTO DE CAPITALIZA&Ccedil;&Atilde;O<br />
        <?  echo date("d/m/Y H:i:s");?><br />
      </h2>
    </td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>COMPROVANTE DE PAGAMENTO DE T&Iacute;TULO DE CAPITALIZA&Ccedil;&Atilde;O</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 3315.6199</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#FFF"><strong>CLIENTE</strong><BR /><? 
	
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_parcela['cliente']."'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo $res_cliente['nome'];
		}
	
	?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>CPF DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['cliente']; ?></td>
  </tr>
  <tr>
    <td width="142" align="center" bgcolor="#CCCCCC"><strong>c&oacute;d. t&iacute;tulo</strong></td>
    <td width="153" align="center" bgcolor="#CCCCCC"><strong>DATA  CONTRATA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td height="20" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['code']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['data']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>status</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>DIA DE vencimento</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['status']; ?></td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['vencimento']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>PLANO</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['plano'];  
	
	if($res_parcela['plano'] == 'VAREJO'){
		echo " 12";
	}elseif($res_parcela['plano'] == 'GOLD'){
		echo " 24";
	}elseif($res_parcela['plano'] == 'PLATINUM'){
		echo " 36";
	}elseif($res_parcela['plano'] == 'BLACK'){
		echo " 48";
	}elseif($res_parcela['plano'] == 'MASTERBLACK'){
		echo " 60";
	}
	
	?> MESES</td>
    <td align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcela['valor'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>CAR&Ecirc;NCIA</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>FORMA DE PAGT.</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['carencia']; ?> MESES</td>
    <td align="center" bgcolor="#FFFFFF"><? echo $res_parcela['forma_pagamento']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#CCCCCC"><strong>BENEFICI&Aacute;RIO</strong></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['beneficiario']; ?></td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="center" bgcolor="#CCCCCC"><strong>FORMA DE RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td height="18" colspan="2" align="center" bgcolor="#FFFFFF"><? echo $res_parcela['forma_recebimento']; ?></td>
  </tr>
  <tr>
    <td height="8" colspan="2" align="center" bgcolor="#CCCCCC"><strong>DESCRI&Ccedil;&Atilde;O DO PAGAMENTO</strong></td>
  </tr>
 <?
 $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '".$res_parcela['code']."'");
 while($res_parcelas = mysqli_fetch_array($sql_parcelas)){
 ?>
  <tr>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>parcela</strong></td>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>STATUS</strong></td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#F2F2F2"><? echo $res_parcelas['n_parcela']; ?>&ordm; parcela</td>
    <td height="3" align="center" bgcolor="#FFFFFF"><? echo $res_parcelas['status']; ?></td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>VALOR</strong></td>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>JUROS E MULTA</strong></td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcelas['valor'],2,',','.'); ?></td>
    <td height="3" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcelas['juros']+$res_parcelas['multa'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>VALOR PAGO</strong></td>
    <td height="3" align="center" bgcolor="#FFFFFF"><strong>DATA DO PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td height="3" align="center" bgcolor="#FFFFFF">R$ <? echo number_format($res_parcelas['vl_recebido'],2,',','.'); ?></td>
    <td height="3" align="center" bgcolor="#FFFFFF"><? echo $res_parcelas['data_pagt']; ?></td>
  </tr>
  <tr>
    <td height="3" colspan="2" align="center" bgcolor="#FFFFFF"><strong>FORMA DE PAGAMENTO</strong><br />
    <? echo $res_parcelas['forma_pagt']; ?></td>
  </tr>
  <tr>
    <td height="3" colspan="2" align="center" bgcolor="#FFFFFF"><hr /></td>
  </tr>
 <? } ?>
  <tr>
    <td height="3" colspan="2" align="center" bgcolor="#FFFFFF"><strong>SALDO CAPITALIZADO</strong><br />R$ 
    
     <?
     
	
	$valor_capitalizado = 0;
	$code_vencimento_hoje = 0;
	$code_vencimento_primeira_parcela = 0;
	$dias_capitalizacao = 0;
			
	 $sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	 while($res_code_hoje = mysqli_fetch_array($sql_code_vencimento)){
	 $code_vencimento_hoje = $res_code_hoje['codigo'];
	 }
	 
	 $sql_code_vencimento_primeira = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_parcela['code']."' AND n_parcela = '1'");
	 while($res_code_primeira = mysqli_fetch_array($sql_code_vencimento_primeira)){
	 $code_vencimento_primeira_parcela = $res_code_primeira['code_vencimento'];
	 }
		
		$sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_parcela['code']."'");
	
		while($res_soma_parcelas = mysqli_fetch_array($sql_parcelas)){
			$valor_capitalizado = $valor_capitalizado+$res_soma_parcelas['valor'];
		}
		
		$dias_capitalizacao = $code_vencimento_hoje-$code_vencimento_primeira_parcela;
		if($dias_capitalizacao <0){
			$dias_capitalizacao = $code_vencimento_primeira_parcela-$code_vencimento_hoje;
		}
		
		$valor_capitalizado = (($valor_capitalizado*0.00033*($dias_capitalizacao))+$valor_capitalizado);
		
		echo number_format($valor_capitalizado,2,',','.');
	
	 
	 
	 ?>
    
    </td>
  </tr>
  <tr>
    <td height="38" colspan="2" align="left" bgcolor="#FFFFFF"><hr /><strong style="font:10px Arial, Helvetica, sans-serif; text-decoration:none;">*Valores acima, poder&atilde;o ser atualizados a qualquer momento.</strong></td>
  </tr>
</table>
<? } ?>
</div><!-- topo_geral -->
</body>
</html>