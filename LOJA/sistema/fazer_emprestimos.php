<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_emprestimos.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<? if(@$_GET['tipo'] == 'carteira_assinada'){ ?>
<div id="box_cadastro_de_cliente">
 <h1><strong>Formulário de preenchimento de empréstimo</strong><hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="cpf" value="<? echo @$cpf_cliente; ?>" />
   </span><span id="sprytextfield2">
   <input name="valor" type="text" id="valor" />
   </span>
   <input class="input" type="submit" name="send" value="VALIDAR" />
 </form>

<? if(isset($_POST['send'])){

$cpf = $_POST['cpf'];
$valor = $_POST['valor'];

$sql = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
 if(mysql_num_rows($sql) == ''){
	 echo "<script language='javascript'>window.alert('Este CPF não está cadastrado!');</script>";
 }else{
	 while($res_1 = mysql_fetch_array($sql)){

require "dados/dados_clientes.php";

}}}?>
</div><!-- box_cadastro_de_cliente -->
<? } ?>

<? if(@$_GET['tipo'] == 'analise_de_proposta'){ ?>
<div id="box_analises_de_propostass">
 <h1><strong>Resultados das análises da propósta de empréstimo</strong><hr /></h1>
<?
$sql_1 = mysql_query("SELECT * FROM envio_de_propostas WHERE status = 'Em análise' AND tipo_de_proposta = 'Empréstimo' AND tipo_de_emprestimo != 'Empréstimo com cartão' LIMIT 20");
$conta_sql_1 = mysql_num_rows($sql_1);
if($conta_sql_1 == ''){
	echo "<h2>No momento não existe nenhuma propósta para ser analisada!</h2>";
}else{
?>
<table width="1180" border="0">
  <tr>
    <td colspan="9"><h2><strong>Propostas pedentes de resultado:</strong></h2></td>
  </tr>
   <tr>
    <td colspan="9"><hr /></td>
  </tr>
  <tr>
    <td width="1">&nbsp;</td>
    <td width="110"><strong>Nª da propósta:</strong></td>
    <td width="109"><strong>CPF do Cliente:</strong></td>
    <td width="160"><strong>Data de preenchimento:</strong></td>
    <td width="127"><strong>Empresa enviada:</strong></td>
    <td width="240"><strong>Documentos</strong></td>
    <td width="143"><strong>Resultado:</strong></td>
    <td width="188"><strong> Observa&ccedil;&atilde;o:</strong></td>
    <td width="98">&nbsp;</td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
  <tr>
    <td>&nbsp;</td>
    <td><? echo $res_1['n_proposta']; ?></td>
    <td><? echo $cpf = $res_1['cpf']; ?></td>
    <td><? echo $res_1['date']; ?></td>
    <td>
	<? echo $res_1['empresa_de_envio'];?>
    </td>
    <td>
     <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=CPF" target="_blank">CPF</a> | <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=RG" target="_blank">RG</a> | <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=Comprovante de endereço" target="_blank">Resid&ecirc;ncia</a><a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=Comprovante de renda" target="_blank">Renda</a> | <a href="scripts/conversao_pedido_de_emprestimo_pdf.php?cpf=<? echo $res_1['cpf']; ?>&proposta=<? echo $res_1['n_proposta']; ?>" target="_blank">Prop&oacute;sta</a></td>
<form name="" method="post" action="scripts/confirma_analise_de_proposta_emprestimo.php" enctype="multipart/form-data">
    <td>
      <select name="status" size="1">
        <option value="Aprovado">Aprovado</option>
        <option value="Negada">Negada</option>
        <option value="Cancelada">Cancelada</option>
      </select></td>
<input type="hidden" name="n_proposta" value="<? echo $res_1['n_proposta']; ?>" />
<input type="hidden" name="id" value="<? echo $res_1['id']; ?>" />
    <td><input class="input" name="obs" type="text" size="30" /></td>
    <td width="98"><input class="input2" type="submit" name="button"value="Enviar" /></td>
</form>
  </tr>
  <tr>
   <td colspan="2"><strong>Valor solicitado:</strong></td>
   <td colspan="2"><strong>Quantidade de parcelas:</strong> <? if($res_1['status'] == 'Em análise'){ ?> | <a rel="superbox[iframe][200x100]" href="emprestimos/alterar_parcelas.php?proposta=<? echo $res_1['n_proposta']; ?>">Alterar pacelas</a> <? } ?></td>
   <td colspan="2"><strong>Valor das parcelas:</strong> <? if($res_1['status'] == 'Em análise'){ ?>  | <a rel="superbox[iframe][200x100]" href="emprestimos/alterar_valor_parcelas.php?proposta=<? echo $res_1['n_proposta']; ?>">Alterar o valor das pacelas</a> <? } ?></td>
   <td><strong>Tipo de empr&eacute;stimo:</strong></td>
   <td><strong>Financeira:</strong></td>
   <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
  <tr>
    <td colspan="2"><? echo $res_1['valor_solicitado']; ?></td>
    <td colspan="2"><? echo $res_1['quantidade_parcelas']; ?></td>
    <td colspan="2"><? echo $res_1['valor_parcelas']; ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
   <td colspan="9"><hr /></td>
  </tr>
<? } ?>
</table>
</form>
<? } ?>
</div><!-- box_analises_de_propostass -->
<? } ?>







<? if(@$_GET['tipo'] == 'analise_de_proposta_cartao'){ ?>
<div id="box_analises_de_propostass">
 <h1><strong>Resultados das análises da propósta de empréstimo com cartão de crédito</strong><hr /></h1>
<?
$sql_1 = mysql_query("SELECT * FROM envio_de_propostas WHERE status = 'Em análise' AND tipo_de_proposta = 'Empréstimo' AND tipo_de_emprestimo = 'Empréstimo com cartão' LIMIT 20");
$conta_sql_1 = mysql_num_rows($sql_1);
if($conta_sql_1 == ''){
	echo "<h2>No momento não existe nenhuma propósta para ser analisada!</h2>";
}else{
?>
<table width="1180" border="0">
  <tr>
    <td colspan="10"><h2><strong>Propostas pedentes de resultado:</strong></h2></td>
  </tr>
   <tr>
    <td colspan="10"><hr /></td>
  </tr>
  <tr>
    <td width="1">&nbsp;</td>
    <td width="126"><strong>Nª da propósta:</strong></td>
    <td width="106"><strong>CPF:</strong></td>
    <td width="145"><strong>Data:</strong></td>
    <td width="129"><strong>Empresa enviada:</strong></td>
    <td width="114"><strong>Valor solicitado:</strong></td>
    <td width="122"><strong>Valor da parcela:</strong></td>
    <td width="112"><strong>Resultado:</strong></td>
    <td colspan="2"><strong> Observa&ccedil;&atilde;o:</strong></td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
    <form name="" method="post" action="scripts/confirma_analise_de_proposta_emprestimo_cartao.php" enctype="multipart/form-data">
  <tr>
    <td>&nbsp;</td>
    <td><? echo $res_1['n_proposta']; ?></td>
    <td><? echo $cpf = $res_1['cpf']; ?></td>
    <td><? echo $res_1['date']; ?></td>
    <td><? echo $res_1['empresa_de_envio'];?></td>
    <td><? echo $res_1['valor_solicitado']; ?></td>
    <td><? echo @number_format($res_1['valor_parcelas'],2,",","."); ?></td>
    <td>
      <select name="status" size="1">
        <option value="Aprovado">Aprovado</option>
        <option value="Negada">Negada</option>
        <option value="Cancelada">Cancelada</option>
        </select>
    </td>
    <td width="180"><input class="input" name="obs" type="text" size="30" /></td>
    <input type="hidden" name="n_proposta" value="<? echo $res_1['n_proposta']; ?>" />
    <input type="hidden" name="id" value="<? echo $res_1['id']; ?>" />    
    <td width="103" colspan="10"><input class="input2" type="submit" name="button"value="Enviar" /></td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><a target="_blank" rel="superbox[iframe][1000x1550]" href="scripts/imprimir_contrato.php?n_proposta=<? echo @$res_1['n_proposta']; ?>&cpf=<? echo $cpf = @$res_1['cpf']; ?>">Imprimir contrato</a></td>
  </tr>
  <tr>
    <td colspan="11"><hr /></td>
  </tr>
    </form>
  <? } ?>
</table>
</form>
<? } ?>
</div><!-- box_analises_de_propostass -->
<? } ?>








<? if(@$_GET['tipo'] == 'confirmacao_de_credito'){ ?>
<div id="box_analises_de_propostass">
 <h1><strong>Confirmar e guardar o comprovante de crédito em conta bancaria referente ao empréstimo com cartão</strong><hr /></h1>
<?
$sql_1 = mysql_query("SELECT * FROM envio_de_propostas WHERE status = 'Aprovado' AND tipo_de_proposta = 'Empréstimo' AND tipo_de_emprestimo = 'Empréstimo com cartão' LIMIT 20");
$conta_sql_1 = mysql_num_rows($sql_1);
if($conta_sql_1 == ''){
	echo "<h2>No momento não existe nenhuma propósta para ser analisada!</h2>";
}else{
?>
<table width="1180" border="0">
  <tr>
    <td colspan="10"><h2><strong>Propostas pedentes de resultado:</strong></h2></td>
  </tr>
   <tr>
    <td colspan="10"><hr /></td>
  </tr>
  <tr>
    <td width="1">&nbsp;</td>
    <td width="116"><strong>Nª da propósta:</strong></td>
    <td width="115"><strong>CPF:</strong></td>
    <td width="138"><strong>Data:</strong></td>
    <td width="135"><strong>Valor solicitado:</strong></td>
    <td width="142"><strong>Valor da parcela:</strong></td>
    <td width="225"><strong> Observa&ccedil;&atilde;o:</strong></td>
    <td colspan="3">&nbsp;</td>
  </tr>
<? while($res_1 = mysql_fetch_array($sql_1)){ ?>
    <form name="" method="post" action="scripts/confirma_pagamento_de_emprestimo_com_cartao.php" enctype="multipart/form-data">
  <tr>
    <td>&nbsp;</td>
    <td><? echo $res_1['n_proposta']; ?></td>
    <td><? echo $cpf = $res_1['cpf']; ?></td>
    <td><? echo $res_1['date']; ?></td>
    <td><? echo $res_1['valor_solicitado']; ?></td>
    <td><? echo $res_1['valor_parcelas']; ?></td>
    <td><input type="file" name="comprovante"></td>
    <td colspan="2"><input type="submit" name="button" id="button" value="Enviar"></td>
    <input type="hidden" name="n_proposta" value="<? echo $res_1['n_proposta']; ?>" />
    <input type="hidden" name="id" value="<? echo $res_1['id']; ?>" />    
    <td width="219" colspan="10"><label for="fileField"><a target="_blank" rel="superbox[iframe][980x1500]" href="scripts/imprimir_contrato.php?n_proposta=<? echo @$res_1['n_proposta']; ?>&cpf=<? echo $cpf = @$res_1['cpf']; ?>">Imprimir contrato</a></label></td>
  </tr>
  <tr>
    <td></td>
    <td colspan="9"></td>
    </tr>
  <tr>
    <td colspan="11"><hr /></td>
  </tr>
    </form>
  <? } ?>
</table>
</form>
<? } ?>
</div><!-- box_analises_de_propostass -->
<? } ?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "social_security_number", {hint:"Digite o CPF", useCharacterMasking:true, format:"ssn_custom", pattern:"000.000.000-00"});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>