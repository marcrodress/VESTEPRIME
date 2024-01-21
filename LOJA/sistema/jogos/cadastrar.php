<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar.css" rel="stylesheet" type="text/css" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<? require "../../conexao.php"; ?>
</head>

<body>
<div id="box">
<? if(@$_GET['p'] == ''){ ?>
<? if(isset($_POST['go'])){
	
$serie = $_POST['serie'];

echo "<script language='javascript'>window.location='?p=2&serie=$serie';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<strong>Selecione a série do jogo</strong><br />
<select name="serie" size="1" id="select">
  <option value="A">S&Eacute;RIE A </option>
  <option value="B">S&Eacute;RIE B</option>
</select>
<input class="input" type="submit" name="go" value="Avançar" />
</form>
<? } // select a serie A ?>


<? if(@$_GET['p'] == '2'){ ?>
<? if(isset($_POST['button'])){
	
$data_jogo = $_POST['data'];
$hora = $_POST['hora'];
$serie = $_GET['serie'];
$time1 = $_POST['time1'];
$time2 = $_POST['time2'];
$code_jogo = 0;

$mes = $_POST['mes'];

$busca_partida = mysql_query("SELECT * FROM partida ORDER BY id DESC LIMIT 1");
while($res_partida = mysql_fetch_array($busca_partida)){
	$code_jogo = $res_partida['code']+52;
}


if($time1 == $time2){
echo "<script language='javascript'>window.alert('O time 1 não pode ser igual o time 2');</script>";
}else{
	
	$cadastrar = mysql_query("INSERT INTO partida (status, serie, code, data, mes, ano, hora, time1, time2) VALUES ('Ativo', '$serie', '$code_jogo', '$data_jogo', '$mes', '$ano', '$hora', '$time1', '$time2')");
	
	echo "
	
	<strong>Jogo cadastrado com sucesso!<br><br></strong>
	 Pressione F5 para mesclar a operação.
	";
die;

}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="500" border="0">
  <tr>
    <td width="60" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td width="33" bgcolor="#CCCCCC"><strong>HORA</strong></td>
    <td width="33" bgcolor="#CCCCCC"><strong>SÉRIE</strong></td>
    <td width="100" bgcolor="#CCCCCC"><strong>TIME 1</strong></td>
    <td bgcolor="#CCCCCC"><strong>TIME 2</strong></td>
    <td bgcolor="#CCCCCC"><strong>M&Ecirc;S</strong></td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="data"></label>
      <span id="sprytextfield1">
      <input name="data" type="text" id="data" value="<? echo date("d/m/Y"); ?>" size="10" />
      <span class="textfieldRequiredMsg">A value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    <td><label for="hora"></label>
      <span id="sprytextfield2">
      <input name="hora" type="text" id="hora" size="5" />
      <span class="textfieldRequiredMsg">A value is required.</span></span></td>
    <td><label for="textfield3"></label>
    <input name="textfield3" type="text" disabled value="<? echo strtoupper($_GET['serie']); ?>" size="2"></td>
    <td>
      <select name="time1" size="1" id="time1">
        <?
        $select_time1 = mysql_query("SELECT * FROM time");
	   	while($res_time1 = mysql_fetch_array($select_time1)){
	  	?>
        <option value="<? echo $res_time1['id']; ?>"><? echo $res_time1['time']; ?></option>
        <? } ?>
      </select>
      </td>
    <td width="89">
      <select name="time2" size="1" id="time1">
        <?
        $select_time1 = mysql_query("SELECT * FROM time");
	   	while($res_time1 = mysql_fetch_array($select_time1)){
	  	?>
        <option value="<? echo $res_time1['id']; ?>"><? echo $res_time1['time']; ?></option>
        <? } ?>
      </select>    
    </td>
    <td width="91">
    <select name="mes" size="1" id="select">
      <option value="JANEIRO">JANEIRO</option>
      <option value="FEVEREIRO">FEVEREIRO</option>
      <option value="MARÇO">MARÇO</option>
      <option value="ABRIL">ABRIL</option>
      <option value="MAIO">MAIO</option>
      <option value="JUNHO">JUNHO</option>
      <option value="JULHO">JULHO</option>
      <option value="AGOSTO">AGOSTO</option>
      <option value="SETEMBRO">SETEMBRO</option>
      <option value="OUTUBRO">OUTUBRO</option>
      <option value="NOVEMBRO">NOVEMBRO</option>
      <option value="DEZEMBRO">DEZEMBRO</option>
    </select>    
    </td>
    <td width="66"><input class="input" type="submit" name="button" id="button" value="CAD"></td>
  </tr>
</table>
</form>
<? } // select a serie A ?>



</div><!-- box -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
</script>
</body>
</html>