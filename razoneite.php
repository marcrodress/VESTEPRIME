<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/razoneite.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:5px;"><strong>CRÉDITO E DÉBITO</strong></h1>
<hr />
<? if(isset($_POST['button'])){
	
$tipo = $_POST['tipo'];
$data_op = $_POST['data_op'];
$descricao = $_POST['descricao'];
$valor = $_POST['valor'];
$forma_pagt = $_POST['forma_pagt'];
$especificacao = $_POST['especificacao'];

if($forma_pagt == ''){
	echo "<script language='javascript'>window.alert('É NECESSÁRIO INFORMAR A FORMA DE PAGAMENTO!');</script>";
}else{
	
	mysqli_query($conexao_bd, "INSERT INTO razoneite (origem, ip, dia, mes, ano, data, data_completa, operador, tipo, data_operacao, descricao, valor, form_pagt, especificacao) VALUES ('RAZONEITE', '$ip', '$mes', '$ano', '$data', '$data_completa', '$operador', '$tipo', '$data_op', '$descricao', '$valor', '$forma_pagt', '$especificacao')");
	
	echo "<script language='javascript'>window.alert('INFORMAÇÃO CADASTRADA!');window.location='';</script>";
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td width="90" bgcolor="#00CCCC"><strong>TIPO</strong></td>
    <td width="90" bgcolor="#00CCCC"><strong>DATA</strong></td>
    <td width="352" bgcolor="#00CCCC"><strong>DESCRIÇÃO</strong></td>
    <td width="95" bgcolor="#00CCCC"><strong>VALOR</strong></td>
    <td width="124" bgcolor="#00CCCC"><strong>FORM. PAG.</strong></td>
    <td width="157" bgcolor="#00CCCC"><strong>ESPECIFICICAÇÃO</strong></td>
    <td width="52" bgcolor="#00CCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="tipo"></label>
      <select name="tipo" size="1" id="tipo">
        <option value="CREDITO">CREDITO</option>
        <option value="DEBITO">DEBITO</option>
    </select></td>
    <td><label for="data_op"></label>
    <input name="data_op" type="text" id="data_op" value="<? echo date("d/m/Y"); ?>" size="10"></td>
    <td><label for="descricao"></label>
    <input name="descricao" type="text" id="descricao" size="50"></td>
    <td><label for="valor"></label>
    <input name="valor" type="text" id="valor" size="7"></td>
    <td><select name="forma_pagt" size="1" id="forma_pagt">
      <option value="Dinheiro">Dinheiro</option>
      <option value=""></option>
      <option>CARTÃO DE CRÉDITO</option>
      <option value="Ourocard Elo Empresarial">Ourocard Elo Empresarial</option>
      <option value="Ourocard Visa Platinum">Ourocard Visa Platinum</option>
      <option value=""></option>
      <option>CARTÃO DE DÉBITO</option>
      <option value="Ourocard Elo Empresarial">Ourocard Elo Empresarial</option>
      <option value="Ourocard Visa Platinum">Ourocard Visa Platinum</option>
      <option value=""></option>
      <option value="">CHEQUE</option>
      <option value="Cheque BB Empresarial">Cheque BB Empresarial</option>
      <option value="Cheque BB Fisica">Cheque BB Fisica</option>
    </select></td>
    <td><label for="especificacao"></label>
      <select style="width:147px;" name="especificacao" size="1" id="especificacao">
        <option value="PAGAMENTO DE FORNECEDORES">PAGAMENTO DE FORNECEDORES</option>
        <option value="DOAÇÃO">DOAÇÃO</option>
        <option value="CUSTOS DE MANUTENÇÃO">CUSTOS DE MANUTENÇÃO</option>
        <option value="PRESTAÇÃO">PRESTAÇÃO</option>
        <option value="OUTROS">OUTROS</option>
    </select></td>
    <td><input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table
</form>
<hr />

</div><!-- box_pagamento_1 -->
</body>
</html>
