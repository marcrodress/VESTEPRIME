<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/carrinho.css" rel="stylesheet" type="text/css" />

</head>

<body>
<? require "topo.php"; 

require "scripts/verificador_caixa.php";

//mysqli_query($conexao_bd, "UPDATE clientes SET atualizacao = 'CONTATO'");

?>

<div id="topo">
<div id="busca_produto">
<img src="img/linha.png" width="1000" height="5" />
<? if(isset($_POST['gos'])){

$key = $_POST['key'];
$quants = $_POST['quant'];

$puxa_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo'");
if(mysqli_num_rows($puxa_carrinho) == ''){
	$code_carrinho = rand();
	mysqli_query($conexao_bd, "INSERT INTO carrinho (codeCaixa, turno, ip, code_carrinho, hora_abertura, data, status, operador, code_dia, loja) VALUES ('$codeCaixa', '$turno', '$ip', '$code_carrinho', '$data_completa', '$data', 'Ativo', '$operador', '$code_vencimento_hoje', '$filial')");
}else{
	while($res_carrinho = mysqli_fetch_array($puxa_carrinho)){
		$cliente = $res_carrinho['cliente'];
		$code_carrinho = $res_carrinho['code_carrinho'];

$produto_associado = mysqli_query($conexao_bd, "SELECT * FROM codigos_associados WHERE codigo_barras = '$key' OR produto_original = '$key' LIMIT 1");
if(mysqli_num_rows($produto_associado) == ''){
	
$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$key' AND status = 'Ativo'");
if(mysqli_num_rows($sql_produto) == ''){
	echo "<script language='javascript'>window.alert('PRODUTO NÃO ENCONTRADO!');</script>";
}else{
	while($res_produto = mysqli_fetch_array($sql_produto)){
		
		$valor_venda = $res_produto['valor_venda'];
		$tipo = $res_produto['tipo'];
		$valor = ($valor_venda*$quants);
		$estoque = $res_produto['estoque'];
		$comissao = ($res_produto['comissao']*$quants);
		
		$valor_compra = $res_produto['valor_compra'];
		
		$titulo = $res_produto['titulo'];
		$subTipo = $res_produto['subTipo'];
		
		$codeProdutoPassivo = $res_produto['codeProdutoPassivo'];
		$marcaProdutoPassivo = $res_produto['marcaProdutoPassivo'];
		$modeloProdutoPassivo = $res_produto['modeloProdutoPassivo'];
	

	
	$sql_verifica_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_produto = '$key' AND ip = '$ip' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");
	if(mysqli_num_rows($sql_verifica_produto) == ''){ 
	
	 	mysqli_query($conexao_bd, "INSERT INTO produtos_caixa (codeCaixa, turno, ip, code_carrinho, dia, mes, ano, data_completa, data, status, cliente, operador, tipo, quant, valor, code_produto, desconto, comissao, code_dia, loja, valor_compra, valor_venda, titulo, subtipo, codeProdutoPassivo, marcaProdutoPassivo, modeloProdutoPassivo) VALUES ('$codeCaixa', '$turno', '$ip', '$code_carrinho', '$dia', '$mes', '$ano', '$data_completa', '$data', 'Ativo', '$cliente', '$operador', '$tipo', '$quants', '$valor', '$key', '', '$comissao', '$code_vencimento_hoje', '$filial', '$valor_compra', '$valor_venda', '$titulo', '$subTipo', '$codeProdutoPassivo', '$marcaProdutoPassivo', '$modeloProdutoPassivo')");

	}else{
		
			while($res_produto = mysqli_fetch_array($sql_verifica_produto)){
				$quant = $res_produto['quant']+$quants;
				$valor = ($res_produto['valor']*$quants)+$valor;
					
				mysqli_query($conexao_bd, "UPDATE produtos_caixa SET quant = '$quant', valor = '$valor' WHERE code_produto = '$key' AND ip = '$ip' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");	
								
			}
		
		}}}
	
	
	
}else{
	while($res_produto = mysqli_fetch_array($produto_associado)){
		$key = $res_produto['produto_original'];

$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$key' AND status = 'Ativo'");
if(mysqli_num_rows($sql_produto) == ''){
	echo "<script language='javascript'>window.alert('PRODUTO NÃO ENCONTRADO!');</script>";
}else{
	while($res_produto = mysqli_fetch_array($sql_produto)){
		
		$valor_venda = $res_produto['valor_venda'];
		$tipo = $res_produto['tipo'];
		$valor = ($valor_venda*$quants);
		$estoque = $res_produto['estoque'];
		$comissao = ($res_produto['comissao']*$quants);
		
		$valor_compra = $res_produto['valor_compra'];
		$valor_venda = $res_produto['valor_venda'];
		$titulo = $res_produto['titulo'];
		$subTipo = $res_produto['subTipo'];
		
		$codeProdutoPassivo = $res_produto['codeProdutoPassivo'];
		$marcaProdutoPassivo = $res_produto['marcaProdutoPassivo'];
		$modeloProdutoPassivo = $res_produto['modeloProdutoPassivo'];
		
	
	$sql_verifica_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE code_produto = '$key' AND ip = '$ip' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");
	if(mysqli_num_rows($sql_verifica_produto) == ''){ 
	 	mysqli_query($conexao_bd, "INSERT INTO produtos_caixa (codeCaixa, turno, ip, code_carrinho, dia, mes, ano, data_completa, data, status, cliente, operador, tipo, quant, valor, code_produto, desconto, comissao, code_dia, loja, valor_compra, valor_venda, titulo, subtipo, codeProdutoPassivo, marcaProdutoPassivo, modeloProdutoPassivo) VALUES ('$codeCaixa', '$turno', '$ip', '$code_carrinho', '$dia', '$mes', '$ano', '$data_completa', '$data', 'Ativo', '$cliente', '$operador', '$tipo', '$quants', '$valor', '$key', '', '$comissao', '$code_vencimento_hoje', '$filial', '$valor_compra', '$valor_venda', '$titulo', '$subTipo', '$codeProdutoPassivo', '$marcaProdutoPassivo', '$modeloProdutoPassivo')");
		
		$estoque = $estoque-$quants;
		

	}else{
		
			while($res_produto = mysqli_fetch_array($sql_verifica_produto)){
				$quant = $res_produto['quant']+$quants;
				$valor = ($res_produto['valor']*$quants)+$valor;
			    $comissao = ($res_produto['comissao']*$quants);
					
				mysqli_query($conexao_bd, "UPDATE produtos_caixa SET quant = '$quant', valor = '$valor', comissao = '$comissao' WHERE code_produto = '$key' AND ip = '$ip' AND status = 'Ativo' AND code_carrinho = '$code_carrinho'");	
				
				$estoque = $estoque-$quants;
				
			}
		
		}
	
	}
	
}
	}
	}
	}// fecha o while
 }
}?>
  <form name="" method="post" enctype="multipart/form-data">
    <span id="sprytextfield2">
    <input id="input1" style="background:#000; border:1px solid #666;" class="input1" type="text" name="key" />
    <input id="quant1" style="background:#000; border:1px solid #666;" class="input3" type="text" name="quant" value="1" />
    </span>
    <input class="input2" type="submit" name="gos" value=""  />
  </form>
  
    <script>
        document.addEventListener('keydown', function(event) {
            // Verifica se a tecla pressionada é "i"
            if (event.key === 'i' || event.key === 'I') {
                // Impede o comportamento padrão da tecla para evitar a inserção do "I" no input
                event.preventDefault();

                // Obtém o elemento de input pelo ID
                var input = document.getElementById('input1');

                // Define o foco no input
                input.focus();
            }
			
			if (event.key === 'q' || event.key === 'Q') {
                // Impede o comportamento padrão da tecla para evitar a inserção do "I" no input
                event.preventDefault();

                // Obtém o elemento de input pelo ID
                var input = document.getElementById('quant1');

                // Define o foco no input
                input.focus();
            }
			
			if (event.key === 'q' || event.key === 'Q') {
                // Impede o comportamento padrão da tecla para evitar a inserção do "I" no input
                event.preventDefault();

                // Obtém o elemento de input pelo ID
                var input = document.getElementById('quant1');

                // Define o foco no input
                input.focus();
            }
			
			if (event.key === 'p' || event.key === 'P') {
                // Redireciona para a página fecha_carrinho.php?p=
                window.location.href = 'fecha_carrinho.php?p=';
            }
			
			
        });
    </script>
  
 </div><!-- busca_produto -->
<img src="img/linha.png" width="1000" height="5" />
</div><!-- topo -->




<div id="box_corpo">
 <div id="box_cliente">
 <? 
 $sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE ip = '$ip' AND status = 'Ativo' AND cliente != ''");
 if(mysqli_num_rows($sql_carrinho) == ''){
 }else{
    while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
		$cpf_cliente = $res_carrinho['cliente'];
		
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cpf_cliente'");
	if(mysqli_num_rows($sql_cliente) == ''){
	}else{
		while($res_cliente = mysqli_fetch_array($sql_cliente)){
			
			$busca_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf_cliente'");
			while($res_nome = mysqli_fetch_array($busca_nome_cliente)){
				
				if($res_nome['atualizacao'] == 'CONTATO'){
					echo "<script language='javascript'>window.location='atualizacao_dados_cadastrais.php?cliente=$cpf_cliente&tipo=CONTATO';</script>";
				}
				
	
 ?>
 <? if($res_cliente['status'] == 'ATIVO'){ ?>
 <h1><strong>CRÉDITO PRÉ-APROVADO!</strong><span class="h1"> <strong>R$ 
 <? 
  
  $sql_emprestimo = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cpf_cliente'");
 	while($res_emprestimo = mysqli_fetch_array($sql_emprestimo)){
 		echo number_format($res_emprestimo['limite'],2,',','.');
 
 }}}}}}} 
 ?></strong>
 Em até 36X</span></h1>
 </div><!-- box_cliente -->
 
 <div id="box_compras">
 <?
 $verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE status = 'Ativo' AND ip = '$ip'");
 if(mysqli_num_rows($verifica_carrinho) == ''){
	echo "Não existe nenhum produto/serviço adicionado ao carrinho.";	 
 }else{
 $verifica_produtos_carrinho = mysqli_query($conexao_bd, "SELECT * FROM produtos_caixa WHERE status = 'Ativo' AND ip = '$ip'");
  ?>
  <table width="500" border="0">
  <tr>
    <td colspan="6"><strong>DESCRIÇÃO DO CARRINHO</strong></td>
  </tr>
  <tr>
    <td colspan="6"><hr /></td>
  </tr>
  <tr>
    <td width="42"><strong>ITEM</strong></td>
    <td width="48"><strong>COD.</strong></td>
    <td width="207"><strong>DESCRIÇÃO</strong></td>
    <td width="60"><strong>QUANT.</strong></td>
    <td width="58"><strong>V.UNIT.</strong></td>
    <td width="69"><strong>V.TOTAL</strong></td>
  </tr>
  <tr>
    <td colspan="6"><hr></td>
  </tr>
  <? 
  	$produtos = 0;
	$servicoes = 0;
	$item = 0;
	$valor_compras = 0;
  	while($res_produtos_carrinho = mysqli_fetch_array($verifica_produtos_carrinho)){ $item++;
	
	if($res_produtos_carrinho['tipo'] == 'PRODUTO'){
	$produtos++;
	}else{
	$servicoes++;
	}
	
	$valor_compras = $res_produtos_carrinho['valor']+$valor_compras;
	
  ?>
  <tr>
    <td height="29"><? echo $item; ?></td>
    <td><? echo $res_produtos_carrinho['code_produto']; ?></td>
    <td><? $code_produto = $res_produtos_carrinho['code_produto']; 
	
	$busca_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE status = 'Ativo' AND code = '$code_produto'");
		while($res_produto = mysqli_fetch_array($busca_produto)){
				echo $res_produto['titulo_resumido'];
			
	
	?></td>
    <td>
    
    <form name="" method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="code_produto" value="<? echo $res_produtos_carrinho['code_produto']; ?>" />
    <input type="hidden" name="code_carrinho" value="<? echo $res_produtos_carrinho['code_carrinho']; ?>" />
    <input type="hidden" name="quant_produto" value="<? echo $res_produtos_carrinho['quant']; ?>" />
    <input type="text" value="<? echo $res_produtos_carrinho['quant']; ?>" name="quant" width="2" />
    </form>
        
    </td>
    <td><? 
	
	$valor_venda = 0;
	if($filial == 'JERI'){
	$valor_venda = $res_produto['valor_venda2'];
	}else{
	$valor_venda = $res_produto['valor_venda'];
	}	
	
	echo number_format($valor_venda,2); ?></td>
    <td><? echo number_format($res_produtos_carrinho['valor'],2); ?></td>
  </tr>
  <? }} ?>
  
 <? if(isset($_POST['quant'])){ // code_produto 

  $quant = $_POST['quant'];
  $quant_produto = $_POST['quant_produto'];
  $code_carrinho = $_POST['code_carrinho'];
  $code_produto = $_POST['code_produto'];
 
 if($quant == $quant_produto){
	echo "<script language='javascript'>window.alert('NÃO HOUVE ALTERAÇÃO DE QUANTIDADE!');</script>";
 }else{
 if($quant == 0){
  	mysqli_query($conexao_bd, "DELETE FROM produtos_caixa WHERE code_produto = '$code_produto' AND code_carrinho = '$code_carrinho'");
	echo "<script language='javascript'>window.location='carrinho.php';</script>";
 }else{
	 
	  $busca_preco = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_produto'");
	  	while($res_preco = mysqli_fetch_array($busca_preco)){
			
				$valor = 0;
				if($filial == 'JERI'){
				$valor = $res_preco['valor_venda2'];
				}else{
				$valor = $res_preco['valor_venda'];
				}
			
			$estoque = $res_preco['estoque'];
			$comissao = ($res_preco['comissao']*$quant);
			
			$valor_produto = $valor*$quant;
			
			
			mysqli_query($conexao_bd, "UPDATE produtos_caixa SET quant = '$quant', valor = '$valor_produto', comissao = '$comissao' WHERE code_produto = '$code_produto' AND code_carrinho = '$code_carrinho'");
			
			
			
			
			if($quant_produto > $quant){
				$novo_estoque = $estoque+($quant_produto-$quant);
			}else{
				$novo_estoque = $estoque-$quant;
			}
			
			if($novo_estoque < 0){
				$novo_estoque = 0;
			}else{
				$novo_estoque = $novo_estoque;
			}
					

			echo "<script language='javascript'>window.location='carrinho.php';</script>";

		} // busca_preco
  	}
  }
 }?>  
  </table>
<? }// fecha a verificação do carrinho ?>
 </div><!-- box_compras -->
 
 <div id="valor_compras">
  <h1><strong>Valor: </strong> <strong class="strong3">R$ <? echo number_format($valor_compras,2); ?></strong></h1>
  <hr />
  <h2><strong>PRODUTOS:</strong> <? echo $produtos; ?> - <strong>SERVIÇOS:</strong> <? echo $servicoes; ?></h2>
 </div><!-- valor_compras -->
 
 <div id="avisos">
 <h1></h1>
 <ul>
   <li></li>
 </ul>
 </div>
</div>
<!-- box_corpo -->

<? require "rodape.php"; ?>
</body>
</html>