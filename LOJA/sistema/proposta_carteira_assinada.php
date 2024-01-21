<table width="950" border="0">
  <tr>
    <td width="371"><strong>Corretor:</strong> Marcos Rodrigues de Oliveira</td>
    <td width="338"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="244" colspan="2"><strong>Telefone:</strong> (85) 4042.2634/8932.1649</td>
  </tr>
  <tr>
    <td colspan="4"><hr></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Formulário de preenchimento de crédito para cliente com carteira assinada.<br> 
      Abaixo segue os documentos.<br>
    Nº da propósta:</td>
  </tr>
  <tr>
    <td colspan="4"> <? require "menu_cadastro.php"; ?>
      <table width="961" border="0">
        <tr>
    <td width="312"><strong>Nome:</strong></td>
    <td width="320"><strong>RG:</strong></td>
    <td><strong>Data de expedi&ccedil;&atilde;o / UF de expedi&ccedil;&atilde;o:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome']; ?></h3></td>
    <td><h3><? echo $res_1['rg']; ?></h3></td>
    <td><h3><? echo $res_1['date_exp']; ?> / <? echo $res_1['uf_rg']; ?></h3></td>
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
    <td><strong>E-mail:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome_1']; ?> / <? echo $res_1['tele_refere_1']; ?> </h3></td>
    <td><h3><? echo $res_1['nome_2']; ?> / <? echo $res_1['tele_refere_2']; ?> </h3></td>
    <td><h3><? echo $res_1['email']; ?></h3></td>
  </tr>
  <tr>
    <td><strong>Banco / Tipo de conta:</strong></td>
    <td><strong>Agência:</strong></td>
    <td><strong>Conta bancaria: Cliente desde:</strong></td>
  </tr>
  <tr>
    <td><h3><? echo $res_1['nome_banco']; ?> / <? echo $res_1['tipo_de_conta']; ?> </h3></td>
    <td><h3><? echo $res_1['agencia']; ?> </h3></td>
    <td><h3><? echo $res_1['conta_bancaria']; ?></h3></td>
  </tr>
</table>   		
   <? } ?>&nbsp;</td>
  </tr>
  </table>
