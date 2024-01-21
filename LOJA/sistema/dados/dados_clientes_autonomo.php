<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<div id="box_carteira_assinada">
<form action="scripts/conversao_emprestimo_autonomo.php" method="post" enctype="multipart/form-data" name="confirma_send" target="_blank">
<table width="1100" border="0">
  <tr>
    <td colspan="3"><h1>Dados pessoais</h1></td>
    </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td width="342"><strong>Nome:</strong></td>
    <td width="396"><strong>RG:</strong></td>
    <td width="346"><strong>Data de expedi&ccedil;&atilde;o / UF de expedi&ccedil;&atilde;o / Org&atilde;o emissor:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome']; ?></h3></td>
    <td><h3><? echo $res_1['rg']; ?></h3></td>
    <td><h3><? echo $res_1['date_exp']; ?> / <? echo $res_1['uf_rg']; ?>  / <? echo $res_1['orgao_expeditor']; ?></h3></td>
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
    <td><strong>Titulo de eleitor / Data de emiss&atilde;o:</strong></td>
    <td><strong>Zona / Se&ccedil;&atilde;o de vota&ccedil;&atilde;o:</strong></td>
    <td><strong>N&ordm; da reservista:</strong></td>
  </tr>
  <tr>
    <td> <h3><? echo $res_1['titulo']; ?> /      <? echo $res_1['emissao']; ?></h3></td>
    <td> <h3><? echo $res_1['zona']; ?> /      <? echo $res_1['secao']; ?></h3></td>
    <td><h3><? echo $res_1['n_reservista']; ?></h3></td>
  </tr>
  <tr>
    <td colspan="3"><h1>Dados profissionais</h1></td>
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
    <td><h3><? echo $res_1['sit_profissional']; ?></h3></td>
    <td><h3><? echo $res_1['n_inss']; ?></h3></td>
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
    <td><h3><? echo $res_1['bairro_empresa']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['cidade_empresa']; ?>      </h3>      <h3>&nbsp;</h3></td>
</tr>
  <tr>
    <td><strong>Estado sede da empresa:</strong></td>
    <td><strong>CNPJ:</strong></td>
    <td><strong>Data de admiss&atilde;o:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['estado_sede']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['cnpj']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['tempo_de_servico']; ?>      </h3>      <h3>&nbsp;</h3></td>
</tr>
  <tr>
    <td><strong>Renda mensal comprovada</strong></td>
    <td><strong>Dia de pagamento:</strong></td>
    <td><strong>Outras rendas complementar neste trabalho:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['renda_mensal']; ?>
    </h3>
      <h3>&nbsp;</h3>      
      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['dia_pagamento']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['rendas_complementar']; ?>      </h3>      <h3>&nbsp;</h3></td>
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
    <td><strong>Valor de outras rendas:</strong></td>
    <td><strong>Origem das outras rendas:</strong></td>
    <td><strong>Forma de comprova&ccedil;&atilde;o das outras rendas:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['outra_renda']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['origem_outra_renda']; ?></h3></td>
    <td><h3><? echo $res_1['comprovacao_renda']; ?></h3></td>
  </tr>
  <tr>
    <td><strong>Banco / Tipo de conta:</strong></td>
    <td><strong>Agência / Conta bancaria:</strong></td>
    <td><strong>Cliende desde:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome_banco']; ?> / <? echo $res_1['tipo_de_conta']; ?></h3></td>
    <td> <h3><? echo $res_1['agencia']; ?> / <? echo $res_1['conta_bancaria']; ?>     </h3></td>
    <td><h3><? echo $res_1['cliente_desde']; ?>      </h3>      <h3>&nbsp;</h3></td>
  </tr>
  <tr>
    <td><strong>N&ordm; de dependentes:</strong></td>
    <td><strong>N&uacute;mero / N&uacute;mero 2 / S&eacute;rie da CTPS / UF emiss&atilde;o:</strong></td>
    <td><strong> Local de emiss&atilde;o / E-mail:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['dependentes']; ?>      </h3>      <h3>&nbsp;</h3></td>
    <td><h3><? echo $res_1['ctps']; ?> / <? echo $res_1['n_ctps']; ?> / 
      <? echo $res_1['seire_ctps']; ?> / <? echo $res_1['uf_emissor_ctps']; ?> / <? echo $res_1['local_emissao_ctps']; ?></h3></td>
    <td><h3><? echo $res_1['local_emissao_ctps']; ?> / <? echo $res_1['email']; ?></h3></td>
  </tr>
  <tr>
    <td colspan="3"><h1>Comprovantes</h1></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <tr>
    <td align="left"><strong>Comprovante de CPF:</strong></td>
    <td align="left"><strong>Comprovante de RG:</strong></td>
    <td align="left"><strong>Comprovante de endereço:</strong></td>
  </tr>

  <tr>
    <td align="left">
    <?
    $sql_cpf = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'CPF' ORDER BY id DESC LIMIT 1");
	if(mysql_num_rows($sql_cpf) == ''){
		echo "<h3>CPF não enviado!</h3>";
	}else{
		while($res_cpf = mysql_fetch_array($sql_cpf)){
	?>
    <img src="<? echo $res_cpf['doc']; ?>" width="280" height="150" />
    <h3><strong>Enviado por: </strong><? echo $res_cpf['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_cpf['date']; ?></h3>
    <? }} ?>
    </td>
    <td align="left">
    <?
    $sql_rg = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'RG' ORDER BY id DESC LIMIT 1");
	if(mysql_num_rows($sql_cpf) == ''){
		echo "<h3>RG não enviado!</h3>";
	}else{
		while($res_rg = mysql_fetch_array($sql_rg)){
	?>
    <img src="<? echo $res_rg['doc']; ?>" width="280" height="150" />
    <h3><strong>Enviado por: </strong><? echo $res_rg['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_rg['date']; ?></h3>
    <? }} ?>
    </td>
    <td align="left">
    <?
    $sql_endereco = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'Comprovante de endereço' ORDER BY id DESC LIMIT 1");
	if(mysql_num_rows($sql_endereco) == ''){
		echo "<h3>Comprovante de endereço não enviado!</h3>";
	}else{
		while($res_endereco = mysql_fetch_array($sql_endereco)){
	?>
    <img src="<? echo $res_endereco['doc']; ?>" width="280" height="150" />
    <h3><strong>Enviado por: </strong><? echo $res_endereco['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_endereco['date']; ?></h3>
    <? }} ?>
    </td>  </tr>
  <tr>
    <td colspan="3" align="left"><strong>Extratos bancarios:</strong></td>
    </tr>
  <tr>
    <td colspan="3" align="left"><?
    $sql_renda = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'Extrato bancario' ORDER BY id DESC LIMIT 3");
	if(mysql_num_rows($sql_renda) == ''){
		echo "<h3>Nenhum extrato bancario ativo!</h3>";
	}else{
		while($res_renda = mysql_fetch_array($sql_renda)){
	?>
      <table class="table" width="280" border="0">
        <tr>
          <td><span class="h3"> </span><span class="h3"><img src="<? echo $res_renda['doc']; ?>" alt="" width="280" height="150" class="img" /></span></td>
        </tr>
        <tr>
          <td><span class="h3"><strong>Enviado por: </strong><? echo $res_renda['resp_envio']; ?><br />
            <strong>Data:</strong><? echo $res_renda['date']; ?></span></td>
        </tr>
      </table>
      <? }} ?></td>
    </tr>
  <tr>
    <td colspan="3" align="left"><strong>Comprovantes de renda:</strong></td>
  </tr>
  <tr>
    <td colspan="3"> <h3 class="h3"><br /><br />
      </h3>

    <?
    $sql_renda = mysql_query("SELECT * FROM clientes_docs WHERE cpf = '$cpf' AND tipo = 'Comprovante de renda' ORDER BY id DESC");
	if(mysql_num_rows($sql_renda) == ''){
		echo "<h3>Nenhum comprovante de renda ativo!</h3>";
	}else{
		while($res_renda = mysql_fetch_array($sql_renda)){
	?>
      <table class="table" width="280" border="0">
        <tr>
          <td><span class="h3">

            </span><span class="h3"><img src="<? echo $res_renda['doc']; ?>" alt="" width="280" height="150" class="img" /></span>
            </td>
          </tr>
        <tr>
          <td><span class="h3"><strong>Enviado por: </strong><? echo $res_renda['resp_envio']; ?><br /><strong>Data:</strong><? echo $res_renda['date']; ?></span></td>
          </tr>
      </table>
   <? }} ?>   
      </td>
  </tr>
  </table>
<input type="hidden" name="n_proposta" value="<? echo $nova_propost2; ?>" />
<input type="hidden" name="cpf" value="<? echo $_POST['cpf']; ?>" />
 <input class="input4" type="submit" name="confirma_send" value="Enviar" />
</form>

</div><!-- box_carteira_assinada -->
</body>
</html>