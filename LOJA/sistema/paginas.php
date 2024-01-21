<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sem t&iacute;tulo</title>
</head>

<body>
<? switch (@$_GET['pack']){

	case 'dfg';
	include 'home.php';
	break;

	case 'CL1';
	include 'cadastrar_cliente.php';
	break;

	case 'CL2';
	include 'atualizar_dados_clientes.php';
	break;

	case 'CL3';
	include 'lista_de_aposentados_e_pensionista.php';
	break;

	case 'CL4';
	include 'telemarketing_sky.php';
	break;

	case 'CL6';
	include 'cliente_que_fecharam_negocio.php';
	break;

	case 'MP5';
	include 'sites.php';
	break;

	case 'SE1';
	include 'simulacoes_emprestimo.php';
	break;	

	case 'Eb5S';
	include 'fazer_emprestimos.php';
	break;	

	case 'EBTS';
	include 'emprestimo_com_cartao.php';
	break;	

	case 'CBTS';
	include 'confirmar_emprestimo_com_cartao.php';
	break;	
	

	case 'Eb6S';
	include 'mostrar_resultado_da_analise_emprestimo.php';
	break;
	

	case 'RE85';
	include 'recargas_de_telefone.php';
	break;	
	

	case 'CC1';
	include 'proposta_de_cartao_bradescard.php';
	break;
	

	case 'PPCB';
	include 'cartao_bradescard.pdf';
	break;		

	case 'CC2';
	include 'analisar_proposta_de_cartao_bradescard.php';
	break;			
	

	case 'CC3';
	include 'mostrar_resultado_da_analise.php';
	break;
	

	case 'CC4';
	include 'consulta_telefone_proposta_itau.php';
	break;
	

	case 'AGF1';
	include 'tarefas_agendadas.php';
	break;
	

	case 'AGF2';
	include 'agendamento_de_vistas_de_aposentados.php';
	break;
	

	case 'RC4';
	include 'relatorio_do_caixa.php';
	break;	
	

	case 'SKY1';
	include 'cadastrar_venda_sky.php';
	break;	
	
	
	

	case 'bolao_sorte';
	include 'bolao_sorte.php';
	break;
	case 'SKY1';
	include 'cadastrar_venda_sky.php';
	break;	
	
	/**/
	case 'cadastrar_produto';
	include 'cadastrar_produto.php';
	break;	
	
	
	/*FINANCEIRO*/
	case 'fluxo_de_caixa';
	include 'fluxo_de_caixa.php';
	break;		
	case 'informar_debitos';
	include 'informar_debitos.php';
	break;
	case 'informar_creditos';
	include 'informar_creditos.php';
	break;
	case 'comissoes_de_venda';
	include 'comissoes_de_venda.php';
	break;	
	
	
	/*PAGAMENTO DE CONTAS*/
	case 'boletos_a_ser_processado';
	include 'boletos_a_ser_processado.php';
	break;		
	case 'convenio_a_ser_processado';
	include 'convenio_a_ser_processado.php';
	break;

	
	
	/*SETOR FINANCEIRO*/
	case 'fluxo_do_caixa';
	include 'fluxo_do_caixa.php';
	break;		
	case 'relatorio_mensal';
	include 'relatorio_mensal.php';
	break;	

	
	
	/*PRIME CARD*/
	case 'fatura_mes';
	include 'fatura_mes.php';
	break;

	
	
	/*PRODUTOS*/
	case 'cadastrar_modelos_celulares';
	include 'cadastrar_modelos_celulares.php';
	break;
	case 'produtos_de_celulares';
	include 'produtos_de_celulares.php';
	break;
		
		
		
		
									
	case 'T74DFG85F1F':
	include ("home.php");
	break;
}?>
</body>
</html>