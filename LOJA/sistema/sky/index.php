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
<div id="box_send_mail">

<?php if(isset($_POST['button'])){
	
$title1 = $_POST['title1'];
$title2 = $_POST['title2'];
$title3 = $_POST['title3'];
$title4 = $_POST['title4'];
$title5 = $_POST['title5'];
$title6 = $_POST['title6'];
$title7 = $_POST['title7'];
$title8 = $_POST['title8'];
$title9 = $_POST['title9'];

$url1 = $_POST['url1'];
$url2 = $_POST['url2'];
$url3 = $_POST['url3'];
$url4 = $_POST['url4'];
$url5 = $_POST['url5'];
$url6 = $_POST['url6'];
$url7 = $_POST['url7'];
$url8 = $_POST['url8'];
$url9 = $_POST['url9'];

$img1 = $_POST['img1'];
$img2 = $_POST['img2'];
$img3 = $_POST['img3'];
$img4 = $_POST['img4'];
$img5 = $_POST['img5'];
$img6 = $_POST['img6'];
$img7 = $_POST['img7'];
$img8 = $_POST['img8'];
$img9 = $_POST['img9'];

$valor1 = $_POST['valor1'];
$valor2 = $_POST['valor2'];
$valor3 = $_POST['valor3'];
$valor4 = $_POST['valor4'];
$valor5 = $_POST['valor5'];
$valor6 = $_POST['valor6'];
$valor7 = $_POST['valor7'];
$valor8 = $_POST['valor8'];
$valor9 = $_POST['valor9'];

echo "<script language='javascript'>window.location='mostra_mail.php?title1=$title1&title2=$title2&title3=$title3&title4=$title4&title5=$title5&title6=$title6&title7=$title7&title8=$title8&title9=$title9&url1=$url1&url2=$url2&url3=$url3&url4=$url4&url5=$url5&url6=$url6&url7=$url7&url8=$url8&url9=$url9&img1=$img1&img2=$img2&img3=$img3&img4=$img4&img5=$img5&img6=$img6&img7=$img7&img8=$img8&img9=$img9&valor1=$valor1&valor2=$valor2&valor3=$valor3&valor4=$valor4&valor5=$valor5&valor6=$valor6&valor7=$valor7&valor8=$valor8&valor9=$valor9';</script>";

}?>

<form action="" method="post" name="" enctype="multipart/form-data">
<table width="800" background="back.jpg" border="0" align="center">
  <tr>
    <td align="center" width="1437"><img src="logo.png" width="800" height="170"></td>
  </tr>
  <tr>
    <td><img src="email.png" width="800" height="60"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="800" border="0">
      <tr>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1>
          <label for="title1"></label>
          Titulo
          <span id="sprytextfield1">
          <input type="text" name="title1" id="title1" />
          <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
          <p>
            URL
              <span id="sprytextfield4">
              <input type="text" name="url1" id="url1" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
            </span>
            </p>
            <label for="img1"></label>
            IMG
            <span id="sprytextfield7">
            <input type="text" name="img1" id="img2" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
          <p>            <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$ 
            <label for="valor1"></label>
            <span id="sprytextfield10">
            <input class="input" type="text" name="valor1" id="valor2" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span><br />
          </span></p></td>
        <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1>
          <label for="title2"></label>
          Titulo
          <span id="sprytextfield2">
          <input type="text" name="title2" id="title2" />
          <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
          <p> URL
            <span id="sprytextfield5">
            <input type="text" name="url2" id="url2" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
            </span> </p>
          <label for="img1"></label>
IMG
<span id="sprytextfield8">
<input type="text" name="img2" id="img3" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield11">
  <input class="input" type="text" name="valor2" id="valor3" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
<h1><br />
</h1>
        <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
        <td width="220" align="center" bgcolor="#FFFFFF"><h1>
          <label for="title3"></label>
          Titulo
          <span id="sprytextfield3">
          <input type="text" name="title3" id="title3" />
          <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
          <p> URL
            <span id="sprytextfield6">
            <input type="text" name="url3" id="url3" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
            </span> </p>
          <label for="img1"></label>
IMG
<span id="sprytextfield9">
<input type="text" name="img3" id="img4" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield12">
  <input class="input" type="text" name="valor3" id="valor4" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
<h1><br />
</h1>        </tr>
    </table>
      <table width="800" border="0">
        <tr>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title1"></label>
            Titulo
            <span id="sprytextfield13">
            <input type="text" name="title5" id="title4" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield16">
              <input type="text" name="url5" id="url4" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
IMG
<span id="sprytextfield19">
<input type="text" name="img5" id="img5" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield22">
  <input class="input" type="text" name="valor5" id="valor5" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
<h1><span style="color: #ff0000;"><br />
</span></h1></td>
          <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title2"></label>
            Titulo
            <span id="sprytextfield14">
            <input type="text" name="title6" id="title5" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield17">
              <input type="text" name="url6" id="url5" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
IMG
<span id="sprytextfield20">
<input type="text" name="img6" id="img6" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield23">
  <input class="input" type="text" name="valor6" id="valor6" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
            <h1><br />
          </h1></td>
          <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title3"></label>
            Titulo
            <span id="sprytextfield15">
            <input type="text" name="title4" id="title6" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield18">
              <input type="text" name="url4" id="url6" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
IMG
<span id="sprytextfield21">
<input type="text" name="img4" id="img7" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield24">
  <input class="input" type="text" name="valor4" id="valor7" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
            <h1><br />
          </h1></td>
        </tr>
      </table>
      <table width="800" border="0">
        <tr>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title1"></label>
            Titulo
            <span id="sprytextfield25">
            <input type="text" name="title7" id="title7" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield28">
              <input type="text" name="url7" id="url7" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
            IMG
            <span id="sprytextfield31">
            <input type="text" name="img7" id="img8" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
            <p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
              <label for="valor1"></label>
              <span id="sprytextfield34">
              <input class="input" type="text" name="valor7" id="valor8" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
            <h1><span style="color: #ff0000;"><br />
            </span></h1></td>
          <td align="center" width="23"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title2"></label>
            Titulo
            <span id="sprytextfield26">
            <input type="text" name="title8" id="title8" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield29">
              <input type="text" name="url8" id="url8" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
IMG
<span id="sprytextfield32">
<input type="text" name="img8" id="img9" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield35">
  <input class="input" type="text" name="valor8" id="valor9" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
            <h1><br />
          </h1></td>
          <td align="center" width="15"><img src="email.png" alt="" width="5" height="320" /></td>
          <td width="220" align="center" bgcolor="#FFFFFF"><h1>
            <label for="title3"></label>
            Titulo
            <span id="sprytextfield27">
            <input type="text" name="title9" id="title9" />
            <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> </h1>
            <p> URL
              <span id="sprytextfield30">
              <input type="text" name="url9" id="url9" />
              <span class="textfieldRequiredMsg">Um valor é necessário.</span></span> <br />
              </span></p>
            <label for="img1"></label>
IMG
<span id="sprytextfield33">
<input type="text" name="img9" id="img1" />
<span class="textfieldRequiredMsg">Um valor é necessário.</span></span>
</p>
<p> <span style="font-size: x-small; color: #0000ff;"><span style="font-size: large; color: #000000;">Apenas</span> <span style="color: #ff0000;">R$
  <label for="valor1"></label>
  <span id="sprytextfield36">
  <input class="input" type="text" name="valor9" id="valor1" />
  <span class="textfieldRequiredMsg">Um valor é necessário.</span></span></span></p>
            <h1><br />
          </h1></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td><p><a href="http://www.saldaodachina.com.br"><img src="site.png" width="800" height="60" border="0"></a></p></td>
  </tr>
  <tr>
    <td align="center"><p>
      <input class="input2" type="submit" name="button" id="button" value="Avan&ccedil;ar" />
    </p></td>
  </tr>
  </table>
</form>
</div><!-- box_send_mail -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "none");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10");
var sprytextfield11 = new Spry.Widget.ValidationTextField("sprytextfield11");
var sprytextfield12 = new Spry.Widget.ValidationTextField("sprytextfield12");
var sprytextfield13 = new Spry.Widget.ValidationTextField("sprytextfield13");
var sprytextfield14 = new Spry.Widget.ValidationTextField("sprytextfield14");
var sprytextfield15 = new Spry.Widget.ValidationTextField("sprytextfield15");
var sprytextfield16 = new Spry.Widget.ValidationTextField("sprytextfield16");
var sprytextfield17 = new Spry.Widget.ValidationTextField("sprytextfield17");
var sprytextfield18 = new Spry.Widget.ValidationTextField("sprytextfield18");
var sprytextfield19 = new Spry.Widget.ValidationTextField("sprytextfield19");
var sprytextfield20 = new Spry.Widget.ValidationTextField("sprytextfield20");
var sprytextfield21 = new Spry.Widget.ValidationTextField("sprytextfield21");
var sprytextfield22 = new Spry.Widget.ValidationTextField("sprytextfield22");
var sprytextfield23 = new Spry.Widget.ValidationTextField("sprytextfield23");
var sprytextfield24 = new Spry.Widget.ValidationTextField("sprytextfield24");
var sprytextfield25 = new Spry.Widget.ValidationTextField("sprytextfield25");
var sprytextfield26 = new Spry.Widget.ValidationTextField("sprytextfield26");
var sprytextfield27 = new Spry.Widget.ValidationTextField("sprytextfield27");
var sprytextfield28 = new Spry.Widget.ValidationTextField("sprytextfield28");
var sprytextfield29 = new Spry.Widget.ValidationTextField("sprytextfield29");
var sprytextfield30 = new Spry.Widget.ValidationTextField("sprytextfield30");
var sprytextfield31 = new Spry.Widget.ValidationTextField("sprytextfield31");
var sprytextfield32 = new Spry.Widget.ValidationTextField("sprytextfield32");
var sprytextfield33 = new Spry.Widget.ValidationTextField("sprytextfield33");
var sprytextfield34 = new Spry.Widget.ValidationTextField("sprytextfield34");
var sprytextfield35 = new Spry.Widget.ValidationTextField("sprytextfield35");
var sprytextfield36 = new Spry.Widget.ValidationTextField("sprytextfield36");
</script>
</body>
</html>