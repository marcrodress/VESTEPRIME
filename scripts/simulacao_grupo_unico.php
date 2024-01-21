<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/simulacao_grupo_unico.css" rel="stylesheet" type="text/css" />
<? require "../config.php"; ?>
</head>

<body>
<div id="box">

<? if(isset($_POST['confirmar'])){
	
$i = $_POST['parcela'];
$cliente = $_GET['cliente'];
$id = $_GET['id'];
$n_proposta = $_GET['n_proposta'];
$taxa = $_GET['taxa'];
$valor = $_GET['valor'];

$taxa = $_GET['taxa'];  if($taxa == 0){ $taxa = 5; }else{ $taxa = $_GET['taxa']; }

$parcela_coo = 0;

$sql_verifica_parcela = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta' AND int_integrante = '1'");
	while($res_verifica_parcela = mysqli_fetch_array($sql_verifica_parcela)){
		$parcela_coo = $res_verifica_parcela['quant_parcela'];
	}

if($id != 1 && $parcela_coo == 0){
 echo "<script language='javascript'>window.alert('Você deve primeiro simular as parcelas do coordenador do grupo!');</script>";
}else{
if($i != $parcela_coo && $id != 1){
 echo "<script language='javascript'>window.alert('O número de parcelas deve ser igual para todos os clientes!');</script>";
}else{


$valor_parcela = (($valor*($taxa/100)*$i)+$valor+14.99)/$i;
$valor_total = ((($valor*($taxa/100)*$i)+$valor+14.99)/$i)*$i;

mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes SET valor = '$valor', juros = '$taxa', tarifa = '14.99', quant_parcela = '$i', valor_parcela = '$valor_parcela', valor_total = '$valor_total' WHERE n_proposta = '$n_proposta' AND cliente = '$cliente'");

echo "<strong>Contratação realizada com sucesso!</strong>
<br><br>
Pressione F5 para mesclar a operação
";

die;
  }
 }
}?>














<? 


$cliente = $_GET['cliente'];
$id = $_GET['id'];
$n_proposta = $_GET['n_proposta'];

$limite = 0;
$taxa_juros = 0;

$sql_limites = mysqli_query($conexao_bd, "SELECT * FROM limite_credmais WHERE cliente = '$cliente'");
	while($limite_cliente = mysqli_fetch_array($sql_limites)){
		$limite = $limite_cliente['limite'];
		$taxa_juros = $limite_cliente['taxa_juros'];
	}
	
if($limite == 0){
	$limite = 300;
}
	
?>
<table width="433" border="0">
  <tr>
    <td colspan="2"><strong>CLIENTE: </strong> 
      <? 
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>
    </td>
  </tr>
  <td width="176"><tr>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <input type="hidden" name="limite" value="<? echo $limite; ?>" />
    <td width="220"><strong>LIMITE DISPONÍVEL:</strong> R$ <? echo number_format($limite,2,',','.'); ?></td>
    <td width="203"><input style="font:15px Arial, Helvetica, sans-serif; color:#00F; text-align:center; padding:5px; border:1px solid #660; border-radius:3px;" name="valor" type="text" id="textfield" size="10" value="<? echo $limite; ?>" />
      <input style="font:15px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #660; border-radius:3px;" type="submit" name="button" id="button" value="SIMULAR" /></td>
    </tr>
  </form>
  
  <? if(isset($_POST['button'])){
  
   $valor = $_POST['valor'];
   
	$limite = $_POST['limite'];
	
	if($valor > $limite){
		echo "<script language='javascript'>window.alert('Não é possível solicitar um valor maior que o limite disponível!');</script>";
	}else{
	   
   
   echo "<script language='javascript'>window.location='?n_proposta=$n_proposta&cliente=$cliente&id=$id&valor=$valor&taxa=$taxa_juros';</script>";
	}
  }?>
  
  
<? if($_GET['valor'] != 0){ $taxa = $_GET['taxa'];  if($taxa == 0){ $taxa = 5; }else{ $taxa = $_GET['taxa']; } ?> 
  <tr>
    <td colspan="2"><hr />
      <strong style="color:#C60;">VALOR SOLICITADO:</strong> R$ <? $valor = $_GET['valor']; echo number_format($valor,2,',','.');?>
      <hr /></td>
  </tr>
  <? for($i=3; $i<=12; $i++){ ?>
  <form name="" method="post" enctype="multipart/form-data">
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><input type="radio" name="parcela" value="<? echo $i; ?>" />
      <? echo $i ?> X <? echo number_format((($valor*($taxa/100)*$i)+$valor+14.99)/$i,2,',','.'); ?> </td>
    <td width="247">R$ <? echo number_format(((($valor*($taxa/100)*$i)+$valor+14.99)/$i)*$i,2,',','.'); ?></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="2"><hr />      <input style="font:15px Arial, Helvetica, sans-serif; padding:5px; border:1px solid #660; border-radius:3px;" type="submit" name="confirmar" id="button2" value="Confirmar" /></td>
    </tr>
   </form>

<? } ?>
</table>
</div><!-- box -->
</body>
</html>