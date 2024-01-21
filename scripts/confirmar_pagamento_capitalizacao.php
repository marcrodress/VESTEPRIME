<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
<? require "../config.php"; ?>
<style type="text/css">
body{
	font:12px Arial, Helvetica, sans-serif;
	color:#930;
	}
body,td,th {
	color: #000;
}

body table{
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	}
</style>
</head>

<body>
<? if(isset($_POST['button'])){
	
$form_pagt = $_POST['form_pagt'];
$status_cap = $_GET['status_cap'];
$cliente = $_GET['cliente'];
$valor = $_GET['valor'];

$valor_total = number_format($_GET['receber'],2,',','.');

mysqli_query($conexao_bd, "UPDATE parcelas_capitalizacao SET operador_pgto = '$operador', multa = '".$_GET['multa']."', juros = '".$_GET['juros']."', vl_recebido = '".$_GET['receber']."', forma_pagt = '$form_pagt', dia_pagt = '$dia', mes_pagt = '$mes', ano_pagt = '$ano', data_pagt = '$data', data_completa_pagt = '$data_completa', status = 'Pago' WHERE id = '".$_GET['id']."'");


if($status_cap == 'Aguarda'){
	mysqli_query($conexao_bd, "UPDATE plano_capitalizao SET status = 'Ativo' WHERE code = '".$_GET['plano']."'");
}






	$score = 0;
	$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	 while($res_score = mysqli_fetch_array($sql_score)){
		 $score = $res_score['score'];
	 }

	   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'PAGAMENTO DE PARCELA DE CAPITALIZACAO', '".$score*0.3."')");
   	  
	  $score = $score+($valor*0.3);
     
	   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");







echo "
<strong>Pagamento confirmado com sucesso!</strong>
<br><br>
<em>Pressione F5 para mesclar a operação.</em>
"; 



$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.smsdev.com.br/v1/send?key=TZXZSWGNSZY51PZTLQ1SI772BRGA1FGQAKH16GEYTWKMUBSHF2K5D4O4REAUCWD2KG686DRENLFCJZKQT0FEJ4V1YSVICR1DCRU1PJW2OZIW48VKFQ8V084I82QJ5SSZ&type=9&number=85984228226&msg=".urlencode("Titulo de capitalizacao: Foi pago $valor_total do cliente $cliente"),
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


die;

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="754" border="0">
  <tr>
    <td width="81" bgcolor="#669999"><strong>COD.TITULO</strong></td>
    <td width="90" bgcolor="#669999"><strong>PARCELA</strong></td>
    <td width="73" bgcolor="#669999"><strong>VALOR</strong></td>
    <td width="78" bgcolor="#669999"><strong>MULTA</strong></td>
    <td width="75" bgcolor="#669999"><strong>JUROS</strong></td>
    <td width="91" bgcolor="#669999"><strong>A RECEBER</strong></td>
    <td width="162" bgcolor="#669999"><strong>FORM. PAGT.</strong></td>
    <td width="70" bgcolor="#669999">&nbsp;</td>
  </tr>
  <tr>
    <td><? echo $_GET['plano']; ?></td>
    <td><? echo $_GET['parcela']; ?></td>
    <td><? echo number_format($_GET['valor'],2,',','.'); ?></td>
    <td><? echo number_format($_GET['multa'],2,',','.'); ?></td>
    <td><? echo number_format($_GET['juros'],2,',','.'); ?></td>
    <td><? echo number_format($_GET['receber'],2,',','.'); ?></td>
    <td>
      <select style="border:1px solid #000; border-radius:3px; text-align:center;" name="form_pagt" size="1" id="select">
        <option value="DINHEIRO">DINHEIRO</option>
        <option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
        <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
    </select></td>
    <td><input style="border:1px solid #000; border-radius:3px; text-align:center;" type="submit" name="button" id="button" value="Confirmar" /></td>
  </tr>
</table>
</form>
</body>
</html>