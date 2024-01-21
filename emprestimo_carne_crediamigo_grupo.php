<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/emprestimo_carne_crediamigo_grupo.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<div id="box_pagamento_1">
<h1><strong>Crédito compartilhado - título único</strong></h1>
<hr />
<? if($_GET['p'] == ''){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <h2 style="font:12px Arial, Helvetica, sans-serif; margin:10px 10px 10px 5px;"><strong>Informe o total de integrantes</strong></h2>
 <select style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#CCC; border:1px solid #666; padding:10px;" autofocus name="integrantes" size="1">
   <option value="3">3 - Integrante</option>
   <option value="4">4 - Integrante</option>
   <option value="5">5 - Integrante</option>
   <option value="6">6 - Integrante</option>
   <option value="7">7 - Integrante</option>
   <option value="8">8 - Integrante</option>
   <option value="9">9 - Integrante</option>
   <option value="10">10 - Integrante</option>
 </select>
 <input style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#CCC; border:1px solid #666; padding:10px;" type="submit" name="avanca" value="Avançar" />
</form>
<? if(isset($_POST['avanca'])){
	
$integrantes = $_POST['integrantes'];
$n_proposta = rand()*date("s");

echo "<script language='javascript'>window.location='?p=2&integrantes=$integrantes&n_proposta=$n_proposta&int=1';</script>";

}?>
<br />
<? } // pagina que não exibe nada ?>




<? if($_GET['p'] == '2'){
	
$integrantes = $_GET['integrantes'];
$n_proposta = $_GET['n_proposta'];
$int = $_GET['int'];	

if($int > $integrantes){
echo "<script language='javascript'>window.location='?p=3&n_proposta=$n_proposta';</script>";
}

?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <h2 style="font:12px Arial, Helvetica, sans-serif; margin:10px;"><strong>Informe o CPF <? echo $_GET['int'];  ?>º integrante <? if($_GET['int'] == 1){ echo " - LIDER DO GRUPO"; } ?></strong></h2>
 <input name="cpf" type="text" style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#CCC; border:1px solid #666; text-align:center; padding:10px; border-radius:3px;" maxlength="11" autofocus />
 <input style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#999; border:1px solid #CCC; padding:10px; border-radius:3px;" type="submit" name="avanca" value="Avançar" />
</form>
<? if(isset($_POST['avanca'])){

$cpf = $_POST['cpf'];
$integrantes = $_GET['integrantes'];
$n_proposta = $_GET['n_proposta'];
$int = $_GET['int'];


if($cpf == ''){
echo "<script language='javascript'>window.alert('Por favor, informe o CPF do cliente!');</script>";
}else{
$verifica_se_cliente_ja_tem = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta' AND cliente = '$cpf'");
 if(mysqli_num_rows($verifica_se_cliente_ja_tem) >= 1){
   echo "<script language='javascript'>window.alert('CLIENTE JÁ FOI ADICIONADO A ESTE GRUPO EM FORMAÇÃO!');</script>";	   
 }else{
  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf'");
   if(mysqli_num_rows($sql_verifica) == ''){
	echo "<script language='javascript'>window.alert('Cliente não encontrado, verifique o CPF digitado!');</script>";	   
   }else{
	   while($res_cpf = mysqli_fetch_array($sql_verifica)){
		   $status = $res_cpf['status'];
		   
		   if($status == 'CANCELADO'){
			echo "<script language='javascript'>window.alert('A STUAÇÃO DO CLIENTE NÃO PERMITE SOLICITAR CRÉDITO, USE O CÓDIGO 412 PARA RESOLVER A PENDÊNCIA!');</script>";	   
		   }else{

			   $sql_verifica_AGUARDA = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE cliente = '$cpf' AND status = 'AGUARDA'"));	
			   $sql_verifica_APROVADO = mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE cliente = '$cpf' AND status = 'APROVADO'"));	
				
			   if($sql_verifica_AGUARDA >= 1){
				echo "<script language='javascript'>window.alert('CLIENTE JÁ POSSUI UMA SIMULAÇÃO DE CRÉDITO, CANCELE OU CONCLUA A SIMULAÇÃO REALIZADA ANTERIORMENTE!');</script>";
			   }elseif($sql_verifica_APROVADO >= 1){
				echo "<script language='javascript'>window.alert('CLIENTE JÁ POSSUI EMPRÉSTIMO ATIVO, O CLIENTE SÓ PODE SOLICITAR UM NOVO EMPRÉSTIMO APÓS QUITAR O PRIMEIRO!');</script>";
			   }else{
				 mysqli_query($conexao_bd, "INSERT INTO emprestimo_distribuicao_clientes (n_proposta, data, data_completa, dia, mes, ano, ip, operador, status, valor, juros, tarifa, quant_parcela, valor_parcela, valor_total, cliente, int_integrante, cpf_conta, nome_conta, tipo_conta, agencia, n_conta, banco) VALUES ('$n_proposta', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'AGUARDA', '', '', '', '', '', '', '$cpf', '".$_GET['int']."', '', '', '', '', '', '')");
				 
				 if($int == 1){
					 mysqli_query($conexao_bd, "INSERT INTO emprestimo_boleto_unico (n_proposta, data, data_completa, dia, mes, ano, ip, operador, status, valor, juros, tarifa, quant_parcela, valor_parcela, valor_total, vencimento, cpf, contrato, sit_liberacao) VALUES ('$n_proposta', '$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$operador', 'SIMULACAO', '', '', '', '', '', '', '', '$cpf', '', '')");
				 }
				 
				 
				 $int++;
					echo "<script language='javascript'>window.location='?p=2&integrantes=$integrantes&n_proposta=$n_proposta&int=$int';</script>";
				 
			   }			   
			   
		   } // VERIFIQUE SE O CPF DO CLIENTE ESTÁ ATIVO
		   
	   }
   }
	
 } // verifica se o cliente já foi adicionado
}

}?>

<? } // DEFINE OS CLIENTES ?>




<? if($_GET['p'] == '3'){ ?>
<form name="" method="post" action="" enctype="multipart/form-data">
 <h2 style="font:12px Arial, Helvetica, sans-serif; margin:10px;"><strong>Informe a data de vencimento para gerar o boleto</strong></h2>
 <select autofocus style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#CCC; border:1px solid #666; padding:10px;" name="vencimento" size="1">
   <option value="1">1</option>
   <option value="3">3</option>
   <option value="5">5</option>
   <option value="7">7</option>
   <option value="9">9</option>
   <option value="11">11</option>
   <option value="13">13</option>
   <option value="15">15</option>
   <option value="17">17</option>
   <option value="21">21</option>
   <option value="23">23</option>
   <option value="25">25</option>
   <option value="27">27</option>
   <option value="29">29</option>
 </select>
 <input style="font:12px Arial, Helvetica, sans-serif; background:#000; color:#CCC; border:1px solid #666; padding:10px;" type="submit" name="avanca" value="Avançar" />
</form>
<? if(isset($_POST['avanca'])){

$vencimento = $_POST['vencimento'];
$n_proposta = $_GET['n_proposta'];


mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET vencimento = '$vencimento' WHERE n_proposta = '$n_proposta'");

echo "<script language='javascript'>window.location='?p=5&n_proposta=$n_proposta';</script>";


}?>




<? } ?>










<? if($_GET['p'] == '5'){ ?>
<table width="1000" class="table" border="0">
  <tr>
    <td width="73" bgcolor="#003366"><strong>STATUS</strong></td>
    <td width="116" bgcolor="#003366"><strong>CPF</strong></td>
    <td width="239" bgcolor="#003366"><strong>NOME</strong></td>
    <td width="72" bgcolor="#003366"><strong>VALOR</strong></td>
    <td width="55" bgcolor="#003366"><strong>JUROS</strong></td>
    <td width="64" bgcolor="#003366"><strong>TARIFA</strong></td>
    <td width="78" bgcolor="#003366"><strong>N° PARCELA</strong></td>
    <td width="82" bgcolor="#003366"><strong>VL. PARCELA</strong></td>
    <td width="73" bgcolor="#003366"><strong>VL. TOTAL</strong></td>
    <td width="106" bgcolor="#003366">&nbsp;</td>
  </tr>
<?

$n_proposta = $_GET['n_proposta'];

$sql_emprestimos = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta'");
while($res_emprestimos = mysqli_fetch_array($sql_emprestimos)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#666'"; }else{ echo "bgcolor='#999'"; } ?>>
    <td><? echo $res_emprestimos['status']; ?></td>
    <td><? echo $res_emprestimos['cliente']; ?></td>
    <td>
	<? 
		$sqlcliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res_emprestimos['cliente']."'");
			while($res_cliente = mysqli_fetch_array($sqlcliente)){
				echo $res_cliente['nome'];
			}
	?>
    </td>
    <td>R$ <? $valor = $valor+$res_emprestimos['valor']; echo number_format($res_emprestimos['valor'],2,',','.'); ?></td>
    <td><? echo $res_emprestimos['juros']; ?>%</td>
    <td><? echo $res_emprestimos['tarifa']; ?></td>
    <td><? echo $quant_parcela = $res_emprestimos['quant_parcela']; ?></td>
    <td>R$ <? $valor_parcela = $valor_parcela+$res_emprestimos['valor_parcela']; echo number_format($res_emprestimos['valor_parcela'],2,',','.'); ?></td>
    <td>R$ <? $valor_total = $valor_total+$res_emprestimos['valor_total']; echo number_format($res_emprestimos['valor_total'],2,',','.'); ?></td>
    <td>
    <a rel="superbox[iframe][450x420]" href="scripts/simulacao_grupo_unico.php?n_proposta=<? echo $_GET['n_proposta']; ?>&cliente=<? echo $res_emprestimos['cliente']; ?>&id=<? echo $res_emprestimos['int_integrante']; ?>"><img src="img/simulador.png" width="25" height="25" border="0" title="Simular empréstimo"></a>
    
    <a rel="superbox[iframe][450x350]" href="scripts/dados_bancarios.php?n_proposta=<? echo $_GET['n_proposta']; ?>&cliente=<? echo $res_emprestimos['cliente']; ?>&id=<? echo $res_emprestimos['id']; ?>"><img src="img/DINHEIRO_ICO.png" width="25" height="25" border="0" title="Informar dados bancários" /></a>
    
    <? if(mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '".$_GET['n_proposta']."'")) > 3){ ?>
    <a href="?p=3&n_proposta=<? echo $_GET['n_proposta']; ?>&pg=excluir&id=<? echo $res_emprestimos['id']; ?>"><img src="img/deleta.jpg" width="20" height="20" border="0" title="Excluir cliente"></a>
    <? } ?>
    
    </td>
  </tr>
<? } ?>
  <tr>
    <td colspan="3">&nbsp;</td>
    <td bgcolor="#333333">R$
      <? echo number_format($valor,2,',','.'); ?></td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td bgcolor="#333333">R$
      <? echo number_format($valor_parcela,2,',','.'); ?></td>
    <td bgcolor="#333333">R$ <? echo number_format($valor_total,2,',','.'); ?></td>
    <td>&nbsp;</td>
    </tr>
  <tr>
  
  <?
  
   $n_proposta = $_GET['n_proposta'];
  
   $sql_atualiza_dados  = mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET valor = '$valor', quant_parcela = '$quant_parcela', valor_parcela = '$valor_parcela', valor_total = '$valor_total' WHERE n_proposta = '$n_proposta'");
  
  ?>
  
    <td colspan="10"><br />
    
    <a style="font:12px Arial, Helvetica, sans-serif; padding:10px; text-decoration:none; color:#FFF; background:#000; border:2px solid #666; margin:10px;" href="?pg=verifica_avancar&n_proposta=<? echo $n_proposta ?>" title="Concretizar proposta">Avan&ccedil;ar</a>


      <script language="JavaScript" type="text/javascript">
        function confirmacao(id) {
             var resposta = confirm("Uma vez cancelado, não será possível reativar a proposta. Você confirma o cancelamento?");
         
             if (resposta == true) {
                  window.location.href = "?p=excluir_simulacao&n_proposta="+id;
             }
        }
        </script>
    <a href="javascript:func()" onclick="confirmacao('<? echo $n_proposta ?>')" style="font:12px Arial, Helvetica, sans-serif; padding:10px; text-decoration:none; color:#FFF; background:#003; border:1px solid #CCC; margin:10px;" title="Cancelar proposta e excluir simulação">Cancelar</a>
    
    <br /><br /></td>
    </tr>
</table>
 
<? } // DEFINE OS LIMITES ?>
<br />
</div><!-- box_pagamento_1 -->
</body>
</html>

<? if($_GET['pg'] == 'verifica_avancar'){

$n_proposta = $_GET['n_proposta'];

$sql_verifica_contas = mysqli_query($conexao_bd, "SELECT * FROM emprestimo_distribuicao_clientes WHERE n_proposta = '$n_proposta' AND n_conta = ''");
if(mysqli_num_rows($sql_verifica_contas) >= 1){
echo "<script language='javascript'>window.alert('É necessário informar a conta para recebimento de crédito de todos os integrantes!');window.location='?p=5&n_proposta=$n_proposta';</script>";
}else{
}
echo "<script language='javascript'>window.location='resultado_emprestimo_carne_grupo.php?p=2&n_proposta=$n_proposta';</script>";
}?>




<? if($_GET['pg'] == 'excluir'){

$n_proposta = $_GET['n_proposta'];
$id = $_GET['id'];

mysqli_query($conexao_bd, "DELETE FROM emprestimo_distribuicao_clientes WHERE id = '$id'");

echo "<script language='javascript'>window.location='?p=5&n_proposta=$n_proposta';</script>";

}?>





<? if($_GET['p'] == 'excluir_simulacao'){

$n_proposta = $_GET['n_proposta'];

mysqli_query($conexao_bd, "UPDATE emprestimo_distribuicao_clientes SET status = 'CANCELADO' WHERE n_proposta = '$n_proposta'");
mysqli_query($conexao_bd, "UPDATE emprestimo_boleto_unico SET status = 'CANCELADO' WHERE n_proposta = '$n_proposta'");

echo "<script language='javascript'>window.location='carrinho.php';</script>";

}?>