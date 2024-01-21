<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="sky/css/cliente_que_fecharam_negocio.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_clientes">
 <h1>Cliente que fecharam negocio</h1>
 <hr />
<? if(@$_GET['status'] == 'confirmar'){
	echo "<h3><img src='img/roler.gif'>Processando operação - Aguarde...</h3>";
	
$id = $_GET['id'];
$comissao = $_GET['comissao'];
$cpf = $_GET['cpf'];
$plano = $_GET['plano'];
$valor = $_GET['valor'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y");
$date_complet = date("d/m/Y H:i:s");
$dia = date("d");
$mes = date("m");
$ano = date("Y");

$sql_c = mysql_query("UPDATE contratos_sky SET status = 'Concluído', data_operacao = '$date_complet' WHERE id = '$id'");
if($sql_c == ''){
echo "<script language='javascript'>window.alert('Erro ao processar informação!');window.location='?pack=CL6';</script>";
}else{
	
$sql_co = mysql_query("INSERT INTO relatorio_do_caixa (ip, tipo, date, date_complet, dia, mes, ano, codigo, cpf, motivo, valor, forma_de_recebimento, lucro) VALUES ('$ip', 'Crédito', '$date', '$date_complet', '$dia', '$mes', '$ano', '$cpf', '$cpf', 'Assinatura Sky - $plano', '$valor', 'Déposito bancario', '$comissao')");

if($sql_co == ''){
echo "<script language='javascript'>window.alert('Erro ao processar dados para o relatório do caixa!');window.location='?pack=CL6';</script>";
}else{
	
echo "<script language='javascript'>window.location='?pack=CL6';</script>";

  }
 }
}?> 
 
 
 
 
 
 
 
 
<? if(@$_GET['status'] == 'deleta'){
	echo "<h3><img src='img/roler.gif'>Processando operação - Aguarde...</h3>";
	
$id = $_GET['id'];
$comissao = $_GET['comissao'];
$cpf = $_GET['cpf'];
$plano = $_GET['plano'];
$valor = $_GET['valor'];

$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y");
$date_complet = date("d/m/Y H:i:s");
$dia = date("d");
$mes = date("m");
$ano = date("Y");

$sql_c = mysql_query("UPDATE contratos_sky SET status = 'Proposta negada', data_operacao = '$date_complet' WHERE id = '$id'");

if($sql_c == ''){
echo "<script language='javascript'>window.alert('Erro ao processar informação!');window.location='?pack=CL6';</script>";
}else{
	
echo "<script language='javascript'>window.location='?pack=CL6';</script>";

 }
}?> 
 
  
 
 
<? 

$sql_1 = mysql_query("SELECT * FROM contratos_sky WHERE status = 'Ativo'");
if(mysql_num_rows($sql_1) == ''){
	echo "<h2><strong>No momento não existe nenhum plano para ser cadastrado.</strong></h2>";
}else{
?>
 <table width="1180" border="0">
   <tr>
     <td width="167" height="24"><strong>Nome: </strong></td>
     <td width="113"><strong>CPF:</strong></td>
     <td width="153"><strong>Plano</strong>:</td>
     <td width="121"><strong>Valor:</strong></td>
     <td width="211"><strong>Data do pedido:</strong></td>
     <td width="161"><strong>Status:</strong></td>
     <td width="125">&nbsp;</td>
     <td width="93">&nbsp;</td>
   </tr>
   <?
    while($res_1 = mysql_fetch_array($sql_1)){
    	$id_cliente = $res_1['id_cliente'];
    	$valor = $res_1['valor'];
		$comissao = $valor*81.7/100;
	$sql_2 = mysql_query("SELECT * FROM telemarketing WHERE id = '$id_cliente' OR cpf = '$id_cliente'");
		while($res_2 = mysql_fetch_array($sql_2)){
   ?>
   <tr>
     <td><? echo $res_2['nome']; ?></td>
     <td><? echo $res_2['cpf']; ?></td>
     <td><? echo $res_1['plano']; ?></td>
     <td><? echo $res_1['valor']; ?></td>
     <td><? echo $res_1['date']; ?></td>
     <td><? echo $res_1['status']; ?></td>
     <td><a rel="superbox[iframe][1010x550]" href="sky/informcao_completa.php?id=<? echo $res_1['id']; ?>&id_cliente=<? echo $res_1['id_cliente']; ?>">Informa&ccedil;&atilde;o completa</a></td>
     <td> <a target="_blank" href="http://centraldeconhecimento.sky.com.br/mpls/Web/Portal/Main/Home.aspx" title="Cadastrar venda diretamente na Sky"><img src="img/sky.jpg" width="20" height="20" border="0" /></a> <a href="?pack=CL6&status=confirmar&cpf=<? echo $res_2['cpf']; ?>&plano=<? echo $res_1['plano']; ?>&valor=<? echo $res_1['valor']; ?>&comissao=<? echo $comissao; ?>&id=<? echo $res_1['id']; ?>"><img title="Marcar como operação realizada com sucesso" src="img/correto.jpg" width="20" height="20" border="0" /></a> <a href="?pack=CL6&status=deleta&cpf=<? echo $res_2['cpf']; ?>&plano=<? echo $res_1['plano']; ?>&valor=<? echo $res_1['valor']; ?>&comissao=<? echo $comissao; ?>&id=<? echo $res_1['id']; ?>"><img title="Marcar como não concluído" src="img/deleta.jpg" width="18" height="18" border="0" /></a> <a rel="superbox[iframe][300x80]" href="sky/enviar_email.php?id=<? echo $res_1['id']; ?>&id_cliente=<? echo $id_cliente; ?>"><img title="Enviar e-mail" src="img/enviar_email.jpg" width="20" height="20" border="0" /> </a> </a></td>
   </tr>
   <? }} ?>
 </table>
<? } ?>
</div><!-- box_clientes -->
</body>
</html>