<!DOCTYPE HTML>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title></title>
	<script src="../dist/JsBarcode.all.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 0;
		}

		#barcodeContainer {
			text-align: center;
		}
	</style>
	<script>
		Number.prototype.zeroPadding = function(){
			var ret = "" + this.valueOf();
			return ret.length == 1 ? "0" + ret : ret;
		};
	</script>
</head>
<body>
<? 
require "../../../config.php"; 
$sqlBoleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id']."'");
while($resBoleto = mysqli_fetch_array($sqlBoleto)){
	$codigoBarras = $resBoleto['code_barras'];
	$codigoBarras2 = $resBoleto['code_barras'];
	$codigoBarras2 = str_replace(' ', '', $codigoBarras2);
	$codigoBarras2 = str_replace('.', '', $codigoBarras2);
	$codigoBarras2 = str_replace('-', '', $codigoBarras2);
?>
	
    
    
    
      <p><strong>BANCO:</strong> <? echo $resBoleto['banco']; ?><br><br><br><br><br><br><br><br><br><br></p>
      <h5>R$ <? echo number_format(($resBoleto['valor']+$resBoleto['juros']-$resBoleto['desconto']),2,',','.'); ?><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></h5>
      <img id="barcode1"/>
    
    
    
    <div id="barcodeContainer">
		
		<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
        <script>
            var url = new URL(window.location.href);			
            var produto = url.searchParams.get("<? echo $codigoBarras2; ?>");
        
            // Definindo a altura para 100px
            JsBarcode("#barcode1", "<? echo $codigoBarras; ?>");
        
            // Removendo o print() se não for necessário
        </script>
	</div>
<? } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
