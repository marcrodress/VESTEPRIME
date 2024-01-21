<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/saque_banco_do_brasil.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_deposito">
<h1><strong>28 - INFORMAÇÃO DE SAQUE BANCO DO BRASIL</strong></h1>
<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table table-striped table-bordered" width="1000" border="0">
  <tr>
    <td bgcolor="#999999"><strong>DATA</strong></td>
    <td bgcolor="#999999"><strong>AGÊNCIA</strong></td>
    <td bgcolor="#999999"><strong>TIPO DE CONTA</strong></td>
    <td bgcolor="#999999"><strong>CONTA</strong></td>
    <td bgcolor="#999999"><strong>TITULAR DA CONTA</strong></td>
    <td bgcolor="#999999"><strong>VALOR</strong></td>
    <td colspan="2" bgcolor="#999999"><strong>Nº DOCUMENTO</strong></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input class="form-control" name="data" type="text" id="textfield" value="<? echo date("d/m/Y"); ?>" size="10"></td>
    <td><label for="textfield2"></label>
    <input class="form-control" name="agencia" type="text" autofocus size="5"></td>
    <td>
      <select name="tipo_conta" size="1" id="select">
        <option value="CORRENTE">CORRENTE</option>
        <option value="POUPANCA - 51">POUPANCA - 51</option>
        <option value="POUPANCA - 96">POUPANCA - 96</option>
        <option value="SAQUE INSS">SAQUE INSS</option>
        <option value="SAQUE MAIS INF&Acirc;NCIA">SAQUE MAIS INF&Acirc;NCIA</option>
        <option value="OUTROS SAQUES BB">OUTROS SAQUES BB</option>
      </select></td>
    <td><label for="textfield3"></label>
    <input class="form-control" name="conta" type="text" id="textfield3" size="10"></td>
    <td><label for="textfield4"></label>
    <input class="form-control" name="favorecido" type="text" id="textfield4" size="35"></td>
    <td><label for="textfield5"></label>
    <input class="form-control" name="valor" type="text" id="textfield5" size="8"></td>
    <td><label for="textfield6"></label>
    <input class="form-control" name="n_documento" type="text" id="textfield6" size="18"></td>
    <td><input type="submit" name="button" id="button" value="ENVIAR"></td>
  </tr>
</table>
</form>
<? if(isset($_POST['button'])){
	
$data_deposito = $_POST['data'];
$agencia = $_POST['agencia'];
$tipo_conta = $_POST['tipo_conta'];
$conta = $_POST['conta'];
$favorecido = $_POST['favorecido'];
$valor = $_POST['valor'];
$n_documento = $_POST['n_documento'];


$verifica_virgula = 0;

for($i=0; $i<(strlen($valor)); $i++){
	if($valor[$i] == ','){
		$verifica_virgula = 1;
	}
}

if($verifica_virgula == 1){
echo "<script language='javascript'>window.alert('NÃO É PERMITIDO O USO DE VIRGULAS NO SISTEMA! USE O PONTO PARA SEPARAR OS CENTAVOS');</script>";
}else{



  $novos_pontos = 0;
  $vestepoint = 0;
  $cliente = 0;
  
  
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente
  
  
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = $valor/3;
		}elseif($categoria == 'platinum'){
			$novos_pontos = $valor/4;
		}elseif($categoria == 'gold'){
			$novos_pontos = $valor/4.5;
		}else{
			$novos_pontos = $valor/5;
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'SAQUE BANCO DO BRASIL', '$operador', '$novos_pontos', '$valor', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cliente'");
    



mysqli_query($conexao_bd, "INSERT INTO saque_banco_brasil (codeCaixa, turno, cliente, ip, dia, mes, ano, data, data_completa, status, operador, data_deposito, agencia, tipo_conta, conta, favorecido, valor, n_documento, motivo_cancelamento, operador_cancelamento) VALUES ('$codeCaixa', '$turno', '$cliente', '$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$operador', '$data_deposito', '$agencia', '$tipo_conta', '$conta', '$favorecido', '$valor', '$n_documento', '', '')");

echo "<script language='javascript'>window.location='';</script>";
 }
}?>

<ul>
<br />
<strong>CUIDADO</strong>
<li>Ao informar o saque para o sistema, por favor, certifique se o mesmo realmente foi realizado.</li>
<li>Cuidado para não digitar informações incorretas.</li>
</ul>
<hr />
<?

$sql_deposito = mysqli_query($conexao_bd, "SELECT * FROM saque_banco_brasil WHERE data_deposito = '$data' AND status = 'Ativo'");
if(mysqli_num_rows($sql_deposito) == ''){
}else{

?>
<table class="table table-striped table-bordered table-hover" width="1000" border="0">
  <tr>
    <td width="34" bgcolor="#999999"><strong>ID</strong></td>
    <td width="54" bgcolor="#999999">DATA</td>
    <td width="99" bgcolor="#999999"><strong>AGÊNCIA</strong></td>
    <td width="133" bgcolor="#999999"><strong>TIPO DE CONTA</strong></td>
    <td width="94" bgcolor="#999999"><strong>CONTA</strong></td>
    <td width="281" bgcolor="#999999"><strong>TITULAR DA CONTA</strong></td>
    <td width="101" bgcolor="#999999"><strong>VALOR</strong></td>
    <td width="113" bgcolor="#999999"><strong>Nº DOCUMENTO</strong></td>
    <td width="53" bgcolor="#999999">&nbsp;</td>
  </tr>
  <? 
  $i = 0;  $total = 0;
  while($res_deposito = mysqli_fetch_array($sql_deposito)){ $i++;  $total = $res_deposito['valor']+$total; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_deposito['id']; ?></td>
    <td><? echo $res_deposito['data_deposito']; ?></td>
    <td><? echo $res_deposito['agencia']; ?></td>
    <td><? echo $res_deposito['tipo_conta']; ?></td>
    <td><? echo $res_deposito['conta']; ?></td>
    <td><? echo strtoupper($res_deposito['favorecido']); ?></td>
    <td>R$ <? echo number_format($res_deposito['valor'],2,',','.'); ?></td>
    <td><? echo $res_deposito['n_documento']; ?></td>
    <td>
        <? if($tipo == 'ADM'){ ?>
    	<a rel="superbox[iframe][550x250]" href="scripts/cancela_saque.php?id=<? echo $res_deposito['id']; ?>"><img src="img/deleta.jpg" width="18" height="18" border="0" /></a>
        <? } ?>
        </td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="6">&nbsp;</td>
    <td bgcolor="#CCCCCC">R$ <? echo number_format($total,2,',','.'); ?></td>
    <td colspan="2">&nbsp;</td>
    </tr>
</table>
<? } ?>
</div><!-- box_deposito -->
</body>
</html>