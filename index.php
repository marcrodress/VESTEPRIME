<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SISTEMA DE CAIXA - VEESTE PRIME</title>
<link href="img/logo.png" rel="shortcut icon" />
<link href="css/index.css" rel="stylesheet" type="text/css" />
<? require "config.php"; ?>
</head>

<body>


<? require "topo.php"; ?>


<? 
	if(@$_GET['pack'] == 1){
		echo "<script language='javascript'>window.location='carrinho.php?p=index';</script>";
	}elseif(@$_GET['pack'] == 200){
		echo "<script language='javascript'>window.location='jogos.php?p=';</script>";
	}elseif(@$_GET['pack'] == 201){
		echo "<script language='javascript'>window.location='jogos.php?p=fazer_jogo_bolao_da_sorte';</script>";
	}elseif(@$_GET['pack'] == 2010){
		echo "<script language='javascript'>window.location='jogos.php?p=cancela_um_bilhete';</script>";
	}elseif(@$_GET['pack'] == 2011){
		echo "<script language='javascript'>window.location='jogos.php?p=reempressao_bilhete_jogo';</script>";
	}elseif(@$_GET['pack'] == 2014){
		echo "<script language='javascript'>window.location='jogos.php?p=verificar_resultado_jogo';</script>";
	}elseif(@$_GET['pack'] == 2012){
		echo "<script language='javascript'>window.location='jogos.php?p=conferir_jogo_premiacao';</script>";
	}elseif(@$_GET['pack'] == 2013){
		echo "<script language='javascript'>window.location='jogos.php?p=fazer_pagamento_jogo';</script>";
	}elseif(@$_GET['pack'] == 2015){
		echo "<script language='javascript'>window.location='jogos.php?p=buscador_numero_jogador';</script>";
	}elseif(@$_GET['pack'] == 2017){
		echo "<script language='javascript'>window.location='jogos.php?p=verifica_proximos_jogos';</script>";


	// INFORMAÇÕES SOBRE O CLIENTE
	}elseif(@$_GET['pack'] == 500){
		echo "<script language='javascript'>window.location='loja_online.php?cate=8415&query=$query';</script>";
	}elseif(@$_GET['pack'] == 510){
		echo "<script language='javascript'>window.location='pedidos_da_loja_virtual.php';</script>";
	}elseif(@$_GET['pack'] == 520){
		echo "<script language='javascript'>window.location='cadastrar_produtos_loja_virtual.php';</script>";
	}elseif(@$_GET['pack'] == 530){
		echo "<script language='javascript'>window.location='pedidos_loja_online_adm.php';</script>";		

	// INFORMAÇÕES SOBRE O CLIENTE
	}elseif(@$_GET['pack'] == 400){
		echo "<script language='javascript'>window.location='auxilio.php?p=';</script>";


	// INFORMAÇÕES SOBRE O CLIENTE
	}elseif(@$_GET['pack'] == 410){
		echo "<script language='javascript'>window.location='cliente.php?p=analise_rapida';</script>";
	}elseif(@$_GET['pack'] == 415){
		echo "<script language='javascript'>window.location='faturas.php?cliente=".@$clienete."';</script>";
	}elseif(@$_GET['pack'] == 10){ 
		echo "<script language='javascript'>window.location='mostra_cliente.php?p=informar_cliente';</script>";
		echo "<script language='javascript'>window.location='faturas.php?cliente=$cliente';</script>";
	}elseif(@$_GET['pack'] == 411){ 
		echo "<script language='javascript'>window.location='altera_senha.php?p=informar_cliente';</script>";
	}elseif(@$_GET['pack'] == 412){ 
		echo "<script language='javascript'>window.location='verificar_analise_credito.php';</script>";
	}elseif(@$_GET['pack'] == 418){ 
		echo "<script language='javascript'>window.location='clientes_veste_prime.php';</script>";
	}elseif(@$_GET['pack'] == 413){
		
		
		
		
	$cliente = 0;
	
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
	 if(mysqli_num_rows($sql_carrinho) == ''){
		echo "<script language='javascript'>window.location='carrinho.php';</script>";
	 }else{
		while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			$cliente = $res_carrinho['cliente'];
		}
	  }		
		
		echo "<script language='javascript'>window.location='cliente.php?p=continua_proposta&cpf=$cliente';</script>";
	}elseif(@$_GET['pack'] == 430){ 
		echo "<script language='javascript'>window.location='lancar_boletos_de_faturas.php';</script>";				
		
		
				
		
		
		
		
		
		
		
	}elseif(@$_GET['pack'] == 20){ // fecha o carrinho
		echo "<script language='javascript'>window.location='fecha_carrinho.php?p=';</script>";		
	}elseif(@$_GET['pack'] == 21){ // fecha o carrinho
		echo "<script language='javascript'>window.location='fecha_carrinho.php?p=21';</script>";
	}elseif(@$_GET['pack'] == 25){ // DEVOLUÇÃO E TROCA
		echo "<script language='javascript'>window.location='devolucao_e_troca.php?p=21';</script>";
	}elseif(@$_GET['pack'] == 26){ // DEVOLUÇÃO E TROCA
		echo "<script language='javascript'>window.location='incluir_comprovante_compra.php?p=21';</script>";			
		
	
	// PAGAMENTO DE BOLETOS
	}elseif(@$_GET['pack'] == 49){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='fazer_pagamento_boleto.php?p=';</script>";
	}elseif(@$_GET['pack'] == 50){ // FAZ PAGAMENTO INICIO
		echo "<script language='javascript'>window.location='fazer_pagamento.php?p=';</script>";
	}elseif(@$_GET['pack'] == 481){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='fazer_pagamento.php?p=2&tipo=BOLETO&sem_cobranca=sim';</script>";
	}elseif(@$_GET['pack'] == 491){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='fazer_pagamento.php?p=2&tipo=CONVENIO&sem_cobranca=sim';</script>";
	}elseif(@$_GET['pack'] == 450){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='fazer_pagamento.php?p=2&tipo=BOLETO&nega=sim';</script>";
	}elseif(@$_GET['pack'] == 451){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='fazer_pagamento.php?p=2&tipo=CONVENIO&nega=sim';</script>";				
	
	// RECARGA DE CELULAR
	}elseif(@$_GET['pack'] == 300){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='recarga_de_celular.php?p=';</script>";
		
	
	// OPERADOR
	}elseif(@$_GET['pack'] == 666){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='mostrar_comissao.php?p=';</script>";	
		
		
	
	// RECARGA DE TV PRÉ-PAGO
	}elseif(@$_GET['pack'] == 700){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='tv_pre_pago.php?p=';</script>";
		
		
	
	// RETIRADA DE DINHEIRO
	}elseif(@$_GET['pack'] == 618){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='retirada_dinheiro.php?p=';</script>";
		
		
		
	
	// PAGINAS EXTRAS
	}elseif(@$_GET['pack'] == 312){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='santander_free.php?p=';</script>";
	}elseif(@$_GET['pack'] == 313){ // abre_selecao_carrinho
		echo "<script language='javascript'>window.location='paginas_extras.php?p=313';</script>";
		
		
		
	
	// GIFT_CARD
	}elseif(@$_GET['pack'] == 56214){
		echo "<script language='javascript'>window.location='gift_card.php?p=';</script>";
		
		
		
	
	// PREJUÍZOS E PERDAS
	}elseif(@$_GET['pack'] == 123){
		echo "<script language='javascript'>window.location='prejuizos_e_perdas.php?p=';</script>";
		
		
		
	
	// EMPRÉSTIMO NO CARTÃO DE CRÉDITO
	}elseif(@$_GET['pack'] == 952){
		echo "<script language='javascript'>window.location='emprestimo_cartao_credito.php?p=';</script>";
		
		
		
	
	// CREDITO PESSOAL
	}elseif(@$_GET['pack'] == 212){
		echo "<script language='javascript'>window.location='credito_pessoal.php?p=';</script>";
		
		
		
		
	
	// SAGRIA DE CAIXA
	}elseif(@$_GET['pack'] == 117){
		echo "<script language='javascript'>window.location='sagria_para_banco.php?p=1';</script>";
	}elseif(@$_GET['pack'] == 118){
		echo "<script language='javascript'>window.location='entrada_de_dinheiro_caixa.php?p=';</script>";		
		
		
		
	
	// SAQUE DE CARTÃO
	}elseif(@$_GET['pack'] == 51){
		echo "<script language='javascript'>window.location='saque_de_cartao.php?p=';</script>";
	}elseif(@$_GET['pack'] == 52){
		echo "<script language='javascript'>window.location='saque_transferencia.php?p=';</script>";
				
		
		
		
	
	// ABRE O CAIXA
	}elseif(@$_GET['pack'] == 101){
		echo "<script language='javascript'>window.location='incluir_link_comprovante.php?p=';</script>";
		
		
		
		
	
	// SAQUE DO CARTÃO VESTE PRIME
	}elseif(@$_GET['pack'] == 215){
		echo "<script language='javascript'>window.location='saque_veste_prime.php?p=';</script>";
		
	
		
		
		
	
	// LISTA BOLETOS
	}elseif(@$_GET['pack'] == 100){
		echo "<script language='javascript'>window.location='boletos_processando.php?p=';</script>";
		
	
	// FAZER TRANSFERÊNCIA
	}elseif(@$_GET['pack'] == 89){
		echo "<script language='javascript'>window.location='fazer_ted.php?p=1';</script>";
		
			
		
	
	// FAZER FECHAMENTO DE CAIXA
	}elseif(@$_GET['pack'] == 613){
		echo "<script language='javascript'>window.location='aporte_financeiro.php?p=';</script>";
	}elseif(@$_GET['pack'] == 612){
		echo "<script language='javascript'>window.location='fechamento_caixa.php?p=';</script>";
		
			
	
	// VERIFICAR E-MAILS DE ACESSOS
	}elseif(@$_GET['pack'] == 420){
		echo "<script language='javascript'>window.location='emails_acessos.php?p=';</script>";
				
	
	// PESQUISA DE PRODUTO
	}elseif(@$_GET['pack'] == 2){
		echo "<script language='javascript'>window.location='pesquisa_de_produto.php?p=';</script>";
				
	
	// DEPÓSITO BANCO DO BRASIL
	}elseif(@$_GET['pack'] == 27){
		echo "<script language='javascript'>window.location='deposito_banco_do_brasil.php?p=';</script>";
	
	// SAQUE BANCO DO BRASIL
	}elseif(@$_GET['pack'] == 28){
		echo "<script language='javascript'>window.location='saque_banco_do_brasil.php?p=';</script>";
				
						
		
	
	// SAIR DO SISTEMA
	}elseif(@$_GET['pack'] == 1001){
		echo "<script language='javascript'>window.location='sair_do_sistema.php?p=';</script>";
				
				
						
	
	// SETOR DE NEGOCIAÇÃO
	}elseif(@$_GET['pack'] == 85){
		echo "<script language='javascript'>window.location='setor_de_negociacao.php?p=';</script>";
						
		
		
		
	// SAI DO CADASTRO DO CLIENTE
	}elseif(@$_GET['pack'] == 1000){
		echo "<script language='javascript'>window.location='scripts/sai_do_cadastro_cliente.php';</script>";
						
						
		
		
	// EMITIR NOTA DINHEIRO
	}elseif(@$_GET['pack'] == 150){
		echo "<script language='javascript'>window.location='emitir_nota_troco.php';</script>";
						
								
	// FATURAMENTO
	}elseif(@$_GET['pack'] == 10000){
		echo "<script language='javascript'>window.location='mostrar_lucro_dia.php?ano_filtro=$ano&mes_filtro=$mes&dia_filtro=$dia';</script>";
	}elseif(@$_GET['pack'] == 9999){
		echo "<script language='javascript'>window.location='depesas_de_manutencao.php';</script>";
	}elseif(@$_GET['pack'] == 9998){
		echo "<script language='javascript'>window.location='razoneite.php';</script>";
									
											
								
	// TROCA DE PRODUTO
	}elseif(@$_GET['pack'] == 160){
		echo "<script language='javascript'>window.location='trocar_produto.php';</script>";
						
								
	// EMPRESTIMO NO CARNÊ
	}elseif(@$_GET['pack'] == 940){
		echo "<script language='javascript'>window.location='emprestimo_no_carne_sem_fiador.php';</script>";
	}elseif(@$_GET['pack'] == 950){
		echo "<script language='javascript'>window.location='emprestimo_no_carne.php';</script>";
	}elseif(@$_GET['pack'] == 951){
		echo "<script language='javascript'>window.location='resultado_emprestimo_carne.php';</script>";
	}elseif(@$_GET['pack'] == 953){
		echo "<script language='javascript'>window.location='resultado_de_emprestimo_carne.php';</script>";	
	}elseif(@$_GET['pack'] == 954){
		echo "<script language='javascript'>window.location='resultado_emprestimo_carne_grupo_t.php';</script>";						
								
	// EMPRESTIMO_CARNE_CREDIAMIGO
	}elseif(@$_GET['pack'] == 920){
		echo "<script language='javascript'>window.location='emprestimo_carne_crediamigo_grupo.php';</script>";
	}elseif(@$_GET['pack'] == 921){
		echo "<script language='javascript'>window.location='resultado_emprestimo_carne_grupo.php?p=1';</script>";										
						
								
	// CADASTRO DE PRODUTO
	}elseif(@$_GET['pack'] == 31){
		echo "<script language='javascript'>window.location='cadastrar_produto.php';</script>";
	}elseif(@$_GET['pack'] == 30){
		echo "<script language='javascript'>window.location='categoria_subcategoria.php';</script>";						
	}elseif(@$_GET['pack'] == 32){
		echo "<script language='javascript'>window.location='lista_produtos.php';</script>";
	}elseif(@$_GET['pack'] == 33){
		echo "<script language='javascript'>window.location='produtos_celulares.php';</script>";													
								
				
		
						
								
	// CLIENTE AVULSO
	}elseif(@$_GET['pack'] == 70){
		echo "<script language='javascript'>window.location='cliente_avulso.php';</script>";
	}elseif(@$_GET['pack'] == 71){
		echo "<script language='javascript'>window.location='categoria_subcategoria.php';</script>";						
	}elseif(@$_GET['pack'] == 72){
		echo "<script language='javascript'>window.location='lista_produtos.php';</script>";													
								
						
		
		
						
								
	// ENVIAR E-MAIL PARA CLIENTES
	}elseif(@$_GET['pack'] == 80){
		echo "<script language='javascript'>window.location='enviar_email_clientes.php';</script>";
						
								
	// RESUMO DE CRÉDITO
	}elseif(@$_GET['pack'] == 750){
		echo "<script language='javascript'>window.location='setor_de_credito.php?ano_filtro=$ano&mes_filtro=$mes';</script>";
	}elseif(@$_GET['pack'] == 751){
		echo "<script language='javascript'>window.location='credito_a_receber.php?ano_filtro=$ano&mes_filtro=$mes';</script>";
						
						
								
	// CURSO ONLINE VESTE PRIME
	}elseif(@$_GET['pack'] == 2000){
		echo "<script language='javascript'>window.location='curso_online.php';</script>";
						
						
								
	// VESTECAPITALIZE
	}elseif(@$_GET['pack'] == 3000){
		echo "<script language='javascript'>window.location='capitalizacao.php';</script>";
	}elseif(@$_GET['pack'] == 3100){
		echo "<script language='javascript'>window.location='capitalizacao_titulos.php';</script>";
								
	// SAQUE FÁCIL
	}elseif(@$_GET['pack'] == 900){
		echo "<script language='javascript'>window.location='saque_facil.php';</script>";
	}elseif(@$_GET['pack'] == 910){
		echo "<script language='javascript'>window.location='resultado_saque_facil.php';</script>";
																	
								
						
						
								
	// TREINAMENTO ONLINE
	}elseif(@$_GET['pack'] == 550){
		echo "<script language='javascript'>window.location='treinamento_online.php';</script>";
								
	// PLANO CANADA
	}elseif(@$_GET['pack'] == 7500){
		echo "<script language='javascript'>window.location='plano_canada.php';</script>";
	}elseif(@$_GET['pack'] == 7510){
		echo "<script language='javascript'>window.location='despesas_plano_canada.php';</script>";
	}elseif(@$_GET['pack'] == 7560){
		echo "<script language='javascript'>window.location='saldo_confirmado.php';</script>";
	}elseif(@$_GET['pack'] == 7570){
		echo "<script language='javascript'>window.location='plano_canada_previsto.php';</script>";											
	}elseif(@$_GET['pack'] == 7501){
		echo "<script language='javascript'>window.location='plano_canada_despesas.php';</script>";										
								
	// PROMOÇÃO
	}elseif(@$_GET['pack'] == 6500){						
		echo "<script language='javascript'>window.location='promocao_mes.php?p=';</script>";
								
	// CADASTRO DO CLIENTE
	}elseif(@$_GET['pack'] == 609){						
		echo "<script language='javascript'>window.location='analise_de_credito.php?p=';</script>";
		

	// RIFAS
	}elseif(@$_GET['pack'] == 800){
		echo "<script language='javascript'>window.location='rifas.php?p=';</script>";
		
	// CATEGÓRIAS DE PRODUTOS DIVERSOS
	}elseif(@$_GET['pack'] == 34){
		echo "<script language='javascript'>window.location='categoriaProdutosDiversos.php?p=';</script>";
	}elseif(@$_GET['pack'] == 35){
		echo "<script language='javascript'>window.location='categoriaProdutosDiversosModelos.php?p=';</script>";
	}elseif(@$_GET['pack'] == 36){
		echo "<script language='javascript'>window.location='categoriaProdutosDiversosProdutos.php?p=';</script>";
	}elseif(@$_GET['pack'] == 37){
		echo "<script language='javascript'>window.location='categoriaProdutosDiversosCriarProduto.php?p=';</script>";
			
		
	}else{
		echo "<script language='javascript'>window.location='carrinho.php?p=index';</script>";
	}
	
?>


</body>
</html>