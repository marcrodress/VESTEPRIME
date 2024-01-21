<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

require "conexao.php";


mysqli_query($conexao_bd, "UPDATE promocao_cupom_gerador SET status = 'Ativo', nome = 'MARIA DE FATIMA CONRADO LIMA', telefone = '', cpf = '83161040325' WHERE nome = '' AND codigo_promocao = '701769639'");

?>

</body>
</html>