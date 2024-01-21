<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/efetivar_pagamento.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />

</head>

<body>
<div id="box">
<? require "../config.php"; ?>


<? if(isset($_POST['forma_processamento'])){

if($_GET['banco'] == 'VESTEPRIMECARD'){ require "liberar_pagamento_vesteprime.php"; } 	

$forma_processamento = $_POST['forma_processamento'];
$banco = $_POST['banco'];
$tarifa = $_POST['tarifa'];
$diferenca_cartao = $_POST['diferenca_cartao'];
$comissao = $_POST['comissao'];
$juros_maquina = $_POST['juros_maquina'];
$juros_sistema = $_POST['juros_sistema'];
$comissao = $comissao+($juros_maquina-$juros_sistema)+$diferenca_cartao;
$data_pagamento = $_POST['data_pagamento'];
$observacao = $_POST['observacao'];
$cliente = $_POST['cliente'];
$valor_boleto = $_POST['valor_boleto']+$tarifa;
$operador = $_GET['operador'];

if($juros_sistema >0 && $juros_maquina <=0){
	echo "<script language='javascript'>window.alert('Você deve informar os juros que apareceu na maquina de pagamentos quando foi efetivado');</script>";
}else{


$comprovante_pagamento = $_FILES['comprovante_pagamento']['name'];
$comprovante_pagamento = str_replace(" ", "-", $comprovante_pagamento); $comprovante_pagamento = str_replace(",", "-", $comprovante_pagamento); $comprovante_pagamento = str_replace("ã", "a", $comprovante_pagamento);

if(file_exists("../comprovante_pagamento/$comprovante_pagamento")){ $a = 1;while(file_exists("../comprovante_pagamento/[$a]$comprovante_pagamento")){$a++;}$comprovante_pagamento = "[".$a."]".$comprovante_pagamento;}
(move_uploaded_file($_FILES['comprovante_pagamento']['tmp_name'], "../comprovante_pagamento/".$comprovante_pagamento));

if($comprovante_pagamento == '[1]'){
	$comprovante_pagamento = NULL;
}


mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET operador_efetivado = '$operador', data_efetivado = '$data', forma_processamento = '$forma_processamento', banco_processamento = '$banco', tarifa_processamento = '$tarifa', comissao = '$comissao', data_pagamento = '$data_pagamento', observacao = '$observacao', status = 'Efetivado', juros_maquina = '$juros_maquina', diferenca_cartao = '$diferenca_cartao', comprovante = '$comprovante_pagamento' WHERE id = '".$_GET['id']."'");


echo "Pagamento efetivamento com sucesso!<br><br> Pressione F5 para finalizar a operação";

if($_GET['banco'] == 'CREDIMAIS'){ require "confir_pagamento_emprestimo_carne.php";}

die;

 }
}?>




<?

$sql_verifica_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id']."'");
	while($res_pagamento = mysqli_fetch_array($sql_verifica_pagamento)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="951" border="0">
  <tr>
    <td colspan="8">
        <strong>CÓDIGO DE BARRAS:</strong><br />
	<? 
	
	$code_barras = $res_pagamento['code_barras']; 
	
	for($i=0; $i<strlen($code_barras); $i++){
		if($code_barras[$i] == '.' || $code_barras[$i] == ' ' || $code_barras[$i] == '-'){
		}else{
			echo $code_barras[$i];
	  }
	}?>
    
    	<hr />  
      <? echo $res_pagamento['code_barras']; ?>
      <hr /></td>
    </tr> 
  <input type="hidden" name="cliente" value="<? echo $res_pagamento['cliente']; ?>" />
  <input type="hidden" name="valor_boleto" value="<? echo $res_pagamento['valor']; ?>" />
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>BANCO EMISSOR: 
      </strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>VALOR: 
      </strong></td>
    <td width="79" bgcolor="#CCCCCC"><strong>JUROS: 
      </strong></td>
    <td bgcolor="#CCCCCC"><strong>TARIFA: 
      </strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>IMPRESSO</strong></td>
    <td width="156" bgcolor="#CCCCCC"><strong>VENCIMENTO:
    </strong></td>
    </tr>
  <tr>
    <td colspan="2"><input name="textfield4" type="text" disabled="disabled" id="textfield4" value="<? echo $res_pagamento['banco']; ?>" size="40" /></td>
    <td width="76"><input name="textfield5" type="text" disabled="disabled" id="textfield5" value="<? echo number_format($res_pagamento['valor'], 2, ',', '.'); ?>" size="10" /></td>
    <td width="79">
    <input name="textfield6" type="text" disabled="disabled" id="textfield6" value="<? echo number_format($res_pagamento['juros'], 2, ',', '.'); ?>" size="10" />
    
    <input name="juros_sistema" type="hidden" value="<? echo number_format($res_pagamento['juros'], 2, ',', '.'); ?>" />
    
    </td>
    <td><input name="textfield7" type="text" disabled="disabled" id="textfield7" value="<? echo number_format($res_pagamento['tarifa'], 2, ',', '.'); ?>" size="10" /></td>
    <td colspan="2"><input name="textfield" type="text" disabled="disabled" id="textfield" value="<? echo number_format($res_pagamento['boleto_impresso'], 2, ',', '.'); ?>" size="10" /></td>
    <td width="156"><input name="textfield8" value="<? echo $res_pagamento['vencimento']; ?>" type="text" disabled="disabled" id="textfield8" size="20" /></td>
  </tr>
  <tr>
   <td colspan="8"><hr /></td>
  </tr>
  <tr>
    <td width="189" bgcolor="#CCCCCC"><strong>FORM. PROCESSAMENTO</strong></td>
    <td width="144" bgcolor="#CCCCCC"><strong>BANCO</strong></td>
    <td bgcolor="#CCCCCC"><strong>TARIFA PAGT.</strong></td>
    <td bgcolor="#CCCCCC"><strong>COMISSÃO</strong></td>
    <td width="144" bgcolor="#CCCCCC"><strong>DATA DE PAGAMENTO</strong></td>
    <td width="114" bgcolor="#CCCCCC"><strong>JUROS MAQUINA</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>DIFEREN&Ccedil;A CARTAO</strong></td>
    </tr>
  <tr>
    <td><label for="forma_processamento"></label>
      <select name="forma_processamento" size="1" id="forma_processamento">
<option value="MAQUINA DE PAGAMENTO">MAQUINA DE PAGAMENTO</option>
<option value="CR&Eacute;DITO EM CONTA">CR&Eacute;DITO EM CONTA</option>
<option value="CONTA BANCARIA">CONTA BANCARIA</option>
<option value="CONTA BANCARIA">CART&Atilde;O DE CR&Eacute;DITO</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
    <td><label for="banco"></label>
      <select name="banco" size="1" id="banco">
        <option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
        <option value="RECARGA PAY">RECARGA PAY</option>
        <option value="ITA&Uacute;">ITA&Uacute;</option>
        <option value="SANTANDER">SANTANDER</option>
        <option value="BANCO INTER">BANCO INTER</option>
        <option value="PICPAY">PICPAY</option>
        <option value="CELCOIN">CELCOIN</option>
      </select></td>
    <td><label for="select3"></label>
      <label for="tarifa"></label>
    <input name="tarifa" type="text" id="tarifa" value="0" size="5"></td>
    <td><input name="comissao" type="text" id="comissao" value="0" size="7"></td>
    <td><label for="select4"></label>
      <label for="observacao"></label>
      <label for="textfield9"></label>
      <span id="sprytextfield1">
      <input name="data_pagamento" type="text" id="textfield9" size="12" value="<? echo date("d/m/Y"); ?>" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span>      
      <label for="comissao"></label></td>
    <td><label for="juros_maquina"></label>
      <input name="juros_maquina" type="text" id="juros_maquina" size="5" /></td>
    <td colspan="2"><label for="diferenca_cartao"></label>
      <input name="diferenca_cartao" type="text" id="diferenca_cartao" size="5" /></td>
    </tr>
  <tr>
    <td colspan="8" bgcolor="#CCCCCC"><strong>COMPROVANTE DE PAGAMENTO</strong></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#FFFFFF"><label for="comprovante_pagamento"></label>
      <input type="file" name="comprovante_pagamento" id="comprovante_pagamento" /></td>
  </tr>
  <tr>
    <td colspan="8" bgcolor="#CCCCCC"><strong>OBSERVA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td colspan="8"><input name="observacao" type="text" id="observacao" size="70" /></td>
  </tr>
  <tr>
    <td colspan="8"><hr />
      <input type="submit" name="button" id="button" value="EFETIVAR" /></td>
  </tr>
</table>
</form>
<? } ?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>