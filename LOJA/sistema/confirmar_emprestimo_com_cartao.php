<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_com_cartao.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>
</head>

<body>
<div id="confirma_emprestimo_com_cartao">
<h1>Operação realizada com sucesso</h1>
<?

$cpf = $_POST['cpf'];
$valor_emprestimo = $_POST['valor_emprestimo'];
$q_parcelas = $_POST['q_parcelas'];

$taxa_adm = ($valor_emprestimo*17)/(100);
$juro_mes = $q_parcelas/(2);
$taxa_pacelamento = ($valor_emprestimo*$juro_mes)/(100);
$taxas_de_juro = ($valor_emprestimo*6.5)/(100);
$despesas = $taxa_pacelamento+$taxas_de_juro;

$valor_das_parcelas = ($taxa_adm+$taxa_pacelamento+$taxas_de_juro+$despesas+$valor_emprestimo)/$q_parcelas;

$valor_total = $valor_das_parcelas*$q_parcelas;



$ip = $_SERVER['REMOTE_ADDR'];
$date = date("d/m/Y H:i:s");

	  $sql_3 = mysql_query("SELECT * FROM envio_de_propostas ORDER BY id DESC LIMIT 1");
	   while($res_3 = mysql_fetch_array($sql_3)){
	      
		  $segundos = date("s");
		  $ultima_proposta = $res_3['n_proposta'];
		  $id = $res_3['id'];

		  
		  $nova_proposta = $ultima_proposta+($segundos+$id);
		  
		  $nova_proposta2 =  "$nova_proposta$id";
		  

mysql_query("INSERT INTO envio_de_propostas (ip, date, status, tipo_de_proposta, tipo_de_emprestimo, n_proposta, cpf, valor_solicitado, quantidade_parcelas, valor_parcelas, empresa_de_envio) VALUES ('$ip', '$date', 'Em análise', 'Empréstimo', 'Empréstimo com cartão', '$nova_proposta2', '$cpf', '$valor_emprestimo', '$q_parcelas', '$valor_das_parcelas', 'Paypal')");

mysql_query("INSERT INTO emprestimo_cartao_credito (date, ip, cpf, n_proposta, valor_emprestimo, q_parcelas, taxa_adm, taxa_pacelamento, taxas_de_juro, despesas, valor_parcela, valor_total) VALUES ('$date', '$ip', '$cpf', '$nova_proposta2', '$valor_emprestimo', '$q_parcelas', '$taxa_adm', '$taxa_pacelamento', '$taxas_de_juro', '$despesas', '$valor_das_parcelas', '$valor_total')");
?>


<table width="1180" border="0">
  <tr>
    <td>Transação efetuada com sucesso!!!</td>
  </tr>
  <tr>
    <td><strong>O número da propósta é:</strong> <? echo $nova_proposta2; ?></td>
  </tr>
  <tr>
    <td>Clique na imagem abaixo para ir para fazer o pagamento com o Paypal</td>
  </tr>
  <tr>
    <td><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_blank">
      <input type="hidden" name="cmd" value="_xclick">
      <input name="business" type="hidden" value="9HSM6YNPU9NK6">
      <input type="hidden" name="lc" value="BR">
      <input type="hidden" name="item_name" value="Empréstimo com cartão de crédito propósta nº <? echo $nova_proposta2; ?>">
      <input type="hidden" name="amount" value="<? echo $valor_total; ?>">
      <input type="hidden" name="currency_code" value="BRL">
      <input type="hidden" name="button_subtype" value="services">
      <input type="hidden" name="no_note" value="0">
      <input type="hidden" name="cn" value="Adicionar instruções especiais para o vendedor">
      <input type="hidden" name="no_shipping" value="2">
      <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHosted">
      <input class="input_paypal" class="img" type="image" src="img/pagar_agora.png" height="100" border="0" name="submit" alt="PayPal - A maneira mais fácil e segura de efetuar pagamentos online!">
      <img class="input_paypal" alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
    </form></td>
  </tr>
</table>


<? }?>
</div><!-- confirma_emprestimo_com_cartao -->
</body>
</html>