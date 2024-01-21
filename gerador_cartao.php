<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<?

require "conexao.php";

$sql_puxa_cliente  = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente");
if(mysqli_num_rows($sql_puxa_cliente) == ''){
	echo "NÃO GEROU";
}else{
?>
        <table width="944" border="0">
          <tr>
            <td width="38" bgcolor="#0099CC"><strong>N&ordm;</strong></td>
            <td width="477" bgcolor="#0099CC"><strong>NOME DO CLIENTE</strong></td>
            <td width="259" bgcolor="#0099CC"><strong>NÚMERO IMPRESSO NO CARTÃO</strong></td>
            <td width="152" bgcolor="#0099CC"><strong>CLIENTE DESDE</strong></td>
          </tr>
          <?
		  $i = 0;
			while($res_cliente = mysqli_fetch_array($sql_puxa_cliente)){
			 $cpf_cliente = $res_cliente['cliente'];
			 					$cartao = $res_cliente['cartao'];
			 					$cliente_desde = $res_cliente['data'];

			 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
				while($res_nome = mysqli_fetch_array($sql_cliente)){ $i++;				 	
		  ?>
			<tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
            <td><? echo $i; ?></td>
            <td><? echo strtoupper($res_nome['nome']); ?></td>
            <td><? 
					
					
					echo $cartao[0]; 
					echo $cartao[1]; 
					echo $cartao[2]; 
					echo $cartao[3]; 
					echo "&nbsp;&nbsp";
					echo $cartao[4]; 
					echo $cartao[5]; 
					echo $cartao[6]; 
					echo $cartao[7]; 
					echo "&nbsp;&nbsp";
					echo $cartao[8]; 
					echo $cartao[9]; 
					echo $cartao[10]; 
					echo $cartao[11]; 	
					echo "&nbsp;&nbsp";
					echo $cartao[12]; 
					echo $cartao[13]; 
					echo $cartao[14]; 
					echo $cartao[15]; 				
				?></td>
            <td>
			<? 
			echo $cliente_desde[3];
			echo $cliente_desde[4];
			echo "/";
			echo $cliente_desde[6];
			echo $cliente_desde[7];
			echo $cliente_desde[8];
			echo $cliente_desde[9];
			?></td>
          </tr>
         <? }} ?>
        </table>
<? } ?>
</body>
</html>