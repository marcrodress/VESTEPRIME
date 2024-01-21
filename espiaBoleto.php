<?
 require "conexao.php";
 /*
 if($_GET['p'] != '4'){
	
 $conjunto = 0;
 $valorConjunto = 0;
 $valorPagamento = 0;
 $ultimoBoleto = 0;
 $valorUltimoBoleto = 0;
	
 $sqlVerificaUltimoBoleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE operador = '$operador' AND status != 'CANCELADO' ORDER BY id DESC LIMIT 1");
   while($resVerificaUltimoBoleto = mysqli_fetch_array($sqlVerificaUltimoBoleto)){
	   $conjunto = $resVerificaUltimoBoleto['conjunto'];
      
	   $valorUltimoBoleto = $resVerificaUltimoBoleto['valor_recebido'];
	   $ultimoBoleto = $resVerificaUltimoBoleto['code_boleto'];
  }

  if($conjunto !=0){
	   
	   $sqlBoletosConjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$conjunto' AND status != 'CANCELADO'");
	   	 while($resBoletosConjunto = mysqli_fetch_array($sqlBoletosConjunto)){
			 $valorConjunto+=$resBoletosConjunto['valor_recebido'];
		}


		
		$sqlVerificaPagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '$conjunto'");
			 while($resVerificaPagamento = mysqli_fetch_array($sqlVerificaPagamento)){
				 $valorPagamento+=$resVerificaPagamento['valor_transacao'];
			}

			
			if($valorConjunto > $valorPagamento){
				
				mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'TENTOU FAZER ALGUMA ALTERAÇÃO NO SISTEMA DE BOLETOS', '$url')");
				
				echo "<script>window.alert('Prezado(a) operador(a), o que você está tentando fazer é errado e põe em risco o sistema financeiro, portanto, foi colocado um alerta em seu login para averiguar possíveis irregularidades e uma notificação foi enviada ao seu superior para verificar sua condulta!');window.location='carrinho.php?p=index';</script>";
			
			}
	   
   }else{
	   
	   $sqlVerificaPagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$ultimoBoleto'");
			 while($resVerificaPagamento = mysqli_fetch_array($sqlVerificaPagamento)){
				 $valorPagamento += $resVerificaPagamento['valor_transacao'];
			}
  
  
 				if($valorUltimoBoleto > $valorPagamento){
				
				mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'TENTOU FAZER ALGUMA ALTERAÇÃO NO SISTEMA DE BOLETOS', '$url')");

				
				echo "<script>window.alert('$valorUltimoBoleto - $valorPagamento, Prezado(a) operador(a), o que você está tentando fazer é errado e põe em risco o sistema financeiro, portanto, foi colocado um alerta em seu login para averiguar possíveis irregularidades e uma notificação foi enviada ao seu superior para verificar sua condulta!');window.location='carrinho.php?p=index';</script>";
			
				}
  
  
  }
 
 }
 
 */

?>