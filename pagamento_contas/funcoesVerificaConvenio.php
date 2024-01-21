<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<?

require "funcoesVerificaBoleto.php";

function limpaCodigo($codigo_barras){
	
	$codigo_barras = str_replace('-', '', $codigo_barras);
	$codigo_barras = str_replace(' ', '', $codigo_barras);
	
	return $codigo_barras;


}

function formataCodigo($codigo_barras){
	
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

return $codigo_barras;
	
}


function retornaIndiceCodigoConvenio($codigo_barras){
	
	$codigo = limpaCodigo($codigo_barras);
	return $codigo[1];
	
}

function retornaNomeConvenio($codigo){

	require "../conexao.php";

	
	$sqlNomeConvenio = mysqli_query($conexao_bd, "SELECT * FROM tipos_convenio WHERE codigo = '$codigo'");
	$contaConvenio = mysqli_num_rows($sqlNomeConvenio);
	if($contaConvenio == ''){
		return "NÃO IDENTIFICADO";
	}else{
		while($resNomeConvenio = mysqli_fetch_array($sqlNomeConvenio)){
			return $resNomeConvenio['convenio'];
		}
	}
}

function verificaRegistricaoConvenio($codigo){
	
	require "../conexao.php";
	
	$sqlNomeConvenio = mysqli_query($conexao_bd, "SELECT * FROM tipos_convenio WHERE codigo = '$codigo' AND restrincao_data = 'SIM'");
	if(mysqli_num_rows($sqlNomeConvenio) >= 1){
			return true;
	}else{
			return false;
		}
}


function retornaCodigoConvenio($codigo_barras){
	
	$codigo = limpaCodigo($codigo_barras);
	
	$verifica_convenio1 = $codigo[17];
	$verifica_convenio2 = $codigo[18];
	$verifica_convenio3 = $codigo[19];
	$verifica_convenio4 = $codigo[20];
	
	return ("$verifica_convenio1$verifica_convenio2$verifica_convenio3$verifica_convenio4");
	
}

function retornaValorConvenio($codigo_barras){

	$codigo = limpaCodigo($codigo_barras);

	$valor2 = $codigo[8];
	$valor3 = $codigo[9];
	$valor4 = $codigo[10];
	$valor5 = $codigo[12];
	$valor6 = $codigo[13];
	$valor7 = $codigo[14];
	$valor8 = $codigo[15];
	$valor9 = $codigo[16];

	return $valor = ("$valor2$valor3$valor4$valor5$valor6.$valor7$valor8")+0;
	
}


function retornaDataVencimento($codigo_barras){
	
	$codigo_barras = limpaCodigo($codigo_barras);
	
	
	
	$dia_vencimento1 = $codigo_barras[27];
	$dia_vencimento2 = $codigo_barras[28];
	
	$mes_vencimento1 = $codigo_barras[25];
	$mes_vencimento2 = $codigo_barras[26];
	
	$ano_vencimento1 = $codigo_barras[29];
	$ano_vencimento2 = $codigo_barras[30];
	$ano_vencimento3 = $codigo_barras[31];
	$ano_vencimento4 = $codigo_barras[32];	
	

	return $data_venciemento = "$dia_vencimento1$dia_vencimento2/$mes_vencimento1$mes_vencimento2/$ano_vencimento1$ano_vencimento2$ano_vencimento3$ano_vencimento4";
	

}

?>