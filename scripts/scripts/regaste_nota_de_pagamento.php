<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/regaste_nota_de_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../config.php"; ?>

<? if(isset($_POST['button'])){
	
$id_caixa = $_GET['id_caixa'];
$checkbox = @$_POST['checkbox'];


if($checkbox == ''){
	echo "<script language='javascript'>window.alert('VOCÊ DEVE DECLARAR QUE LEU AS INFORMAÇÕES APRESENTADAS SÃO DE SUA RESPONSABILIDADE!');</script>";	
}else{
	mysqli_query($conexao_bd, "UPDATE emissao_de_nota_de_pagamento SET status = 'RESGATADO', data_resgate = '$data_completa', operador_regaste = '$operador', dia_resgate = '$data' WHERE code_cupom = '".$_GET['code_cupom']."'");
	
	echo "
	Nota resgatada com sucesso!<br><br>Pressione F5 para mesclar a operação e imprima a nota e peça para o cliente para assinar o recebimento do valor aqui apresentado.
	";
	die;
}


}?>
<form name="" method="post" enctype="multipart/form-data" action="">
 <table width="700" border="0">
  <tr>
    <td width="20"><input type="checkbox" name="checkbox" id="checkbox">
    <label for="checkbox"></label></td>
    <td width="670"> 
    <?
	$sql_verica = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE code_cupom = '".$_GET['code_cupom']."'");
	while($res_cupom = mysqli_fetch_array($sql_verica)){
		echo "Declaro que nota de número <strong>".$res_cupom['code_cupom']."</strong> gerada inicialmente no valor de <strong>R$ ".number_format($res_cupom['valor'], 2, ',', '.')."</strong> e que durante <strong>".$res_cupom['dias_juros']." dias</strong> rendeu <strong>R$ ".number_format($res_cupom['juros_rendidos'], 2, ',', '.')."</strong> e será feito o resgate no valor de <strong>R$ ". number_format($res_cupom['valor']+$res_cupom['juros_rendidos'], 2, ',', '.')."</strong> para o cliente <strong>".$res_cupom['nome']."</strong> e confirmo que o cliente mostrou um documento de identificaão para resgate.";
	}
	?>    
   </td>
  </tr>
  </table>
<p>
  <input type="submit" name="button" id="button" value="Confirmar">
</p>
</form>
</div><!-- box -->
</body>
</html>