<? require "conexao.php";  ?>
<? 
@session_start();
$operador = $_SESSION['cpf'];
$nome = $_SESSION['nome'];
$tipo = $_SESSION['tipo'];
$filial = $_SESSION['filial'];
$codeCaixa = $_SESSION['codeCaixa'];


if($operador == ''){
	echo "<script language='javascript'>window.location='login.php';</script>";
}

mysqli_query($conexao_bd, "INSERT INTO gravador_url (ip, data, data_completa, operador, url) VALUES ('$ip', '$data', '$data_completa', '$operador', '$url')");




?>
