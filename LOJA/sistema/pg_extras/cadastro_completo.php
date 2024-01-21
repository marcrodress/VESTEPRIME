<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastro_completo.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?
$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM lista_inss WHERE id = '$id'");
 while($res = mysql_fetch_array($sql_1)){
?>

<? if(isset($_POST['button'])){

$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$cep = $_POST['cep'];
$rg = $_POST['rg'];
$fone = $_POST['fone'];
$phone1 = $_POST['phone1'];
$phone2 = $_POST['phone2'];
$phone3 = $_POST['phone3'];
$phone4 = $_POST['phone4'];
$phone5 = $_POST['phone5'];
$obs = $_POST['obs'];

mysql_query("UPDATE lista_inss SET endereco = '$endereco', complemento = '$complemento', bairro = '$bairro', cep = '$cep', cidade = '$cidade', fone = '$fone', phone1 = '$phone1', phone2 = '$phone2', phone3 = '$phone3', phone4 = '$phone4', phone5 = '$phone5', rg = '$rg', obs = '$obs' WHERE id = '$id'");

echo "<strong>Dados atualizados com sucesso.</strong>";

die;

}?>

<form name="button" method="post" action="" enctype="multipart/form-data">
<table width="966" border="0">
  <tr>
    <td width="210"><strong>Nome:</strong></td>
    <td width="199"><strong>CPF:</strong></td>
    <td width="217"><strong>Data de nasicmento:</strong></td>
    <td width="189"><strong>N&ordm; do ben&eacute;ficio:</strong></td>
    <td width="146"><strong>Valor do ben&eacute;ficio:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['nome']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['cpf']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['dt_nasc']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['n_beneficio']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['vl_atual_benef']; ?>">
    </strong></td>
  </tr>
  <tr>
    <td><strong>Tipo:</strong></td>
    <td><strong>Banco:</strong></td>
    <td><strong>Estado:</strong></td>
    <td><strong>Cidade:</strong></td>
    <td><strong>Bairro:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['tipo_concessao']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['banco']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="textfield" id="textfield" disabled="disabled" value="<? echo $res['uf']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="cidade" id="textfield" value="<? echo $res['cidade']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="bairro" id="textfield" value="<? echo $res['bairro']; ?>">
    </strong></td>
  </tr>
  <tr>
    <td><strong>Endere&ccedil;o:</strong></td>
    <td><strong>Complemento:</strong></td>
    <td><strong>CEP:</strong></td>
    <td><strong>RG:</strong></td>
    <td><strong>Telefone:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input type="text" name="endereco" id="textfield" value="<? echo $res['endereco']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="complemento" id="textfield" value="<? echo $res['complemento']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="cep" id="textfield" value="<? echo $res['cep']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="rg" id="textfield" value="<? echo $res['rg']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="fone" id="textfield" value="<? echo $res['fone']; ?>">
    </strong></td>
  </tr>
  <tr>
    <td><strong>Telefone 1:</strong></td>
    <td><strong>Telefone 2:</strong></td>
    <td><strong>Telefone 3:</strong></td>
    <td><strong>Telefone 4:</strong></td>
    <td><strong>Telefone 5:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input type="text" name="phone1" id="textfield" value="<? echo $res['phone1']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone2" id="textfield" value="<? echo $res['phone2']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone3" id="textfield" value="<? echo $res['phone3']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone4" id="textfield" value="<? echo $res['phone4']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone5" id="textfield" value="<? echo $res['phone5']; ?>">
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><strong>Observa&ccedil;&otilde;es:</strong></td>
  </tr>
  <tr>
    <td colspan="5"><label for="textarea"></label>
    <textarea name="obs" id="textarea" cols="160" rows="5"><? echo $res['obs']; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="5"><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
  </tr>
</table>
</form>
<? } ?>
</body>
</html>