<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>VESTE PRIME - ELETRÔNICOS E ACESSÓRIOS</title>
<link href="css/gerar_revista.css" rel="stylesheet" type="text/css" />
<? require "conexao.php"; ?>
</head>

<body>
<div id="box_logo">
<h1 style="font:50px Arial, Helvetica, sans-serif; color:#0C0;"><strong>CATÁLOGO PARA REVENDA</strong></h1>
<img src="img/logo.png" />
<h1 style="font:20px Arial, Helvetica, sans-serif; color:#09C;"><strong>Eletrônicos e acessórios</strong></h1>
<hr />
<table width="931" border="0">
  <tr>
    <td width="380" rowspan="2"><img style="border-radius:10px;" src="img/veste_prime_card.jpg" width="380" height="220"></td>
    <td width="541"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>FÁCIL APROVAÇÃO! - CRÉDITO LIBERADO NA HORA</strong></h1></td>
  </tr>
  <tr>
    <td><p style="font:15px Arial, Helvetica, sans-serif; color:#099;"><strong>FAÇA JÁ O SEU CARTÃO E SOLICITE E PARCELE SUAS COMPRAS EM ATÉ 12X FIXAS</strong></p>
    <p><img src="https://http2.mlstatic.com/adesivo-5-unidades-mastercard-bandeira-carto-de-credito-D_NQ_NP_822188-MLB31701262934_082019-F.jpg" width="150"></p></td>
  </tr>
</table>
<img src="img/back_ground.png" width="950" height="1" />

<table width="950" style="text-align:left;" border="0">
  <tr>
    <td width="300">
    <img src="https://i1.wp.com/agroemdia.com.br/wp-content/uploads/2019/03/logo-bb-25-3-19.png?resize=800%2C447&ssl=1" width="300" height="150" />
    <img src="https://http2.mlstatic.com/D_NQ_NP_937652-MLB31669873060_082019-V.jpg" />
    </td>
    <td width="650"><p style="font:18px Arial, Helvetica, sans-serif; color:#0C3;"><strong>APROVEITE SUA VISITA A VESTE PRIME E PAGUE SUAS CONTAS!</strong></p>
    <p style="font:12px Arial, Helvetica, sans-serif;">Somos autorizados do Banco do Brasil para atuar como correspondente e prestar os seguintes serviços:</p>
    <ul style="float:left; font:15px Arial, Helvetica, sans-serif;">
      <li>Pagamento de contas</li>
      <li>Saques do Banco do Brasil</li>
      <li>Depósitos</li>
      <li>Abertura de Contas</li>
      <li>Empréstimo Pessoal</li>
      <li>Empréstimo Consignado</li>
      <li>Cartão de crédito</li>
      <li>Consórcios</li>
    </ul></td>
  </tr>
</table>
<img src="img/back_ground.png" width="950" height="1" />

<img src="img/todos_os_pagamentos.png" />

<img src="img/back_ground.png" width="950" height="1" />
<h1 style="font:15px Arial, Helvetica, sans-serif; color:#999;"><strong>Rua Capitão Inácio Prata - 2010 - Taiba - São Gonalo do Amarante - Ceará - Cep: 62670-000<br />
(85) 3315.6199 / 99158.7323 - Atendimento de 8 as 12 e das 15 as 17 de segunda a domingo.
</strong></h1>
</div><!-- box_logo -->


	<?
    $sql_menu = mysqli_query($conexao_bd, "SELECT * FROM menu_principal ORDER BY ordem ASC");
        while($res_menu = mysqli_fetch_array($sql_menu)){

    ?>
<div id="conterner_produto">
    <div id="box_produto">
    <img src="img/back_ground.png" width="950" height="1" />
    <h1 style="font:20px Arial, Helvetica, sans-serif; margin:10px;"><strong><? echo $res_menu['nome_categoria']; ?></strong></h1>
    <?
		
	$sql_subcategoria = mysqli_query($conexao_bd, "SELECT * FROM sub_categoria WHERE code_categoria = '".$res_menu['code_categoria']."' ORDER BY ordem ASC");
		while($res_subcategoria = mysqli_fetch_array($sql_subcategoria)){
    $sql_relacao = mysqli_query($conexao_bd, "SELECT * FROM relacao_produto_categoria WHERE code_sub_categoria = '".$res_subcategoria['code_subcategoria']."'");
        while($res_relacao = mysqli_fetch_array($sql_relacao)){
            $produto = $res_relacao['produto'];
            
            $sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$produto'");
                while($res_produto = mysqli_fetch_array($sql_produto)){		
    ?>		
    <table style="border:1px solid #CCC; text-transform:uppercase; text-align:center; border-radius:10px; height:250px; padding:0; float:left; margin:5px 5px 5px 5px; font:12px Arial, Helvetica, sans-serif;" width="300" border="0">
      <tr>
        <td align="center"><strong style="margin:0 0 0 3px; width:280px; float:left;"><? echo $res_produto['titulo_resumido']; ?></strong><br />
        <? 
		$imagem = $res_produto['foto'];
		list($largura_original, $altura_original) = getimagesize($imagem);
		
		$nova_largura = ($largura_original*(150+10))/$altura_original;
		
		$ratio = 5.5; // razão de proporcionalidade
		$largura_final = $largura_original/$ratio;
		$altura_final = $altura_original/$ratio;
		
		?>        
        <img style="border-radius:1px; border-radius:10px; margin:0 0 0 0;" src="<? echo $res_produto['foto']; ?>" width="<? echo $nova_largura; ?>" height="150" />
        <h1 style="font:17px Arial, Helvetica, sans-serif; color:#00F; margin:5px 0 0 0;"><strong>R$ <? echo number_format(($res_produto['valor_compra']*0.4)+$res_produto['valor_compra'],2,',','.'); ?></strong></h1>
        <h2 style="font:8px Arial, Helvetica, sans-serif; margin:0 0 0 0;">COD.<? echo $res_produto['code']; ?></h2>
      <? if($res_produto['estoque'] <=0){ ?>
        <h3 style="font:12px Arial, Helvetica, sans-serif; color:#F00; margin:0px 0 0 0;">Aguarda reposição de estoque</h3>
      <? }else{ ?>
       <h3 style="font:12px Arial, Helvetica, sans-serif; color:#0C0; margin:0px 0 0 0;">Quant. Disponível: <? echo $res_produto['estoque'];?></h3></td>
      </tr>      
      <? } ?>
    </table>
    <?	}}} ?>
    </div><!-- box_produto -->
    <? } ?>
</div><!-- conterner_produto -->
</body>
</html>