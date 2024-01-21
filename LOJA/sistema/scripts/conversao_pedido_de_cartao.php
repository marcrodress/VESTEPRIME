<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/carteira_assinada_conversao_para_pdf.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<?
require "../../conexao.php";
$cpf = $_POST['cpf'];

$sql = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
	while($res_1 = mysql_fetch_array($sql)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="975" border="0">
  <tr>
    <td width="409"><strong>Corretor:</strong> Marcos Rodrigues de Oliveira</td>
    <td width="265"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="299" colspan="2"><strong>Telefone:</strong> (85) 4042.2634/8932.1649</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Formul&aacute;rio de preenchimento de prop&oacute;sta de cart&atilde;o de cr&eacute;dito:<br>
      <strong>N&ordm; da prop&oacute;sta: </strong>
      <? echo $_POST['n_proposta']; ?><br />
      </td>
  </tr>
  <tr>
    <td colspan="4"><table width="961" border="0">
      <tr>
        <td colspan="3"><h1>Dados pessoais</h1></td>
      </tr>
      <tr>
        <td colspan="3"><hr /></td>
      </tr>
      <tr>
        <td width="290"><strong>Nome:</strong></td>
        <td width="287"><strong>RG:</strong></td>
        <td width="368"><strong>Data de expedi&ccedil;&atilde;o / UF de expedi&ccedil;&atilde;o / Org&atilde;o emissor:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['nome']; ?></h3></td>
        <td><h3><? echo $res_1['rg']; ?></h3></td>
        <td><h3><? echo $res_1['date_exp']; ?> / <? echo $res_1['uf_rg']; ?> / <? echo $res_1['orgao_expeditor']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>CPF:</strong></td>
        <td><strong>Nascimento:</strong></td>
        <td><strong>Estado civil:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['cpf']; ?></h3></td>
        <td><h3><? echo $res_1['nascimento']; ?></h3></td>
        <td><h3><? echo $res_1['estado_civil']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Nome da c&ocirc;njuge:</strong></td>
        <td><strong>Sexo:</strong></td>
        <td><strong>Nome da m&atilde;e:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['conjuge']; ?></h3></td>
        <td><h3><? echo $res_1['nascimento']; ?></h3></td>
        <td><h3><? echo $res_1['mae']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Nome do pai:</strong></td>
        <td><strong>Escolaridade:</strong></td>
        <td><strong>Nacionalidade:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['pai']; ?></h3></td>
        <td><h3><? echo $res_1['escolaridade']; ?></h3></td>
        <td><h3><? echo $res_1['nacionalidade']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Telefone resid&ecirc;ncial:</strong></td>
        <td><strong>Telefone celular 1:</strong></td>
        <td><strong>Telefone celular 2:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['tele_residencial']; ?></h3></td>
        <td><h3><? echo $res_1['celular_1']; ?></h3></td>
        <td><h3><? echo $res_1['celular_2']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Naturalidade:</strong></td>
        <td><strong>Tipo de moradia:</strong></td>
        <td><strong>Endereco:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['naturalidade']; ?></h3></td>
        <td><h3><? echo $res_1['moradia']; ?></h3></td>
        <td><h3><? echo $res_1['endereco']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>N&ordm; da resid&ecirc;ncia:</strong></td>
        <td><strong>Cep:</strong></td>
        <td><strong>Bairro:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['n_residencia']; ?></h3></td>
        <td><h3><? echo $res_1['cep']; ?></h3></td>
        <td><h3><? echo $res_1['bairro']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Cidade:</strong></td>
        <td><strong>Estado:</strong></td>
        <td><strong>Tempo de moradia: (m&ecirc;s e ano)</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['cidade']; ?></h3></td>
        <td><h3><? echo $res_1['estado']; ?></h3></td>
        <td><h3><? echo $res_1['ano_moradia']; ?>/<? echo $res_1['mes_moradia']; ?></h3></td>
      </tr>
      <tr>
        <td colspan="3"><h1>Dados profissionais</h1></td>
      </tr>
      <tr>
        <td colspan="3"><hr /></td>
      </tr>
      <tr>
        <td><strong>Situa&ccedil;&atilde;o profissional:</strong></td>
        <td><strong>N&ordm; de dependentes:</strong></td>
        <td><strong>Nome da empresa:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['sit_profissional']; ?></h3></td>
        <td><? echo $res_1['dependentes']; ?></td>
        <td><h3><? echo $res_1['nome_empresa']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Profiss&atilde;o:</strong></td>
        <td><strong>Telefone da empresa:</strong></td>
        <td><strong>Endere&ccedil;o:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['profissao']; ?></h3></td>
        <td><h3><? echo $res_1['tele_empresa']; ?></h3></td>
        <td><h3><? echo $res_1['endereco_empresa']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>N&ordm; da sede da empresa:</strong></td>
        <td><strong>Bairro sede da empresa:</strong></td>
        <td><strong>Cidade sede da empresa:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['numero_da_empresa']; ?></h3></td>
        <td><h3><? echo $res_1['bairro_empresa']; ?></h3></td>
        <td><h3><? echo $res_1['cidade_empresa']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Estado sede da empresa:</strong></td>
        <td><strong>CNPJ:</strong></td>
        <td><strong>Data de admiss&atilde;o:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['estado_sede']; ?></h3></td>
        <td><h3><? echo $res_1['cnpj']; ?></h3></td>
        <td><h3><? echo $res_1['tempo_de_servico']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Renda mensal comprovada</strong></td>
        <td><strong>Dia de pagamento:</strong></td>
        <td><strong> E-mail:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['renda_mensal']; ?></h3></td>
        <td><h3><? echo $res_1['dia_pagamento']; ?></h3></td>
        <td>v</td>
      </tr>
      <tr>
        <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 1:</strong></td>
        <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 2:</strong></td>
        <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 3:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['nome_1']; ?> / <? echo $res_1['tele_refere_1']; ?></h3></td>
        <td><h3><? echo $res_1['nome_2']; ?> / <? echo $res_1['tele_refere_2']; ?></h3></td>
        <td><h3><? echo $res_1['nome_3']; ?> / <? echo $res_1['tele_refere_3']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Valor de outras rendas:</strong></td>
        <td><strong>Origem das outras rendas:</strong></td>
        <td><strong>Forma de comprova&ccedil;&atilde;o das outras rendas:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['outra_renda']; ?></h3></td>
        <td><h3><? echo $res_1['origem_outra_renda']; ?></h3></td>
        <td><h3><? echo $res_1['comprovacao_renda']; ?></h3></td>
      </tr>
      <tr>
        <td><strong>Banco / Tipo de conta:</strong></td>
        <td><strong>Ag&ecirc;ncia / Conta bancaria:</strong></td>
        <td><strong>Cliende desde:</strong></td>
      </tr>
      <tr>
        <td><h3><? echo $res_1['nome_banco']; ?> / <? echo $res_1['tipo_de_conta']; ?></h3></td>
        <td><h3><? echo $res_1['agencia']; ?> / <? echo $res_1['conta_bancaria']; ?></h3></td>
        <td><h3><? echo $res_1['cliente_desde']; ?></h3></td>
      </tr>
    </table>
      <table width="960" border="0">
        <tr>
          <td colspan="3"><h1>Dados dos cart&atilde;o</h1></td>
        </tr>
        <tr>
          <td colspan="3"><hr /></td>
        </tr>
        <tr>
          <td width="342"><strong>Seguro Perda e Roubo - R$ 2.00:</strong></td>
          <td width="396"><strong>Proten&ccedil;&atilde;o Total Farm&aacute;cia - R$ 4.99</strong></td>
          <td width="346"><strong>Prote&ccedil;&atilde;o Total - R$ 3.99:</strong></td>
        </tr>
        <tr>
          <td><h3><? echo $_POST['perda_e_roubo']; ?></h3></td>
          <td><h3><? echo $_POST['farmacia']; ?></h3></td>
          <td><h3><? echo $_POST['total']; ?></h3></td>
        </tr>
        <tr>
          <td colspan="3"><strong>Depedente 1:</strong></td>
        </tr>
        <tr>
          <td colspan="3"><h3>
          <strong>Nome:</strong> <? echo @$_POST['dependente1']; ?> /  <strong>CPF:</strong> <? echo @$_POST['cpf1']; ?> / <strong>Nascimento:</strong> <? echo @$_POST['nascimento1']; ?> / <strong>Parentesco:</strong> <? echo @$_POST['parentesco1']; ?> / <strong>Sexo:</strong> <? echo @$_POST['sexo1']; ?></h3></td>
        </tr>
        <tr>
          <td colspan="3">'<strong>Depedente 2:</strong></td>
        </tr>
        <tr>
          <td colspan="3"><h3>
            <strong>Nome:</strong> <? echo @$_POST['dependente2']; ?> / <strong>CPF:</strong> <? echo @$_POST['cpf2']; ?> / <strong>Nascimento:</strong> <? echo @$_POST['nascimento2']; ?> / <strong>Parentesco:</strong> <? echo @$_POST['parentesco2']; ?> / <strong>Sexo:</strong> <? echo @$_POST['sexo2']; ?></h3>
          </h3></td>
        </tr>
        <tr>
          <td><strong>Bandeira escolhida:</strong></td>
          <td><strong>Melhor dia de vencimento:</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><? echo @$_POST['bandeira']; ?></td>
          <td><? echo @$_POST['vencimento']; ?></label></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>


<input type="hidden" name="perda_e_roubo" value="<? echo $_POST['perda_e_roubo']; ?>" />
<input type="hidden" name="farmacia" value="<? echo $farmacia = $_POST['farmacia']; ?>" />
<input type="hidden" name="totals" value="<? echo $total = $_POST['total']; ?>" />

<input type="hidden" name="n_proposta" value="<? echo $_POST['n_proposta']; ?>" />
<input type="hidden" name="cpf" value="<? echo $_POST['cpf']; ?>" />

<input type="hidden" name="dependente1" value="<? echo $_POST['dependente1'];?>" />
<input type="hidden" name="cpf1" value="<? echo $_POST['cpf1'];?>" />
<input type="hidden" name="nascimento1" value="<? echo $_POST['nascimento1'];?>" />
<input type="hidden" name="parentesco1" value="<? echo $_POST['parentesco1'];?>" />
<input type="hidden" name="sexo1" value="<? echo $_POST['sexo1'];?>" />


<input type="hidden" name="dependente2" value="<? echo $dependente2 = $_POST['dependente2'];?>" />
<input type="hidden" name="cpf2" value="<? echo $cpf2 = $_POST['cpf2'];?>" />
<input type="hidden" name="nascimento2" value="<? echo $nascimento2 = $_POST['nascimento2'];?>" />
<input type="hidden" name="parentesco2" value="<? echo $parentesco2 = $_POST['parentesco2'];?>" />
<input type="hidden" name="sexo2" value="<? echo $sexo2 = $_POST['sexo2'];?>" />

<input type="hidden" name="bandeira" value="<? echo $bandeira = $_POST['bandeira'];?>" />
<input type="hidden" name="vencimento" value="<? echo $vencimento = $_POST['vencimento'];?>" />


  <tr>
    <td colspan="4"><input type="submit" name="button" id="button" value="Confirmar" /></td>
  </tr>
</table>

<? } ?>
</form>

<? if(isset($_POST['button'])){

$perda_e_roubo = $_POST['perda_e_roubo'];
$farmacia = $_POST['farmacia'];
$totals = $_POST['totals'];

$n_proposta = $_POST['n_proposta'];
$cpf = $_POST['cpf'];

$dependente1 = $_POST['dependente1'];
$cpf1 = $_POST['cpf1'];
$nascimento1 = $_POST['nascimento1'];
$parentesco1 = $_POST['parentesco1'];
$sexo1 = $_POST['sexo1'];


$dependente2 = $_POST['dependente2'];
$cpf2 = $_POST['cpf2'];
$nascimento2 = $_POST['nascimento2'];
$parentesco2 = $_POST['parentesco2'];
$sexo2 = $_POST['sexo2'];

$bandeira = $_POST['bandeira'];
$vencimento = $_POST['vencimento'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y H:i:s");

mysql_query("INSERT INTO envio_de_propostas (ip, date, status, tipo_de_proposta, n_proposta, cpf, perda_e_roubo, farmacia, total, dependente1, cpf1, nascimento1, parentesco1, sexo1, dependente2, cpf2, nascimento2, parentesco2, sexo2, bandeira, vencimento, empresa_de_envio) VALUES ('$ip', '$date', 'Em análise', 'Cartão', '$n_proposta', '$cpf', '$perda_e_roubo', '$farmacia', '$totals', '$dependente1', '$cpf1', '$nascimento1', '$parentesco1', '$sexo1', '$dependente2', '$cpf2', '$nascimento2', '$parentesco2', '$sexo2', '$bandeira', '$vencimento', 'Invest Acessória')");

echo "<script language='javascript'>window.alert('OK');</script>";

}?>
</div><!-- box -->
</body>
</html>