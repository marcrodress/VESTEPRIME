<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_ted.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?
$cliente = 0;
$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		$cliente = $res_cliente['cliente'];
} // fecha busca cliente

if($cliente == 0 && $_GET['p'] != '2'){
	echo "<script language='javascript'>window.location='?p=2';</script>";
}

?>


<div id="box_pagamento_1">
<? if($_GET['p'] == '1'){ ?>
<h1><strong>TRANSFERÊNCIA TED</strong></h1>
<hr />
<?


$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE cpf_remetente = '$cliente'");
if(mysqli_num_rows($sql_verifica) == ''){
	echo "<script language='javascript'>window.location='?p=2';</script>";
}else{
?>
<h2 style="font:15px Arial, Helvetica, sans-serif; margin:50px 0 -40px 350px; color:#666"><strong>Transferências realizadas anteriormente</strong></h2>
<form name="form" id="form">
  <select style="font:10px Arial, Helvetica, sans-serif; margin:45px; width:900px; padding:5px; height:40px; border:1px solid #555; color:#CCC; text-transform:uppercase;" name="jumpMenu" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value="">Selecione a conta</option>
    <option value=""></option>
    <option value="?p=2">ADICIONAR NOVA CONTA</option>
    <option value=""></option>
    
   <? 
   
   	while($res_verifica = mysqli_fetch_array($sql_verifica)){ 
    
	$sql_verifica_conta = mysqli_query($conexao_bd, "SELECT * FROM transferencias_ted_realizadas WHERE cpf_remetente = '".$res_verifica['cpf_remetente']."' AND cpf_beneficiario = '".$res_verifica['cpf_beneficiario']."' AND tipo_conta = '".$res_verifica['tipo_conta']."' AND agencia = '".$res_verifica['agencia']."' AND conta_beneficario = '".$res_verifica['conta_beneficario']."'");
	if(mysqli_num_rows($sql_verifica_conta) == ''){
		mysqli_query($conexao_bd, "INSERT INTO transferencias_ted_realizadas (cpf_remetente, cpf_beneficiario, tipo_conta, agencia, conta_beneficario, id_conta) VALUES ('".$res_verifica['cpf_remetente']."', '".$res_verifica['cpf_beneficiario']."', '".$res_verifica['tipo_conta']."', '".$res_verifica['agencia']."', '".$res_verifica['conta_beneficario']."', '".$res_verifica['id']."')");
	} // IF
  } // while
   ?>
   
   <?
    
	$sql_teds = mysqli_query($conexao_bd, "SELECT * FROM transferencias_ted_realizadas WHERE cpf_remetente = '$cliente'");
	while($res_teds = mysqli_fetch_array($sql_teds)){
	 $sql_resultado_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE id = '".$res_teds['id_conta']."'");
		while($res_resultado = mysqli_fetch_array($sql_resultado_ted)){
   ?>
   
    <option value="?p=2&id=<? echo $res_resultado['id']; ?>"><? echo $res_resultado['nome_beneficiario']; ?> - CPF: <? echo $res_resultado['cpf_beneficiario']; ?> - BANCO: <? echo $res_resultado['banco']; ?> - TIPO DE CONTA: <? echo $res_resultado['tipo_conta']; ?> - AGÊNCIA: <? echo $res_resultado['agencia']; ?> - CONTA: <? echo $res_resultado['conta_beneficario']; ?></option>
    
    <option value=""></option>

    
   <? }} ?>
   
   
   
  </select>
</form>
<? } ?>


<? } ?>


<? if($_GET['p'] == '2'){ ?>
<hr />
<h1><strong>TRANSFERÊNCIA TED</strong></h1>
<? if(isset($_POST['button'])){

$nome_beneficiario = $_POST['nome_beneficiario'];
$cpf_beneficiario = $_POST['cpf_beneficiario'];
$tipo_conta_beneficiario = $_POST['tipo_conta_beneficiario'];
$agencia_beneficiario = $_POST['agencia_beneficiario'];
$conta_beneficiario = $_POST['conta_beneficiario'];
$observacoes = $_POST['observacoes'];
$telefone = $_POST['telefone'];
$banco = $_POST['banco'];

$valor = $_POST['valor'];

$numero_formatado = preg_replace("/[^0-9,.]/", "", $valor);

// Substitui ',' por '.' se necessário
$valor = str_replace(".", "", $numero_formatado);
$valor = str_replace(",", ".", $valor);


$tarifaBase = 9.99;
$tarifa = 0;

if ($valor > 1000) {
    $numIncrementos = ceil(($valor - 1000) / 1000);
    $tarifa = $tarifaBase + ($numIncrementos * 9.99);
} else {
    $tarifa = $tarifaBase;
}


$sql_informa = mysqli_query($conexao_bd, "INSERT INTO transferencia_ted (codeCaixa, turno, status, dia, mes, ano, data, data_completa, ip, operador, nome_remetente, cpf_remetente, nome_beneficiario, cpf_beneficiario, tarifa, tipo_conta, agencia, conta_beneficario, observacoes, valor, telefone_remetente, banco, motivo_cancelamento, operador_cancelamento, comprovante) VALUES ('$codeCaixa', '$turno', 'Aguarda', '$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$operador', '$nome_remetente', '$cpf_remetente', '$nome_beneficiario', '$cpf_beneficiario', '$tarifa', '$tipo_conta_beneficiario', '$agencia_beneficiario', '$conta_beneficiario', '$observacoes', '$valor', '$telefone', '$banco', '', '', '')");



		
		
echo "<script language='javascript'>window.alert('TRANSFERÊNCIA POR TED EMITIDA COM SUCESSO! AGUARDE O RETORNO SOBRE SUA EFETIIVAÇÃO');window.location='?p=';</script>";
  
  
  
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <table class="table table-bordered table-dark" style="border:2px solid #000; border-radius:5px; margin:0 -5px 0 -1px;" width="698" border="0">
  <tr>
    <td colspan="6" align="center" bgcolor="#333333"><h3><strong> INFORME TODOS OS DADOS CORRETAMENTE </strong></h3></td>
  </tr>
  <tr>
    <td width="160" bgcolor="#232323">Banco</td>
    <td width="160" bgcolor="#232323">tipo</td>
    <td width="160" bgcolor="#232323">Conta</td>
    <td width="64" bgcolor="#232323">Ag&ecirc;ncia</td>
    <td colspan="2" bgcolor="#232323"><strong>VALOR</strong></td>
  </tr>
  <tr>
    <?
  
	$cliente = "";
	$nome_cliente = "";
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			$cliente = $res_cliente['cliente'];
	} // fecha busca cliente  
  	
	$sql_nome = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
    	while($res_nome = mysqli_fetch_array($sql_nome)){
			$nome_cliente = $res_nome['nome'];
		}
  
   $nome_beneficiario1 = "";
   $cpf_beneficiario1 = "";
   $tipo_conta1 = "";
   $banco1 = "";
   $agencia1 = "";
   $conta_beneficario1 = "";
   $observacoes1 = "";
   $valor1 = "";
   $telefone_remetente1 = "";
   $sql_zap = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE id = '".$_GET['id']."'");
   if(mysqli_num_rows($sql_zap) == ''){
   }else{
	   while($res_new = mysqli_fetch_array($sql_zap)){
		   $nome_beneficiario1 = $res_new['nome_beneficiario'];
		   $cpf_beneficiario1 = $res_new['cpf_beneficiario'];
		   $tipo_conta1 = $res_new['tipo_conta'];
		   $banco1 = $res_new['banco'];
		   $agencia1 = $res_new['agencia'];
		   $conta_beneficario1 = $res_new['conta_beneficario'];
		   $observacoes1 = $res_new['observacoes'];
		   $valor1 = $res_new['valor'];
		   $telefone_remetente1 = $res_new['telefone_remetente'];
	 }
   }
  ?>
    <td><select style="width:160px; background-color:#333; outline: none; color:#F90; padding:15px; height:50px; text-align:left;" name="banco" size="1" id="select">
      <option value="<? if($banco == ''){ echo $banco1; }else{ echo $banco; }; ?>">
        <? if($banco == ''){ echo $banco1; }else{ echo $banco; }; ?>
        </option>
      <?
      $sql_bancos = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos");
		while($res_banco = mysqli_fetch_array($sql_bancos)){
	  ?>
      <option value="<? echo $res_banco['codigo']; ?> - <? echo $res_banco['nome_banco']; ?> "><? echo $res_banco['codigo']; ?> - <? echo $res_banco['nome_banco']; ?></option>
      <? } ?>
    </select></td>
    <td><select style="width:160px;  background-color:#333; outline: none; color:#F90; padding:15px; height:50px; text-align:left;" name="tipo_conta_beneficiario" size="1" id="tipo_conta_beneficiario">
      <option value="<? if($tipo_conta_beneficiario == ''){ echo $tipo_conta1; }else{ echo $tipo_conta_beneficiario; }; ?>">
        <? if($tipo_conta_beneficiario == ''){ echo $tipo_conta1; }else{ echo $tipo_conta_beneficiario; }; ?>
        </option>
      <option value="CORRENTE">CORRENTE</option>
      <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
    </select></td>
    <td><input style="padding:20px; background-color:#333; outline: none; color:#F90;" name="conta_beneficiario" type="text" oninput="formatarAgencia(this)" id="conta_beneficiario" size="15" value="<? if($conta_beneficiario == ''){ echo $conta_beneficario1; }else{ echo $conta_beneficiario; }; ?>" /></td>
    <td><input style="padding:20px; background-color:#333; outline: none;color:#F90;"name="agencia_beneficiario" type="text"  id="agencia_beneficiario" value="<? if($agencia_beneficiario == ''){ echo $agencia1; }else{ echo $agencia_beneficiario; }; ?>" size="4" maxlength="4" /></td>
    <td colspan="2"><input style="padding: 15px; background-color:#333; color:#F90; font:20px Arial, Helvetica, sans-serif;" name="valor" type="text" id="valor" size="15" /></td>
  </tr>
  <tr>
    <td align="CENTER" bgcolor="#232323"><strong>BENEFICI&Aacute;RIO</strong></td>
    <td align="CENTER" bgcolor="#232323"><strong>CPF/CNPJ</strong></td>
    <td align="CENTER" bgcolor="#232323">TELEFONE </td>
    <td colspan="2" align="CENTER" bgcolor="#232323">observa&ccedil;&otilde;es</td>
    <td width="161" align="center" bgcolor="#FF0000"><strong>tarifa</strong></td>
  </tr>
  <tr>
    <td align="CENTER"><input style="padding:20px; background-color:#333; outline: none;color:#F90;" name="nome_beneficiario" type="text" id="nome_beneficiario" size="20" value="<? if($nome_beneficiario == ''){ echo $nome_beneficiario1; }else{ echo $nome_beneficiario; }; ?>" /></td>
    <td align="left"><input style="padding:20px; background-color:#333; outline: none;color:#F90;" name="cpf_beneficiario" type="text" id="cpfInput" value="<? if($cpf_beneficiario == ''){ echo $cpf_beneficiario1; }else{ echo $cpf_beneficiario; }; ?>" size="20" /></td>
    <td align="CENTER"><input style="padding: 20px; background-color:#333; outline: none; border:0px; color:#F90;" name="telefone" type="text" size="20" oninput="formatarTelefone(this)" value="<?php echo ($telefone == '') ? $telefone_remetente1 : $telefone; ?>" /></td>
    <td colspan="2" align="CENTER"><input name="observacoes" type="text" id="observacoes" style="padding: 20px; outline: none; background-color:#333; color:#F90;" size="18" /></td>
    <td align="center" bgcolor="#FF0000"><input style="padding:20px; background-color:#333; color:#F90; outline: none; text-align:center;" disabled="disabled" type="text" id="tarifaCampo" size="7" /></td>
  </tr><input name="tarifa" type="hidden" id="tarifaCampo" size="7" />
  <tr>
    <td colspan="6" align="center"><input class="botao_avancar2" type="submit" name="button" id="button" value="ENVIAR" /></td>
  </tr>
  </table>
</form>

<script>

        function formatarAgencia(input) {
            // Remove todos os caracteres não numéricos
            let agencia = input.value.replace(/\D/g, '');

            // Remove zeros à esquerda
            agencia = agencia.replace(/^0+/, '');

            // Adiciona o traço no penúltimo número, se houver pelo menos dois números
            if (agencia.length >= 2) {
                agencia = agencia.slice(0, -1) + '-' + agencia.slice(-1);
            }

            // Atualiza o valor no input
            input.value = agencia;
        }

document.addEventListener("DOMContentLoaded", function() {
    const cpfInput = document.getElementById("cpfInput");

    cpfInput.addEventListener("input", function() {
        let inputValue = cpfInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos
        let formattedCPF;

        if (inputValue.length <= 11) {
            formattedCPF = inputValue.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else {
            formattedCPF = inputValue.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
        }

        cpfInput.value = formattedCPF;
    });
});



function formatarTelefone(input) {
  let valorAtual = input.value;

  let numeroApenas = valorAtual.replace(/[^\d]/g, '');

  let numeroFormatado = '';
  if (numeroApenas.length > 0) {
    numeroFormatado += '(' + numeroApenas.substring(0, 2) + ')';
  }
  if (numeroApenas.length > 2) {
    numeroFormatado += ' ' + numeroApenas.substring(2, 7);
  }
  if (numeroApenas.length > 7) {
    numeroFormatado += '.' + numeroApenas.substring(7, 11);
  }

  input.value = numeroFormatado;
}





// Adiciona um ouvinte de evento de entrada (input) ao campo de entrada
	document.getElementById('valor').addEventListener('input', function() {
		var valorFaturaEmCentavos = this.value;
			
		valorFaturaEmCentavos = valorFaturaEmCentavos.replace(/[^0-9]/g, '');
	
		var valorFaturaEmReais = (parseFloat(valorFaturaEmCentavos) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
	
		this.value = valorFaturaEmReais;
		
		var valor = formatarValor(valorFaturaEmReais);
		
		
	
		
	});

function formatarValor(valorFaturaEmReais) {
    
	let valor = valorFaturaEmReais;

    valor = valor.replace('R$', '');
    valor = valor.replace('.', '');
    valor = valor.replace(',', '.');

    

    atualizarTarifa(valor);
}

function atualizarTarifa(valor) {
    let tarifaBase = 9.99;
    let tarifa = 0;
    let valorCampo = valor;

    if (valorCampo > 1000) {
        var numIncrementos = Math.ceil((valorCampo - 1000) / 1000);

        tarifa = tarifaBase + (numIncrementos * 9.99);
    } else {
        tarifa = tarifaBase;
    }
	

	
    var tarifaCampo = document.getElementById("tarifaCampo");
    var tarifaEnvia = document.getElementById("tarifaEnvia");

    tarifaCampo.value = tarifa.toFixed(2);
    tarifaEnvia.value = tarifaEnvia.toFixed(2);
}

</script>



</script>





<? } ?>



<hr />
<strong><strong>OBSERVAÇÕES IMPORTANTES</strong></strong>
<ul>
 <li>A tarifa de transferência é menor para os clientes que tem cadastro conosco. Por tanto, ofereça para que o cliente faça seu cadastro no sistema!</li>
 <li>O prazo para efetivação do TED poderá levar entre 30 minutos a 40 horas.</li>
 <li>Se o TED foi emitido depois de 15 horas, só será efetivado na conta do cliente somente no próximo dia útil.</li>
 <li>Avise ao cliente que o TED emitido pelo usuário, contudo, o destinatário irá identificar que foi emitida por nosso sistema.</li>
</ul>
<hr />

<h4><strong>ÚLTIMAS TRANSFERÊNCIAS EMITIDAS</strong></h4>
<?
$sql_ted = mysqli_query($conexao_bd, "SELECT * FROM transferencia_ted WHERE status != 'Cancelado' AND mes = '$mes' AND ano = '$ano' OR status = 'Aguarda' ORDER BY id DESC");
if(mysqli_num_rows($sql_ted) == ''){
	echo "<em>Não foi encontrado nenhum TED cadastrado!</em>";
}else{
?>
<table class="table-bordered" style="text-align:center; padding:10px;" width="942" border="0">
  <tr>
    <td width="22" bgcolor="#232323"><strong>id</strong></td>
    <td width="95" bgcolor="#232323"><strong>DATA</strong></td>
    <td width="70" bgcolor="#232323"><strong>STATUS</strong></td>
    <td width="154" bgcolor="#232323"><strong>BENEFICI&Aacute;RIO</strong></td>
    <td width="30" bgcolor="#232323"><strong>BANCO</strong></td>
    <td width="28" bgcolor="#232323"><strong>TIPO</strong></td>
    <td width="29" bgcolor="#232323"><strong>AG&Ecirc;NCIA</strong></td>
    <td width="41" bgcolor="#232323"><strong>CONTA</strong></td>
    <td width="57" bgcolor="#232323"><strong>VALOR</strong></td>
    <td width="60" bgcolor="#232323">&nbsp;</td>
  </tr>
  <?   $i = 0; $total = 0;
	while($res_ted = mysqli_fetch_array($sql_ted)){ $i++; ?>
  <tr <? if($res_ted['operador'] == '60425441369'){ echo "bgcolor='#003366'"; }elseif($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#333'"; } ?>>
    <td><? echo $i; ?></td>
    <td><? echo $res_ted['data_completa']; ?></td>
    <td><? echo strtoupper($res_ted['status']); ?></td>
    <td style="font:10px Arial, Helvetica, sans-serif;"><? echo strtoupper($res_ted['nome_beneficiario']); ?></td>
    <td><? 
		
		$banco = strtoupper($res_ted['banco']);
		$bancoNumerico = preg_replace("/[^0-9]/", "", $banco);
		$bancoFormatado = ltrim($bancoNumerico, '0'); // Remove os zeros à esquerda
		
		echo $bancoFormatado;
		
	 ?></td>
    <td><? echo strtoupper($res_ted['tipo_conta']); ?></td>
    <td><? echo strtoupper($res_ted['agencia']); ?></td>
    <td><? echo strtoupper($res_ted['conta_beneficario']); ?></td>
    <td>R$ <? echo number_format($res_ted['valor'], 2, ',', '.'); ?></td>
    <? if(isset($_POST['confirmar'])){
	
$tarifa = 0;
$valor = $_GET['valor'];
$banco_emissor_cartao = $_GET['banco'];
if($banco_emissor_cartao == '001'){
$tarifa = 0;
}else{
$tarifa = $_GET['valor']*0.021;
}
$bandeira = $_GET['bandeira'];
$cliente = $_GET['cliente'];


$sql_saque = mysqli_query($conexao_bd, "INSERT INTO saques (dia, mes, ano, data, data_completa, ip, cliente, operador, valor, banco, bandeira_cartao, tarifa, valor_cobrado) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$cliente', '$operador', '$valor', '$banco_emissor_cartao', '$bandeira', '$tarifa', '$valor_cobrado')");
echo "<script language='javascript'>window.location='?valor=$valor&banco=$banco_emissor_cartao&bandeira=$bandeira&cliente=$cliente&tarifa=$tarifa&p=3';</script>";
}
?>  
    
    
    <td>
    	<script language="javascript">
		function abrePopUps(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=360,height=460');
		}
	</script>
<a onclick="abrePopUps('scripts/comprovante_transferencia_ted.php?id=<? echo $res_ted['id']; ?>');" href="?p="><img title="IMPRIMIR COMPROVANTE DE TRANSFERÊNCIA" src="img/imprimir.png" width="20" height="20" border="0"></a>     
    <? if($res_ted['status'] == 'Aguarda'){ ?>
    <a rel="superbox[iframe][550x205]" href="scripts/cancela_transferencia_ted.php?id=<? echo $res_ted['id']; ?>">
    <img src="img/deleta.fw.png" width="18" height="18" border="0"></a>
    <? } ?>
    <? if($tipo == 'ADM' && $res_ted['status'] == 'Aguarda'){ ?>
     <a rel="superbox[iframe][330x150]" href="scripts/efetivar_ted.php?id=<? echo $res_ted['id']; ?>"><img src="img/correto.fw.png" width="18" height="18" border="0" title="Efetivar" /></a>
    <? } ?>
    <? if($tipo == 'ADM' && $res_ted['status'] == 'Efetivado' && $res_ted['data'] == $data){ ?>
     <a href="?pg=acao&acao=Aguarda&id=<? echo $res_ted['id']; ?>"><img src="img/bloquea.png" width="18" height="18" border="0" title="Desefetivar" /></a>
    <? } ?> 
    <? if($res_ted['status'] == 'Efetivado' && $res_ted['comprovante'] != NULL){ ?>
    <a target="_blank" href="comprovante_ted/<? echo $res_ted['comprovante']; ?>"><img src="img/comprovante.png" width="20" height="20" border="0" title="Emitir comprovante de pagamento" /></a>
    <? } ?>
    </td>
  </tr>
  <? } ?>
</table>

<? } ?>
</div><!-- box_pagamento_1 -->
<? if($_GET['pg'] == 'acao'){
	
$acao = $_GET['acao'];
$id = $_GET['id'];

mysqli_query($conexao_bd, "UPDATE transferencia_ted SET status = '$acao' WHERE id = '$id'");

echo "<script language='javascript'>window.location='fazer_ted.php';</script>";

}?>
</body>
</html>
