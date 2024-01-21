<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
<script src="../SpryAssets/SpryValidationCheckbox.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationCheckbox.css" rel="stylesheet" type="text/css" />
</head>

<body>
<p>
<? if(isset($_POST['enviar'])){

require "../conexao.php";

$tarifa = $_POST['tarifa'];
$senha = $_POST['senha'];
$vencimento = $_POST['vencimento'];

$cliente = $_GET['cliente'];


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
		$fechamento = "11";
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

if($tarifa == ''){
	echo "<script language='javascript'>window.alert('O cliente precisa concordar com a tarifa para iniciar a avaliação automática de crédito!');window.location='';</script>";
}elseif($senha == ''){
	echo "<script language='javascript'>window.alert('Peça ao cliente que digite sua senha para iniciar a avaliação de crédito!');window.location='';</script>";
}else{

	$sql_confere_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
	if(mysqli_num_rows($sql_confere_senha) == ''){
		echo "<script language='javascript'>window.alert('Senha não confere!');window.location='';</script>";
	}else{
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vencimento = '$vencimento', fechamento = '$fechamento' WHERE cliente = '$cliente'");
		echo "<strong>Prezado cliente!</strong><br><br>As alterações foram realziadas com sucesso.<br><br><em>Pressione F5 para mesclar a operação.</em>.";
		
		die;
		
  } 
 }
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <span id="sprycheckbox1">
  <input type="checkbox" name="tarifa" id="checkbox" />
  <span class="checkboxRequiredMsg">O cliente precisar concordar com a cobran&ccedil;a da tarifa.</span></span>
  <label for="checkbox"></label> 
Concordo que após autorizar a alteração do vencimento da fatura, será cobrado uma tarifa única no valor de <strong style="font:15px Arial, Helvetica, sans-serif;"><strong>R$ 0,00</strong></strong> na fatura do cliente, caso a alteração seja aprovada.</p>
<p><hr />
<strong>Novo vencimento</strong><br />
 <select name="vencimento" size="1">
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
  <p>Digite a senha para confirmar</p>
  <p>
  <input name="senha" type="password" id="textfield" style="font:20px Arial, Helvetica, sans-serif; color:#F90; text-align:center; border-radius:5px; border:1px solid #000;" size="5" maxlength="6" autofocus />
    </p>
  </p>
<p>
  <input style="font:12px Arial, Helvetica, sans-serif; color:#666; padding:5px; border-radius:3px; border:1px solid #000;" type="submit" name="enviar" id="button" value="Confirmar" />
</form>
</p>
<script type="text/javascript">
var sprycheckbox1 = new Spry.Widget.ValidationCheckbox("sprycheckbox1");
</script>
</body>
</html>