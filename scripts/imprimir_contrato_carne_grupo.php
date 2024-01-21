<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../conexao.php"; ?>
<style type="text/css">
body {
	background-color: #FFF;
	font:13px Arial, Helvetica, sans-serif;
}
body table{
	border:2px solid #000;
}
body .table{
	text-align:center;
	border:2px solid #000;
}
</style>
</head>

<body>
<table width="1000" border="0">
  <tr>
    <td width="156" rowspan="4"><img src="../img/logo.png" width="156" height="92" /></td>
    <td><h1 style="font:20px Arial, Helvetica, sans-serif; text-align:center;"><strong>CONTRATO DE CR&Eacute;DITO  CREDIMAIS</strong></h1>
    <hr /></td>
  </tr>
  <tr>
    <td align="center"><strong>CNPJ: 32.450.862/0001-02</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>VESTE PRIME</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>MARCOS RODRIGUES DE OLIVEIRA 05379839371</strong></td>
  </tr>
</table>

<table width="1000" border="0">
  <tr>
    <td align="center" colspan="6"><img src="../img/identificacao_contratente.fw.png" width="1000" height="40" /></td>
  </tr>
<?

$n_proposta = $_GET['n_proposta'];
$sql_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_proposta)){
	$cpf_cliente = $res_proposta['cliente'];

$sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
while($res_cpf = mysqli_fetch_array($sql_cpf)){
?>
  <tr>
    <td colspan="6" bgcolor="#666666"><h2 style="font:18px Arial, Helvetica, sans-serif; margin:0; padding:0;">Idenfica&ccedil;&atilde;o do contratante <? echo $res_proposta['int_integrante']; ?> <? if($res_proposta['int_integrante'] == 1){ echo " - Coordenador"; } ?></h2></td>
  </tr>
  <tr>
    <td width="230" bgcolor="#CCCCCC"><strong>Nome:</strong></td>
    <td width="195" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td width="139" bgcolor="#CCCCCC"><strong>RG</strong></td>
    <td width="140" bgcolor="#CCCCCC"><strong>Org&atilde;o expeditor</strong></td>
    <td width="138" bgcolor="#CCCCCC"><strong>Data de expedi&ccedil;&atilde;o</strong></td>
    <td width="138" bgcolor="#CCCCCC"><strong>Data de nascimento</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['nome']; ?></td>
    <td><? echo $res_cpf['cpf']; ?></td>
    <td><? echo $res_cpf['rg']; ?></td>
    <td><? echo $res_cpf['orgao_expeditor']; ?></td>
    <td><? echo $res_cpf['date_exp']; ?></td>
    <td><? echo $res_cpf['nascimento']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nome da m&atilde;e</strong></td>
    <td bgcolor="#CCCCCC"><strong>Sexo</strong></td>
    <td bgcolor="#CCCCCC"><strong>Nascionalidade</strong></td>
    <td bgcolor="#CCCCCC"><strong>Cidade de nascimento</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Estado c&iacute;vil</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['mae']; ?></td>
    <td><? echo $res_cpf['sexo']; ?></td>
    <td><? echo $res_cpf['nacionalidade']; ?></td>
    <td><? echo $res_cpf['naturalidade']; ?></td>
    <td colspan="2"><? echo $res_cpf['estado_civil']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Nome do pai</strong></td>
    <td bgcolor="#CCCCCC"><strong>Profiss&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tempo de servi&ccedil;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Renda mensal</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Conjuge</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['pai']; ?></td>
    <td><? echo $res_cpf['profissao']; ?></td>
    <td><? echo $res_cpf['tempo_de_servico']; ?></td>
    <td><? echo $res_cpf['renda_mensal']; ?></td>
    <td colspan="2"><? echo $res_cpf['conjuge']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Forma&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Situa&ccedil;&atilde;o profissional</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Endere&ccedil;o</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Bairro</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['escolaridade']; ?></td>
    <td><? echo $res_cpf['sit_profissional']; ?></td>
    <td colspan="2"><? echo $res_cpf['endereco']; ?> - <? echo $res_cpf['n_residencia']; ?></td>
    <td colspan="2"><? echo $res_cpf['bairro']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Cidade</strong></td>
    <td bgcolor="#CCCCCC"><strong>Estado</strong></td>
    <td bgcolor="#CCCCCC"><strong>Complemento</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tipo de moradia</strong></td>
    <td bgcolor="#CCCCCC"><strong>CEP</strong></td>
    <td bgcolor="#CCCCCC"><strong>Reside desde</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['cidade']; ?></td>
    <td><? echo $res_cpf['estado']; ?></td>
    <td><? echo $res_cpf['complemento']; ?></td>
    <td><? echo $res_cpf['moradia']; ?></td>
    <td><? echo $res_cpf['cep']; ?></td>
    <td><? echo $res_cpf['ano_moradia']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>Telefone 1</strong></td>
    <td bgcolor="#CCCCCC"><strong>Telefone 2</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Telefone 3</strong></td>
    <td colspan="2" bgcolor="#CCCCCC"><strong>E-mail</strong></td>
  </tr>
  <tr>
    <td><? echo $res_cpf['celular_1']; ?></td>
    <td><? echo $res_cpf['celular_2']; ?></td>
    <td colspan="2"><? echo $res_cpf['celular_3']; ?></td>
    <td colspan="2"><? echo $res_cpf['email']; ?></td>
  </tr>
<? }} ?>
</table>


<?
$n_proposta = $_GET['n_proposta'];
$sql_propostas = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto_unico WHERE n_proposta = '$n_proposta'");
while($res_propostas = mysqli_fetch_array($sql_propostas)){
?>
<table class="table" width="1000" border="0">
  <tr>
    <td colspan="9"><img src="../img/distribuicao_credito.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td colspan="9"><strong>N&ordm; proposta: </strong><? echo $res_propostas['n_proposta']; ?></td>
  </tr>
  <tr>
    <td colspan="9"><strong>Data da contrata&ccedil;&atilde;o:</strong> <? echo $res_propostas['data']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>ID</strong></td>
    <td bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td bgcolor="#CCCCCC"><strong>Nome</strong></td>
    <td bgcolor="#CCCCCC"><strong>Valor</strong></td>
    <td bgcolor="#CCCCCC"><strong>Juros</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tarifa</strong></td>
    <td bgcolor="#CCCCCC"><strong>N&ordm;. Parcela</strong></td>
    <td bgcolor="#CCCCCC"><strong>Vl. Parcela</strong></td>
    <td bgcolor="#CCCCCC"><strong>Vl. Total</strong></td>
  </tr>
<?
$n_proposta = $_GET['n_proposta'];
$sql_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_proposta)){
?>
  <tr>
    <td><? echo $res_proposta['int_integrante']; ?></td>
    <td><? echo $res_proposta['cliente']; ?></td>
    <td>
	<?
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_proposta['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>    
    </td>
    <td>R$ <? echo number_format($res_proposta['valor'],2,',','.'); ?></td>
    <td><? echo $res_proposta['juros']; ?>%</td>
    <td>R$ <? echo number_format($res_proposta['tarifa'],2,',','.'); ?></td>
    <td><? echo $res_proposta['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_proposta['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_proposta['valor_total'],2,',','.'); ?></td>
  </tr>
<? } ?>
</table>
<p>
  <? } ?>
  
  

<?
$n_proposta = $_GET['n_proposta'];
$sql_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_proposta)){
?>
<table class="table" width="1000" border="0">
  <tr>
    <td colspan="9"><img src="../img/contas_para_realizacao_credito.fw.png" alt="" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td colspan="9"><strong>N&ordm; proposta: </strong><? echo $_GET['n_proposta']; ?></td>
  </tr>
  <tr>
    <td colspan="9"><strong>Data da contrata&ccedil;&atilde;o:</strong> <? echo $res_proposta['data']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>ID</strong></td>
    <td bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td bgcolor="#CCCCCC"><strong>Nome</strong></td>
    <td bgcolor="#CCCCCC"><strong>Valor</strong></td>
    <td bgcolor="#CCCCCC"><strong>Juros</strong></td>
    <td bgcolor="#CCCCCC"><strong>Tarifa</strong></td>
    <td bgcolor="#CCCCCC"><strong>N&ordm;. Parcela</strong></td>
    <td bgcolor="#CCCCCC"><strong>Vl. Parcela</strong></td>
    <td bgcolor="#CCCCCC"><strong>Vl. Total</strong></td>
  </tr>
  <tr>
    <td><? echo $res_proposta['int_integrante']; ?></td>
    <td><? echo $res_proposta['cliente']; ?></td>
    <td><?
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_proposta['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?></td>
    <td>R$ <? echo number_format($res_proposta['valor'],2,',','.'); ?></td>
    <td><? echo $res_proposta['juros']; ?>%</td>
    <td>R$ <? echo number_format($res_proposta['tarifa'],2,',','.'); ?></td>
    <td><? echo $res_proposta['quant_parcela']; ?></td>
    <td>R$ <? echo number_format($res_proposta['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_proposta['valor_total'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="9">DADOS PARA REALIZA&Ccedil;&Atilde;O DO CR&Eacute;DITO</td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Valor</strong></td>
    <td bgcolor="#CCCCCC"><strong>CPF da conta</strong></td>
    <td colspan="3" bgcolor="#CCCCCC"><strong>Nome do titular da conta</strong></td>
    <td colspan="3" bgcolor="#CCCCCC"><strong>Banco de cr&eacute;dito</strong></td>
  </tr>
  <tr>
    <td colspan="2">R$ <? echo number_format($res_proposta['valor'],2,',','.'); ?></td>
    <td><? echo $res_proposta['cpf_conta']; ?></td>
    <td colspan="3"><? echo $res_proposta['nome_conta']; ?></td>
    <td colspan="3"><? echo $res_proposta['banco']; ?></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#CCCCCC"><strong>Tipo de conta</strong></td>
    <td bgcolor="#CCCCCC"><strong>Ag&ecirc;ncia</strong></td>
    <td colspan="3" bgcolor="#CCCCCC"><strong>N&uacute;mero da conta</strong></td>
    <td bgcolor="#CCCCCC"><strong>Forma de autoriza&ccedil;&atilde;o</strong></td>
    <td bgcolor="#CCCCCC"><strong>Titular da conta</strong></td>
    <td bgcolor="#CCCCCC"><strong>Previs&atilde;o de cr&eacute;dito</strong></td>
  </tr>
  <tr>
    <td colspan="2"><? echo $res_proposta['tipo_conta']; ?></td>
    <td><? echo $res_proposta['agencia']; ?></td>
    <td colspan="3"><? echo $res_proposta['n_conta']; ?></td>
    <td>Assinatura manual</td>
    <td><? if($res_proposta['cpf_conta'] == $res_proposta['cliente']){ echo "SIM"; }else{ echo "NAO"; } ?></td>
    <td>72 horas &uacute;teis</td>
  </tr>
  <tr>
    <td colspan="9"><hr />
      <p>Eu, 
        <?
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_proposta['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>
      , declaro que concordo com transfer&ecirc;ncia de cr&eacute;dito referente a libera&ccedil;&atilde;o do cr&eacute;dito alvo de gera&ccedil;&atilde;o deste contrato</p>
    <p>&nbsp;</p>
    <p>__________________________________________________</p>
    <p><strong>NOME: 
      <?
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_proposta['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>
    </strong> </p>
    <p><strong>CPF:<? echo $res_proposta['cliente']; ?></strong></p></td>
  </tr>
</table>
<? } ?>





<table width="1000" border="0">
  <tr>
    <td><img src="../img/objeto_de_contratacao.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>1.1. O cr&eacute;dito pessoal alvo deste contrato trata-se  um cr&eacute;dito que &eacute; disponibilizado de forma conjunta entre os integrantes a qual  todos se responsabilizam pelo uso do cr&eacute;dito, bem como o pagamento de todas as parcelas.</p>
      <p>1.2. O cr&eacute;dito pessoal alvo desta contrata&ccedil;&atilde;o &eacute;  disponibilizado em contas separadas acima acertadas, com as condi&ccedil;&otilde;es individuais,  mas  com responsabilidade de pagamento e comprimento do contrato de todos.
    </p></td>
  </tr>
  <tr>
    <td><img src="../img/das_resposabilidades.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>2.1. O cr&eacute;dito disponibilizado e  aqui descritos s&atilde;o condi&ccedil;&otilde;es individuais e com taxas individuais, mas a  responsabilidade e conhecimento de todos.</p>
      <p>    22. Cada membro concorda com o  cr&eacute;dito solicitado por cada pessoa do grupo, suas taxas e concorda com o valor  das parcelas e que deveram arcar com elas mesmo que cada pessoa do grupo n&atilde;o  colabore com o pagamento.</p></td>
  </tr>
  <tr>
    <td><img src="../img/do_pagamento.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>3.1. O cr&eacute;dito solicitado e  aprovado acima ser&aacute; transferido pela VESTE PRIME e disponibilizado em contas  individuais, do titular ou uma conta indicada por ele para recebimento do  cr&eacute;dito referente ao cr&eacute;dito pessoal aqui contrato.</p>
      <p>        3. 2. Cada membro da equipe ter&aacute;  a responsabilidade de quitar mensalmente por meio de boleto o cr&eacute;dito  solicitado por cada membro do grupo.</p>
      <p>        3.3. O n&atilde;o pagamento na data do  vencimento da parcela incidir&aacute; de multas e juros di&aacute;rios que a crit&eacute;rio da  VESTE PRIME e concordado com cada membro, incidir&aacute; de: </p>
      <ul>
        <li>Multa de at&eacute; 10% do valor</li>
        <li>1% de mora di&aacute;ria.</li>
      </ul>
    <p>3.4 Cada membro da equipe assume a responsabilidade de  pagamento dos demais membros do grupo, sendo de responsabilidade individual e  coletiva dos demais membros o pagamento de cada parcela mesmo que um ou mais membros  n&atilde;o arque com a responsabilidade de seu pagamento individual.</p></td>
  </tr>
  <tr>
    <td><img src="../img/da_funcao_do_coordenador.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>4.1. O coordenador tem a fun&ccedil;&atilde;o de coletar os dados, de  organizar a reuni&atilde;o, al&eacute;m de ser o principal respons&aacute;vel pela execu&ccedil;&atilde;o do  pagamento, bem como a organiza&ccedil;&atilde;o para arrecada&ccedil;&atilde;o dos valores individuais para  cumprimento da execu&ccedil;&atilde;o do pagamento coletivo.</p>
      <p>        4.2. &Eacute; de responsabilidade do coordenador do grupo informar  a VESTE PRIME, caso algum membro da equipe n&atilde;o venha arcar com o repasse da sua  parcela individual para o coordenador.</p>
      <p>        4.3. Formul&aacute;rios e demais responsabilidades ser&atilde;o passados  exclusivamente a VESTE PRIME por meio do coordenador.</p>
      <p>    4.4. O coordenador d&aacute; todo e pleno direito de cada membro  saber como est&aacute; o andamento do contrato coletivo, al&eacute;m de fornecer informa&ccedil;&otilde;es  individual aos demais membros sobre o andamento do contrato.</p></td>
  </tr>
  <tr>
    <td><img src="../img/debito_em_conta.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>5.1. O n&atilde;o pagamento de uma ou mais parcelas dar&aacute; o direito  a VESTE PRIME e fazer d&eacute;bitos para cumprimento das obriga&ccedil;&otilde;es de pagamento  deste contrato nas contas pertencentes aos titulares, independente do(s) banco(s),  bem como o d&eacute;bito em contas de investimentos, poupan&ccedil;as e cart&otilde;es de cr&eacute;dito.</p>
      <p>    5.2. Cada membro assume a responsabilidade do pagamento  total do contrato, em caso da VESTE PRIME usar o artigo 5.1, a VESTE PRIME  poder&aacute; efetuar o d&eacute;bito de todo o valor em uma ou mais contas para saldar o  saldo devedor.</p></td>
  </tr>
  <tr>
    <td><img src="../img/protecao_ao_credito.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>6.1. O n&atilde;o pagamento de uma ou mais parcelas deste contrato,  dar&aacute; o direito a VESTE PRIME de incluir o nome/CPF de cada membro do grupo no  prazo m&aacute;ximo de 20 dias do vencimento de cada parcela em:</p>
      <ul>
        <li>&Oacute;rg&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito, SPC/SERASA, etc.</li>
        <li>Protesto em cart&oacute;rios.</li>
        <li>Informar a bases internas e externas sobre o  devido d&eacute;bito.</li>
      </ul>
      <p>6.2. A restri&ccedil;&atilde;o caso ocorra, ser&aacute; tirado no prazo de 5 dias  &uacute;teis do CPF do cliente nas bases restritivas de cr&eacute;dito ap&oacute;s o pagamento do saldo em atraso ou acordo firmado..</p>
      <p>        6.3. A PEDIDO POR MEIO DE SOLICITA&Ccedil;&Atilde;O DOS DEMAIS MEMBROS DO  GRUPO, UM INTEGRANTE PODER&Aacute; TER O NOME RESTRITO INDIVIDUALMENTE SE:</p>
      <ul>
        <li>N&atilde;o pagar suas parcelas individuais em dia com o  coordenador do grupo.</li>
      </ul>
      <p>6.4. Caso o item 6.4 seja usado o membro alvo ter&aacute; que  procurar a VESTE PRIME para quitar sua d&iacute;vida com o grupo.</p>
      <p>        6.5. Cada membro d&aacute; o direito de em caso seja necess&aacute;rio  usar o item 6.4 deste contrato de cobrar, negociar a d&iacute;vida por qualquer valor  a qual &eacute; vantajoso para a VESTE PRIME e do membro alvo, bem como fazer a  inclus&atilde;o e exclus&atilde;o de bases restritivas de cr&eacute;dito.</p>
      <p>    6.6. O saldo pago e negociado pela VESTE PRIME, usando o  item 6.5 ser&aacute; repassado de valor igual a todos os membros, por meio de conta  banc&aacute;ria de titularidade do cliente, sendo repassado e dividido em partes  iguais at&eacute; 70% do valor quitado no item 6.5 e cada membro solicitando do item  6.3</p></td>
  </tr>
  <tr>
    <td><img src="../img/liberacao_credito.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>7.1. A libera&ccedil;&atilde;o do cr&eacute;dito deste contrato ser&aacute; feita na conta  autorizada por meio de assinatura manual descrita acima no prazo m&aacute;ximo de 72  horas ap&oacute;s a assinatura do contrato.</p></td>
  </tr>
  <tr>
    <td><img src="../img/finalizacao_contrato.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>8.1. Este contrato estar&aacute; automaticamente FINALIZADO somente  ap&oacute;s o pagamento total das parcelas e o n&atilde;o acionamento do item 6.3, podendo  ser revisado pela VESTE PRIME de acordo com os membros deste grupo.</p></td>
  </tr>
  <tr>
    <td><img src="../img/consultas_e_liberacao_de_limites.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>9.1. Autorizo a VESTE PRIME fazer consultas peri&oacute;dicas de  acordo com suas necessidades em qualquer base de dados, bir&ocirc;s de cr&eacute;dito ou  sistemas de cadastro, bem como repassar informa&ccedil;&otilde;es de cada membro a base de  dados e ao Banco Central e parceiros.</p>
    <p>9.2. Autorizo a VESTE PRIME a alterar minhas linhas de  cr&eacute;dito, bem como cancelar sem aviso pr&eacute;vio a crit&eacute;rio e decis&atilde;o da VESTE  PRIME.</p></td>
  </tr>
  <tr>
    <td><img src="../img/condicoes_de_aceite.fw.png" width="1000" height="40" /></td>
  </tr>
  <tr>
    <td><p>10.1 Todos os membros concordam com todos as cl&aacute;usulas deste  contrato, o reconhecendo e aceitando em sua plenitude as informa&ccedil;&otilde;es deste  contrato.<br />
    10.2 O Reconhecimento e concord&acirc;ncia se d&aacute; por meio da  assinatura deste contrato por todos os membros da equipe. </p></td>
  </tr>
</table>
<table class="table" width="1000" border="0">
  <tr>
    <td><strong><p>&nbsp;</p>
Taiba - S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de <? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "março";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?> de  <? echo date("Y"); ?>    </strong></td>
  </tr>
<?
$sql_proposta = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_proposta = mysqli_fetch_array($sql_proposta)){
	$cpf_cliente = $res_proposta['cliente'];
?>
  <tr>
    <td><p>&nbsp;</p>
    <p>____________________________________________________</p>
    <p><strong><? echo $res_proposta['int_integrante']; ?> - 
	<? 
	   
	
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>    </strong>
    <br />
    <strong>CPF: <? echo $res_proposta['cliente']; ?> </strong>
       
    </p></td>
  </tr>
<? } ?>  
  <tr>
    <td><p>&nbsp;</p>
    <p>_______________________________________________________</p>
    <p>ASSINATURA DO OPERADOR:</p></td>
  </tr>
  <tr>
    <td><p>&nbsp;</p>
    <p>_____________________________________________________</p>
    <p>TESTEMUNHA 1:</p>
    <p>&nbsp;</p>
    <p>_____________________________________________________</p>
    <p>TESTEMUNHA 2:</p>
<p>&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
</body>
</html>