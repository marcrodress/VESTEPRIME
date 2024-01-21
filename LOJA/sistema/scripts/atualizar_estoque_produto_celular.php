<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/atualizar_estoque_produto_celular.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "../../conexao.php"; ?>



<? if(isset($_POST['button'])){

$comissao = $_POST['comissao'];
$valor_venda = $_POST['valor'];
$valor_compra = $_POST['compra'];
$estoque_atual = $_POST['estoque'];


mysqli_query($conexao_db, "UPDATE produtos SET estoque = '$estoque_atual', valor_venda = '$valor_venda', valor_compra = '$valor_compra', comissao = '$comissao' WHERE id = '".$_GET['id']."'");

echo "
Informações atualizada com sucesso!<br></br>Pressione F5 para mesclar a operações.
";

die;

}?>



<?
$sql_produto = mysqli_query($conexao_db, "SELECT * FROM produtos WHERE id = '".$_GET['id']."'");
while($res_produto = mysqli_fetch_array($sql_produto)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="600" border="0">
  <tr>
    <td bgcolor="#0099FF" align="center" colspan="4"><? echo $res_produto['titulo']; ?></td>
    </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><strong>VALOR VENDA</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>VALOR DE COMPRA</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>ESTOQUE</strong></td>
    <td align="center" bgcolor="#CCCCCC"><strong>COMISS&Atilde;O</strong></td>
  </tr>
  <tr>
    <td align="center"><label for="valor"></label>
    <input name="valor" type="text" id="valor" size="5" value="<? echo $res_produto['valor_venda']; ?>" /></td>
    <td align="center"><label for="compra"></label>
    <input name="compra" type="text" id="compra" size="5" value="<? echo $res_produto['valor_compra']; ?>" /></td>
    <td align="center"><label for="estoque"></label>
    <input name="estoque" type="text" id="estoque" size="5" value="<? echo $res_produto['estoque']; ?>" /></td>
    <td align="center"><label for="comissao"></label>
    <input name="comissao" type="text" id="comissao" size="5" value="<? echo $res_produto['comissao']; ?>" /></td>
  </tr>
  <tr>
    <td align="center" colspan="4"><hr />      <input type="submit" name="button" id="button" value="ATUALIZAR" /></td>
  </tr>
</table>
</form>
<? } ?>
</body>
</html>