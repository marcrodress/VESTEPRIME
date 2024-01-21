<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_no_carne.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php";

$cpf_cliente = 0;
$limite_credito = 0;
$taxa_juros = 0;

 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
	echo "<script language='javascript'>window.alert('INFORME O CLIENTE PARA CONTINUAR!');window.location='carrinho.php';</script>";
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		$verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
		
			 while($res_limite = mysqli_fetch_array($verifica_limite)){
				 $credito_pessoal_disponivel = $res_limite['credito_pessoal_disponivel'];
				 $taxa_juros = $res_limite['juros'];
			}

		 if($credito_pessoal_disponivel <= 10){
			echo "<script language='javascript'>window.alert('CLIENTE INFORMADO NÃO POSSUI LIMITE DE CRÉDITO PARA CONTRATAÇÃO!');window.location='carrinho.php';</script>";
		 }else{
		 
		 }
  }
 }

?>

<? if(isset($_POST['enviar'])){
	
$valor = $_POST['valor'];
$recebimento = $_POST['recebimento'];

if($valor == ''){
	echo "<script language='javascript'>window.alert('Digite um valor para simular!');</script>";
}elseif($valor>$credito_pessoal_disponivel){
	echo "<script language='javascript'>window.alert('O valor máximo que pode ser simulado é $credito_pessoal_disponivel');</script>";
}else{
	echo "<script language='javascript'>window.location='?p=1&valor=$valor&recebimento=$recebimento';</script>";
 }
}?>
<? if($_GET['p'] == '1' || $_GET['p'] == ''){ ?>
<div id="box_pagamento_1">

<h1><strong>SAQUE FÁCIL</strong></h1>
<hr style="color:#111;" />
<form method="post" name="" action="" enctype="multipart/form-data">
 <input type="text" name="valor" size="70" />
 <input class="input" type="submit" name="enviar" value="SIMULAR" />
</form>
<hr style="color:#111;" />
<? } // fim da caixa ?>


<? if($_GET['p'] == '1'){ ?>
<div id="box_pagamento_1">

<h2><strong>SIMULAÇÃO PARA R$ <? $valor = $_GET['valor']; echo number_format($_GET['valor'], 2, ',', '.');?></strong></h2>
<hr style="color:#111;" />

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td colspan="3">
      <strong>SELECIONE AS PARCELA</strong><strong>S</strong></td>
    </tr>
  <? for($i=1; $i<=12; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td width="53"><input style="background:#000;" class="input3" type="radio" name="parcela" id="radio" value="<? echo $i; ?>"></td>
    <td width="200"><?
	$simulacao = (((((9.99)/100)*$valor)*$i)+$valor+10)/$i;
    echo $i; echo " X ";
	echo number_format($simulacao, 2, ',', '.');  ?>
    </td>
    <td align="right" width="620"><h8 class="h8_valor">R$ <? echo number_format($simulacao*$i, 2, ',', '.');  ?></h8></td>
  </tr>
  <? } ?>
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

$cliente = 0;
$carrinho = 0;

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
		$code_carrinho = $res_cliente['code_carrinho'];
} // fecha busca cliente

echo "<script language='javascript'>window.location='?p=2&valor=$valor&recebimento=$recebimento&parcela=$parcela&taxa_juros=$taxa_juros';</script>";

}?>

<? } // fecha o P1 ?>

</div><!-- box_pagamento_1 -->




<? if($_GET['p'] == '2'){ ?>
<div id="box_pagamento_2">
<h1><strong>Confirme a forma de recebimento</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<select class="select" name="form_pgt" size="1">
  <option value="PAGAMENTO NO CAIXA">PAGAMENTO NO CAIXA</option>
  <option value="TED/DOC">TED/DOC</option>
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

$taxa_juros = $_GET['taxa_juros'];

echo "<script language='javascript'>window.location='?p=3&valor=$valor&recebimento=$recebimento&parcela=$parcela&form_pgt=$form_pgt&cliente=$cliente&taxa_juros=$taxa_juros';</script>";


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
$cliente = $_GET['cliente'];

$n_proposta = rand();

$i = $_GET['parcela'];
$parcela = $_GET['parcela'];
$form_pgt = $_GET['form_pgt'];
	
$simulacao = number_format(((((9.99/100)*$valor)*$i)+$valor+10)/$i,2);
$valor_total = number_format($simulacao*$i,2, ',', '.');

if($form_pgt == 'TED' && $agencia == '' && $numero_conta == ''){
	echo "<script language='javascript'>window.alert('INFORME TODOS OS DADOS PARA EMISSÃO DO DOC/TED!');</script>";
}else{

$lucro = $valor_total-$valor;

  $sql_insert = mysqli_query($conexao_bd, "INSERT INTO emprestimo_saque_facil (codeCaixa, turno, n_proposta, data, data_completa, dia, mes, ano, ip, operador, status, forma_pagamento, valor, recebimento, quant_parcela, valor_parcela, valor_total, cpf, nome, telefone, banco, tipo_conta, agencia, conta, lucro) VALUES ('$codeCaixa', '$turno', '$n_proposta', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'APROVADO', 'VESTE PRIME CARD', '$valor', '$form_pgt', '$i', '$simulacao', '$valor_total', '$cpf_cliente', '$nome', '$telefone', '$banco', '$tipo_conta', '$agencia', '$numero_conta', '$lucro')");
  
  if($sql_insert == ''){
	echo "<script language='javascript'>window.alert('OCORREU UM ERRO AO ENVIAR PROPOSTA, TENTE NOVAMENTE!');</script>";  
  }else{
	
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cpf', 'SAQUE FÁCIL', '300')");
		 

		   
			mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, code_carrinho, cliente, parcelado, quant_parcela, valor_parcela, comprovante, operador) VALUES ('$n_proposta', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'SAQUE FÁCIL', '$valor', '$n_proposta', '$cliente', 'SIM', '$parcela', '$simulacao', '', '$operador')");
			
			for($i=1; $i<=$_GET['parcela']; $i++){
				mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$n_proposta', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '$i/$parcela', '$i', '$parcela', '$simulacao', '$cliente')");
			}
	  

		  $credito_pessoal_disponivel = 0;
		  $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
		   while($res_conta_corrente = mysqli_fetch_array($sql_conta_corrente)){
			   $credito_pessoal_disponivel = $res_conta_corrente['credito_pessoal_disponivel'];
			   
		   }
		  
		
		
		  $credito_pessoal_disponivel = $credito_pessoal_disponivel-$valor;
		  $score = $score-30;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score', credito_pessoal_disponivel = '$credito_pessoal_disponivel' WHERE cliente = '$cpf'");

	  
	echo "<script language='javascript'>window.alert('SOLICITAÇÃO DE CRÉDITO APROVADA, NÃO ESQUEÇA DE ASSINAR OS FORMULÁRIOS!');window.location='resultado_saque_facil.php?pg=detalhes&n_proposta=$n_proposta'</script>";  	 
   }
 }
}
?>



<h1><strong>CONFIRME A CONTRATAÇÃO DO SÁQUE FÁCIL</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <? 
	$valor = $_GET['valor'];
	$i = $_GET['parcela'];
	$parcela = $_GET['parcela'];
	$taxa_juros = $_GET['taxa_juros'];
	
    $simulacao = ((((9.99/100)*$valor)*$i)+$valor+10)/$i;

  ?>
    <td colspan="4" bgcolor="#000000"><strong>FOI SOLICITADO R$ <? echo number_format($valor, 2, ',', '.'); ?> PARCELADO EM <? echo $parcela;  ?> X <? echo number_format($simulacao, 2, ',', '.'); ?> </strong></td>
  </tr>
  <tr>
    <td width="180" bgcolor="#000000"><strong>NOME:</strong></td>
    <td width="79" bgcolor="#000000"><strong>CPF</strong></td>
    <td width="80" bgcolor="#000000"><strong>TELEFONE</strong></td>
    <td width="194" bgcolor="#000000"><strong>RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td bgcolor="#000000"><span id="sprytextfield2">
      <input name="nome" type="text" id="textfield" size="40" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['nome'];
			}
	
	?>
    "/>
    </span></td>
    <td bgcolor="#000000"><label for="textfield2"></label>
      <span id="sprytextfield3">
      <input name="cpf" type="text" id="textfield2" size="20" value="<? echo $_GET['cliente']; ?>" />
      </span></td>
    <td bgcolor="#000000"><label for="textfield6"></label>
      <span id="sprytextfield81sd5f1">
      <input name="telefone" type="text" id="textfield6" size="15" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['celular_1'];
			}
	
	?>" />
      </span></td>
    <td bgcolor="#000000"><label for="textfield3"></label>
      <input name="recebimento" disabled="disabled" type="text" id="textfield3" size="20" value="<? echo $_GET['form_pgt']; ?>">
     </td>
    </tr>
  <tr>
    <td bgcolor="#000000"><strong>BANCO</strong></td>
    <td bgcolor="#000000"><strong>TIPO CONTA</strong></td>
    <td bgcolor="#000000"><strong>AGÊNCIA</strong></td>
    <td bgcolor="#000000"><strong>N&Uacute;MERO DA CONTA</strong></td>
    </tr>
  <tr>
    <td bgcolor="#000000">
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
   <td bgcolor="#000000">
    <select name="tipo_conta" size="1" id="tipo_conta">
      <option value=""></option>    
      <option value="CORRENTE">CORRENTE</option>
      <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
    </select></td>
    <td bgcolor="#000000"><input name="agencia" type="text" id="agencia" size="5" maxlength="4" /></td>
    <td bgcolor="#000000"><input name="numero_conta" type="text" id="numero_conta" size="6" /></td>
  </tr>
   <tr>
     <td colspan="4" align="center" bgcolor="#000000"><hr style="border:1px solid #111;" />
       <strong>DIGITE SUA SENHA PARA CONFIRMAR A TRANSA&Ccedil;&Atilde;O<br />
       <input style="border:1px solid #333;" name="cpf_fiador" type="password" id="cpf_fiador" size="10" maxlength="6" autofocus />
       </strong>       <label for="cpf_fiador"></label></td>
   </tr>
   <tr>
     <td colspan="4" bgcolor="#000000"><input type="submit" name="button2" id="button2" value="CONFIRMAR" /></td>
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