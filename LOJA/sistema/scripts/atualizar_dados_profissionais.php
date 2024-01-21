<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../css/cadastrar_cliente.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>

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
 echo "<script language='javascript'>window.location='atualizar_dados_profissionais.php?pg=senha_correta&cpf_cliente=$cpf_cliente&id=$id&operador=$operador&cpf_operador=$cpf_operador';</script>";
}}}?>
<? } ?>



<? if($_GET['pg'] == 'senha_correta'){ ?>


<?php if(isset($_POST['send'])){



$n_inss = $_POST['n_inss'];
$dia_pagamento = $_POST['dia_pagamento'];
$rendas_complementar = $_POST['rendas_complementar'];
$sit_profissional = $_POST['sit_profissional'];
$profissao = $_POST['profissao'];
$nome_empresa = $_POST['nome_empresa'];
$tele_empresa = $_POST['tele_empresa'];
$endereco_empresa = $_POST['endereco_empresa'];
$numero_da_empresa = $_POST['numero_da_empresa'];
$bairro_empresa = $_POST['bairro_empresa'];
$cidade_empresa = $_POST['cidade_empresa'];
$estado_sede = $_POST['estado_sede'];
$cnpj = $_POST['cnpj'];
$tempo_de_servico = $_POST['tempo_de_servico'];
$renda_mensal = $_POST['renda_mensal'];
$nome_1 = $_POST['nome_1'];
$tele_refere_1 = $_POST['tele_refere_1'];
$nome_2 = $_POST['nome_2'];
$tele_refere_2 = $_POST['tele_refere_2'];
$nome_3 = $_POST['nome_3'];
$tele_refere_3 = $_POST['tele_refere_3'];
$nome_banco = $_POST['nome_banco'];
$tipo_de_conta = $_POST['tipo_de_conta'];
$agencia = $_POST['agencia'];
$conta_bancaria = $_POST['conta_bancaria'];
$cliente_desde = $_POST['tempo_de_conta'];

$outra_renda = $_POST['outra_renda'];
$origem_outra_renda = $_POST['origem_outra_renda'];
$comprovacao_renda = $_POST['comprovacao_renda'];

$dependentes = $_POST['dependentes'];
$ctps = $_POST['ctps'];
$data_ctps = $_POST['data_ctps'];
$uf_emissor_ctps = $_POST['uf_emissor_ctps'];
$n_ctps = $_POST['n_ctps'];
$seire_ctps = $_POST['seire_ctps'];
$local_emissao_ctps = $_POST['local_emissao_ctps'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];
	
$operador = $_GET['operador'];
$cpf_operador = $_GET['cpf_operador'];

	
$cpf_cliente = $_GET['cpf_cliente'];
$id = $_GET['id'];


$sql_update = mysql_query("UPDATE clientes SET sit_profissional = '$sit_profissional', n_inss = '$n_inss', profissao = '$profissao', nome_empresa = '$nome_empresa', tele_empresa = '$tele_empresa', endereco_empresa = '$endereco_empresa', numero_da_empresa = '$numero_da_empresa', bairro_empresa = '$bairro_empresa', cidade_empresa = '$cidade_empresa', estado_sede = '$estado_sede', cnpj = '$cnpj', tempo_de_servico = '$tempo_de_servico', renda_mensal = '$renda_mensal', dia_pagamento = '$dia_pagamento', rendas_complementar = '$rendas_complementar', outra_renda = '$outra_renda', origem_outra_renda = '$origem_outra_renda', comprovacao_renda = '$comprovacao_renda', nome_1 = '$nome_1', tele_refere_1 = '$tele_refere_1', nome_2 = '$nome_2', tele_refere_2 = '$tele_refere_2', nome_3 = '$nome_3', tele_refere_3 = '$tele_refere_3', nome_banco = '$nome_banco', tipo_de_conta = '$tipo_de_conta', agencia = '$agencia', conta_bancaria = '$conta_bancaria', cliente_desde = '$cliente_desde', dependentes = '$dependentes', ctps = '$ctps', data_ctps = '$data_ctps', uf_emissor_ctps = '$uf_emissor_ctps', n_ctps = '$n_ctps', seire_ctps = '$seire_ctps', local_emissao_ctps = '$local_emissao_ctps' WHERE cpf = '$cpf_cliente' AND id = '$id'");

mysql_query("INSERT INTO atualizacao_de_cadastro (ip, date, cpf, id_cliente, tipo_de_dado, operador, cpf_operador) VALUES ('$ip', '$date', '$cpf_cliente', '$id', 'Dados Profissionais', '$operador', '$cpf_operador')");

mysql_query("INSERT INTO acoes_cadastro (ip, date, id_cliente, cpf, nome_acao, executor) VALUES ('$ip', '$date', '$id', '$cpf_cliente', 'Atualização de dados profissionais autorizado com senha', 'Atendente - $operador CPF: $cpf_operador')");
	
	
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
  </table>
  <table width="1200" border="0">
    <tr>
      <td width="414"><h1><strong>Dados profissionais</strong></h1></td>
      <td width="405">&nbsp;</td>
      <td width="367">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><hr /></td>
    </tr>
    <tr>
      <td><strong>Situa&ccedil;&atilde;o profissional:</strong></td>
      <td><strong>N&ordm; do ben&eacute;ficio do INSS:</strong></td>
      <td><strong>Nome da empresa:</strong></td>
    </tr>
    <tr>
      <td><label for="sit_profissional"></label>
        <select name="sit_profissional" size="1" id="sit_profissional">
          <option value="<? echo $res['sit_profissional']; ?>"><? echo $res['sit_profissional']; ?></option>
          <option value=""></option>
          <option value="Funcion&aacute;rio Publico">Funcion&aacute;rio Publico</option>
          <option value="Aposentados e Pensionistas">Aposentados e Pensionistas</option>
          <option value="Aut&ocirc;nomo">Aut&ocirc;nomo</option>
          <option value="Funcion&aacute;rio de Empresa Privada">Funcion&aacute;rio de Empresa Privada</option>
          <option value="For&ccedil;as Armadas">For&ccedil;as Armadas</option>
          <option value="Militar">Militar</option>
          <option value="Proprit&aacute;rio">Proprit&aacute;rio</option>
        </select>
      </td>
      <td><span id="sprytextfield27">
        <input type="text" name="n_inss" id="n_inss" value="<? echo $res['n_inss']; ?>" />
</span></td>
      <td><span id="sprytextfield28">
        <input type="text" name="nome_empresa" id="nome_empresa" value="<? echo $res['nome_empresa']; ?>" />
</span></td>
</tr>
    <tr>
      <td><strong>Profiss&atilde;o:</strong></td>
      <td><strong>Telefone da empresa:</strong></td>
      <td><strong>Endere&ccedil;o sede da empresa:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield29">
        <input type="text" name="profissao" id="profissao" value="<? echo $res['profissao']; ?>" />
</span></td>
      <td><span id="sprytextfield30">
        <input type="text" name="tele_empresa" id="tele_empresa" value="<? echo $res['tele_empresa']; ?>" />
      </span></td>
      <td><span id="sprytextfield31">
        <input type="text" name="endereco_empresa" id="endereco_empresa2" value="<? echo $res['endereco_empresa']; ?>" />
</span></td>
    </tr>
    <tr>
      <td><strong>N&ordm; da sede da empresa:</strong></td>
      <td><strong>Bairro sede da empresa:</strong></td>
      <td><strong>Cidade sede da empresa:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield32">
        <input type="text" name="numero_da_empresa" id="numero_da_empresa2" value="<? echo $res['numero_da_empresa']; ?>" />
</span></td>
      <td><span id="sprytextfield33">
        <input type="text" name="bairro_empresa" id="bairro_empresa2" value="<? echo $res['bairro_empresa']; ?>" />
</span></td>
      <td><span id="sprytextfield34">
        <input type="text" name="cidade_empresa" id="cidade_empresa2" value="<? echo $res['cidade_empresa']; ?>" />
</span></td>
</tr>
    <tr>
      <td><strong>Estado sede da empresa:</strong></td>
      <td><strong>CNPJ:</strong></td>
      <td><strong>Data de adimiss&atilde;o (tempo de servi&ccedil;o):</strong></td>
    </tr>
    <tr>
      <td><select name="estado_sede" id="estado_sede">
        <option value="<? echo $res['estado_sede']; ?>"><? echo $res['estado_sede']; ?></option>
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
      <td><span id="sprytextfield35">
        <input type="text" name="cnpj" id="cnpj" value="<? echo $res['cnpj']; ?>" />
      </span></td>
      <td><span id="sprytextfield36">
        <input type="text" name="tempo_de_servico" id="tempo_de_servico" value="<? echo $res['tempo_de_servico']; ?>" />
</span></td>
    </tr>
    <tr>
      <td><strong>Renda mensal comprovada:</strong></td>
      <td><strong>Dia de pagamento:</strong></td>
      <td><strong>Outras rendas complementar neste trabalho:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield37">
        <input type="text" name="renda_mensal" id="renda_mensal" value="<? echo $res['renda_mensal']; ?>" />
</span></td>
      <td><span id="sprytextfield38">
        <input type="text" name="dia_pagamento" id="dia_pagamento" value="<? echo $res['dia_pagamento']; ?>" />
</span></td>
      <td><span id="sprytextfield39">
        <input type="text" name="rendas_complementar" id="rendas_complementar" value="<? echo $res['rendas_complementar']; ?>" />
</span></td>
</tr>
    <tr>
      <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 1:</strong></td>
      <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 2:</strong></td>
      <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 3:</strong></td>
    </tr>
    <tr>
      <td><span id="sprytextfield40">
        <input class="input1" type="text" name="nome_1" id="nome_1" value="<? echo $res['nome_1']; ?>" />
</span><span id="sprytextfield41">
<input class="input1" type="text" name="tele_refere_1" id="tele_refere_1" value="<? echo $res['tele_refere_1']; ?>" />
</span></td>
      <td><span id="sprytextfield42">
        <input class="input1" type="text" name="nome_2" id="nome_2" value="<? echo $res['nome_2']; ?>" />
</span><span id="sprytextfield43">
<input class="input1" type="text" name="tele_refere_2" id="tele_refere_2" value="<? echo $res['tele_refere_2']; ?>" />
</span></td>
      <td><span id="sprytextfield44">
        <input class="input1" type="text" name="tele_refere_3" id="tele_refere_3" value="<? echo $res['tele_refere_3']; ?>" />
</span><span id="sprytextfield45">
<input class="input1" type="text" name="nome_3" id="nome_3" value="<? echo $res['nome_3']; ?>" />
</span></td>
    </tr>
    <tr>
      <td><strong>Banco para refer&ecirc;ncia bancaria / Tipo de conta bancaria:</strong></td>
      <td><strong>Agencia / Conta Bancaria:</strong></td>
      <td><strong>Tempo de conta (cliente desde):</strong></td>
    </tr>
    <tr>
      <td><label for="tipo_de_conta"></label>
        <select class="select1_3" name="nome_banco">
          <option value="<? echo $res['nome_banco']; ?>"><? echo $res['nome_banco']; ?></option>
          <option value=""></option>
          <option value="Banco Bradesco">Banco Bradesco</option>
          <option value="Banco Itau S.A.">Banco Itau S.A.</option>
          <option value="Banco Santander Brasil S.A.">Banco Santander Brasil S.A.</option>
          <option value="Caixa Economica Federal">Caixa Economica Federal</option>
          <option value="Banco Citibank S.A.">Banco Citibank S.A.</option>
          <option value="Banco Hsbc Bank Brasil S.A">Banco Hsbc Bank Brasil S.A</option>
          <option value="Nossa Caixa - Nosso Banco S.A">Nossa Caixa - Nosso Banco S.A</option>
          <option value="Agrobanco Banco Comercial S.A.">Agrobanco Banco Comercial S.A.</option>
          <option value="Azteca">Azteca</option>
          <option value="Bacen - Tesouro Nacional">Bacen - Tesouro Nacional</option>
          <option value="Bancicred">Bancicred</option>
          <option value="Banco A.J. Renner S.A.">Banco A.J. Renner S.A.</option>
          <option value="Banco Abc Brasil S.A.">Banco Abc Brasil S.A.</option>
          <option value="Banco Abn Amro S.A.">Banco Abn Amro S.A.</option>
          <option value="Banco Adolpho Ol. E Assoc. S.A.">Banco Adolpho Ol. E Assoc. S.A.</option>
          <option value="Banco Agrimisa S.A.">Banco Agrimisa S.A.</option>
          <option value="Banco Alfa S.A.">Banco Alfa S.A.</option>
          <option value="Banco America Do Sul S.A.">Banco America Do Sul S.A.</option>
          <option value="Banco American Express S.A.">Banco American Express S.A.</option>
          <option value="Banco Aplicap S.A.">Banco Aplicap S.A.</option>
          <option value="Banco Araucaria S.A.">Banco Araucaria S.A.</option>
          <option value="Banco Arbi S.A.">Banco Arbi S.A.</option>
          <option value="Banco Atlantis S.A.">Banco Atlantis S.A.</option>
          <option value="Banco Autolatina S.A.">Banco Autolatina S.A.</option>
          <option value="Banco Auxiliar S.A.">Banco Auxiliar S.A.</option>
          <option value="Banco Axial S.A.">Banco Axial S.A.</option>
          <option value="Banco Bamge S.A">Banco Bamge S.A</option>
          <option value="Banco Bancred S.A.">Banco Bancred S.A.</option>
          <option value="Banco Banerj S.A.">Banco Banerj S.A.</option>
          <option value="Banco Banestes">Banco Banestes</option>
          <option value="Banco Banorte S.A">Banco Banorte S.A</option>
          <option value="Banco Barclays E Galicia S.A.">Banco Barclays E Galicia S.A.</option>
          <option value="Banco Battistella S.A.">Banco Battistella S.A.</option>
          <option value="Banco Bbm Com. C. Imob. C. Fin Inv. S.">Banco Bbm Com. C. Imob. C. Fin Inv. S.</option>
          <option value="Banco Bbm S.A">Banco Bbm S.A</option>
          <option value="Banco Bgn S.A.">Banco Bgn S.A.</option>
          <option value="Banco Bilbao Vizcaya Brasil S.A">Banco Bilbao Vizcaya Brasil S.A</option>
          <option value="Banco Bm&amp;F Servi&ccedil;os De Liquida&ccedil;&atilde;o Cust&oacute;dia S.A">Banco Bm&amp;F Servi&ccedil;os De Liquida&ccedil;&atilde;o Cust&oacute;dia S.A</option>
          <option value="Banco Bmc S.A.">Banco Bmc S.A.</option>
          <option value="Banco Bmd S.A.">Banco Bmd S.A.</option>
          <option value="Banco Bmg S.A.">Banco Bmg S.A.</option>
          <option value="Banco Bnp Paribas Brasil S.A.">Banco Bnp Paribas Brasil S.A.</option>
          <option value="Banco Boavista Interatlantico">Banco Boavista Interatlantico</option>
          <option value="Banco Boavista Interatl&Atilde;&cent;ntico S.A.">Banco Boavista Interatl&Atilde;&cent;ntico S.A.</option>
          <option value="Banco Boreal S.A.">Banco Boreal S.A.</option>
          <option value="Banco Bozano, Simonsen S.A.">Banco Bozano, Simonsen S.A.</option>
          <option value="Banco Brascan S.A.">Banco Brascan S.A.</option>
          <option value="Banco Braseg S.A.">Banco Braseg S.A.</option>
          <option value="Banco Brasileiro Iraquiano S.A">Banco Brasileiro Iraquiano S.A</option>
          <option value="Banco Brj S.A.">Banco Brj S.A.</option>
          <option value="Banco Bva S.A.">Banco Bva S.A.</option>
          <option value="Banco Cacique S.A.">Banco Cacique S.A.</option>
          <option value="Banco Calyon Brasil S.A.">Banco Calyon Brasil S.A.</option>
          <option value="Banco Cambial S.A">Banco Cambial S.A</option>
          <option value="Banco Capital S.A.">Banco Capital S.A.</option>
          <option value="Banco Cargill S.A.">Banco Cargill S.A.</option>
          <option value="Banco Ccf Brasil S.A.">Banco Ccf Brasil S.A.</option>
          <option value="Banco Cedula S.A.">Banco Cedula S.A.</option>
          <option value="Banco Cidade S.A.">Banco Cidade S.A.</option>
          <option value="Banco Cindam S.A.">Banco Cindam S.A.</option>
          <option value="Banco Classico S.A.">Banco Classico S.A.</option>
          <option value="Banco Columbia S.A.">Banco Columbia S.A.</option>
          <option value="Banco Comercial Uruguai S.A.">Banco Comercial Uruguai S.A.</option>
          <option value="Banco Coml Bancesa S.A.">Banco Coml Bancesa S.A.</option>
          <option value="Banco Coml De Sao Paulo S.A.">Banco Coml De Sao Paulo S.A.</option>
          <option value="Banco Coml Paraguayo S.A.">Banco Coml Paraguayo S.A.</option>
          <option value="Banco Cooperativo Sicredi S.A.">Banco Cooperativo Sicredi S.A.</option>
          <option value="Banco Cr2 S.A.">Banco Cr2 S.A.</option>
          <option value="Banco Credibanco S.A">Banco Credibanco S.A</option>
          <option value="Banco Credibel S.A.">Banco Credibel S.A.</option>
          <option value="Banco Crediplan S.A.">Banco Crediplan S.A.</option>
          <option value="Banco Credit Coml France S.A.">Banco Credit Coml France S.A.</option>
          <option value="Banco Credit Suisse (Brasil) Fbgsa">Banco Credit Suisse (Brasil) Fbgsa</option>
          <option value="Banco Credito Metropolitano S/">Banco Credito Metropolitano S/</option>
          <option value="Banco Crefisul S.A.">Banco Crefisul S.A.</option>
          <option value="Banco Criterium S. A.">Banco Criterium S. A.</option>
          <option value="Banco Cruzeiro Do Sul S.A.">Banco Cruzeiro Do Sul S.A.</option>
          <option value="Banco Das Nacoes S.A.">Banco Das Nacoes S.A.</option>
          <option value="Banco Daycoval S.A.">Banco Daycoval S.A.</option>
          <option value="Banco De Cred Real De Mg A">Banco De Cred Real De Mg A</option>
          <option value="Banco De Credito De Sao Paulo">Banco De Credito De Sao Paulo</option>
          <option value="Banco De Credito Nacional S.A.">Banco De Credito Nacional S.A.</option>
          <option value="Banco De Credito Real M.G. S.A">Banco De Credito Real M.G. S.A</option>
          <option value="Banco De Desen. Do Espirito Santo S.A.">Banco De Desen. Do Espirito Santo S.A.</option>
          <option value="Banco De Desen. Do Estado Da Bahia S.A.">Banco De Desen. Do Estado Da Bahia S.A.</option>
          <option value="Banco De Fin. Internacional S.A.">Banco De Fin. Internacional S.A.</option>
          <option value="Banco De La Nacion Argentina">Banco De La Nacion Argentina</option>
          <option value="Banco De La Prov. De Buenos Aires">Banco De La Prov. De Buenos Aires</option>
          <option value="Banco De La Rep. Or. Del Uruguay">Banco De La Rep. Or. Del Uruguay</option>
          <option value="Banco De Roraima S.A">Banco De Roraima S.A</option>
          <option value="Banco Destak S.A.">Banco Destak S.A.</option>
          <option value="Banco Dibens S.A.">Banco Dibens S.A.</option>
          <option value="Banco Digibanco S.A.">Banco Digibanco S.A.</option>
          <option value="Banco Dimensao S.A.">Banco Dimensao S.A.</option>
          <option value="Banco do Brasil">Banco do Brasil</option>
          <option value="Banco Do Com. E Ind De Sp S.A.">Banco Do Com. E Ind De Sp S.A.</option>
          <option value="Banco Do Est. Do Rio Grande Sul">Banco Do Est. Do Rio Grande Sul</option>
          <option value="Banco Do Est. Grande Norte S.A">Banco Do Est. Grande Norte S.A</option>
          <option value="Banco Do Estado Amapa S.A.">Banco Do Estado Amapa S.A.</option>
          <option value="Banco Do Estado De Alagoas S.A">Banco Do Estado De Alagoas S.A</option>
          <option value="Banco Do Estado De Goias S.A. (Beg)">Banco Do Estado De Goias S.A. (Beg)</option>
          <option value="Banco Do Estado De Rondonia S.">Banco Do Estado De Rondonia S.</option>
          <option value="Banco Do Estado De Roraima S.A">Banco Do Estado De Roraima S.A</option>
          <option value="Banco Do Estado De Sergipe S.A">Banco Do Estado De Sergipe S.A</option>
          <option value="Banco Do Estado Do Acre S.A.">Banco Do Estado Do Acre S.A.</option>
          <option value="Banco Do Estado Do Ceara S.A.">Banco Do Estado Do Ceara S.A.</option>
          <option value="Banco Do Estado Do Maranhao S.">Banco Do Estado Do Maranhao S.</option>
          <option value="Banco Do Estado Do Para S.A.">Banco Do Estado Do Para S.A.</option>
          <option value="Banco Do Estado Do Parana S.A.">Banco Do Estado Do Parana S.A.</option>
          <option value="Banco Do Estado Do Piaui S.A.">Banco Do Estado Do Piaui S.A.</option>
          <option value="Banco Do Nordeste Do Brasil S.">Banco Do Nordeste Do Brasil S.</option>
          <option value="Banco Do Progresso S.A.">Banco Do Progresso S.A.</option>
          <option value="Banco Dracma S.A.">Banco Dracma S.A.</option>
          <option value="Banco Economico S.A.">Banco Economico S.A.</option>
          <option value="Banco Empresarial S.A.">Banco Empresarial S.A.</option>
          <option value="Banco Equatorial S.A.">Banco Equatorial S.A.</option>
          <option value="Banco Euroinvest S.A. Eurobanc">Banco Euroinvest S.A. Eurobanc</option>
          <option value="Banco Exprinter Losan S.A.">Banco Exprinter Losan S.A.</option>
          <option value="Banco Exterior De Espana S.A.">Banco Exterior De Espana S.A.</option>
          <option value="Banco F.Barreto S.A.">Banco F.Barreto S.A.</option>
          <option value="Banco Fator S.A.">Banco Fator S.A.</option>
          <option value="Banco Fenicia S.A.">Banco Fenicia S.A.</option>
          <option value="Banco Fiat S.A.">Banco Fiat S.A.</option>
          <option value="Banco Fibra S.A.">Banco Fibra S.A.</option>
          <option value="Banco Ficrisa Axelrud S.A.">Banco Ficrisa Axelrud S.A.</option>
          <option value="Banco Ficsa S.A.">Banco Ficsa S.A.</option>
          <option value="Banco Financial Port.">Banco Financial Port.</option>
          <option value="Banco Financial Portugues">Banco Financial Portugues</option>
          <option value="Banco Finansinos S. A.">Banco Finansinos S. A.</option>
          <option value="Banco Finasa S.A.">Banco Finasa S.A.</option>
          <option value="Banco Fininvest S.A.">Banco Fininvest S.A.</option>
          <option value="Banco Fital S.A.">Banco Fital S.A.</option>
          <option value="Banco Fleming Graphus S.A.">Banco Fleming Graphus S.A.</option>
          <option value="Banco Fonte Cindam S.A.">Banco Fonte Cindam S.A.</option>
          <option value="Banco Frances E Brasileiro S.A">Banco Frances E Brasileiro S.A</option>
          <option value="Banco Frances E Brasileiro S.A.">Banco Frances E Brasileiro S.A.</option>
          <option value="Banco Frances Inter. Brasil S.A">Banco Frances Inter. Brasil S.A</option>
          <option value="Banco Garavelo S.A.">Banco Garavelo S.A.</option>
          <option value="Banco Ge Capital S.A">Banco Ge Capital S.A</option>
          <option value="Banco General Motors S.A">Banco General Motors S.A</option>
          <option value="Banco Gerdau S.A.">Banco Gerdau S.A.</option>
          <option value="Banco Gnpp S.A.">Banco Gnpp S.A.</option>
          <option value="Banco Grande Rio S.A.">Banco Grande Rio S.A.</option>
          <option value="Banco Guanabara S.A.">Banco Guanabara S.A.</option>
          <option value="Banco Gulfinvest S.A.">Banco Gulfinvest S.A.</option>
          <option value="Banco Hercules S.A.">Banco Hercules S.A.</option>
          <option value="Banco Hexabanco S.A.">Banco Hexabanco S.A.</option>
          <option value="Banco Hnf S.A.">Banco Hnf S.A.</option>
          <option value="Banco Ibi S.A. Banco M&uacute;ltiplo">Banco Ibi S.A. Banco M&uacute;ltiplo</option>
          <option value="Banco Icatu S.A.">Banco Icatu S.A.</option>
          <option value="Banco Induscred S.A.">Banco Induscred S.A.</option>
          <option value="Banco Industrial Do Brasil S.">Banco Industrial Do Brasil S.</option>
          <option value="Banco Industrial E Comercial S">Banco Industrial E Comercial S</option>
          <option value="Banco Indusval S.A.">Banco Indusval S.A.</option>
          <option value="Banco Inter-Atlantico S.A.">Banco Inter-Atlantico S.A.</option>
          <option value="Banco Intercap S.A.">Banco Intercap S.A.</option>
          <option value="Banco Interfinance S.A.">Banco Interfinance S.A.</option>
          <option value="Banco Interior De Sao Paulo S.A">Banco Interior De Sao Paulo S.A</option>
          <option value="Banco Interpacifico S.A.">Banco Interpacifico S.A.</option>
          <option value="Banco Interpart S.A.">Banco Interpart S.A.</option>
          <option value="Banco Investcorp S.A.">Banco Investcorp S.A.</option>
          <option value="Banco Investcred Unibanco S.A.">Banco Investcred Unibanco S.A.</option>
          <option value="Banco Investor S.A.">Banco Investor S.A.</option>
          <option value="Banco Iochpe S.A.">Banco Iochpe S.A.</option>
          <option value="Banco Itabanco S.A.">Banco Itabanco S.A.</option>
          <option value="Banco Itamarati S.A.">Banco Itamarati S.A.</option>
          <option value="Banco Ita&uacute; Bba S.A.">Banco Ita&uacute; Bba S.A.</option>
          <option value="Banco J. P. Morgan S.A.">Banco J. P. Morgan S.A.</option>
          <option value="Banco J. Safra S.A.">Banco J. Safra S.A.</option>
          <option value="Banco John Deere S.A. - Bco Agroinvest S.A.">Banco John Deere S.A. - Bco Agroinvest S.A.</option>
          <option value="Banco Kdb S.A.">Banco Kdb S.A.</option>
          <option value="Banco Keb Do Brasil S.A.">Banco Keb Do Brasil S.A.</option>
          <option value="Banco Lavra S.A.">Banco Lavra S.A.</option>
          <option value="Banco Liberal S.A.">Banco Liberal S.A.</option>
          <option value="Banco Luso Brasileiro S.A.">Banco Luso Brasileiro S.A.</option>
          <option value="Banco Maisonnave S.A">Banco Maisonnave S.A</option>
          <option value="Banco Marka S.A.">Banco Marka S.A.</option>
          <option value="Banco Martinelli S.A.">Banco Martinelli S.A.</option>
          <option value="Banco Matone S.A.">Banco Matone S.A.</option>
          <option value="Banco Matrix S.A.">Banco Matrix S.A.</option>
          <option value="Banco Maxinvest S.A.">Banco Maxinvest S.A.</option>
          <option value="Banco Mercantil Do Brasil S.A.">Banco Mercantil Do Brasil S.A.</option>
          <option value="Banco Mercantil Finasa S.A - S.P">Banco Mercantil Finasa S.A - S.P</option>
          <option value="Banco Mercantil S.A.">Banco Mercantil S.A.</option>
          <option value="Banco Meridional S.A">Banco Meridional S.A</option>
          <option value="Banco Merrill Lynch S.A.">Banco Merrill Lynch S.A.</option>
          <option value="Banco Minas S.A.">Banco Minas S.A.</option>
          <option value="Banco Misasi S.A.">Banco Misasi S.A.</option>
          <option value="Banco Mitsubishi Brasileiro S.A">Banco Mitsubishi Brasileiro S.A</option>
          <option value="Banco Modal S.A.">Banco Modal S.A.</option>
          <option value="Banco Morada S.A.">Banco Morada S.A.</option>
          <option value="Banco Morgan Stanley Dean Witter S.A.">Banco Morgan Stanley Dean Witter S.A.</option>
          <option value="Banco Multiplic S.A.">Banco Multiplic S.A.</option>
          <option value="Banco Nac De Credito Coop. S.A.">Banco Nac De Credito Coop. S.A.</option>
          <option value="Banco Nac Desenv Econ Social S.A">Banco Nac Desenv Econ Social S.A</option>
          <option value="Banco Nacional S.A.">Banco Nacional S.A.</option>
          <option value="Banco Norchem S.A.">Banco Norchem S.A.</option>
          <option value="Banco Ok S.A.">Banco Ok S.A.</option>
          <option value="Banco Open S.A.">Banco Open S.A.</option>
          <option value="Banco Operador S.A.">Banco Operador S.A.</option>
          <option value="Banco Opportunity S.A.">Banco Opportunity S.A.</option>
          <option value="Banco Ourinvest S.A.">Banco Ourinvest S.A.</option>
          <option value="Banco Pactual S.A.">Banco Pactual S.A.</option>
          <option value="Banco Panamericano S.A.">Banco Panamericano S.A.</option>
          <option value="Banco Patente S.A.">Banco Patente S.A.</option>
          <option value="Banco Paulista S.A.">Banco Paulista S.A.</option>
          <option value="Banco Pebb S.A.">Banco Pebb S.A.</option>
          <option value="Banco Pecunia S.A.">Banco Pecunia S.A.</option>
          <option value="Banco Performance S.A">Banco Performance S.A</option>
          <option value="Banco Pine S.A.">Banco Pine S.A.</option>
          <option value="Banco Planibanc S.A.">Banco Planibanc S.A.</option>
          <option value="Banco Pontual S.A.">Banco Pontual S.A.</option>
          <option value="Banco Porto Real S.A.">Banco Porto Real S.A.</option>
          <option value="Banco Porto Seguro S.A.">Banco Porto Seguro S.A.</option>
          <option value="Banco Pottencial S.A.">Banco Pottencial S.A.</option>
          <option value="Banco Prime S.A.">Banco Prime S.A.</option>
          <option value="Banco Primus S.A.">Banco Primus S.A.</option>
          <option value="Banco Prosper S.A.">Banco Prosper S.A.</option>
          <option value="Banco Rabobank Internat Br S.A">Banco Rabobank Internat Br S.A</option>
          <option value="Banco Real S.A.">Banco Real S.A.</option>
          <option value="Banco Regional Malcon S.A.">Banco Regional Malcon S.A.</option>
          <option value="Banco Rendimento S.A.">Banco Rendimento S.A.</option>
          <option value="Banco Republic Nat Of N.Y. Br S.A">Banco Republic Nat Of N.Y. Br S.A</option>
          <option value="Banco Ribeirao Preto S.A.">Banco Ribeirao Preto S.A.</option>
          <option value="Banco Rosa S.A.">Banco Rosa S.A.</option>
          <option value="Banco Rural Mais S.A.">Banco Rural Mais S.A.</option>
          <option value="Banco Rural S.A.">Banco Rural S.A.</option>
          <option value="Banco Safra S.A.">Banco Safra S.A.</option>
          <option value="Banco Santander De Negocios S.">Banco Santander De Negocios S.</option>
          <option value="Banco Santos Neves S.A.">Banco Santos Neves S.A.</option>
          <option value="Banco Santos S. A.">Banco Santos S. A.</option>
          <option value="Banco Sao Jorge S.A.">Banco Sao Jorge S.A.</option>
          <option value="Banco Schahin S.A">Banco Schahin S.A</option>
          <option value="Banco Semear S.A. - Bco Emblema S.A.">Banco Semear S.A. - Bco Emblema S.A.</option>
          <option value="Banco Simples S.A.">Banco Simples S.A.</option>
          <option value="Banco Sistema S.A.">Banco Sistema S.A.</option>
          <option value="Banco Soci&eacute;t&eacute; G&eacute;n&eacute;rale Brasil S.A.">Banco Soci&eacute;t&eacute; G&eacute;n&eacute;rale Brasil S.A.</option>
          <option value="Banco Sofisa S.A.">Banco Sofisa S.A.</option>
          <option value="Banco Stock Maxima S.A">Banco Stock Maxima S.A</option>
          <option value="Banco Sudameris Brasil S.A.">Banco Sudameris Brasil S.A.</option>
          <option value="Banco Sul America S.A.">Banco Sul America S.A.</option>
          <option value="Banco Sumitomo Brasileiro S.A.">Banco Sumitomo Brasileiro S.A.</option>
          <option value="Banco Tecnicorp S.A.">Banco Tecnicorp S.A.</option>
          <option value="Banco Tendencia S.A.">Banco Tendencia S.A.</option>
          <option value="Banco Theca S.A.">Banco Theca S.A.</option>
          <option value="Banco Tokio Mitsubishi Brasil">Banco Tokio Mitsubishi Brasil</option>
          <option value="Banco Triangulo S.A.">Banco Triangulo S.A.</option>
          <option value="Banco Ubs S.A.">Banco Ubs S.A.</option>
          <option value="Banco Union, S.A.C.A.">Banco Union, S.A.C.A.</option>
          <option value="Banco United S.A.">Banco United S.A.</option>
          <option value="Banco Universal S.A.">Banco Universal S.A.</option>
          <option value="Banco Varig S.A.">Banco Varig S.A.</option>
          <option value="Banco Vega S.A.">Banco Vega S.A.</option>
          <option value="Banco Vetor S.A.">Banco Vetor S.A.</option>
          <option value="Banco Votorantim S.A.">Banco Votorantim S.A.</option>
          <option value="Banco Vr S.A.">Banco Vr S.A.</option>
          <option value="Banco Wachovia S.A.">Banco Wachovia S.A.</option>
          <option value="Banco Westlb Do Brasil S.A.">Banco Westlb Do Brasil S.A.</option>
          <option value="Bancorp - Banco Com. De Inv. S.A.">Bancorp - Banco Com. De Inv. S.A.</option>
          <option value="Bandefe">Bandefe</option>
          <option value="Bando Do Estado Da Bahia S.A.">Bando Do Estado Da Bahia S.A.</option>
          <option value="Bando Do Estado De Mato Grosso">Bando Do Estado De Mato Grosso</option>
          <option value="Bando Do Estado De Sp Banespa">Bando Do Estado De Sp Banespa</option>
          <option value="Bando Do Estado Do Amazonas">Bando Do Estado Do Amazonas</option>
          <option value="Bando Do Estado Santa Catarina">Bando Do Estado Santa Catarina</option>
          <option value="Banestes">Banestes</option>
          <option value="Banfort - Banco Fortaleza S.A.">Banfort - Banco Fortaleza S.A.</option>
          <option value="Bankboston (Itaubank) S.A.">Bankboston (Itaubank) S.A.</option>
          <option value="Bankboston N.A.">Bankboston N.A.</option>
          <option value="Bankpar Banco Multiplo S.A..">Bankpar Banco Multiplo S.A..</option>
          <option value="Bb Banco Popular Do Brasil S.A.">Bb Banco Popular Do Brasil S.A.</option>
          <option value="Bbs - Banco Bonsucesso S.A.">Bbs - Banco Bonsucesso S.A.</option>
          <option value="Bcam Confidence">Bcam Confidence</option>
          <option value="Bco Bnl Do Brasil S A">Bco Bnl Do Brasil S A</option>
          <option value="Bco Central Do Brasil">Bco Central Do Brasil</option>
          <option value="Bco Da Amazonia S A">Bco Da Amazonia S A</option>
          <option value="Bco De Desen De Minas Gerais S A">Bco De Desen De Minas Gerais S A</option>
          <option value="Bco Do Estado De Pernambuco S A">Bco Do Estado De Pernambuco S A</option>
          <option value="Bco Santander Antigo Noroeste S A">Bco Santander Antigo Noroeste S A</option>
          <option value="Bcr - Banco De Credito Real S.A.">Bcr - Banco De Credito Real S.A.</option>
          <option value="Bcr-Banco De Cres. Real S.A">Bcr-Banco De Cres. Real S.A</option>
          <option value="Bfc Banco S.A.">Bfc Banco S.A.</option>
          <option value="Bi Bes Espirito Santo">Bi Bes Espirito Santo</option>
          <option value="Bi Standard">Bi Standard</option>
          <option value="Big S.A. - Banco Irmaos Guimaraes">Big S.A. - Banco Irmaos Guimaraes</option>
          <option value="Bpn Brasil Banco M&uacute;tiplo S.A.">Bpn Brasil Banco M&uacute;tiplo S.A.</option>
          <option value="Brasbanco S.A. - Banco Coml">Brasbanco S.A. - Banco Coml</option>
          <option value="Brb - Banco De Brasilia S.A.">Brb - Banco De Brasilia S.A.</option>
          <option value="Caixa Economica Est. Goias">Caixa Economica Est. Goias</option>
          <option value="Caixa Economica Est. Rio Gde Sul">Caixa Economica Est. Rio Gde Sul</option>
          <option value="Caixa Economica Minas Gerais">Caixa Economica Minas Gerais</option>
          <option value="Cc Regiao Da Mogiana">Cc Regiao Da Mogiana</option>
          <option value="Cc Unicred Central Rs">Cc Unicred Central Rs</option>
          <option value="Cc Unicred Central Santa Catarina">Cc Unicred Central Santa Catarina</option>
          <option value="Centro Hispano Banco">Centro Hispano Banco</option>
          <option value="China Brasil">China Brasil</option>
          <option value="Citibank N.A.">Citibank N.A.</option>
          <option value="Concordia">Concordia</option>
          <option value="Deutsche Bank S. A. - Banco Al">Deutsche Bank S. A. - Banco Al</option>
          <option value="Dresdner Bank Brasil S.A B. Mult">Dresdner Bank Brasil S.A B. Mult</option>
          <option value="Dresdner Bank L. Aktiengesellchaft">Dresdner Bank L. Aktiengesellchaft</option>
          <option value="Dtvm Oliveira Trust">Dtvm Oliveira Trust</option>
          <option value="Dtvm Renascenca">Dtvm Renascenca</option>
          <option value="Goldman Sachs Do Brasil Banco M&uacute;ltiplo S.A.">Goldman Sachs Do Brasil Banco M&uacute;ltiplo S.A.</option>
          <option value="Hipercard Banco M&uacute;ltiplo S.A.">Hipercard Banco M&uacute;ltiplo S.A.</option>
          <option value="Ing Bank N.V.">Ing Bank N.V.</option>
          <option value="Intermedium">Intermedium</option>
          <option value="J Safra Sa">J Safra Sa</option>
          <option value="Lemon Bank Banco M&uacute;ltiplo S.A.">Lemon Bank Banco M&uacute;ltiplo S.A.</option>
          <option value="Lloyds Bank Plc">Lloyds Bank Plc</option>
          <option value="Milbanco S.A.">Milbanco S.A.</option>
          <option value="Morgan Guaranty Trust Company">Morgan Guaranty Trust Company</option>
          <option value="Multi Banco S.A.">Multi Banco S.A.</option>
          <option value="Paraiban Bando Do Estado Da Paraiba">Paraiban Bando Do Estado Da Paraiba</option>
          <option value="Parana Banco S.A.">Parana Banco S.A.</option>
          <option value="Randon">Randon</option>
          <option value="Sc Bt Associados">Sc Bt Associados</option>
          <option value="Sc Confidence">Sc Confidence</option>
          <option value="Sc Link">Sc Link</option>
          <option value="Sc Planner">Sc Planner</option>
          <option value="Sc Senso">Sc Senso</option>
          <option value="Sc Souza Barros">Sc Souza Barros</option>
          <option value="Scfi Oboe">Scfi Oboe</option>
          <option value="Scm Polocred">Scm Polocred</option>
          <option value="Sicoob">Sicoob</option>
          <option value="Unibanco - Uniao Bcos Brasileiros">Unibanco - Uniao Bcos Brasileiros</option>
          <option value="Unicard Banco M&uacute;ltiplo S.A. - Bco Bandeirantes">Unicard Banco M&uacute;ltiplo S.A. - Bco Bandeirantes</option>
          <option value="Unicred">Unicred</option>
          <option value="Banco Brasileiro Comercial">Banco Brasileiro Comercial</option>
          <option value="Banco BRJ S.A .">Banco BRJ S.A .</option>
          <option value="Banco das Nacoes">Banco das Nacoes</option>
          <option value="Banco de Credito Comercial">Banco de Credito Comercial</option>
          <option value="Banco do Comercio">Banco do Comercio</option>
          <option value="Banco Financial">Banco Financial</option>
          <option value="Banco Habitasul S.A.">Banco Habitasul S.A.</option>
          <option value="Banco Hispano Americano">Banco Hispano Americano</option>
          <option value="Banco Industrial Pernambuco">Banco Industrial Pernambuco</option>
          <option value="Banco Mineiro">Banco Mineiro</option>
          <option value="Banco Pinto de Magalhaes">Banco Pinto de Magalhaes</option>
          <option value="Banco Real de Sao Paulo">Banco Real de Sao Paulo</option>
          <option value="Banco Regional S.A.">Banco Regional S.A.</option>
          <option value="Banco Residencia S.A.">Banco Residencia S.A.</option>
          <option value="Banco Savena">Banco Savena</option>
          <option value="Banco Sibisa">Banco Sibisa</option>
          <option value="Banco Sul Brasileiro S.A">Banco Sul Brasileiro S.A</option>
          <option value="Banco Abb S/A">Banco Abb S/A</option>
          <option value="BPA B. Pao de Acucar">BPA B. Pao de Acucar</option>
          <option value="Caixa Ec do Est de SC">Caixa Ec do Est de SC</option>
        </select>
        <select class="select1_3" name="tipo_de_conta" size="1" id="tipo_de_conta">
          <option value="Conta Corrente">Conta Corrente</option>
          <option value="Conta Poupan&ccedil;a">Conta Poupan&ccedil;a</option>
          <option value="Conta Universit&aacute;ria">Conta Universit&aacute;ria</option>
          <option value="Conta Sal&aacute;rio">Conta Sal&aacute;rio</option>
          <option value="Conta Pessoa Jur&iacute;dica">Conta Pessoa Jur&iacute;dica</option>
        </select></td>
      <td><span id="sprytextfield46">
        <input class="input1" type="text" name="agencia" id="agencia" value="<? echo $res['agencia']; ?>" />
</span><span id="sprytextfield47">
        <input class="input1" type="text" name="conta_bancaria" id="conta_bancaria2" value="<? echo $res['conta_bancaria']; ?>" />
</span></td>
      <td><span id="sprytextfield48">
        <input type="text" name="tempo_de_conta" id="tempo_de_conta" value="<? echo $res['cliente_desde']; ?>" />
</span></td>
      </tr>
    <tr>
      <td><strong>Valor de outras rendas:</strong></td>
      <td><strong>Origem de outras rendas:</strong></td>
      <td><strong>Forma de comprova&ccedil;&atilde;o de outras rendas:</strong></td>
    </tr>
    <tr>
      <td>
        <label for="outra_renda"></label>
        <span id="sprytextfield49">
        <input type="text" name="outra_renda" id="outra_renda" value="<? echo $res['outra_renda']; ?>" />
</span></td>
      <td>
        <label for="origem_outra_renda"></label>
        <span id="sprytextfield50">
        <input type="text" name="origem_outra_renda" id="origem_outra_renda" value="<? echo $res['origem_outra_renda']; ?>" />
</span></td>
      <td>
        <label for="comprovacao_renda"></label>
        <span id="sprytextfield51">
        <input type="text" name="comprovacao_renda" id="comprovacao_renda" value="<? echo $res['comprovacao_renda']; ?>" />
</span></td>
    </tr>
    <tr>
      <td><strong>N&ordm; de dependentes:</strong></td>
      <td><strong>N&uacute;mero da CTPS / Data de emiss&atilde;o / UF de expedi&ccedil;&atilde;o:</strong></td>
      <td><strong>N&uacute;mero / s&eacute;rie da CTPS / Local de emiss&atilde;o:</strong></td>
    </tr>
    <tr>
      <td><label for="dependentes"></label>
        <span id="sprytextfield52">
          <input type="text" name="dependentes" id="dependentes" value="<? echo $res['dependentes']; ?>" />
</span></td>
      <td><span id="sprytextfield53">
        <input class="input3_2" type="text" name="ctps" id="ctps" value="<? echo $res['ctps']; ?>" />
        </span><span id="sprytextfield59">
          <input class="input3_2" type="text" name="data_ctps" id="ctps2" value="<? echo $res['data_ctps']; ?>" />
          </span>
        <select class="select1_2" name="uf_emissor_ctps" id="estado_sede">
          <option value="<? echo $res['uf_emissor_ctps']; ?>"><? echo $res['uf_emissor_ctps']; ?></option>
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
      <td><span id="sprytextfield54">
        <input class="input3_2" type="text" name="n_ctps" id="n_ctps" value="<? echo $res['n_ctps']; ?>" />
  </span><span id="sprytextfield55">
  <input class="input3_2" type="text" name="seire_ctps" id="seire_ctps" value="<? echo $res['seire_ctps']; ?>" />
</span><input class="input3_2_2" type="text" name="local_emissao_ctps" id="local_emissao_ctps" value="<? echo $res['local_emissao_ctps']; ?>" /></td>
    </tr>
    <tr>
      <td><input class="input3" type="submit" name="send" id="send" value="Cadastrar" /></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>    
  </table>
  <? } ?>
</form>
<? } ?>
</div><!-- box_cadastro_de_cliente -->
<script type="text/javascript">
var sprytextfield27 = new Spry.Widget.ValidationTextField("sprytextfield27", "none", {isRequired:false});
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28", "none", {isRequired:false});
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29", "none", {isRequired:false});
var sprytextfield30 = new Spry.Widget.ValidationTextField("sprytextfield30", "phone_number", {isRequired:false, format:"phone_custom", useCharacterMasking:true, pattern:"(00) 0000.0000"});
var sprytextfield31 = new Spry.Widget.ValidationTextField("sprytextfield31", "none", {isRequired:false});
var sprytextfield32 = new Spry.Widget.ValidationTextField("sprytextfield32", "none", {isRequired:false});
var sprytextfield33 = new Spry.Widget.ValidationTextField("sprytextfield33", "none", {isRequired:false});
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34", "none", {isRequired:false});
var sprytextfield35 = new Spry.Widget.ValidationTextField("sprytextfield35", "zip_code", {isRequired:false, format:"zip_custom", pattern:"00.000.000/0000-00", useCharacterMasking:true});
var sprytextfield36 = new Spry.Widget.ValidationTextField("sprytextfield36", "none", {isRequired:false});
var sprytextfield37 = new Spry.Widget.ValidationTextField("sprytextfield37", "none", {isRequired:false});
var sprytextfield38 = new Spry.Widget.ValidationTextField("sprytextfield38", "none", {isRequired:false});
var sprytextfield39 = new Spry.Widget.ValidationTextField("sprytextfield39", "none", {isRequired:false});
var sprytextfield40 = new Spry.Widget.ValidationTextField("sprytextfield40", "none", {isRequired:false});
var sprytextfield41 = new Spry.Widget.ValidationTextField("sprytextfield41", "phone_number", {isRequired:false, format:"phone_custom", useCharacterMasking:true, pattern:"(00) 0000.0000"});
var sprytextfield42 = new Spry.Widget.ValidationTextField("sprytextfield42", "none", {isRequired:false});
var sprytextfield43 = new Spry.Widget.ValidationTextField("sprytextfield43", "phone_number", {isRequired:false, format:"phone_custom", useCharacterMasking:true, pattern:"(00) 0000.0000"});
var sprytextfield44 = new Spry.Widget.ValidationTextField("sprytextfield44", "none", {isRequired:false});
var sprytextfield45 = new Spry.Widget.ValidationTextField("sprytextfield45", "phone_number", {isRequired:false, format:"phone_custom", pattern:"(00) 0000.0000", useCharacterMasking:true});
var sprytextfield46 = new Spry.Widget.ValidationTextField("sprytextfield46", "none", {isRequired:false});
var sprytextfield47 = new Spry.Widget.ValidationTextField("sprytextfield47", "none", {isRequired:false});
var sprytextfield48 = new Spry.Widget.ValidationTextField("sprytextfield48", "none", {isRequired:false});
var sprytextfield49 = new Spry.Widget.ValidationTextField("sprytextfield49", "none", {isRequired:false});
var sprytextfield50 = new Spry.Widget.ValidationTextField("sprytextfield50", "none", {isRequired:false});
var sprytextfield51 = new Spry.Widget.ValidationTextField("sprytextfield51", "none", {isRequired:false});
var sprytextfield52 = new Spry.Widget.ValidationTextField("sprytextfield52", "none", {isRequired:false});
var sprytextfield54 = new Spry.Widget.ValidationTextField("sprytextfield54", "none", {isRequired:false});
var sprytextfield55 = new Spry.Widget.ValidationTextField("sprytextfield55", "none", {isRequired:false});
var sprytextfield59 = new Spry.Widget.ValidationTextField("sprytextfield59", "date", {isRequired:false, format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield53 = new Spry.Widget.ValidationTextField("sprytextfield53", "custom", {isRequired:false, useCharacterMasking:true, pattern:"000.00000.00-0"});
</script>
</body>
</html>