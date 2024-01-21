<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/credito_pessoal.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="box_corpo">
 <div id="box_input">
   <h1><strong>DIGITE O VALOR DO SAQUE</strong></h1>
   <hr />
   <form name="" method="post" action="" enctype="multipart/form-data">
   <input type="text" name="valor" />
   <select name="tipo" size="1">
     <option value="SAQUE">SAQUE</option>
     <option value="CREDITO PESSOAL">CREDITO PESSOAL</option>
   </select>
   <input class="input1" type="submit" name="simular" value="Simular" />
   </form>
   <? if(isset($_POST['simular'])){
	   
	$valor = $_POST['valor'];
	$tipo = $_POST['tipo'];
	
	echo "<script language='javascript'>window.location='?p=&simucao=1&valor=$valor&tipo=$tipo';</script>";	
	
   
   }?>
 </div><!-- box_input -->
 
 <? if($_GET['simucao'] == '1'){ ?>
 <div id="box_simulacao">
 <h2><strong>SIMUAÇÃO DE VALOR PARA <? echo number_format($_GET['valor'], 2, ',', '.'); ?> - <? echo $_GET['tipo']; ?></strong></h2><hr />
 
 <? if(isset($_POST['enviar'])){
	 
  $parcela = $_POST['parcela'];
  $valor = $_GET['valor'];
  $tipo = $_GET['tipo'];  
	  
	$cliente = 0;
	$limite_saque = 0;
	$disponivel_saque_facil = 0;
	
	$sql_cliente = mysql_query("SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
		while($res_cliente = mysql_fetch_array($sql_cliente)){
			$cliente = $res_cliente['cliente'];
	} // fecha busca cliente
	
	$sql_disponivel_saque_facil = mysql_query("SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND status = 'Ativo'");
		while($res_disponivel_saque_facil = mysql_fetch_array($sql_disponivel_saque_facil)){
			$disponivel_saque_facil = $res_disponivel_saque_facil['disponivel_saque_facil'];
	} // fecha busca cliente
		
	
	
	
	
	if($cliente == ''){
		echo "<script language='javascript'>window.alert('Cliente não encontrado!');</script>";
	}elseif($disponivel_saque_facil < $valor){
		echo "<script language='javascript'>window.alert('Cliente não possui limite disponível para saque!');</script>";
	}elseif($_GET['tipo'] == 'CREDITO PESSOAL'){
		echo "<script language='javascript'>window.alert('SOLICITAÇÃO DE CRÉDITO NEGADO!');</script>";
	}else{
	echo "<script language='javascript'>window.location='?p=2&simucao=2&valor=$valor&tipo=$tipo&cliente=$cliente&parcela=$parcela';</script>";	
		
	}
 
 }?>
 
 <form name="" method="post" action="" enctype="multipart/form-data">
 <? 
 for($i=1; $i<13; $i++){ 
 
 if($_GET['tipo'] == 'CREDITO PESSOAL'){
 $valor = (($_GET['valor']*0.0999)*$i)+$_GET['valor'];
 }else{
 $valor = (($_GET['valor']*0.129)*$i)+$_GET['valor'];
 }
 
 ?>
  <h1><input type="radio" name="parcela" value="<? echo $i; ?>" /> <? echo $i; ?> X <? echo number_format($valor/$i,2); ?></h1>
 <? } ?>
 <hr />
 <input class="input" type="submit" name="enviar" value="Enviar" />
 </form>
 
 </div><!-- box_simulacao -->
 <? } ?>






 
 <? if($_GET['simucao'] == '2'){ ?>
 <div id="box_simulacao">
 <h2><strong>ESCOLHER COMO QUER RECEBER OS R$ <? echo number_format($_GET['valor'], 2, ',', '.'); ?></strong></h2><hr />
 
 <? if(isset($_POST['enviar'])){
	 
  $recebimento = $_GET['recebimento'];
  $parcela = $_GET['parcela'];
  $valor = $_GET['valor'];
  $cliente = $_GET['cliente'];
  $tipo = $_GET['tipo'];
  $recebimento = $_POST['recebimento']; 
  
  echo "<script language='javascript'>window.location='?p=2&simucao=3&valor=$valor&tipo=$tipo&cliente=$cliente&parcela=$parcela&recebimento=$recebimento';</script>";	
  
   
 }?>
 
 <form name="" method="post" action="" enctype="multipart/form-data">
	<select class="select" name="recebimento" size="1">
	  <option value="TED">TED</option>
	  <option value="DOC">DOC</option>
	  <option value="CAIXA">CAIXA</option>
	</select>
 <input class="input" type="submit" name="enviar" value="Enviar" />
 </form>
 
 </div><!-- box_simulacao -->
 <? } ?>


 





 
 <? if($_GET['simucao'] == '3'){ ?>
 <div id="box_simulacao">
 

 <? if(isset($_POST['enviar'])){
	 
  $banco = $_POST['banco'];
  $tipo = $_POST['tipo'];
  $agencia = $_POST['agencia'];
  $conta = $_POST['conta'];
  
  if($agencia == ''){
  	echo "<script language='javascript'>window.alert('Informe a agência para crédito!');</script>";
  }elseif($conta == ''){
  	echo "<script language='javascript'>window.alert('Informe a conta para crédito!');</script>";
  }elseif($banco == ''){
  	echo "<script language='javascript'>window.alert('Informe o banco para crédito!');</script>";	
  }else{
	  
   
	  
 ?>
  
 
 <? die; }}?>
  
 <h2><strong>ESCOLHER COMO QUER RECEBER OS R$ <? echo number_format($_GET['valor'], 2, ',', '.'); ?></strong></h2><hr />
 
 <form name="" method="post" action="" enctype="multipart/form-data">
	<table width="400" border="0">
  <tr>
    <td><strong>BANCO</strong></td>
    <td><strong>TIPO DE CONTA</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="select"></label>
      <select class="select2" name="banco" id="select">
      <option value=""></option>
     <?
     $sql_busca_banco = mysql_query("SELECT * FROM lista_bancos");
	 	while($res_busca_banco = mysql_fetch_array($sql_busca_banco)){
	 ?>
      <option value="<? echo $res_busca_banco['codigo']; ?> - <? echo $res_busca_banco['nome_banco']; ?>"><? echo $res_busca_banco['codigo']; ?> - <? echo $res_busca_banco['nome_banco']; ?></option>
      <? } ?>      
    </select></td>
    <td><label for="select2"></label>
      <select name="tipo" size="1" class="select2" id="select2">
        <option value="CORRENTE">CORRENTE</option>
        <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
      </select></td>
    <td><label for="textfield"></label></td>
  </tr>
  <tr>
    <td><strong>AG&Ecirc;NCIA</strong></td>
    <td><strong>CONTA PARA CR&Eacute;DITO</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label for="textfield2">
      <input class="input2" name="agencia" type="text" id="textfield" size="10" />
    </label></td>
    <td><input class="input2" name="conta" type="text" id="textfield2" size="10" /></td>
    <td><input class="input" type="submit" name="enviar" value="Enviar" /></td>
  </tr>
</table>
</form>

 
 </div><!-- box_simulacao -->
 <? } ?>


 
</div><!-- box_corpo -->

<? require "rodape.php"; ?>

</body>
</html>