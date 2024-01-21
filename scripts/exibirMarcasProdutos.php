<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>

<body>
<? require "../conexao.php"; ?>
<table class="table table-primary table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">MARCA</th>
              <th scope="col">SITUA&Ccedil;&Atilde;O</th>
              </tr>
          </thead>
          <tbody>
          	 <? $i = 0; $codeProduto = $_GET['codeProduto'];
                $sql = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosMarca");
                 while($resMarca = mysqli_fetch_array($sql)){ $i++;
             ?>
            <tr>
              <th scope="row"><? echo $i; ?></th>
              <td><? echo $resMarca['marca']; ?></td>
              <td>
              	
                <?
				 $sqlMarcas = mysqli_query($conexao_bd, "SELECT * FROM categoriaProdutosDiversosProdutosMarcas WHERE codeProduto = '".$_GET['codeProduto']."' AND marcas = '".$resMarca['code']."'");
				 if(mysqli_num_rows($sqlMarcas) >= 1){
				?>
                <a href="?acao2=deleta&codeProduto=<? echo $_GET['codeProduto']; ?>&marca=<? echo $resMarca['code']; ?>"><img src="../img/deleta.jpg" title="Deletar" /></a>
				<? }else{ ?>
                <a href="?acao2=criar&codeProduto=<? echo $_GET['codeProduto']; ?>&marca=<? echo $resMarca['code']; ?>"><img src="../img/correto.png" title="Adicionar" /></a>
                <? } ?>
                
              </td>
            </tr>
			<? } ?>
          </tbody>
        </table>
</body>
</html>
<? if(@$_GET['acao2'] != NULL){ $codeProduto = $_GET['codeProduto'];
	
	if($_GET['acao2'] == 'criar'){
		mysqli_query($conexao_bd, "INSERT INTO categoriaProdutosDiversosProdutosMarcas (codeProduto, marcas) VALUES ('".$_GET['codeProduto']."', '".$_GET['marca']."')");
	}else{
		$sqlMarcas = mysqli_query($conexao_bd, "DELETE FROM categoriaProdutosDiversosProdutosMarcas WHERE codeProduto = '".$_GET['codeProduto']."' AND marcas = '".$_GET['marca']."'");
	}
	
	echo "<script>window.location='?codeProduto=$codeProduto';</script>";

}?>