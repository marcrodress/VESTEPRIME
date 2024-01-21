<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/capitalizacao_titulos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>

<div id="box_pagamento_1">
<h1><strong>TITULOS DE CAPITALIZAÇÃO CONTRATADOS</strong></h1>
<hr />
<?

$cliente = 0;
	
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
	 if(mysqli_num_rows($sql_carrinho) == ''){
		echo "<script language='javascript'>window.location='carrinho.php';</script>";
	 }else{
		while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			$cliente = $res_carrinho['cliente'];
		}
	  }


$sql_planos = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE cliente = '$cliente'");
if(mysqli_num_rows($sql_planos) == ''){
 echo "<script language='javascript'>window.alert('Cliente não possui titulos de capitalização contratos!');window.location='carrinho.php';</script>";
}else{
?>

<table width="1000" border="0">
  <tr>
    <td width="83" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
    <td width="108" bgcolor="#CCCCCC"><strong>COD. TITULO</strong></td>
    <td width="126" bgcolor="#CCCCCC"><strong>PLANO</strong></td>
    <td width="95" bgcolor="#CCCCCC"><strong>CARÊNCIA</strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>VENCIMENTO</strong></td>
    <td width="147" bgcolor="#CCCCCC"><strong>FORM. PAGAMENTO</strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>MENSALIDADE</strong></td>
    <td width="122" bgcolor="#CCCCCC"><strong>SALDO</strong></td>
    <td width="105" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<? while($res_cap = mysqli_fetch_array($sql_planos)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_cap['status']; ?></td>
    <td><? echo $res_cap['code']; ?></td>
    <td><? echo $res_cap['plano'];
	
	if($res_cap['plano'] == 'VAREJO'){
		echo " 12";
	}elseif($res_cap['plano'] == 'GOLD'){
		echo " 24";
	}elseif($res_cap['plano'] == 'PLATINUM'){
		echo " 36";
	}elseif($res_cap['plano'] == 'BLACK'){
		echo " 48";
	}elseif($res_cap['plano'] == 'MASTERBLACK'){
		echo " 60";
	}	
	
	 ?> MESES</td>
    <td><? echo $res_cap['carencia']; ?> MESES</td>
    <td><? echo $res_cap['vencimento']; ?></td>
    <td><? echo $res_cap['forma_pagamento']; ?></td>
    <td>R$ <? echo number_format($res_cap['valor'],2,',','.'); ?></td>
    <td>R$<? 
	
	$valor_capitalizado = 0;
	$code_vencimento_hoje = 0;
	$code_vencimento_primeira_parcela = 0;
	$dias_capitalizacao = 0;
			
	 $sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	 while($res_code_hoje = mysqli_fetch_array($sql_code_vencimento)){
	 $code_vencimento_hoje = $res_code_hoje['codigo'];
	 }
	 
	 $sql_code_vencimento_primeira = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_cap['code']."' AND cliente = '$cliente' AND n_parcela = '1'");
	 while($res_code_primeira = mysqli_fetch_array($sql_code_vencimento_primeira)){
	 $code_vencimento_primeira_parcela = $res_code_primeira['code_vencimento'];
	 }
		
		$sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_cap['code']."' AND cliente = '$cliente'");
	
		while($res_soma_parcelas = mysqli_fetch_array($sql_parcelas)){
			$valor_capitalizado = $valor_capitalizado+$res_soma_parcelas['valor'];
		}
		
		$dias_capitalizacao = $code_vencimento_hoje-$code_vencimento_primeira_parcela;
		if($dias_capitalizacao <0){
			$dias_capitalizacao = $code_vencimento_primeira_parcela-$code_vencimento_hoje;
		}
		
		$valor_capitalizado = (($valor_capitalizado*0.00033*($dias_capitalizacao))+$valor_capitalizado);
		
		echo number_format($valor_capitalizado,2,',','.');
	
	?></td>
    <td>
     <? if($res_cap['status'] != 'CANCELADO'){?>
      <a href="scripts/contrato_capitalizao.php?code=<? echo $res_cap['code']; ?>" target="_blank"><img src="img/imprimir.png" width="20" height="20" border="0" /></a>
     <? } ?> 
      
      
      
      <?
    $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '".$res_cap['code']."' AND status = 'Pago'");
	if(mysqli_num_rows($sql_parcelas) >= $res_cap['carencia'] && $res_cap['status'] == 'Ativo'){
	?>
      <a href="scripts/contrato_capitalizao.php?code=<? echo $res_cap['code']; ?>" target="_blank"><img src="img/1878637.png" width="20" height="20" border="0" /></a>
      <? } ?>    
      
      
      <script language="javascript">
		function relatorio(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
      </script>    
      <a onclick="relatorio('scripts/relatorio_detalhado_capitalizacao.php?id=<? echo $res_cap['id']; ?>');" href=""><img src="img/cadastro.jpg" width="20" height="20" border="0" /></a>
      
      
      
      
      
      <? if($res_cap['status'] == 'Aguarda'){ ?>
       <a href="?code=<? echo $res_cap['code']; ?>&p=cancelado"><img src="img/bloquea.png" width="20" height="20" title="CANCELAR PLANO DE CAPITALIZAÇÃO" /></a>
      <? } ?>
      <? if($res_cap['status'] == 'Aguarda' || $res_cap['status'] == 'Ativo'){ ?>
      <a href="?code=<? echo $res_cap['code']; ?>&p=pag&valor=<? echo $res_cap['valor']; ?>"><img src="img/dinheiro.jpg" width="20" height="20" border="0" /></a>
      <? } ?>
      
      
      <? if(mysqli_num_rows($sql_parcelas) >= 13 && $res_cap['status'] == 'Ativo'){ ?>
      <a rel="superbox[iframe][860x380]" href="scripts/regastar_capitalizacao.php?titulo=<? echo $res_cap['code']; ?>&cliente=<? echo $cliente; ?>"><img src="img/regatar_dinheiro.png" width="20" title="Solicitar resgate de título!" height="20" /></a>
      <? } ?>
      
      
    </td>
  </tr>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#999'"; } ?>>
   <? if($res_cap['code'] == $_GET['code'] && $_GET['p'] == 'pag'){ ?>
    <td colspan="9" align="center"><table class="table" width="800" border="0">
      <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><table class="table" width="800" border="0">
          <tr>
            <td width="73" bgcolor="#DFFFEF"><strong>COD. TITULO</strong></td>
            <td width="53" bgcolor="#DFFFEF"><strong>PARCELA</strong></td>
            <td width="50" bgcolor="#DFFFEF"><strong>STATUS</strong></td>
            <td width="74" bgcolor="#DFFFEF"><strong>VENCIMENTO</strong></td>
            <td width="45" bgcolor="#DFFFEF"><strong>VALOR</strong></td>
            <td width="47" bgcolor="#DFFFEF"><strong>MULTA</strong></td>
            <td width="54" bgcolor="#DFFFEF"><strong>JUROS</strong></td>
            <td width="67" bgcolor="#DFFFEF"><strong>VL. PAGAR</strong></td>
            <td width="118" bgcolor="#DFFFEF"><strong>DATA DO PAGAMENTO</strong></td>
            <td width="125" bgcolor="#DFFFEF"><strong>FORMA PAGT.</strong></td>
            <td width="42" bgcolor="#DFFFEF">&nbsp;</td>
          </tr>
          <?
	
	$code_vencimento_hoje = 0;
	$multa = 0;
	$juros = 0;
    $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '".$_GET['code']."'  ORDER BY n_parcela DESC");
	 $i = 0;
	 while($res_parcelas = mysqli_fetch_array($sql_parcelas)){ $i++;
	 
	 $code_vencimento = $res_parcelas['code_vencimento'];
	 
	 $sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	 while($res_code_hoje = mysqli_fetch_array($sql_code_vencimento)){
	 $code_vencimento_hoje = $res_code_hoje['codigo'];
	 
	 
	 ?>
          <tr <? if($code_vencimento_hoje > $code_vencimento && $res_parcelas['status'] == 'Aguarda'){ echo "bgcolor='#FFCCCC'"; }elseif($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
            <td><? echo $res_parcelas['code_capitalizacao']; ?></td>
            <td><? echo $res_parcelas['n_parcela']; ?></td>
            <td><? echo $status = $res_parcelas['status']; ?></td>
            <td><? echo $res_parcelas['vencimento']; ?></td>
            <td><? echo number_format($res_parcelas['valor'],2,',','.'); ?></td>
            <td><? 
			 if($status == 'Aguarda'){
				if($code_vencimento_hoje > $code_vencimento){
					 $multa = ($res_parcelas['valor']*0.05); 
					 echo number_format($multa,2,',','.');
				}
			 }
			
			?></td>
            <td><? 
			
			if($code_vencimento_hoje > $code_vencimento){ 
				if($status == 'Aguarda'){
				 $juros = ($res_parcelas['valor']*0.005*($code_vencimento_hoje-$code_vencimento)); 
				 echo number_format($juros,2,',','.'); 
				}
			} 
			
			?></td>
            <td><? echo number_format($res_parcelas['valor']+$multa+$juros,2,',','.'); ?></td>
            <td><? if($res_parcelas['data_pagt'] == 0){ }else{ echo $res_parcelas['data_pagt']; } ?></td>
            <td><? echo $res_parcelas['forma_pagt']; ?></td>
            <td><? if($res_parcelas['status'] == 'Aguarda'){ ?>
              <a rel="superbox[iframe][780x100]" href="scripts/confirmar_pagamento_capitalizacao.php?id=<? echo $res_parcelas['id']; ?>&plano=<? echo $res_parcelas['code_capitalizacao']; ?>&parcela=<? echo $res_parcelas['n_parcela']; ?>&status_cap=<? echo $res_cap['status']; ?>&valor=<? echo $res_parcelas['valor']; ?>&cliente=<? echo $res_parcelas['cliente']; ?>&multa=<? echo $multa; ?>&juros=<? echo $juros; ?>&receber=<? echo $res_parcelas['valor']+$multa+$juros; ?>"><img src="img/download.jfif" alt="" width="23" height="23" border="0" title="Confirmar pagamento" /></a>
              <? } ?>
              <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
          </script>
              <? if($res_parcelas['status'] == 'Pago'){ ?>
              <a onclick="abrePopUp('scripts/imprimir_comprovante_capitalizacao.php?id=<? echo $res_parcelas['id']; ?>');" href=""><img src="img/impressora.jfif" alt="" width="23" height="23" border="0" title="Imprimir comprovante de pagamento" /></a>
              <? } ?></td>
          </tr>
          <? }} ?>
        </table></td>
      </tr>
    </table></td>
    <? } ?>
    </tr>
 <? } ?>
  </table>

	
<? } ?>
</div><!-- box_pagamento_1 -->
</body>
</html>

<? if(@$_GET['p'] == 'cancelado'){

mysqli_query($conexao_bd, "UPDATE plano_capitalizao SET status = 'CANCELADO' WHERE code = '".$_GET['code']."'");

echo "<script language='javascript'>window.alert('PLANO CANCELADO COM SUCESSO!');window.location='?p=';</script>";

}?>