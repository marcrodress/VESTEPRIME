<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/dados_visita.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<?

require "../../conexao.php";

$id = $_GET['id'];
$id_cliente = $_GET['id_cliente'];

$sql_1 = mysql_query("SELECT * FROM visitas_confirmadas WHERE id = '$id'");
	while($res_1 = mysql_fetch_array($sql_1)){

$sql_2 = mysql_query("SELECT * FROM lista_inss WHERE id = '$id_cliente'");
	while($res_2 = mysql_fetch_array($sql_2)){		

?>
<table width="1000" border="1" bordercolor="#000">
  <tr>
    <td align="center" colspan="3"><p><img src="../../img/index.png" width="194" height="112" /></p><p></p></td>
  </tr>
  <tr>
    <td width="333" align="center"><strong>Nome: </strong>Marcos Rodrigues de Oliveira</td>
    <td width="387" align="center"><strong>CPF:</strong> 053.798.393-71</td>
    <td width="268" align="center"><strong>Telefone: </strong>(85) 3315.6219</td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC" colspan="3"><img src="../img/confirmacao_visita.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td colspan="3"><table width="1000" border="0">
      <tr>
        <td width="15">&nbsp;</td>
        <td width="396"><strong>Nome:</strong></td>
        <td width="327"><strong>CPF:</strong></td>
        <td width="244"><strong>Data de nascimento:</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><? echo $res_2['nome']; ?></td>
        <td><? echo $res_2['cpf']; ?></td>
        <td><? echo $res_2['dt_nasc']; ?></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><strong>Endere&ccedil;o:</strong></td>
        <td><strong>Complemento:</strong></td>
        <td><strong>Cep:</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><? echo $res_2['endereco']; ?></td>
        <td><? echo $res_2['complemento']; ?></td>
        <td><? echo $res_2['cep']; ?></td>
      </tr>
      <tr>
        <td rowspan="8">&nbsp;</td>
        <td><strong>Bairro:</strong></td>
        <td><strong>Cidade:</strong></td>
        <td><strong>UF:</strong></td>
      </tr>
      <tr>
        <td><? echo $res_2['bairro']; ?></td>
        <td><? echo $res_2['cidade']; ?></td>
        <td><? echo $res_2['uf']; ?></td>
      </tr>
      <tr>
        <td><strong>N&ordm; do ben&eacute;ficio:</strong></td>
        <td><strong>Valor do ben&eacute;ficio:</strong></td>
        <td><strong>Servi&ccedil;o contratado:</strong></td>
        </tr>
      <tr>
        <td><? echo $res_2['n_beneficio']; ?></td>
        <td>R$ <? echo number_format($res_2['vl_atual_benef'],2,",","."); ?></td>
        <td>Empréstimo Consignado</td>
      </tr>
      <tr>
        <td><strong>Telefone:</strong></td>
        <td><strong>Tipo de concess&atilde;o</strong></td>
        <td><strong>Banco pagador:</strong></td>
      </tr>
      <tr>
        <td><? echo $res_2['fone']; ?></td>
        <td><? echo $res_2['tipo_concessao']; ?></td>
        <td><? echo $res_2['banco']; ?></td>
      </tr>
      <tr>
        <td colspan="3"><strong>Observa&ccedil;&otilde;es:</strong></td>
      </tr>
      <tr>
        <td colspan="3"><? echo $res_1['obs']; ?></td>
        </tr>
      <tr>
        <td colspan="4"><hr /></td>
        </tr>
      <tr>
        <td height="33" colspan="4"><p>A Easy Loan Financial Services inscrita no CNPJ sob n&ordm;  18.471.972/0001-20, que atua no mercado como correspondente de institui&ccedil;&otilde;es financeira,  confirma que ligou para <? echo $res_2['nome']; ?> e explicou as formas e pagamento do empr&eacute;stimo que a mesma(o) est&aacute; contratando. A Easy Loan Financial Services declara que est&aacute; apta a prestar qualquer informa&ccedil;&atilde;o, ou, indicar quem pode  prestar a informa&ccedil;&atilde;o de forma eficaz ao cliente dentro do prazo m&aacute;ximo de  45(quarente e cinco) dias corridos ap&oacute;s o cliente ter adquirido o produto solicitado,  que na ocasi&atilde;o &eacute; o empr&eacute;stimo.</p>
<p>            Declaro que a Easy Loan Financial Services me ligou e  explicou todas as informa&ccedil;&otilde;es sobre o empr&eacute;stimo que estou adquirindo. Tamb&eacute;m  declaro que isento e Easy Loan Financial Services sobre qualquer assunto ap&oacute;s 45(quarenta  e cinco) dias corridos de eu ter contra&iacute;do este empr&eacute;stimo, sendo que procurarei o banco  emissor do empr&eacute;stimo caso a Easy Loan Financial Services n&atilde;o saiba me prestar a informa&ccedil;&atilde;o que preciso, mesmo estando no prazo de 45(quarenta e cinco) dias corrido.</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
          <p>&nbsp;</p>
<p>&nbsp;</p>
          <p>&nbsp;</p></td>
        </tr>
      <tr>
        <td height="34" colspan="4"><hr />          <strong>Data da liga&ccedil;&atilde;o:</strong> <? echo $res_1['data']; ?>
          <hr /></td>
      </tr>
      <tr>
        <td colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td height="69" colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td height="69" colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td height="69" colspan="4">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" colspan="4"><p>_______________________ ______/_________________/__________</p>
          <p>&nbsp;</p>
          </td>
      </tr>
      <tr>
        <td></td>
      </tr>
      <tr>
        <td align="center" colspan="4"><p>&nbsp;</p>
          <p>______________________________________________________ <br />
            <em>Assinatura do cliente</em></p></td>
      </tr>
    </table></td>
  </tr>
</table>
<p>
  <? }} ?>
</p>
<table width="1010" border="1">
  <tr>
    <td width="345">Nome:</td>
    <td width="343">RG:</td>
    <td width="299">D. de expedi&ccedil;&atilde;o / UF / Org&atilde;o emissor:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
</tr>
  <tr>
    <td>CPF:</td>
    <td>Nascimento:</td>
    <td>Estado civil:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>Nome da c&ocirc;njuge:</td>
    <td>Sexo:</td>
    <td>Nome da m&atilde;e:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
  </tr>
  <tr>
    <td>Nome do pai:</td>
    <td>Escolaridade:</td>
    <td>Nacionalidade:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>Telefone resid&ecirc;ncial:</td>
    <td>Telefone celular 1:</td>
    <td>Telefone celular 2:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
</tr>
  <tr>
    <td>Naturalidade:</td>
    <td>Tipo de moradia:</td>
    <td>Endereco:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>N&ordm; da resid&ecirc;ncia:</td>
    <td>Cep:</td>
    <td>Bairro:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
</tr>
  <tr>
    <td>Cidade:</td>
    <td>Estado:</td>
    <td>Tempo de moradia: (m&ecirc;s e ano)</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>Titulo de eleitor / Data de emiss&atilde;o:</td>
    <td>Zona / Se&ccedil;&atilde;o de vota&ccedil;&atilde;o:</td>
    <td>N&ordm; da reservista:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Situa&ccedil;&atilde;o profissional:</td>
    <td>N&ordm; do ben&eacute;ficio do INSS:</td>
    <td>Nome da empresa:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
</tr>
  <tr>
    <td>Profiss&atilde;o:</td>
    <td>Telefone da empresa:</td>
    <td>Endere&ccedil;o:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>N&ordm; da sede da empresa:</td>
    <td>Bairro sede da empresa:</td>
    <td>Cidade sede da empresa:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>Estado sede da empresa:</td>
    <td>CNPJ:</td>
    <td>Data de admiss&atilde;o:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td></td>
</tr>
  <tr>
    <td>Renda mensal comprovada</td>
    <td>Dia de pagamento:</td>
    <td>Outras rendas complementar neste trabalho:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
  <tr>
    <td>Nome e n&uacute;mero da refer&ecirc;ncia profissional 1:</td>
    <td>Nome e n&uacute;mero da refer&ecirc;ncia profissional 2:</td>
    <td>Nome e n&uacute;mero da refer&ecirc;ncia profissional 3:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>Valor de outras rendas:</td>
    <td>Origem das outras rendas:</td>
    <td>Forma de comprova&ccedil;&atilde;o das outras rendas:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Banco / Tipo de conta:</td>
    <td>Agência / Conta bancaria:</td>
    <td>Cliende desde:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>N&ordm; de dependentes:</td>
    <td>N&uacute;mero / N&uacute;mero 2 / S&eacute;rie da CTPS / UF emiss&atilde;o:</td>
    <td> Local de emiss&atilde;o / E-mail:</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table> 			
</div><!-- box -->

<? if(isset($_POST['imprimir'])){ ?>
<script type="text/javascript">
window.print() 
</script>
<? die; } ?>
<form name="imprimir" method="post" action="" enctype="multipart/form-data">
<input type="button" name="imprimir" value="Imprimir" onclick="window.print();">
</form>
</body>
</html>