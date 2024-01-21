<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<? require "../config.php"; ?>

<style type="text/css">
table{
	padding:5px;
	text-align:center;
	}
body{
	font:12px Arial, Helvetica, sans-serif;
	}
body input{
	font:12px Arial, Helvetica, sans-serif;
	padding:5px;
	border:1px solid #09C;
	border-radius:5px;
	}
body select{
	font:12px Arial, Helvetica, sans-serif;
	padding:5px;
	border:1px solid #09C;
	border-radius:5px;
	}
table td{
	padding:5px;
	border:1px solid #09C;
	border-radius:5px;
	font-weight: bold;
	}
</style>
</head>

<body>
<? if($_GET['code_cofirmacao'] != ''){?>

<? if(isset($_POST['enviar'])){

$code_cofirmacao = $_POST['code_cofirmacao'];
if($code_cofirmacao != $_GET['code_cofirmacao']){
	echo "<script language='javascript'>window.alert('Código inválido!');</script>";
}else{

$titulo = $_GET['titulo'];
$cliente = $_GET['cliente'];
$code_cofirmacao = $_GET['code_cofirmacao'];
$telefone_cliente = $_GET['telefone'];
$resgate = $_GET['resgate'];


mysqli_query($conexao_bd, "INSERT INTO resgate (titulo, cliente, data, valor) VALUES ('$titulo', '$cliente', '$data_completa', '$resgate')");
mysqli_query($conexao_bd, "UPDATE plano_capitalizao SET status = 'REGASTADO' WHERE code = '$titulo' AND cliente = '$cliente'");

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=85984228226&msg=".urlencode("Titulo de capitalizacao: $titulo e cliente $cliente foi solicitado o resgate no valor $resgate!"),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  "cURL Error #:" . $err;
} else {
  $response;
}
 
 
 
 echo "<strong><br>Solicitação realizada com sucesso!</strong><br><br>Pressione F5.";
 die;

}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:12px Arial, Helvetica, sans-serif;"><em>Foi enviado um código de SMS para o telefone cadastrado</em></h1>
<hr />
<h1 style="font:12px Arial, Helvetica, sans-serif;"><strong>Digite o código recebido</strong></h1>
<input style="padding:10px; font:20px Arial, Helvetica, sans-serif; text-align:center; color:#09C;" type="text" name="code_cofirmacao" autofocus/> 
<input style="padding:10px; font:20px Arial, Helvetica, sans-serif; text-align:center; color:#09C;" type="submit" name="enviar" value="Enviar" />
</form>
<br /><br />
<a style="padding:10px; text-decoration:none; text-align:center; background:#990; color:#FFF; border:2px solid #000;" href="?titulo=<? echo $_GET['titulo'] ?>&cliente=<? echo $_GET['cliente'] ?>&p=reenviar&code_cofirmacao=<? echo $_GET['code_cofirmacao'] ?>&telefone=<? echo $_GET['telefone'] ?>">Reenviar código</a>

<? } ?>





<? if(@$_GET['p'] == 'reenviar'){



$titulo = $_GET['titulo'];
$cliente = $_GET['cliente'];
$code_cofirmacao = $_GET['code_cofirmacao'];
$telefone_cliente = $_GET['telefone'];


$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Para confirmar o resgate da sua capitalizacao digite o código: $code_cofirmacao.
  
  "),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  "cURL Error #:" . $err;
} else {
  $response;
}

$resgate = $_GET['resgate'];



	echo "<script language='javascript'>window.alert('Código reenviado!');window.location='?titulo=$titulo&cliente=$cliente&code_cofirmacao=$code_cofirmacao&telefone=$telefone_cliente&resgate=$resgate';</script>";
	


}?>


















<? if(isset($_POST['button'])){
	
$banco = $_POST['banco'];
$tipo = $_POST['tipo'];
$agencia = $_POST['agencia'];
$conta = $_POST['conta'];
$forma = $_POST['forma'];
$senha = $_POST['senha'];
$resgate = $_POST['valor_resgate'];

$sql_verifica_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE senha = '$senha' AND cpf = '".$_GET['cliente']."'");
if(mysqli_num_rows($sql_verifica_senha) == ''){
	echo "<script language='javascript'>window.alert('Senha incorreta!');</script>";
}else{
	mysqli_query($conexao_bd, "UPDATE plano_capitalizao SET forma_recebimento = '$forma', banco = '$banco', tipo_conta = '$tipo', agencia = '$agencia', conta_bancaria = '$conta'");

$titulo = $_GET['titulo'];
$cliente = $_GET['cliente'];
$code_cofirmacao = rand()+date("Y")+date("m");
$telefone_cliente = 0;

while($res_cliente = mysqli_fetch_array($sql_verifica_senha)){
	$telefone_cliente = $res_cliente['celular_1'];
}

$telefone_cliente = str_replace(" ", "", $telefone_cliente); 
$telefone_cliente = str_replace("(", "", $telefone_cliente); 
$telefone_cliente = str_replace(")", "", $telefone_cliente); 
$telefone_cliente = str_replace(".", "", $telefone_cliente); 




$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=$telefone_cliente&msg=".urlencode("VESTE PRIME: Para confirmar o resgate da sua capitalizacao digite o código: $code_cofirmacao.
  
  "),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  echo $response;
}




	echo "<script language='javascript'>window.location='?titulo=$titulo&cliente=$cliente&code_cofirmacao=$code_cofirmacao&telefone=$telefone_cliente&resgate=$resgate';</script>";
	
}



}?>



<? if($_GET['code_cofirmacao'] == ''){?>
<?
$sql_planos = mysqli_query($conexao_bd, "SELECT * FROM plano_capitalizao WHERE code = '".$_GET['titulo']."'");
if(mysqli_num_rows($sql_planos) == ''){
}else{
	while($res_planos = mysqli_fetch_array($sql_planos)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="800" border="0">
  <tr>
    <td colspan="7" bgcolor="#00CC99"><strong>DADOS DO PLANO</strong></td>
  </tr>
  <tr>
    <td width="98"><strong>Código</strong></td>
    <td width="127"><strong>Plano</strong></td>
    <td width="89"><strong>Período</strong></td>
    <td width="104"><strong>Carência</strong></td>
    <td width="148"><strong>Parc.  pagas</strong></td>
    <td width="113"><strong>Acumulado</strong></td>
    <td width="91"><strong>Vl. Resgate</strong></td>
  </tr>
  <tr>
    <td><? echo $res_planos['code']; ?></td>
    <td><? echo $res_planos['plano']; ?></td>
    <td><? 
	$meses = 0;
		if($res_planos['plano'] == 'VAREJO'){
		echo $meses = "12";
	}elseif($res_planos['plano'] == 'GOLD'){
		echo $meses = "24";
	}elseif($res_planos['plano'] == 'PLATINUM'){
		echo $meses = "36";
	}elseif($res_planos['plano'] == 'BLACK'){
		echo $meses = "48";
	}elseif($res_planos['plano'] == 'MASTERBLACK'){
		echo $meses = "60";
	}
	
	 ?></td>
    <td>12 meses</td>
    <td>
    <? $pago = 0; $parcelas_pagas = 0;
	 $sql_code_vencimento_primeira = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_planos['code']."'");
	 $parcelas_pagas = mysqli_num_rows($sql_code_vencimento_primeira);
     while($res_pagas = mysqli_fetch_array($sql_code_vencimento_primeira)){
		 $pago = $pago+$res_pagas['valor'];
	 }
	 echo number_format($pago,2,',','.');
	?>
    </td>
    <td>
    <?
	 $sql_code_vencimento_primeira = mysqli_query($conexao_bd, "SELECT * FROM parcelas_capitalizacao WHERE status = 'Pago' AND code_capitalizacao = '".$res_planos['code']."' AND n_parcela = '1'");
	 while($res_code_primeira = mysqli_fetch_array($sql_code_vencimento_primeira)){
	 $code_vencimento_primeira_parcela = $res_code_primeira['code_vencimento'];
	 }

	$dias_capitalizacao = $code_vencimento_hoje-$code_vencimento_primeira_parcela;
	 
	if($dias_capitalizacao <0){
	 $dias_capitalizacao = $code_vencimento_primeira_parcela-$code_vencimento_hoje;
	}
		
	$pago = (($pago*0.00033*($dias_capitalizacao))+$pago);
		
	echo number_format($pago,2,',','.');
	?>
    </td>
    <td>
    <? $resgate = 0;
	if($meses == $parcelas_pagas){
		echo $resgate = number_format($pago,2,',','.');
	}else{
		$percentual = ((60+($parcelas_pagas*0.5))/100);
		if($percentual >= 95){
			echo $resgate = number_format(95*$pago,2,',','.');
		}else{
			echo $resgate = number_format($percentual*$pago,2,',','.');
		}
	}
	?>
    </td>
  </tr>
  <tr>
    <td colspan="7" bgcolor="#00CC99"><strong>FORMA DE RESGATE</strong></td>
  </tr>
  <tr>
    <td colspan="3">Banco para resgate</td>
    <td>Tipo de conta</td>
    <td>Agência</td>
    <td>Conta</td>
    <td width="50">Form. resgate</td>
  </tr>
  <tr>
    <td colspan="3">
      <select name="banco" size="1" id="banco_emissor_cartao">
       <?
        $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo != '001'");
			while($res_1 = mysqli_fetch_array($sql_1)){
	   ?>
        <option value="<? echo $res_1['codigo']; ?>"><? echo $res_1['codigo']; ?> - <? echo $res_1['nome_banco']; ?></option>
        <? } ?>
      </select>     
    </td>
    <td><label for="tipo"></label>
      <select name="tipo" size="1" id="tipo">
        <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
        <option value="CORRENTE">CORRENTE</option>
      </select></td>
    <td><label for="textfield"></label>
    <input name="agencia" type="text" id="textfield" size="10" maxlength="4"></td>
    <td><label for="conta"></label>
    <input name="conta" type="text" id="conta" size="15"></td>
    <td><select name="forma" size="1" id="forma">
      <option value="TED">TED</option>
      <option value="CHEQUE">CHEQUE</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="7" align="center" bgcolor="#00CC99">Senha do cart&atilde;o do cliente</td>
  </tr>
  <tr>
    <td colspan="7" align="center"><input style="font:20px Arial, Helvetica, sans-serif; text-align:center; color:#09C; width:60px;" name="senha" type="password" /></td>
  </tr>
  <tr> <input type="hidden" name="valor_resgate" value="<? echo $resgate; ?>" />
    <td colspan="7" align="center"><input style="font:12px Arial, Helvetica, sans-serif; padding:8px; border-radius:3px; border:1px solid #666;" type="submit" name="button" id="button" value="Avan&ccedil;ar resgate" /></td>
  </tr>
</table>
</form>
<? }} ?>

<? } ?>
</body>
</html>