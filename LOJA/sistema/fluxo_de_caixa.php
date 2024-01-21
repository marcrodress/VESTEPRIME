<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fluxo_de_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">

<?


// mysql_query("DELETE FROM fluxo_de_caixa WHERE descricao = 'PAGAMENTO DE CARRINHO'");


/*

mysql_query("UPDATE fluxo_de_caixa SET status = 'Ativo'");




$sql_pagamento_contas = mysql_query("SELECT * FROM pagamento_contas");
while($res_pagamento_contas = mysql_fetch_array($sql_pagamento_contas)){
		
		$id = $res_pagamento_contas['id'];
		$data = $res_pagamento_contas['data'];
		$data_completa = $res_pagamento_contas['data_completa'];
		$d = $res_pagamento_contas['d'];
		$m = $res_pagamento_contas['m'];
		$a = $res_pagamento_contas['a'];
		$ip = $res_pagamento_contas['ip'];
		$operador = $res_pagamento_contas['operador'];
		$status = $res_pagamento_contas['status'];
		$cliente = $res_pagamento_contas['cliente'];
		$forma_pagamento = $res_pagamento_contas['forma_pagamento'];
		$valor = $res_pagamento_contas['valor'];
		$juros = $res_pagamento_contas['juros'];
		$tarifa = $res_pagamento_contas['tarifa'];
		$code_barras = $res_pagamento_contas['code_barras'];
		
		$valor = $valor+$juros;
		
		if($forma_pagamento != 'EASY CARD'){
		
		mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor, tipo, code_carrinho, produto, origem, id_origem, code_transacao) VALUES ('Ativo', '$data', '$data_completa', '$d', '$m', '$a', 'CREDITO', '$cliente', 'PAGAMENTO DE CONTAS', '$forma_pagamento', '$valor', 'ENTRADA', '$code_barras', '15620', 'PAGAMENTO DE CONTAS', '$id', '$code_barras')");
		}
		
		
	} // while pagamento_contas 





$sql_transfere = mysql_query("SELECT * FROM produtos_caixa");


while($res_transfere = mysql_fetch_array($sql_transfere)){
	
	$data = $res_transfere['data'];
	$ip = $res_transfere['ip'];
	$code_carrinho = $res_transfere['code_carrinho'];
	
	$dia1 = $data[0];
	$dia2 = $data[1];

	$mes1 = $data[3];
	$mes2 = $data[4];

	$ano1 = $data[6];
	$ano2 = $data[7];
	$ano3 = $data[8];
	$ano4 = $data[9];
	
	$dia = "$dia1$dia2";
	$mes = "$mes1$mes2";
	$ano = "$ano1$ano2$ano3$ano4";
	
	
	$sql_verifica = mysql_query("UPDATE pagamento_carrinho SET ip = '$ip', dia = '$dia', mes = '$mes', ano = '$ano', data = '$data' WHERE code_carrinho = '$code_carrinho'");
	
 }



$sql_transfere = mysql_query("SELECT * FROM pagamento_carrinho");
	while($res_transfere = mysql_fetch_array($sql_transfere)){
		
		$status = $res_transfere['status'];
		$ip = $res_transfere['ip'];
		$dia = $res_transfere['dia'];
		$mes = $res_transfere['mes'];
		$ano = $res_transfere['ano'];
		$data = $res_transfere['data'];
		$data_completa = $res_transfere['data_completa'];
		$code_carrinho = $res_transfere['code_carrinho'];
		$form_pag = $res_transfere['form_pag'];
		$parcelas = $res_transfere['parcelas'];
		$cartao = $res_transfere['cartao'];
		$valor_total = $res_transfere['valor_total'];
		$valor_fornecido = $res_transfere['valor_fornecido'];
		$valor_parcela = $res_transfere['valor_parcela'];
		$cliente = $res_transfere['cliente'];
		$status_cheque = $res_transfere['status_cheque'];
		$troco = $res_transfere['troco'];
		$id = $res_transfere['id'];
		
		if($form_pag == 'DINHEIRO'){
			$valor_total = $valor_total;
		}else{
			$valor_tota = 0;
		}
		
		if($form_pag != 'EASY CARD'){
		mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, bandeira_cartao, tipo_cartao, valor, tipo, code_carrinho, origem, id_origem) values ('$status', '$data', '$data_completa', '$dia', '$mes', '$ano', 'CREDITO', '$cliente', 'PAGAMENTO DE CARRINHO', '$form_pag', '$cartao', '$cartao', '$valor_total', 'ENTRADA', '$code_carrinho', 'PAGAMENTO_CARRINHO', '$id')");
		} // fecha a verificação de pagamento
		
	}





$sql_retirada = mysql_query("SELECT * FROM retirada_dinheiro");
	while($res_retirada = mysql_fetch_array($sql_retirada)){
		
		 $status = $res_retirada['status'];
		 $data = $res_retirada['data'];
		 $data_completa = $res_retirada['data_completa'];
		 $dia = $res_retirada['dia'];
		 $mes = $res_retirada['mes'];
		 $ano = $res_retirada['ano'];
		 $valor = $res_retirada['valor'];
		 $finalidade = $res_retirada['finalidade'];
		 $descricao = $res_retirada['descricao'];
		 $operador = $res_retirada['operador'];
		 $id_retirada = $res_retirada['id'];
		 
		 mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor, tipo, origem, id_origem) VALUES ('$status', '$data', '$data_completa', '$dia', '$mes', '$ano', 'DEBITO', '$operador', '$descricao', 'DINHEIRO', '$valor', 'SAIDA', 'RETIRADA DE DINHEIRO', '$id_retirada')");
		
		} // fecha o serviço de retirada









$sql_pagamento_fatura = mysql_query("SELECT * FROM pagamento_fatura");
	while($res_pagamento_fatura = mysql_fetch_array($sql_pagamento_fatura)){
		
		$ip = $res_pagamento_fatura['ip'];
		$status = $res_pagamento_fatura['status'];
		$data = $res_pagamento_fatura['data'];
		$data_completa = $res_pagamento_fatura['data_completa'];
		$dia = $res_pagamento_fatura['dia'];
		$mes = $res_pagamento_fatura['mes'];
		$ano = $res_pagamento_fatura['ano'];
		$cliente = $res_pagamento_fatura['cliente'];
		$valor = $res_pagamento_fatura['valor'];
		$forma_pagamento = $res_pagamento_fatura['forma_pagamento'];
		$id_pagamento_fatura = $res_pagamento_fatura['id'];
		
		
		mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, bandeira_cartao, tipo_cartao, valor, tipo, code_carrinho, origem, id_origem) values ('$status', '$data', '$data_completa', '$dia', '$mes', '$ano', 'CREDITO', '$cliente', 'PAGAMENTO DE FATURA', '$forma_pagamento', '$cartao', '$cartao', '$valor', 'ENTRADA', '$code_carrinho', 'PAGAMENTO_FATURA', '$id')");
		
	
	}






$sql_recarga_tv_prepago = mysql_query("SELECT * FROM recarga_tv_prepago");
	while($res_recarga_tv_prepago = mysql_fetch_array($sql_recarga_tv_prepago)){
			$id_recarga_tv_prepago = $res_recarga_tv_prepago['id'];
			$data = $res_recarga_tv_prepago['data'];
			$data_completa = $res_recarga_tv_prepago['data_completa'];
			$d = $res_recarga_tv_prepago['d'];
			$m = $res_recarga_tv_prepago['m'];
			$a = $res_recarga_tv_prepago['a'];
			$ip = $res_recarga_tv_prepago['ip'];
			$operador = $res_recarga_tv_prepago['operador'];
			$cliente = $res_recarga_tv_prepago['cliente'];
			$forma_pagamento = $res_recarga_tv_prepago['forma_pagamento'];
			$valor = $res_recarga_tv_prepago['valor'];
			$tarifa = $res_recarga_tv_prepago['tarifa'];
			$autenticacao = $res_recarga_tv_prepago['autenticacao'];
			$tv = $res_recarga_tv_prepago['tv'];
			$code_cliente = $res_recarga_tv_prepago['code_cliente'];
			$cpf = $res_recarga_tv_prepago['cpf'];
			
			if($forma_pagamento != 'EASY CARD'){

			mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor, tipo, code_carrinho, produto, origem, id_origem, code_transacao) VALUES ('Ativo', '$data', '$data_completa', '$d', '$m', '$a', 'CREDITO', '$cliente', 'RECARGA DE TV PREPAGO', '$forma_pagamento', '$valor', 'ENTRADA', '$autenticacao', '98416', 'RECARGA DE TV PRE-PAGO', '$id_recarga_tv_prepago', '$autenticacao')");
			}
		
	} // recarga_tv_prepago







$sql_recarga_prepago = mysql_query("SELECT * FROM recarga_prepago");
	while($res_recarga_prepago = mysql_fetch_array($sql_recarga_prepago)){
		
		$data = $res_recarga_prepago['data'];
		$data_completa = $res_recarga_prepago['data_completa'];
		$d = $res_recarga_prepago['d'];
		$m = $res_recarga_prepago['m'];
		$a = $res_recarga_prepago['a'];
		$ip = $res_recarga_prepago['ip'];
		$operador = $res_recarga_prepago['operador'];
		$status = $res_recarga_prepago['status'];
		$cliente = $res_recarga_prepago['cliente'];
		$forma_pagamento = $res_recarga_prepago['forma_pagamento'];
		$tarifa = $res_recarga_prepago['tarifa'];
		$autenticacao = $res_recarga_prepago['autenticacao'];
		$operadora = $res_recarga_prepago['operadora'];
		$numero = $res_recarga_prepago['numero'];
		$id = $res_recarga_prepago['id'];
		
			if($forma_pagamento != 'EASY CARD'){
			mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, cliente, descricao, forma_recebimento, valor, tipo, code_carrinho, produto, origem, id_origem, code_transacao) VALUES ('Ativo', '$data', '$data_completa', '$d', '$m', '$a', 'CREDITO', '$cliente', 'RECARGA DE CELULAR PREPAGO', '$forma_pagamento', '$valor', 'ENTRADA', '$autenticacao', '98415', 'RECARGA DE CELULAR PRE-PAGO', '$id', '$autenticacao')");
			 
			}
		
	} // fecha recarga_prepago 

*/


?>






<? if(isset($_POST['button'])){
	

$dia = $_POST['dia'];
$mes = $_POST['mes'];
$ano = $_POST['ano'];

$filtro = 0;

if($dia != 0 && $mes !=0 && $ano != 0){
$filtro = base64_encode("WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano'");
}elseif($mes != 0 && $ano != 0){
$filtro = base64_encode("WHERE mes = '$mes' AND ano = '$ano'");
}elseif($ano != 0){
$filtro = base64_encode("WHERE ano = '$ano'");
}

echo "<script language='javascript'>window.location='?pack=fluxo_de_caixa&filtro=$filtro';</script>";


}?>

<table width="1195" border="0">
  <tr>
    <td><h1><strong>FLUXO DE CAIXA</strong></h1><hr /></td>
    </tr>
  <tr>
    <td><strong>
      <label for="dia">FILTRAR POR DIA</label>
    </strong></td>
    </tr>
  <tr>
    <td height="32">
      <form name="" method="post" action="" enctype="multipart/form-data">
        <select name="dia" size="1" id="dia">
          <option value=""></option>
          <option value="01">1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          <option value="13">13</option>
          <option value="14">14</option>
          <option value="15">15</option>
          <option value="16">16</option>
          <option value="17">17</option>
          <option value="18">18</option>
          <option value="19">19</option>
          <option value="20">20</option>
          <option value="21">21</option>
          <option value="22">22</option>
          <option value="23">23</option>
          <option value="24">24</option>
          <option value="25">25</option>
          <option value="26">26</option>
          <option value="27">27</option>
          <option value="28">28</option>
          <option value="29">29</option>
          <option value="30">30</option>
          <option value="31">31</option>
          </select>
        <label for="mes"></label>
        <select name="mes" size="1" id="mes">
          <option value=""></option>        
          <option value="01">1</option>
          <option value="02">2</option>
          <option value="03">3</option>
          <option value="04">4</option>
          <option value="05">5</option>
          <option value="06">6</option>
          <option value="07">7</option>
          <option value="08">8</option>
          <option value="09">9</option>
          <option value="10">10</option>
          <option value="11">11</option>
          <option value="12">12</option>
          </select>
        <label for="ano"></label>
        <select name="ano" size="1" id="ano">
          <option value="2019">2019</option>
          <option value="2018">2018</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          </select> 
        <label for="select9"></label>
        <input class="input" type="submit" name="button" id="button" value="Enviar">
        </form>
    </td>
    </tr>
  <tr>
    <td height="6"><hr></td>
  </tr>
</table>

<table class="table" width="1187" border="0">
  <tr>
    <td colspan="3" bgcolor="#666666" align="center"><strong>RESUMO DE CAIXA</strong></td>
  </tr>
  <tr>
    <td width="483"><strong>CRÉDITO</strong></td>
    <td width="384"><strong>DÉBITO</strong></td>
    <td width="304"><strong>SALDO</strong></td>
    </tr>
  <tr>
    <td>
    R$ <?
    $entradas = 0;
	$filtro = base64_decode($_GET['filtro']);
	$sql_entradas = mysql_query("SELECT * FROM fluxo_de_caixa $filtro AND tipo_entrada = 'CREDITO'");
		while($res_entradas = mysql_fetch_array($sql_entradas)){
				$entradas = $res_entradas['valor']+$entradas;
			}
				echo number_format($entradas,2, ',', '.');
	?>
    </td>
    <td>
    R$ <?
    $saidas = 0;
	$filtro = base64_decode($_GET['filtro']);	
	$sql_saidas = mysql_query("SELECT * FROM fluxo_de_caixa $filtro AND tipo_entrada = 'DEBITO'");
		while($res_saidas = mysql_fetch_array($sql_saidas)){
				$saidas = $res_saidas['valor']+$saidas;
			}
				echo number_format($saidas,2, ',', '.');
	?>
    </td>
    <td>R$ <? echo number_format($entradas-$saidas,2, ',', '.'); ?></td>
    </tr>
  <tr>
    <td height="19" align="center" colspan="3" bgcolor="#999999"><strong>SALDO TOTAL</strong></td>
    </tr>
  <tr>
    <td><strong>TOTAL DE DINHEIRO RECEBIDO</strong></td>
    <td><strong>DEBITOS REALIZADOS</strong></td>
    <td><strong>DINHEIRO DISPON&Iacute;VEL NO CAIXA</strong></td>
  </tr>
  <tr>
    <td>R$
      <?
    $entradas = 0;
	$sql_entradas = mysql_query("SELECT * FROM fluxo_de_caixa WHERE tipo_entrada = 'CREDITO'");
		while($res_entradas = mysql_fetch_array($sql_entradas)){
				$entradas = $res_entradas['valor']+$entradas;
			}
				echo number_format($entradas,2, ',', '.');
	?></td>
    <td>R$
      <?
    $saidas = 0;
	$sql_saidas = mysql_query("SELECT * FROM fluxo_de_caixa WHERE tipo_entrada = 'DEBITO'");
		while($res_saidas = mysql_fetch_array($sql_saidas)){
				$saidas = $res_saidas['valor']+$saidas;
			}
				echo number_format($saidas,2, ',', '.');
	?></td>
    <td>R$ <? echo number_format($entradas-$saidas,2, ',', '.'); ?></td>
  </tr>
</table>
<hr />
<table class="table" width="1187" border="0">
  <tr>
    <td align="center" colspan="6" bgcolor="#00CC00"><strong>RESUMO DE RECEBIMENTOS COM VENDAS DE PRODUTOS
    </strong>      <hr></td>
  </tr>
  <tr>
    <td width="179"><strong>DINHEIRO</strong></td>
    <td width="239"><strong>Easy CARD</strong></td>
    <td width="278"><strong>CARTÃO DE CRÉDITO</strong></td>
    <td width="207"><strong>CARTÃO DE DÉBITO</strong></td>
    <td width="129"><strong>CHEQUE</strong></td>
    <td width="129"><strong>COMISS&Otilde;ES</strong></td>
  </tr>
  <tr>
    <td>R$
      <?
    $dinheiro = 0;
	$filtro = base64_decode($_GET['filtro']);		
	$sql_dinheiro = mysql_query("SELECT * FROM pagamento_carrinho $filtro AND form_pag = 'DINHEIRO'");
		while($res_dinheiro = mysql_fetch_array($sql_dinheiro)){
				$dinheiro = $res_dinheiro['valor_fornecido']+$dinheiro;
			}
				echo number_format($dinheiro,2, ',', '.');
	?></td>
    <td>R$
      <?
    $easy_card = 0;
	
	$sql_easy_card = mysql_query("SELECT * FROM pagamento_carrinho $filtro AND form_pag = 'EASY CARD'");
		while($res_easy_card = mysql_fetch_array($sql_easy_card)){
				$easy_card = $res_easy_card['valor_total']+$easy_card;
			}
				echo number_format($easy_card,2, ',', '.');
	?></td>
    <td>R$
      <?
    $cartap_credito = 0;
	
	$sql_cartap_credito = mysql_query("SELECT * FROM pagamento_carrinho $filtro AND form_pag = 'CARTÃO DE CRÉDITO'");
		while($res_cartap_credito = mysql_fetch_array($sql_cartap_credito)){
				$cartap_credito = $res_cartap_credito['valor_total']+$cartap_credito;
			}
				echo number_format($cartap_credito,2, ',', '.');
	?></td>
    <td>R$
      <?
    $cartao_debito = 0;
	
	$sql_cartao_debito = mysql_query("SELECT * FROM pagamento_carrinho $filtro AND form_pag = 'CARTÃO DE DÉBITO'");
		while($res_cartao_debito = mysql_fetch_array($sql_cartao_debito)){
				$cartao_debito = $res_cartao_debito['valor_total']+$cartao_debito;
			}
				echo number_format($cartao_debito,2, ',', '.');
	?></td>
    <td>R$
      <?
    $cheque = 0;
	
	$sql_cheque = mysql_query("SELECT * FROM pagamento_carrinho $filtro AND form_pag = 'CHEQUE'");
		while($res_cheque = mysql_fetch_array($sql_cheque)){
				$cheque = $res_cheque['valor_total']+$cheque;
			}
				echo number_format($cheque,2, ',', '.');
	?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
    </tr>
  <tr>
    <td align="center" colspan="6"><strong>TOTAL DE RECEBIMENTOS:</strong> <? echo number_format($dinheiro+$cartao_debito+$cartap_credito+$cheque, 2, ',', '.'); ?></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>



</div><!-- box_cad_produto -->
</body>
</html>