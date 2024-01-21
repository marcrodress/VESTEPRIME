<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produtos_celulares.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>CADASTRO DE MODELOS DE PRODUTOS/SERVI&Ccedil;OS PASSIVOS</strong></h1>
<hr />

<? if(isset($_POST['cadastrarMarca'])){
          
    $imagem = $_POST['imagem'];
    $modelo = strtoupper($_POST['modelo']);
            
    $sql = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosModelos WHERE marca = '".$_GET['marca']."' AND modelo = '$modelo'");
       if(mysqli_num_rows($sql) >= 1){
           echo "<script language='javascript'>window.alert('Modelo já cadastrado!');</script>";
        }else{
            $codeCategoria = rand();
            mysqli_query($conexao_bd, "INSERT INTO categoriaProdutosDiversosModelos (code, marca, modelo, imagem) VALUES ('$codeCategoria', '".$_GET['marca']."', '$modelo', '$imagem')");

           echo "<script language='javascript'>window.alert('Modelo cadastrado com sucesso!');window.location='';</script>";
         }
}?>
<table width="1000" style="margin:3px;" border="0">
 
  
    <tr>
      <td colspan="4" bgcolor="#339999" style="padding:10px;">
          <select name="jumpMenu" style="width:950px; padding:10px; font-size:20px; font-family:Arial, Helvetica, sans-serif; height:50px;" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
            <option>Selecione a categória</option>
             <?
             
                $sql = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosMarca");
                 while($resMarca = mysqli_fetch_array($sql)){
             ?>
            <option value="?marca=<? echo $resMarca['code']; ?>&nomeMarca=<? echo $resMarca['marca']; ?>&imagem=<? echo $resMarca['imagem']; ?>"><? echo $resMarca['marca']; ?></option>
            <? } ?>
          </select>
       </td>
      </tr>
      
  <? if($_GET['marca'] != NULL){ ?>
  <form name="" method="post" enctype="multipart/form-data" action="">
    <tr>
      <td width="135" bgcolor="#339999" style="padding:10px;"><strong>MARCA</strong></td>
      <td width="136" bgcolor="#339999" style="padding:10px;"><strong>MODELO</strong></td>
      <td width="589" align="left" bgcolor="#339966" style="padding:10px;"><strong>IMAGEM</strong></td>
      <td width="120" rowspan="2" bgcolor="#0066CC"><input class="input" type="submit" name="cadastrarMarca" id="button2" value="Cadastrar" /></td>
    </tr>
    <tr>
      <td bgcolor="#FFFFFF"><input name="textfield" value="<? echo $_GET['nomeMarca']; ?>" type="text" disabled="disabled" size="30" /></td>
      <td bgcolor="#FFFFFF"><input name="modelo" type="text" size="30" autofocus="autofocus" /></td>
      <td bgcolor="#FFFFFF"><input name="imagem" type="text" value="<? echo $_GET['imagem']; ?>" size="73" /></td>
      </tr>
  </form>
  <? } ?>
  </table>
 
 
<? if($_GET['marca'] != NULL){ ?>

 <hr />
 <table width="1000" style="margin:3px;" border="0">
    <?
      
	  $sqlMarcas = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosModelos WHERE marca = '".$_GET['marca']."'");
	   while($resMarca = mysqli_fetch_array($sqlMarcas)){
	 
	?>
     <tr>
       <td width="92" rowspan="2" bgcolor="#FFFFFF" style="padding:10px;"><img src="<? echo $resMarca['imagem']; ?>" width="71" height="63" /></td>
       <td width="770" style="padding:10px;" align="left" bgcolor="#339966"><h2><strong><? echo $_GET['nomeMarca']; ?> - <? echo $resMarca['modelo']; ?></strong></h2></td>
       <td width="120" bgcolor="#669900"><strong>C&Oacute;DIGO</strong></td>
     </tr>
     <tr>
       <td bgcolor="#FFFFFF" align="left"><img src="img/deleta.fw.png" width="20" height="20" /></td>
       <td width="120" bgcolor="#669900"><? echo $resMarca['code']; ?></td>
     </tr>
     <tr>
       <td colspan="3" bgcolor="#FFFFFF" style="padding:10px;"><hr /></td>
     </tr>
     <? } ?>
 </table>
 
  <? } ?>
 
 
</div><!-- box_pagamento_1 -->
</body>
</html>