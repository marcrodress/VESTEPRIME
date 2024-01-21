<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<form action="gerar_cupom_sorteio_sessao.php" method="post" enctype="multipart/form-data" name="" target="_self">
<h1 style="font:12px Arial, Helvetica, sans-serif;"><strong>Quant.</strong>
<input style="border-radius:5px; text-align:center; border:1px solid #000;" type="number" name="quant" size="5" value="5" />
<label for="tipo_servico"></label>
<select style="border-radius:5px; width:130px; border:1px solid #000;" name="tipo_servico" size="1" id="tipo_servico">
  <option value="CUPOM AVULSO">CUPOM AVULSO</option>
  <option value="PAGAMENTO DE CONTAS">PAGAMENTO DE CONTAS</option>
  <option value="RECARGA DE CELULAR">RECARGA DE CELULAR</option>
  <option value="COMPRA DE PRODUTOS">COMPRA DE PRODUTOS</option>
  <option value="SAQUE BANCO DO BRASIL">SAQUE BANCO DO BRASIL</option>
  <option value="SAQUE OUTROS BANCOS">SAQUE OUTROS BANCOS</option>
  <option value="PRODUTOS DA LOJA VIRTUAL">PRODUTOS DA LOJA VIRTUAL</option>
</select>
<input type="submit" name="button" id="button" value="Gerar" />
</h1>
</form>
</body>
</html>