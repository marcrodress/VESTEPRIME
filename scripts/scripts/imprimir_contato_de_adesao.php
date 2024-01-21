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
    <td width="244" rowspan="3" align="center"><img src="../img/logo.png" width="99" height="61"></td>
    <td colspan="5" align="center" bgcolor="#999999"><strong>TERMO DE ADES&Atilde;O  AO CONTRATO DE CONTRATA&Ccedil;&Atilde;O DE CR&Eacute;DITO VESTE PRIME CARD</strong></td>
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
    <td width="145"><strong>BAIRRO:</strong> TAIBA</td>
    <td width="184"><strong>CEP: </strong>62670-000</td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>DADOS DO CLIENTE</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Nome: </strong> <? echo $res['nome']; ?></td>
    <td colspan="2"><strong>CPF:</strong ><? echo $res['cpf']; ?></td>
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
    <td width="173"><strong>N&ordm; resid&ecirc;ncia:</strong> <? echo $res['n_residencia']; ?></td>
    <td width="190"><strong>Estado:</strong> <? echo $res['estado']; ?></td>
    <td colspan="2"><strong>CEP:</strong> <? echo $res['cep']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>E-mail:</strong> <? echo $res['email']; ?></td>

    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <tr>
    <td colspan="6" align="center" bgcolor="#CCCCCC"><strong>INFORMA&Ccedil;&Otilde;ES SOBRE O SERVI&Ccedil;O CONTRATO</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Plano contratado:</strong>  <? echo strtoupper($res_credito['categoria']); ?></td>
    <td colspan="2"><strong>Valor mensal:</strong>  R$ <? echo @number_format($res_credito['valor'], 2, ',', '.'); ?></td>
    <td colspan="2"><strong>Vencimento:</strong>  <? echo $res_credito['vencimento']; ?></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Limite de cr&eacute;dito:</strong>  <? echo number_format($res_credito['limite_loja'], 2, ',', '.'); ?></td>
    <td colspan="2"><strong>Limite de financiamento:</strong>  <? echo number_format($res_credito['avista_fora'], 2, ',', '.'); ?></td>
    <td colspan="2"><strong>Cr&eacute;dito pessoal:</strong> <? echo @number_format($res_credito['credito_pessoal'], 2, ',', '.'); ?></td>
  </tr>
  <tr>
    <td align="center" colspan="6" bgcolor="#CCCCCC">
      <strong>DESCRI&Ccedil;&Otilde;ES B&Aacute;SICAS DO TERMO DE ADES&Atilde;O  AO CONTRATO DE CONTRATA&Ccedil;&Atilde;O DE CR&Eacute;DITO VESTE PRIME CARD</strong>
    </td>
  </tr>
  <tr>
    <td colspan="6"><p>A empresa MARCOS RODRIGUES DE OLIVEIRA 05379839371 registrada sob CNPJ: 32.450.862/0001-02 e que presta servi&ccedil;o financeiros como correspondente bancario, al&eacute;m de atuar no segmento de vendas de vestur&aacute;rio e acess&oacute;rios de celulares e similares ser&aacute; descrita  a seguir apenas como <strong>VESTE PRIME.</strong></p>      <ul>
        <li>CLAUSULA 1: Reconhe&ccedil;o e concordo com todos os termos em sua plenitude descritos no contrato de ades&atilde;o que faz parte integrante desde termo de aceite do contrato de ades&atilde;o.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 2: Reconhe&ccedil;o o valor de cr&eacute;dito que foi apresentado e aceito por mim e tenho ci&ecirc;ncia que farei o pagamento, caso seja utilizado at&eacute; a data de vencimento, bem como o mesmo pode alterado sem aviso pr&eacute;vio sempre a seguir crit&eacute;rios internos da VESTE PRIME.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 3: Reconhe&ccedil;o e tenho plena e total convic&ccedil;&atilde;o que se eu n&atilde;o pagar o cr&eacute;dito utilizado transcorridos 30 (dez) dias ap&oacute;s o vencimento poderei a crit&eacute;rio da VESTE PRIME ter meu nome inclu&iacute;do nos ORG&Atilde;OS DE PROTE&Ccedil;&Atilde;O AO CR&Eacute;DITO.</li>
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
      <li>CLAUSULA 7: Reconhe&ccedil;o que o cancelamento do plano, bem como altera&ccedil;&atilde;o do mesmo, n&atilde;o me inibe de efetuar o pagamento dos limites de cr&eacute;dito utilizado.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 8: Reconhe&ccedil;o que caso eu venha solicitar o cancelamento do plano, ou VESTE PRIME ao seu crit&eacute;rio encerrar meu contrato terei que pagar as parcelas futuras que ainda est&atilde;o ativas e que o mesmo s&oacute; efetuar&aacute; o cancelamento em sua plenitudade caso seja pago todo o limite de cr&eacute;dito utilizado.</li>
    </ul></td>
  </tr>
  <tr>
    <td height="25" colspan="6"><ul>
      <li>CLAUSULA 9: Concordo que a VESTE PRIME poder&aacute; cancelar meus limites de cr&eacute;dito a qualquer momento sem aviso pr&eacute;vio ou com aviso pr&eacute;vio de 30 dias sem pagamento de multa por parte da VESTE PRIME.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="6"><ul>
      <li>CLAUSULA 10: Concordo com a altera&ccedil;&atilde;o dos meus limites de dr&eacute;ditos descritos no contrato de ades&atilde;o.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 1: </strong></p></td>
    <td colspan="3"><p>___________________________________________________</p>
    <p><strong>TESTEMUNHA 2:</strong></p></td>
  </tr>
  <tr>
    <td align="center" colspan="6"><strong>Taiba, </strong>S&atilde;o Gon&ccedil;alo do Amarante, <? echo date("d"); ?> de dezembro de  <? echo date("Y"); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="center"><p>___________________________________________________</p>
<p><strong>CLIENTE: </strong><? echo $res['nome']; ?></p>
<p>___________________________________________________</p>
<p><strong>RESPONS&Aacute;VEL PELA PREENCHIMENTO DA PROP&Oacute;STA</strong></p></td>
  </tr>
  <tr>
    <td align="left" colspan="6"><p align="left"><strong><em>PREZADO CLIENTE</em></strong><br />
        A <strong>MARCOS RODRIGUES DE OLIVEIRA  05379839371,&nbsp; </strong>a seguir denominada,  apenas VESTE PRIME<strong>.</strong>, com sede na Rua  Capit&atilde;o In&aacute;cio Prata, 2010 &ndash; CEP: 62670-000 &ndash; BAIRRO: TAIBA &ndash; S&Atilde;O GON&Ccedil;ALO DO  AMARANTE, CNPJ/MF n&ordm; 32.450.862/0001-02, emite&nbsp;  e&nbsp; administra&nbsp; os servi&ccedil;os de compras a prazo, a seguir  denominada apenas como VESTE PRIME CARD <strong></strong>e apresenta a voc&ecirc; as&nbsp; condi&ccedil;&otilde;es&nbsp;  de uso do cart&atilde;o que voc&ecirc; solicitou. <strong><em>VEJA&nbsp; O QUE DIZ O CONTRATO</em></strong>. <strong><em>LEIA-O  COM MUITA ATEN&Ccedil;&Atilde;O, ENTENDA AS REGRAS DE USO E UTILIZE O OS PRODUTOS E SERVI&Ccedil;OS DO CART&Atilde;O VESTE PRIME CARD.</em></strong><br />
        <strong><em>SOMENTE ASSINE O CONTRATO SE  ESTIVER DE ACORDO</em></strong><strong>. </strong>Em  caso de d&uacute;vidas, entre em contato conosco.</p>
      <p align="left"><strong><em><u>1. VESTE PRIME CARD</u></em></strong><strong><em>. </em></strong>O <strong><em>cart&atilde;o </em></strong>&eacute; um meio de pagamento para transa&ccedil;&otilde;es de aquisi&ccedil;&atilde;o&nbsp; de produtos e servi&ccedil;os em estabelecimentos da  rede VESTE PRIME ou lojas e parceiros conveniados, cuja disponibilidade ser&aacute;  indicada em sua fatura, nos  estabelecimentos da VESTE PRIME ou por meio do site eletr&ocirc;nico  www.vesteprime.com.br.</p>
<p align="left"><strong><em><u>2. TITULAR DO CART&Atilde;O</u></em></strong><strong>. </strong>Voc&ecirc; &eacute; o <strong><em>titular </em></strong>do <strong><em>VESTE PRIME CARD </em></strong>e pode, se desejar, indicar outras pessoas do  seu relacionamento apresentando algum grau de paresntesto ou n&atilde;o, <strong>desde que maiores de 18 anos</strong>, como <strong><em>adicionais</em></strong>, <strong>sob sua exclusiva responsabilidade</strong>,  inclusive pelas transa&ccedil;&otilde;es por elas realizadas e o respectivo pagamento. Voc&ecirc; <strong>pode exclu&iacute;-las&nbsp; </strong>sempre&nbsp;  que&nbsp; desejar.</p>
<p align="left"><strong><em><u>3. EMISS&Atilde;O DO CART&Atilde;O E LIMITES</u></em></strong><strong><em>. </em></strong>Ao  solicitar o <strong><em>cadastro com aprova&ccedil;&atilde;o de cr&eacute;dito </em></strong>voc&ecirc; autoriza o <strong>VESTE PRIME </strong>a analisar os seus dados e  dos seus <strong><em>adicionais</em></strong> a qualquer base que for de inteiro interesse da VESTE PRIME e de acordo com a pol&iacute;tica de cr&eacute;dito e cadastro vigentes.</p>
<ol>
        <ol>
          <li>Aprovado o cr&eacute;dito,  voc&ecirc; recebe o seu <strong><em>cart&atilde;o </em></strong>e o dos <strong><em>adicionais</em></strong>, se indicados, e tem o <strong><em>limite de cr&eacute;dito</em></strong> informado na sua <strong><em>fatura </em></strong>mensal.</li>
          <li>O <strong><em>limite de cr&eacute;dito </em></strong>pode ser alterado  conforme a pol&iacute;tica de cr&eacute;dito e pode sofrer altera&ccedil;&otilde;es sempre que a VESTE  PRIME julgar necess&aacute;rio sem qualquer tipo de aviso pr&eacute;vio, sendo que ao assinar  este contrato o cliente j&aacute; se encontra ciente das condi&ccedil;&otilde;es.</li>
          <li>O <strong><em>limite  de cr&eacute;dito </em></strong>&eacute; <strong>reduzido </strong>pelo  valor total das transa&ccedil;&otilde;es realizadas, das tarifas e encargos e <strong>restabelecido</strong>, automaticamente, na  propor&ccedil;&atilde;o do valor pago, em at&eacute; 72 horas do pagamento, no prazo da compensa&ccedil;&atilde;o  e libera&ccedil;&atilde;o.</li></ol>
      </ol>
      <ul>
        <li><strong><em>DESBLOQUEIO DO SERVI&Ccedil;OS DE COMPRA A  PRAZO E ADES&Atilde;O &Agrave;S REGRAS</u></em></strong>. Ao receber receber este contrato confira  os dados. Se estiverem corretos <strong>e se  voc&ecirc; concordar com as regras deste contrato</strong>, <strong>assine para o operador efetue o desbloqueio conforme orienta&ccedil;&atilde;o da  VESTE PRIME</strong>.</li>
        </li>
      </ul>
      </ol>
      <p><strong>      FIQUE ATENTO! A VESTE PRIME FORNECE SENHA, ONDE A COMPRA &Eacute; OBRIGAT&Oacute;RIA  NAS LOJAS VESTE PRIME OU PARCEIROS COM O USO DE SENHA ELETR&Ocirc;NICA E APRESENTA&Ccedil;&Atilde;O  DO DOCUMENTO DE IDENTIFICA&Ccedil;&Atilde;O</strong></p>
      <p><strong>IMPORTANTE!  AO ASSINAR ESTE CONTRATO O CLIENTE CONCORDA COM TODOS OS TERMOS DESCRITOS NO  MESMO.</strong>      <br clear="all" />
    </p>
<p><strong><em><u>4. USO DO CART&Atilde;O</u></em></strong>.  Voc&ecirc; e os <strong><em>adicionais </em></strong>devem conferir os dados de todas as transa&ccedil;&otilde;es  realizadas no <strong><em>cart&atilde;o</em></strong>.&nbsp; A assinatura no  comprovante de venda, a digita&ccedil;&atilde;o da <strong><em>senha </em></strong>ou a confirma&ccedil;&atilde;o da  opera&ccedil;&atilde;o&nbsp; por&nbsp; meio&nbsp;  dos canais eletr&ocirc;nicos (internet ou telefone) demonstram sua  concord&acirc;ncia e formalizam a transa&ccedil;&atilde;o realizada.</p>
      <strong>      FIQUE ATENTO! VOC&Ecirc; &Eacute; O &Uacute;NICO RESPONS&Aacute;VEL PELAS SUAS TRANSA&Ccedil;&Otilde;ES E  DE SEUS ADICIONAIS REALIZADAS COM O CART&Atilde;O JUNTO AOS ESTABELECIMENTOS. A VESTE  PRIME N&Atilde;O RESPONDE PELO PRE&Ccedil;O, QUANTIDADE, QUALIDADE DO BEM OU SERVI&Ccedil;O QUE VOC&Ecirc;  ADQUIRIR E NEM POR EVENTUAL RESTRI&Ccedil;&Atilde;O AO USO DO CART&Atilde;O OU POR EVENTUAL DESACORDO  COMERCIAL ENTRE VOC&Ecirc; E O ESTABELECIMENTO.
      </strong>
      <ol>
        <ol>
          <li>&Eacute;  expressamente vedada a utiliza&ccedil;&atilde;o do <strong><em>cart&atilde;o </em></strong>em transa&ccedil;&otilde;es n&atilde;o permitidas  pela legisla&ccedil;&atilde;o, tais como apostas via internet, cassinos ou compra de bens que  configurem investimento no exterior ou importa&ccedil;&atilde;o. O descumprimento poder&aacute; ensejar&aacute;  o imediato cancelamento do <strong><em>cart&atilde;o</em></strong>.</li>
          <li>O <strong><em>cart&atilde;o </em></strong>pode ser retido no estabelecimento se estiver cancelado, vencido ou for  constatada irregularidade.</li>
          <li>O <strong><em>CART&Atilde;O </em></strong>PODE SER BLOQUEADO SE VOC&Ecirc; ESTIVER EM <strong>ATRASO </strong>COM AS OBRIGA&Ccedil;&Otilde;ES DESTE CONTRATO OU OUTRA OBRIGA&Ccedil;&Atilde;O  DECORRENTE DE QUALQUER OPERA&Ccedil;&Atilde;O MANTIDA COM A VESTE PRIME.&nbsp; TAMB&Eacute;M PODE SER BLOQUEADO AT&Eacute; O PAGAMENTO  INTEGRAL DE D&Iacute;VIDA REFINANCIADA OU, AINDA, SE FOR CONSTATADO IND&Iacute;CIO DE FRAUDE  NA UTILIZA&Ccedil;&Atilde;O DO <strong><em>CART&Atilde;O</em></strong>.</li>
          <li>Regularizado  o motivo que ocasionou o bloqueio do seu <strong><em>cart&atilde;o</em></strong>, a VESTE PRIME ao seu  crit&eacute;rio pode restabelecer o uso.&nbsp; N&atilde;o  havendo regulariza&ccedil;&atilde;o, o <strong><em>cart&atilde;o </em></strong>ser&aacute; cancelado ou mesmo que o seja resolvido o motivo que ocasionou  o bloqueio a crit&eacute;rio da VESTE PRIME o cart&atilde;o poder&aacute; continuar bloqueado ou  poder&aacute; ser cancelado, sendo que o cliente ter&aacute; que continuar com o pagamentos  das transa&ccedil;&otilde;es j&aacute; realizadas sob pena de ter o CPF cadastrados nos org&atilde;os de  prote&ccedil;&atilde;o ao cr&eacute;dito.</li>
          <li>Fica  a crit&eacute;rio do estabelecimento a cobrar pelos juros que melhor lhe convir, desde  que obede&ccedil;a a legisla&ccedil;&atilde;o vigente.</li>
          <li>Voc&ecirc;  pode consultar o <strong><em>CUSTO EFETIVO TOTAL (CET) </em></strong>nas <strong><em>faturas </em></strong>mensais e,  previamente &agrave; contrata&ccedil;&atilde;o das opera&ccedil;&otilde;es de cr&eacute;dito, nos respectivos canais de  atendimento. O <strong><em>CET</em></strong>, expresso na forma de taxa percentual&nbsp; anual e calculado conforme as normas  aplic&aacute;veis, corresponde aos encargos, tributos, tarifas e outras despesas  incidentes sobre as opera&ccedil;&otilde;es de cr&eacute;dito especificadas neste contrato.</li>
          <li>A  qualquer momento e sem aviso pr&eacute;vio a VESTE PRIME pode alterar os servi&ccedil;os bem  como bloquear ou cancelar alguns ou todos os servi&ccedil;os ofertados pelo cart&atilde;o  VESTE PRIME CARD.</li>
        </ol>
      </ol>
      <p><strong><em><u>5. SERVI&Ccedil;O DE AVALIA&Ccedil;&Atilde;O EMERGENCIAL DE  CR&Eacute;DITO</u></em></strong>. Se dispon&iacute;vel em seu <strong><em>cart&atilde;o</em></strong>, voc&ecirc; pode  contratar o Servi&ccedil;o de Avalia&ccedil;&atilde;o Emergencial de Cr&eacute;dito, que consiste na  avalia&ccedil;&atilde;o, pelo sistema da VESTE PRIME, em car&aacute;ter emergencial, da viabilidade  de autorizar transa&ccedil;&atilde;o acima do seu limite de  cr&eacute;dito.</p>
<strong>      IMPORTANTE! A AUTORIZA&Ccedil;&Atilde;O DA  TRANSA&Ccedil;&Atilde;O ACIMA DO LIMITE DEPENDE DE AN&Aacute;LISE DE CR&Eacute;DITO DE ACORDO COM A  POL&Iacute;TICA DA VESTE PRIME E PODE SER OU N&Atilde;O CONCEDIDA.
</strong>      <ol>
        <ol>
          <li>Esse  servi&ccedil;o &eacute; realizado no momento em que voc&ecirc; utilizar o <strong><em>cart&atilde;o </em></strong>acima do seu  limite de&nbsp; cr&eacute;dito&nbsp; dispon&iacute;vel e, se autorizado, ser&aacute; cobrada <strong>TARIFA</strong>,  tarifa essa que &eacute; alterada de acordo com a politica da VESTE PRIME e se  encontra dispon&iacute;vel em mural de avisos, sempre que for alterado o valor da  TARIFA ao usar o cart&atilde;o o cliente estar&aacute; concordando com os termos.</li>
        </ol>
      </ol>
      ATEN&Ccedil;&Atilde;O! A autoriza&ccedil;&atilde;o emergencial n&atilde;o significa aumento do limite do  seu <em>cart&atilde;o</em>.
      <ol>
        <blockquote>
          <p>VOC&Ecirc; PODE CANCELAR  ESSE SERVI&Ccedil;O A QUALQUER MOMENTO.</p>
        </blockquote>
      </ol>
      <p><strong><em><u>6. PAGAMENTO DE CONTAS</u></em></strong><strong>.&nbsp;&nbsp; </strong>Caso dispon&iacute;vel, voc&ecirc; pode utilizar o <strong><em>cart&atilde;o </em></strong>para o pagamento avulso de boletos&nbsp;&nbsp;  e outras contas, <strong>EXCETO FATURAS DO  VESTE PRIME CARD</strong>, sujeito &agrave; cobran&ccedil;a de <strong>TARIFA, JUROS e IOF</strong>. </p>
      <ol>
        <ol>
          <li>O  limite de cr&eacute;dito do <strong><em>cart&atilde;o </em></strong>n&atilde;o pode ser ultrapassado  para o pagamento de contas, ainda que ocorra a recomposi&ccedil;&atilde;o no m&ecirc;s. Se isso  ocorrer, essa transa&ccedil;&atilde;o pode ficar indispon&iacute;vel ou o <strong><em>cart&atilde;o </em></strong>ser cancelado.</li>
          <li>A  crit&eacute;rio da VESTE PRIME poder&aacute; ser feito avalia&ccedil;&atilde;o emergencial de cr&eacute;dito para  esses servi&ccedil;os.</li>
        </ol>
      </ol>
      <p align="left">&nbsp;</p>
      <p><strong><em><u>7. SAQUE E EMPR&Eacute;STIMO PESSOAL</u></em></strong>.  Com o <strong><em>cart&atilde;o </em></strong>voc&ecirc; pode realizar saques e contratar empr&eacute;stimo  pessoal, desde que essas transa&ccedil;&otilde;es estejam dispon&iacute;veis para voc&ecirc;. Os encargos  s&atilde;o informados na <strong><em>fatura</em>.</strong></p>
      <ol>
        <ol>
          <li><strong>SAQUES. </strong>Em dinheiro  e at&eacute; o valor autorizado especificamente para essa transa&ccedil;&atilde;o. Incidem <strong>JUROS</strong>, calculados desde a data do saque  at&eacute; a data de vencimento da <strong><em>fatura</em>, IOF e TARIFA</strong>, para os saques  realizados&nbsp; no pa&iacute;s. Para saques no  exterior incide <strong>TARIFA e IOF</strong>.</li>
          <ol>
            <li>O  valor total do saque e respectivos encargos devem ser pagos no vencimento da <strong><em>fatura </em></strong>ou, se dispon&iacute;vel em seu <strong><em>cart&atilde;o</em></strong>, de forma parcelada, nas  condi&ccedil;&otilde;es contratadas por voc&ecirc;.</li>
          </ol>
          <li><strong>EMPR&Eacute;STIMO  PESSOAL</strong>. Limite de cr&eacute;dito adicional para a contrata&ccedil;&atilde;o de  empr&eacute;stimo, nas condi&ccedil;&otilde;es que vierem a ser previamente informadas a voc&ecirc;.  Incidem <strong>JUROS e IOF</strong>. As parcelas do  empr&eacute;stimo contratado s&atilde;o cobradas por meio da sua <strong><em>fatura</em></strong><em>.</em></li>
        </ol>
      </ol>
      <p><strong><em><u>8. FATURA</u></em></strong>. &Eacute;  a presta&ccedil;&atilde;o de contas disponibilizada pela VESTE PRIME a voc&ecirc; e cont&eacute;m os  limites de cr&eacute;dito, os dados das transa&ccedil;&otilde;es realizadas com o seu <strong><em>cart&atilde;o</em></strong>,  a data de vencimento escolhida, as opera&ccedil;&otilde;es de cr&eacute;dito dispon&iacute;veis, as formas  de pagamento da fatura, os <strong>JUROS</strong>, o <strong>IOF</strong>, as <strong>TARIFAS</strong>, os demais encargos devidos, o <strong>VALOR TOTAL</strong>, o <strong>VALOR M&Iacute;NIMO</strong>,  que necessariamente voc&ecirc; deve pagar no vencimento para n&atilde;o ficar em atraso, <strong>AVISOS IMPORTANTES</strong>, dentre outras informa&ccedil;&otilde;es.</p>
      <ol>
        <ol>
          <li>Se  por qualquer motivo a fatura n&atilde;o for disponibilizada, entre em contato com a  VESTE PRIME, pois voc&ecirc; sempre dever&aacute; efetuar o pagamento at&eacute; a data de vencimento.</li>
          <li><strong>IMPORTANTE</strong>!  Confira todas as transa&ccedil;&otilde;es lan&ccedil;adas na sua <strong><em>fatura</em></strong>. <strong>Reclama&ccedil;&otilde;es devem ser feitas em at&eacute; 45 dias contados do vencimento da <em>fatura </em>e ser&atilde;o analisadas pela VESTE PRIME, que poder&aacute; solicitar  a voc&ecirc; a</strong></li>
        </ol>
      </ol>
      <p align="left"><strong>apresenta&ccedil;&atilde;o  de documentos</strong>. A an&aacute;lise n&atilde;o o exime do pagamento dos  demais valores lan&ccedil;ados na <strong><em>fatura</em></strong>.&nbsp; Ap&oacute;s esse prazo as transa&ccedil;&otilde;es ser&atilde;o  consideradas reconhecidas por voc&ecirc;.</p>
      <ol>
        <ol>
          <ol>
            <li>Se  constatada a regularidade da transa&ccedil;&atilde;o reclamada, essa transa&ccedil;&atilde;o ser&aacute; lan&ccedil;ada  em <strong><em>fatura </em></strong>posterior, com encargos.</li>
          </ol>
        </ol>
      </ol>
      <p><strong><em><u>9. FORMAS DE PAGAMENTO</u></em></strong><strong><em>. </em></strong>VOC&Ecirc;  DEVE PAGAR O VALOR TOTAL DA SUA FATURA MENSAL AT&Eacute; A DATA DE VENCIMENTO, OU, SE  PREFERIR, PODE ESCOLHER POR UMA DAS OP&Ccedil;&Otilde;ES A  SEGUIR.</p>
     SE VOC&Ecirc; N&Atilde;O POSSUIR CR&Eacute;DITO ROTATIVO VIGENTE NO M&Ecirc;S, voc&ecirc; pode:
      <p>a) <strong><u>pagar qualquer  valor entre o Pagamento M&iacute;nimo e o Valor&nbsp;  Total&nbsp; da <em>fatura</em></u></strong>.&nbsp; Quando voc&ecirc;  opta por esse pagamento, a diferen&ccedil;a entre o que foi pago por voc&ecirc; e o Valor  Total da <strong><em>fatura </em></strong>&eacute; financiada at&eacute; o vencimento da pr&oacute;xima <strong><em>fatura </em></strong>com a cobran&ccedil;a de IOF e dos juros informados na <strong><em>fatura </em></strong>para o Cr&eacute;dito  Rotativo.<br />
        Regra  de amortiza&ccedil;&atilde;o: o valor pago ser&aacute; utilizado para liquidar os eventuais encargos  de mora e as eventuais parcelas de opera&ccedil;&otilde;es de cr&eacute;dito j&aacute; contratadas e,  ainda, para amortizar as novas transa&ccedil;&otilde;es e/ou compras lan&ccedil;adas na sua <strong><em>fatura</em></strong>.</p>
      SE VOC&Ecirc; J&Aacute; POSSUIR UM CR&Eacute;DITO ROTATIVO VIGENTE NO M&Ecirc;S, voc&ecirc; pode:
      <ol>
        <li><strong><u>pagar  qualquer valor entre o Pagamento M&iacute;nimo e o Pagamento Parcial da <em>fatura</em></u></strong><strong>. </strong>Quando voc&ecirc;  faz essa op&ccedil;&atilde;o, ocorre o seguinte:</li>
        <ol>
          <li>a diferen&ccedil;a entre o valor pago e o  valor do Pagamento Parcial &eacute; parcelada automaticamente com a incid&ecirc;ncia de IOF  e dos juros informados na <strong><em>fatura </em></strong>para o Parcelamento  Autom&aacute;tico. A quantidade de parcelas &eacute; definida conforme o valor parcelado e  demais crit&eacute;rios estabelecidos pela VESTE PRIME e a primeira parcela &eacute; lan&ccedil;ada  apenas na pr&oacute;xima fatura;</li>
          <li>a diferen&ccedil;a entre o valor do  Pagamento Parcial e o Valor Total da <strong><em>fatura </em></strong>ser&aacute; financiada at&eacute; o  vencimento da pr&oacute;xima fatura com a cobran&ccedil;a de IOF e dos juros informados na <strong><em>fatura </em></strong>para o Cr&eacute;dito Rotativo.</li>
        </ol>
      </ol>
      <p>Regra  de amortiza&ccedil;&atilde;o: o valor pago ser&aacute; utilizado para liquidar os eventuais encargos  de mora e as eventuais parcelas de opera&ccedil;&otilde;es de cr&eacute;dito j&aacute; contratadas e,  ainda, para amortizar o Cr&eacute;dito Rotativo vigente naquele m&ecirc;s.</p>
      <ol>
        <li><strong><u>pagar  qualquer valor entre o Pagamento Parcial e o Valor Total da <em>fatura</em></u></strong><strong>. </strong>Quando voc&ecirc;  faz isso, a diferen&ccedil;a entre o valor pago por voc&ecirc; e o Valor Total da <strong><em>fatura </em></strong>&eacute; financiada at&eacute; o vencimento da pr&oacute;xima <strong><em>fatura </em></strong>com a cobran&ccedil;a de  IOF e dos juros informados na <strong><em>fatura </em></strong>para o Cr&eacute;dito Rotativo.</li>
      </ol>
      <p>Regra  de amortiza&ccedil;&atilde;o: o valor pago ser&aacute; utilizado para liquidar os eventuais encargos  de mora, as&nbsp; eventuais parcelas de  opera&ccedil;&otilde;es de cr&eacute;dito j&aacute; contratadas e o Cr&eacute;dito Rotativo vigente naquele m&ecirc;s e,  se suficiente, para amortizar as novas transa&ccedil;&otilde;es e/ou compras lan&ccedil;adas na sua <strong><em>fatura</em></strong>.</p>
      <ol>
        <ol>
          <li>Se  dispon&iacute;vel, voc&ecirc; ainda pode <strong><u>PARCELAR  O VALOR DA FATURA</u></strong>. Voc&ecirc; pode contratar o parcelamento do valor total ou  parcial da sua <strong><em>fatura</em></strong><em>, </em>conforme os  planos&nbsp; oferecidos pela VESTE PRIME. Para  essa contrata&ccedil;&atilde;o&nbsp; voc&ecirc; deve pagar o valor  da primeira parcela na data de vencimento da sua <strong><em>fatura</em></strong>, em um &uacute;nico  pagamento, sendo que o saldo em aberto &eacute; distribu&iacute;do em parcelas, que s&atilde;o  lan&ccedil;adas automaticamente nas&nbsp; pr&oacute;ximas <strong>faturas, </strong>com incid&ecirc;ncia dos juros do  plano de parcelamento escolhido e IOF.</li>
        </ol>
      </ol>
      <p align="left">&nbsp;</p>
      <em><u><strong>10. FALTA DE PAGAMENTO OU ATRASO</strong></u></em><strong>.</strong> NA FALTA,  INSUFICI&Ecirc;NCIA OU ATRASO NO PAGAMENTO DE, PELO MENOS, O VALOR M&Iacute;NIMO, O CART&Atilde;O  PODE SER BLOQUEADO E/OU CANCELADO.
      <ol>
        <ol>
          <li><strong>Nessa  hip&oacute;tese, voc&ecirc; deve pagar o saldo devedor total, inclusive as transa&ccedil;&otilde;es a  vencer e/ou em processamento, sobre o qual incidem, desde o vencimento at&eacute; a  data do efetivo pagamento, (i) JUROS REMUNERAT&Oacute;RIOS &agrave; taxa praticada para  &ldquo;Saques&rdquo; indicada na fatura, (ii) IOF, (iii) MULTA de 23,99% e (iv) JUROS  MORAT&Oacute;RIOS de 30% ao m&ecirc;s, estes calculados sobre o valor da obriga&ccedil;&atilde;o vencida  acrescido da multa. A capitaliza&ccedil;&atilde;o dos juros, remunerat&oacute;rios e morat&oacute;rios,  ser&aacute; mensal.</strong></li>
          <li>Todas  as despesas&nbsp; incorridas pela VESTE PRIME para  a cobran&ccedil;a do d&eacute;bito, tais como, postagem, &oacute;rg&atilde;os&nbsp; de prote&ccedil;&atilde;o ao cr&eacute;dito, liga&ccedil;&otilde;es telef&ocirc;nicas,  custas extrajudiciais e judiciais, honor&aacute;rios advocat&iacute;cios e outras ser&atilde;o  cobradas de voc&ecirc;. Da mesma forma, voc&ecirc; ser&aacute; ressarcido das despesas que  incorrer caso tenha que recorrer a procedimento extrajudicial ou judicial para  que a VESTE PRIME cumpra&nbsp; as&nbsp; obriga&ccedil;&otilde;es&nbsp;  assumidas neste contrato.</li>
          <li>No  atraso, todas as suas obriga&ccedil;&otilde;es&nbsp; poder&atilde;o  ser consideradas&nbsp; vencidas  antecipadamente e exigido o&nbsp; saldo  devedor total e os encargos.</li>
          <li>O  cliente tem plena e total ci&ecirc;ncia que a crit&eacute;rio da VESTE PRIME poder&aacute; teu seu  CPF (CADASTRO DE PESSOAS F&Iacute;SCIAS) nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito ap&oacute;s 1 (um)  de atraso do pagamento da fatura.</li>
        </ol>
      </ol>
      <p><strong><em><u>11. TARIFAS</u></em></strong><strong><em>. </em></strong>AO  ADERIR A ESTE CONTRATO VOC&Ecirc; EST&Aacute; SUJEITO &Agrave; COBRAN&Ccedil;A DAS TARIFAS A SEGUIR  INDICADAS:</p>
      <ol>
        <li>pelo per&iacute;odo de 12 meses de uso, <strong>TARIFA DE ANUIDADE DIFERENCIADA </strong>no <strong>CART&Atilde;O DIFERENCIADO</strong>, que oferece  programas de benef&iacute;cio e/ou recompensas vinculadas ao <strong><em>cart&atilde;o </em></strong>ou, <strong>TARIFA DE ANUIDADE </strong>no <strong>CART&Atilde;O B&Aacute;SICO</strong>, que n&atilde;o oferece  benef&iacute;cios e/ou recompensas;</li>
        <li><strong>AVALIA&Ccedil;&Atilde;O EMERGENCIAL DE CR&Eacute;DITO</strong>, conforme disposto  neste contrato.</li>
        <li><strong>FORNECIMENTO  DE 2&ordf; VIA DE CART&Atilde;O</strong>, em raz&atilde;o de perda, roubo, furto, dano ou outros  motivos que n&atilde;o sejam de responsabilidade do <strong>SANTANDER</strong>.</li>
        <li><strong>FORNECIMENTO EMERGENCIAL DE 2&ordf; VIA DE CART&Atilde;O</strong>, caso voc&ecirc; solicite  esse servi&ccedil;o.</li>
        <li><strong>FORNECIMENTO DE PL&Aacute;STICO DE CART&Atilde;O PERSONALIZADO, </strong>caso voc&ecirc; solicite  esse servi&ccedil;o.</li>
        <li><strong>UTILIZA&Ccedil;&Atilde;O DE CANAIS DE ATENDIMENTO PARA SAQUE EM  ESP&Eacute;CIE</strong>, caso voc&ecirc; solicite esse servi&ccedil;o.</li>
        <li><strong>PAGAMENTO DE CONTAS NA FUN&Ccedil;&Atilde;O CR&Eacute;DITO</strong>, caso voc&ecirc; utilize  esse servi&ccedil;o.</li>
        <li><strong>ENVIO  DE MENSAGEM AUTOM&Aacute;TICA RELATIVA A LAN&Ccedil;AMENTOS NO CART&Atilde;O DE CR&Eacute;DITO</strong>,  caso voc&ecirc; solicite esse servi&ccedil;o.</li>
        <ol>
          <li>O  pagamento da anuidade pode ser parcelado, conforme op&ccedil;&otilde;es oferecidas pela VESTE  PRIME. Se dispon&iacute;vel em seu <strong><em>cart&atilde;o</em></strong>.</li>
          <li>A VESTE PRIME pode alterar os  valores das tarifas, mediante pr&eacute;via comunica&ccedil;&atilde;o por meio da tabela de servi&ccedil;os  afixada nas lojas da VESTE PRIME e divulgada no <em>site </em>e/ou por outros canais de atendimento disponibilizados,  ou, ainda, estabelecer pre&ccedil;os diferenciados temporariamente em raz&atilde;o de  negocia&ccedil;&otilde;es espec&iacute;ficas.</li>
        </ol>
      </ol>
      <p align="left">&nbsp;</p>
      <em><u>PERDA, FURTO, ROUBO OU  EXTRAVIO DO CART&Atilde;O</u></em>. EM RAZ&Atilde;O DO SEU DEVER DE  BOA-F&Eacute;&nbsp; E COOPERA&Ccedil;&Atilde;O, VOC&Ecirc; E OS  ADICIONAIS OBRIGAM-SE A FORNECER E MANTER ATUALIZADOS SEUS DADOS CADASTRAIS  PARA O ENVIO DE AVISO DE ALERTA PELA VESTE PRIME OU CONFIRMA&Ccedil;&Atilde;O DE  TRANSA&Ccedil;&Atilde;O&nbsp; E,&nbsp; EM CASO DE PERDA, FURTO, ROUBO OU EXTRAVIO DO  CART&Atilde;O, EST&Aacute; OBRIGADO A COMUNICAR<u> IMEDIATAMENTE</u> A CENTRAL DE ATENDIMENTO  VESTE PRIME E, SE NO EXTERIOR, TAMB&Eacute;M O SERVI&Ccedil;O INTERNACIONAL DA RESPECTIVA BANDEIRA.
      <ol>
        <blockquote>
          <p><strong>SE  VOC&Ecirc; CUMPRIR O DISPOSTO NO ITEM 15, A VESTE PRIME EFETUAR&Aacute; O BLOQUEIO DO CART&Atilde;O  E RESPONDER&Aacute; PELAS COMPRAS DE PRODUTOS E/OU SERVI&Ccedil;OS E PELOS SAQUES REALIZADOS  POR TERCEIROS<u> SEM AUTENTICA&Ccedil;&Atilde;O DE SENHA PESSOAL</u> PELO PRAZO DE 48 HORAS  ANTES DA SUA COMUNICA&Ccedil;&Atilde;O.</strong></p>
          <p><strong>SE  VOC&Ecirc; N&Atilde;O CUMPRIR O DISPOSTO NO ITEM 15, VOC&Ecirc; SER&Aacute; O &Uacute;NICO E EXCLUSIVO  RESPONS&Aacute;VEL POR TODA E QUALQUER TRANSA&Ccedil;&Atilde;O E SAQUES REALIZADOS NO CART&Atilde;O.</strong></p>
        </blockquote>
      </ol>
      <p><strong><u>12. COMUNICA&Ccedil;&Atilde;O</u></strong><strong>. </strong>A VESTE  PRIME pode realizar quaisquer comunica&ccedil;&otilde;es relacionadas com este contrato e  realizar a oferta de produtos e servi&ccedil;os por meio dos canais de comunica&ccedil;&atilde;o  disponibilizados, inclusive, por e- mail e/ou mensagens/notifica&ccedil;&otilde;es  eletr&ocirc;nicas autom&aacute;ticas em dispositivos m&oacute;veis (tais como SMS, MMS ou PUSH).  Tamb&eacute;m por essa raz&atilde;o, voc&ecirc; se obriga a manter o seu cadastro sempre  atualizado, inclusive o n&uacute;mero&nbsp; de seu  celular e endere&ccedil;o de e-mail, sendo de sua exclusiva e integral  responsabilidade todas as consequ&ecirc;ncias decorrentes da omiss&atilde;o dessa obriga&ccedil;&atilde;o.  Voc&ecirc; receber&aacute; as mensagens/notifica&ccedil;&otilde;es em&nbsp;  seus&nbsp; dispositivos&nbsp; m&oacute;veis desde que estejam ligados em &aacute;rea de  cobertura da sua operadora de telefonia m&oacute;vel e/ou conectados&nbsp;&nbsp; &agrave; internet e desde que estejam habilitados  para receber tais mensagens/notifica&ccedil;&otilde;es. A VESTE PRIME n&atilde;o se responsabiliza  por eventuais atrasos, falhas ou indisponibilidades da rede sem fio, da  internet ou dos servi&ccedil;os prestados pelas operadoras de telefonia m&oacute;vel que  venham a prejudicar a transmiss&atilde;o das informa&ccedil;&otilde;es.</p>
      <p align="left">&nbsp;</p>
      <p><strong><em><u>13. RESCIS&Atilde;O CONTRATUAL</u></em></strong><strong>. </strong>O contrato  vigorar&aacute; por prazo indeterminado, podendo ser rescindido e, consequentemente, o <strong><em>cart&atilde;o </em></strong>cancelado, a qualquer momento, pela VESTE PRIME ou por voc&ecirc;, mediante  pr&eacute;vio aviso ou, pela VESTE PRIME , independentemente de aviso, nos casos de  atraso ou falta de pagamento, morte, interdi&ccedil;&atilde;o ou insolv&ecirc;ncia, restri&ccedil;&otilde;es  cadastrais ou credit&iacute;cias e n&atilde;o utiliza&ccedil;&atilde;o do <strong><em>cart&atilde;o </em></strong>por 6 meses&nbsp; consecutivos. O cancelamento do <strong><em>cart&atilde;o </em></strong>acarreta, automaticamente, o cancelamento dos <strong><em>adicionais</em></strong>.      </p>
      <ol>
      <blockquote>
        <p>No caso de rescis&atilde;o voc&ecirc; n&atilde;o  poder&aacute; solicitar o reembolso proporcional da <strong>TARIFA </strong>de anuidade  paga e o <strong>a VESTE PRIME </strong>poder&aacute; compensar esse valor  com eventual saldo devedor de seu <strong><em>cart&atilde;o</em></strong>.</p>
          <p>A utiliza&ccedil;&atilde;o do seu <strong><em>cart&atilde;o </em></strong>ou <strong><em>adicionais </em></strong>em estabelecimentos de sua propriedade ensejar&aacute; o  imediato cancelamento do <strong><em>cart&atilde;o</em></strong>.</p>
        </blockquote>
      </ol>
      <p><strong><em><u>14. DISPOSI&Ccedil;&Otilde;ES GERAIS</u></em></strong><strong>. </strong>Aplicam-se ainda a este contrato as seguintes condi&ccedil;&otilde;es:</p>
      A VESTE PRIME RESERVA-SE O DIREITO DE REVISAR ESTE CONTRATO A QUALQUER  MOMENTO E A MODIFICA-LO, TOTAL OU PARCIALMENTE. TAIS ALTERA&Ccedil;&Otilde;ES SER&Atilde;O  COMUNICADAS COM ANTECED&Ecirc;NCIA DE 30 DIAS. SE VOC&Ecirc; N&Atilde;O CONCORDAR, DEVER&Aacute;  RESCINDIR ESTE CONTRATO. AO UTILIZAR O <em>CART&Atilde;O </em>AP&Oacute;S A COMUNICA&Ccedil;&Atilde;O VOC&Ecirc; MANIFESTA A SUA CONCORD&Acirc;NCIA COM AS ALTERA&Ccedil;&Otilde;ES REALIZADAS.
      <ol>
        <ol>
          <li>O  uso do <strong><em>cart&atilde;o </em></strong>pode ser ampliado e agregados novos servi&ccedil;os e produtos,  bem como interrompido o fornecimento de determinados produtos e/ou servi&ccedil;os vigentes.</li>
          <li>Voc&ecirc; autoriza o Conglomerado Financeiro VESTE PRIME:</li>
          <ol>
            <li>A obter, fornecer e compartilhar  suas informa&ccedil;&otilde;es cadastrais, financeiras e de opera&ccedil;&otilde;es ativas e passivas e  servi&ccedil;os prestados junto a outras institui&ccedil;&otilde;es pertencentes ao Conglomerado  Financeiro VESTE PRIME, ficando todos autorizados a examinar e utilizar,  no&nbsp; Brasil ,&nbsp; tais informa&ccedil;&otilde;es, inclusive para oferta de  produtos e servi&ccedil;os;</li>
            <li>A  obter, fornecer e compartilhar suas informa&ccedil;&otilde;es cadastrais com a <strong>Bandeira </strong>do seu <strong><em>cart&atilde;o</em></strong>, para concess&atilde;o de  benef&iacute;cios e ofertas de produtos e servi&ccedil;os;</li>
            <li>A  informar aos &oacute;rg&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito, tais como SERASA e SPC, detre outros, os dados  relativos &agrave; falta de pagamento de obriga&ccedil;&otilde;es assumidas junto a VESTE PRIME;</li>
          </ol>
          <li>Ao  aderir a este contrato voc&ecirc; se obriga a:&nbsp;  (i) n&atilde;o utilizar o limite de cr&eacute;dito concedido para finalidades&nbsp; que possam causar danos sociais e em projetos  que n&atilde;o atendam rigorosamente a Pol&iacute;tica Nacional de Meio Ambiente e as normas  legais e regulamentares que regem tal pol&iacute;tica; (ii) pagar todos os tributos  relativos a&nbsp;&nbsp;&nbsp; este contrato, inclusive  aqueles que no futuro venham a ser exigidos, e arcar com eventuais aumentos de  al&iacute;quotas e (iii) manter atualizados, perante a VESTE PRIME, seus dados  cadastrais e econ&ocirc;micos.</li>
          <li>Para  ter direito aos benef&iacute;cios e  recompensas do seu <strong><em>cart&atilde;o</em></strong>, como por exemplo pontos, b&ocirc;nus ou milhas, voc&ecirc; deve  pagar, pelo menos, o valor&nbsp; m&iacute;nimo das <strong><em>faturas </em></strong>at&eacute; a data de vencimento, bem como &eacute; necess&aacute;rio&nbsp;&nbsp; que n&atilde;o haja nenhum inadimplemento das  obriga&ccedil;&otilde;es estabelecidas neste contrato ou no regulamento do respectivo programa.</li>
          <li>A sua ades&atilde;o a este contrato obriga as partes, seus  herdeiros e sucessores.</li>
          <li>Fica  eleito o foro da Comarca de S&Atilde;O GON&Ccedil;ALO DO AMARANTE ou do domic&iacute;lio do <strong><em>titular </em></strong>para dirimir quaisquer quest&otilde;es relativas a este contrato.      </li>
        </ol>
      </ol></td>
  </tr>
  <tr>
    <td align="center" colspan="6"><ol>
      <p>___________________________________________________</p>
      <p><strong>CLIENTE: </strong><? echo $res['nome']; ?></p>
    </ol></td>
  </tr>
</table>
<? }} ?>
</body>
</html>