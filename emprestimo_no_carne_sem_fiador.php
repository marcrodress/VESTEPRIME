<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_no_carne_sem_fiador.css" rel="stylesheet" type="text/css" />
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
		$verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cpf_cliente'");
		 if(mysqli_num_rows($verifica_limite) == ''){
			echo "<script language='javascript'>window.alert('CLIENTE INFORMADO NÃO POSSUI LIMITE DE CRÉDITO PARA CONTRATAÇÃO!');window.location='carrinho.php';</script>";
		 }else{
			 while($res_limite = mysqli_fetch_array($verifica_limite)){
				 $limite_credito = $res_limite['limite'];
				 $taxa_juros = $res_limite['juros'];
			}

   }
  }
 }

?>

<? if(isset($_POST['enviar'])){
	
$valor = $_POST['valor'];
$recebimento = $_POST['recebimento'];

if($valor == ''){
	echo "<script language='javascript'>window.alert('Digite um valor para simular!');</script>";
}elseif($valor>$limite_credito){
	echo "<script language='javascript'>window.alert('O valor máximo que pode ser simulado é $limite_credito');</script>";
}else{
	echo "<script language='javascript'>window.location='?p=1&valor=$valor&recebimento=$recebimento';</script>";
 }
}?>
<? if($_GET['p'] == '1' || $_GET['p'] == ''){ ?>
<div id="box_pagamento_1">

<hr />
<h1><strong>Simula&ccedil;&atilde;o de cr&eacute;dito sem fiador</strong></h1><hr />
<h2 style="font:12px Arial, Helvetica, sans-serif; color:#0FC; margin:10px;"><strong>LIMITE DISPONÍVEL:</strong> R$ <? echo number_format($limite_credito,2, ',', '.'); ?></h2>
<hr />
<form method="post" name="" action="" enctype="multipart/form-data">
 <input type="text" name="valor" size="72" />
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
  <? for($i=4; $i<=36; $i++){ ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td width="53"><input class="input3" type="radio" name="parcela" id="radio" value="<? echo $i; ?>"></td>
    <td width="200"><?
	$simulacao = ((((($taxa_juros)/100)*$valor)*$i)+$valor)/$i;
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

$sql_verifica_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE cliente = '$cliente' AND status = 'AGUARDA'");
if(mysqli_num_rows($sql_verifica_emprestimo) >1){
echo "<script language='javascript'>window.alert('CLIENTE AINDA POSSUI UM EMPRÉSTIMO ATIVO QUE AINDA NÃO FOI QUITADO! É NECESSÁRIO EFETUAR O PAGAMENTO DA PENÚLTIMA PARCELA PARA SOLICITAR UM NOVO EMPRÉSTIMO!');</script>";
}else{
echo "<script language='javascript'>window.location='?p=2&valor=$valor&recebimento=$recebimento&parcela=$parcela&taxa_juros=$taxa_juros';</script>";
}

}?>

<? } // fecha o P1 ?>

</div><!-- box_pagamento_1 -->




<? if($_GET['p'] == '2'){ ?>
<div id="box_pagamento_2">
<h1><strong>Confirme a forma de recebimento</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<select class="select" name="form_pgt" size="1">
  <option value="TED">TED</option>
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
$vencimento = $_POST['vencimento'];

$n_proposta = rand();

$i = $_GET['parcela'];
$parcela = $_GET['parcela'];
$taxa_juros = $_GET['taxa_juros'];
	
$simulacao = number_format((((($taxa_juros/100)*$valor)*$i)+$valor)/$i,2);
$valor_total = number_format($simulacao*$i,2, ',', '.');

if($form_pgt == 'TED' && $agencia == '' && $numero_conta == ''){
	echo "<script language='javascript'>window.alert('INFORME TODOS OS DADOS PARA EMISSÃO DO DOC/TED!');</script>";
}else{
	
  $sql_insert = mysqli_query($conexao_bd, "INSERT INTO emprestimo_boleto (n_proposta, data, data_completa, dia, mes, ano, ip, operador, status, forma_pagamento, valor, juros, recebimento, quant_parcela, valor_parcela, valor_total, cpf, nome, telefone, banco, tipo_conta, agencia, conta, tarifa, lucro, vencimento, cpf_fi, contrato, sit_liberacao) VALUES ('$n_proposta', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'Aguarda', '$form_pgt', '$valor', '$taxa_juros', '$recebimento', '$parcela', '$simulacao', '$valor_total', '$cpf', '$nome', '$telefone', '$banco', '$tipo_conta', '$agencia', '$numero_conta', '$tarifa', '', '$vencimento', '$cpf_fi', '', 'AGUARDA')");
  
  
  if($sql_insert == ''){
	echo "<script language='javascript'>window.alert('OCORREU UM ERRO AO ENVIAR PROPOSTA, TENTE NOVAMENTE!');</script>";  
  }else{
	
		$score = 0;
		$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
		 while($res_score = mysqli_fetch_array($sql_score)){
			 $score = $res_score['score'];
		 }
		  
		   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'DEBITO', '$data', '$dia', '$mes', '$ano', '$cpf', 'EMPRESTIMO NO BOLETO', '300')");
		 
		  $score = $score-300;
		   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cpf'");	
	  
   for($i=1; $i<=$parcela; $i++){
	   mysqli_query($conexao_bd, "INSERT INTO boletos_emprestimo_boleto (cliente, proposta, parcela, codigo_barras, localizador, vencimento, valor, status, data_pagamento) VALUES ('$cpf', '$n_proposta', '$i', '', '', '', '$simulacao', 'AGUARDA', '')");
   }
	  
	echo "<script language='javascript'>window.alert('PROPOSTA ENVIADA COM SUCESSO, AGUARDE O RESULTADO DA ANALISE DE CRÉDITO!');window.location='resultado_emprestimo_carne.php'</script>";  	 
   }
  }
}
?>



<h1><strong>CONFIRME A CONTRATAÇÃO DO CR&Eacute;DITO PESSOAL</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <? 
	$valor = $_GET['valor'];
	$i = $_GET['parcela'];
	$parcela = $_GET['parcela'];
	$taxa_juros = $_GET['taxa_juros'];
	
    $simulacao = ((((($taxa_juros)/100)*$valor)*$i)+$valor)/$i;

  ?>
    <td colspan="4"><strong>FOI SOLICITADO R$ <? echo number_format($valor, 2, ',', '.'); ?> PARCELADO EM <? echo $parcela;  ?> X <? echo number_format($simulacao, 2, ',', '.'); ?> </strong></td>
  </tr>
  <tr>
    <td width="180" bgcolor="#333333"><strong>NOME</strong></td>
    <td width="79" bgcolor="#333333"><strong>CPF</strong></td>
    <td width="80" bgcolor="#333333"><strong>TELEFONE</strong></td>
    <td width="194" bgcolor="#333333"><strong>RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield2">
      <input name="nome" type="text" id="textfield" size="40" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['nome'];
			}
	
	?>
    "/>
    </span></td>
    <td><label for="textfield2"></label>
      <span id="sprytextfield3">
      <input name="cpf" type="text" id="textfield2" size="20" value="<? echo $_GET['cliente']; ?>" />
      </span></td>
    <td><label for="textfield6"></label>
      <span id="sprytextfield81sd5f1">
      <input name="telefone" type="text" id="textfield6" size="15" value="<? 
	
	$sql_busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cliente']."'");
		while($res_busca_cliente = mysqli_fetch_array($sql_busca_cliente)){
				echo $res_busca_cliente['celular_1'];
			}
	
	?>" />
      </span></td>
    <td><label for="textfield3"></label>
      <input name="recebimento" disabled="disabled" type="text" id="textfield3" size="20" value="<? echo $_GET['form_pgt']; ?>">
     </td>
    </tr>
  <tr>
    <td bgcolor="#333333"><strong>BANCO</strong></td>
    <td bgcolor="#333333"><strong>TIPO CONTA</strong></td>
    <td bgcolor="#333333"><strong>AGÊNCIA</strong></td>
    <td bgcolor="#333333"><strong>N&Uacute;MERO DA CONTA</strong></td>
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
    <td><input name="agencia" type="text" id="agencia" size="5" maxlength="4" /></td>
    <td><input name="numero_conta" type="text" id="numero_conta" size="6" /></td>
  </tr>
   <tr>
     <td colspan="4" align="center" bgcolor="#333333"><strong>Vencimento das parcelas</strong><br /><select name="vencimento" size="1">
       <option value="1">1</option>
       <option value="3">3</option>
       <option value="5">5</option>
       <option value="8">8</option>
       <option value="10">10</option>
       <option value="12">12</option>
       <option value="15">15</option>
       <option value="18">18</option>
       <option value="20">20</option>
       <option value="22">22</option>
       <option value="25">25</option>
       <option value="28">28</option>
     </select></td>
   </tr>
   <tr>
     <td colspan="4"><input style="border:1px solid #CCC;" type="submit" name="button2" id="button2" value="CONFIRMAR" /></td>
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