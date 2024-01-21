<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/treinamento_online.css" rel="stylesheet" type="text/css" />
</head>

<body>

<? require "topo.php";?>
<div id="box_plano_canada">
<hr />

<h1 style="font:18px Arial, Helvetica, sans-serif; margin:10px; color:#666; text-transform:uppercase;"><strong>Plano canadá - RELATÓRIO COMPLETO</strong>
<form name="" method="post" action="" enctype="multipart/form-data">
<?
$dolar = 0;
$sql_dolar = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_dolar");
while($res_dolar = mysqli_fetch_array($sql_dolar)){
	$dolar = $res_dolar['dolar'];
}
?>
 <input style="border:1px solid #333; background:#000; float:right; text-align:center; color:#F00;" type="text" name="dolar" value="<? echo $dolar; ?>" size="5" maxlength="4" />

</form>

<? if(isset($_POST['dolar'])){

 $dolar = $_POST['dolar'];
 mysqli_query($conexao_bd, "UPDATE plano_canada_dolar SET dolar = '$dolar'");

 echo "<script language='javascript'>window.location='';</script>";
 
}?>

</h1>

<hr />
	<div id="despesas_previstas">
	 <img src="img/plano_canada/despesas_previstas.fw.png" width="170" height="52" />
     R$ <?
      
	  $valor_despesa = 0;
	  $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada");
	 	while($res_despesas = mysqli_fetch_array($sql_despesas)){
			$valor_despesa = $valor_despesa+($res_despesas['valor']*$res_despesas['quant']);
		}
		$valor_despesa = $valor_despesa*$dolar;
	 	echo number_format($valor_despesa,2,',','.');
	 ?>
    </div><!-- despesas_previstas -->

	<div id="faturas_fechadas">
	 <img src="img/plano_canada/faturas_fechadas.fw.png" width="170" height="52" />
	 R$     
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
	 ?>     
    </div><!-- faturas_fechadas -->
    
	<div id="faturas_a_receber">
	 <img src="img/plano_canada/faturas_a_receber.fw.png" width="170" height="52" />
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
		
		$valor_a_receber = $valor_a_receber*0.9;
		
		echo number_format($valor_a_receber,2,',','.');
	 ?>
          
    </div><!-- faturas_fechadas -->
    
	<div id="saldo_bancario">
	 <img src="img/plano_canada/saldo_bancario.fw.png" width="170" height="52" />
     
     R$ <?
      
	  $saldo_bancario = 0;
	  $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_saldo_confirmado WHERE tipo = 'SALDO'");
	 	while($res_despesas = mysqli_fetch_array($sql_despesas)){
			$saldo_bancario = $saldo_bancario+($res_despesas['valor']);
		}
	 	echo number_format($saldo_bancario,2,',','.');
	 ?>     
     
    </div><!-- saldo_bancario -->    
    
	<div id="investimento_bancario">
	 <img src="img/plano_canada/investimento_bancario.fw.png" width="170" height="52" />
     R$ <?
      
	  $investimento = 0;
	  $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_saldo_confirmado WHERE tipo = 'INVESTIMENTO'");
	 	while($res_despesas = mysqli_fetch_array($sql_despesas)){
			$investimento = $investimento+($res_despesas['valor']);
		}
	 	echo number_format($investimento,2,',','.');
	 ?>       
    </div><!-- investimento_bancario -->    
    
	<div id="emprestimos">
	 <img src="img/plano_canada/emprestimos.fw.png" width="170" height="52" />
	R$ <? 
	  $conta_parcelas_aguarda = 0;
		   $sql_boletos = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE status = 'AGUARDA'");
	   while($res_emprestimos = mysqli_fetch_array($sql_boletos)){
		
		
   		  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email WHERE cliente = ".$res_emprestimos['cliente']."");
			if(mysqli_num_rows($sql_cliente) == ''){
				$conta_parcelas_aguarda = $res_emprestimos['valor']+$conta_parcelas_aguarda;
		 }		
		
		
	   }
	  $conta_parcelas_aguarda = $conta_parcelas_aguarda*0.9;
	  echo number_format($conta_parcelas_aguarda,2,',','.');
			 
	 ?>     
     
    </div><!-- emprestimos -->
    
	<div id="previsto">
	 <img src="img/plano_canada/previsto.fw.png" width="170" height="52" />
     R$ <?
      
	  $previsto = 0;
	  $sql_despesas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_previsto");
	 	while($res_despesas = mysqli_fetch_array($sql_despesas)){
			$previsto = $previsto+($res_despesas['valor']*$res_despesas['quant']);
		}
		
		$previsto = $previsto*0.9;
		
	 	echo number_format($previsto,2,',','.');
	 ?>     
    </div><!-- previsto -->       
    
	<div id="capitalizacao">
	 <img src="img/plano_canada/capitalizacao.fw.png" width="170" height="50" />
	 R$ <?
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
    </div><!-- capitalizacao --> 
    
	<div id="saldo_atual">
	 <img src="img/plano_canada/saldo_atual.fw.png" width="170" height="50" />
     <?
      $despesas_confirmadas = 0;
	  $sql_despesas_confrmadas = mysqli_query($conexao_bd, "SELECT * FROM plano_canada_despesas");
	   while($res_despesas_confirmadas = mysqli_fetch_array($sql_despesas_confrmadas)){
		   $despesas_confirmadas = $despesas_confirmadas+$res_despesas_confirmadas['valor'];
	   }
	 ?>
     
    R$  <? echo number_format((($conta_parcelas_aguarda+$saldo_bancario+$previsto+$investimento+$valor_a_receber+$faturas_fechadas-$valor_confirmado)-$despesas_confirmadas),2,',','.'); ?>
    </div><!-- saldo_atual --> 
    
	<div id="ainda_falta">
	 <img src="img/plano_canada/ainda_falta.fw.png" width="170" height="50" />
     R$  <? echo number_format(($valor_despesa+$valor_confirmado)-($conta_parcelas_aguarda+$previsto+$saldo_bancario+$investimento+$valor_a_receber+$faturas_fechadas),2,',','.'); ?>
    </div><!-- ainda_falta --> 
    
<img src="img/plano_canada/ainda_falta.fw.png" width="1000" height="1" />        

<h1 style="font:12px Arial, Helvetica, sans-serif; color:#900; margin:20px 0 0 400px;"><strong>Você tem <?
	
	echo number_format(($conta_parcelas_aguarda+$saldo_bancario+$previsto+$investimento+$valor_a_receber+$faturas_fechadas)*100/$valor_despesa,2);
	

?>% do necessário</strong></h1>

</div><!-- box_plano_canada -->
</body>
</html>
