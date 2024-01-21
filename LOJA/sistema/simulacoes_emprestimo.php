<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/simulacoes_emprestimo.css" rel="stylesheet" type="text/css" />
<link href="img/logo.png" rel="shortcut icon" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'jbcred'){ ?>
 <h1>Simulação de empréstimo com a JB Cred<hr /></h1>
<table class="table" width="1175" border="0">
  <tr>
    <td width="351"><strong>200,00 </strong>= 87,00</td>
    <td width="373"><strong>650,00</strong> = 237,75</td>
    <td width="437"><strong>1200,00</strong> = 422,00</td>
  </tr>
  <tr>
    <td><strong>250,00 </strong>= 103,75</td>
    <td><strong>700,00</strong> = 254,50</td>
    <td><strong>1300,00</strong> = 455,55</td>
  </tr>
  <tr>
    <td><strong>300,00</strong> = 120,50</td>
    <td><strong>750,00</strong> = 271,25</td>
    <td><strong>1400,00</strong> = 489,00</td>
  </tr>
  <tr>
    <td><strong>350,00</strong> = 137,25</td>
    <td><strong>800,00</strong> = 288,00</td>
    <td><strong>1500,00 </strong>= 522,50</td>
  </tr>
  <tr>
    <td><strong>400,00</strong> = 154,00</td>
    <td><strong>850,00</strong> = 304,75</td>
    <td><strong>1600,00</strong> = 556,00</td>
  </tr>
  <tr>
    <td><strong>450,00</strong> = 170,75</td>
    <td><strong>900,00</strong> = 921,50</td>
    <td><strong>1700,00</strong> = 589,50</td>
  </tr>
  <tr>
    <td><strong>500,00</strong> = 187,50</td>
    <td><strong>950,00</strong> = 338,25</td>
    <td><strong>1800,00 </strong>= 623,00</td>
  </tr>
  <tr>
    <td><strong>550,00</strong> = 204,25</td>
    <td><strong>1000,00</strong> = 355,00</td>
    <td><strong>1900,00</strong> = 656,50</td>
  </tr>
  <tr>
    <td><strong>600,00</strong> = 221,00</td>
    <td><strong>1100,00</strong> = 388,50</td>
    <td><strong>2000,00</strong> = 690,00</td>
  </tr>
</table>
 
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = "19.5";

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 6");
?>
<table width="1175" border="0">
  <tr>
    <td width="116"><strong>Valor solicitado:</strong></td>
    <td width="187"><strong>Quantidade de Parcelas:</strong></td>
    <td width="120"><strong>Taxas de juro:</strong></td>
    <td width="153"><strong>Valor da parcela:</strong></td>
    <td width="149"><strong>Juros na parcela:</strong></td>
    <td width="181"><strong>Valor total da parcela:</strong></td>
    <td width="164"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td><? echo $taxa_juro; ?>%</td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td>R$ <? $parcela2 = $valor*$taxa_juro/100; echo number_format($parcela2,2,",","."); ?></td>
    <td>R$ <? $parcela3 = $valor*$taxa_juro/100+$parcela1; echo number_format($parcela3,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela3*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->



<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'outros_aposentado'){ ?>
 <h1>Simulação de empréstimo consignado para outros aposentados<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = "1.41";

$sql = mysql_query("SELECT * FROM simulador_meses  ORDER BY id DESC");
?>
<table width="1175" border="0">
  <tr>
    <td width="116"><strong>Valor solicitado:</strong></td>
    <td width="187"><strong>Quantidade de Parcelas:</strong></td>
    <td width="120"><strong>Taxas de juro:</strong></td>
    <td width="153"><strong>Valor da parcela:</strong></td>
    <td width="149"><strong>Juros na parcela:</strong></td>
    <td width="181"><strong>Valor total da parcela:</strong></td>
    <td width="164"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td><? echo $taxa_juro; ?>%</td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td>R$ <? $parcela2 = $valor*$taxa_juro/100; echo number_format($parcela2,2,",","."); ?></td>
    <td>R$ <? $parcela3 = $valor*$taxa_juro/100+$parcela1; echo number_format($parcela3,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela3*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->




<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'autonomo_com_cheque'){ ?>
 <h1>Simulação de empréstimo autônomo com cheque<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = "9.9";

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 24");
?>
<table width="1175" border="0">
  <tr>
    <td width="116"><strong>Valor solicitado:</strong></td>
    <td width="187"><strong>Quantidade de Parcelas:</strong></td>
    <td width="120"><strong>Taxas de juro:</strong></td>
    <td width="153"><strong>Valor da parcela:</strong></td>
    <td width="149"><strong>Juros na parcela:</strong></td>
    <td width="181"><strong>Valor total da parcela:</strong></td>
    <td width="164"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td><? echo $taxa_juro; ?>%</td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td>R$ <? $parcela2 = ($valor*$taxa_juro)/100; echo number_format($parcela2,2,",","."); ?></td>
    <td>R$ <? $parcela3 = ($valor*$taxa_juro)/100+$parcela1; echo number_format($parcela3,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela3*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->





<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'autonomo_com_carne'){ ?>
 <h1>Simulação de empréstimo autônomo no carné<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = "13";

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 18");
?>
<table width="1175" border="0">
  <tr>
    <td width="116"><strong>Valor solicitado:</strong></td>
    <td width="187"><strong>Quantidade de Parcelas:</strong></td>
    <td width="120"><strong>Taxas de juro:</strong></td>
    <td width="153"><strong>Valor da parcela:</strong></td>
    <td width="149"><strong>Juros na parcela:</strong></td>
    <td width="181"><strong>Valor total da parcela:</strong></td>
    <td width="164"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td><? echo $taxa_juro; ?>%</td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td>R$ <? $parcela2 = $valor*$taxa_juro/100; echo number_format($parcela2,2,",","."); ?></td>
    <td>R$ <? $parcela3 = $valor*$taxa_juro/100+$parcela1; echo number_format($parcela3,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela3*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->






<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'carteira_assinada'){ ?>
 <h1>Simulação de empréstimo funcionário de empresa privada<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = "6.99";

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 24");
?>
<table width="1175" border="0">
  <tr>
    <td width="116"><strong>Valor solicitado:</strong></td>
    <td width="187"><strong>Quantidade de Parcelas:</strong></td>
    <td width="120"><strong>Taxas de juro:</strong></td>
    <td width="153"><strong>Valor da parcela:</strong></td>
    <td width="149"><strong>Juros na parcela:</strong></td>
    <td width="181"><strong>Valor total da parcela:</strong></td>
    <td width="164"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="7"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td><? echo $taxa_juro; ?>%</td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td>R$ <? $parcela2 = $valor*$taxa_juro/100; echo number_format($parcela2,2,",","."); ?></td>
    <td>R$ <? $parcela3 = $valor*$taxa_juro/100+$parcela1; echo number_format($parcela3,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela3*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->







<div id="box_cadastro_de_cliente">
<? if(@$_GET['perfil'] == 'cartao_de_credito'){ ?>
 <h1>Simulação de empréstimo com cartão de crédito<hr /></h1>
 <form name="" method="post" enctype="multipart/form-data" action="">
   <span id="sprytextfield1">
   <input type="text" name="valor" />
   </span>
   <input class="input" type="submit" name="send" value="SIMULAR" />
 </form>

<? if(isset($_POST['send'])){

$valor = $_POST['valor'];
$taxa_juro = 6.5;

$sql = mysql_query("SELECT * FROM simulador_meses LIMIT 12");
?>
<table width="1175" border="0">
  <tr>
    <td width="115"><strong>Valor solicitado:</strong></td>
    <td width="67"><strong>Parcelas:</strong></td>
    <td width="115"><strong>Valor da parcela:</strong></td>
    <td width="141"><strong>Taxa administrativa:</strong></td>
    <td width="148"><strong>Juros de parcelamento</strong></td>
    <td width="115"><strong>Taxa de juros:</strong></td>
    <td width="117"><strong>Juros na parcela:</strong></td>
    <td width="148"><strong>Valor total da parcela:</strong></td>
    <td width="169"><strong>Valor total a ser pago:</strong></td>
  </tr>
<? while($res_sql = mysql_fetch_array($sql)){ ?>  
  <tr>
    <td colspan="9"><hr></td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($valor,2,",","."); ?></td>
    <td><? echo $res_sql['mes']; ?></td>
    <td>R$ <? $parcela1 = $valor/$res_sql['mes']; echo number_format($parcela1,2,",","."); ?></td>
    <td><? echo $taxa_adm = "17"; ?>% - R$
    <? $parcela2 = ($valor*$taxa_adm)/100; echo number_format($parcela2,2,",","."); ?></td>
    <td><? echo $juro_mes = $res_sql['mes']/2; ?>% - R$
      <? $parcela3 = ($valor*$juro_mes)/100; echo number_format($parcela3,2,",","."); ?></td>
    <td><? echo $taxa_juro; ?>% - R$ <? $parcela4 = ($valor*$taxa_juro)/100; echo number_format($parcela4,2,",","."); ?></td>
    <td>R$ <? $parcela5 = ($valor*$juro_mes/100)+($valor*$taxa_juro/100); echo number_format($parcela5,2,",","."); ?></td>
    <td>R$ <? $parcela6 = ($valor+$parcela2+$parcela3+$parcela4+$parcela5)/$res_sql['mes']; echo number_format($parcela6,2,",","."); ?></td>
    <td>R$ <? $valor_total = $parcela6*$res_sql['mes']; echo number_format($valor_total,2,",","."); ?></td>
  </tr>
<? } ?>
</table>
<? }}?>
</div><!-- box_cadastro_de_cliente -->


<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Exemplo: 1.200"});
</script>
</body>
</html>