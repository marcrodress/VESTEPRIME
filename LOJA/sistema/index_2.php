<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sistema Easy Loan Servi&ccedil;os Financeiros</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>
</head>

<body>
<? require "config.php"; require "../conexao.php"; ?>
<?
$sql_cliente = mysql_query("SELECT * FROM atendimentos WHERE atendente = '$nome_operador' AND status = 'Aberto' ORDER BY id DESC LIMIT 1");
if(mysql_num_rows($sql_cliente) == ''){
?>
<? require "topo.php"; ?>

<div id="contente_site">
<? require "paginas.php"; ?>
</div><!-- contente_site -->

<? require "rodape.php"; ?>

<? }else{
 while($res_cliente = mysql_fetch_array($sql_cliente)){
	 
$cpf_cliente = $res_cliente['cpf'];
$nome_cliente = $res_cliente['nome'];
$telefone_cliente = $res_cliente['telefone'];
$rg_cliente = $res_cliente['rg'];
 
?>

<? require "topo.php"; ?>

<div id="contente_site">
<? require "paginas.php"; ?>
</div><!-- contente_site -->

<? require "rodape.php"; ?>

<? }} ?>
</body>
</html>