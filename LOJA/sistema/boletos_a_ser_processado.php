<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/boletos_a_ser_processado.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<h1><strong>Boletos a serem processados</strong></h1><hr />
<? if(isset($_POST['button'])){
	
$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];
$status = $_POST['status'];

$vencimento = "$dia/$mes/$ano";

if($status == ''){
$filtro = base64_encode("SELECT * FROM pagamento_contas WHERE vencimento = '$vencimento' AND tipo = 'BOLETO'");
}elseif($dia == 0 && $mes == 0 && $ano == 0){
$filtro = base64_encode("SELECT * FROM pagamento_contas WHERE tipo = 'BOLETO'");
}else{
$filtro = base64_encode("SELECT * FROM pagamento_contas WHERE vencimento = '$vencimento' AND tipo = 'BOLETO' AND status = '$status'");
}
echo "<script language='javascript'>window.location='?pack=boletos_a_ser_processado&filtro=$filtro';</script>";

}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1100" border="0">
  <tr>
    <td width="52"><strong>Dia</strong></td>
    <td width="52"><strong>M&ecirc;s</strong></td>
    <td width="68"><strong>Ano</strong></td>
    <td width="123"><strong>Status</strong></td>
    <td width="783">&nbsp;</td>
    </tr>
  <tr>
    <td><label for="dia"></label>
      <select name="dia" size="1" id="dia">
        <option value=""></option>
        <option value="01">01</option>
        <option value="02">02</option>
        <option value="03">03</option>
        <option value="04">04</option>
        <option value="05">05</option>
        <option value="06">06</option>
        <option value="07">07</option>
        <option value="08">08</option>
        <option value="09">09</option>
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
        <option value="29">29</option>
        <option value="30">30</option>
        <option value="31">31</option>
      </select></td>
    <td><label for="mes"></label>
      <select name="mes" size="1" id="mes">
        <option value=""></option>      
        <option value="01">JANEIRO</option>
        <option value="02">FEVEREIRO</option>
        <option value="03">MAR&Ccedil;O</option>
        <option value="04">ABRIL</option>
        <option value="05">MAIO</option>
        <option value="06">JUNHO</option>
        <option value="07">JULHO</option>
        <option value="08">AGOSTO</option>
        <option value="09">SETEMBRO</option>
        <option value="10">OUTUBRO</option>
        <option value="11">NOVEMBRO</option>
        <option value="12">DEZEMBRO</option>
      </select></td>
    <td><label for="ano"></label>
      <select name="ano" size="1" id="ano">
        <option value=""></option>      
        <option value="2019">2019</option>
        <option value="2018">2018</option>
        <option value="2020">2020</option>
        <option value="2021">2021</option>
        <option value="2022">2022</option>
        <option value="2023">2023</option>
      </select></td>
    <td><label for="status"></label>
      <select name="status" size="1" id="status">
        <option value=""></option>
        <option value="Aguarda">Aguarda</option>
        <option value="Efetivado">Efetivado</option>
      </select></td>
    <td align="left"><input type="submit" class="input" name="button" id="button" value="Enviar" /></td>
    </tr>
</table>
</form>
<hr />
<table width="1190" border="0">
  <tr>
    <td width="54" height="34" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
    <td width="98" bgcolor="#CCCCCC"><strong>EMISSOR</strong></td>
    <td width="178" bgcolor="#CCCCCC"><strong>CÓDIGO DE BARRAS</strong></td>
    <td width="45" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
    <td width="43" bgcolor="#CCCCCC"><strong>JUROS</strong></td>
    <td width="102" bgcolor="#CCCCCC"><strong>FORM. PGT</strong></td>
    <td width="44" bgcolor="#CCCCCC"><strong>TARIFA</strong></td>
    <td width="82" bgcolor="#CCCCCC"><strong>VENCIMENTO</strong></td>
    <td width="68" bgcolor="#CCCCCC"><strong>CLIENTE</strong></td>
    <td width="45" bgcolor="#CCCCCC"><strong>Nº DOC</strong></td>
    <td width="136" bgcolor="#CCCCCC"><strong>PROCESSAMENTO</strong></td>
    <td width="140" bgcolor="#CCCCCC">&nbsp;</td>
    <td width="101" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
<?
$i = 0;
$filtro = base64_decode($_GET['filtro']);
$sql_pagamento = mysql_query($filtro);
	while($res_pagamento = mysql_fetch_array($sql_pagamento)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_pagamento['status']; ?></td>
    <td><? echo $res_pagamento['banco']; ?></td>
    <td><? echo $res_pagamento['code_barras']; ?></td>
    <td><? echo number_format($res_pagamento['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_pagamento['juros']; ?></td>
    <td><? echo $res_pagamento['forma_pagamento']; ?></td>
    <td><? echo $res_pagamento['tarifa']; ?></td>
    <td><? echo $res_pagamento['vencimento']; ?></td>
    <td><a rel="superbox[iframe][300x70]" href="scripts/mostrar_cliente.php?cliente=<? echo $res_pagamento['cliente']; ?>"><? echo $res_pagamento['cliente']; ?></a></td>
    <td><? echo $res_pagamento['n_doc']; ?></td>
    <td><? echo $res_pagamento['forma_processamento']; ?></td>
    <td><? echo $res_pagamento['banco_processamento']; ?></td>
    <td>
      <img src="img/bloquea.png" width="20" height="20">
      
      <img src="img/correto.jpg" width="20" height="20">
      
      <a rel="superbox[iframe][975x300]" href="scripts/cancela_boleto.php?id=<? echo $res_pagamento['id']; ?>"><img src="img/deleta.jpg" width="18" height="18" title="Excluir boleto do sistema!"></a>
      
      <a rel="superbox[iframe][975x300]" href="scripts/efetivar_pagamento.php?id=<? echo $res_pagamento['id']; ?>"><img src="img/cadastro.jpg" width="20" height="20" border="0" title="EFETIVAR PAGAMENTO" /></a>
      
    </td>
  </tr>
  <? } ?>
</table>

</div><!-- box_cad_produto -->
</body>
</html>