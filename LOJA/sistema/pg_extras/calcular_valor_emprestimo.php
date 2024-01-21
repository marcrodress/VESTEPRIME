<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/calcular_valor_emprestimo.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<div id="box">
<?
$id = $_GET['id'];

$sql_1 = mysql_query("SELECT * FROM lista_inss WHERE id = '$id'");
 while($res = mysql_fetch_array($sql_1)){
?>
  <table border="0">
    <tr>
      <td width="134"><strong>N&ordm; do beneficio:</strong></td>
      <td width="147"><strong>Data de nascimento:</strong></td>
      <td width="264"><strong>Nome completo:</strong></td>
      <td width="162"><strong>CPF:</strong></td>
      <td width="173"><strong>Valor do beneficio:</strong></td>
      <td width="94">&nbsp;</td>
    </tr>
    <tr>
    <td><? echo $res['n_beneficio']; ?></td>
    <td><? echo $res['dt_nasc']; ?></td>
    <td><? echo $res['nome']; ?></td>
    <td><? echo $res['cpf']; ?></td>
    <td><? echo @number_format($res['vl_atual_benef'],2,",","."); ?></td>
    </tr>
  </table>
  <hr />
  <p>Calular valor total disponivel</p>
  <p>
  <form name="button" method="post" action="" enctype="multipart/form-data">
    <input name="vl_beneficio" type="text" id="textfield" size="29" value="<? echo $res['vl_atual_benef'] ; ?>" />
    <input class="input" type="submit" name="button" id="button" value="Calcular" />
  </form>
  
  <? if(isset($_POST['button'])){

  $vl_beneficio = $_POST['vl_beneficio']*30/100;
  
  $vl_m = $vl_beneficio*60/1.85;
  
  ?>
  <p></p>
  <ul>
   <li>Valor máximo de desconto:<strong> R$ <? echo number_format($vl_beneficio,2,",","."); ?></strong></li>
   <li>Valor máximo de empréstimo:<strong> R$ <? echo number_format($vl_m,2,",","."); ?></strong></li>
   <li>Divisão máxima do empréstimo:<strong> 60X R$ <? echo number_format($vl_beneficio,2,",","."); ?> = <? echo number_format($vl_m*2,2,",","."); ?></strong></li>
  </ul>
  <? }?>
  
  </p>
  <hr />
  <p>Calcular valor total disponivel com os descontos</p>
  <p>
  <form name="button" method="post" action="" enctype="multipart/form-data">
    <strong>Valor do ben&eacute;ficio:</strong>
    <input name="vl_beneficio" type="text" id="textfield2" size="20" value="<? echo $res['vl_atual_benef'] ; ?>" />
    <strong>Valor dos descontos</strong>:
    <input name="vl_desconto" type="text" id="textfield3" size="20" />
    <input class="input" type="submit" name="button2" id="button2" value="Calcular" />
  </form>
  
  <? if(isset($_POST['button2'])){

  $vl_desconto = $_POST['vl_desconto'];
  $vl_beneficio = $_POST['vl_beneficio']*30/100-$vl_desconto;
  
  $vl_m = $vl_beneficio*60/1.85;
  
  ?>
  <p></p>
  <ul>
   <li>Valor total de descontos:<strong> R$ <? echo @number_format($vl_desconto,2,",","."); ?></strong></li>
   <li>Valor disponivel:<strong> R$ <? echo number_format($vl_beneficio,2,",","."); ?></strong></li>
   <li>Valor máximo de empréstimo:<strong> R$ <? echo number_format($vl_m,2,",","."); ?></strong></li>
   <li>Divisão máxima do empréstimo:<strong> 60X R$ <? echo number_format($vl_beneficio,2,",","."); ?> = <? echo number_format($vl_m*2,2,",","."); ?></strong></li>
  </ul>
  <p>
    <? }?>
  </p>
  </p>
  <hr />
  <p>Calcular empr&eacute;stimo conforme o cliente deseje</p>
  <form name="" method="post" action="" enctype="multipart/form-data">
   <strong>Valor beneficio:</strong><input name="vl_bene" type="text" size="25" value="<? echo $res['vl_atual_benef'] ; ?>" /><strong>Valor solicitado: </strong><input name="vl_sol" type="text" size="26" />
    <input class="input" type="submit" name="button3" id="button4" value="Calcular" />
  </form>
 
    <? if(isset($_POST['button3'])){

	 $vl_bene = $_POST['vl_bene']*30/100;
	 $vl_sol = $_POST['vl_sol'];

	 $taxa_juro = "1.41";

	 $sql_1 = mysql_query("SELECT * FROM simulador_meses ORDER BY id DESC");
	?>
    <p></p>
    Valor máximo que pode ser descontado: <? echo number_format($vl_bene,2,",","."); ?>
    <p></p>
  <div id="box_calculado">
  <? while($res_1 = mysql_fetch_array($sql_1)){?>
    <ul>
     <li>Valor solicitado: <? echo number_format($vl_sol,2,",","."); ?> -  Qº parcelas: <? echo $res_1['mes']; ?> - Valor das parcelas: <? $vl_sol1 = $vl_sol/$res_1['mes']; $parcela = $vl_sol*$taxa_juro/100+$vl_sol1; echo number_format($parcela,2,",","."); ?></li>
    </ul>
	<? }}?>
  </div><!-- box_calculado -->    
</div><!-- box -->

<? } ?>

</body>
</html>