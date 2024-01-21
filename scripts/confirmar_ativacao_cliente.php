<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="css/confirmar_ativacao_cliente.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../conexao.php"; ?>
<div id="box">
<? if(isset($_POST['enviar'])){
	
$cliente = $_GET['cliente'];
$plano = $_GET['plano'];
$vencimento = $_POST['vencimento'];
$fechamento = 0;

if($vencimento <10){
	if($vencimento == 9){
		$fechamento = 28;
	}elseif($vencimento == 8){
		$fechamento = 28;
	}elseif($vencimento == 7){
		$fechamento = 27;
	}elseif($vencimento == 6){
		$fechamento = 26;
	}elseif($vencimento == 5){
		$fechamento = 25;
	}elseif($vencimento == 4){
		$fechamento = 24;
	}elseif($vencimento == 3){
		$fechamento = 23;
	}elseif($vencimento == 2){
		$fechamento = 22;
	}elseif($vencimento == 1){
		$fechamento = 21;
	}
}elseif($vencimento == 10){
	$fechamento = "01";
	}elseif($vencimento == 11){
		$fechamento = "01";
	}elseif($vencimento == 12){
		$fechamento = "02";
	}elseif($vencimento == 13){
		$fechamento = "03";
	}elseif($vencimento == 14){
		$fechamento = "04";
	}elseif($vencimento == 15){
		$fechamento = "05";
	}elseif($vencimento == 16){
		$fechamento = "06";
	}elseif($vencimento == 17){
		$fechamento = "07";
	}elseif($vencimento == 18){
		$fechamento = "08";
	}elseif($vencimento == 19){
		$fechamento = "09";
}else{
	$fechamento = $vencimento-10;
	}

$valor = 0;

if($plano == 'Varejo'){
	$valor = 4.99;
}elseif($plano == 'Gold'){
	$valor = 8.99;
}elseif($plano == 'Platinum'){
	$valor = 14.99;
}elseif($plano == 'Black'){
	$valor = 19.99;
}else{
	$valor = 4.99;
	}

mysqli_query($conexao_bd, "UPDATE conta_corrente SET status = 'ATIVO', vencimento = '$vencimento', fechamento = '$fechamento' WHERE cliente = '$cliente'");

echo "
<strong>Cadastrado ativado com sucesso!<br></strong>
<br>
<em>Pressione F5 para ativar todos os modulos deste cliente.</em>
";

die;
}?>
Escolha a data de vencimento da fatura
<form name="" method="post" action="" enctype="multipart/form-data">
<select name="vencimento" size="1" id="select">
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
          <option value="7">7</option>
          <option value="8">8</option>
          <option value="9">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
        </select>
<input type="submit" name="enviar" value="Confirmar" />
</form>
<!-- box -->
</div><!-- box -->
</body>
</html>