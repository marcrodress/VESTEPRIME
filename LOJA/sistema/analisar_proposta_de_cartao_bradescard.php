<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/analises_proposta_de_cartao_bradescard.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<div id="box_analises_de_propostass">
 <h1><strong>Resultados das análises da propósta de cartão de crédito</strong><hr /></h1>
<?
$sql_1 = mysql_query("SELECT * FROM envio_de_propostas WHERE status = 'Em análise' AND tipo_de_proposta = 'Cartão' LIMIT 20");
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
    <td width="90"><strong>Nª da propósta:</strong></td>
    <td width="109"><strong>CPF do Cliente:</strong></td>
    <td width="144"><strong>Data de preenchimento:</strong></td>
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
     <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=CPF" target="_blank">CPF</a> | <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=RG" target="_blank">RG</a> | <a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=Comprovante de endereço" target="_blank">Resid&ecirc;ncia</a><a href="dados/mostrar_documentos.php?cpf=<? echo $res_1['cpf']; ?>&tipo=Comprovante de renda" target="_blank">Renda</a> | <a href="scripts/conversao_pedido_de_cartao_pdf.php?cpf=<? echo $res_1['cpf']; ?>&proposta=<? echo $res_1['n_proposta']; ?>" target="_blank">Prop&oacute;sta</a></td>
<form name="" method="post" action="scripts/confirma_analise_de_proposta.php" enctype="multipart/form-data">
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
   <td colspan="9"><hr /></td>
  </tr>
<? } ?>
</table>
</form>
<? } ?>
</div><!-- box_analises_de_propostass -->
</body>
</html>