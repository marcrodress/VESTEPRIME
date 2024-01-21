<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/confirmar_visita.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<?
$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM lista_inss WHERE id = '$id'");
 while($res = mysql_fetch_array($sql_1)){
?>

<? if(isset($_POST['button'])){

$data_visita = $_POST['data_visita'];
$turno = $_POST['turno'];
$vl_pretendido = $_POST['vl_pretendido'];
$obs = $_POST['obs'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
$cpf = $_POST['cpf'];
$id = $_GET['id'];

$sql_2 = mysql_query("INSERT INTO visitas_confirmadas (ip, data, status, id_cliente, cpf, data_visita, turno_visita, vl_pretendido, obs) VALUES ('$ip', '$date', 'Ativo', '$id', '$cpf', '$data_visita', '$turno', '$vl_pretendido', '$obs')");
if($sql_2 == ''){
	echo "Ocorreu um erro ao agendar, por favor, tente novamente...";
}else{
	echo "Agendamento realizado com sucesso...";
die;
}}?>
<form name="button" method="post" action="" enctype="multipart/form-data">
<table width="966" border="0">
  <tr>
    <td width="200"><strong>Nome:</strong></td>
    <td width="203"><strong>CPF:</strong></td>
    <td width="195"><strong>Data de nasicmento:</strong></td>
    <td width="182"><strong>N&ordm; do ben&eacute;ficio:</strong></td>
    <td width="182"><strong>Valor do ben&eacute;ficio:</strong></td>
  </tr>
  <tr>
    <td><strong>
    <input type="text" name="nome" id="textfield" disabled="disabled" value="<? echo $res['nome']; ?>">
    </strong></td>
    <td><strong><input type="hidden" name="cpf" value="<? echo $res['cpf']; ?>" />
    <input type="text" name="ddd" id="textfield" disabled="disabled" value="<? echo $res['cpf']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="dt_nasc" id="textfield" disabled="disabled" value="<? echo $res['dt_nasc']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="n_beneficio" id="textfield" disabled="disabled" value="<? echo $res['n_beneficio']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="vl_atual_benef" id="textfield" disabled="disabled" value="<? echo $res['vl_atual_benef']; ?>">
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
    <input type="text" name="tipo_concessao" id="textfield" disabled="disabled" value="<? echo $res['tipo_concessao']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="banco" id="textfield" disabled="disabled" value="<? echo $res['banco']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="uf" id="textfield" disabled="disabled" value="<? echo $res['uf']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="cidade" id="textfield" disabled="disabled" value="<? echo $res['cidade']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="bairro" id="textfield" disabled="disabled" value="<? echo $res['bairro']; ?>">
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
    <input type="text" name="endereco" id="textfield" disabled="disabled" value="<? echo $res['endereco']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="complemento" id="textfield" disabled="disabled" value="<? echo $res['complemento']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="cep" id="textfield" disabled="disabled" value="<? echo $res['cep']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="rg" id="textfield" disabled="disabled" value="<? echo $res['rg']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="fone" id="textfield" disabled="disabled" value="<? echo $res['fone']; ?>">
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
    <input type="text" name="phone1" id="textfield" disabled="disabled" value="<? echo $res['phone1']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone2" id="textfield" disabled="disabled" value="<? echo $res['phone2']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone3" id="textfield" disabled="disabled" value="<? echo $res['phone3']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone4" id="textfield" disabled="disabled" value="<? echo $res['phone4']; ?>">
    </strong></td>
    <td><strong>
    <input type="text" name="phone5" id="textfield" disabled="disabled" value="<? echo $res['phone5']; ?>">
    </strong></td>
  </tr>
  <tr>
    <td><strong>Melhor data para marcar a visita:</strong></td>
    <td><strong>Melhor turno da visita:</strong></td>
    <td><strong>Valor pretendindo:</strong></td>
    <td colspan="2" rowspan="2"><label for="select"></label> 
      * N&atilde;o se esque&ccedil;a avisar ao cliente que antes da visita o promotor ir&aacute; ligar novamente s&oacute; para confirmar se o cliente vai est&aacute; reamente em casa.</td>
    </tr>
  <tr>
    <td><strong>
      <input type="text" name="data_visita" id="textfield2" value="<? echo @$data_visita; ?>" />
    </strong></td>
    <td><select name="turno" size="1" id="select">
      <option value="<? echo @$_POST['turno']; ?>"><? echo @$_POST['turno']; ?></option>
      <option value="Manh&atilde;">Manh&atilde;</option>
      <option value="Tarde">Tarde</option>
      <option value="Noite">Noite</option>
    </select></td>
    <td><label for="vl_pretendido"></label>
      <input type="text" name="vl_pretendido" id="vl_pretendido" value="<? echo @$vl_pretendido; ?>" /></td>
    </tr>
  <tr>
    <td colspan="5"><strong>Observa&ccedil;&otilde;es:</strong></td>
  </tr>
  <tr>
    <td colspan="5"><label for="textarea"></label>
      <textarea name="obs" id="textarea" cols="160" rows="5"><? echo @$obs; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="5"><input class="input" type="submit" name="button" id="button" value="Confirmar"></td>
  </tr>
</table>
</form>
<? } ?>
</body>
</html>