<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fazer_pagamento.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; require "scripts/verificador_caixa.php"; ?>


<div id="box_pagamento_1">


<?


$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE operador = '$operador' AND status != 'CANCELADO' ORDER BY id DESC LIMIT 1");
  while($res_boleto = mysqli_fetch_array($sql_boleto)){
	$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE operador = '$operador' AND code_boleto = '".$res_boleto['code_boleto']."' ORDER BY id DESC LIMIT 1");
	  if(mysqli_num_rows($sql_pagamentos) <= 0 && mysqli_num_rows($sql_verifica_conjunto) <= 0 && $_GET['p'] == ''){
		  echo "<script language='javascript'>window.alert('Existem boletos pendentes de informação de pagamento!');window.location='boletos_processando.php?p=';</script>";
	  }
	  
 }


?>




<? if($_GET['p'] == '' && $_GET['acao2'] == ''){ ?>
<hr />
<h1><strong>INFORME ABAIXO O CÓDIGO DE BARRAS</strong></h1>
<input id="numericInput" style="
    font: 30px Arial, Helvetica, sans-serif;
            margin: 10px;
            width: 990px;
            background: #000;
            padding: 20px;
            color: #F90;
            border: 1px solid #000;
" type="text" placeholder="Informe aqui o código de barras" autofocus="autofocus"/>



  <script>

			  
  
  
        // Função para verificar e redirecionar
        function verificarEredirecionar() {
            // Obter o valor do input
            var codigoInput = document.getElementById("numericInput").value;

            // Contar apenas os algarismos numéricos
            var algarismosNumericos = codigoInput.replace(/\D/g, '');

            // Verificar se atingiu 48 números
            if (algarismosNumericos.length >= 47) {
                // Verificar se o primeiro número começa com 8
                if (algarismosNumericos.charAt(0) == '8' && algarismosNumericos.length == 48) {
			
                    var url = "pagamento_contas/verifica_convenio.php?codigoBarras=" +  algarismosNumericos;
                    window.location.href = url;
                
				} else if (algarismosNumericos.charAt(0) != '8' && algarismosNumericos.length == 47) {
   
                    var url = "pagamento_contas/verifica_boleto.php?codigoBarras=" + algarismosNumericos;
                    window.location.href = url;
                }
            }
        }

        // Adicionar um listener para o evento de input no campo
        document.getElementById("numericInput").addEventListener("input", verificarEredirecionar);
    </script>



<?
$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
if(mysqli_num_rows($sql_verifica_conjunto) == ''){
}else{
?>
<br /><br /><br /><br />
<h1 style='font:20px Arial; text-align:center; color:red; margin:50px 0 0 30px;'><strong>Atenção: Você está preenchendo um conjunto de títulos de pagamento</strong>
<br /><br />
<a href="fazer_pagamento_conjunto.php?code_conjunto=<?
 while($res_pagamentos = mysqli_fetch_array($sql_verifica_conjunto)){
	 echo $res_pagamentos['code_conjunto'];
}
?>" style="border:1px solid #09F; padding:5px; text-decoration:none; color: #FF0; background:#06C;"><strong>Titulos</strong></a></h1>
<img style="margin:50px 0 0 450px;" src='img/boleto_conjunto.png' width="120" height="80">
<? } ?>




<? }// pagamentos 1 ?>







<? if($_GET['tipo'] == 'CONVENIO' && $_GET['p'] == '2'){  
$codigo_barras = $_GET['codigoBarras'];
$codigo1 = $codigo_barras[0];
$codigo2 = $codigo_barras[1];
$codigo3 = $codigo_barras[2];
$codigo4 = $codigo_barras[3];
$codigo5 = $codigo_barras[4];
$codigo6 = $codigo_barras[5];
$codigo7 = $codigo_barras[6];
$codigo8 = $codigo_barras[7];
$codigo9 = $codigo_barras[8];
$codigo10 = $codigo_barras[9];
$codigo11 = $codigo_barras[10];
$codigo12 = $codigo_barras[11];
$codigo13 = $codigo_barras[12];
$codigo14 = $codigo_barras[13];
$codigo15 = $codigo_barras[14];
$codigo16 = $codigo_barras[15];
$codigo17 = $codigo_barras[16];
$codigo18 = $codigo_barras[17];
$codigo19 = $codigo_barras[18];
$codigo20 = $codigo_barras[19];
$codigo21 = $codigo_barras[20];
$codigo22 = $codigo_barras[21];
$codigo23 = $codigo_barras[22];
$codigo24 = $codigo_barras[23];
$codigo25 = $codigo_barras[24];
$codigo26 = $codigo_barras[25];
$codigo27 = $codigo_barras[26];
$codigo28 = $codigo_barras[27];
$codigo29 = $codigo_barras[28];
$codigo30 = $codigo_barras[29];
$codigo31 = $codigo_barras[30];
$codigo32 = $codigo_barras[31];
$codigo33 = $codigo_barras[32];
$codigo34 = $codigo_barras[33];
$codigo35 = $codigo_barras[34];
$codigo36 = $codigo_barras[35];
$codigo37 = $codigo_barras[36];
$codigo38 = $codigo_barras[37];
$codigo39 = $codigo_barras[38];
$codigo40 = $codigo_barras[39];
$codigo41 = $codigo_barras[40];
$codigo42 = $codigo_barras[41];
$codigo43 = $codigo_barras[42];
$codigo44 = $codigo_barras[43];
$codigo45 = $codigo_barras[44];
$codigo46 = $codigo_barras[45];
$codigo47 = $codigo_barras[46];
$codigo48 = $codigo_barras[47];

$codigo_barras = "$codigo1$codigo2$codigo3$codigo4$codigo5$codigo6$codigo7$codigo8$codigo9$codigo10$codigo11-$codigo12 $codigo13$codigo14$codigo15$codigo16$codigo17$codigo18$codigo19$codigo20$codigo21$codigo22$codigo23-$codigo24 $codigo25$codigo26$codigo27$codigo28$codigo29$codigo30$codigo31$codigo32$codigo33$codigo34$codigo35-$codigo36 $codigo37$codigo38$codigo39$codigo40$codigo41$codigo42$codigo43$codigo44$codigo45$codigo46$codigo47-$codigo48";


$tipo_pagamento = $_GET['tipo'];
$nega = $_GET['nega'];
$sem_cobranca = $_GET['sem_cobranca'];


$sql_verifica_convenio = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_barras = '$codigo_barras' AND status != 'CANCELADO'");
if(mysqli_num_rows($sql_verifica_convenio) >=1){
	echo "<script language='javascript'>alert('Este pagamento já foi realizado e não poderá ser refeito!');location='?p=';</script>";
}else{
	require "pagamento_contas/verifica_convenio.php";
}} 





?>











<? if($_GET['tipo'] == 'BOLETO' && $_GET['p'] == '2'){  

$codigo_barras = $_GET['codigoBarras'];
$codigo1 = $codigo_barras[0];
$codigo2 = $codigo_barras[1];
$codigo3 = $codigo_barras[2];
$codigo4 = $codigo_barras[3];
$codigo5 = $codigo_barras[4];
$codigo6 = $codigo_barras[5];
$codigo7 = $codigo_barras[6];
$codigo8 = $codigo_barras[7];
$codigo9 = $codigo_barras[8];
$codigo10 = $codigo_barras[9];
$codigo11 = $codigo_barras[10];
$codigo12 = $codigo_barras[11];
$codigo13 = $codigo_barras[12];
$codigo14 = $codigo_barras[13];
$codigo15 = $codigo_barras[14];
$codigo16 = $codigo_barras[15];
$codigo17 = $codigo_barras[16];
$codigo18 = $codigo_barras[17];
$codigo19 = $codigo_barras[18];
$codigo20 = $codigo_barras[19];
$codigo21 = $codigo_barras[20];
$codigo22 = $codigo_barras[21];
$codigo23 = $codigo_barras[22];
$codigo24 = $codigo_barras[23];
$codigo25 = $codigo_barras[24];
$codigo26 = $codigo_barras[25];
$codigo27 = $codigo_barras[26];
$codigo28 = $codigo_barras[27];
$codigo29 = $codigo_barras[28];
$codigo30 = $codigo_barras[29];
$codigo31 = $codigo_barras[30];
$codigo32 = $codigo_barras[31];
$codigo33 = $codigo_barras[32];
$codigo34 = $codigo_barras[33];
$codigo35 = $codigo_barras[34];
$codigo36 = $codigo_barras[35];
$codigo37 = $codigo_barras[36];
$codigo38 = $codigo_barras[37];
$codigo39 = $codigo_barras[38];
$codigo40 = $codigo_barras[39];
$codigo41 = $codigo_barras[40];
$codigo42 = $codigo_barras[41];
$codigo43 = $codigo_barras[42];
$codigo44 = $codigo_barras[43];
$codigo45 = $codigo_barras[44];
$codigo46 = $codigo_barras[45];
$codigo47 = $codigo_barras[46];


$codigo_barras = "$codigo1$codigo2$codigo3$codigo4$codigo5.$codigo6$codigo7$codigo8$codigo9$codigo10 $codigo11$codigo12$codigo13$codigo14$codigo15.$codigo16$codigo17$codigo18$codigo19$codigo20 $codigo21 $codigo22$codigo23$codigo24$codigo25$codigo26.$codigo27$codigo28$codigo29$codigo30$codigo31$codigo32 $codigo33 $codigo34$codigo35$codigo36$codigo37$codigo38$codigo39$codigo40$codigo41$codigo42$codigo43$codigo44$codigo45$codigo46$codigo47";



$tipo_pagamento = $_GET['tipo'];
$nega = $_GET['nega'];
$sem_cobranca = $_GET['sem_cobranca'];

$valor = ("$codigo40$codigo41$codigo42$codigo43$codigo44$codigo45.$codigo46$codigo47")+0;

$sql_verifica_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_barras = '$codigo_barras' AND status != 'CANCELADO'");	

if(mysqli_num_rows($sql_verifica_boletos) >= 1 && $valor >0){		
	echo "<script language='javascript'>alert('Este pagamento já foi realizado e não poderá ser refeito!');location='?p=';</script>";
}else{

	if($valor <=0){
		
		echo "<script language='javascript'>window.location='?p=22&acao2=valorBoleto&tipo=BOLETO&boleto=$codigo_barras';</script>";
		
	}else{
		
		require "pagamento_contas/verifica_boleto.php";
	}

}}
?>



<? if($_GET['acao2'] == 'valorBoleto' && $_GET['p'] == '22'){ ?>

<? if(isset($_POST['valor_fatura'])){

$valor = $_POST['valor_fatura'];

if($valor == ''){
	echo "<script>alert('Você deve digitar o valor para avançar');</script>";
}else{
$codigoBarras = $_GET['codigoBarras'];


echo "<script>window.location='pagamento_contas/verifica_boleto.php?codigoBarras=$codigoBarras&tipo=BOLETO&valorBoleto=$valor';</script>";


}

}?>
<hr />
 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5" style="font:18px Arial, Helvetica, sans-serif; margin:10px;">
   Digite o valor que será pago nesta fatura<br /><br />
  <input id="valor_fatura" 
       style="background:#000; font:20px Arial, Helvetica, sans-serif; padding:5px; color:#CCC; border-radius:8px; border:1px solid #666; padding:20px; height:30px;" 
       type="text" 
       name="valor_fatura" 
       class="input_juros" 
       size="20" 
       autofocus/>
       
   </h1>
 </form>
<script>
// Adiciona um ouvinte de evento de entrada (input) ao campo de entrada
document.getElementById('valor_fatura').addEventListener('input', function() {
    var valorFaturaEmCentavos = this.value;

    valorFaturaEmCentavos = valorFaturaEmCentavos.replace(/[^0-9]/g, '');

    var valorFaturaEmReais = (parseFloat(valorFaturaEmCentavos) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    this.value = valorFaturaEmReais;
});
</script>
 
<? } // pagina 2 ?>







<? if($_GET['p'] == 'juros'){ ?>
<? if(isset($_POST['avancar'])){
	
$tipo_juros = $_POST['tipo_multa'];
require "pagamento_contas/funcoesVerificaBoleto.php";

$multa = $_POST['multa'];

$multa = $_POST['multa'];
$multa = preg_replace("/[^0-9,.]/", "", $multa);
$multa = str_replace(',', '.', $multa);
$multa = floatval($multa);

	
$codeVencimento = $_GET['codeVencimento'];	
$valorBoleto = $_GET['valor'];	
$codigoBarras = $_GET['codigoBarras'];

$tarifaRecebimento = taxaRecebimento($valorBoleto);

if($multa == 0){

echo "<script language='javascript'>window.location='?p=3&valorJuros=$multa&tipo=BOLETO&codeVencimento=$codeVencimento&valor=$valorBoleto&codigoBarras=$codigoBarras&tarifa=$tarifa&boleto_vencido=1&tarifaRecebimento=$tarifaRecebimento';</script>";
 
 }else{


$tarifa = tarifaBoletoVencido($valorBoleto);
$juros = ($multa-$valorBoleto);


echo "<script language='javascript'>window.location='?p=3&valorJuros=$juros&tipo=BOLETO&codeVencimento=$codeVencimento&valor=$valorBoleto&codigoBarras=$codigoBarras&tarifa=$tarifa&boleto_vencido=1&tarifaRecebimento=$tarifaRecebimento';</script>";


}

}?>

 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5" style="font:18px Arial, Helvetica, sans-serif; margin:10px;">
  <hr />
   Valor total com multa+juros 
   <input id="valorTotal" style="background:#000; width:130px; font:20px Arial, Helvetica, sans-serif; padding:5px; color:#CCC; border-radius:8px; border:1px solid #666; padding:20px; height:30px;" name="multa" type="text" class="input_juros" size="5"  autofocus/>
   <input style="background:#000; width:120px; font:20px Arial, Helvetica, sans-serif; color:#CCC; border-radius:8px; border:1px solid #666; padding:8px; height:50px;" type="submit" name="avancar" value="Avançar" />
  </h1>
 <script>
// Adiciona um ouvinte de evento de entrada (input) ao campo de entrada
document.getElementById('valorTotal').addEventListener('input', function() {
    var valorFaturaEmCentavos = this.value;

    valorFaturaEmCentavos = valorFaturaEmCentavos.replace(/[^0-9]/g, '');

    var valorFaturaEmReais = (parseFloat(valorFaturaEmCentavos) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });

    this.value = valorFaturaEmReais;
});
</script> 
  
  
 </form>
<? } // fecha juros ?>




<? if($_GET['acao2'] == 'pega_data'){?>
<? if(isset($_POST['data_vencimento'])){
	
$vencimentoDigitado = $_POST['data_vencimento'];
$codigoBarras = $_GET['boleto'];



if($_GET['tipo'] == 'BOLETO'){
	
echo "<script>window.location='pagamento_contas/verifica_boleto.php?codigoBarras=$codigoBarras&codeVencimento=$vencimentoDigitado&tipo=BOLETO&valorBoleto=".$_GET['valorBoleto']."';</script>";


}else{

$codeVencimento = 0;
$code_hoje = 0;


$busca_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$vencimentoDigitado'");
while($res_busca_vencimento = mysqli_fetch_array($busca_vencimento)){
	$codeVencimento = $res_busca_vencimento['codigo'];
}
$busca_hoje = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_busca_hoje = mysqli_fetch_array($busca_hoje)){
	$code_hoje = $res_busca_hoje['codigo'];
}

if($code_vencimento < $code_hoje && $codigo_barras[1] == 5 || $codigo_barras[1] == 1){
	echo "<script>alert('Estar convênio estar vencido e não pode ser aceito');window.location='?p=';</script>";
}else{
	include_once("pagamento_contas/funcoesVerificaConvenio.php");
	
	
		echo "<script>window.location='fazer_pagamento.php?p=3&tipo=CONVENIO&boleto=$codigoBarras&codeVencimento=$codeVencimento&valorBoleto=".$_GET['valorBoleto']."&tarifaRecebimento=".taxaRecebimento($_GET['valorBoleto'])."';</script>";
	
}
	
}

}?>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <h1 class="h5" style="margin:10px 0 0 0; font:18px Arial, Helvetica, sans-serif;">
  <hr /><br /><br /><br /><br /><br />
   <strong>Informe a data de vencimento</strong> <span id="sprytextfield1_vencimento_convenio"><br />
      <input id="data_vencimento" style="font:50px Arial, Helvetica, sans-serif; border-radius:5px; margin:2px 0 0 0; width:300px; padding:20px; height:40px; background:#000; color:#F90; text-align:center;" type="text" name="data_vencimento" class="input_juros" autofocus="autofocus"/>

   <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span>
   </h1>
 </form>
<script>
// Adiciona um ouvinte de evento de entrada (input) ao campo de entrada
document.getElementById('data_vencimento').addEventListener('input', function() {
    // Pega o valor do campo de entrada
    var valorData = this.value;

    // Remove caracteres não numéricos
    valorData = valorData.replace(/[^0-9]/g, '');

    // Formata a data no formato desejado (dd/mm/yyyy)
    if (valorData.length >= 8) {
        var dia = valorData.substring(0, 2);
        var mes = valorData.substring(2, 4);
        var ano = valorData.substring(4, 8);

        // Atualiza o valor no campo de entrada
        this.value = dia + '/' + mes + '/' + ano;
    }
});

 document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "h"
            if (event.key === 'h' || event.key === 'H') {
                // Obtém o elemento de input pelo ID
                var input = document.getElementById('data_vencimento');

                // Obtém a data atual
                var dataAtual = new Date();

                // Formata a data no estilo desejado (dd/mm/yyyy)
                var dia = dataAtual.getDate().toString().padStart(2, '0');
                var mes = (dataAtual.getMonth() + 1).toString().padStart(2, '0'); // Mês é base 0, então adicionamos 1
                var ano = dataAtual.getFullYear();

                // Atualiza o valor do campo de entrada
                input.value = dia + '/' + mes + '/' + ano;
            }
        });
</script> 

<? } ?>




<? if($_GET['p'] == '3'){  ?>
<? if($_GET['tipo'] == 'BOLETO'){ require "pagamento_contas/funcoesVerificaBoleto.php"; ?>
<? if(isset($_POST['buttons'])){ require "pagamento_contas/verifica_informacoes_boleto.php"; }?>

<h1><strong>VERIFIQUE AS INFORMAÇÕES CONTIDAS ABAIXO E CONFIRME O PAGAMENTO</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<hr /><table width="950" border="0">
  <tr>
    <td colspan="3"><label for="textfield"></label>
    <input class="codigo_barras2" style="text-align:center;" name="textfield" type="text" value="<?  echo restaraConfiguracaoBoleto($_GET['codigoBarras']); ?>" disabled id="textfield"></td>
  </tr>
  <tr>
    <td width="130"><?  $valor = $_GET['valor'];

$valor = preg_replace('/[^0-9,.]/', '', $valor);
$formatted_valor = number_format($valor, 2, ',', '.');

?></td>
    <td align="right" width="473"><strong>BANCO FAVORECIDO</strong></td>
    <?  $banco2 = 0; ?>
    <td width="386">
    <input class="valores2" name="textfield2" type="text" disabled id="textfield2" value="<?
	
	$banco2 = 0;
	$banco = analisaBoleto($_GET['codigoBarras']);
	

	$sqlBanco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '".$banco['banco']."'");
		while($resBanco = mysqli_fetch_array($sqlBanco)){
		echo $banco2 = strtoupper($resBanco['nome_banco']);
	}
	?>"/></td><input type="hidden" name="banco" value="<? echo $banco2; ?>" />
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VENCIMENTO</strong>
    <?
	$code_hoje = 0;
	$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
		while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
			
			$code_hoje = $res_vencimento['codigo'];
	}
	?>
    </td>
    <td>
    <?
	$vencimento = 0;
	$sql_verifica_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$_GET['codeVencimento']."'");
	?>
    <span id="sprytextfield91111">
     <input name="vencimento" type="text" disabled="disabled" class="valores2" value="<? 
	   while($res_data_vencimento = mysqli_fetch_array($sql_verifica_vencimento)){ 
	   		echo $vencimento = $res_data_vencimento['vencimento'];
		} 
	?>" /></span>
    <input class="valores2" type="hidden" name="vencimento" value="<? echo $vencimento;  ?>" />
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>PAGAMENTO</strong></td>
    <td><label for="textfield4"></label>
      <? $pagamento = 0; ?>
      <input name="textfield4" type="text" disabled="disabled" class="valores2" id="textfield4" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>   
      " />
      <input type="hidden" name="dia_pagamento" value="<? echo $dia_pagamento ?>" />
      </span></td>
  </tr>
  <tr>
    <td><?
	$cliente = 0;
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
		 while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			 $cliente = $res_carrinho['cliente'];
		 }
	 $sql_telefone = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
	 	while($res_dados_telefone = mysqli_fetch_array($sql_telefone)){
			$telefone = $res_dados_telefone['celular_1'];
		}
	 
	?></td>
    <td align="right"><strong>VALOR DO DOCUMENTO</strong></td>
    <td>
      <input type="text" disabled="disabled" class="valores2" id="valorDocumento" value="R$ <? 
	  			
				$valorString = $_GET['valor'];

				// Remove caracteres não numéricos, exceto ponto e vírgula
				$valorString = preg_replace("/[^0-9,.]/", "", $valorString);
				
				// Substitui a vírgula por ponto (para o formato numérico válido em PHP)
				$valorString = str_replace(',', '.', $valorString);
				
				// Converte para float
				$valorFloat = floatval($valorString);
				
				// Exibe o valor float
				echo number_format($valorFloat,2,',','.'); 
				

				
		?>" /> 
      <input type="hidden" name="valor" value=" <? 
	  			
				$valorString = $_GET['valor'];

				$valorString = preg_replace("/[^0-9,.]/", "", $valorString);
				$valorString = str_replace(',', '.', $valorString);
				
				$valorFloat = floatval($valorString);
				
				echo $valorFloat; 
				

				
		?>" />
      </td>
  </tr>
  <? if($_GET['boleto_vencido'] == 1){ ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>JUROS E MULTA</strong></td>
    <td><input name="juros_multa" type="text" disabled="disabled" class="valores2" id="textfield7" value="<? echo number_format($_GET['valorJuros']+$_GET['tarifa'], 2, ',', '.'); ?>" /></td>
  </tr>
  <? } ?>
  
  <? if($_GET['boleto_vencido'] == 0 && $banco2 != 'VESTEPRIME CARD'){ ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>DESCONTOS</strong></td>
    <td><input name="descontos" style="background:#666; border:1px solid #F90; outline: none;" type="text" class="valores2" id="desconto"/></td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>TELEFONE</strong></td>
    <td><?
	$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
	 while($res_pagamentos = mysqli_fetch_array($sql_verifica_conjunto)){
		 
		 $sql_pagamento_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '".$res_pagamentos['code_conjunto']."' AND telefone != '' ORDER BY id DESC LIMIT 1");
		   while($res_pagamentos_boletos = mysqli_fetch_array($sql_pagamento_boletos)){
			   $telefone = $res_pagamentos_boletos['telefone'];
		  }
	}
	?>
      <span id="telefone">
<input name="telefone" style="background: #666; border: 1px solid #F90; outline: none;" id="telefone" type="text" class="valores2" <?php if ($telefone != '') { ?>disabled="disabled"<?php } ?> value="<?php echo $telefone; ?>" autofocus/>

      <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR COBRADO <input id="impressoCheckbox" name="impresso" type="checkbox" /></strong></td>
    <td><input name="telefone" type="text" disabled="disabled" class="valores2" id="textfield3" value="<? 
	$boleto_vencido = 0;
		echo number_format($_GET['valor']+$_GET['valorJuros']+$_GET['tarifa']+$_GET['tarifaRecebimento'], 2, ',', '.');
	
	?>" />
      </td>
  </tr>
  <tr>
    <td align="center" colspan="3"><hr><input class="botao_avancar3" type="submit" name="buttons" id="button" value="CONFIRMAR"></td>
  </tr>
</table>
</form>
    <script>

			document.addEventListener('keydown', function(e) {
			// Verifica se a tecla pressionada é a letra 'd'
			if (e.key === 't' || event.key === 'T') {
				// Aplica autofocus no próximo input
				document.getElementById('telefone').focus();
			}
		});
			
			document.addEventListener('keydown', function(e) {
			// Verifica se a tecla pressionada é a letra 'd'
			if (e.key === 'd' || event.key === 'D') {
				// Aplica autofocus no próximo input
				document.getElementById('desconto').focus();
			}
		});
		
		document.getElementById('desconto').addEventListener('input', function() {
			var valorFaturaEmCentavos = this.value;
		
			valorFaturaEmCentavos = valorFaturaEmCentavos.replace(/[^0-9]/g, '');
		
			var valorFaturaEmReais = (parseFloat(valorFaturaEmCentavos) / 100).toLocaleString('pt-BR', { style: 'currency', currency: 'BRL' });
		
			this.value = valorFaturaEmReais;
		});
		

	
        document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "I"
            if (event.key === 'i' || event.key === 'I') {
                // Obtém o elemento do checkbox pelo ID
                var checkbox = document.getElementById('impressoCheckbox');
                
                // Altera o estado do checkbox
                checkbox.checked = !checkbox.checked;
            }
        });
		
		
		document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "A"
            if (event.key === 'a' || event.key === 'A') {
                // Impede o comportamento padrão da tecla para evitar conflito
                event.preventDefault();

                // Obtém o botão pelo ID
                var botao = document.getElementById('button');

                // Aciona o clique no botão
                botao.click();
            }
        });
		
    </script>

<? } // verifica tipo de pagamento é boleto ?>





















<? if($_GET['tipo'] == 'CONVENIO'){  require "pagamento_contas/funcoesVerificaConvenio.php"; ?>


<? if(isset($_POST['buttonss'])){ require "pagamento_contas/verifica_informacoes_convenio.php"; } // fecha post ?>

<h1><strong>VERIFIQUE AS INFORMAÇÕES ABAIXO E CONFIRME O PAGAMENTO</strong></h1>
<form id="meuFormulario" method="post" enctype="multipart/form-data">
<hr /><table width="950" border="0">
  <tr>
    <td colspan="3"><input class="codigo_barras2" name="textfield" type="text" value="<? echo formataCodigo($_GET['boleto']); ?>" disabled="disabled"></td>
  </tr>
  <tr>
    <td width="130">&nbsp;</td>
    <td align="right" width="473"><strong>CONV&Ecirc;NIO</strong></td>
    <td width="386"><input class="valores2" name="textfield2" type="text" disabled id="textfield2" value="<? 
	
    $codigoBarras = $_GET['boleto']; $convenio = 0;
	
	$sqlNomeConvenio = mysqli_query($conexao_bd, "SELECT * FROM tipos_convenio WHERE codigo = '".retornaCodigoConvenio($_GET['boleto'])."'");
	$contaConvenio = mysqli_num_rows($sqlNomeConvenio);
	
	if($contaConvenio >=1){
			while($resNomeConvenio = mysqli_fetch_array($sqlNomeConvenio)){
				echo $convenio = $resNomeConvenio['convenio'];
			}
	
	}else{
		
			
		if($codigoBarras[1] == '1'){
			 $convenio = "Prefeituras";
		}elseif($codigoBarras[1] == '2'){
			 $convenio = "Saneamento";
		}elseif($codigoBarras[1] == '3'){
			 $convenio = "Energia Elétrica ou Gás";
		}elseif($codigoBarras[1] == '4'){
			 $convenio = "Telecomunicações";
		}elseif($codigoBarras[1] == '5'){
			 $convenio = "Órgãos Governamentais";
		}elseif($codigoBarras[1] == '6'){
			 $convenio = "Carnes e Assemelhados ou demais empresas";
		}elseif($codigoBarras[1] == '7'){
			 $convenio = "Multas de trânsito";
		}elseif($codigoBarras[1] == '9'){
			 $convenio = "Uso exclusivo do banco";
		}
		
		echo $convenio;
		
		
	}
	    $dataVencimento = 0;
		$sqlDataVencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$_GET['codeVencimento']."'");
			while($resCodeVencimento = mysqli_fetch_array($sqlDataVencimento)){
				$dataVencimento = $resCodeVencimento['vencimento'];
		}
	
	?>">
    
    <input type="hidden" name="orgao" value="<? echo $convenio; ?>" />
    <input type="hidden" name="verifica_boleto_tarifado" value="<? echo $_GET['tarifaRecebimento']; ?>" />
    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VENCIMENTO</strong></td>
    <td><span id="vencimento">
    <input name="vencimento" type="hidden" class="valores2" value="<? echo $dataVencimento; ?>" />
    <input name="vencimento3" type="text" disabled="disabled" class="valores2" value="<? echo $dataVencimento; ?>" />
    <span class="textfieldInvalidFormatMsg"></span><span class="textfieldRequiredMsg"></span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>PAGAMENTO</strong></td>
    <td>
      <span id="sprytextfield260000165412">
            <? $pagamento = 0; ?>
      <input name="textfield4" type="text" disabled="disab2led" class="valores2" id="textfield4" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>   
      " />
      <input type="hidden" name="dia_pagamento" value="<? echo $dia_pagamento ?>" />
      </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR DO PAGAMENTO</strong></td>
    <td>
      <input name="valor" type="text" disabled="disabled" class="valores2" id="textfield5" value="<? echo number_format($_GET['valorBoleto'], 2, ',', '.'); ?>" />
      <input type="hidden" name="valor" value="<? echo $_GET['valor']; ?>" />
      </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>TELEFONE</strong></td>
    <td>
<?
	$cliente = 0;
	 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
		 while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			 $cliente = $res_carrinho['cliente'];
		 }
	 $sql_telefone = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
	 	while($res_dados_telefone = mysqli_fetch_array($sql_telefone)){
			$telefone = $res_dados_telefone['celular_1'];
		}
	 
	?>    
    
    <?
	$sql_verifica_conjunto = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boleto_conjunto WHERE status = 'Aguarda' AND operador = '$operador'");
	 while($res_pagamentos = mysqli_fetch_array($sql_verifica_conjunto)){
		 
		 $sql_pagamento_boletos = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE conjunto = '".$res_pagamentos['code_conjunto']."' AND telefone != '' ORDER BY id DESC LIMIT 1");
		   while($res_pagamentos_boletos = mysqli_fetch_array($sql_pagamento_boletos)){
			   $telefone = $res_pagamentos_boletos['telefone'];
		  }
	}
	?>
    <span id="telefone">
    <input name="telefone" type="text" class="valores2" <? if($telefone != ''){ ?>disabled="disabled"<? } ?> value="<? echo $telefone; ?>"  autofocus/>
    <span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span></span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right"><strong>VALOR COBRADO</strong><input id="impressoCheckbox" name="impresso" type="checkbox" value="SIM" /></td>
    <td>
      <input name="textfield8" class="valores2" type="text" disabled="disabled" value="<? echo number_format($_GET['valorBoleto']+$_GET['tarifaRecebimento'], 2, ',', '.'); ?>" id="textfield8" />
      </td>
  </tr>
  <tr>
    <td align="center" colspan="3"><hr><input class="botao_avancar3" type="submit" name="buttonss" id="button" value="CONFIRMAR"></td>
  </tr>
</table>
</form>
    <script>
        document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "I"
            if (event.key === 'i' || event.key === 'I') {
                // Obtém o elemento do checkbox pelo ID
                var checkbox = document.getElementById('impressoCheckbox');
                
                // Altera o estado do checkbox
                checkbox.checked = !checkbox.checked;
            }
        });
		
		
		document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "A"
            if (event.key === 'a' || event.key === 'A') {
                // Impede o comportamento padrão da tecla para evitar conflito
                event.preventDefault();

                // Obtém o botão pelo ID
                var botao = document.getElementById('button');

                // Aciona o clique no botão
                botao.click();
            }
        });
		
    </script>


<? } // verifica tipo de pagamento é convênio ?>









<? }// pagamentos 3 ?>






<? if($_GET['p'] == '4'){ ?>
<h1><strong>Informações sobre o pagamento</strong></h1>
<?

	
$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM verifica_efetivado WHERE code_boleto = '".$_GET['code_boleto']."'");
if(mysqli_num_rows($sql_verifica_boleto) >= 1){
  
  mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'Operador voltou a tela de pagamenton do boleto $code_boleto mesmo após emitir o recibo de pagamento', '$url')");	
	
  mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Usuário voltou a tela de pagamento mesmo após o recibo emitido $code_boleto', '$url')");
	
  echo "<script language='javascript'>window.alert('AQUI! - ".mysqli_num_rows($sql_verifica_boleto)." O recibo deste pagamento já emitido, por tanto, somente um requerimento pode cancelar esse pagamento. Lembrando que foi enviado uma notificação para verificar esta sua ação!');window.location='fazer_pagamento.php?p=';</script>";
  
}

?>





<? 
$code_boleto = @$_GET['code_boleto'];
$pagamento_escolhido = 0;
$valor_pagamento = 0;
$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '$code_boleto'");
	while($res_boleto = @mysqli_fetch_array($sql_boleto)){
		$pagamento_escolhido = $res_boleto['pagamento_escolhido'];
		$valor_pagamento = $res_boleto['valor']+$res_boleto['juros'];
		
?>
<input class="codigo_barras3" type="text" disabled="disabled" value="<? echo $res_boleto['code_barras']; ?>" />
<div id="pagamento">
<? if(isset($_POST['valor_enviar'])){
	
$forma_pagamento = $_POST['forma_pagamento'];
$valor_enviar = $_POST['valor_enviar'];

@$pontos = array(",", ".");
@$valor_enviar = str_replace($pontos, ".", $valor_enviar);

$tamanho_valor = strlen($valor_enviar);
$verifica_se_existe_virgula = 0;

$verifica_conjunto = 0;


if($valor_enviar == "+"){
	$code_conjunto = date("s")*646+564+rand();
	mysqli_query($conexao_bd, "INSERT INTO pagamento_boleto_conjunto (status, code_conjunto, data, data_completa, cliente, operador) VALUES ('Aguarda', '$code_conjunto', '$data', '$data_completa', '$cliente', '$operador')");
	
	mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET conjunto = '$code_conjunto' WHERE code_boleto = '".$_GET['code_boleto']."'");
		
	echo "<script language='javascript'>window.location='fazer_pagamento.php?p=';</script>";

}
// aqui termina o conjunto



for($i=0; $i<$tamanho_valor; $i++){
	if($valor_enviar[$i] == ','){
		$verifica_se_existe_virgula = 1;
	}
}

if($verifica_se_existe_virgula == 1){
	echo "<script language='javascript'>window.alert('OS NÚMEROS NÃO PODE CONTER VIRGULA, APENAS O PONTO É UTILIZADO PARA DIFERENCIAR OS CENTAVOS!');</script>";
}else{

$tipo = $_GET['tipo'];
$codigo_barras = $_GET['codigo_barras'];
$banco = $_GET['banco'];
$vencimento = $_GET['vencimento'];
$juros = $_GET['juros'];
$descontos = $_GET['descontos'];
$telefone = $_GET['telefone'];
$pgt_form = $_GET['forma_pagamento'];
$tarifado = $_GET['tarifado'];
$vencido = $_GET['vencido'];
$valor = $_GET['valor'];

$pagamentos_feitos = 0;
$sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}

$valor_maximo_a_receber = $res_boleto['valor_recebido'];

$falta_ainda_receber = $valor_maximo_a_receber-$pagamentos_feitos;

if($pagamentos_feitos >= $valor_maximo_a_receber){
	echo "<script language='javascript'>window.alert('O pagamento total já foi efetuado!');</script>";
}elseif($valorusar>$falta_ainda_receber && $forma_pagamento != 'DINHEIRO'){
	echo "<script language='javascript'>window.alert('Não é possível efetivar um valor acima do que ainda falta pagar!');</script>";
}else{
 	
	$saldo_conta = 0;
	$cheque_especial = 0;
	$saldo_conta_e_cheque_especial = 0;
	$cliente = $res_boleto['cliente'];
	$status_cliente = 0;
	$limite_pagamento = 0;
	$taxa_juros = 0;
	$juros_parcelado = 0;
	$limite_emergencial_auto = 0;
	$sql_verifica_saldo = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
		while($res_verifica_saldo = mysqli_fetch_array($sql_verifica_saldo)){
			$saldo_conta = $res_verifica_saldo['saldo'];
			$status_cliente = $res_verifica_saldo['status'];
			$pagamento_contas = $res_verifica_saldo['pagamento_contas'];
			$limite_pagamento = $res_verifica_saldo['disponivel_pagamento_contas'];
			$taxa_juros = $res_verifica_saldo['taxa_juros'];
			$juros_parcelado = $res_verifica_saldo['juros_parcelamento'];
			$limite_emergencial_auto = $res_verifica_saldo['limite_emergencial'];
		}


	if($status_cliente != 'ATIVO' && $forma_pagamento == 'VESTE PRIME'){
		echo "<script language='javascript'>window.alert('Cliente não está apto para fazer pagamento usando o VESTE PRIME CARD!');</script>";
	}elseif($forma_pagamento == 'VESTE PRIME' && $limite_pagamento < $valor_enviar){	
		$limite_emergencial = ($pagamento_contas*0.3)+$limite_pagamento;
		if($limite_emergencial >= $valor_enviar && $limite_emergencial_auto == 'AUTORIZAR'){
 	 		echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_emergencial&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado&limiteemergencial=sim';</script>";
		}else{
		echo "<script language='javascript'>window.alert('CLIENTE NÃO TEM LIMITE DISPONÍVEL PARA FINANCIAR DESSE PAGAMENTO ESSE VALOR, ELE PODE TENTAR UMA AVALIAÇÃO EMERGICIAL DE CRÉDITO OU AUMENTO DE LIMITE PARA FINANCIAR ESSE PAGAMENTO. NÃO ESQUECER DE AVISAR DA TARIFA COBRADA!');</script>";
		}
	}elseif($forma_pagamento == 'VESTE PRIME' && $limite_pagamento >= $valor_enviar){
 	 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
	}else{
		
		
		$limite_caractres = strlen($valor_enviar); 
		$verficado_multiplicacao = 0;
		
		for($i=0; $i<=$limite_caractres; $i++){
			if($valor_enviar[$i] == '*'){
				$verficado_multiplicacao = 1;
			}
		}

		
		
		
	 if($verficado_multiplicacao == 1){
	 $valor_enviar =  "$valor_enviar"+0;
 	 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&valor_nota=$valor_enviar&acao=multiplicador';</script>";
	 }		
		
 	 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&limite_pagamento=$limite_pagamento&valorusar=$valor_enviar&pag_form=$forma_pagamento&taxa_juros=$taxa_juros&juros_parcelamento=$juros_parcelado';</script>";
   }
  }
 }
}?>



<? if($_GET['acao'] == 'multiplicador'){ ?>

<? if(isset($_POST['quantidade'])){

$quantidade = $_POST['quantidade'];
$valor_nota = $_GET['valor_nota'];

$valorusar = $quantidade*$valor_nota;

$code_boleto = $_GET['code_boleto'];

 echo "<script language='javascript'>window.location='?p=4&code_boleto=$code_boleto&valorusar=$valorusar&pag_form=DINHEIRO';</script>";

}?>

<form name="" method="post" action="" enctype="multipart/form-data">
 <h6 style="float:left; font:25px Arial, Helvetica, sans-serif; margin:10px 0 0 5px;"><strong>Quantidade de notas</strong></h6>
 <input style="margin:5px 0 0 5px; width:100px;" name="quantidade" type="number" value="" size="5" autofocus/>
</form>
<? } // quantidade de notas ?>








<? if($_GET['pag_form'] == '' && $_GET['acao'] != 'multiplicador'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select name="forma_pagamento" size="1">
   <?
   $saldo_pagamento = 0;
   $sql_verifica_limite = mysqli_query($conexao_bd, "SELECT * FROM limites_operacionais WHERE data = '$data'");
   while($res_limite = mysqli_fetch_array($sql_verifica_limite)){ $saldo_pagamento = $res_limite['saldo']; }
   if(($saldo_pagamento+$valor_pagamento) <= 20000){
   ?>
   <? if($res_boleto['cliente'] != ''){ ?><option value="VESTE PRIME">1 - VESTE PRIME</option><? } ?>
   <option value="DINHEIRO">2 - DINHEIRO</option>
   <option value="TRANSFERENCIA">3 - PIX/TRANSFER&Ecirc;NCIA</option>
   <option value="CARTAO DE DEBITO">4 - CART&Atilde;O DE D&Eacute;BITO</option>
   <option value="CARTAO DE CREDITO">5 - CART&Atilde;O DE CR&Eacute;DITO</option>
   <option value="M12">6 - AUTORIZA&Ccedil;&Atilde;O M12</option>
   <? } ?>
</select>
 <input name="valor_enviar" type="text" value="<? 
 $pagamentos_feitos = 0;
 $valor_a_receber = $res_boleto['valor_recebido'];
 $sql_busca_pagamento = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
 	while($res_busca_pagamento = mysqli_fetch_array($sql_busca_pagamento)){
		$pagamentos_feitos = $res_busca_pagamento['valor']+$pagamentos_feitos;
	}
 
 echo $falta_pagar = number_format(($res_boleto['valor_recebido']-$pagamentos_feitos), 2, '.', '');
 
 ?>" size="5"  <? if($falta_pagar >0){ ?>autofocus<? } ?>/>
</form>
<? } // verifica se existe informações ?>
<div id="opcoes_de_parcelamento">
<hr />

<? if(@$_GET['pag_form'] == 'DINHEIRO' || @$_GET['pag_form'] == 'PIX' || @$_GET['pag_form'] == 'M12' || @$_GET['pag_form'] == 'TRANSFERENCIA'){ require "pagamento_contas/dinheiro.php"; } // FINALIZA A SELEÇÃO DE DINHEIRO?>

<? if(@$_GET['pag_form'] == 'VESTE PRIME'){ require "pagamento_contas/pagamento_veste_prime.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE CREDITO'){ require "pagamento_contas/pagamento_cartao_credito.php"; } ?>

<? if(@$_GET['pag_form'] == 'CARTAO DE DEBITO'){ require "pagamento_contas/pagamento_cartao_debito.php"; } ?>



<? if($_GET['pag_form'] == ''){ ?>
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<a class="aa" rel="superbox[iframe][905x200]" href="scripts/ver_pagamentos_boletos.php?code_boleto=<? echo $code_boleto; ?>">Ver pagamentos</a>
<h3 class="h3"><hr /><strong>VALOR A PAGAR:</strong> R$ <? echo number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?></h3>
<h3 class="h4"><strong>VALOR PAGO:</strong> R$ <? echo number_format($pagamentos_feitos, 2, ',', '.'); ?><strong> - AINDA FALTA PAGAR:</strong> R$ <? echo number_format($falta_pagar, 2, ',', '.'); ?></h3>
<h3 class="h5"><br /><strong>TROCO:</strong> R$
<?
$troco = 0;
$soma_troco = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
	while($res_troco = mysqli_fetch_array($soma_troco)){
			$troco = $res_troco['troco']+$troco;
	}
	
	echo number_format($troco, 2, ',', '.');
	
?>
</h3><br /><br /><br />
<? } ?>
</div><!-- opcoes_de_parcelamento -->
<hr />
<img src="img/bancodobrasil.jpg" width="400" height="60" />
</div><!-- pagamento -->


<div id="informacoes_pagamento">
<strong>Revise as informações do pagamento
<? if(@$res_boleto['tipo'] == 'CONVENIO'){ ?>
</strong><h1 class="h1">TIPO DE FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<? echo $res_boleto['banco']; ?>" size="48" /><br />
<? }else{ ?>
</strong><h1 class="h1">BANCO FAVORECIDO<br />
<input type="text" disabled="disabled" class="input2" value="<?
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '".$res_boleto['banco']."'");
	if(mysqli_num_rows($sql_banco) == ''){
		echo $res_boleto['banco'];
	}else{
		while($res_banco = mysqli_fetch_array($sql_banco)){
				echo $banco2 = $res_banco['nome_banco'];
			}
	}
?>" size="48" /><br />
<? } // verifica se é banco ou convênio ?>
VALOR<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['valor'], 2, ',', '.'); ?>" size="7" /><br />
VENCIMENTO<br />
<input type="text" disabled="disabled" class="input" value="<? echo $res_boleto['vencimento']; ?>" size="7" /><br />
PAGAMENTO<br />
<input type="text" disabled="disabled" class="input" value="<?
	  $dia_pagamento = date("d/m/Y");
	  $sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM datas_pagamento_contas WHERE dia = '$dia_pagamento'");
	  if(mysqli_num_rows($sql_pagamento) == ''){
		  echo $dia_pagamento = date("d/m/Y");
	  }else{
		  while($res_pagamento = mysqli_fetch_array($sql_pagamento)){
			 echo $dia_pagamento = $res_pagamento['proximo_dia'];
	   }
	  }
	  ?>" size="7" /><br />
JUROS/MULTA<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['juros']+$res_boleto['boleto_vencido'], 2, ',', '.'); ?>" size="7" /><br />
DESCONTOS<br />
<input type="text" disabled="disabled" class="input" value="<? echo $res_boleto['desconto']; ?>" size="7" /><br />
OUTRAS TARIFAS<br />
<input type="text" disabled="disabled" class="input" value="<?
$tarifas_extras = $res_boleto['boleto_tarifado']+$res_boleto['boleto_impresso'];
echo number_format($tarifas_extras, 2, ',', '.');

?>" size="7" /><br />
VALOR A RECEBER<br />
<input type="text" disabled="disabled" class="input" value="<? echo number_format($res_boleto['valor_recebido'], 2, ',', '.'); ?>" size="10" /><br />
<hr /></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar" type="submit" name="cancelar" value="Cancelar" /><br />
</form>

<? if(isset($_POST['cancelar'])){
	
	
$sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM verifica_efetivado WHERE code_boleto = '".$_GET['code_boleto']."'");
if(mysqli_num_rows($sql_verifica_boleto) >= 1){
  
  mysqli_query($conexao_bd, "INSERT INTO notificacoes_de_sistema (data_completa, ip, operador, acao, url) VALUES ('$data_completa', '$ip', '$operador', 'operador quis cancelar o pagamento $code_boleto mesmo após emitir o recibo de pagamento', '$url')");	
	
 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Tentativa de cancelamento do pagamento $code_boleto', '$url')");
	
  echo "<script language='javascript'>window.alert('O recibo deste pagamento já emitido, por tanto, somente um requerimento pode cancelar esse pagamento. Lembrando que foi enviado uma notificação para verificar esta sua ação!');</script>";
}else{

$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET status = 'CANCELADO', motivo_cancelamento = 'BOLETO CANCELADO ANTES DE FINALIZADO', operador_cancelamento = '$operador' WHERE code_boleto = '$code_boleto'");

 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Cancelamento do pagamento $code_boleto', '$url')");


  echo "<script language='javascript'>window.alert('PAGAMENTO CANCELADO COM SUCESSO!');window.location='fazer_pagamento.php?p=';</script>";
}else{
  echo "<script language='javascript'>window.alert('EXCLUA TODOS OS PAGAMENTOS ANTES DE CANCELAR O PAGAMENTO DO BOLETO!');</script>";
 }
}
}?>




<? if(isset($_POST['confirmar'])){

$soma_pagamento = 0;
$valor_a_receber = 0;
$verifica_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM pagamento_boletos_opcoes WHERE code_boleto = '$code_boleto'");
if(mysqli_num_rows($verifica_pagamentos) == ''){
  echo "<script language='javascript'>window.alert('ANTES DE ENVIAR O TITULO DE RECEBIMENTO PARA COMPENSAÇÃO, O PAGAMENTO DO MESMO DEVE SER CONFIRMADO!');</script>";
}else{
	while($res_soma_pagamentos = mysqli_fetch_array($verifica_pagamentos)){
		$soma_pagamento = $res_soma_pagamentos['valor']+$soma_pagamento;
	}
	
$sql_verifica_valor_receber = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '$code_boleto'");
	while($res_valor_receber = mysqli_fetch_array($sql_verifica_valor_receber)){
		$valor_a_receber = $res_valor_receber['valor_recebido'];
	}
	
	if($valor_a_receber-$soma_pagamento >0){
  	 echo "<script language='javascript'>window.alert('TÍTULO DE PAGAMENTO NÃO FOI QUITADO POR COMPLETO!');</script>";
	}else{
	
	 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Confirmação de efetivação do pagamento $code_boleto', '$url')");
	
		
  	 echo "<script language='javascript'>window.location='?p=confirmar_efetivacao&code_boleto=$code_boleto';</script>";
  }
 }
}?>


<? if($pagamentos_feitos>=$valor_a_receber){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="botao_avancar2" type="submit" name="confirmar" value="Confirmar" <? if($falta_pagar <=0){ ?>autofocus<? } ?> /><br />
</form>
<? } ?>


</div><!-- informacoes_pagamento -->


<? }// termina o while de verificação ?>



<? } // fechamento do 4 ?>




<? if($_GET['p'] == 'confirmar_efetivacao_conjunto'){ $code_conjunto = $_GET['code_conjunto']; ?>
<hr />
<h1 class="h11"><strong>Informar efetivação de boleto</strong></h1>
    <ul>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 1 para efetivado</strong></li>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 2 para não efetivado</strong></li>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 0 informar que todos o conjunto foi efetivado</strong></li>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 3 informar que todos o conjunto foi <strong>NÃO</strong> efetivado</strong></li>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 9 para voltar ao boleto anterior</strong></li>
    </ul>
<hr style="color:#999; border:1px solid #333;" />

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="900" border="0" align="center" style="text-align:center;">
  <tr>
    <td width="334"><strong>BENEFICIÁRIO</strong></td>
    <td width="149"><strong>VALOR</strong></td>
    <td width="139"><strong>TAXAS</strong></td>
    <td width="155"><strong>VALOR TOTAL</strong></td>
    <td width="101"><strong>OPÇÕES</strong></td>
  </tr>
  <?
  	$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '".$_GET['id_boleto']."'");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
  ?>
  <tr>
    <td style="color:#CCC;"><? 
    $banco = $res_boleto['banco'];
	$codigo_barras = $res_boleto['codigo_barras'];
	
	$banco2 = 0;
	
	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				$banco2 = $res_banco['nome_banco'];
			}
			
	$sql_confere_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE anexo_boleto = '$codigo_barras'");
	if(mysqli_num_rows($sql_confere_fatura) >= 1){
		$banco2 = "VESTEPRIME CARD";
	}
	
	$sql_verifica_credimais = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE codigo_barras = '$codigo_barras'");
	$conta_credimais = mysqli_num_rows($sql_verifica_credimais);
	if($conta_credimais >= 1){
		$banco2 = "CREDIMAIS";
	}	

	if($banco2 == 0){

	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				$banco2 = $res_banco['nome_banco'];
			}
	
	}
	
	 echo $banco2;
	
	
	?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor'],2,',','.'); ?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor']+$res_boleto['boleto_vencido']+$res_boleto['boleto_tarifado']+$res_boleto['boleto_impresso'],2,',','.'); ?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor_recebido'],2,',','.'); ?></td>
    <td><input style="font:30px Arial, Helvetica, sans-serif; background:#000; border-radius:15px; border:1px solid #ccc;  color:#F00; width:50px; text-align:center;" name="opcao" type="text" autofocus size="10"></td>
  </tr>
  <? } ?>
</table>
</form>
<hr style="color:#999; border:1px solid #333;" />
<? if(isset($_POST['opcao'])){

$opcao = $_POST['opcao'];

if($opcao == '0'){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET forma_processamento = 'MAQUINA DE PAGAMENTO', banco_processamento = 'BANCO DO BRASIL', tarifa_processamento = '0', operador_efetivado = '$operador', data_efetivado = '$data', comissao = '0', status = 'Efetivado', data_pagamento
 = '$data' WHERE conjunto = '$code_conjunto'");
 
  	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado efetivação do pagamento do conjunto $code_conjunto', '$url')");

 
 echo "<script language='javascript'>window.location='?p=5&code_conjunto=$code_conjunto';</script>";
}elseif($opcao == '3'){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET forma_processamento = 'MAQUINA DE PAGAMENTO', banco_processamento = 'BANCO DO BRASIL', tarifa_processamento = '0', operador_efetivado = '$operador', data_efetivado = '$data', comissao = '0', status = 'Aguarda', data_pagamento
 = '$data' WHERE conjunto = '$code_conjunto'");
 
   	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado não efetivação do pagamento do boleto $code_conjunto', '$url')");

 
 echo "<script language='javascript'>window.location='?p=5&code_conjunto=$code_conjunto';</script>";
}elseif($opcao == '1'){
	
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET forma_processamento = 'MAQUINA DE PAGAMENTO', banco_processamento = 'BANCO DO BRASIL', tarifa_processamento = '0', operador_efetivado = '$operador', data_efetivado = '$data', comissao = '0', status = 'Efetivado', data_pagamento
 = '$data' WHERE id = '".$_GET['id_boleto']."'");
 
 $id_pagamento = $_GET['id_boleto'];
 
mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado efetivação do pagamento do boleto ID $id_pagamento', '$url')");

 
 $id_boleto = $_GET['id_boleto']+1;
 $sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '$id_boleto' AND conjunto = '$code_conjunto'");
 if(mysqli_num_rows($sql_verifica_boleto) == ''){
	 echo "<script language='javascript'>window.location='?p=5&code_conjunto=$code_conjunto';</script>";	
 }else{
	echo "<script language='javascript'>window.location='?p=confirmar_efetivacao_conjunto&code_conjunto=$code_conjunto&id_boleto=$id_boleto';</script>";	
  }
  
  
}elseif($opcao == '2'){
 $id_boleto = $_GET['id_boleto'];
 $sql_verifica_boleto = mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET status = 'Aguarda' WHERE id = '$id_boleto' AND conjunto = '$code_conjunto'");
 $id_boleto++;
 
 mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado não efetivação do pagamento do boleto ID $id_pagamento', '$url')");

 
 $sql_verifica_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE id = '$id_boleto' AND conjunto = '$code_conjunto'");
 if(mysqli_num_rows($sql_verifica_boleto) == ''){
	 echo "<script language='javascript'>window.location='?p=5&code_conjunto=$code_conjunto';</script>";	
 }else{
	echo "<script language='javascript'>window.location='?p=confirmar_efetivacao_conjunto&code_conjunto=$code_conjunto&id_boleto=$id_boleto';</script>";	
  }

}elseif($opcao == '9'){
 $id_boleto = $_GET['id_boleto']-1;

mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Retornou ao pagamento anterior do boleto ID $id_pagamento', '$url')");


	echo "<script language='javascript'>window.location='?p=confirmar_efetivacao_conjunto&code_conjunto=$code_conjunto&id_boleto=$id_boleto';</script>";	

	

}else{
	echo "<script language='javascript'>window.alert('Opção digitada não é válida!');</script>";	
}

}?>
<? } ?>






<? if($_GET['p'] == 'confirmar_efetivacao'){ $code_boleto = $_GET['code_boleto']; ?>
<hr />
<h1 class="h11"><strong>Informar efetivação de boleto</strong></h1>
    <ul>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 1 para efetivado</strong></li>
     <li style="font:15px Arial, Helvetica, sans-serif;"><strong>Informe 2 para não efetivado</strong></li>
    </ul>
<hr style="color:#999; border:1px solid #333;" />

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="900" border="0" align="center" style="text-align:center;">
  <tr>
    <td width="334"><strong>BENEFICIÁRIO</strong></td>
    <td width="149"><strong>VALOR</strong></td>
    <td width="139"><strong>TAXAS</strong></td>
    <td width="155"><strong>VALOR TOTAL</strong></td>
    <td width="101"><strong>OPÇÕES</strong></td>
  </tr>
  <?
  	$sql_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '".$_GET['code_boleto']."'");
	while($res_boleto = mysqli_fetch_array($sql_boleto)){
  ?>
  <tr>
    <td style="color:#CCC;"><? 
    $banco = $res_boleto['banco'];
	$codigo_barras = $res_boleto['codigo_barras'];
	
	
	$banco2 = 0;
	
	$sql_confere_fatura = mysqli_query($conexao_bd, "SELECT * FROM faturas_fechadas WHERE anexo_boleto = '$codigo_barras'");
	if(mysqli_num_rows($sql_confere_fatura) >= 1){
		$banco2 = "VESTEPRIME CARD";
	}
	
	$sql_verifica_credimais = mysqli_query($conexao_bd, "SELECT * FROM boletos_emprestimo_boleto WHERE codigo_barras = '$codigo_barras'");
	if(mysqli_num_rows($sql_verifica_credimais) >= 1){
		$banco2 = "CREDIMAIS";
	}
	
	if($banco2 == 0){

	$sql_banco = mysqli_query($conexao_bd, "SELECT * FROM lista_bancos WHERE codigo = '$banco'");
		while($res_banco = mysqli_fetch_array($sql_banco)){
				$banco2 = $res_banco['nome_banco'];
			}
	
	}
	
	
	
	 echo $banco2;
	
	
	?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor'],2,',','.'); ?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor']+$res_boleto['boleto_vencido']+$res_boleto['boleto_tarifado']+$res_boleto['boleto_impresso'],2,',','.'); ?></td>
    <td style="color:#FFF;">R$ <? echo number_format($res_boleto['valor_recebido'],2,',','.'); ?></td>
    <td><input style="font:30px Arial, Helvetica, sans-serif; background:#000; border-radius:15px; border:1px solid #ccc;  color:#F00; width:50px; text-align:center;" name="opcao" type="text" autofocus size="10"></td>
  </tr>
  <? } ?>
</table>
</form>
<hr style="color:#999; border:1px solid #333;" />
<? if(isset($_POST['opcao'])){ $code_boleto = $_GET['code_boleto'];

$opcao = $_POST['opcao'];

if($opcao == '1'){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET forma_processamento = 'MAQUINA DE PAGAMENTO', banco_processamento = 'BANCO DO BRASIL', tarifa_processamento = '0', operador_efetivado = '$operador', data_efetivado = '$data', comissao = '0', status = 'Efetivado', data_pagamento
 = '$data' WHERE code_boleto = '".$_GET['code_boleto']."'");
 
 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado efetivação do pagamento do boleto $code_boleto', '$url')");

 
	 echo "<script language='javascript'>window.location='?p=5&code_boleto=$code_boleto';</script>";	
}elseif($opcao == '2'){
mysqli_query($conexao_bd, "UPDATE pagamentoboletos SET status = 'Aguarda' WHERE code_boleto = '".$_GET['code_boleto']."'");

 	mysqli_query($conexao_bd, "INSERT INTO acoes_operador (data, data_completa, ip, operador, tipo, descricao, url) VALUES ('$data', '$data_completa', '$ip', '$operador', 'PAGAMENTO', 'Informado não efetivação do pagamento do boleto $code_boleto', '$url')");


	 echo "<script language='javascript'>window.location='?p=5&code_boleto=$code_boleto';</script>";	
}else{
	echo "<script language='javascript'>window.alert('Opção digitada não é válida!');</script>";
}
}?>
<? } ?>














<? if($_GET['p'] == '5'){ ?>
<h1 class="h11"><strong>PROCESSANDO PAGAMENTO</strong></h1>
  <script type="text/javascript">
      function redirectTime(){
         window.location = "?p=6&code_boleto=<? echo $_GET['code_boleto']; ?>&code_conjunto=<? echo $_GET['code_conjunto']; ?>"
      }
   </script>
   <body onLoad="setTimeout('redirectTime()', 2000)">
  
  <img class="imggg" src="img/gif_carregando.gif" width="115" height="60" /> 
  <h6 class="h66">Verificando informações e validando pagamento, aguarde...</h6>
  <hr />
  <img class="imggg22" src="img/redemaisvoce.jpg" width="100" height="50" />
  <h6 class="h66">Este pagamento é processado e credenciado por meio de uma parceria do BANCO DO BRASIL/BANCO RENDIMENTO e REDE MAIS VOCÊ.</h6><br />
  <img class="imggg2" src="img/bancodobrasil.jpg" width="100" height="20" />
  <img class="h656" src="img/logo_banco_rendimento.png" width="150" height="20" /><br />
<? } // fechamento do 5 ?>


<? if($_GET['p'] == '6'){ ?>
<h1><strong>PAGAMENTO ENVIADO PARA EFETIVAÇÃO COM SUCESSO!</strong></h1>
<table width="900" border="0" class="table">
  <tr>
    <td align="center" width="662"><br />
    
   	  <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    <form name=""><input class="comprovante" type="submit"  onclick="abrePopUp('scripts/comprovante_de_pagamento_de_titulos.php?code_boleto=<? echo $_GET['code_boleto']; ?>&code_conjunto=<? echo $_GET['code_conjunto']; ?>');" value="Imprimir comprovante de pagamento" autofocus/></form>
    </td>
    <td width="328" align="center" rowspan="3"><img class="pagamento_sucesso" src="img/bb_rendimento.png"></td>
  <?
  $novos_pontos = 0;
  $vestepoint = 0;
  $cliente = 0;
  $valor_boleto = 0;
  $banco_farovecido = 0;
  
  $busca_boleto = mysqli_query($conexao_bd, "SELECT * FROM pagamentoboletos WHERE code_boleto = '".$_GET['code_boleto']."'");
  	while($res_boleto = mysql_fetch_array($busca_boleto)){
		$cliente = $res_boleto['cliente'];
		$valor_boleto = $res_boleto['valor'];
		$banco_farovecido = $res_boleto['banco'];
	}
  
  
  $busca_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
  	while($res_cliente =  mysqli_fetch_array($busca_cliente)){
		
		$vestepoint = $res_cliente['vestepoint'];
		
		$categoria = $res_cliente['categoria'];
		if($categoria == 'black'){
			$novos_pontos = number_format($valor_boleto/2);
		}elseif($categoria == 'platinum'){
			$novos_pontos = number_format($valor_boleto/3);
		}elseif($categoria == 'gold'){
			$novos_pontos = number_format($valor_boleto/3.5);
		}else{
			$novos_pontos = number_format($valor_boleto/4);
		}	
		$vestepoint = $vestepoint+$novos_pontos;
	   }

		
		mysqli_query($conexao_bd, "INSERT INTO extratato_vestepoint (ip, dia, mes, ano, data, data_completa, status, tipo, cliente, descricao, operador, total, valor_transacao, novo_saldo) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', 'CREDITO', '$cliente', 'PAGAMENTO DE CONTAS', '$operador', '$novos_pontos', '$valor_boleto', '$vestepoint')");
		
		mysqli_query($conexao_bd, "UPDATE conta_corrente SET vestepoint = '$vestepoint' WHERE cliente = '$cliente'");
			
  
  
  
  ?>  
    

    
  </tr>
  <tr>
    <td>
    <ul class="lic">
     <li>O pagamento foi processado com sucesso, o comprovante de efetivação poderá ser retirado 24 horas após o vencimento no site da Rede Mais Você.</li>
     <li>O pagamento pode demorar até 5 dias úteis para ser compensado.</li>
     <li>Todos os pagamentos realizados após as 15 horas poderá ser efetivado somente no próximo dia útil.</li>
    </ul>
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } // fechamento do 6 ?>
</div><!-- box_pagamento_1 -->

<script type="text/javascript">
var telefone = new Spry.Widget.ValidationTextField("telefone", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true});
var vencimento = new Spry.Widget.ValidationTextField("vencimento", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
</script>
</body>
</html>