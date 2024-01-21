<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>

<style type="text/css">
body {
	background-color: #06C;
	color:#FFF;
	text-align:center;
	}
</style>
</head>

<body>
<form action="" method="post" enctype="multipart/form-data">

<table width="300" border="0">
  <tr>
    <td><h1 style="font:80px Arial, Helvetica, sans-serif; color:#FF0; padding:0; margin:0;">Solicite o VESTE PRIME VIRTUAL CARD MASTERCARD</h1></td>
  </tr>
  <tr>
    <td><img style="width:auto; border-radius:5px; border:5px solid #999;" src="../cartao/icone_cartao.jpg" width="954" height="502" /></td>
  </tr>
  <? if(isset($_POST['button'])){
  	require "../conexao.php";
	$cpf = $_POST['cpf'];
	if($cpf == ''){
		echo "<script language='javascript'>window.alert('POR FAVOR, DIGITE SEU CPF PARA ANALISE DE CRÉDITO!');</script>";
	}else{
		$sql = mysqli_query($conexao_bd, "SELECT * FROM cpf_cartao WHERE cpf = '$cpf'");
		if(mysqli_num_rows($sql) >= 1){
			echo "<script language='javascript'>window.alert('CPF já se encontra em nossa base de analise de crédito. Aguarde!');</script>";
		}else{
			mysqli_query($conexao_bd, "INSERT INTO cpf_cartao (cpf) VALUES ('$cpf')");
			echo "<script language='javascript'>window.alert('Proposta enviada com sucesso!');</script>";			
		}
	}







  }?>
  
  
  <tr>
    <td><h1 style="font:100px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>CPF</strong></h1></td>
  </tr>
  <tr>
    <td><label for="textfield"></label>
    <input name="cpf" type="number" id="textfield" style="font:100px Arial, Helvetica, sans-serif; margin:0; padding:0;" size="12" maxlength="11" /></td>
  </tr>
  <tr>
    <td><p>&nbsp;
      </p>
      <p>
        <input style="font:50px Arial, Helvetica, sans-serif; margin:0; padding:20px;" type="submit" name="button" id="button" value="Enviar" />
    </p></td>
  </tr>
</table>
</form>
</body>
</html>