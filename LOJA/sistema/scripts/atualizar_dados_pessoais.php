<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/atualiza_dados_cliente.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; ?>
<div id="box_cadastro_de_cliente">
<? if($_GET['pg'] == 'digitar_senha'){ ?>
<h1 class="h12">Digite sua senha para autorizar a atualização de seu cadastro</h1>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input class="input4" type="password" name="senha" /><input type="submit" class="input5" name="send" value="Confirmar" />
</form>
<? if(isset($_POST['send'])){ 

$senha = $_POST['senha'];
$cpf_cliente = $_GET['cpf_cliente'];
$id = $_GET['id'];

	
$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

$sql_1 = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf_cliente' AND id = '$id'");
if(mysql_num_rows($sql_1) == ''){
 echo "<script language='javascript'>window.alert('Não estou conseguindo localizar este cliente!');</script>";
}else{
$sql_2 = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf_cliente' AND senha = '$senha'");
if(mysql_num_rows($sql_2) == ''){
 echo "<script language='javascript'>window.alert('A senha digitada não confere!');window.location='';</script>";
}else{
 echo "<script language='javascript'>window.location='atualizar_dados_pessoais.php?pg=senha_correta&cpf_cliente=$cpf_cliente&id=$id&operador=$operador&cpf_operador=$cpf_operador';</script>";
}}}?>
<? } ?>



<? if($_GET['pg'] == 'senha_correta'){ ?>


<?php if(isset($_POST['button'])){


$nome = $_POST['nome'];
$rg = $_POST['rg'];
$date_exp = $_POST['date_exp'];
$uf_rg = $_POST['uf_rg'];
$orgao_emissor = $_POST['orgao_emissor'];
$nascimento = $_POST['nascimento'];
$estado_civil = $_POST['estado_civil'];
$conjuge = $_POST['conjuge'];
$sexo = $_POST['sexo'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$escolaridade = $_POST['escolaridade'];
$nascionalidade = $_POST['nacionalidade'];
$naturalidade = $_POST['naturalidade'];
$tele_residencial = $_POST['tele_residencial'];
$celular_1 = $_POST['celular_1'];
$celular_2 = $_POST['celular_2'];
$moradia = $_POST['moradia'];
$endereco = $_POST['endereco'];
$n_residencia = $_POST['n_residencia'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$ano_moradia = $_POST['ano_moradia'];
$mes_moradia = $_POST['mes_moradia'];
$titulo = $_POST['titulo'];
$emissao = $_POST['emissao'];
$uf_titulo = $_POST['uf_titulo'];
$zona = $_POST['zona'];
$secao = $_POST['secao'];
$n_reservista = $_POST['n_reservista'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
	
$cpf_cliente = $_GET['cpf_cliente'];
$id = $_GET['id'];

	
$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

$sql_update = mysql_query("UPDATE clientes SET uf_titulo = '$uf_titulo', nome = '$nome', rg = '$rg', date_exp = '$date_exp', uf_rg = '$uf_rg', orgao_expeditor = '$orgao_emissor', nascimento = '$nascimento', estado_civil = '$estado_civil', conjuge = '$conjuge', sexo = '$sexo', mae = '$mae', pai = '$pai', escolaridade = '$escolaridade', nacionalidade = '$nascionalidade', tele_residencial = '$tele_residencial', celular_1 = '$celular_1', celular_2 = '$celular_2', naturalidade = '$naturalidade', moradia = '$moradia', endereco = '$endereco', n_residencia = '$n_residencia', cep = '$cep', bairro = '$bairro', cidade = '$cidade', estado = '$estado', ano_moradia = '$ano_moradia', mes_moradia = '$mes_moradia', titulo = '$titulo', emissao = '$emissao', zona = '$zona', secao = '$secao', n_reservista = '$n_reservista' WHERE cpf = '$cpf_cliente' AND id = '$id'");

mysql_query("INSERT INTO atualizacao_de_cadastro (ip, date, cpf, id_cliente, tipo_de_dado, operador, cpf_operador) VALUES ('$ip', '$date', '$cpf_cliente', '$id', 'Dados Pessoais', '$operador', '$cpf_operador')");

mysql_query("INSERT INTO acoes_cadastro (ip, date, id_cliente, cpf, nome_acao, executor) VALUES ('$ip', '$date', '$id', '$cpf_cliente', 'Atualização de dados pessoais autorizado com senha', 'Atendente - $operador CPF: $cpf_operador')");

	
echo "
<h2>Cadastro atualizado com sucesso!</h2>
<p><br>Lebre-se de manter sempre o cadastro do cliente atualizado assim ele encontra uma série de benefícios,  como:</p><br>
<ul>
  <li>Irá receber proposta para adesão de cartão de  credito.</li>
  <li>Irá receber proposta para empréstimos e  financiamentos.</li>
  <li>Irá poder fazer o pagamento de suas contas no  Easy Loan.</li>
  <li>Poderá recarregar seu celular junto com agente.</li>
</ul><br>
<p>Pedimos sempre que deixe seu cadastro atualizado, para ter o  máximo de benefícios dos produtos Easy Loan.<br><br></p>
";

die;
}?>
<?
$cpf_cliente = $_GET['cpf_cliente'];

$sql_dados = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
	while($res = mysql_fetch_array($sql_dados)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="961" border="0">
    <tr>
      <td colspan="3"><h1><strong>Dados pessoais do cliente</strong></h1></td>
    </tr>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>
    <tr>
      <td width="320"><strong>Nome:</strong></td>
      <td width="320"><strong>RG:</strong></td>
      <td><strong>Data de expedi&ccedil;&atilde;o / UF de expedi&ccedil;&atilde;o / Org&atilde;o emissor:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield1">
        <input type="text" name="nome" id="nome" value="<? echo $res['nome']; ?>" />
      </span></td>
      <td><span id="sprytextfield2">
        <input type="text" name="rg" id="rg" value="<? echo $res['rg']; ?>" />
      </span></td>
      <td><span id="sprytextfield3">
      <input class="input1_1" type="text" name="date_exp" id="date_exp" value="<? echo $res['date_exp']; ?>" />
      <span class="textfieldRequiredMsg"></span></span>
        <select class="select" name="uf_rg" id="uf_rg">
          <option value="<? echo $res['uf_rg']; ?>"><? echo $res['uf_rg']; ?></option>
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
        <span id="sprytextfield13">
        <input class="input3_2" type="text" name="orgao_emissor" id="orgao_emissor" value="<? echo $res['orgao_expeditor']; ?>" />
</span></td>
</tr>
    <tr>
      <td><strong>CPF:</strong></td>
      <td><strong>Nascimento:</strong></td>
      <td><strong>Estado civil:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield4">
        <input type="text" name="cpf" disabled="disabled" id="cpf" value="<? echo $_GET['cpf_cliente']; ?>" />
      </span></td>
      <td><span id="sprytextfield5">
        <input type="text" name="nascimento" id="nascimento" value="<? echo $res['nascimento']; ?>" />
      </span></td>
      <td><select name="estado_civil" size="1" id="estado_civil">
        <option value="<? echo $res['estado_civil']; ?>"><? echo $res['estado_civil']; ?></option>
        <option value=""></option>
        <option value="Solteiro">Solteiro</option>
        <option value="Casado">Casado</option>
        <option value="Divorciado">Divorciado</option>
        <option value="Vi&uacute;vo(a)">Vi&uacute;vo(a)</option>
      </select></td>
</tr>
    <tr>
      <td><strong>Nome da c&ocirc;njuge</strong></td>
      <td><strong>Sexo:</strong></td>
      <td><strong>Nome da m&atilde;e:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield6">
        <input type="text" name="conjuge" id="conjuge" value="<? echo $res['conjuge']; ?>" />
      </span></td>
      <td><select name="sexo" size="1" id="sexo">
        <option value="<? echo $res['sexo']; ?>"><? echo $res['sexo']; ?></option>
        <option value=""></option>
        <option value="Masculino">Masculino</option>
        <option value="Feminino">Feminino</option>
      </select></td>
      <td><span id="sprytextfield7">
        <input type="text" name="mae" id="mae" value="<? echo $res['mae']; ?>" />
</span></td>

    </tr>
    <tr>
      <td><strong>
      Nome do pai:
      </strong></td>
      <td><strong>
      Escolaridade:
      </strong></td>
      <td><strong>Nacionalidade:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield8">
        <input type="text" name="pai" id="pai" value="<? echo $res['pai']; ?>" />
</span></td>
      <td><select name="escolaridade" size="1" id="escolaridade">
        <option value="<? echo $res['escolaridade']; ?>"><? echo $res['escolaridade']; ?></option>
        <option value=""></option>
        <option value="Ensino Infantil">Ensino Infantil</option>
        <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
        <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
        <option value="Ensino M&eacute;dio Incompleto">Ensino M&eacute;dio Incompleto</option>
        <option value="Ensino M&eacute;dio Completo">Ensino M&eacute;dio Completo</option>
        <option value="Superior Incompleto">Superior Incompleto</option>
        <option value="Superior Completo">Superior Completo</option>
      </select></td>
      <td><span id="sprytextfield9">
        <input type="text" name="nacionalidade" id="nacionalidade" value="<? echo $res['nacionalidade']; ?>" />
</span></td>
</tr>
    <tr>
      <td><strong>Telefone resid&ecirc;ncial:</strong></td>
      <td><strong>Telefone celular 1:</strong></td>
      <td><strong>Telefone celular 2:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield10">
      <input type="text" name="tele_residencial" id="tele_residencial" value="<? echo $res['tele_residencial']; ?>" />
</span></td>
      <td><span id="sprytextfield11">
        <input type="text" name="celular_1" id="celular_1" value="<? echo $res['celular_1']; ?>" />
        <span class="textfieldInvalidFormatMsg"></span></span></td>
      <td><span id="sprytextfield12">
        <input type="text" name="celular_2" id="celular_2" value="<? echo $res['celular_2']; ?>" />
        <span class="textfieldInvalidFormatMsg"></span></span></td>
</tr>
    <tr>
      <td><strong>Naturalidade:</strong></td>
      <td><strong>Tipo de moradia:</strong></td>
      <td><strong>Endereco:</strong></td>
    </tr>
      <td><span id="sprytextfield14">
        <input type="text" name="naturalidade" id="naturalidade" value="<? echo $res['naturalidade']; ?>" />
        <span class="textfieldRequiredMsg"></span></span></td>
      <td>
        <select name="moradia" size="1" id="moradia">
          <option value="<? echo $res['moradia']; ?>"><? echo $res['moradia']; ?></option>
          <option value="Alugada">Alugada</option>
          <option value="Pr&oacute;pria">Pr&oacute;pria</option>
          <option value="Familar">Familar</option>
          <option value="Parente">Parente</option>
        </select>
	  </td>
      <td><span id="sprytextfield15">
        <input type="text" name="endereco" id="endereco" value="<? echo $res['endereco']; ?>" />
        <span class="textfieldRequiredMsg"></span></span>
      <tr>
        <td><strong>N&ordm; da resid&ecirc;ncia:</strong></td>
        <td><strong>Cep:</strong></td>
        <td><strong>Bairro:</strong></td>
      </tr>
    <tr>
      <td><span id="sprytextfield16">
        <input type="text" name="n_residencia" id="n_residencia" value="<? echo $res['n_residencia']; ?>" />
        <span class="textfieldRequiredMsg"></span></span></td>
      <td><span id="sprytextfield17">
        <input type="text" name="cep" id="cep" value="<? echo $res['cep']; ?>" />
      </span>
      <td><span id="sprytextfield18">
      <input type="text" name="bairro" id="bairro" value="<? echo $res['bairro']; ?>" />
      <span class="textfieldRequiredMsg"></span></span></td>
      <tr>
        <td><strong>Cidade:</strong></td>
        <td><strong>Estado:</strong></td>
        <td><strong>Tempo de moradia: (m&ecirc;s e ano)</strong></td>
      </tr>
    <tr>
      <td><span id="sprytextfield19">
        <input type="text" name="cidade" id="cidade" value="<? echo $res['cidade']; ?>" />
      </span></td>
      <td>
        <select name="estado" id="estado">
          <option value="<? echo $res['estado']; ?>"><? echo $res['estado']; ?></option>
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
      <td><span id="sprytextfield20">
        <input class="input1" type="text" name="ano_moradia" id="ano_moradia" value="<? echo $res['ano_moradia']; ?>" />
        <span class="textfieldRequiredMsg"></span></span><span id="sprytextfield21">
        <input class="input1" type="text" name="mes_moradia" id="mes_moradia" value="<? echo $res['mes_moradia']; ?>" />
        <span class="textfieldRequiredMsg"></span></span></td>
</tr>
    <tr>
      <td><strong>Titulo de eleitor / Data de emiss&atilde;o:</strong></td>
      <td><strong>Zona / Se&ccedil;&atilde;o de vota&ccedil;&atilde;o:</strong></td>
      <td><strong>N&ordm; da resevista:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield22">
        <input class="input3_2" type="text" name="titulo" id="titulo" value="<? echo $res['titulo']; ?>" />
</span><span id="sprytextfield23">
<input class="input3_2" type="text" name="emissao" id="emissao" value="<? echo $res['emissao']; ?>" />
</span>
<select class="select1_2" name="uf_titulo" id="uf_titulo">
  <option value="<? echo $res['uf_titulo']; ?>"><? echo $res['uf_titulo']; ?></option>
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
</select></td>
      <td><span id="sprytextfield24">
        <input class="input1" type="text" name="zona" id="zona" value="<? echo $res['zona']; ?>" />
</span><span id="sprytextfield25">
<input class="input1" type="text" name="secao" id="secao" value="<? echo $res['secao']; ?>" />
</span></td>
      <td><span id="sprytextfield26">
        <input type="text" name="n_reservista" id="n_reservista" value="<? echo $res['n_reservista']; ?>" />
</span></td>
    </tr>
  </table>
<? } ?>
<input type="submit" class="input1_2" value="Atualizar" name="button" />
</form>
<? } ?>
</div><!-- box_cadastro_de_cliente -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "social_security_number", {format:"ssn_custom", useCharacterMasking:true, pattern:"000.000.000-00"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "none", {isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none", {isRequired:false});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "none", {isRequired:false});
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "none", {isRequired:false});
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "phone_number", {format:"phone_custom", useCharacterMasking:true, isRequired:false, pattern:"(00) 0000.0000"});
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11", "phone_number", {format:"phone_custom", pattern:"(00) 0000.0000", useCharacterMasking:true});
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12", "phone_number", {isRequired:false, format:"phone_custom", pattern:"(00) 0000.0000", useCharacterMasking:true});
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13", "none", {isRequired:false});
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17", "zip_code", {format:"zip_custom", pattern:"00000-000", useCharacterMasking:true});
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20");
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21");
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22", "none", {isRequired:false});
var sprytextfield23 = new Spry.Widget.ValidationTextField("sprytextfield23", "none", {isRequired:false});
var sprytextfield24 = new Spry.Widget.ValidationTextField("sprytextfield24", "none", {isRequired:false});
var sprytextfield25 = new Spry.Widget.ValidationTextField("sprytextfield25", "none", {isRequired:false});
var sprytextfield26 = new Spry.Widget.ValidationTextField("sprytextfield26", "none", {isRequired:false});
</script>
</body>
</html>