<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATO DE ADESÃO</title>
<link href="css/imprimir_contato_de_adesao.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?
    
    require "../conexao.php";
    
    $cpf = $_GET['cpf'];
    
    $sql = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf'");
        while($res = mysqli_fetch_array($sql)){
			
	 $sql_credito = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente  WHERE cliente = '$cpf'");
        while($res_credito = mysqli_fetch_array($sql_credito)){
    
    ?>
<table width="1000" border="0">
  <tr>
    <td width="248" rowspan="3" align="center"><img src="../img/logo.png" width="99" height="61"></td>
    <td colspan="5" align="center" bgcolor="#999999"><strong>TERMO DE ADES&Atilde;O  AO CONTRATO DE CONTRATA&Ccedil;&Atilde;O DE CR&Eacute;DITO VESTE PRIME CARD</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="5"><strong>VESTE PRIME - ELETR&Otilde;NICOS E ACESS&Oacute;RIOS DE CELULARES</strong>
      <hr /></td>
  </tr>
  <tr>
    <td colspan="2"><strong>CNPJ: </strong>32.450.862/0001-02</td>
    <td colspan="3"><strong>EMPRESA: </strong>MARCOS RODRIGUES DE OLIVEIRA 05379839371</td>
  </tr>
  <tr>
    <td colspan="2"><strong>TELEFONE: &nbsp;</strong>(85) 3315.6199</td>
    <td colspan="2"><strong>ENDERE&Ccedil;O:</strong> RUA CAPITAO INACIO PRATA</td>
    <td colspan="2"><strong>N&Uacute;MERO:</strong> 2010</td>
  </tr>
  <tr>
    <td colspan="4"><strong>CIDADE: </strong>S&Atilde;O GON&Ccedil;ALO DO AMARANTE - CE</td>
    <td width="113"><strong>BAIRRO:</strong> TAIBA</td>
    <td width="185"><strong>CEP: </strong>62670-000</td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome: </strong> <? echo $res['nome']; ?></td>
    <td colspan="2"><strong>CPF: </strong ><? echo $res['cpf']; ?></td>
    <td colspan="2"><strong>RG:</strong> <? echo $res['rg']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nascimento:</strong> <? echo $res['nascimento']; ?></td>
    <td colspan="2"><strong>Estado civil:</strong> <? echo $res['estado_civil']; ?></td>
    <td colspan="2"><strong>Nome do conjulge:</strong> <? echo $res['conjuge']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Sexo:</strong> <? echo $res['sexo']; ?></td>
    <td colspan="2"><strong>Nome da M&atilde;e: </strong><? echo $res['mae']; ?></td>
    <td colspan="2"><strong>Telefone:</strong> <? echo $res['celular_1']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome do pai:</strong> <? echo $res['pai']; ?></td>
    <td colspan="2"><strong>Escolaridade:</strong> <? echo $res['escolaridade']; ?></td>
    <td colspan="2"><strong>Nacionalidade:</strong> <? echo $res['nacionalidade']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Naturalidade:</strong> <? echo $res['naturalidade']; ?></td>
    <td colspan="2"><strong>Sit. Profissional:</strong> <? echo $res['sit_profissional']; ?></td>
    <td colspan="2"><strong>Profiss&atilde;o:</strong> <? echo $res['profissao']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Renda:</strong> <? echo $res['renda_mensal']; ?></td>
    <td colspan="2"><strong>Endere&ccedil;o:</strong> <? echo $res['endereco']; ?></td>
    <td colspan="2"><strong>Cidade:</strong> <? echo $res['cidade']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Bairro:</strong> <? echo $res['bairro']; ?></td>
    <td width="260"><strong>N&ordm; resid&ecirc;ncia:</strong> <? echo $res['n_residencia']; ?></td>
    <td width="165"><strong>Estado:</strong> <? echo $res['estado']; ?></td>
    <td colspan="2"><strong>CEP:</strong> <? echo $res['cep']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><strong>E-mail:</strong> <? echo $res['email']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <?
  
   $sql_verifica_avalista = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE cpf_fi = '$cpf' AND n_proposta = '".$_GET['n_proposta']."'");
   if(mysqli_num_rows($sql_verifica_avalista) >= 1){
   }else{

   $sql_verifica_avalista = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '".$_GET['n_proposta']."'");
	 	while($res_avalista = mysqli_fetch_array($sql_verifica_avalista)){
  	
	 $sql_avalista = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_avalista['cpf_fi']."'");
	 	while($res_avalista = mysqli_fetch_array($sql_avalista)){
	
  ?>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO AVALISTA</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome: </strong> <? echo $res_avalista['nome']; ?></td>
    <td colspan="2"><strong>CPF: </strong ><? echo $res_avalista['cpf']; ?></td>
    <td colspan="2"><strong>RG:</strong> <? echo $res_avalista['rg']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nascimento:</strong> <? echo $res_avalista['nascimento']; ?></td>
    <td colspan="2"><strong>Estado civil:</strong> <? echo $res_avalista['estado_civil']; ?></td>
    <td colspan="2"><strong>Nome do conjulge:</strong> <? echo $res_avalista['conjuge']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Sexo:</strong> <? echo $res_avalista['sexo']; ?></td>
    <td colspan="2"><strong>Nome da M&atilde;e: </strong><? echo $res_avalista['mae']; ?></td>
    <td colspan="2"><strong>Telefone:</strong> <? echo $res_avalista['celular_1']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome do pai:</strong> <? echo $res_avalista['pai']; ?></td>
    <td colspan="2"><strong>Escolaridade:</strong> <? echo $res_avalista['escolaridade']; ?></td>
    <td colspan="2"><strong>Nacionalidade:</strong> <? echo $res_avalista['nacionalidade']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Naturalidade:</strong> <? echo $res_avalista['naturalidade']; ?></td>
    <td colspan="2"><strong>Sit. Profissional:</strong> <? echo $res_avalista['sit_profissional']; ?></td>
    <td colspan="2"><strong>Profiss&atilde;o:</strong> <? echo $res_avalista['profissao']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Renda:</strong> <? echo $res_avalista['renda_mensal']; ?></td>
    <td colspan="2"><strong>Endere&ccedil;o:</strong> <? echo $res_avalista['endereco']; ?></td>
    <td colspan="2"><strong>Cidade:</strong> <? echo $res_avalista['cidade']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Bairro:</strong> <? echo $res_avalista['bairro']; ?></td>
    <td width="260"><strong>N&ordm; resid&ecirc;ncia:</strong> <? echo $res_avalista['n_residencia']; ?></td>
    <td width="165"><strong>Estado:</strong> <? echo $res_avalista['estado']; ?></td>
    <td colspan="2"><strong>CEP:</strong> <? echo $res_avalista['cep']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><strong>E-mail:</strong> <? echo $res_avalista['email']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <? }}} ?>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS SOBRE O CR&Eacute;DITO</strong></td>
  </tr>
<?

$sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '".$_GET['n_proposta']."'");
while($res_credito = mysqli_fetch_array($sql_emprestimo)){

?>
  <tr>
    <td colspan="2"><strong>Valor contratado:</strong> R$ <? echo  number_format($res_credito['valor'], 2, ',', '.'); ?></td>
    <td colspan="2"><strong>N&uacute;mero de parcelas:</strong> <? echo $res_credito['quant_parcela']; ?></td>
    <td colspan="2"><strong>Valor da parcela:</strong>  R$ <? echo  number_format($res_credito['valor_parcela'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Valor total a ser pago:</strong> R$ <? echo  $res_credito['valor_total']; ?></td>
    <td colspan="2"><strong>Vencimento das parcelas:</strong> <? echo $res_credito['vencimento']; ?></td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>CONTA PARA CR&Eacute;DITO</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left" bgcolor="#FFFFFF"><strong>Banco:</strong> <? echo strtoupper($res_credito['banco']); ?></td>
    <td align="center" bgcolor="#FFFFFF"><strong>Tipo de conta:</strong> <? echo strtoupper($res_credito['tipo_conta']); ?></td>
    <td align="center" bgcolor="#FFFFFF"><strong>Ag&ecirc;ncia:</strong> <? echo strtoupper($res_credito['agencia']); ?></td>
    <td colspan="2" align="center" bgcolor="#FFFFFF"><strong>Conta corrente:</strong> <? echo strtoupper($res_credito['conta']); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td align="center" colspan="6" bgcolor="#CCCCCC"><strong>DESCRI&Ccedil;&Otilde;ES B&Aacute;SICAS DO TERMO DE ADES&Atilde;O  AO CONTRATO DE CONTRATA&Ccedil;&Atilde;O DE CR&Eacute;DITO VESTE PRIME</strong></td>
  </tr>
  <tr>
    <td colspan="6"><p>A empresa MARCOS RODRIGUES DE OLIVEIRA 05379839371 registrada sob CNPJ: 32.450.862/0001-02 e que presta servi&ccedil;o financeiro como correspondente bancario, al&eacute;m de atuar no segmento de vendas de eletr&ocirc;nicos e similares ser&aacute; descrita  a seguir apenas como <strong>VESTE PRIME.</strong></p>      <ul>
        <li>CLAUSULA 1: Reconhe&ccedil;o e concordo com todos os termos em sua plenitude descritos no contrato de ades&atilde;o deste cr&eacute;dito pessoal.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 2: Reconhe&ccedil;o o valor de cr&eacute;dito que foi apresentado e aceito por mim e tenho ci&ecirc;ncia que farei o pagamento, caso seja utilizado at&eacute; a data de vencimento, bem como o mesmo pode alterado sem aviso pr&eacute;vio sempre a seguir crit&eacute;rios internos da VESTE PRIME.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 3: Reconhe&ccedil;o e tenho plena e total convic&ccedil;&atilde;o que se eu n&atilde;o pagar o cr&eacute;dito utilizado transcorridos 20 (dez) dias ap&oacute;s o vencimento poderei a crit&eacute;rio da institui&ccedil;&atilde;o financeira e/ou VESTE PRIME ter meu nome inclu&iacute;do nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 4: Afirmo que deixarei sempre meus dados atualizados sempre que houver necessidade.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 5: Reconhe&ccedil;o que irei procurar sempre a VESTE PRIME para solucionar eventuais problemas com o contrato.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 6: Afirmo que todas as informa&ccedil;&otilde;es aqui apresentadas est&atilde;o corretas.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 7: Reconhe&ccedil;o que o cancelamento do plano de pagamento (parcelas), bem como altera&ccedil;&atilde;o do mesmo, n&atilde;o me inibe de efetuar o pagamento dos limites de cr&eacute;dito utilizado.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 8: Reconhe&ccedil;o que caso eu venha solicitar o cancelamento do plano, ou VESTE PRIME ao seu crit&eacute;rio, encerrar meu contrato terei que pagar o saldo devedor que ainda estiver em aberto e que o mesmo s&oacute; efetuar&aacute; o cancelamento em sua plenitudade caso seja pago todo o limite de cr&eacute;dito utilizado.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 9: Concordo que a institui&ccedil;&atilde;o financeira e/ou a corresponde bancaria VESTE PRIME poder&aacute; cancelar meus limites de cr&eacute;dito a qualquer momento sem aviso pr&eacute;vio ou com aviso pr&eacute;vio de 30 dias sem pagamento de multa por parte da VESTE PRIME.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 10: Concordo com a altera&ccedil;&atilde;o dos meus limites de cr&eacute;ditos descritos no contrato de ades&atilde;o.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 11: Concordo que em caso de atraso das parcelas, usarei a crit&eacute;rio da VESTE PRIME o saldo de investimentos, ou qualquer outro valor de cr&eacute;dito a receber, sendo que o valor s&oacute; ser&aacute; liberado ap&oacute;s quita&ccedil;&atilde;o das parcelas em atraso.</li>
    </ul></td>
  </tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 12: Desde j&aacute;, autorizo a VESTE PRIME a fazer consultas em qualquer em meu CPF em qualquer bir&ocirc; de cr&eacute;dito ou em outras bases de dados.</li>
    </ul></td>
  </tr> 
  </tr>
    <td colspan="6"><ul>
      <li><strong>CLAUSULA 13: Informo que o avalista, se for informado, assumi todas as responsabilidades para quitar todo os saldo devedor deixado pelo cliente principal, tendo plena e total ci&ecirc;ncia que o n&atilde;o pagamento do cr&eacute;dito pelo avalista ou pelo cliente principal d&aacute; o direito a crit&eacute;rio da VESTE PRIME incluir o nome e/ou CPF  de ambos, avalista e cliente solicitante, nos org&atilde;os de proten&ccedil;&atilde;o ao cr&eacute;dito passados 20 dias de atraso.</strong></li>
    </ul></td>
  </tr> 
  </tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 14: Caso o sistema n&atilde;o detecte o pagamento, o cliente e/ou avalista se compromete a mostrar o c&oacute;digo de barras a VESTE PRIME.</li>
    </ul></td>
  </tr> 
  </tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 15: Reconhe&ccedil;o e concordo que eu e meu avalista ter&aacute; o saldo de  aplica&ccedil;&otilde;es financeiras e titulos de capitaliza&ccedil;&atilde;o at&eacute; que a penultima parcela deste cr&eacute;dito seja totalmente paga.</li>
    </ul></td>
  </tr> 
  </tr>
    <td colspan="6"><ul>
      <li><strong>CLAUSULA 16: Desde j&aacute;, autorizo a VESTE PRIME a usar o saldo de aplica&ccedil;&otilde;es e titulos de capitalaza&ccedil;&atilde;o junto a VESTE PRIME meu e/ou AVALISTA para quitar o saldo devedor referente a este cr&eacute;dito pessoal.</strong></li>
    </ul></td>
  </tr> 
  </tr>
    <td colspan="6"><ul>
      <li><strong>CLAUSULA 17: </strong>Autorizo a VESTE PRIME fazer d&eacute;bitos em quaisquer conta bancaria de minha titularidade ou do avalista para saldar este empr&eacute;stimo<strong>.</strong></li>
    </ul></td>
  </tr> 
  
  
  
   
  <tr>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 1: </strong></p></td>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 2:</strong></p></td>
  </tr>
  <tr>
    <td align="center" colspan="6">Taiba - S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de <? $mes = date("m");
		
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
	
	 ?> de  <? echo date("Y"); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><p>&nbsp;</p>
      <p>___________________________________________________</p>
<p><strong>CLIENTE: </strong><? echo $res['nome']; ?></p>
<p>&nbsp;</p>
<p>___________________________________________________</p>
<p><strong>AVALISTA: </strong><? 

  
   $sql_verifica_avalista = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE cpf_fi = '$cpf' AND n_proposta = '".$_GET['n_proposta']."'");
   if(mysqli_num_rows($sql_verifica_avalista) >= 1){
   }else{

   $sql_verifica_avalista = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_boleto WHERE n_proposta = '".$_GET['n_proposta']."'");
	 	while($res_avalista = mysqli_fetch_array($sql_verifica_avalista)){
  	
	 $sql_avalista = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_avalista['cpf_fi']."'");
	 	while($res_avalista = mysqli_fetch_array($sql_avalista)){
			
			echo strtoupper($res_avalista['nome']);
	
		}}}

 ?></p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>___________________________________________________</p>
<p><strong>RESPONS&Aacute;VEL PELA PREENCHIMENTO DA PROP&Oacute;STA</strong></p></td>
  </tr>
</table>
<? }} ?>
</body>
</html>