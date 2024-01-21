<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?
require "funcoesVerificaBoleto.php";

$codigoBarras = $_GET['codigoBarras'];
$valorBoleto = retornaValorVoleto($_GET['valorBoleto']);
$codeVencimento = retornaVecimentoBoleto($_GET['codeVencimento']);
$vencimento2 = analisaBoleto($codigoBarras);

if($valorBoleto == 0){
	$valorBoleto = $vencimento2['valor'];
}
if($codeVencimento == 0){
	$codeVencimento = $vencimento2['vencimento'];
}

if(retornaValorVoleto($codigoBarras) == NULL){
	
	echo "<script>window.location='../fazer_pagamento.php?p=22&acao2=valorBoleto&tipo=BOLETO&codigoBarras=$codigoBarras&codeVencimento=0&valorBoleto=$valorBoleto';</script>";

}elseif(retornaVecimentoBoleto($codigoBarras) <=0){
	
	echo "<script>window.location='../fazer_pagamento.php?p=22&acao2=pega_data&tipo=BOLETO&boleto=$codigoBarras&codeVencimento=".retornaVecimentoBoleto($codigoBarras)."&valorBoleto=".$_GET['valorBoleto']."';</script>";
	
}else{
	
		
	if (verificaBoletoVencido($codeVencimento) == 1 &&  $valorBoleto != 0 && $codeVencimento != 0) {
		
		echo "<script>window.alert('ATENÇÃO: O boleto estar vencido e na próxima tela digite o valor total do boleto obtido na maquina de pagamentos, se não tiver juros bata digita 0 (zero) e enter');window.location='../fazer_pagamento.php?p=juros&tipo=BOLETO&valor=$valorBoleto&codigoBarras=$codigoBarras&codeVencimento=$codeVencimento';</script>";
	}else{
	
	$tarifaRecebimento = taxaRecebimento($valorBoleto);

	echo "<script>window.location.href = '../fazer_pagamento.php?p=3&tipo=BOLETO&valor=$valorBoleto&codigoBarras=$codigoBarras&codeVencimento=$codeVencimento&tarifaRecebimento=$tarifaRecebimento';</script>";
		
	}
	
		
	
}

?>