<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Gerando receita</title>
</head>

<body>
<?
require "conexao.php";

$conta_notas = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento"));


$id_nota = $_GET['id_nota'];
if($id_nota == 0){
$id_nota = 1;
}else{
$id_nota = $id_nota;
}

if($id_nota > $conta_notas){
	echo "<script language='javascript'>window.location='lanca_cobranca_capitalizacao.php';</script>";
}else{

$travado = 0;
$valor = 0;
$dias_juros = 0;
$juros_rendidos = 0;
$ultimo_dia_juros = 0;

$verifica_nota = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE status = 'Ativo' AND id = '$id_nota'");
if(mysqli_num_rows($verifica_nota) == ''){
$id_nota++;
echo "<script language='javascript'>window.location='?id_nota=$id_nota';</script>";
}else{
	while($res_nota = mysqli_fetch_array($verifica_nota)){
		$travado = $res_nota['travado'];
		$valor = $res_nota['valor'];
		$dias_juros = $res_nota['dias_juros'];
		$juros_rendidos = $res_nota['juros_rendidos'];
		$ultimo_dia_juros = $res_nota['ultimo_dia_juros'];
	}
	
	$sql_verifica_ultimo_juro = mysqli_query($conexao_bd, "SELECT * FROM emissao_de_nota_de_pagamento WHERE id = '$id_nota' AND ultimo_dia_juros = '$data'");
	if(mysqli_num_rows($sql_verifica_ultimo_juro) >= 1){
	$id_nota++;
	echo "<script language='javascript'>window.location='?id_nota=$id_nota';</script>";
	}else{
		$dias_juros++;
		$juros_para_render = ((1/30)/100)*($valor+$juros_rendidos);
		$juros_rendidos = $juros_rendidos+$juros_para_render;
		
		mysqli_query($conexao_bd, "UPDATE emissao_de_nota_de_pagamento SET dias_juros = '$dias_juros', ultimo_dia_juros = '$data', juros_rendidos = '$juros_rendidos' WHERE id = '$id_nota'");
		
		$id_nota++;
		echo "<script language='javascript'>window.location='?id_nota=$id_nota';</script>";
	}

 }
}





?>
</body>
</html>