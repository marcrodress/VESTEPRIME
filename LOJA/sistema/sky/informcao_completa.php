<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/informcao_completa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<?
require "../../conexao.php";
$id = $_GET['id'];
$id_cliente = $_GET['id_cliente'];

$sql_1 = mysql_query("SELECT * FROM telemarketing WHERE id = '$id_cliente' OR cpf = '$id_cliente'");
	while($res_1 = mysql_fetch_array($sql_1)){
$sql_2 = mysql_query("SELECT * FROM contratos_sky WHERE id = '$id'");
	while($res_2 = mysql_fetch_array($sql_2)){

?>
  <table width="1000" border="0">
    <tr>
      <td colspan="9"><h1><strong>Dados pessoais:</strong></h1></td>
    </tr>
    <tr>
      <td width="197"><strong>Nome: </strong></td>
      <td width="190"><strong>CPF:</strong></td>
      <td width="207"><strong>RG:</strong></td>
      <td width="219"><strong>Data de nascimento:</strong></td>
      <td width="165"><strong>Estado civil:</strong></td>
    </tr>
    <tr>
      <td><? echo $res_1['nome']; ?></td>
      <td><? echo $res_1['cpf']; ?></td>
      <td><? echo $res_1['rg']; ?></td>
      <td><? echo $res_1['nascimento']; ?></td>
      <td><? echo $res_1['estado_civil']; ?></td>
    </tr>
    <tr>
      <td colspan="9"><hr />
      <h1><strong>Dados da instala&ccedil;&atilde;o:</strong></h1></td>
    </tr>    
    <tr>
      <td><strong>Endere&ccedil;o:</strong></td>
      <td><strong>Cep:</strong></td>
      <td><strong>Complemeto:</strong></td>
      <td><strong>Tipo de imovel:</strong></td>
      <td><strong>Bairro:</strong></td>
    </tr>
    <tr>
      <td><? echo $res_1['endereco']; ?></td>
      <td><? echo $res_1['cep']; ?></td>
      <td><? echo $res_1['complemento']; ?></td>
      <td><? echo $res_1['tipo_imovel']; ?></td>
      <td><? echo $res_1['bairro']; ?></td>
    </tr>
    </tr>
    <tr>
      <td><strong>Cidade:</strong></td>
      <td><strong>Estado:</strong></td>
      <td><strong>Telefone resid&ecirc;ncial:</strong></td>
      <td><strong>Telefone celular:</strong></td>
      <td><strong>Telefone comercial:</strong></td>
    </tr>
    <tr>
      <td><? echo $res_1['cidade']; ?></td>
      <td><? echo $res_1['estado']; ?></td>
      <td><? echo $res_1['tele_residencial']; ?></td>
      <td><? echo $res_1['tele_celular']; ?></td>
      <td><? echo $res_1['tele_comercial']; ?></td>
    </tr>
    </tr>
    <tr>
      <td><strong>E-mail:</strong></td>
      <td><strong>Plano:</strong></td>
      <td><strong>Valor:</strong></td>
      <td><strong>Brasileir&atilde;o:</strong></td>
      <td><strong>Estadual:</strong></td>
    </tr>
    <tr>
      <td><? echo $res_1['email']; ?></td>
      <td><? echo $res_2['plano']; ?></td>
      <td><? echo $res_2['valor']; ?></td>
      <td><? echo $res_2['brasileirao']; ?></td>
      <td><? echo $res_2['estadual']; ?></td>
    </tr>
    </tr>
    <tr>
      <td colspan="5"><p><strong>Observa&ccedil;&otilde;es:</strong></p></td>
    </tr>
    <tr>
      <td colspan="9"><? echo $res_2['obs']; ?></td>
    </tr>
    <tr>
      <td colspan="5"><hr />
      <h1><strong>Dados de pagamento:</strong></h1></td>
    </tr>
    <tr>
      <td colspan="5" align="center"><hr />
      CART&Atilde;O DE CR&Eacute;DITO
      <hr /></td>
    </tr>
    <tr>
      <td><strong>N&ordm; do cart&atilde;o:</strong></td>
      <td><strong>Validade:</strong></td>
      <td><strong>Nome impresso no cart&atilde;o:</strong></td>
      <td><strong>C&oacute;digo de seguran&ccedil;a:</strong></td>
      <td><strong>Badeira:</strong></td>
    </tr>
    <tr>
      <td><? echo $res_2['cartao']; ?></td>
      <td><? echo $res_2['validade']; ?></td>
      <td><? echo $res_2['nome_impressor_cartao']; ?></td>
      <td><? echo $res_2['cosigo_s_cartao']; ?></td>
      <td><? echo $res_2['bandeira']; ?></td>
    </tr>
    <tr>
      <td colspan="5" align="center"><hr />
      D&Eacute;BITO EM CONTA CORRENTE
      <hr /></td>
    </tr>
    <tr>
      <td></td>
      <td><strong>Banco:</strong></td>
      <td><strong>Ag&ecirc;ncia:</strong></td>
      <td><strong>Conta corrente:</strong></td>
      <td></td>
    </tr>
    <tr>
      <td></td>
      <td><? echo $res_2['banco']; ?></td>
      <td><? echo $res_2['agencia']; ?></td>
      <td><? echo $res_2['conta_corrente']; ?></td>
      <td></td>
    </tr>
  </table>
<? }} ?>
</div><!-- box -->
</body>
</html>