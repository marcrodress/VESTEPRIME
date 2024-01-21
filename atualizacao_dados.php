<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/atualizacao_dados.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">
<?

$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

?>



<h1><strong>ATUALIZAR DADOS CADASTRAIS</strong></h1>
<hr />
<? if(isset($_POST['button'])){
	

$mae = strtoupper($_POST['mae']);
$renda_mensal = $_POST['renda_mensal'];
$estado_civil = strtoupper($_POST['estado_civil']);
$tele_residencial = $_POST['tele_residencial'];
$celular_1 = $_POST['celular_1'];
$celular_2 = $_POST['celular_2'];
$escolaridade = strtoupper($_POST['escolaridade']);
$sit_profissional = strtoupper($_POST['sit_profissional']);
$endereco = strtoupper($_POST['endereco']);
$n_residencia = $_POST['n_residencia'];
$cep = $_POST['cep'];
$bairro = strtoupper($_POST['bairro']);
$cidade = strtoupper($_POST['cidade']);
$estado = strtoupper($_POST['estado']);
$profissao = strtoupper($_POST['profissao']);


$email = strtolower($_POST['email']);
$categoria = strtolower($_POST['categoria']);

$fechamento = 0;

$vencimento = $_POST['vencimento'];


if($vencimento <10){
	if($vencimento == 9){
		$fechamento = 28;
	}elseif($vencimento == 8){
		$fechamento = 28;
	}elseif($vencimento == 7){
		$fechamento = 27;
	}elseif($vencimento == 6){
		$fechamento = 26;
	}elseif($vencimento == 5){
		$fechamento = 25;
	}elseif($vencimento == 4){
		$fechamento = 24;
	}elseif($vencimento == 3){
		$fechamento = 23;
	}elseif($vencimento == 2){
		$fechamento = 22;
	}elseif($vencimento == 1){
		$fechamento = 21;
	}
}elseif($vencimento == 10){
	$fechamento = "01";
}else{
	$fechamento = $vencimento-10;
	}
	
if($fechamento >=2 && $fechamento <=9){
	$fechamento = "0$fechamento";
}else{
	$fechamento = $fechamento;
}





$sql_clientes = mysqli_query($conexao_bd, "UPDATE clientes SET atualizacao = 'ATUALIZADO', ultima_atualizacao = '$data', mae = '$mae', renda_mensal = '$renda_mensal', estado_civil = '$estado_civil', tele_residencial = '$tele_residencial', celular_1 = '$celular_1', celular_2 = '$celular_2', escolaridade = '$escolaridade', sit_profissional = '$sit_profissional', endereco = '$endereco', n_residencia = '$n_residencia', cep = '$cep', bairro = '$bairro', cidade = '$cidade', estado = '$estado', profissao = '$profissao', email = '$email' WHERE cpf = '$cliente'");

if($sql_clientes == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao atualizar dados, tente novamente!');</script>";
}else{


$valor = 0;

if($categoria == 'Varejo'){
	$valor = 4.99;
}elseif($categoria == 'Gold'){
	$valor = 8.99;
}elseif($categoria == 'Platinum'){
	$valor = 14.99;
}elseif($categoria == 'Black'){
	$valor = 19.99;
	}


if($categoria != ''){
mysqli_query($conexao_bd, "UPDATE conta_corrente SET categoria = '$categoria', anuidade = '$valor', vencimento = '$vencimento', fechamento = '$fechamento' WHERE cliente = '$cliente'");
}

echo "<script language='javascript'>window.alert('Informações atualizadas com sucesso!');window.location='';</script>";
}

}?>

<?

$sql_puxa = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
$sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente  WHERE cliente = '$cliente'");
	while($res_puxa_cliente = mysqli_fetch_array($sql_puxa)){
	while($res_puxa_conta = mysqli_fetch_array($sql_conta_corrente)){
?>

<form name="" method="post" action="" enctype="multipart/form-data">
  <table width="961" border="0">
    <tr>
      <td colspan="3"><strong>Nome:</strong></td>
      </tr>
    <tr>
      <td colspan="3"><span id="sprytextfield1">
        <input name="nome" type="text" disabled id="nome" value="<? echo $res_puxa_cliente['nome']; ?>" />
      </span></td>
      </tr>
    <tr>
      <td width="320"><strong>Nome da mãe</strong></td>
      <td width="320"><strong>Renda mensal comprovada:</strong></td>
      <td><strong>Estado Civil</strong></td>      				
    </tr>
    <tr>
      <td><span id="sprytextfield6">
        <input type="text" name="mae" id="mae" value="<? echo $res_puxa_cliente['mae']; ?>" />
      </span></td>
      <td><input type="text" name="renda_mensal" id="renda_mensal" value="<? echo $res_puxa_cliente['renda_mensal']; ?>" /></td>
      <td><select name="estado_civil" size="1" id="estado_civil">
        <option value="<? echo $res_puxa_cliente['estado_civil']; ?>"><? echo $res_puxa_cliente['estado_civil']; ?></option>
        <option value=""></option>
        <option value="Solteiro">Solteiro</option>
        <option value="Casado">Casado</option>
        <option value="Divorciado">Divorciado</option>
        <option value="Vi&uacute;vo(a)">Vi&uacute;vo</option>
      </select></td>
    </tr>
    <tr>
      <td><strong>Telefone resid&ecirc;ncial:</strong></td>
      <td><strong>Telefone celular 1:</strong></td>
      <td><strong>Telefone celular 2:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield2">
      <input type="text" name="tele_residencial" id="tele_residencial" value="<? echo $res_puxa_cliente['tele_residencial']; ?>" />
<span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><span id="sprytextfield11">
        <span class="textfieldInvalidFormatMsg"></span><span id="sprytextfield4">
        <label for="text1"></label>
        <input type="text" name="celular_1" id="celular_1" value="<? echo $res_puxa_cliente['celular_1']; ?>" />
        </span></span></td>
      <td><span id="sprytextfield12"><span id="sprytextfield3">
      <input type="text" name="celular_2" id="celular_2" value="<? echo $res_puxa_cliente['celular_2']; ?>" />
      </span><span class="textfieldInvalidFormatMsg"></span></span></td>
</tr>
    <tr>
      <td><strong> Escolaridade: </strong></td>
      <td><strong>Situa&ccedil;&atilde;o profissional:</strong></td>
      <td><strong>Endereco:</strong></td>
    </tr>
      <td><select name="escolaridade" size="1" id="escolaridade">
        <option value="<? echo $res_puxa_cliente['escolaridade']; ?>"><? echo $res_puxa_cliente['escolaridade']; ?></option>
        <option value=""></option>
        <option value="Analfabeto">Analfabeto</option>
        <option value="Ensino Infantil">Ensino Infantil</option>
        <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
        <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
        <option value="Ensino M&eacute;dio Incompleto">Ensino M&eacute;dio Incompleto</option>
        <option value="Ensino M&eacute;dio Completo">Ensino M&eacute;dio Completo</option>
        <option value="Superior Incompleto">Superior Incompleto</option>
        <option value="Superior Completo">Superior Completo</option>
      </select></td>
      <td><select name="sit_profissional" size="1" id="sit_profissional">
        <option value="<? echo $res_puxa_cliente['sit_profissional']; ?>"><? echo $res_puxa_cliente['sit_profissional']; ?></option>
        <option value=""></option>
        <option value="Funcion&aacute;rio Publico">Funcion&aacute;rio Publico</option>
        <option value="Aposentados e Pensionistas">Aposentados e Pensionistas</option>
        <option value="Aut&ocirc;nomo">Aut&ocirc;nomo</option>
        <option value="Empregador">Empregador</option>
        <option value="Funcion&aacute;rio de Empresa Privada">Funcion&aacute;rio de Empresa Privada</option>
        <option value="For&ccedil;as Armadas">For&ccedil;as Armadas</option>
        <option value="Militar">Militar</option>
        <option value="Proprit&aacute;rio">Proprit&aacute;rio</option>
      </select></td>
      <td><span id="sprytextfield15">
        <input name="endereco" type="text" id="endereco" value="<? echo $res_puxa_cliente['endereco']; ?>" />
        <span class="textfieldRequiredMsg"></span></span>
      <tr>
        <td><strong>N&ordm; da resid&ecirc;ncia:</strong></td>
        <td><strong>Cep:</strong></td>
        <td><strong>Bairro:</strong></td>
      </tr>
    <tr>
      <td><span id="sprytextfield16">
        <input name="n_residencia" type="text" id="n_residencia" value="<? echo $res_puxa_cliente['n_residencia']; ?>" />
        <span class="textfieldRequiredMsg"></span></span></td>
      <td><span id="sprytextfield17">
        <input name="cep" type="text" id="cep" value="<? echo $res_puxa_cliente['cep']; ?>" />
      </span>
      <td><span id="sprytextfield18">
      <input name="bairro" type="text" id="bairro" value="<? echo $res_puxa_cliente['bairro']; ?>" />
      <span class="textfieldRequiredMsg"></span></span></td>
      <tr>
        <td><strong>Cidade:</strong></td>
        <td><strong>Estado:</strong></td>
        <td><strong>Profiss&atilde;o:</strong></td>
      </tr>
    <tr>
      <td><span id="sprytextfield19">
        <input name="cidade" type="text" id="cidade" value="<? echo $res_puxa_cliente['cidade']; ?>" />
      </span></td>
      <td>
        <select name="estado" id="estado">
          <option value="<? echo $res_puxa_cliente['estado']; ?>"><? echo $res_puxa_cliente['estado']; ?></option>
          <option value=""></option>
          <option value="Acre">Acre</option>
          <option value="Alagoas">Alagoas</option>
          <option value="Amap&aacute;">Amap&aacute;</option>
          <option value="Amazonas">Amazonas</option>
          <option value="Bahia">Bahia</option>
          <option value="Cear&aacute;">Cear&aacute;</option>
          <option value="Distrito Federal">Distrito Federal</option>
          <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
          <option value="Goi&aacute;s">Goi&aacute;s</option>
          <option value="Maranh&atilde;o">Maranh&atilde;o</option>
          <option value="Mato Grosso">Mato Grosso</option>
          <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
          <option value="Minas Gerais">Minas Gerais</option>
          <option value="Par&aacute;">Par&aacute;</option>
          <option value="Para&iacute;ba">Para&iacute;ba</option>
          <option value="Paran&aacute;">Paran&aacute;</option>
          <option value="Pernambuco">Pernambuco</option>
          <option value="Piau&iacute;">Piau&iacute;</option>
          <option value="Rio de Janeiro">Rio de Janeiro</option>
          <option value="Rio Grande do Norte">Rio Grande do Norte</option>
          <option value="Rio Grande do Sul">Rio Grande do Sul</option>
          <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
          <option value="Roraima">Roraima</option>
          <option value="Santa Catarina">Santa Catarina</option>
          <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
          <option value="Sergipe">Sergipe</option>
          <option value="Tocantins">Tocantins</option>
        </select>
      </td>
      <td><span id="sprytextfield29">
      <input type="text" name="profissao" id="profissao" value="<? echo $res_puxa_cliente['profissao']; ?>" />
      </span></td>
</tr>
    <tr>

      <td colspan="3"><hr /></td>
    </tr>
    <tr>
      <td><strong>E-mail para envio de informativos:</strong></td>
      <td><strong>SEGMENTO DO CLIENTE</strong></td>
      <td><strong>VENCIMENTO DA FATURA</strong></td>
    </tr>
    <tr>
      <td>
        <input type="text" name="email" id="email" value="<? echo $res_puxa_cliente['email']; ?>" />
      </td>
      <td><select name="categoria" size="1">
		<option value=""></option>
		<option value="Varejo">VAREJO R$ 4,99</option>
        <option value="Gold">GOLD R$ 8,99</option>
        <option value="Platinum">PLATINUM R$ 14,99</option>
        <option value="Black">BLACK R$ 19,99</option>
      </select>
        </td>
      <td>
<select name="vencimento" size="1" id="select">
	      <option value="<? echo $res_puxa_conta['vencimento']; ?>"><? echo $res_puxa_conta['vencimento']; ?></option>
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
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
        </select>      
      </td>
    </tr>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>        
    <tr>
      <td colspan="3" align="center"><input class="input3" type="submit" name="button" id="button" value="Cadastrar" /></td>
    </tr>
  </table>
 </form>
<? }} ?>
</div><!-- box_pagamento_1 -->
<script type="text/javascript">
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {isRequired:false, useCharacterMasking:true, pattern:"(00) 0000.0000"});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000"});
</script>
</body>
</html>