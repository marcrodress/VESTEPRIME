<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/credito_a_receber.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<?

$autorizacao = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador' AND senha_autorizacao = ''");
if(mysqli_num_rows($autorizacao) != ''){
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
}

?>


<div id="box_pagamento_1">
 <div id="filtro">
  <form name="" method="post" action="" enctype="multipart/form-data">
   <select name="dia" size="1">
     <option value="">Selecione o dia</option>
     <option value="<? echo $dia; ?>"><? echo $dia; ?></option>
	  <? for($i=1; $i<=31; $i++){ ?>
        <? if($i != $dia){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select name="mes" size="1">
     <option value="<? echo $mes; ?>"><? echo $mes; ?></option>
     <option value="">Selecione o mês</option>
	  <? for($i=1; $i<=12; $i++){ ?>
        <? if($i != $mes){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select name="ano" size="1">
     <option value="<? echo $ano; ?>"><? echo $ano; ?></option>
     <option value="<? echo $ano-1; ?>"><? echo $ano-1; ?></option>
     <option value="<? echo $ano-2; ?>"><? echo $ano-2; ?></option>
     <option value="<? echo $ano-3; ?>"><? echo $ano-3; ?></option>
     <option value="<? echo $ano-4; ?>"><? echo $ano-4; ?></option>
   </select>
  <input type="submit" name="filtro" value="Filtrar" />
  </form>
  <? if(isset($_POST['filtro'])){
	 
  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $ano = $_POST['ano'];
  
  if($ano == ''){
	  echo "<script language='javascript'>window.alert('É obrigatório informar o ano!');</script>";
  }else{
	  echo "<script language='javascript'>window.location='?ano_filtro=$ano&mes_filtro=$mes&dia_filtro=$dia';</script>";
  }
  
  }?>
 </div><!-- filtro -->
 <hr />
 
 
 <div id="pagar_ao_sistema">
  <form name="" method="post" action="" enctype="multipart/form-data">
  <strong> Dia <input name="dia_p" type="text" id="dia" size="5" value="<? echo date("d"); ?>" maxlength="2" />
   Mês <input name="mes_p" type="text" id="mes" size="5" maxlength="2" value="<? echo date("m"); ?>" />
   Ano <input name="ano_p" type="text" id="ano" size="5" maxlength="4" value="<? echo date("Y"); ?>" />
   Descricão <input name="descricao" type="text" id="descricao" size="50" />
   Valor <input name="valor" type="text" id="descricao" size="8" maxlength="8" />
   </strong>
   <input type="submit" name="enviar" value="Enviar" />
  </form>
  <hr />
  <? if(isset($_POST['enviar'])){
	  
	 
	 $dia_p = $_POST['dia_p'];
	 $mes_p = $_POST['mes_p'];
	 $ano_p = $_POST['ano_p'];
	 $descricao = $_POST['descricao'];
	 $valor = $_POST['valor'];
	 
	 $sql_valor_pago = mysqli_query($conexao_bd, "INSERT INTO saldos_recebidos (dia, mes, ano, descricao, valor) VALUES ('$dia_p', '$mes_p', '$ano_p', '$descricao', '$valor')");
	 
	 echo "<script language='javascript'>window.location='';</script>";
	 
  
  }?>
 </div><!-- pagar_ao_sistema -->
 
 <div id="resumo">
 	
    <div id="recarga_a_receber">
     <img src="img/recarga_a_receber.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$
     <?
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	 
	 
      $recarga_prepago = 0;
	  $sql_recarga = mysqli_query($conexao_bd, "SELECT * FROM recarga_prepago WHERE forma_pagamento = 'VESTE PRIME' AND m = '$mes_filtro' AND a = '$ano_filtro'");
	  	while($res_recarga = mysqli_fetch_array($sql_recarga)){
			$recarga_prepago = $res_recarga['valor']+$recarga_prepago;
		}
	  echo number_format($recarga_prepago,2,',','.');
	 ?>
     </p>
    </div><!-- recarga_a_receber -->
 	
    <div id="tv_prepago">
     <img src="img/tv_prepago_a_receber.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$ 
     <?
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	 
	 
      $recarga_tv_prepago = 0;
	  $sql_recarga = mysqli_query($conexao_bd, "SELECT * FROM recarga_tv_prepago WHERE forma_pagamento = 'VESTE PRIME' AND m = '$mes_filtro' AND a = '$ano_filtro'");
	  	while($res_recarga = mysqli_fetch_array($sql_recarga)){
			$recarga_tv_prepago = $res_recarga['valor']+$recarga_tv_prepago;
		}
	  echo number_format($recarga_tv_prepago,2,',','.');
	 ?>     
     </p>
    </div><!-- tv_prepago -->
 	
    <div id="giftcard">
     <img src="img/giftcard_a_receber.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$ 
     <?
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	 
	 
      $gift_card = 0;
	  $sql_recarga = mysqli_query($conexao_bd, "SELECT * FROM gift_card WHERE forma_pagamento = 'VESTE PRIME' AND mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  	while($res_recarga = mysqli_fetch_array($sql_recarga)){
			$gift_card = $res_recarga['valor']+$gift_card;
		}
	  echo number_format($gift_card,2,',','.');
	 ?>
     </p>
    </div><!-- giftcard -->
 	
    <div id="venda_produtos">
     <img src="img/venda_de_produtos_a_receber.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$ 
     <?
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	 
	 
      $lancamento_fatura = 0;
	  $sql_recarga = mysqli_query($conexao_bd, "SELECT * FROM pagamento_carrinho WHERE form_pag = 'VESTE PRIME' AND mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  	while($res_recarga = mysqli_fetch_array($sql_recarga)){
			if($res_recarga['parcelas'] >= 3){
			$desconto_parcela = ($res_recarga['parcelas']*1.3)/100;
			}else{
			$desconto_parcela = ($res_recarga['parcelas']*3)/100;
			}
			$lancamento_fatura = $res_recarga['valor_total']-(($res_recarga['valor_total']*$desconto_parcela))+$lancamento_fatura;
		}
	  echo number_format($lancamento_fatura*0.98,2,',','.');
	 ?>   
     </p>
    </div><!-- venda_produtos -->
 	
    <div id="valor_pagamentos">
     <img src="img/valor_pagamentos.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$   
     <?
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	 
	 
      $valor_pagamentos = 0;
      $valor_saques = 0;
	  
	  $sql_saques = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_saque_facil WHERE status = 'APROVADO' AND mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  	while($res_saques = mysqli_fetch_array($sql_saques)){
			$valor_saques = $res_saques['valor']+$valor_saques;
		}	  
	  
	  $sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE forma_pagamento = 'VESTE PRIME' AND mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  	while($res_pagamentos = mysqli_fetch_array($sql_pagamentos)){
			$valor_pagamentos = $res_pagamentos['valor']+$valor_pagamentos;
		}
		
	  $valor_pagamentos = $valor_pagamentos+$valor_saques;
	  	
	  echo number_format($valor_pagamentos,2,',','.');
	 ?> 
     </p>
    </div><!-- valor_pago -->
     	
    <div id="valor_montante">
     <img src="img/valor_montante.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$   
     <? 
	 
	 $auxilio_emergencial = 0;
	 
	 $sql_auxilio = mysqli_query($conexao_bd, "SELECT * FROM auxilio_emergencial WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  while($res_auxilio = mysqli_fetch_array($sql_auxilio)){
		  $auxilio_emergencial = $auxilio_emergencial+$res_auxilio['valor'];
	  }
	 
	 
	 $montante = ($lancamento_fatura*0.95)+$gift_card+$recarga_tv_prepago+$valor_pagamentos+$recarga_prepago+$auxilio_emergencial;
	 
	 echo number_format($montante,2,',','.'); 
	 
	 ?>
     </p>
    </div><!-- valor_montante -->

 	
    <div id="valor_pago">
     <img src="img/valor_pago.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$   
     <? 
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];	
	  	 
	  $valor_pago = 0;
	 
	  $sql_valor_pago = mysqli_query($conexao_bd, "SELECT * FROM saldos_recebidos WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'");
	  	while($res_valor_pago = mysqli_fetch_array($sql_valor_pago)){
			$valor_pago = $res_valor_pago['valor']+$valor_pago;
		}
	 echo number_format($valor_pago,2,',','.'); 

	 ?>
     </p>
    </div><!-- valor_pago -->
         	
    <div id="saldo_a_receber">
     <img src="img/saldo_a_receber.fw.png" />
     <p style="margin:7px 0 0 0;">
     R$   
     <? echo number_format($montante-$valor_pago,2,',','.'); ?>
     </p>
    </div><!-- saldo_a_receber -->
 </div><!-- resumo -->
 
 <div id="descricao_recebimento">
  <br />
  <?
  
    
	  $mes_filtro = $_GET['mes_filtro'];
	  $ano_filtro = $_GET['ano_filtro'];  
  
   $sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM saldos_recebidos WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'");
   if(mysqli_num_rows($sql_pagamentos) >= 1){
  
  ?>
  <table width="638" border="0">
  <tr>
    <td width="108" bgcolor="#0099FF"><strong>Data</strong></td>
    <td width="339" bgcolor="#0099FF"><strong>Descrição</strong></td>
    <td width="80" bgcolor="#0099FF"><strong>Valor</strong></td>
    <td width="93" bgcolor="#0099FF">&nbsp;</td>
  </tr>
  <?

    while($res_sql = mysqli_fetch_array($sql_pagamentos)){ $i++;
	
   
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_sql['dia']; ?>/<? echo $res_sql['mes']; ?>/<? echo $res_sql['ano']; ?></td>
    <td><? echo $res_sql['descricao']; ?></td>
    <td>R$ <? echo number_format($res_sql['valor'],2,',','.'); ?></td>
    <td><a href="credito_a_receber.php?ano_filtro=<? echo $_GET['ano_filtro']; ?>&id=<? echo $res_sql['id']; ?>&mes_filtro=<? echo $_GET['mes_filtro']; ?>&acao=excluir"><img src="img/deleta.jpg" width="18" height="18" border="0" title="APAGAR REGISTRO" /></a></td>
  </tr>
  <? } ?>
  </table>
  <? } ?>
 </div><!-- descricao_recebimento -->
 
</div><!-- box_pagamento_1 -->
</body>
</html>
<? if($_GET['acao'] == 'excluir'){

 $mes_filtro = $_GET['mes_filtro'];
 $ano_filtro = $_GET['ano_filtro'];
 $id = $_GET['id'];
 
 mysqli_query($conexao_bd, "DELETE FROM saldos_recebidos WHERE id = '$id'");
 
 echo "<script language='javascript'>window.location='credito_a_receber.php?ano_filtro=$ano_filtro&mes_filtro=$mes_filtro';</script>";

}?>