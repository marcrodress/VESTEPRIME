<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_cartao_credito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<? if(isset($_POST['enviar'])){
	
$valor = $_POST['valor'];
$recebimento = $_POST['recebimento'];

if($valor == ''){
	echo "<script language='javascript'>window.alert('Digite um valor para simular!');</script>";
}else{
	echo "<script language='javascript'>window.location='?p=1&valor=$valor&recebimento=$recebimento';</script>";
 }
}?>
<? if($_GET['p'] == '1' || $_GET['p'] == ''){ ?>
<div id="box_pagamento_1">

<h1><strong>Empréstimo no cartão de crédito</strong></h1><hr />
<form method="post" name="" action="" enctype="multipart/form-data">
 <input type="text" name="valor" size="56" autofocus/>
 <select name="recebimento" size="1">
   <option value="MASTERCARD">MASTER</option>
   <option value="VISA">VISA</option>
   <option value="ELO">ELO</option>
   <option value="FORTBRASIL">FORTBRASIL</option>
 </select>
 <input class="input" type="submit" name="enviar" value="SIMULAR" />
</form>
<hr />
<? } // fim da caixa ?>


<? if($_GET['p'] == '1'){ ?>
<div id="box_pagamento_1">

<h2><strong>SIMULAÇÃO PARA R$ <? $valor = $_GET['valor']; echo number_format($_GET['valor'], 2, ',', '.');?></strong></h2>
<hr />

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td colspan="3">
      <strong>SELECIONE AS PARCELA</strong><strong>S</strong></td>
    </tr>
  <? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td width="53"><input class="input3" type="radio" name="parcela" id="radio" value="<? echo $i; ?>"></td>
    <td width="200"> <? 
	if($_GET['recebimento'] == 'FORTBRASIL'){
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.2;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	}else{
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.1;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	}
	?>
    <?
	if($simulacao <5){
	}else{
    echo $i; echo " X ";
	echo number_format($simulacao, 2, ',', '.');  ?>
    
    </td>
    <td align="right" width="620"><h8 class="h8_valor">R$ <? echo number_format($simulacao*$i, 2, ',', '.');  ?></h8></td>
  </tr>
  <? }} ?>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><input class="input2" type="submit" name="button" id="button" value="Avançar"></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){

$parcela = $_POST['parcela'];
$valor = $_GET['valor'];
$recebimento = $_GET['recebimento'];

echo "<script language='javascript'>window.location='?p=2&valor=$valor&recebimento=$recebimento&parcela=$parcela';</script>";


}?>

<? } // fecha o P1 ?>

</div><!-- box_pagamento_1 -->




<? if($_GET['p'] == '2'){ ?>
<div id="box_pagamento_2">
<h1><strong>Confirme a forma de recebimento</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<select class="select" name="form_pgt" size="1">
  <option value="CAIXA">PAGAMENTO NO CAIXA</option>
  <option value="TED">TED</option>
  <option value="DOC">DOC</option>
</select>
<input class="input" type="submit" name="avancar" value="Avançar" />
</form>
<? if(isset($_POST['avancar'])){
	
$parcela = $_GET['parcela'];
$form_pgt = $_POST['form_pgt'];
$valor = $_GET['valor'];
$recebimento = $_GET['recebimento'];


$cliente = 0;
$carrinho = 0;

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
		$code_carrinho = $res_cliente['code_carrinho'];
} // fecha busca cliente


echo "<script language='javascript'>window.location='?p=3&valor=$valor&recebimento=$recebimento&parcela=$parcela&form_pgt=$form_pgt&cliente=$cliente';</script>";


}?>
</div><!-- box_pagamento_2 -->
<? } // fecha o P2 ?>







<? if($_GET['p'] == '3'){ ?>
<div id="box_pagamento_3">

<? if(isset($_POST['button2'])){
	
	
$parcela = $_GET['parcela'];
$valor = $_GET['valor'];
$recebimento = $_GET['recebimento'];
$form_pgt = $_GET['form_pgt'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$telefone = $_POST['telefone'];
$banco = $_POST['banco'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$numero_conta = $_POST['numero_conta'];

$n_proposta = rand();

if($_GET['recebimento'] == 'FORTBRASIL'){
		
	$valor = $_GET['valor'];
	$i = $_GET['parcela'];
	$parcela = $_GET['parcela'];
	
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.2;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	$valor_total = $simulacao*$i;
	
}else{

	$valor_total = 0;
	$simulacao = 0;
	$i = $parcela;
	
	if($_GET['recebimento'] == '7'){
	$base_juro = (($i+10)/100);
	$simulacao = (($base_juro*$valor)+$valor)/$i;
	$valor_total = $simulacao*$valor;
	}else{
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.1;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	$valor_total = $simulacao*$i;
	}
	


} // verifica o tipo de cartão

if($form_pgt == 'TED' && $agencia == '' && $numero_conta == ''){
	echo "<script language='javascript'>window.alert('INFORME TODOS OS DADOS PARA EMISSÃO DO DOC/TED!');</script>";
}else{
	
  $sql_insert = mysqli_query($conexao_bd, "INSERT INTO emprestimo_cartao (codeCaixa, turno, n_proposta, data, data_completa, dia, mes, ano, ip, operador, status, forma_pagamento, valor, juros, recebimento, quant_parcela, valor_parcela, valor_total, cpf, nome, telefone, banco, tipo_conta, agencia, conta, tarifa, lucro) VALUES ('$codeCaixa', '$turno', '$n_proposta', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'Aguarda', '$form_pgt', '$valor', '$base_juro', '$recebimento', '$parcela', '$simulacao', '$valor_total', '$cpf', '$nome', '$telefone', '$banco', '$tipo_conta', '$agencia', '$numero_conta', '$tarifa', '')");
?>



  
  <?
  $valor_pontos = $_GET['valor'];
  $novos_pontos = 0;;
  $vestepoint = 0;
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = $valor_pontos/2;
		}elseif($categoria == 'platinum'){
			$novos_pontos = $valor_pontos/2.5;
		}elseif($categoria == 'gold'){
			$novos_pontos = $valor_pontos/3.5;
		}else{
			$novos_pontos = $valor_pontos/4;
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'EMPRESTIMO NO CARTAO DE CREDITO', '$operador', '$novos_pontos', '$valor_pontos', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cpf'");
			
  
  
  
  ?>  
    


DSF

<h1><strong>EMPRÉSTIMO REALIZADO COM SUCESSO!</strong></h1><hr /><br /><br />
<p>Solicite ao cliente que assine o contrato de realização do empréstimo para arquivamento.</p>
<p>Solicite ao cliente que assine o cupom de recebimento de valores.</p>
<p>&nbsp;</p>
<p><a class="a" target="_blank" rel="superbox[iframe][1000x1550]" href="scripts/imprimir_contrato.php?n_proposta=<? echo $n_proposta; ?>&cpf=<? echo $cpf; ?>">IMPRIMIR CONTRATO DE EMPRÉSTIMO</a></p><br />
<? if($form_pgt == 'CAIXA'){ ?>


    	<script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=350,height=400');
		}
	</script>
<p><a class="a2" onclick="abrePopUp('scripts/termo_recebimento_de_emprestimo_cartoa.php?cpf=<? echo $cpf; ?>&n_proposta=<? echo $n_proposta; ?>&nome=<? echo $nome; ?>&valor=<? echo $valor; ?>');" href="">IMPRIMIR TERMO DE RECEBIMENTO DE VALORES</a> </p>
<? } ?>

<?	die; } }?>


<h1><strong>CONFIRME A CONTRATAÇÃO DO EMPRÉSTIMO</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
  <? 
  
  	if($_GET['recebimento'] == 'FORTBRASIL'){
		
	$valor = $_GET['valor'];
	$i = $_GET['parcela'];
	$parcela = $_GET['parcela'];
	
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.2;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	$valor_total = $simulacao*$valor;
	}else{
    $valor = $_GET['valor'];
    $parcela = $_GET['parcela'];
	$i = $parcela;
	if($_GET['recebimento'] == '7'){
	$base_juro = (($i+10)/100);
	$simulacao = (($base_juro*$valor)+$valor)/$i;
	$valor_total = $simulacao*$valor;
	}else{
	$base_juro = (($i+10)/100);
	$tarifa = $valor*0.1;
	$simulacao = (($base_juro*$valor)+$valor+$tarifa)/$i;
	$valor_total = $simulacao*$valor;
	}
	
	} // verifica a bandeira do cartão
  ?>
    <td colspan="4"><strong>FOI SOLICITADO R$ <? echo number_format($valor, 2, ',', '.'); ?> PARCELADO EM <? echo $parcela;  ?> X <? echo number_format($simulacao, 2, ',', '.'); ?> </strong></td>
  </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>
  <tr>
    <td width="180">NOME:</td>
    <td width="79">CPF</td>
    <td width="80">TELEFONE</td>
    <td width="194">RECEBIMENTO</td>
    </tr>
  <tr>
    <td><span id="sprytextfield2">
      <input name="nome" type="text" id="textfield" size="40" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['nome'];
			}
	
	?>"/>
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield3">
      <input name="cpf" type="text" id="textfield2" size="20" value="<? echo $_GET['cliente']; ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="textfield6"></label>
      <span id="sprytextfield81sd5f1">
      <input name="telefone" type="text" id="textfield6" size="15" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['celular_1'];
			}
	
	?>" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="textfield3"></label>
      <input name="recebimento" disabled="disabled" type="text" id="textfield3" size="20" value="<? echo $_GET['form_pgt']; ?>">
     </td>
    </tr>
  <tr>
    <td>BANCO</td>
    <td>TIPO CONTA</td>
    <td>AGÊNCIA</td>
    <td>N&Uacute;MERO DA CONTA</td>
    </tr>
  <tr>
    <td>
    <select name="banco" size="1" id="banco">
      <option value=""></option>
     <?
     $sql_busca_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos");
	 	while($res_busca_banco = mysqli_fetch_array($sql_busca_banco)){
	 ?>
      <option value="<? echo $res_busca_banco['codigo']; ?> - <? echo $res_busca_banco['nome_banco']; ?>"><? echo $res_busca_banco['codigo']; ?> - <? echo $res_busca_banco['nome_banco']; ?></option>
      <? } ?>
    </select>
    </td>
    <td>
    <select name="tipo_conta" size="1" id="tipo_conta">
      <option value=""></option>    
      <option value="CORRENTE">CORRENTE</option>
      <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
    </select></td>
    <td><input name="agencia" type="text" id="agencia" size="5" /></td>
    <td><input name="numero_conta" type="text" id="numero_conta" size="6" /></td>
    </tr>
  <tr>
    <td colspan="4"><hr /></td>
  </tr>    
  <tr>
    <td colspan="4"><input type="submit" name="button2" id="button2" value="CONFIRMAR" /></td>
    </tr>
</table>
</form>
</div><!-- box_pagamento_3 -->
<? } // fecha o P3 ?>



<script type="text/javascript">
var sprytextfield81sd5f1 = new Spry.Widget.ValidationTextField("sprytextfield81sd5f1", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
</script>
</body>
</html>