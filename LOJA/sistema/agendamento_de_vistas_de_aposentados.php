<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/agendamento_de_vistas_de_aposentados.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_visitas">
 <h1>Visitas agendadas</h1>
 <?
 
 $sql_1 = mysql_query("SELECT * FROM visitas_confirmadas WHERE status != 'Concluído'");
 $conta_sql_1 = mysql_num_rows($sql_1);
 if($conta_sql_1 == ''){
	 echo "No momento não existe nenhum cliente para ser visitado!";
 }else{
 ?>
 <form name="" action="" enctype="multipart/form-data" method="post">
    <table width="1180" border="0">
      <tr>
        <td width="83"><strong>Status:</strong></td>
        <td width="105"><strong>Data da visita:</strong></td>
        <td width="86"><strong>Turno:</strong></td>
        <td width="134"><strong>Valor pretendido:</strong></td>
        <td width="96"><strong>CPF:</strong></td>
        <td width="157"><strong>Data da liga&ccedil;&atilde;o:</strong></td>
        <td width="169"><strong>Dados a visita:</strong></td>
        <td width="314"><strong>Situa&ccedil;&atilde;o da visita:</strong></td>
      </tr>
   <? while($res_1 = mysql_fetch_array($sql_1)){ ?>
   
      <tr>
        <td><? echo $res_1['status']; ?></td>
        <td><? echo $res_1['data_visita']; ?></td>
        <td><? echo $res_1['turno_visita']; ?></td>
        <td><? echo $res_1['vl_pretendido']; ?></td>
        <td><? echo $res_1['cpf']; ?></td>
        <td><? echo $res_1['data']; ?></td>
        <td><a href="pg_extras/dados_visita.php?id=<? echo $res_1['id']; ?>&id_cliente=<? echo $res_1['id_cliente']; ?>" rel="superbox[iframe][1050x700]">Imprimir relat&oacute;rio da visita</a></td>
        <td colspan="2"><a href="?pack=AGF2&acao=1&status=Concluído&id=<? echo $res_1['id']; ?>">Sucesso</a> | <a href="?pack=AGF2&acao=1&status=Não localizado&id=<? echo $res_1['id']; ?>">N&atilde;o localizado</a> | <a href="?pack=AGF2&acao=1&status=Não fez o empréstimo&id=<? echo $res_1['id']; ?>">N&atilde;o fez o empr&eacute;stimo</a> | <a href="?pack=AGF2&acao=1&status=Outro&id=<? echo $res_1['id']; ?>">Outro</a></td>
      </tr>
      <tr>
        <td colspan="9"><hr /></td>
      </tr>
    <? } ?>
    </table>
    </form>
 <? }?>
<? if(@$_GET['acao'] == '1'){

$status = $_GET['status'];
$id_operation = $_GET['id'];

$date = date("d/m/Y H:i:s");
$ip = $_SERVER['REMOTE_ADDR'];

mysql_query("UPDATE visitas_confirmadas SET status = '$status', ip_result = '$ip', resultado = '$status', data_resultado = '$date' WHERE id = '$id_operation'");

echo "<script language='javascript'>window.location='?pack=AGF2';</script>";

}?> 
</div><!-- box_visitas -->
</body>
</html>