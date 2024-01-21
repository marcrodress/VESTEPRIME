<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/confirmar_visita.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? if(isset($_POST['send'])){

require "../../conexao.php";
	
$plano = $_POST['plano'];
$valor = $_POST['valor'];
$brasileirao = $_POST['brasileirao'];
$estadual = $_POST['estadual'];
$cartao = $_POST['cartao'];
$validade = $_POST['validade'];
$nome_impressor_cartao = $_POST['nome_impressor_cartao'];
$cosigo_s_cartao = $_POST['cosigo_s_cartao'];
$bandeira = $_POST['bandeira'];
$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta_corrente = $_POST['conta_corrente'];
$obs = $_POST['obs'];

$id_cliente = $_GET['id'];
$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y H:i:s");

$insert = mysql_query("INSERT INTO contratos_sky (status, ip, date, id_cliente, plano, valor, brasileirao, estadual, cartao, validade, nome_impressor_cartao, cosigo_s_cartao, bandeira, banco, agencia, conta_corrente, obs) VALUES ('Ativo', '$ip', '$date', '$id_cliente', '$plano', '$validade', '$brasileirao', '$estadual', '$cartao', '$validade', '$nome_impressor_cartao', '$cosigo_s_cartao', '$bandeira', '$banco', '$agencia', '$conta_corrente', '$obs')");

if($insert == ''){
	echo "<h1><strong>Ouve um erro, tente novamente!</strong></h1><hr>";
}else{
	echo "<h1><strong>Confirmação de adesão ao plano Sky realizado com sucesso...</strong></h1>";
	die;
}}?>
<form name="send" method="post" action="" enctype="multipart/form-data">
<table width="793" border="0">
  <tr>
    <td width="168"><strong>Plano contratado:</strong></td>
    <td width="141">&nbsp;</td>
    <td width="120"><strong>Valor:</strong></td>
    <td width="158"><strong>Brasileir&atilde;o:</strong></td>
    <td width="184"><strong>Estadual:</strong></td>
  </tr>
  <tr>
    <td colspan="2"><label for="plano"></label>
      <select name="plano" size="1" id="plano">
        <option value="Sky Fit - R$ 49.90">Sky Fit - R$ 49.90</option>
        <option value="Sky Light - R$ 79.90">Sky Light - R$ 79.90</option>
        <option value="Sky Mix HD R$ 99.90">Sky Mix HD R$ 99.90</option>
        <option value="Sky Fit Futebol R$ 114.90">Sky Fit Futebol R$ 114.90</option>
        <option value="Sky Light + HBO R$ 119.90">Sky Light + HBO R$ 119.90</option>
        <option value="Sky Light + Telecine 3 R$ 129.90">Sky Light + Telecine 3 R$ 129.90</option>
        <option value="Sky Light + Cinema R$ 49.90">Sky Light + Cinema R$ 49.90</option>
        <option value="Sky Light + Futebol R$ 159.90">Sky Light + Futebol R$ 159.90</option>
        <option value="HDTV HBO Max R$ 149.90">HDTV HBO Max R$ 149.90</option>
        <option value="HDTV Telecine R$ 169.90">HDTV Telecine R$ 169.90</option>
        <option value="HDTV Cinema R$ 189.90">HDTV Cinema R$ 189.90</option>
        <option value="HDTV Futebol R$ 199.90">HDTV Futebol R$ 199.90</option>
        <option value="HDTV FULL HBO MIX R$  204.90">HDTV FULL HBO MIX R$  204.90</option>
        <option value="HDTV FULL TELECINE R$  224.90">HDTV FULL TELECINE R$  224.90</option>
        <option value="HDTV FULL CINEMA R$  244.90">HDTV FULL CINEMA R$  244.90</option>
        <option value="HDTV FULL FUTEBOL R$  249.90">HDTV FULL FUTEBOL R$  249.90</option>
        <option value="HDTV FULL TOP R$  299.90">HDTV FULL TOP R$  299.90</option>
      </select></td>
    <td><strong>
      <input name="valor" type="text" id="textfield" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="brasileirao" type="text" id="textfield" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="estadual" type="text" id="textfield" value="" size="20" />
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><strong>DADOS DE PAGAMENTO:</strong>
      <hr />
      <strong></strong></td>
  </tr>
  <tr>
    <td><strong>Cart&atilde;o de cr&eacute;dito:</strong></td>
    <td><strong>N&uacute;mero do cart&atilde;o:</strong></td>
    <td><strong>Validade:</strong></td>
    <td><strong>Nome impresso no cart&atilde;</strong>o:</td>
    <td><strong>C&oacute;digo de seguran&ccedil;a / Bandeira:</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>
      <input name="cartao" type="text" id="cartao" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="validade" type="text" id="textfield3" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="nome_impressor_cartao" type="text" id="nome_impressor_cartao" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="cosigo_s_cartao" type="text" id="cosigo_s_cartao" value="" size="5" />
      <input name="bandeira" type="text" id="bandeira" value="" size="8" />
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><hr /></td>
  </tr>
  <tr>
    <td><strong>D&eacute;bito em conta corrente:</strong></td>
    <td><strong>Banco:</strong></td>
    <td><strong>Ag&ecirc;ncia:</strong></td>
    <td><strong>Conta corrente:</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>
      <input name="banco" type="text" id="banco" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="agencia" type="text" id="agencia" value="" size="20" />
    </strong></td>
    <td><strong>
      <input name="conta_corrente" type="text" id="conta_corrente" value="" size="20" />
    </strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><strong>Observa&ccedil;&otilde;es:
      <label for="obs"></label>
    </strong></td>
  </tr>
  <tr>
    <td colspan="5"><strong>
      <textarea name="obs" id="obs" cols="100" rows="5"></textarea>
    </strong></td>
  </tr>
</table>
 <input class="input" type="submit" name="send" value="Confirmar" />
</form>
</body>
</html>