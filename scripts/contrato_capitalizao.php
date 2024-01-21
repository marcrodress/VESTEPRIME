<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTRATO DE ADESÃO</title>
<link href="css/contrato_capitalizao.css" rel="stylesheet" type="text/css">
</head>

<body>
	<?
    
    require "../conexao.php";
    
    $cpf = 0;
	$plano_cap = $_GET['code'];
    
	$sql_plano = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE code = '$plano_cap'");
        while($res_plano = mysqli_fetch_array($sql_plano)){
			$cpf = $res_plano['cliente'];
	
    $sql = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf'");
        while($res = mysqli_fetch_array($sql)){
			
	 $sql_credito = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente  WHERE cliente = '$cpf'");
        while($res_credito = mysqli_fetch_array($sql_credito)){
    
    ?>
<table width="1000" border="0">
  <tr>
    <td width="138" rowspan="3" align="center"><img src="../img/logo.png" width="99" height="61"></td>
    <td colspan="5" align="center" bgcolor="#999999"><strong>CONTRATO DE ADES&Atilde;O DE CAPITALIZA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td align="center" colspan="5"><strong>VESTE PRIME - VESTU&Aacute;RIO E ACESS&Oacute;RIOS DE CELULARES</strong>
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
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO CONTRATANTE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome: </strong> <? echo $res['nome']; ?></td>
    <td colspan="2"><strong>CPF:</strong > <? echo $res['cpf']; ?></td>
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
    <td width="158"><strong>N&ordm; resid&ecirc;ncia:</strong> <? echo $res['n_residencia']; ?></td>
    <td width="216"><strong>Estado:</strong> <? echo $res['estado']; ?></td>
    <td colspan="2"><strong>CEP:</strong> <? echo $res['cep']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><strong>E-mail:</strong> <? echo $res['email']; ?></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS PLANO DE CAPITALIZA&Ccedil;&Atilde;O</strong></td>
  </tr>
  <tr>
    <td><strong>PLANO:</strong> <? echo $res_plano['plano']; ?></td>
    <td width="164"><strong>PER&Iacute;ODO:</strong> 
      <?
    
	if($res_plano['plano'] == 'VAREJO'){
		echo " 12";
	}elseif($res_plano['plano'] == 'GOLD'){
		echo " 24";
	}elseif($res_plano['plano'] == 'PLATINUM'){
		echo " 36";
	}elseif($res_plano['plano'] == 'BLACK'){
		echo " 48";
	}elseif($res_plano['plano'] == 'MASTERBLACK'){
		echo " 60";
	}
	
	?> meses
    </td>
    <td><strong>CAR&Ecirc;NCIA: 
      </strong>
    <? echo $res_plano['carencia']; ?> meses </td>
    <td><strong>VALOR DO PLANO:</strong> R$ <? echo number_format($res_plano['valor'],2,',','.'); ?></td>
    <td colspan="2"><strong>DIA DO VENCIMENTO MENSAL:</strong> <? echo $res_plano['vencimento']; ?></td>
  </tr>
  <tr>
    <td colspan="3"><strong>FORMA DE PAGAMENTO:</strong> <? echo $res_plano['forma_pagamento']; ?></td>
    <td colspan="2"><strong>FORMA DE RECEBIMENTO:</strong> <? echo $res_plano['forma_recebimento']; ?></td>
    <td rowspan="2" align="center"><strong>N&Uacute;MERO DA SORTE:</strong>      <? echo $res_plano['numero_sorte']; ?></td>
  </tr>
  <tr>
    <td colspan="3"><strong>BENEFICI&Aacute;RIO:</strong> <? echo $res_plano['beneficiario']; ?></td>
    <td colspan="2"><strong>GRAU DE PARENTESCO:</strong> <? echo $res_plano['grau_parentesco']; ?></td>
  </tr>
  <tr>
    <td align="center" colspan="6" bgcolor="#CCCCCC"><strong>DESCRI&Ccedil;&Otilde;ES B&Aacute;SICAS DO TERMO DE ADES&Atilde;O  AO CONTRATO DE CONTRATA&Ccedil;&Atilde;O DE CR&Eacute;DITO VESTE PRIME</strong></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><strong>1. 
      OBJETIVO
      </strong>
      <p> 1.1. Este T&iacute;tulo  tem por objetivo  a constitui&ccedil;&atilde;o de um determinado Capital, de acordo  com o plano aprovado,  que ser&aacute; pago em moeda corrente ao Titular, desde que respeitado o disposto nestas Condi&ccedil;&otilde;es Gerais.   </p>
    <p> 1.2. A aprova&ccedil;&atilde;o deste T&iacute;tulo pela SUSEP, n&atilde;o implica, por parte da Autarquia, em incentivo ou recomenda&ccedil;&atilde;o &agrave; sua aquisi&ccedil;&atilde;o,  representando, exclusivamente, sua adequa&ccedil;&atilde;o &agrave;s normas em vigor.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>2. NATUREZA DO T&Iacute;TULO</strong>
      <p>2.1. Os direitos relativos ao T&iacute;tulo n&atilde;o poder&atilde;o ser comercializados separadamente.  &Eacute; facultada  a cess&atilde;o parcial  ou total dos direitos ou obriga&ccedil;&otilde;es do T&iacute;tulo, a qualquer momento, de acordo com a legisla&ccedil;&atilde;o vigente,  mediante comunica&ccedil;&atilde;o escrita  &agrave; Sociedade de Capitaliza&ccedil;&atilde;o.</p>
      <p>2.2 Cumpre ao Subscritor ou Titular comunicar &agrave; Sociedade de Capitaliza&ccedil;&atilde;o a  realiza&ccedil;&atilde;o da transfer&ecirc;ncia, informando os dados cadastrais do novo Subscritor  ou Titular, respectivamente, ficando  vedada a cobran&ccedil;a  de qualquer esp&eacute;cie.</p>
    <p>2.3 Cumpre ao Subscritor ou Titular manter seus dados cadastrais atualizados  perante &agrave; Sociedade de Capitaliza&ccedil;&atilde;o, para efeito de registro e controle.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>3. VIG&Ecirc;NCIA </strong>      <p>3.1. A vig&ecirc;ncia  do T&iacute;tulo &eacute; de no m&aacute;ximo <?
    
	if($res_plano['plano'] == 'VAREJO'){
		echo " 12";
	}elseif($res_plano['plano'] == 'GOLD'){
		echo " 24";
	}elseif($res_plano['plano'] == 'PLATINUM'){
		echo " 36";
	}elseif($res_plano['plano'] == 'BLACK'){
		echo " 48";
	}elseif($res_plano['plano'] == 'MASTERBLACK'){
		echo " 60";
	}
	
	?> meses,  a depsendo que todos  os direitos dele decorrentes se iniciam na data do primeiro pagamento, ou na data da aquisi&ccedil;&atilde;o, o que ocorrer  primeiro.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>4. PAGAMENTO
          </strong>
      <p>4.1. Este T&iacute;tulo ser&aacute; pago pelo Subscritor em 
        <?
    $meses_plano = 0;
	if($res_plano['plano'] == 'VAREJO'){
		echo " 12";
		$meses_plano = 12;
	}elseif($res_plano['plano'] == 'GOLD'){
		echo " 24";
		$meses_plano = 24;
	}elseif($res_plano['plano'] == 'PLATINUM'){
		echo " 36";
		$meses_plano = 36;
	}elseif($res_plano['plano'] == 'BLACK'){
		echo " 48";
		$meses_plano = 48;
	}elseif($res_plano['plano'] == 'MASTERBLACK'){
		echo " 60";
		$meses_plano = 60;
	}
		echo $meses_plano;
	?> 
parcelas, nas  respectivas datas de vencimento.</p>
<p>4.2. O n&atilde;o pagamento de qualquer parcela  at&eacute; a data de seu vencimento determinar&aacute; a suspens&atilde;o do T&iacute;tulo e de todos os pr&ecirc;mios relativos a sorteios, caso haja.</p>
      <ul>
        <li> 4.2.1. Caso o contratante seja sorteado, o mesmo perder&aacute; o pr&ecirc;mio SEM DIREITO A RECEBIMENTO DE QUALQUER PR&Ecirc;MIO caso o cliente esteja com alguma parcela em aberto.</li>
      </ul>
      <p>4.3. Durante a vig&ecirc;ncia, o T&iacute;tulo com at&eacute; 12 meses consecutivos sem pagamento, limitados a 12 (doze) meses  sem pagamento, consecutivos ou n&atilde;o, poder&aacute;  ser reabilitado, a partir da quita&ccedil;&atilde;o da parcela relativa  ao m&ecirc;s de reabilita&ccedil;&atilde;o.</p>
      <p>4.4. O T&iacute;tulo n&atilde;o participa dos sorteios, enquanto estiver na condi&ccedil;&atilde;o de suspenso.  O pagamento das parcelas em atraso n&atilde;o restabelece o direito &agrave; participa&ccedil;&atilde;o nos  sorteios ocorridos durante o per&iacute;odo de suspens&atilde;o, bem como fica CANCELADO o direito de recebimento de algum pr&ecirc;mio.</p>
      <p>4.5. A Sociedade prorrogar&aacute; a vig&ecirc;ncia do T&iacute;tulo, adicionando  os meses correspondentes ao atraso ocorrido, por tantos meses quantos forem as  parcelas em atraso, participando o Titular dos sorteios previstos  no(s) m&ecirc;s(es) de prorroga&ccedil;&atilde;o, salvo em caso de cancelamento.</p>
      <p>4.6. Os valores das parcelas ser&atilde;o  reajustados anualmente, de acordo com a varia&ccedil;&atilde;o do IGP-M/FGV do per&iacute;odo  de 12 (doze) meses, apurado  com defasagem de 2 meses  em rela&ccedil;&atilde;o a data do reajuste.</p>
        <p>- Caso  ocorra a extin&ccedil;&atilde;o  deste &iacute;ndice de reajuste, ser&aacute;  utilizado o IPCA - IBGE.</p>
        <p>4.7. Em caso de atraso, o cliente deve arcar com os juros e multas estabecidos pela contratada sendo dispostos da seguinte maneira:</p>
      <ul>
        <li>4.7.1. 5% de multa sobre o valor mensal do plano</li>
        <li>4.7.2. 0,3% de juros di&aacute;rios por dia de atraso</li>
      </ul></td>
  </tr>
  <tr>
    <td colspan="6"><strong>5. CANCELAMENTO 
    </strong>      <p>5.1 - O T&iacute;tulo ser&aacute; cancelado, na hip&oacute;tese do Subscritor deixar  de efetuar o pagamento  de 13 (treze) meses consecutivos em atraso, ou de 13 (treze) meses acumulados  em atraso, consecutivos ou n&atilde;o, durante a vig&ecirc;ncia.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>6. CAR&Ecirc;NCIA</strong>
      <p>6.1.  Car&ecirc;ncia para Resgate Antecipado Total</p>
      <p>6.2. O valor de resgate antecipado total,  calculado na forma estabelecida no item X, somente estar&aacute; dispon&iacute;vel ao Titular  ap&oacute;s 12 meses do in&iacute;cio de vig&ecirc;ncia.</p>
        <p>6.3. Car&ecirc;ncia para Resgate Antecipado Parcial</p>
    <p>Para  pagamento de resgate  antecipado parcial, dever&atilde;o  ter decorrido 12 (doze) meses do in&iacute;cio  de vig&ecirc;ncia do T&iacute;tulo, observadas ainda as regras  definidas no item 10.9.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>7. RESERVA DE CAPITALIZA&Ccedil;&Atilde;O</strong>
      <p>7.1. A Reserva de Capitaliza&ccedil;&atilde;o ser&aacute; constitu&iacute;da durante o  per&iacute;odo de vig&ecirc;ncia do T&iacute;tulo, por um percentual de cada  parcela paga, conforme tabela do item 12.1, atualizada mensalmente na data de  anivers&aacute;rio, pela taxa de remunera&ccedil;&atilde;o b&aacute;sica aplicada &agrave; caderneta de poupan&ccedil;a da data de anivers&aacute;rio e capitalizada &agrave; taxa de juros de 1%  a.m., gerando o valor de resgate do T&iacute;tulo.</p>
      <blockquote>
        <p>- Caso ocorra a extin&ccedil;&atilde;o deste  &iacute;ndice, ser&aacute; utilizado o &iacute;ndice que for considerado para atualiza&ccedil;&atilde;o da caderneta  de poupan&ccedil;a.</p>
      </blockquote>
      <p>7.2.  O capital formado  neste t&iacute;tulo ser&aacute; atualizado pela Taxa de Remunera&ccedil;&atilde;o B&aacute;sica aplicada &agrave;s cadernetas de poupan&ccedil;a  (TR), que corresponde ao rendimento das cadernetas de poupan&ccedil;a sem a parcela de  juros mensais.</p>
    <p>7.3. A aplica&ccedil;&atilde;o da taxa de juros cessar&aacute; a partir da data do  cancelamento do T&iacute;tulo por falta de pagamento, ou por resgate  antecipado total, ou ainda, a partir da data do t&eacute;rmino da vig&ecirc;ncia.</p></td>
  </tr>
  <tr>
    <td colspan="6"><strong>8. RESGATE</strong>
      <p>8.1. Ao final do prazo de vig&ecirc;ncia do T&iacute;tulo, o Titular ter&aacute; direito a 100% do valor  constitu&iacute;do na reserva de capitaliza&ccedil;&atilde;o.</p>
      <p>8.2. A tabela abaixo  apresenta o valor  m&iacute;nimo que poder&aacute; ser resgatado  pelo Titular, respeitado o prazo de car&ecirc;ncia e  decorrido um m&ecirc;s do pagamento de cada parcela:</p>
      <div>
        <p>&nbsp;</p>
        <table border="1" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" width="131" valign="top"><p><strong><u>M&Ecirc;S DE</u> <u>VIG&Ecirc;NCIA</u></strong></p></td>
            <td align="center" width="331" valign="top"><p><strong>% de resgate sobre a soma das parcelas pagas</strong></p></td>
          </tr>
          <? $i=12; while($i<($meses_plano-1)){ $i++;?>
          <tr>
            <td align="center" width="131" valign="top"><p><? echo $i; ?></p></td>
            <td align="center" width="331" valign="top"><p><? echo number_format((100/$i)+($i*1.3)+17,2); ?></p></td>
          </tr>
          <? } ?>
          <tr>
            <td align="center" width="131" valign="top"><p><? echo $meses_plano; ?></p></td>
            <td align="center" width="331" valign="top"><p>100%</p></td>
          </tr>
        </table>
       8.3. Os percentuais apresentados nesta tabela demonstrativa consideram:
        <ul>
          <li>8.3.1. m&ecirc;s de vig&ecirc;ncia como parcelas pagas nos seus respectivos vencimentos;</li>
          
          <li>8.3.2. parcelas sem reajuste;</li>
          
          <li>8.3.3. a n&atilde;o ocorr&ecirc;ncia de resgate parcial;</li>
          
          <li>8.3.4. apenas aplica&ccedil;&atilde;o de juros de 1% a.m. ao m&ecirc;s, isto &eacute;, sem considerar o &iacute;ndice de atualiza&ccedil;&atilde;o;
            <ul>
              
              <li>8.3.1. O valor do resgate ser&aacute; colocado &agrave; disposi&ccedil;&atilde;o do Titular em at&eacute; 15 dias &uacute;teis  ap&oacute;s o t&eacute;rmino da vig&ecirc;ncia ou ap&oacute;s o cancelamento do T&iacute;tulo, ou ainda, ap&oacute;s a  solicita&ccedil;&atilde;o por parte  do Titular no caso de resgate antecipado, observada a car&ecirc;ncia estabelecida no item VIII. Para  efetivar o pagamento ser&aacute; necess&aacute;ria a apresenta&ccedil;&atilde;o dos documentos, exigidos pela legisla&ccedil;&atilde;o vigente,  &agrave; Sociedade de Capitaliza&ccedil;&atilde;o.</li>
              
              <li>8.3.2. Somente ser&atilde;o devidos juros morat&oacute;rios de 1 % a.m., proporcionalmente ao n&uacute;mero de dias em atraso, caso a Sociedade de  Capitaliza&ccedil;&atilde;o <u>n&atilde;o disponibilize</u> no prazo de 15 dias &uacute;teis  o valor do pagamento do resgate e desde que atendidas as disposi&ccedil;&otilde;es  do item 10.4.</li>
              
              <li>8.3.3. O valor de resgate ser&aacute; atualizado pela taxa de remunera&ccedil;&atilde;o b&aacute;sica  aplicada &agrave; caderneta de  poupan&ccedil;a, a partir da:</li>
            </ul>
          </li>
          <li>*data de cancelamento ou data de sua solicita&ccedil;&atilde;o at&eacute; o efetivo  pagamento nos casos  de cancelamento  do T&iacute;tulo ou solicita&ccedil;&atilde;o de resgate antecipado total ou parcial;</li>
          <li>*data do t&eacute;rmino de sua vig&ecirc;ncia  at&eacute; a data do efetivo  pagamento, nos casos de resgate total. 
            <ul>
              <li>- O resgate do T&iacute;tulo, em raz&atilde;o do t&eacute;rmino de vig&ecirc;ncia ou do resgate  antecipado total, encerra quaisquer direitos previstos nestas Condi&ccedil;&otilde;es Gerais.</li>
              <li>-  Caso o valor de resgate seja superior &agrave; soma das parcelas pagas haver&aacute;  incid&ecirc;ncia de Imposto de Renda sobre a diferen&ccedil;a entre o valor de resgate e a  soma das parcelas pagas, conforme legisla&ccedil;&atilde;o em vigor, ressalvados os casos de  resgate antecipado parcial.</li>
            </ul>
          </li>
        </ul>
      </div>
      <br clear="all" />
      <div>
        <p><strong>9. RESGATE AP&Oacute;S O FIM DO PLANO</strong></p>
        <p>9.1. O contratante deve em entrar em contato diretamente com a contrada para informar os dados e forma como deseja receber o valor do pr&ecirc;mio, obedecendo os seguintes crit&eacute;rios.</p>
        <ul>
          <li>9.1.1. Se a op&ccedil;&atilde;o de resgate for por conta banc&aacute;ria, o valor ser&aacute; transferido para a conta informada no momento da contrata&ccedil;&atilde;o no prazo m&aacute;ximo de 30 dias ap&oacute;s o termino.      </li>
        </ul>
      </div></td>
  </tr>
  <tr>
    <td colspan="6"><p><strong>10. RESGATE DOS PR&Ecirc;MIOS</strong></p>
    <p>10.1. Caso haja premia&ccedil;&atilde;o o contratante concorda que:</p>
    <ul>
      <li>*Caso tenha alguma parcela em atraso no momento do sorteio, o mesmo n&atilde;o ter&aacute; direito, mesmo que fa&ccedil;a a quita&ccedil;&atilde;o ap&oacute;s o sorteio.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>
  <tr>
    <td colspan="6"></td>
  </tr>  
  
  
  <tr>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 1: </strong></p></td>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 2:</strong></p></td>
  </tr>
  <tr>
    <td align="center" colspan="6"><strong>Taiba, </strong>S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de <? $mes = date("m");
		
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
    <td colspan="6" align="center"><p>___________________________________________________</p>
<p><strong>CLIENTE: </strong><? echo $res['nome']; ?></p>
<p>___________________________________________________</p>
<p><strong>RESPONS&Aacute;VEL PELA PREENCHIMENTO DA PROP&Oacute;STA</strong></p></td>
  </tr>
</table>
<? }}} ?>
</body>
</html>