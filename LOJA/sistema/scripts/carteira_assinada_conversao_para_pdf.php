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
$cpf = $_GET['cpf'];

$sql = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
	while($res_1 = mysql_fetch_array($sql)){
?>
<table width="1022" border="0">
  <tr>
    <td width="453"><strong>Corretor:</strong> Marcos Rodrigues de Oliveira</td>
    <td width="294"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="272" colspan="2"><strong>Telefone:</strong> (85) 4042.2634/8932.1649</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Formul&aacute;rio de preenchimento de cr&eacute;dito para cliente com carteira assinada.<br> 
      Abaixo segue os documentos.<br>
      <strong>N&ordm; da prop&oacute;sta: </strong>
      <? echo $_GET['proposta']; ?><br />
      <strong>Valor solicitado pelo cliente:</strong><br />R$ <? echo number_format($_GET['valor'],2,",",".") ?></td>
  </tr>
  <tr>
    <td colspan="4"> 
      <table width="1007" border="0">
        <tr>
    <td width="306"><strong>Nome:</strong></td>
    <td width="392"><strong>RG:</strong></td>
    <td width="293"><strong>Data de expedi&ccedil;&atilde;o / UF / Orgão Expeditor</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome']; ?></h3></td>
    <td><h3><? echo $res_1['rg']; ?></h3></td>
    <td><h3><? echo $res_1['date_exp']; ?> / <? echo $res_1['uf_rg']; ?> / <? echo $res_1['orgao_expeditor']; ?></h3></td>
</tr>
  <tr>
    <td><strong>CPF:</strong></td>
    <td><strong>Nascimento:</strong></td>
    <td><strong>Nome da m&atilde;e:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['cpf']; ?></h3></td>
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
    <td><strong>Situa&ccedil;&atilde;o profissional:</strong></td>
    <td><strong>Profiss&atilde;o:</strong></td>
    <td><strong>Nome da empresa:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['sit_profissional']; ?></h3></td>
    <td><h3><? echo $res_1['profissao']; ?></h3></td>
    <td><h3><? echo $res_1['nome_empresa']; ?></h3></td>
</tr>
  <tr>
    <td><strong>Telefone da empresa:</strong></td>
    <td><strong>Endere&ccedil;o:</strong></td>
    <td><strong>N&ordm; da sede da empresa:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['tele_empresa']; ?></h3></td>
    <td><h3><? echo $res_1['endereco_empresa']; ?></h3></td>
    <td><h3><? echo $res_1['numero_da_empresa']; ?></h3></td>
</tr>
  <tr>
    <td><strong>Bairro sede da empresa:</strong></td>
    <td><strong>Cidade sede da empresa:</strong></td>
    <td><strong>Estado sede da empresa:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['bairro_empresa']; ?></h3></td>
    <td><h3><? echo $res_1['cidade_empresa']; ?></h3></td>
    <td><h3><? echo $res_1['estado_sede']; ?></h3></td>
</tr>
  <tr>
    <td><strong>CNPJ:</strong></td>
    <td><strong>Tempo de servi&ccedil;o:</strong></td>
    <td><strong>Renda mensal comprovada:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['cnpj']; ?></h3></td>
    <td><h3><? echo $res_1['tempo_de_servico']; ?></h3></td>
    <td><h3><? echo $res_1['renda_mensal']; ?></h3></td>
</tr>
  <tr>
    <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 1:</strong></td>
    <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 2:</strong></td>
    <td><strong>Nome e n&uacute;mero da refer&ecirc;ncia profissional 3:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome_1']; ?> / <? echo $res_1['tele_refere_1']; ?> </h3></td>
    <td><h3><? echo $res_1['nome_2']; ?> / <? echo $res_1['tele_refere_2']; ?> </h3></td>
    <td><h3><? echo $res_1['nome_3']; ?> / <? echo $res_1['tele_refere_3']; ?></h3></td>
  </tr>
  <tr>
    <td><strong>E-mail:</strong></td>
    <td><strong>Banco / Tipo de conta:</strong></td>
    <td><strong>Ag&ecirc;ncia: / Conta bancaria / Cliente desde:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['email']; ?></h3></td>
    <td><h3><? echo $res_1['nome_banco']; ?> / <? echo $res_1['tipo_de_conta']; ?></h3></td>
    <td><h3><? echo $res_1['agencia']; ?> / <? echo $res_1['conta_bancaria']; ?> / <? echo $res_1['cliente_desde']; ?></h3></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
    </tr>
  <tr>
    <td colspan="3"><strong>CPF scaneado</strong></td>
    </tr>
  <tr>
    <td colspan="3">
    <?
    $sql_2 = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'CPF' LIMIT 2");
		while($res_2 = mysql_fetch_array($sql_2)){
	?>
    <img src="<? echo $res_2['doc']; ?>" />
    <? } ?>
    </td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><strong>RG scaneado</strong></td>
  </tr>
  <tr>
    <td colspan="3">
    <?
    $sql_3 = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'RG' LIMIT 2");
		while($res_3 = mysql_fetch_array($sql_3)){
	?>
    <img src="<? echo $res_3['doc']; ?>" />
    <? } ?>    
    </td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Comprovante de endere&ccedil;o scaneado</strong></td>
  </tr>
  <tr>
    <td colspan="3">
    <?
    $sql_4 = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'Comprovante de endereço' LIMIT 1");
		while($res_4 = mysql_fetch_array($sql_4)){
	?>
    <img src="<? echo $res_4['doc']; ?>" />
    <? } ?>    
    </td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Comprovante de renda scaneado</strong></td>
  </tr>
  <tr>
    <td colspan="3">
    <?
    $sql_5 = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'Comprovante de renda' LIMIT 1");
		while($res_5 = mysql_fetch_array($sql_4)){
	?>
    <img src="<? echo $res_5['doc']; ?>" />
    <? } ?>    
    </td>  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td colspan="3"><strong>Extratos bancarios scaneado</strong></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  </table>   		
</td>
  </tr>
</table>

<? } ?>
</div><!-- box -->
</body>
</html>