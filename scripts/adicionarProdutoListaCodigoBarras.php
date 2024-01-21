<?php
require "../config.php";
$codigoProduto = $_POST['codigoProduto'];
mysqli_query($conexao_bd, "INSERT INTO ProdutosListaCodigoBarras (produto, operador) VALUES ('$codigoProduto', '$operador')");

echo "<script>alert('Produto adicionado!');</script>";
?>
