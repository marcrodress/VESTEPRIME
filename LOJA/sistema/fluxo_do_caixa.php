<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fluxo_do_caixa.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<h1><strong>RELATÓRIO DE CAIXA</strong></h1>
<hr />
<table width="1195" border="0">
  <tr>
    <td><strong>
      <label for="dia">ESCOLHA O FILTRO</label>
    </strong></td>
  </tr>
  <tr>
    <td height="32"><form name="" method="post" action="" enctype="multipart/form-data">
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
      <select name="ano2" size="1" id="ano2">
        <option value="TODOS">TODOS</option>
        <option value="CREDITO">CREDITOS</option>
        <option value="DEBITO">DEBITOS</option>
      </select>
<label for="select9"></label>
      <input class="input" type="submit" name="button" id="button" value="Enviar" />
    </form></td>
  </tr>
  <tr>
    <td height="6"><hr /></td>
  </tr>
</table>

<hr />
<table width="1190" border="0">
  <tr>
    <td width="42" bgcolor="#CCCCCC"><strong>DATA</strong></td>
    <td width="58" bgcolor="#CCCCCC"><strong>STATUS</strong></td>
    <td width="35" bgcolor="#CCCCCC"><strong>TIPO</strong></td>
    <td width="166" bgcolor="#CCCCCC"><strong>CLIENTE</strong></td>
    <td width="98" bgcolor="#CCCCCC"><strong>PAGAMENTO</strong></td>
    <td width="288" bgcolor="#CCCCCC"><strong>DESCRIÇÃO</strong></td>
    <td width="132" bgcolor="#CCCCCC"><strong>CODE CARRINHO</strong></td>
    <td width="87" bgcolor="#CCCCCC"><strong>VALOR</strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>PRODUTO</strong></td>
    <td width="144" bgcolor="#CCCCCC"><strong>CODE TRASAÇÃO</strong></td>
  </tr>
<? 
$credito = 0;
$debitos = 0;

$sql_fluxo_caixa = mysql_query("SELECT * FROM fluxo_de_caixa");
$i = 0; while($res_fluxo = mysql_fetch_array($sql_fluxo_caixa)){  $i++; 
	
	if($res_fluxo['tipo_entrada'] == 'CREDITO'){
		$credito = $credito+$res_fluxo['valor'];
	}else{
		$debitos = $debitos+$res_fluxo['valor'];
	}

?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_fluxo['data']; ?></td>
    <td><? echo $res_fluxo['status']; ?></td>
    <td><? echo $res_fluxo['tipo_entrada']; ?></td>
    <td><? echo $res_fluxo['cliente']; ?></td>
    <td><? echo $res_fluxo['forma_recebimento']; ?></td>
    <td><? echo $res_fluxo['descricao']; ?></td>
    <td><? echo $res_fluxo['code_carrinho']; ?></td>
    <td><? echo number_format($res_fluxo['valor'], 2, ',', '.'); ?></td>
    <td><? echo $res_fluxo['produto']; ?></td>
    <td><? echo $res_fluxo['code_transacao']; ?></td>
  </tr>
<? } ?>  
  <tr>
    <td colspan="10"><hr /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong>SALDO:</strong></td>
    <td><? echo number_format($credito-$debitos, 2, ',', '.'); ?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</div><!-- box_cad_produto -->
</body>
</html>