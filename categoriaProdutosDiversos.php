<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produtos_celulares.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<div id="box_pagamento_1">
<h1><strong>CADASTRO DE MARCAS DE PRODUTOS/SERVI&Ccedil;OS PASSIVOS</strong></h1>
<hr />

<? if(isset($_POST['cadastrarMarca'])){
          
    $imagem = $_POST['imagem'];
    $marca = strtoupper($_POST['marca']);
            
    $sql = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosMarca WHERE marca = '$marca'");
       if(mysqli_num_rows($sql) >= 1){
           echo "<script language='javascript'>window.alert('Nome marca já cadastrada!');</script>";
        }else{
            $codeCategoria = rand();
            mysqli_query($conexao_bd, "INSERT INTO categoriaProdutosDiversosMarca (code, imagem, marca) VALUES ('$codeCategoria', '$imagem', '$marca')");

           echo "<script language='javascript'>window.alert('Marca cadastrado com sucesso!');window.location='';</script>";
         }
}?>
<table width="1000" style="margin:3px;" border="0">
 
  <form name="" method="post" enctype="multipart/form-data" action="">
    <tr>
      <td width="273" style="padding:10px;" bgcolor="#339999"><strong>NOME DA MARCA</strong></td>
      <td width="589" style="padding:10px;" align="left" bgcolor="#339966"><strong> IMAGEM</strong></td>
      <td width="120" rowspan="2" bgcolor="#0066CC"><input class="input" type="submit" name="cadastrarMarca" id="button2" value="Cadastrar" /></td>
      </tr>
    <tr>
      <td bgcolor="#FFFFFF"><input name="marca" type="text" id="marca" size="50" /></td>
      <td bgcolor="#FFFFFF"><input name="imagem" type="text" id="imagem" size="90" /></td>
      </tr>
  </form>
  </table>
 
 <hr />
 <table width="1000" style="margin:3px;" border="0">
    <?
      
	  $sqlMarcas = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosMarca");
	   while($resMarca = mysqli_fetch_array($sqlMarcas)){
	 
	?>
     <tr>
       <td width="92" rowspan="2" bgcolor="#FFFFFF" style="padding:10px;"><img src="<? echo $resMarca['imagem']; ?>" width="71" height="63" /></td>
       <td width="770" style="padding:10px;" align="left" bgcolor="#339966"><h2><strong><? echo $resMarca['marca']; ?></strong></h2></td>
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
 
 
 
 
</div><!-- box_pagamento_1 -->
</body>
</html>