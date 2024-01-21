<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>

<body>
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;">Lista de produtos</h1>
<?
require "../conexao.php";
 $sql_produtos_em_estoque = mysqli_query($conexao_bd, "SELECT * FROM produtos");
	while($res_produtos_e_servicos = mysqli_fetch_array($sql_produtos_em_estoque)){
		
			
			
?>
<table class="table" width="800" border="0" style="border-radius:3px; border:1px solid #000; margin:0 0 3px 0;">
  <tr>
    <td width="97" rowspan="2"><img src='<? echo $res_produtos_e_servicos['foto']; ?>' width="60" height="60" /></td>
    <td colspan="6" bgcolor="#FFECF5"><? echo $res_produtos_e_servicos['titulo']; ?>  - 
    
    	<a href="?p=deleta&code=<?php echo $res_produtos_e_servicos['id']; ?>" target="_blank"><img src="../img/deleta.jpg" width="20" height="20" title="Excluir produto" /></a>
        <a target="_blank"  href="../cadastrar_produto.php?p=informacoes_produto&code_produto=<? echo $res_produtos_e_servicos['code']; ?>"><img src="../img/cadastro.jpg" width="20" height="20" title="Editar informações do produto" /></a>
    </td>
  </tr>
  <tr>
    <td width="109">Estoque: <? echo $res_produtos_e_servicos['estoque']; ?></td>
    <td width="147">Valor de compra: <? echo number_format($res_produtos_e_servicos['valor_compra'],2,',','.'); ?></td>
    <td width="126">Valor venda: <? echo number_format($res_produtos_e_servicos['valor_venda'],2,',','.'); ?> </td>
    <td width="70">TIPO:  <? echo $res_produtos_e_servicos['tipo']; ?> </td>
    <td width="158">SUBTIPO: <? echo $res_produtos_e_servicos['subTipo']; ?></td>
    <td width="61">
    </td>
  </tr>
</table>
<? } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

<script>

	function deleta(code){
		alert('Tem certeza?');
		window.location=''+code;
			
	}

</script>

<? if($_GET['p'] == 'deleta'){

	mysqli_query($conexao_bd, "DELETE FROM produtos WHERE id = '".$_GET['code']."'");
	
	echo "<script>window.close();</script>";


}?>
</body>
</html>