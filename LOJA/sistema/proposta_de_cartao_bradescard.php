<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/proposta_de_cartao_bradescard.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
</head>

<body>
<div id="box_cadastro_de_cliente">
 <h1><strong>Preenchimento de propósta do cartão Bradescard</strong><hr /></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
   <span id="sprytextfield1">
   <input class="input_search" type="text" name="cpf" value="<? echo @$cpf_cliente; ?>" />
   </span>
   <input class="input" type="submit" name="send" value="VALIDAR" />
 </form>

<? if(isset($_POST['send'])){

$cpf = $_POST['cpf'];

$sql = mysql_query("SELECT * FROM clientes WHERE cpf = '$cpf'");
 if(mysql_num_rows($sql) == ''){
	 echo "<script language='javascript'>window.alert('Este CPF não está cadastrado!');</script>";
 }else{
	 while($res_1 = mysql_fetch_array($sql)){
?>
<form action="scripts/conversao_pedido_de_cartao.php" method="post" enctype="multipart/form-data" name="confirma_send" target="_blank">
<table width="1157" border="0">
  <tr>
    <td width="371"><strong>Corretor:</strong> Marcos Rodrigues de Oliveira</td>
    <td width="338"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="244" colspan="2"><strong>Telefone:</strong> (85) 4042.2634/8932.1649</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Formul&aacute;rio de preenchimento de cr&eacute;dito para cliente com carteira assinada.<br>
      <strong>N&ordm; da prop&oacute;sta: </strong>
      <?
	  $sql_3 = mysql_query("SELECT * FROM envio_de_propostas ORDER BY id DESC LIMIT 1");
	   while($res_3 = mysql_fetch_array($sql_3)){
	      
		  $segundos = date("s");
		  $ultima_proposta = $res_3['n_proposta'];
		  $id = $res_3['id'];

		  
		  $nova_proposta = $ultima_proposta+($segundos*$id);
		  
		  echo $nova_proposta2 =  "$nova_proposta$id";
		  
		  
	   
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
    <td><h3><? echo $res_1['outra_renda']; ?></h3></td>
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
    <td><h3><? echo $res_1['cliente_desde']; ?></h3></td>
  </tr>
  </table>
      <table width="1130" border="0">
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
          <td><h3>
            <input type="radio" name="perda_e_roubo" id="radio" value="Sim" />
            <label for="perda_e_roubo"></label>
            SIM 
            <input type="radio" name="perda_e_roubo" id="radio2" value="N&atilde;o" />
            <label for="perda_e_roubo"></label> 
            N&atilde;o
          </h3></td>
          <td><h3>
            <input type="radio" name="farmacia" id="radio" value="Sim" />
            <label for="perda_e_roubo"></label>
            SIM
            <input type="radio" name="farmacia" id="radio2" value="N&atilde;o" />
            <label for="perda_e_roubo"></label>
            N&atilde;o </h3></td>
          <td><h3>
            <input type="radio" name="total" id="radio" value="Sim" />
            <label for="perda_e_roubo"></label>
            SIM
            <input type="radio" name="total" id="radio2" value="N&atilde;o" />
            <label for="perda_e_roubo"></label>
            N&atilde;o </h3></td>
          </tr>
        <tr>
          <td colspan="3"><strong>Depedente 1 (Nome / CPF / Data de nascimento / Grau de parenteso / sexo):</strong></td>
          </tr>
        <tr>
          <td colspan="3"><h3>
            <input name="dependente1" type="text" class="input_input1" id="dependente1" size="54" />
            <input name="cpf1" type="text" class="input_input1" id="cpf1" size="30" />
            <input name="nascimento1" type="text" class="input_input1" id="nascimento1" size="30" />
            <label for="parentesco1"></label>
            <select class="input_select" name="parentesco1" size="1" id="parentesco1">
              <option value=""></option>
              <option value="Irm&atilde;o">Irm&atilde;o</option>
              <option value="Pa&iacute;s">Pa&iacute;s</option>
              <option value="C&ocirc;njuge">C&ocirc;njuge</option>
              <option value="Filho">Filho</option>
              <option value="Outros">Outros</option>
              </select>
            <select class="input_select" name="sexo1" size="1" id="sexo1">
              <option value=""></option>
              <option value="Masculino">Masculino</option>
              <option value="Feminino">Feminino</option>
              </select>
            <label for="bandeira"></label>
            </h3></td>
          </tr>
        <tr>
          <td colspan="3">'<strong>Depedente 2 (Nome / CPF / Data de nascimento / Grau de parenteso / sexo):</strong></td>
          </tr>
        <tr>
          <td colspan="3">
            <input name="dependente2" type="text" class="input_input1" id="dependente2" size="54" />
<input name="cpf2" type="text" class="input_input1" id="textfield5" size="30" />
<input name="nascimento2" type="text" class="input_input1" id="textfield6" size="30" />
<label for="parentesco1"></label>
            <select class="input_select" name="parentesco2" size="1" id="select2">
              <option value=""></option>
              <option value="Irm&atilde;o">Irm&atilde;o</option>
              <option value="Pa&iacute;s">Pa&iacute;s</option>
              <option value="C&ocirc;njuge">C&ocirc;njuge</option>
              <option value="Filho">Filho</option>
              <option value="Outros">Outros</option>
            </select>
            <select class="input_select" name="sexo2" size="1" id="sexo2">
              <option value=" "></option>
              <option value=" Masculino">Masculino</option>
              <option value="Feminino">Feminino</option>
            </select>
            <label for="bandeira"></label></td>
        </tr>
        <tr>
          <td height="23"><strong>Bandeira escolhida:</strong></td>
          <td><strong>Melhor dia de vencimento:</strong></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><select class="input_select" name="bandeira" size="1" id="bandeira">
            <option value="Mastarcard Nacional">Mastarcard Nacional</option>
            <option value="Mastercard Interncaional">Mastercard Interncaional</option>
            <option value="Elo Nacional">Elo Nacional</option>
          </select></td>
          <td><label for="vencimento"></label>
            <select class="input_select" name="vencimento" size="1" id="vencimento">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="22">21</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
            </select></td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>

<input type="hidden" name="n_proposta" value="<? echo $nova_proposta2; ?>" />
<input type="hidden" name="cpf" value="<? echo $_POST['cpf']; ?>" />
 <input class="input4" type="submit" name="confirma_send" value="Enviar" />
</form>

<? } ?>
<? }}}?>
</div><!-- box_cadastro_de_cliente -->
</body>
</html>