<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<? require "../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['button'])){
	
$contrato = $_FILES['contrato']['name'];
$codigo_negociacao = $_GET['codigo_negociacao'];

$contrato = str_replace(" ", "-", $contrato); $contrato = str_replace(",", "-", $contrato); $contrato = str_replace("ã", "a", $contrato);
if(file_exists("../contrato_dividas/$contrato")){ $a = 1;while(file_exists("../contrato_dividas/[$a]$contrato")){$a++;}$contrato = "[".$a."]".$contrato;}

$sql_con = mysqli_query($conexao_bd, "UPDATE dados_da_divida_negociacao_fechado SET contrato = '$contrato', envio_contrato = 'SIM' WHERE code_negociacao = '$codigo_negociacao'");
if($sql_con == ''){
echo "Ocorreu um erro enviar contrato, tente novamente!";
die;
}else{
echo "<strong>Contrato enviado com sucesso!</strong>
<br>
Pressione F5 para mesclar a operação.
";

$n_parcelas = 0;
$valor_parcelas = 0;
$cliente = 0;
$forma_pag = 0;

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM dados_da_divida_negociacao_fechado WHERE code_negociacao = '$codigo_negociacao'");
 while($res_verifica = mysqli_fetch_array($sql_verifica)){
	 
	 $n_parcelas = $res_verifica['parcelas'];
	 $valor_parcelas = $res_verifica['valor_parcela'];
	 $cliente = $res_verifica['cliente'];
	 $forma_pag = $res_verifica['forma_pag'];
	 	 
 }

if($forma_pag == 'BOLETO BANCARIO'){
 for($i=1; $i<=$n_parcelas; $i++){
	 mysqli_query($conexao_bd, "INSERT INTO boletos_negociacao (cliente, proposta, parcela, codigo_barras, localizador, vencimento, valor, status, data_pagamento) VALUES ('$cliente', '$codigo_negociacao', '$i', '', '', '', '$valor_parcelas', 'AGUARDA', '')");
 }
}


(move_uploaded_file($_FILES['contrato']['tmp_name'], "../contrato_dividas/".$contrato));
die;
}


}?>
<strong>Confira se todos os documentos estão assinados
</strong>
<hr style="border:1px solid #EEE;" />
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
  <label for="fileField"></label>
  <input type="file" name="contrato" id="fileField" />
  <input type="submit" name="button" id="button" value="Enviar" />
</form>
</body>
</html>