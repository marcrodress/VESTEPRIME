<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<form action="scripts/conversao_emprestimo_consigando.php" method="post" enctype="multipart/form-data" name="confirma_send" target="_blank">
<table width="1166" border="0">
  <tr>
    <td width="445"><strong>Corretor:</strong> Marcos Rodrigues de Oliveira</td>
    <td width="405"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="302" colspan="2"><strong>Telefone:</strong> (85) 3315.6219/9233.0928</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Formul&aacute;rio de preenchimento de cr&eacute;dito para cliente aposentados e pensionista do INSS.<br>
      <strong>N&ordm; da prop&oacute;sta: </strong>
      <?
	  $sql_3 = mysql_query("SELECT * FROM envio_de_propostas ORDER BY id DESC LIMIT 1");
	   while($res_3 = mysql_fetch_array($sql_3)){
	      
		  $segundos = date("s");
		  $ultima_proposta = $res_3['n_proposta'];
		  $id = $res_3['id'];

		  
		  $nova_proposta = $ultima_proposta+($segundos*$id);
		  
		  echo $nova_propost2 = "$nova_proposta$id";
		  
		  
	   
	  ?>
      </td>
  </tr>
  <tr>
    <td colspan="4"> 
      <table width="1130" border="0">
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
    <td><h3><? echo $cpf = $res_1['cpf']; ?></h3></td>
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
    <td><strong>N&ordm; do beneficio do INSS:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['sit_profissional']; ?></h3></td>
    <td><? echo $res_1['dependentes']; ?></td>
    <td><h3><? echo $res_1['n_inss']; ?></h3></td>
</tr>
  <tr>
    <td><strong>Valor para pagamento do INSS:</strong></td>
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
    <td><h3><? echo $res_1['nome_1']; ?> / <? echo $res_1['tele_refere_1']; ?> </h3></td>
    <td><h3><? echo $res_1['nome_2']; ?> / <? echo $res_1['tele_refere_2']; ?> </h3></td>
    <td><h3><? echo $res_1['nome_3']; ?> / <? echo $res_1['tele_refere_3']; ?></h3></td>
    </tr>
  <tr>
    <td><strong>Banco / Tipo de conta:</strong></td>
    <td><strong>Agência / Conta bancaria:</strong></td>
    <td><strong>Cliende desde:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome_banco']; ?> / <? echo $res_1['tipo_de_conta']; ?></h3></td>
    <td> <h3><? echo $res_1['agencia']; ?> / <? echo $res_1['conta_bancaria']; ?>     </h3></td>
    <td><h3><? echo $res_1['cliente_desde']; ?></h3></td>
  </tr>
  </table>
      <table width="1130" border="0">
        <tr>
          <td colspan="3"><h1>Dados do empr&eacute;stimo</h1></td>
        </tr>
        <tr>
          <td colspan="3"><hr /></td>
        </tr>
        <tr>
          <td width="342"><strong>Valor solicidado:</strong></td>
          <td width="396"><strong>Quantidade de meses:</strong></td>
          <td width="346"><strong>Valor de cada parcela:</strong></td>
        </tr>
        <tr>
          <td><h3>
            <label for="valor"></label>
            <input name="valor" type="text" class="input_input1" id="valor" value="<? echo number_format($_POST['valor'],2,",","."); ?>" />
            <input name="valor2" type="hidden" value="<? echo $_POST['valor']; ?>" />
          </h3></td>
          <td><h3>
            <select class="input_select" name="meses" id="meses">
             <?
              $meses = mysql_query("SELECT * FROM simulador_meses");
			   while($r_m = mysql_fetch_array($meses)){
			 ?>
              <option value="<? echo $r_m['mes']; ?>"><? echo $r_m['mes']; ?></option>
             <? } ?>
            </select>
          </h3></td>
          <td><h3>
            <input class="input_input1" type="text" name="parcela" />
          </h3></td>
          </tr>
        <tr>
          <td height="23">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>

<input type="hidden" name="n_proposta" value="<? echo $nova_propost2; ?>" />
<input type="hidden" name="cpf" value="<? echo $_POST['cpf']; ?>" />
 <input class="input4" type="submit" name="confirma_send" value="Enviar" />
</form>

<? } ?>
</body>
</html>