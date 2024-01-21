2<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/auxilio.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">
<? if($_GET['p'] == ''){ ?>
<h1><strong>Identifique quem vai retirar o auxilio</strong></h1>
<hr />

<?
$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
		if($cliente == NULL){
		echo "<script language='javascript'>window.location='index.php';</script>";
		}
} // fecha busca cliente
?>


<? if(isset($_POST['enviar_cpf'])){

$auxilio_tirou = $_POST['auxilio_tirou'];

if($auxilio_tirou == ''){
	echo "<script language='javascript'>window.alert('Primeiro identifique quem vai tirar o auxilio');</script>";
}else{
		
	$sql_tira = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$auxilio_tirou'");
	if(mysqli_num_rows($sql_tira) == NULL){
	echo "<script language='javascript'>window.alert('CPF INFORMANDO NÃO ESTÁ CADASTRADO!');</script>";
	}else{
		echo "<script language='javascript'>window.location='auxilio.php?p=valor&cpf_auxilio=$cliente&cpf_tira=$auxilio_tirou';</script>";
	}
		
}

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input style="border:1px solid #999;" type="text" name="auxilio_tirou" autofocus value="<? echo $cliente; ?>" />
 <input style="border:1px solid #999;" type="submit" name="enviar_cpf" value="Buscar" />
</form>
<? } ?>


<? if($_GET['p'] == 'valor'){ ?>
<h1><strong>Identifique o valor que será tirado</strong></h1>
<hr />
<? if(isset($_POST['valor'])){

$valor_tirou = $_POST['valor_tirou'];

if($valor_tirou == ''){
	echo "<script language='javascript'>window.alert('Primeiro identifique o valor do auxilio');</script>";
}else{
		
		$cpf_auxilio = $_GET['cpf_auxilio'];
		$cpf_tira = $_GET['cpf_tira'];
	
		echo "<script language='javascript'>window.location='auxilio.php?p=tarifa&cpf_auxilio=$cpf_auxilio&cpf_tira=$cpf_tira&valor=$valor_tirou';</script>";
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <input style="border:1px solid #999; padding:20px; width:120px; font:20px Arial, Helvetica, sans-serif;" type="text" name="valor_tirou" autofocus value="" />
 <input style="border:1px solid #999; padding:20px; width:120px; font:20px Arial, Helvetica, sans-serif;" type="submit" name="valor" value="Seguir" />
</form>
<? } ?>



<? if($_GET['p'] == 'tarifa'){ ?>
<h1><strong>Idetifique a tarifa que será aplicada</strong></h1>
<hr />
<? if(isset($_POST['tarifa'])){

$tarifa_aplicada = $_POST['tarifa_aplicada'];

if($tarifa_aplicada == ''){
	echo "<script language='javascript'>window.alert('Primeiro identifique a tarifa do auxilio');</script>";
}else{
		
		$cpf_auxilio = $_GET['cpf_auxilio'];
		$cpf_tira = $_GET['cpf_tira'];
		$valor = $_GET['valor'];
	
		echo "<script language='javascript'>window.location='auxilio.php?p=forma&cpf_auxilio=$cpf_auxilio&cpf_tira=$cpf_tira&valor=$valor&tarifa=$tarifa_aplicada';</script>";
}
}?>

<form name="" method="post" action="" enctype="multipart/form-data">
 <select autofocus style="border:1px solid #999; padding:20px; width:150px; font:20px Arial, Helvetica, sans-serif; height:60px;" name="tarifa_aplicada" size="1">
   <option value="<? 
   $tarifa = 0;
   	if($_GET['valor'] < 200){ 
		 echo $tarifa = 10;
	}elseif($_GET['valor'] >= 200 && $_GET['valor'] < 300){ 
		echo $tarifa = 20;
	}elseif($_GET['valor'] >= 300){ 
		 echo $tarifa = 30;
	}
		  
	
	?>"><? 
   
   	if($_GET['valor'] < 200){ 
		echo "R$ 10,00";
	}elseif($_GET['valor'] > 200 && $_GET['valor'] <= 300){ 
		echo "R$ 20,00";
	}elseif($_GET['valor'] > 300){ 
		echo "R$ 30,00";		
	}
		  
	
	?></option>
   <option value=""></option>
   <option value="10">R$ 10,00</option>
   <option value="20">R$ 20,00</option>
   <option value="30">R$ 30,00</option>
 </select>

 <input style="border:1px solid #999; padding:18px; width:120px; font:20px Arial, Helvetica, sans-serif;" type="submit" name="tarifa" value="Seguir" />
</form>
<? } ?>




<? if($_GET['p'] == 'forma'){ ?>
<h1><strong>Idetifique a forma como será tirado o auxilio</strong></h1>
<hr />
<? if(isset($_POST['avancar'])){

$tipo = $_POST['tipo'];

$cpf_auxilio = $_GET['cpf_auxilio'];
$cpf_tira = $_GET['cpf_tira'];
$valor = $_GET['valor'];
$tarifa_aplicada = $_GET['tarifa'];

	
		echo "<script language='javascript'>window.location='auxilio.php?p=beneficio&cpf_auxilio=$cpf_auxilio&cpf_tira=$cpf_tira&valor=$valor&tarifa=$tarifa_aplicada&tipo=$tipo';</script>";


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select autofocus style="border:1px solid #999; padding:20px; width:150px; font:20px Arial, Helvetica, sans-serif; height:60px;" name="tipo" size="1">
   <option value="PIX">PIX</option>
   <option value="DOC">DOC</option>
   <option value="TED">TED</option>
   <option value="BOLETO">BOLETO</option>
   <option value="MAQUINA DE CART&Atilde;O">MAQUINA DE CART&Atilde;O</option>
   <option value="OUTROS">OUTROS</option>
 </select>

 <input style="border:1px solid #999; padding:18px; width:150px; font:20px Arial, Helvetica, sans-serif;" type="submit" name="avancar" value="finalizar" />
</form>
<? } ?>





<? if($_GET['p'] == 'beneficio'){ ?>
<h1><strong>Identifique o tipo de beneficio</strong></h1>
<hr />
<? if(isset($_POST['avancar'])){

$beneficio = $_POST['beneficio'];
$tipo = $_GET['tipo'];
$cpf_auxilio = $_GET['cpf_auxilio'];
$cpf_tira = $_GET['cpf_tira'];
$valor = $_GET['valor'];
$tarifa_aplicada = $_GET['tarifa'];

$code_beneficio = rand()+date("d")*date("d");

$sql_cadastrar_beneficio = mysqli_query($conexao_bd, "INSERT INTO auxilio_emergencial (code, data, data_completa, dia, mes, ano, operador, status, cpf_auxilio, cpf_tira, valor, tarifa, tipo, beneficio) VALUES ('$code_beneficio', '$data', '$data_completa', '$dia', '$mes', '$ano', '$operador', 'AGUARDA', '$cpf_auxilio', '$cpf_tira', '$valor', '$tarifa_aplicada', '$tipo', '$beneficio')");

	
		echo "<script language='javascript'>window.location='auxilio.php?p=final&cpf_auxilio=$cpf_auxilio&cpf_tira=$cpf_tira&valor=$valor&tarifa=$tarifa_aplicada&tipo=$tipo&beneficio=$beneficio&code_beneficio=$code_beneficio';</script>";


}?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select autofocus style="border:1px solid #999; padding:20px; width:300px; font:20px Arial, Helvetica, sans-serif; height:60px;" name="beneficio" size="1">
   <option value="AUXILIO EMERGENCIAL">AUXILIO EMERGENCIAL</option>
   <option value="BOLSA FAMILIA">BOLSA FAMILIA</option>
   <option value="FGTS">FGTS</option>
   <option value="OUTROS">OUTROS</option>
 </select>
 <input style="border:1px solid #999; padding:18px; width:150px; font:20px Arial, Helvetica, sans-serif;" type="submit" name="avancar" value="finalizar" />
</form>
<? } ?>






<? if($_GET['p'] == 'final'){ ?>
<h1><strong>Imprima o comprovante de saque de auxilio</strong></h1>
<hr />
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=150,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1000,height=600');
		}
	</script>
    <form name=""><input class="comprovante" type="submit"  onclick="abrePopUp('scripts/comprovante_de_auxilio.php?code=<? echo $_GET['code_beneficio']; ?>&code_conjunto=<? echo $_GET['code_conjunto']; ?>');" value="Imprimir comprovante de auxilio" autofocus/></form>
<? } ?>

</div><!-- box_pagamento_1 -->


</body>
</html>
