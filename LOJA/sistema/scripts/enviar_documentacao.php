<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/enviar_documentacao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../../conexao.php"; ?>
<? if(isset($_POST['send'])){

$tipo = $_POST['tipo'];
$doc = $_FILES['doc']['name'];
$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

$doc = str_replace(" ", "-", $doc);
$doc = str_replace(",", "-", $doc);
$doc = str_replace("ã", "a", $doc);
$doc = str_replace("á", "a", $doc);
$doc = str_replace("à", "a", $doc);
$doc = str_replace("é", "e", $doc);
$doc = str_replace("ê", "e", $doc);
$doc = str_replace("è", "e", $doc);
$doc = str_replace("í", "i", $doc);
$doc = str_replace("ì", "i", $doc);
$doc = str_replace("ó", "o", $doc);
$doc = str_replace("õ", "o", $doc);
$doc = str_replace("ç", "c", $doc);

$id_cliente = $_GET['id'];
$cpf_cliente = $_GET['cpf_cliente'];
$email = $_GET['email'];

$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

if(file_exists("../sky_sound_dt/clientes_docs/$doc")){ $a = 1;while(file_exists("../sky_sound_dt/clientes_docs/[$a]$doc")){$a++;}$doc = "[".$a."]".$doc;}


$sql_insert_docs = mysql_query("INSERT INTO clientes_docs (date, ip, id_cliente, cpf, email, tipo, doc, resp_envio) VALUES ('$date', '$ip', '$id_cliente', '$cpf_cliente', '$email', '$tipo', 'http://www.easyloan.com.br/sky_sound_dt/clientes_docs/$doc', 'Atendente - $operador - CPF: $cpf_operador')");

(move_uploaded_file($_FILES['doc']['tmp_name'], "../../clientes_docs/".$doc));

mysql_query("INSERT INTO atualizacao_de_cadastro (ip, date, cpf, id_cliente, tipo_de_dado, operador, cpf_operador) VALUES ('$ip', '$date', '$cpf_cliente', '$id_cliente', 'Cadastro de documento $tipo', '$operador', '$cpf_operador')");

mysql_query("INSERT INTO acoes_cadastro (ip, date, id_cliente, cpf, nome_acao, executor) VALUES ('$ip', '$date', '$id_cliente', '$cpf_cliente', 'Envio de documentação', 'Atendente - $operador CPF: $cpf_operador')");


echo "<table width='500' border='0'>
  <tr>
    <td><p><strong>Documento enviado com sucesso!</strong><br>
      Toda vez que precisar enviar alguma propósta pela internet enviaremos sempre para análise o arquivo mais novo, sempre que poder atualize seus dados.    
    <p><strong>Atenciosamente</strong><br>
    Easy Loan <br>(85) 3315.6219</p></td>
  </tr>
</table>
";

die;
}?>
<form name="send" method="post" action="" enctype="multipart/form-data">
 <table width="500">
  <tr>
   <td width="286">Tipo de documentação:</td>
   <td width="302">Selecione o documento para enviar:</td>
  </tr>
  <tr>
   <td><select name="tipo" size="1">
     <option value="CPF">CPF</option>
     <option value="RG">RG</option>
     <option value="Titulo">Titulo</option>
     <option value="Reservista">Reservista</option>
     <option value="Carteira de Trabalho">Carteira de Trabalho</option>
     <option value="Certidão de casamento">Certidão de casamento</option>
     <option value="Certidão de nascimento">Certidão de nascimento</option>
     <option value="Comprovante de endere&ccedil;o">Comprovante de endere&ccedil;o</option>
     <option value="Comprovante de renda">Comprovante de renda</option>
     <option value="Extrato bancario">Extrato bancario</option>
   </select></td>
   <td><input name="doc" type="file" /></td>
  </tr>
  <tr>
   <td><input class="input" name="send" type="submit" value="Enviar" /></td>
  </tr> 
 </table>
</form>
</div><!-- box -->
</body>
</html>