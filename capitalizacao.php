<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/capitalizacao.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>


<div id="box_pagamento_1">
<h1><strong>CAPITALIZAÇÃO VESTE PRIME</strong></h1>
<hr />

<? if($_GET['p'] == ''){ ?>

<?	
$cliente = 0;
	
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
	 if(mysqli_num_rows($sql_carrinho) == ''){
		echo "<script language='javascript'>window.location='carrinho.php';</script>";
	 }else{
		while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			$cliente = $res_carrinho['cliente'];
		}
	  }
	  
	  $sql_clientes = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
	   while($res_clientes = mysqli_fetch_array($sql_clientes)){

?>


<? if(isset($_POST['button'])){

$plano = $_POST['plano'];
$carencia = $_POST['carencia'];
$senha = $_POST['senha'];
$beneficiario = $_POST['beneficiario'];
$grau_parentesco = $_POST['grau_parentesco'];
$valor = $_POST['valor'];
$vencimento = $_POST['vencimento'];
$forma_pagamento = $_POST['forma_pagamento'];
$forma_recebimento = $_POST['forma_recebimento'];
$banco = $_POST['banco'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$conta_bancaria = $_POST['conta_bancaria'];

$code_plano = rand();


$sql_senha = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente' AND senha = '$senha'");
if(mysqli_num_rows($sql_senha) == ''){
 echo "<script language='javascript'>window.alert('SENHA DIGITADA INCORRETAMENTE!');</script>";
}else{

if($forma_pagamento == 'VESTE PRIME CARD'){
$sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND status = 'ATIVO'");
if(mysqli_num_rows($sql_conta_corrente) == ''){
 echo "<script language='javascript'>window.alert('CARTÃO VESTE PRIME CARD NÃO ESTÁ ATIVO, POR ESTE MOTIVO, O CLIENTE NÃO PODE CONTRATAR O TITULO NO CARTÃO. ESCOLHA OUTRA FORMA DE PAGAMENTO!');</script>";
}else{
}
} // FORMA DE PAGAMENTO


$parcelas = 0;

if($plano == 'VAREJO'){
	$parcelas = 12;
}elseif($plano == 'GOLD'){
	$parcelas = 24;
}elseif($plano == 'PLATINUM'){
	$parcelas = 36;
}elseif($plano == 'BLACK'){
	$parcelas = 48;
}elseif($plano == 'MASTERBLACK'){
	$parcelas = 60;
}

$mes_vencimento = $mes+1;

	if($mes_vencimento ==12){
		$mes_vencimento = "1";
		$ano = $ano+1;
	}elseif($mes_vencimento ==24){
		$mes_vencimento = "1";
		$ano = $ano+2;
	}else{
		$mes_vencimento = $mes_vencimento;
		$ano = $ano;
	}
	if($mes_vencimento <10){ $mes_vencimento = "0$mes_vencimento"; }
	$vencimento_completo = "$vencimento/$mes_vencimento/$ano";
	
	$code_vencimento = 0;
	$sqli_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$vencimento_completo'");
	while($res_vencimento = mysqli_fetch_array($sqli_code_vencimento)){
		$code_vencimento = $res_vencimento['codigo'];
	}
	
	
	mysqli_query($conexao_bd, "INSERT INTO parcelas_capitalizacao (code_capitalizacao, n_parcela, cliente, status, vencimento, code_vencimento, valor, operador_pgto, multa, juros, vl_recebido, forma_pagt, dia_pagt, mes_pagt, ano_pagt, data_pagt, data_completa_pagt, mes, ano, code_barras) VALUES ('$code_plano', '1', '$cliente', 'Aguarda', '$vencimento_completo', '$code_vencimento', '$valor', '', '', '', '', '', '', '', '', '', '', '$mes_vencimento', '$ano', '')");

$numero_sorte = rand();

$sql_cadastra = mysqli_query($conexao_bd, "INSERT INTO plano_capitalizao (data, data_completa, dia, mes, ano, ip, status, code, operador, cliente, plano, carencia, beneficiario, grau_parentesco, valor, vencimento, forma_pagamento, forma_recebimento, numero_sorte, banco, tipo_conta, agencia, conta_bancaria) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', 'Aguarda', '$code_plano', '$operador', '$cliente', '$plano', '$carencia', '$beneficiario', '$grau_parentesco', '$valor', '$vencimento', '$forma_pagamento', '$forma_recebimento', '$numero_sorte', '$banco', '$tipo_conta', '$agencia', '$conta_bancaria')");


	$score = 0;
	$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	 while($res_score = mysqli_fetch_array($sql_score)){
		 $score = $res_score['score'];
	 }
	  
	   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'CONTRATO DE CAPITALIZACAO', '$valor')");
     
	  $score = $score+$valor;
	   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");


echo "<script language='javascript'>window.alert('Contratação efetuada com sucesso!');window.location='capitalizacao_titulos.php';</script>";

 }
}?>


<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
  <tr>
    <td width="285" bgcolor="#CCCCCC"><strong>NOME COMPLETO</strong></td>
    <td width="233" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td width="224" bgcolor="#CCCCCC"><strong>RG</strong></td>
    <td width="240" bgcolor="#CCCCCC"><strong>DATA DE NASCIMENTO</strong></td>
  </tr>
  <tr>
    <td><? echo $res_clientes['nome']; ?></td>
    <td><? echo $res_clientes['cpf']; ?></td>
    <td><? echo $res_clientes['rg']; ?></td>
    <td><? echo $res_clientes['nascimento']; ?></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>PLANO DE CAPITALIZAÇÃO</strong></td>
    <td bgcolor="#CCCCCC"><strong>PERÍODO DE CARÊNCIA</strong></td>
    <td bgcolor="#CCCCCC"><strong>BENEFICIÁRIO</strong></td>
    <td bgcolor="#CCCCCC"><strong>GRAU DE PARENTESCO</strong></td>
  </tr>
  <tr>
    <td><label for="valor_plano"></label>
      <select name="plano" size="1" id="plano">
		<option value="PLATINUM">PLATINUM 36 MESES</option>
        <option value="BLACK">BLACK 48 MESES</option>
        <option value="MASTERBLACK">MASTER BLACK 60 MESES</option>
      </select>      
      <label for="valor_plano"></label></td>
    <td><label for="periodo"></label>
      <select name="carencia" size="1" id="periodo">
        <option value="12">12 MESES</option>
      </select></td>
    <td><label for="beneficiario"></label>
    <input name="beneficiario" type="text" id="beneficiario" size="50"></td>
    <td><label for="grau_parentesco"></label>
      <select name="grau_parentesco" size="1" id="grau_parentesco">
        <option value="MAE">MAE</option>
        <option value="PAI">PAI</option>
        <option value="IRMAO">IRMAO</option>
        <option value="FILHO">FILHO</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>VALOR DO PLANO</strong></td>
    <td bgcolor="#CCCCCC"><strong>DATA DE VENCIMENTO</strong></td>
    <td bgcolor="#CCCCCC"><strong>FORMA DE PAGAMENTO</strong></td>
    <td bgcolor="#CCCCCC"><strong>FORMA DE RECEBIMENTO</strong></td>
  </tr>
  <tr>
    <td><select name="valor" size="1">
      <option value="40">R$ 40,00</option>
      <option value="50">R$ 50,00</option>
      <option value="60">R$ 60,00</option>
      <option value="80">R$ 80,00</option>
      <option value="90">R$ 90,00</option>
      <option value="100">R$ 100,00</option>
      <option value="150">R$ 150,00</option>
      <option value="200">R$ 200,00</option>
      <option value="300">R$ 300,00</option>
      <option value="500">R$ 500,00</option>
      <option value="1000">R$ 1.000,00</option>
    </select></td>
    <td><label for="vencimento"></label>
      <select name="vencimento" size="1" id="vencimento">
        <option value="01">01</option>
        <option value="03">03</option>
        <option value="06">06</option>
        <option value="09">09</option>
        <option value="12">12</option>
        <option value="15">15</option>
        <option value="18">18</option>
        <option value="21">21</option>
        <option value="24">24</option>
        <option value="27">27</option>
      </select></td>
    <td><label for="forma_pagamento"></label>
      <select name="forma_pagamento" size="1" id="forma_pagamento">
        <option value="VESTE PRIME CARD">VESTE PRIME CARD</option>
        <option value="BOLETO">BOLETO</option>
        <option value="BOCA DO CAIXA">CAIXA</option>
      </select></td>
    <td><label for="forma_recebimento"></label>
      <select name="forma_recebimento" size="1" id="forma_recebimento">
        <option value="CONTA BANCARIA">CONTA BANCARIA</option>
        <option value="CHEQUE">CHEQUE</option>
        <option value="FOLHA DE PAGAMENTO">FOLHA DE PAGAMENTO</option>
      </select></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC"><strong>BANCO</strong></td>
    <td bgcolor="#CCCCCC"><strong>TIPO DE CONTA</strong></td>
    <td bgcolor="#CCCCCC"><strong>AG&Ecirc;NCIA</strong></td>
    <td bgcolor="#CCCCCC"><strong>CONTA BANC&Aacute;RIA</strong></td>
  </tr>
  <tr>
    <td>
      <select name="banco" size="1" style="width:270px;">
       <?
        $sql_1 = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo != '001'");
			while($res_1 = mysqli_fetch_array($sql_1)){
	   ?>
        <option value="<? echo $res_1['codigo']; ?>"><? echo $res_1['codigo']; ?> - <? echo $res_1['nome_banco']; ?></option>
        <? } ?>
      </select>     
    </td>
    <td><label for="tipo_conta"></label>
      <select name="tipo_conta" size="1" id="tipo_conta">
        <option value="CORRENTE">CORRENTE</option>
        <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
      </select></td>
    <td><label for="agencia"></label>
      <input name="agencia" type="text" id="agencia" size="7" maxlength="4" /></td>
    <td><label for="conta_bancaria"></label>
      <label><input name="conta_bancaria" type="text" id="conta_bancaria" size="15" maxlength="20" /></label></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><hr /></td>
  </tr>
  <tr>
    <td colspan="4" align="center">Digite a senha para confirmar a contratação</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="password" size="3" name="senha" /></td>
  </tr>
  <tr>
    <td colspan="4">
    <hr />
    <p>OBSERVAÇÕES IMPORTANTES</p>
      <ul>
        <li>Informe o cliente que uma vez confirmado a capitalização, não será possível efetuar o cancelamento.</li>
    </ul></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><hr />
<input type="submit" name="button" id="button" value="Confirmar"></td>
    </tr>
</table>
</form>
<? } // clientes ?>
<? } // FIM DA PAGINA ?>

</div><!-- box_pagamento_1 -->
</body>
</html>