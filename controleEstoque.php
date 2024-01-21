<?

require "conexao.php";
$sql = mysqli_query($conexao_bd, "SELECT * FROM produtos");
	 while($res = mysqli_fetch_array($sql)){
		 
		  if($res['estoque'] <=0){
		 	
			mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '0' WHERE id = '".$res['id']."'");
			
		  }
	}
?>