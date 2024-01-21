<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?
require "funcoesVerificaConvenio.php";
$codigoBarras = $_GET['codigoBarras'];



if(retornaNomeConvenio(retornaCodigoConvenio($codigoBarras)) == 'DAE ESTADO CEARA'){ 

	
	if(verificaBoletoVencido(codeVencimento(retornaDataVencimento($codigoBarras))) == 1){
		echo "<script>
				window.alert('ESTE CONVENIO DE ARRECAÇAO ESTAR VENCIDO E NÃO PODEMOS PROCESSAR O PAGAMENTO. POR FAVOR, SOLICITE UM CONVÊNIO ATUALIZADO!');
				window.location='../fazer_pagamento.php?p=';
			</script>";
	}else{
		
		if(retornaValorConvenio($codigoBarras) >2000){
		echo "<script>
				window.alert('ESTE CONVÊNIO ULTRAPASSA O LIMITE DESTE CORRESPONDE E SERÁ COBRADO UMA TARIFA NO VALOR DE R$ ".taxaRecebimento(retornaValorConvenio($codigoBarras))." NO SEU RECEBIMENTO, INFORME AO CLIENTE!');
			</script>";
		}
		
		echo "<script>window.location='../fazer_pagamento.php?p=3&tipo=CONVENIO&boleto=$codigoBarras&codeVencimento=".codeVencimento(retornaDataVencimento($codigoBarras))."&valorBoleto=".retornaValorConvenio($codigoBarras)."&tarifaRecebimento=".taxaRecebimento(retornaValorConvenio($codigoBarras))."';</script>";
	}
	
}else{ 
	
	echo "<script>window.location='../fazer_pagamento.php?p=22&acao2=pega_data&tipo=CONVENIO&boleto=$codigoBarras&codeVencimento=0&valorBoleto=".retornaValorConvenio($codigoBarras)."';</script>";

}


?>
