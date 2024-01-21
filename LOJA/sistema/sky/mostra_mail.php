<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Enviar e-mail</title>
<link href="css/index.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php if(isset($_POST['button'])){
	
$title1_s = $_GET['title1'];
$title2 = $_GET['title2'];
$title3 = $_GET['title3'];
$title4 = $_GET['title4'];
$title5 = $_GET['title5'];
$title6 = $_GET['title6'];
$title7 = $_GET['title7'];
$title8 = $_GET['title8'];
$title9 = $_GET['title9'];

$url1 = $_GET['url1'];
$url2 = $_GET['url2'];
$url3 = $_GET['url3'];
$url4 = $_GET['url4'];
$url5 = $_GET['url5'];
$url6 = $_GET['url6'];
$url7 = $_GET['url7'];
$url8 = $_GET['url8'];
$url9 = $_GET['url9'];

$img1 = $_GET['img1'];
$img2 = $_GET['img2'];
$img3 = $_GET['img3'];
$img4 = $_GET['img4'];
$img5 = $_GET['img5'];
$img6 = $_GET['img6'];
$img7 = $_GET['img7'];
$img8 = $_GET['img8'];
$img9 = $_GET['img9'];

$valor1 = $_GET['valor1'];
$valor2 = $_GET['valor2'];
$valor3 = $_GET['valor3'];
$valor4 = $_GET['valor4'];
$valor5 = $_GET['valor5'];
$valor6 = $_GET['valor6'];
$valor7 = $_GET['valor7'];
$valor8 = $_GET['valor8'];
$valor9 = $_GET['valor9'];

echo "<script language='javascript'>
                      window.location='envio_de_email_em_massa.php?title1=$title1_s&title2=$title2&title3=$title3&title4=$title4&title5=$title5&title6=$title6&title7=$title7&title8=$title8&title9=$title9&url1=$url1&url2=$url2&url3=$url3&url4=$url4&url5=$url5&url6=$url6&url7=$url7&url8=$url8&url9=$url9&img1=$img1&img2=$img2&img3=$img3&img4=$img4&img5=$img5&img6=$img6&img7=$img7&img8=$img8&img9=$img9&valor1=$valor1&valor2=$valor2&valor3=$valor3&valor4=$valor4&valor5=$valor5&valor6=$valor6&valor7=$valor7&valor8=$valor8&valor9=$valor9&id=1';
</script>";

}?>
<div id="box_send_mail">
<form action="" method="post" name="" enctype="multipart/form-data">
<table width="800" background="back.jpg" border="0" align="center">
  <tr>
    <td align="center" width="1437"><img src="logo.png" width="800" height="170"></td>
  </tr>
  <tr>
    <td><img src="email.png" width="800" height="60"></td>
  </tr>
  <tr>
    <td><table width="800" border="0">
      <tr>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title1']; ?></span></h1>
          <br />
          </span>
          </p>
          <a target="_blank" href="<? echo $_GET['url1']; ?>"><img src="<? echo $_GET['img1']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor1']; ?> <br />
            </span> <a href="<? echo $_GET['url1']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a><br />
          </span></td>
        <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title2']; ?></span></h1>
          <br />
          </span>
          </p>
          <a href="<? echo $_GET['url2']; ?>"><img src="<? echo $_GET['img2']; ?>" width="220" height="200" border="0" /></a><span style="font-size: x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor2']; ?> <br />
          </span> <a href="<? echo $_GET['url2']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
        <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title3']; ?></span></h1>
          <br />
          </span>
          </p>
          <a href="<? echo $_GET['url3']; ?>"><img src="<? echo $_GET['img3']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor3']; ?> <br />
          </span> <a href="<? echo $_GET['url3']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
      </tr>
    </table>
      <table width="800" border="0">
        <tr>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title4']; ?></span></h1>
            <br />
            </span>
            </p>
            <a href="<? echo $_GET['url4']; ?>"><img src="<? echo $_GET['img4']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor4']; ?> <br />
              </span> <a href="<? echo $_GET['url4']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a><br />
            </span></td>
          <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"> <? echo $_GET['title5']; ?></span></h1>
            <br />
            </span>
            </p>
            <a href="<? echo $_GET['url5']; ?>"><img src="<? echo $_GET['img5']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor5']; ?> <br />
            </span> <a href="<? echo $_GET['url5']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
          <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title6']; ?></span></h1>
            <br />
            </span>
            </p>
            <a href="<? echo $_GET['url6']; ?>"><img src="<? echo $_GET['img6']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor6']; ?> <br />
            </span> <a href="<? echo $_GET['url6']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="800" border="0">
      <tr>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title7']; ?></span></h1>
          <br />
          </span>
          </p>
          <a href="<? echo $_GET['url7']; ?>"><img src="<? echo $_GET['img7']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor7']; ?> <br />
            </span> <a href="<? echo $_GET['url7']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a><br />
          </span></td>
        <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title8']; ?></span></h1>
          <br />
          </span>
          </p>
          <a href="<? echo $_GET['url8']; ?>"><img src="<? echo $_GET['img8']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor8']; ?> <br />
          </span> <a href="<? echo $_GET['url8']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
        <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1><span style="color: #ff6600; font-size: small;"><? echo $_GET['title9']; ?></span></h1>
          <br />
          </span>
          </p>
          <a href="<? echo $_GET['url9']; ?>"><img src="<? echo $_GET['img9']; ?>" width="220" height="200" border="0" /></a><span style="font-size:  x-large; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ <? echo $_GET['valor9']; ?> <br />
          </span> <a href="<? echo $_GET['url9']; ?>"><img src="btn_comprar.png" width="116" height="31" border="0" /></a></span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><p><a href="http://www.saldaodachina.com.br"><img src="site.png" width="800" height="60" border="0"></a></p></td>
  </tr>
  <tr>
    <td align="center"><input class="input2" type="submit" name="button" id="button" value="Enviar E-mail" />
 </tr>
</table>
</script>
</form>
</div><!-- box_send_mail -->
</body>
</html>