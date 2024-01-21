<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/todos_os_clientes.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cadastro_de_cliente">
 <h1>Todos os clientes cadastrados no Easy Loan</h1>
<?

$sql_1 = mysql_query("SELECT * FROM clientes ORDER BY id DESC LIMIT 50");
$conta = mysql_num_rows($sql_1);
?>
<table width="1180" border="0">
  <tr>
    <td width="245"><strong>Nome do cliente:</strong></td>
    <td width="134"><strong>CPF do cliente:</strong></td>
    <td width="171"><strong>Data de nascimento:</strong></td>
    <td width="146"><strong>Telefone:</strong></td>
    <td width="151"><strong>Tipo profissional:</strong></td>
    <td width="146"><strong>Empréstimos:</strong></td>
    <td width="155"><strong>Cartões:</strong></td>
  </tr>
<? while($res = mysql_fetch_array($sql_1)){ ?>
  <tr>
    <td><? echo $res['nome']; ?></td>
    <td><? echo $cpf = $res['cpf']; ?></td>
    <td><? echo $res['nascimento']; ?></td>
    <td><? echo $res['celular_1']; ?></td>
    <td><? echo $res['sit_profissional']; ?></td>
    <td>
    <?
     $sql_2 = mysql_query("SELECT * FROM envio_de_propostas WHERE cpf = '$cpf' AND status = 'Aprovado' AND tipo_de_proposta = 'Empréstimo'");
	 if(mysql_num_rows($sql_2) == ''){
		 echo "Não fez empréstimos";
	 }else{
		echo mysql_num_rows($sql_2);
	 }
	?> 
    </td>    <td>
    <?
     $sql_3 = mysql_query("SELECT * FROM envio_de_propostas WHERE cpf = '$cpf' AND status = 'Aprovado' AND tipo_de_proposta = 'Cartão'");
	 if(mysql_num_rows($sql_3) == ''){
		 echo "Sem cartões";
	 }else{
		echo mysql_num_rows($sql_3);
	 }
	?> 
    </td>
  </tr>
  <tr>
    <td colspan="7"><hr /></td>
    </tr>
<? } ?>
</table>
</div><!-- box_cadastro_de_cliente -->
</body>
</html>