<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>RIFA ONLINE</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<? require "../config.php"; ?>

<style type="text/css">
body table{
	border:1px solid #000;
	padding:10px;
	text-align:center;
	border-radius:5px;
	background:#099;
}
body .table{
	border:1px solid #000;
	padding:1px;
	text-align:center;
	border-radius:5px;
	background:#099;
	text-transform:uppercase;
}
body .table td{
	border:1px solid #000;
	padding:2px;
	background:#FFF;
	font:12px Arial, Helvetica, sans-serif;
	border-radius:5px;
}
body td{
	border:1px solid #000;
	padding:10px;
	background:#FFF;
	font:12px Arial, Helvetica, sans-serif;
	border-radius:5px;
}
body td input{
	border:1px solid #000;
	padding:10px;
	background:#FFF;
	font:12px Arial, Helvetica, sans-serif;
	border-radius:5px;
	width:auto;
}
body td select{
	border:1px solid #000;
	padding:10px;
	background:#FFF;
	font:12px Arial, Helvetica, sans-serif;
	border-radius:5px;
	width:auto;
}
</style>
</head>

<body>
<script type="text/javascript">
    window.onbeforeunload = function() {
       
    }
</script>
<script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82) e.preventDefault(); };

$(document).ready(function(){
     $(document).on("keydown", disableF5);
});
</script>

<?

$code_carrinho = 0; $carrinho_cliente = 0; $nome_cliente = NULL; $telefone_cliente = NULL; $cpf_cliente = NULL;
$puxa_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
if(mysqli_num_rows($puxa_carrinho) == ''){
 }else{
	while($res_carrinho = mysqli_fetch_array($puxa_carrinho)){
		$cliente = $res_carrinho['cliente'];
		$carrinho_cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];
		
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
		  while($res_cliente = mysqli_fetch_array($sql_cliente)){
			  $nome_cliente = $res_cliente['nome'];
			  $telefone_cliente = $res_cliente['celular_1'];
			  $cpf_cliente = $cliente;
		  }
		
  }
}
?>

<? if(@$_GET['p'] == ''){ ?>
<? if(isset($_POST['button'])){
	
$nome_completo = base64_encode($_POST['nome_completo']);
$telefone = base64_encode($_POST['telefone']);
$n_cupom = base64_encode($_POST['n_cupom']);
$cpf = base64_encode($_POST['cpf']);
$id_promocao = $_GET['id'];

echo "<script language='javascript'>window.location='?id=$id_promocao&nome=$nome_completo&telefone=$telefone&n_cupom=$n_cupom&cpf=$cpf&p=2';</script>";

}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<table width="300" border="1">
  <tr>
    <td width="166"><strong><span id="sprytextfield1"><span id="sprytextfield4">
      <input name="nome_completo" type="text" id="nome_completo" value="<? echo $nome_cliente; ?>" size="40" />
    </span><span class="textfieldRequiredMsg">A</span></span></strong></td>
  </tr>
  <tr>
    <td><span id="sprytextfield2">
    <input name="telefone" type="text" id="telefone" size="40" value="<? echo $telefone_cliente; ?>"/>
    <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
  </tr>
  <tr>
    <td><strong>N&deg; cupons</strong>      <select name="n_cupom" size="1" id="n_cupom">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select></td>
  </tr>
  <tr>
    <td><span id="sprytextfield3">
    <input name="cpf" type="text" id="cpf" size="40" value="<? echo $cpf_cliente; ?>" />
</span></td>
  </tr>
  <tr>
    <td><input type="submit" name="button" id="button" value="Avan&ccedil;ar" /></td>
  </tr>
</table>
</form>
<? } ?>



<? if(@$_GET['p'] == '2'){ $total_cupons = base64_decode($_GET['n_cupom']);

$valor_cupom = 0;


$sql_valor_cupom = mysqli_query($conexao_bd, "SELECT * FROM rifas WHERE id = '".$_GET['id']."'");
 while($res_valor = mysqli_fetch_array($sql_valor_cupom)){
	$valor_cupom = $res_valor['valor'];
}

$valor_total = ($valor_cupom*$total_cupons);

?>
<h3 style="font:13px Arial, Helvetica, sans-serif;"><strong>Formas de pagamento</strong></h3>
<form name="" method="post" action="" enctype="multipart/form-data">
<select style="padding:10px; font:12px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #CCC;" name="forma_pagamento" size="1">
  <option value="DINHEIRO">DINHEIRO</option>
  <option value="PIX/TRANSFERENCIA">PIX/TRANSFERENCIA</option>
  <option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
  <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
  <option value="VESTE PRIME CARD">VESTE PRIME CARD</option>
</select>
<input name="valor" type="text" disabled="disabled" id="valor" style="padding:10px; text-align:center; font:12px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #CCC;" value="R$ <? echo number_format($valor_total,2,',','.'); ?>" size="5" />
<input name="enviar" style="padding:10px; cursor:pointer; text-align:center; font:12px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #CCC;" type="submit" id="enviar" value="Emitir" />
</form>

<? if(isset($_POST['enviar'])){

$forma_pagamento = $_POST['forma_pagamento'];


		$id_promocao = $_GET['id'];
		$nome_completo = $_GET['nome'];
		$telefone = $_GET['telefone'];
		$n_cupom = $_GET['n_cupom'];
		$cpf = $_GET['cpf'];


if($forma_pagamento == 'VESTE PRIME CARD'){
	
  $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente !=''");
  if(mysqli_num_rows($sql_carrinho) <=0){
	  echo "<script language='javascript'>window.alert('Primeiro é necessário entrar no cadastro do cliente!');</script>";
  }else{
  	while($res_cliente = mysqli_fetch_array($sql_carrinho)){
	  $cpf_cliente = $res_cliente['cliente'];
	  
	  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente' AND status = 'ATIVO'");
	  if(mysqli_num_rows($sql_carrinho) <=0){
		  echo "<script language='javascript'>window.alert('Situação do cliente não permite fazer transações no VP CARD!');</script>";
	  }else{
		  $code = rand()+($dia*$mes)+$dia+$mes+$ano;
		  
		  mysqli_query($conexao_bd, "INSERT INTO lancamento_fatura (code_transacao, status, data, data_completa, dia, mes, ano, descricao, valor, parcelado, quant_parcela, valor_parcela, cliente, code_carrinho, comprovante, operador) VALUES ('$code', 'Ativo', '$data', '$data_completa', '$dia', '$mes', '$ano', 'RIFAS', '$valor_total', '', '1', '$valor_total', '$cpf_cliente', '$code', '', '$operador')");
		  
		  
		  mysqli_query($conexao_bd, "INSERT INTO compras_parceladas (code_transacao, ip, status, data_compra, data_completa, estabelecimento, parcela, n_parcela, total_parcela, valor_parcela, sit_pag_fatura) VALUES ('$code', '$ip', 'Aguarda', '$data', '$data_completa', 'VESTE PRIME', '1/1', '1', '1', '$valor_total', '$cpf_cliente')");



		echo "<script language='javascript'>window.location='?id=$id_promocao&nome=$nome_completo&telefone=$telefone&n_cupom=$n_cupom&cpf=$cpf&p=3&forma_pagamento=$forma_pagamento';</script>";

		  
	  }
	}
  }
	
}

		echo "<script language='javascript'>window.location='?id=$id_promocao&nome=$nome_completo&telefone=$telefone&n_cupom=$n_cupom&cpf=$cpf&p=3&forma_pagamento=$forma_pagamento';</script>";


}?>


<? } ?>




<? if(@$_GET['p'] == '3'){ 

$nome = base64_decode($_GET['nome']);
$telefone = base64_decode($_GET['telefone']);
$n_cupom = base64_decode($_GET['n_cupom']);
$cpf = base64_decode($_GET['cpf']);
$forma_pagamento = $_GET['forma_pagamento'];
$id_promocao = $_GET['id'];

$titulo = 0;
$imagem = 0;
$inicio = 0;
$fim = 0;
$valor_bilhete = 0;

$sql_rifa = mysqli_query($conexao_bd, "SELECT * FROM rifas WHERE id = '$id_promocao'");
while($res_sorteio = mysqli_fetch_array($sql_rifa)){
	
	$titulo = $res_sorteio['titulo'];
	$imagem = $res_sorteio['imagem'];
	$inicio = $res_sorteio['inicio'];
	$fim = $res_sorteio['fim'];
	$valor_bilhete = $res_sorteio['valor'];
	
}

?>

<? for($i=0; $i<$n_cupom; $i++){ 

$numero_sorte = rand()+date("s");

mysqli_query($conexao_bd, "INSERT INTO rifas_cupons (data, data_completa, dia, mes, ano, operador, id_promocao, code_cupom, status, nome_completo, telefone, cpf, valor, forma_pagamento) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$id_promocao', '$numero_sorte', 'Ativo', '$nome', '$telefone', '$cpf', '$valor_bilhete', '$forma_pagamento')");

?>

<table class="table" width="300" border="1" style="page-break-before: always;">
  <tr>
    <td colspan="2"><img style="margin:-10px 0 -30px 0;" src="http://ikuly.com/caixa/img/index.png" width="226" height="111"><br>
      <h2>BILHETE DE RIFA<br />
      <?  echo date("d/m/Y H:i:s");?>
    </h2></td>
  </tr>
  <tr>
    <td colspan="2"><strong> VESTE PRIME</strong><br />
cnpj: 32.450.862/0001-02 <br />
RUA. capit&atilde;o in&aacute;cio prata - 2010 - Taiba <br />
s&atilde;o gon&ccedil;alo do amarante - cear&aacute; <br />
<strong>cep: </strong>62670-000 <br />
<strong>telefone: </strong>(85) 99158.7323</td>
  </tr>
  <tr>
    <td colspan="2"><h1 style="margin:0; padding:0;"><strong>NÚMERO DA SORTE</strong><br /><? echo $numero_sorte; ?></h1></td>
  </tr>
  <tr>
    <td colspan="2"><h2 style="margin:0; padding:0;"><? echo $titulo; ?><br><img src="<? echo $imagem ?>" width="100" height="100"></h2></td>
  </tr>
  <tr>
    <td width="140"><strong>ÍNICIO</strong></td>
    <td width="144"><strong>SORTEIO</strong></td>
  </tr>
  <tr>
    <td><? echo $inicio; ?></td>
    <td><? echo $fim; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>VALOR DO BILHETE: R$ <? echo number_format($valor_bilhete,2,',','.'); ?></strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>CLIENTE:</strong> <? echo $nome; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>TELEFONE:</strong> <? echo $telefone; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>CÓDIGO DE AUTENTICAÇÃO</strong><br /><? echo md5(rand()); ?></td>
  </tr>
  <tr>
    <td colspan="2">*Este bilhete é o único comprovante de sua participação e será necessário apresenta-lo em caso de resgate de prêmio.</td>
  </tr>
</table>
<br /><br />
<? } ?>
<script language="javascript">window.print();</script>





<? } ?>



<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, hint:"Digite o telefone"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"00000000000", hint:"Digite o CPF", useCharacterMasking:true, isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {hint:"Digite o nome completo"});
</script>
</body>
</html>