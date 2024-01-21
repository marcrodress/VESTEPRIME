<?php

error_reporting(0);
ini_set("display_errors", 0 );

?>


<?
$conexao_bd = mysqli_connect("localhost","root","","caixa") or die(mysql_error());

//mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '0'");


// mysqli_query($conexao_bd, "UPDATE parcelas_capitalizacao SET status = 'Aguarda' WHERE mes = '04' AND ano = '2021'");

/*
$sql_cpf = mysqli_query($conexao_bd, "SELECT * FROM clientes_restricao_email");
 while($res_cpf = mysqli_fetch_array($sql_cpf)){
	 $cpf_cliente = $res_cpf['cliente'];
	 
	 mysqli_query($conexao_bd, "UPDATE conta_corrente SET fechamento = '-' WHERE cliente = '$cpf_cliente'");
	 
 }
*/ 
 
 
 

/*
$sql_cadastro = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_promocao = '1857329203' LIMIT 2000");
	while($res_cadastro = mysqli_fetch_array($sql_cadastro)){
		$cpf = 0;
		$id = 0;
		$cpf = $res_cadastro['cpf'];
		$id = $res_cadastro['id'];
		
		if($cpf == ''){
			mysqli_query($conexao_bd, "DELETE FROM promocao_cupom_gerador WHERE id = '$id'");
		}
		
	}
*/	


/*
for($i=0; $i<=600; $i++){
	mysqli_query($conexao_bd, "INSERT INTO promocao_cupom_gerador (status, codigo_produto, tipo, codigo_promocao, codigo_cupom, nome, telefone, cpf) VALUES ('Aguarda', '', '', '1857329203', '', '', '', '')");
}
*/

  //mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '0' WHERE titulo LIKE '%CELULAR TRANSPARENTE%'");
  //mysqli_query($conexao_bd, "DELETE FROM produtos WHERE estoque <=0 AND LIKE '%PELICULA%'");
  
   // mysqli_query($conexao_bd, "UPDATE boletos_emprestimo_boleto SET valor = '202.22' WHERE proposta = '365953877' AND cliente = '38433346334'");



 //mysqli_query($conexao_bd, "UPDATE conta_corrente SET juro_bandeirado = '5.99'");
 //mysqli_query($conexao_bd, "UPDATE conta_corrente SET fechamento = '18' WHERE vencimento = '28'");
 //mysqli_query($conexao_bd, "UPDATE conta_corrente SET proposta_credito = 'NEGADO', justificativa = 'DEVE SOLICITAR NOVA ANALISE DE CREDITO' WHERE status = 'CANCELDO'");

	$turno = 0;
	$data_completa = date("d/m/Y H:i:s");
	$data = date("d/m/Y");
	$dia = date("d");
	$d = date("d");
	$mes = date("m");
	$hora = date("H:i:s");
	$apenas_hora = date("H");
	$m = date("m");
	$ano = date("Y");
	$a = date("Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

	if($apenas_hora <13){
		$turno = "MANHA";
	}else{
		$turno = "TARDE";		
		}
	
	
$code_vencimento_hoje = 0;

$sql_code_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
while($res_code_vencimento = mysqli_fetch_array($sql_code_vencimento)){
	$code_vencimento_hoje = $res_code_vencimento['codigo'];
}		






?>
