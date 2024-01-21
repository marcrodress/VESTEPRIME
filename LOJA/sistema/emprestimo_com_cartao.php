<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_com_cartao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="emprestimo_com_cartao">
 <h1>Contratação de empréstimo no cartão de empréstimo<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1"><span id="sprytextfield3">
   <input class="input_intro" type="text" name="cpf" />
   </span><span id="sprytextfield2">
   <input class="input_intro" type="text" name="valor" />
   </span></span>
   <input class="input" type="submit" name="send" value="AVAN&Ccedil;AR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$cpf = $_POST['cpf'];
$taxa_juro = 6.5;

$sql_cpf = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
if(@mysql_num_rows($sql_cpf) == ''){
	echo "<script language='javascript'>window.location='?pack=CL1';window.alert('Este CPF não está cadastrado, clique em OK para fazer o cadastro deste cliente!');</script>";
}else{

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 12");
?>
<table width="1175" border="0">
  <tr>
    <td width="20">&nbsp;</td>
    <td width="96"><strong>Valor solicitado:</strong></td>
    <td width="75"><strong>Parcelas:</strong></td>
    <td width="120"><strong>Valor da parcela:</strong></td>
    <td width="148"><strong>Taxa administrativa:</strong></td>
    <td width="155"><strong>Taxa de parcelamento</strong></td>
    <td width="111"><strong>Taxa de juros:</strong></td>
    <td width="121"><strong>Despesas extras:</strong></td>
    <td width="150"><strong>Valor total da parcela:</strong></td>
    <td width="135"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){
$mes = $res_sql['mes'];	
?>  
<form name="" method="post" action="?pack=CBTS" enctype="multipart/form-data">  
     <input type="hidden" name="cpf" value="<? echo $cpf; ?>" />
 <tr>
    <td colspan="10"><hr /></td>
    </tr>
  <tr>
    <td width="20"><input class="input2" type="radio" name="q_parcelas" id="radio" value="<? echo $mes; ?>" /></td>
    <td>R$ <? echo number_format($valor,2,",","."); ?> 
    <input type="hidden" name="valor_emprestimo" value="<? echo $valor; ?>" />  
	</td>
    <td><? echo $mes; ?></td>
    <td>R$ <? $parcela1 = $valor/$mes;; echo number_format($parcela1,2,",","."); ?></td>
    <td><? echo $taxa_adm = "17"; ?>% - R$
    <? $parcela2 = ($valor*$taxa_adm)/100; echo number_format($parcela2,2,",","."); ?>
    <input type="hidden" name="taxa_adm" value="<? echo $parcela2; ?>" />      
    </td>
    <td><? echo $juro_mes = $mes/2; ?>% - R$
      <? $parcela3 = ($valor*$juro_mes)/100; echo number_format($parcela3,2,",","."); ?>
    <input type="hidden" name="taxa_pacelamento" value="<? echo $parcela3; ?>" />        
      </td>
    <td><? echo $taxa_juro; ?>% - R$ <? $parcela4 = ($valor*$taxa_juro)/100; echo number_format($parcela4,2,",","."); ?>
    <input type="hidden" name="taxas_de_juro" value="<? echo $parcela4; ?>" />    
    </td>
    <td>R$ <? $parcela5 = ($valor*$juro_mes/100)+($valor*$taxa_juro/100); echo number_format($parcela5,2,",","."); ?>
    <input type="hidden" name="despesas" value="<? echo $parcela5; ?>" />      
    </td>
    <td>R$ <? $parcela6 = ($valor+$parcela2+$parcela3+$parcela4+$parcela5)/$mes; echo number_format($parcela6,2,",","."); ?>
    <input type="hidden" name="valor_das_parcelas" value="<? echo $parcela6; ?>" />      
    </td>
    <td>R$ <? $valor_total = $parcela6*$mes; echo number_format($valor_total,2,",","."); ?>
    <input type="hidden" name="valor_total" value="<? echo $valor_total; ?>" /></td>
  </tr>
  <tr>
<? } ?>
    <td colspan="10"><input class="input3" type="submit" name="button" id="button" value="Confirmar" /></td>
    </tr>
</form>
</table>
<? }}?>
</div><!-- emprestimo_com_cartao -->
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {hint:"Digite o valor do empr\xE9stimo"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "social_security_number", {hint:"Digite o CPF do cliente", format:"ssn_custom", pattern:"000.000.000-00", useCharacterMasking:true});
</script>
</body>
</html>