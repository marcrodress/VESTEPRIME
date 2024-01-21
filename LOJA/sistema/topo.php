<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />

<link href="../img/index.png" rel="shortcut icon" />
<? require "config.php"; ?>
</head>

<body>
<div id="linha_fixa">
 <a href="?pack=T74DFG85F1F"><strong>Sistema administrativo do Easy Loan</strong></a><hr />
</div><!-- linha_fixa -->

<div id="box_topo">
 <div id="logo">
 <a href="?pack=T74DFG85F1F"><img src="../img/index.png" width="250" height="133" border="0" /></a>
 </div><!-- logo -->
 
 
 <div id="operador">
 <br /> <br />
 
 <h1 class="h1"><? if(@$nome_cliente == ''){}else{ ?><strong class="strong">Cliente:</strong> <em><? echo @$nome_cliente; }?></em></h1> 
 <p></p>
  <h1 class="h1"><strong class="strong">Operador:</strong> <em><? echo @$nome_operador; ?></em> <a class="a" href="sair.php">Sair</a></h1>
 </div><!-- operador -->
  
 <div id="campo_buscar"><span id="sprytextfield85851">
   <input class="input" type="text" name="input" value="<? echo @$cpf_cliente; ?>" />
 </span>
   <input class="input2" type="submit" name="" value="BUSCAR" />
 </div><!-- campo_buscar -->

 <div id="campo_opcoes">
  <ul>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>
   <li><a href="?pack=T74DFG85F1F">HOME</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>
   <li><a href="inicar_atendimento.php" rel="superbox[iframe][630x190]">AGENDAR ATIVIDADE</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>
   <li><a href="topo.php?pg=exclui_sessao_cliente&id_cliente=<? echo @$id_cliente; ?>">ATIVIDADES AGENDADAS</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>
   <li><a href="?pack=T74DFG85F1F">SOLICITÕES CAIXA</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>
   <li><a href="?pack=MP5&pg=consultar_cpf">CONSULTAR CPF</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li> 
   <li><a href="?pack=MP5&pg=consultar_cnpj">CONSULTAR CNPJ</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>    
   <li><a href="?pack=MP5&pg=spc">CONSULTA AO SPC</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li> 
   <li><a href="?pack=MP5&pg=serasa">CONSULTA AO SERASA</a></li>
   <li><img src="img/separador_2.png" width="1" height="25" /></li>      
  </ul>
 </div><!-- campo_opcoes -->
 
 <div id="menu_topo">
  <ul>
   <li><img class="img" src="img/separador.png" /></li>
   <li><a class="a" href="?pack=CL"><strong>CONTA</strong></a>
    <ul>
     <li><a href="?pack=CL1">Cadastrar cliente</a></li>
     <li><a href="?pack=CL2">Atualizar cadastro</a></li>
     <li><a href="?pack=CL2">Limites de crédito</a></li>
     <li><a href="?pack=CL2">Lista todos os clientes</a></li>
    </ul>
   </li>    
   <li><img src="img/separador.png" /></li>
   <li><a href="?pack=CL"><strong>PRIME CARD</strong></a>
    <ul>
     <li><a href="?pack=fatura_mes&perfil=jbcred">Consultar faturas</a></li>
     <li><a href="?pack=fatura_mes&perfil=jbcred">Faturas do mês</a></li>
     <li><a href="?pack=SE1&perfil=jbcred">Clientes Ativos</a></li>
     <li><a href="?pack=SE1&perfil=outros_aposentado">Aumento de limite</a></li>
     <li><a href="?pack=SE1&perfil=autonomo_com_cheque">Fechar faturas</a></li>
     <li><a href="?pack=SE1&perfil=autonomo_com_cheque">Postar boletos faturas</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href=""><strong>Empréstimos</strong></a>
    <ul>
     <li><a href="">Empréstimos no cartão de crédito</a></li>
     <li><a href="">Empréstimos Saque Fácil</a></li>
     <li><a href="">Empréstimos no Boleto</a></li>
     <li><a href="">Empréstimos no Cheque</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href=""><strong>JOGOS</strong></a>
    <ul>
     <li><a href="?pack=bolao_sorte&serie=A">Partidas do Bolão da Sorte</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Milhar Federal</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Extrato de Jogos</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href="?pack=CL"><strong>SEGUROS</strong></a>
    <ul>
     <li><a href="?pack=bolao_sorte&serie=A">Seguro perda e roubo</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Seguro de vida</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Seguro perda de emprego</a></li>
    </ul>
   </li>   
   <li><img src="img/separador.png" /></li>
   <li><a href=""><strong>CAPITALIZAÇÃO</strong></a>
    <ul>
     <li><a href="?pack=bolao_sorte&serie=A">Capitalizações ativas</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Informar resultado de sorteios</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Capitalizações canceladas</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li> 
   <li><a href=""><strong>PAGAMENTOS DE CONTAS</strong></a>
    <ul>
     <li><a href="?pack=boletos_a_ser_processado&filtro=<? echo base64_encode("SELECT * FROM pagamento_contas WHERE status = 'Aguarda' AND tipo = 'BOLETO'"); ?>">Boletos aguarda serem compensados</a></li>
     <li><a href="?pack=convenio_a_ser_processado&filtro=<? echo base64_encode("SELECT * FROM pagamento_contas WHERE status = 'Aguarda' AND tipo = 'CONVENIO'"); ?>">Convênios a serem compensados</a></li>
     <li><a href="?pack=Eb5S&tipo=carteira_assinada">Boletos pagos</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href=""><strong>PRODUTOS</strong></a>
    <ul>
     <li><a href="?pack=cadastrar_modelos_celulares">Modelos de celulares</a></li>
     <li><a href="?pack=produtos_de_celulares">Produtos de celulares</a></li>
     <li><a href="?pack=cadastrar_produto&p=">Cadastrar produtos</a></li>
     <li><a href="?pack=cadastrar_produto&p=">Atualizar produtos</a></li>
     <li><a href="?pack=MP5&pg=itau">Inserir estoque</a></li>
     <li><a href="?pack=MP5&pg=losango">Alerta de estoque</a></li>
     <li><a href="?pack=MP5&pg=losango">Show de vendas</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href="?pack=RE85"><strong>RECARGA DE TELEFONE</strong></a>
    <ul>
     <li><a href="?pack=CC1">Recargas a serem efetuadas</a></li>
     <li><a href="?pack=MP5&pg=itau">Recargas efetuadas</a></li>
    </ul>
   </li>      
   <li><img src="img/separador.png" /></li>
   <li><a href=""><strong>NEGOCIAÇÃO</strong></a>
    <ul>
     <li><a href="">Cartão Easy Card</a></li>
     <li><a href="">Cheque Especial</a></li>
     <li><a href="">Saque Fácil</a></li>
     <li><a href="">Crédito Pessoal</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>    
   <li><a href=""><strong>TELEMARKETING</strong></a>
    <ul>
     <li><a href="">Baú da felicidade</a></li>
     <li><a href="">Empréstimos consignados</a></li>
     <li><a href="">Empréstimos crédito pessoal</a></li>
     <li><a href="">Cartão de crédito</a></li>
     <li><a href=""><strong>CLIENTES CONFIRMADOS</strong></a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
   <li><a href="?pack=cadastrar&filtro="><strong>FINANCEIRO</strong></a>
    <ul>
     <li><a href="?pack=cadastrar&filtro=">Cadastrar prestações</a></li>
     <li><a href="?pack=comissoes_de_venda&filtro=">Comissões de venda</a></li>
     <li><a href="?pack=informar_debitos">Informar débitos</a></li>
     <li><a href="?pack=informar_creditos">Informar créditos</a></li>
     <li><a href="?pack=relatorio_mensal">RELATÓRIO MENSAL</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li> 
   <li><a href=""><strong>RELATÓRIOS</strong></a>
    <ul>
     <li><a href="?pack=fluxo_do_caixa&filtro=<? echo base64_encode("WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano'"); ?>">FLUXO DE CAIXA</a></li>
     <li><a href="">Relatório de clientes</a></li>
     <li><a href="">Relatório de vendas produtos</a></li>
     <li><a href="">Relatório de produtos ABC</a></li>
     <li><a href="">Relatório Easy Card</a></li>
     <li><a href="">Relatório de Empréstimo</a></li>
     <li><a href="">Relatório do Bolão da Sorte</a></li>
     <li><a href="">Relatório Milhar Federal</a></li>
     <li><a href="">Relatório de Seguros</a></li>
     <li><a href="">Relatório de capitalização</a></li>
     <li><a href="">Relatório de pagamento de contas</a></li>
     <li><a href="">Relatório de Recarga de telefone</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>   
   <li><a href=""><strong>UTILITÁRIOS</strong></a>
    <ul>
     <li><a href="?pack=SE1&perfil=autonomo_com_cheque">Renegociação de débitos</a></li>    
     <li><a href="">Clientes aptos a SPC/SERASA</a></li>    
     <li><a href="">Alerta de produtos</a></li>
     <li><a href="">Telefones úteis</a></li>
     <li><a href="">Bradesco Expresso</a></li>
     <li><a href="">Bradesco Promotora</a></li>
     <li><a href="">Banco Itaú</a></li>
     <li><a href="">Banco Bradesco</a></li>
     <li><a href="">Empréstimos do INSS</a></li>
     <li><a href="">Imposto de renda INSS</a></li>
    </ul>
   </li>
   <li><img src="img/separador.png" /></li>
  </ul>
 </div><!-- menu_topo -->
 
</div><!-- box_topo -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield85851", "social_security_number", {format:"ssn_custom", pattern:"000.000.000-00", useCharacterMasking:true});
</script>
</body>
</html>


<? if(@$_GET['pg'] == 'exclui_sessao_cliente'){

$id_cliente = $_GET['id_cliente'];

mysql_query("UPDATE atendimentos SET status = 'Fechado' WHERE id = '$id_cliente'");

echo "<script language='javascript'>window.location='redirecionador';</script>";

}?>
