<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastro_completo_telemarketing.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
require "../../conexao.php";

$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM telemarketing WHERE id = '$id'");
 while($res = mysql_fetch_array($sql_1)){
?>

<? if(isset($_POST['button'])){

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$rg = $_POST['rg'];
$cpf = $_POST['cpf'];
$estado_civil = $_POST['estado_civil'];
$email = $_POST['email'];
$tele_residencial = $_POST['tele_residencial'];
$tele_celular = $_POST['tele_celular'];
$tele_comercial = $_POST['tele_comercial'];
$tipo_imovel = $_POST['tipo_imovel'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$cep = $_POST['cep'];
$rg = $_POST['rg'];

$sqk_update = mysql_query("UPDATE telemarketing SET tele_celular = '$tele_celular', tele_comercial = '$tele_comercial', tipo_imovel = '$tipo_imovel',  cpf = '$cpf', nascimento = '$nascimento', rg = '$rg', estado_civil = '$estado_civil', email = '$email', tele_residencial = '$tele_residencial', nome = '$nome', endereco = '$endereco', complemento = '$complemento', bairro = '$bairro', cidade = '$cidade', estado = '$estado', cep = '$cep' WHERE id = '$id'");

if($sqk_update == ''){
echo "<strong>Ocorreu um erro e os dados não foram atualizados..</strong>";
}else{

echo "<strong>Dados atualizados com sucesso.</strong>";

die;

}}?>

<form name="button" method="post" action="" enctype="multipart/form-data">
<table width="966" border="0">
  <tr>
    <td width="198"><strong>Nome:</strong></td>
    <td width="187"><strong>CPF:</strong></td>
    <td width="175"><strong>Data de nasicmento:</strong></td>
    <td width="185"><strong>RG:</strong></td>
    <td width="204"><strong>Estato civil:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input name="nome" type="text" id="nome" value="<? echo @$res['nome']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="cpf" type="text" id="cpf" value="<? echo @$res['cpf']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="nascimento" type="text" id="nascimento" value="<? echo @$res['nascimento']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="rg" type="text" id="rg" value="<? echo @$res['rg']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="estado_civil" type="text" id="estado_civil" value="<? echo @$res['estado_civil']; ?>" size="40">
    </strong></td>
  </tr>
  <tr>
    <td><strong>E-mail:</strong></td>
    <td><strong>Telefone residencial:</strong></td>
    <td><strong>Telefone celular:</strong></td>
    <td><strong>Telefone comercial:</strong></td>
    <td><strong>Tipo de im&oacute;vel:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input name="email" type="text" id="email" value="<? echo @$res['email']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="tele_residencial" type="text" id="tele_residencial" value="<? echo @$res['tele_residencial']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="tele_celular" type="text" id="tele_celular" value="<? echo @$res['tele_celular']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="tele_comercial" type="text" id="textfield" value="<? echo @$res['tele_comercial']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="tipo_imovel" type="text" id="textfield" value="<? echo @$res['tipo_imovel']; ?>" size="40">
    </strong></td>
  </tr>
  <tr>@
    <td><strong>Endere&ccedil;o:</strong></td>
    <td><strong>Complemento:</strong></td>
    <td><strong>CEP / Estado:</strong></td>
    <td><strong>Bairro:</strong></td>
    <td><strong>Cidade:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input name="endereco" type="text" id="textfield" value="<? echo @$res['endereco']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="complemento" type="text" id="textfield" value="<? echo @$res['complemento']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="cep" type="text" id="textfield" value="<? echo @$res['cep']; ?>" size="15">
    <input name="estado" type="text" id="textfield2" value="<? echo @$res['estado']; ?>" size="15" />
    </strong></td>
    <td><strong>
    <input name="bairro" type="text" id="textfield" value="<? echo @$res['bairro']; ?>" size="40">
    </strong></td>
    <td><strong>
    <input name="cidade" type="text" id="textfield" value="<? echo @$res['cidade']; ?>" size="40">
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td colspan="5"><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
  </tr>
</table>
</form>
<? } ?>
</body>
</html>