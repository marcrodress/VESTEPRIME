<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/sagria_para_banco.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<? if($_GET['p'] == '1'){ ?>

<form name="" method="post" action="" enctype="multipart/form-data">
<h1>SAGRIA DE DEPÓSITIO/TRANSFERÊNCIA</h1>
<hr />
<table width="1000" border="0">
  <tr>
    <td width="173"><strong>VALOR</strong></td>
    <td width="235"><strong>TIPO DE RETIRADA</strong></td>
    <td width="286"><strong>FINALIDADE</strong></td>
    <td width="288"><strong>OBSERVA&Ccedil;&Otilde;ES</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
      <span id="sprytextfield1">
      <input style="padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" autofocus="autofocus" name="valor" type="text" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="select"></label>
      <select style="padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" name="banco" size="1" id="select">
        <option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
        <option value="SANGRIA PESSOAL">SANGRIA PESSOAL</option>
      </select></td>
    <td><label for="select2"></label>
      <select style="padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" name="finalidade" size="1" id="select2">
        <option value="SANGRIA">SANGRIA DE CAIXA</option>
        <option value="ALIVIO">ALIVIO DE NUMERARIO</option>
      </select></td>
    <td><label for="textfield2"></label>
      <input style="padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" name="observacoes" type="text" id="textfield2" size="60" /></td>
  </tr>
  <tr>
    <td colspan="4"><hr />      <strong>SENHA DE AUTORIAZA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td colspan="4"><input style="width:120px; padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" type="password" name="senha_autorizacao" /></td>
  </tr>
  <tr>
    <td colspan="4"><hr />     <input style="padding:10px; border:1px solid #000; border-radius:5px; text-align:center;" type="submit" name="button" id="button" value="ENVIAR" /></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$valor = $_POST['valor'];
$banco = $_POST['banco'];
$finalidade = $_POST['finalidade'];
$observacoes = $_POST['observacoes'];
$senha_autorizacao = $_POST['senha_autorizacao'];

if($senha_autorizacao == ''){
echo "<script language='javascript'>window.alert('Senha de autorização de sangria incorreta!');</script>";
}else{
$sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE senha_autorizacao = '$senha_autorizacao'");
if(mysqli_num_rows($sql_verifica_senha) == ''){
echo "<script language='javascript'>window.alert('Senha de autorização de sangria incorreta!');</script>";
}else{
$sql_sangria = mysqli_query($conexao_bd, "INSERT INTO sangria_caixa (codeCaixa, turno, dia, mes, ano, data, data_completa, finalidade, operador, valor, banco, observacoes) VALUES ('$codeCaixa', '$turno', '$dia', '$mes', '$ano', '$data', '$data_completa', '$finalidade', '$operador', '$valor', 'BANCO DO BRASIL', '$observacoes')");
echo "<script language='javascript'>window.location='?valor=$valor&finalidade=$finalidade&p=2';</script>";
  }
 }
}
?>
<? } ?>
  
  
  
<? if($_GET['p'] == '2'){ ?>

<? if($_GET['finalidade'] == 'ALIVIO'){ ?>

  <br /> <br /><br /> <br /><br /> <br />
<script language="javascript">
		function dados_deposito(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=335,height=400');
		}
	</script>
<a class="a" onclick="dados_deposito('scripts/emitir_dados_deposito.php?nome_operador=<? echo $nome; ?>&cpf_operador=<? echo $operador; ?>&valor=<? echo $_GET['valor']; ?>');" href="">EMITIR DADOS PARA ALÍVIO</a>  
  
 
 
 
 <br /> <br /> <br />
   

<a class="a2" target="_blank" rel="superbox[iframe][1000x1550]" href="scripts/termo_de_deposito.php?nome_operador=<? echo $nome; ?>&cpf_operador=<? echo $operador; ?>&valor=<? echo $_GET['valor']; ?>">DOCUMENTO DE DECLARAÇÃO DE ALÍVIO</a>  


<? }else{ ?>

  <br /> <br /><br /> <br /><br /> <br />
<script language="javascript">
		function dados_deposito(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=335,height=400');
		}
	</script>
<a class="a" onclick="dados_deposito('scripts/emitir_dados_comprovante_de_sangria.php?nome_operador=<? echo $nome; ?>&cpf_operador=<? echo $operador; ?>&valor=<? echo $_GET['valor']; ?>');" href="">EMITIR COMPROVANTE DE SANGRIA</a>  
  
<? } // confirmação de alivio ?>

<? } ?>
</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "integer", {useCharacterMasking:true});
</script>
</body>
</html>