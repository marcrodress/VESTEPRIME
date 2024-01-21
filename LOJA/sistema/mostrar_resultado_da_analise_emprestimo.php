<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/mostrar_resultado_da_analise.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<div id="box_cadastro_de_cliente">
 <h1><strong>Consulta de propósta de empréstimo</strong>
   <hr /></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
   <input name="codigo" type="text" class="input_search" id="codigo" />
   <input class="input" type="submit" name="send" value="VALIDAR" />
 </form>

 <p>
   <? if(isset($_POST['send'])){

$codigo = $_POST['codigo'];

$sql = mysql_query("SELECT * FROM envio_de_propostas WHERE n_proposta = '$codigo'");
 if(mysql_num_rows($sql) == ''){
	 echo "<script language='javascript'>window.alert('Não foi encontrada nenhuma propósta com este código!');</script>";
 }else{
	 while($res_2 = mysql_fetch_array($sql)){
		 
		 $cpf = $res_2['cpf'];

$sql_2 = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
 while($res_1 = mysql_fetch_array($sql_2)){

?>
 </p>
 <table width="1180" border="0">
   <tr>
     <td colspan="3"><h1>Dados pessoais</h1></td>
   </tr>
   <tr>
     <td colspan="3"><hr /></td>
   </tr>
   <tr>
     <td width="430"><strong>Nome:</strong></td>
     <td width="420"><strong>RG:</strong></td>
     <td width="314"><strong>Data de expedi&ccedil;&atilde;o / UF de expedi&ccedil;&atilde;o / Org&atilde;o emissor:</strong></td>
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
 <? } ?>
 <table width="1180" border="0">
   <tr>
     <td colspan="4"><h1>Resumo do empr&eacute;stimo e resultado da an&aacute;lise</h1></td>
   </tr>
   <tr>
     <td colspan="4"><hr /></td>
   </tr>
   <tr>
     <td><strong>Valor solicitado:</strong></td>
     <td><strong>Quantidade de parcelas:</strong></td>
     <td><strong>Valor das parcelas:</strong></td>
     <td><strong>N&ordm; da prop&oacute;sta:</strong></td>
    </tr>
   <tr>
     <td><? echo $res_2['valor_solicitado']; ?></td>
     <td><? echo $res_2['quantidade_parcelas']; ?></td>
     <td><? echo $res_2['valor_parcelas']; ?></td>
     <td><? echo $res_2['n_proposta']; ?></td>
   </tr>
   <tr>
     <td width="361"><strong>Status da prop&oacute;sta:</strong></td>
     <td width="260"><strong>Data de preenchimento:</strong></td>
     <td width="227"><strong>Tipo de empr&eacute;stimo:</strong></td>
     <td width="312"><strong>Empresa de envio:</strong></td>
   </tr>
   <tr>
     <td><h3><? echo $res_2['status']; ?></h3></td>
     <td><h3><? echo $res_2['date']; ?></h3></td>
     <td><? echo $res_2['tipo_de_emprestimo']; ?></td>
     <td><h3><? echo $res_2['empresa_de_envio']; ?></h3></td>
   </tr>
   <?
   if($res_2['tipo_de_emprestimo'] == 'Empréstimo com cartão'){
	  $n_proposta = $res_2['n_proposta'];
	 $sql_3 = mysql_query("SELECT * FROM envio_de_propostas WHERE n_proposta = '$n_proposta'");
	   while($res_3 = mysql_fetch_array($sql_3)){
   ?>
   <tr>
     <td><strong>Data de pagamento:</strong> <? if(@$res_3['data_de_pagamento'] == ''){ echo "O pagamento ainda não feito realizado"; }else{ echo $res_3['data_de_pagamento']; } ?></td>
     <td><? if(@$res_3['data_de_pagamento'] == ''){}else{ ?><a class="a2" href="scripts/mostrar_comprovante_deposito.php?url=<? echo @$res_3['comprovante']; ?>">Comprovante de pagamento</a> <? } ?></td>
     <td></td>
   </tr>
   <? }} ?>
   <tr>
     <td><strong>Observa&ccedil;&otilde;es sobre esta an&aacute;lise:</strong></td>
     <td colspan="2">&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td colspan="4"><? echo $res_2['obs']; ?></td>
    </tr>
   <? if($res_2['dependente1'] == ''){ }else{?>
   <? } ?>
   <? if($res_2['dependente2'] == ''){ }else{?>
   <? } ?>
 </table>
<? }}} ?>
</div><!-- box_cadastro_de_cliente -->
</body>
</html>