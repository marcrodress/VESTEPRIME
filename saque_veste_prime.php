<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/saque_veste_prime.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<? $disponivel_cheque_especial = 0; $limite_loja_disponivel = 0; $saldo = 0; $code_carrinho = 0; $cliente = 0; ?>

 <div id="box_cliente">
 <?
 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];
		
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
	if(mysqli_num_rows($sql_cliente) == ''){
	}else{
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$cliente = $res_cliente['cliente'];
		
	$sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
	if(mysqli_num_rows($conexao_bd, $sql_nome_cliente) == ''){
	}else{
		while($res_nome_cliente = mysqli_fetch_array($sql_nome_cliente)){
			$nome_cliente = $res_nome_cliente['nome'];	
 ?>
 <h1><strong> CLIENTE: </strong><strong class="strong"><? echo $nome_cliente; ?></strong>
<strong>SEGM: </strong><strong class="strong"><? echo $res_cliente['categoria']; ?></strong>         <strong class="strong2"><strong>LIMITE DISPONIVEL:</strong></strong><strong class="strong">R$ <? echo $limite_loja_disponivel = number_format($res_cliente['limite_loja_disponivel'],2); ?></strong></h1>
 <h1><strong>SALDO em conta: </strong><strong class="strong">R$ 
 <? 
  
 $saldo = $res_cliente['saldo'];  
 $saldo2 = number_format($res_cliente['saldo'],2);  
 echo number_format($res_cliente['saldo'],2);
 
 if($saldo2 <0){
 	$saldo2 = 0;
 }else{
	 $saldo2 = $saldo2;
 }
 
 
 ?>
 </strong> <strong>LIMITE: </strong><strong class="strong">R$ <? echo $disponivel_cheque_especial = number_format($res_cliente['disponivel_cheque_especial'],2); ?></strong> <strong>CRÉD. PESSOAL:</strong><strong class="strong">R$ <? echo number_format($res_cliente['disponivel_credito_pessoal'],2); ?></strong> <strong>SAQUE:</strong><strong class="strong">R$ <? echo number_format($res_cliente['disponivel_saque_facil'],2); ?></strong></h1>
 <? }}}}}} ?>
 </div><!-- box_cliente -->


<div id="box_corpo">
 <div id="pagamento">
 
 <form name="" method="post" action="" enctype="multipart/form-data">
 <h1><strong>ESCOLHA A FORMA DE DEPÓSITO</strong></h1><br />
 <select name="pag_forma" size="1">
   <option value="DEBITO EM CONTA">1 - DEBITO EM CONTA</option>
 </select> 
 <input type="text" name="valor_pag" value="" />
 </form>
 <? if(isset($_POST['valor_pag'])){
	 
  $valor_pag = $_POST['valor_pag'];
  
  if($saldo < $valor_pag){
  	echo "<script language='javascript'>window.alert('SALDO INSUFICIENTE PARA REALIZAR SAQUE!');</script>";
  }else{
   
   $novo_saldo = $saldo-$valor_pag;
   $sql_saque = mysqli_query($conexao_bd, "UPDATE conta_corrente SET saldo = '$novo_saldo' WHERE cliente = '$cliente'");
   if($sql_saque == ''){
  	echo "<script language='javascript'>window.alert('SISTEMA INOPERANTE. TENTE NOVAMENTE!');</script>";
   }else{
?>
  
    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=335,height=400');
		}
	</script>
<a onclick="abrePopUp('scripts/autorizacao_saque_em_conta.php?cliente=<? echo $cliente; ?>&valor=<? echo $valor_pag; ?>&cheque_especial=<? echo $valor_debito_conta; ?>&autenticacao=<? echo md5($dia*rand()); ?>');" href="">Assinar autorização de débito em conta</a> 
<?	
   }// if que verica que o saque foi feito com sucesso
  } // if que verica o saldo do cliente em conta corrente
 }?>
 <hr />
 
 </div><!-- pagamento -->
 
 <div id="box_compras">

 </div><!-- box_compras -->

 </div><!-- valor_compras -->
 
</div><!-- box_corpo -->

<? require "rodape.php"; ?>
</body>
</html>