<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SORTEIO VESTE PRIME</title>
<style type="text/css">
body {
	background-color: #FFF;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
	padding:0;
	margin:0;
}
body table{
	font:12px Arial, Helvetica, sans-serif;
	padding:0;
	margin:0;
}
</style>
<? require "../conexao.php"; ?>
</head>

<body>
<script language="javascript">window.print();</script>

<? for($k=1; $k<=$_POST['quant']; $k++){ ?>


    <?
	 $img = 0;
	 $titulos_promo = 0;
	 $data_promocao = 0;
	 $codigo_promocao = 0;
	 $numero_cupom = 0;
	 
	 $p = $_GET['p'];
	 $sql_promocao = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom WHERE status = 'ATIVO'");
	 if(mysqli_num_rows($sql_promocao) == ''){
		 echo "NÃO EXISTE PROMOÇÃO ATIVA NO MOMENTO"; 
	 }else{ 
		 while($res_promocao = mysqli_fetch_array($sql_promocao)){ 
			 $img = $res_promocao['img'];
			 $titulos_promo = $res_promocao['titulo'];
			 $data_promocao = $res_promocao['data_promocao'];
			 $codigo_promocao = $res_promocao['codigo_promocao'];
		 }
	 }
	 
	 $i = 0;
	 $codigo_gerado = 0;
	 
	do{ 
		 
		 $codigo_total = md5(rand()+date("s"));
		 
		 $codigo_gerado1 = $codigo_total[0];
		 $codigo_gerado2 = $codigo_total[1];
		 $codigo_gerado3 = $codigo_total[2];
		 $codigo_gerado4 = $codigo_total[3];
		 $codigo_gerado5 = $codigo_total[4];
		 $codigo_gerado6 = $codigo_total[5];
		 $codigo_gerado7 = $codigo_total[7];
		 $codigo_gerado8 = $codigo_total[8];
		 
		 $codigo_gerado = strtoupper("$codigo_gerado1$codigo_gerado2$codigo_gerado3$codigo_gerado4$codigo_gerado5$codigo_gerado6$codigo_gerado7$codigo_gerado8");
		 
		 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador codigo_cupom = '$codigo_gerado'");
		 if(mysqli_num_rows($sql_verifica) == ''){
			 $i = 1;
		 }
		 
	 }while($i = 0);
	 
	 $codigo_gerado;
 	 $tipo_servico = $_POST['tipo_servico'];
	 $rands = rand()+date('s');
	 $tipo_servico = "$tipo_servico: $rands";
	 $tipo_servicos = "$tipo_servico: $rands";
	 
	 $sql_verifica_cupom = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_produto = '$tipo_servicos'");
	 if(mysqli_num_rows($sql_verifica_cupom) >= 1){ echo "OK";
	 }else{

	 $status = "Aguarda";
	 
     mysqli_query($conexao_bd, "INSERT INTO promocao_cupom_gerador (status, codigo_produto, tipo, codigo_promocao, codigo_cupom, nome, telefone, cpf) VALUES ('$status', '$codigo_produto', '$tipo_servico', '$codigo_promocao', '$codigo_gerado', '$nome', '$telefone', '$cliente')");

	?>
<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td><h9 style="font:25px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>CUPOM DE SORTEIO</strong></h9>
    </td>
  </tr>
  <tr>
    <td><img src="http://www.ikuly.com/caixa/img/index.png" width="121" height="80" /><img src="https://scontent.ffor28-1.fna.fbcdn.net/v/t1.6435-9/242047188_106757808421013_2642184278231497001_n.png?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=09cbfe&amp;_nc_eui2=AeGYjHucqZ3pEcgdb_8frN46gt9GqcG0V--C30apwbRX71Its0Qe3Z41eT_HoVglKhVKzRK438KyLk0MiuqKhgrG&amp;_nc_ohc=OHNQLo4s-50AX-sBG-N&amp;_nc_ht=scontent.ffor28-1.fna&amp;oh=5b7b51296a29ec5c29f3ff5dac8fd7f8&amp;oe=617D5311" width="80" height="80" /><br />
<br />
    <h9 style="font:18px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong><? echo date("d/m/Y H:i:s"); ?></strong></h9>
    </td>
  </tr>
  <tr>
    <td><h9 style="font:20px Arial, Helvetica, sans-serif; text-transform:uppercase; margin:0; padding:0;"><img src="../img/codigo_cupom.fw.png" width="300" height="35" /><br /><? echo $codigo_gerado; ?></h9><hr />
   </td>
  </tr>
  <tr>
    <td>
    <h12 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong><? echo $titulos_promo; ?></strong><br /><img style="border-radius:10px; border:1px solid #000;" src="<? echo $img; ?>" alt="" width="160" height="125"/></h12><br />
    <h9 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>Data do sorteio: <? echo $data_promocao; ?></strong></h9>
    <h9 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><img src="../img/produtos_promocao_sorteio.fw.png" width="300" height="35" /></h9>
    <p><? echo $tipo_servico; ?></p></td>
  </tr>
  <tr>
    <td align="center"><img src="../img/regras_sorteio.fw.png" width="300" height="35" />
      Use QR Code abaixo para participar:
    <img src="../cupom/QRCode_F&aacute;cil.jpg" width="100" height="100" /><strong></strong></td>
  </tr>
  <tr>
    <td><strong>PARA RESGATE DO PR&Ecirc;MIO, O CLIENTE DEVER&Aacute; PORTAR ESTE CUPOM JUNTAMENTE COM O DOCUMENTO DE IDENTIFICA&Ccedil;&Atilde;O.</strong></td>
  </tr>
  <tr>
    <td><img src="../img/validacao_compra.fw.png" width="300" height="35" /></td>
  </tr>
  <tr>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase;"><strong><? echo md5(rand()); ?></strong></h1></td>
  </tr>
</table>
<? }?>

<? } // tamanho do for ?>
</body>
</html>