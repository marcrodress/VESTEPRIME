<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="sky/css/cadastrar_venda_sky.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
 <h2>Cadastrar venda de plano Sky<hr /></h2>
 <form name="avancar" method="post" action="" enctype="multipart/form-data">
   <span id="sprytextfield1">
   <input class="input1" type="text" name="key" />
   </span>
   <input class="input2" type="submit" name="avancar" value="Buscar" />
 </form>


<? if(isset($_POST['button'])){
	
$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$rg = $_POST['rg'];
$nascimento = $_POST['nascimento'];
$estado_civil = $_POST['estado_civil'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$complemento = $_POST['complemento'];
$moradia = $_POST['moradia'];
$cidade = $_POST['cidade'];
$bairro = $_POST['bairro'];
$estado = $_POST['estado'];
$tele_residencial = $_POST['tele_residencial'];
$celular_1 = $_POST['celular_1'];
$tele_empresa = $_POST['tele_empresa'];
$email = $_POST['email'];

$valor = $_POST['valor'];
$plano = $_POST['plano'];
$brasileirao = $_POST['brasileirao'];
$estadual = $_POST['estadual'];
$obs = $_POST['obs'];
$n_cartao = $_POST['n_cartao'];
$validade = $_POST['validade'];
$nome_impresso = $_POST['nome_impresso'];
$codigo_seguranca = $_POST['codigo_seguranca'];
$bandeira = $_POST['bandeira'];
$banco = $_POST['banco'];
$agencia = $_POST['agencia'];
$conta_corrente = $_POST['conta_corrente'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y H:i:s");

$sql_2 = mysql_query("INSERT INTO telemarketing (status, tele_celular, tele_comercial, tipo_imovel, cpf, nascimento, rg, estado_civil, email, tele_residencial, nome, endereco, complemento, bairro, cidade, estado, cep) VALUES ('Ativo', '$celular_1', '$tele_empresa', '$moradia', '$cpf', '$nascimento', '$rg', '$estado_civil', '$email', '$tele_residencial', '$nome', '$endereco', '$complemento', '$bairro', '$cidade', '$estado', '$cep')");
if($sql_2 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar dados no telemarketing!');</script>";
}else{
$sql_3 = mysql_query("INSERT INTO contratos_sky (status, ip, date, id_cliente, plano, valor, brasileirao, estadual, cartao, validade, nome_impressor_cartao, cosigo_s_cartao, bandeira, banco, agencia, conta_corrente, obs) VALUES ('Ativo', '$ip', '$date', '$cpf', '$plano', '$valor', '$brasileirao', '$estadual', '$n_cartao', '$validade', '$nome_impresso', '$codigo_seguranca', '$bandeira', '$banco', '$agencia', '$conta_corrente', '$obs')");
 if($sql_3 == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar dados no setor de contratos Sky!');</script>";
}else{ 
	echo "<script language='javascript'>window.alert('Cadastro realizado com sucessso!');window.location='?pack=SKY1';</script>";
  }
 }
}?>


 
<? if(isset($_POST['avancar'])){

$key = $_POST['key'];

$sql_1 = mysql_query("SELECT * FROM clientes WHERE cpf = '$key'");
if(mysql_num_rows($sql_1) == ''){
	echo "<h3><strong>Não foi encontrado nenhum cliente com esse CPF: $key</strong></h3>";
}else{
	while($res_1 = mysql_fetch_array($sql_1)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input type="hidden" name="cpf" value="<? echo $_POST['key']; ?>" />
  <table width="1180" border="0">
    <tr>
      <td colspan="9"><h1><strong>Dados pessoais:</strong></h1></td>
    </tr>
    <tr>
      <td width="228"><strong>Nome: </strong></td>
      <td width="228"><strong>CPF:</strong></td>
      <td width="242"><strong>RG:</strong></td>
      <td width="251"><strong>Data de nascimento:</strong></td>
      <td width="207"><strong>Estado civil:</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="nome" id="textfield2" value="<? echo @$res_1['nome']; ?>" /></td>
      <td><? echo @$res_1['cpf']; ?></td>
      <td><input type="text" name="rg" id="textfield2" value="<? echo @$res_1['rg']; ?>" /></td>
      <td><input type="text" name="nascimento" id="textfield2" value="<? echo @$res_1['nascimento']; ?>" /></td>
      <td><input type="text" name="estado_civil" id="textfield2" value="<? echo @$res_1['estado_civil']; ?>" /></td>
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
      <td><input type="text" name="endereco" id="textfield2" value="<? echo @$res_1['endereco']; ?>" /></td>
      <td><input type="text" name="cep" id="textfield2" value="<? echo @$res_1['cep']; ?>" /></td>
      <td><input type="text" name="complemento" id="textfield2" value="<? echo @$res_1['complemento']; ?>" /></td>
      <td><input type="text" name="moradia" id="textfield2" value="<? echo @$res_1['moradia']; ?>" /></td>
      <td><input type="text" name="bairro" id="textfield2" value="<? echo @$res_1['bairro']; ?>" /></td>
    </tr>
    <tr>
      <td></tr></td>
    </tr>
    <tr>
      <td><strong>Cidade:</strong></td>
      <td><strong>Estado:</strong></td>
      <td><strong>Telefone resid&ecirc;ncial:</strong></td>
      <td><strong>Telefone celular:</strong></td>
      <td><strong>Telefone comercial:</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="cidade" id="textfield2" value="<? echo @$res_1['cidade']; ?>" /></td>
      <td><input type="text" name="estado" id="textfield2" value="<? echo @$res_1['estado']; ?>" /></td>
      <td><input type="text" name="tele_residencial" id="textfield2" value="<? echo @$res_1['tele_residencial']; ?>" /></td>
      <td><input type="text" name="celular_1" id="textfield2" value="<? echo @$res_1['celular_1']; ?>" /></td>
      <td><input type="text" name="tele_empresa" id="textfield2" value="<? echo @$res_1['tele_empresa']; ?>" /></td>
    </tr>
    <tr>
      <td></tr></td>
    </tr>
    <tr>
      <td><strong>E-mail:</strong></td>
      <td><strong>Plano: <a href="http://www.sky.com.br" target="_blank">Lista</a></strong></td>
      <td><strong>Valor:</strong></td>
      <td><strong>Brasileir&atilde;o:</strong></td>
      <td><strong>Estadual:</strong></td>
    </tr>
    <tr>
      <td><input type="text" name="email" id="textfield2" value="<? echo @$res_1['email']; ?>" /></td>
      <td><select name="plano" size="1" id="plano">
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
        <input name="valor" type="text" id="textfield9" value="" size="20" />
      </strong></td>
      <td><strong>
        <input name="brasileirao" type="text" id="textfield10" value="" size="20" />
      </strong></td>
      <td><strong>
        <input name="estadual" type="text" id="textfield11" value="" size="20" />
      </strong></td>
    </tr>
    <tr>
      <td></tr></td>
    </tr>
    <tr>
      <td colspan="5"><p><strong>Observa&ccedil;&otilde;es:</strong></p></td>
    </tr>
    <tr>
      <td colspan="9"><label for="obs"></label>
      <textarea name="obs" id="obs" cols="143" rows="5"></textarea></td>
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
      <td><label for="n_cartao"></label>
      <input type="text" name="n_cartao" id="n_cartao" /></td>
      <td><label for="validade"></label>
      <input type="text" name="validade" id="validade" /></td>
      <td><label for="nome_impresso"></label>
      <input type="text" name="nome_impresso" id="nome_impresso" /></td>
      <td><label for="codigo_seguranca"></label>
      <input type="text" name="codigo_seguranca" id="codigo_seguranca" /></td>
      <td><label for="bandeira"></label>
      <input type="text" name="bandeira" id="bandeira" /></td>
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
      <td><label for="banco"></label>
      <input type="text" name="banco" id="banco" /></td>
      <td><label for="agencia"></label>
      <input type="text" name="agencia" id="agencia" /></td>
      <td><label for="conta_corrente"></label>
      <input type="text" name="conta_corrente" id="conta_corrente" /></td>
      <td></td>
    </tr>
    <tr>
      <td align="center" colspan="5"><hr /></td>
    </tr>
    <tr>
      <td align="center" colspan="5"><input class="input" type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<? }}}?>

</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "social_security_number", {format:"ssn_custom", pattern:"000.000.000-00", useCharacterMasking:true});
</script>
</body>
</html>