<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/setor_de_credito.css" rel="stylesheet" type="text/css" />
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
    <hr />
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

 <div id="resumo">
 	
    <div id="valor_recebido">
     <img src="img/valor_recebido.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;">
     R$
	 <? 
	 	$dia_filtro = $_GET['dia_filtro'];
	 	$mes_filtro = $_GET['mes_filtro'];
	 	$ano_filtro = $_GET['ano_filtro'];
		
		$filtro_recebido = 0;
		if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
			$filtro_recebido = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro'";
		}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
			$filtro_recebido = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro'";
		}else{
			$filtro_recebido = "WHERE ano = '$ano_filtro'";
		}
		
	 	$pagamentos_recebidos = 0;
	 	$sql_pagamento_fatura = mysqli_query($conexao_bd, "SELECT * FROM pagamento_fatura $filtro_recebido");
			while($res_pagamento_fatura = mysqli_fetch_array($sql_pagamento_fatura)){
				$pagamentos_recebidos = $res_pagamento_fatura['valor']+$pagamentos_recebidos;
			}
			echo number_format($pagamentos_recebidos,2,',','.');
	 ?>     
     </p>
    </div><!-- valor_recebido -->
  
    <div id="valor_a_receber">
     <img src="img/valor_a_receber.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;">
     R$
       <? 
		
		$sql_cadastra_cliente = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura");
			while($res_cadastra_cliente = mysqli_fetch_array($sql_cadastra_cliente)){
				$cliente = $res_cadastra_cliente['cliente'];
				$code_transacao = $res_cadastra_cliente['code_transacao'];
				
				mysqli_query($conexao_bd, "UPDATE compras_parceladas SET sit_pag_fatura = '$cliente' WHERE code_transacao = '$code_transacao'");
				
			}
		
		
		
		
		$valor_a_receber = 0;
		
		$sql_receber = mysqli_query($conexao_bd, "SELECT * FROM compras_parceladas WHERE status = 'Aguarda'");
			while($res_receber = mysqli_fetch_array($sql_receber)){
				$cliente = $res_receber['sit_pag_fatura'];
				
				$sql_verifica_registracao = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '$cliente'");
				if(mysqli_num_rows($sql_verifica_registracao) == ''){
				$valor_a_receber = $valor_a_receber+$res_receber['valor_parcela'];
				}
			}
		
		
		echo number_format($valor_a_receber,2,',','.');
	 ?>
     </p>
    </div><!-- valor_a_receber -->

    <div id="vencido">
     <img src="img/VENCIDO.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;">     R$ 
 <a style="text-decoration:none; color:#F00;" target="_blank" href="scripts/faturas_vencidas.php">
    <?
  $faturas_vencidas = 0;
  $sql_vencidas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'VENCIDA'");
	   while($res_vencidas = mysqli_fetch_array($sql_vencidas)){
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '".$res_vencidas['cliente']."'");
			if(mysqli_num_rows($sql_cliente) == ''){
					$faturas_vencidas = $res_vencidas['valor']+$faturas_vencidas;
				}
			}
		echo number_format($faturas_vencidas,2,',','.');
	 ?></a>
     </p>
    </div><!-- vencido -->

    <div id="prejuizo">
     <img src="img/prejuizo.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;">R$     
       <?
		$prejuizo = 0;
  		$sql_faturas_fechadas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE sit_pag = 'VENCIDA'");
			while($res_faturas_fechadas = mysqli_fetch_array($sql_faturas_fechadas)){
				$cliente = $res_faturas_fechadas['cliente'];
				$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND status = 'CANCELADO'");
				if(mysqli_num_rows($sql_cliente) >= 1){
				$prejuizo = $res_faturas_fechadas['valor']+$prejuizo;
			 }
			}
			echo number_format($prejuizo,2,',','.');
	 ?></p>
    </div><!-- prejuizo -->  

    <div id="faturas_fechadas">
     <img src="img/FATURAS_FECHADAS.fw.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;">R$     
       <?
		$faturas_fechadas = 0;
  		$sql_faturas_fechadas = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas ORDER BY id DESC LIMIT 200");
			while($res_faturas_fechadas = mysqli_fetch_array($sql_faturas_fechadas)){
				$cliente = $res_faturas_fechadas['cliente'];
				
			  if($res_faturas_fechadas['sit_pag'] == 'AGUARDA PAGAMENTO' || $res_faturas_fechadas['sit_pag'] == 'VENCIDA'){
				$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = '$cliente'");
				if(mysqli_num_rows($sql_cliente) == 0){
				$faturas_fechadas = $res_faturas_fechadas['saldo']+$faturas_fechadas;
				}
			 }				   
			}
			echo number_format($faturas_fechadas,2,',','.');
	 ?></p>
    </div><!-- faturas_fechadas -->  

    <div id="clientes_ativos">
     <img src="img/clientes_ativos.png" width="172" height="40" />
     <p style="margin:7px 0 0 0;"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE status = 'ATIVO'")); ?>
     </p>
    </div><!-- clientes_ativos -->   

    <div id="pagamento_contas">
     <img src="img/pagamento_contas.fw.png" />
     <p style="margin:7px 0 0 0;">
      <?
       $pagamento_conta1 = 0;
       $pagamento_conta2 = 0;
       $pagamento_conta3 = 0;
	   
	   $mes1 = $mes-1;
	   if($mes1 <10){ $mes1 = "0$mes1"; }else{ $mes1 = $mes1; }
	   
	   $sql_pagamento_contas1 = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE descricao = 'PAGAMENTO DE CONTAS' AND mes = '$mes1' AND ano = '$ano'");
	   while($res_pagamento_contas1 = mysqli_fetch_array($sql_pagamento_contas1)){
		   $pagamento_conta1 = $res_pagamento_contas1['valor']+$pagamento_conta1;
	   }
	   $sql_pagamento_contas2 = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE descricao = 'PAGAMENTO DE CONTAS' AND mes = '$mes' AND ano = '$ano'");
	   while($res_pagamento_contas2 = mysqli_fetch_array($sql_pagamento_contas2)){
		   $pagamento_conta2 = $res_pagamento_contas2['valor']+$pagamento_conta2;
	   }
	   
	   echo number_format($pagamento_conta1+$pagamento_conta2,2,',','.');
	   
	   
	   
	  ?>
     </p>
    </div><!-- pagamento_contas -->

    <div id="recarga_celular">
     <img src="img/recarga_celular.fw.png" />
     <p style="margin:7px 0 0 0;">
      <?
       $recarga1 = 0;
       $recarga2 = 0;
	   
	   $mes1 = $mes-1;
	   if($mes1 <10){ $mes1 = "0$mes1"; }else{ $mes1 = $mes1; }
	   
	   $sql_recarga1 = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE descricao = 'RECARGA DE CELULAR PRÉ-PAGO' AND mes = '$mes1' AND ano = '$ano'");
	   while($res_recarga1 = mysqli_fetch_array($sql_recarga1)){
		   $recarga1 = $res_recarga1['valor']+$recarga1;
	   }
	   $sql_recarga2 = mysqli_query($conexao_bd, "SELECT * FROM lancamento_fatura WHERE descricao = 'RECARGA DE CELULAR PRÉ-PAGO' AND mes = '$mes' AND ano = '$ano'");
	   while($res_recarga2 = mysqli_fetch_array($sql_recarga2)){
		   $recarga2 = $res_recarga2['valor']+$recarga2;
	   }
	   
	   echo number_format($recarga1+$recarga2,2,',','.');
	   
	   
	   
	  ?>
     </p>
    </div><!-- recarga_celular -->   
 </div><!-- resumo -->
 
 <div id="resumo_emprestimo">
  <h1><strong>Empréstimo no boleto</strong></h1>
 	
    <div id="valor_recebido">
     <img src="img/clientes_aptos.png" />
     <p style="margin:7px 0 0 0;">
      <? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne")); ?>
     </p>
    </div><!-- valor_recebido -->
  

    <div id="prejuizo">
     <img src="img/investimento_confirmado.png" />
     <p style="margin:7px 0 0 0;">
     <strong>R$     
      <? 
	   $investimento_confirmado = 0;
	   $sql_investimento_confirm = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE status = 'APROVADO'");
	    while($res_investimento_confirm = mysqli_fetch_array($sql_investimento_confirm)){
			
			$investimento_confirmado = $res_investimento_confirm['valor']+$investimento_confirmado;
		}
		echo number_format($investimento_confirmado,2,',','.');
	  ?>	
      </strong>
     </p>
    </div><!-- prejuizo -->  

    <div id="clientes_ativos">
     <img src="img/faturamento_previsto_confirmado.png" />
      <? 
	   $faturamento_confirmado = 0;
	   $sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE status = 'APROVADO'");
	    while($res_boleto = mysqli_fetch_array($sql_boleto)){
   		  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = ".$res_boleto['cpf']."");
			if(mysqli_num_rows($sql_cliente) == ''){
			$faturamento_confirmado = ($res_boleto['quant_parcela']*$res_boleto['valor_parcela'])+$faturamento_confirmado;
		}
		}
		echo number_format($faturamento_confirmado,2,',','.');
	  ?>	     
     </p>
    </div><!-- clientes_ativos --> 
    <br /><br /><br /><br /><br /><br />

    <div id="valor_recebido">
     <img src="img/lucro_previsto.png" />
     <p style="margin:7px 0 0 0;">
     <strong>R$ <? echo number_format($faturamento_previsto2-$invesimento_previsto,2,',','.'); ?></strong>
     </p>
    </div><!-- valor_recebido -->

    <div id="valor_a_receber">
     <img src="img/lucro_confirmado.png" />
     <p style="margin:7px 0 0 0;">
     <strong>R$ <? echo number_format($faturamento_confirmado-$investimento_confirmado,2,',','.'); ?></strong>
     </p>
    </div><!-- valor_a_receber -->     
    

    <div id="valor_a_receber">
     <img src="img/valor_ja_recebido.png" />
     <p style="margin:7px 0 0 0;">
     <strong>R$ 
	 <? 
	  $conta_parcelas_pagas = 0;
	  $sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE status = 'PAGO'");
		while($res_boletos = mysqli_fetch_array($sql_boletos)){
			$conta_parcelas_pagas = $res_boletos['valor']+$conta_parcelas_pagas;
	   }
	  
	  echo number_format($conta_parcelas_pagas,2,',','.');
			 
	 ?>
     </strong>
     </p>
    </div><!-- valor_a_receber -->   
 
    <div id="valor_a_receber">
     <img src="img/valor_a_receber_emprestimo.png" />
     <p style="margin:7px 0 0 0;">
	 <? 
	  $conta_parcelas_aguarda = 0;
		   $sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE status = 'AGUARDA'");
	   while($res_emprestimos = mysqli_fetch_array($sql_boletos)){
		
		
   		  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = ".$res_emprestimos['cliente']."");
			if(mysqli_num_rows($sql_cliente) == ''){
				$conta_parcelas_aguarda = $res_emprestimos['valor']+$conta_parcelas_aguarda;
		 }		
		
		
	   }
	  
	  echo number_format($conta_parcelas_aguarda,2,',','.');
			 
	 ?>

     </p>
    </div><!-- valor_a_receber -->         
    
 </div><!-- resumo_emprestimo -->
 <br /><br /><br />
 <br /><br /><br />
 <hr />
 
 <div id="resumo_capitalizacao">
  <h1 style="font:17px Arial, Helvetica, sans-serif; color:#CCC;"><strong><strong>TÍTULOS DE CAPITALIZAÇÃO</strong></strong></h1>
 	
    <div id="valor_recebido">
     <img src="img/titulos_ativos.png" />
     <p style="margin:7px 0 0 0;">
      <? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE status = 'Ativo'")); ?>
     </p>
    </div><!-- valor_recebido -->
  
    <div id="valor_a_receber">
     <img src="img/cap_faturamento_previsto.png" />
     <p style="margin:7px 0 0 0;">
      <?
       $valor_previsto = 0;
	   $valor_plano = 0;
	   $sql_previsto = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE status = 'Ativo'");
	   	while($res_previsto = mysqli_fetch_array($sql_previsto)){
			$plano = $res_previsto['plano'];
			$valor_plano = $res_previsto['valor'];

			if($plano == 'GOLD'){
				$plano = 24;
				$valor_plano = $valor_plano*24;
			}elseif($plano == 'VAREJO'){
				$plano = 12;
				$valor_plano = $valor_plano*12;
			}elseif($plano == 'PLATINUM'){
				$plano = 36;
				$valor_plano = $valor_plano*36;
			}elseif($plano == 'BLACK'){
				$plano = 48;
				$valor_plano = $valor_plano*48;
			}elseif($plano == 'MASTERBLACK'){
				$plano = 60;												
				$valor_plano = $valor_plano*60;
			}
			
			$valor_previsto = $valor_previsto+$valor_plano;
			$valor_plano = 0;
			$plano = 0;

		} // while
	   	   
		   echo number_format($valor_previsto,2,',','.');
		   
	  ?> 	
     </p>
    </div><!-- valor_a_receber -->
  
    <div id="valor_a_receber">
     <img src="img/cap_faturamento_confirmado.png" />
     <p style="margin:7px 0 0 0;">
      <?
       $valor_confirmado = 0;
	   $sql_confirmado = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE status = 'Ativo'");
	   	while($res_confirmado = mysqli_fetch_array($sql_confirmado)){
			$code = $res_confirmado['code'];
			
		  $sql_parcelas = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE code_capitalizacao = '$code' AND status = 'Pago'");
		  	while($res_parcelas = mysqli_fetch_array($sql_parcelas)){
				$valor_confirmado = $valor_confirmado+$res_parcelas['valor'];
			}
		}
	   	   
		   echo number_format($valor_confirmado,2,',','.');
		   
	  ?>
     </p>
    </div><!-- valor_a_receber -->
    
 </div><!-- resumo_capitalizacao -->
 
</div><!-- box_pagamento_1 -->
</body>
</html>