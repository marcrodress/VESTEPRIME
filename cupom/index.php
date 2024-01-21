<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CADASTRO NA PROMO&Ccedil;&Atilde;O</title>
<link href="indez.css" rel="stylesheet" type="text/css" />
<? require "../conexao.php"; ?>

</head>

<body>
<div id="box">
<img src="http://www.ikuly.com/caixa/img/index.png" width="180" height="110" /><img src="https://scontent.ffor28-1.fna.fbcdn.net/v/t1.6435-9/242047188_106757808421013_2642184278231497001_n.png?_nc_cat=108&amp;ccb=1-5&amp;_nc_sid=09cbfe&amp;_nc_eui2=AeGYjHucqZ3pEcgdb_8frN46gt9GqcG0V--C30apwbRX71Its0Qe3Z41eT_HoVglKhVKzRK438KyLk0MiuqKhgrG&amp;_nc_ohc=OHNQLo4s-50AX-sBG-N&amp;_nc_ht=scontent.ffor28-1.fna&amp;oh=5b7b51296a29ec5c29f3ff5dac8fd7f8&amp;oe=617D5311" width="132" height="110" /><br />
<?
	 $img = 0;
	 $titulo = 0;
	 $data_promocao = 0;
	 $codigo_promocao = 0;
	 $numero_cupom = 0;
	 
	 $sql_promocao = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom WHERE status = 'ATIVO'");
		 while($res_promocao = mysqli_fetch_array($sql_promocao)){
			 $img = $res_promocao['img'];
			 $titulo = $res_promocao['titulo'];
			 $data_promocao = $res_promocao['data_promocao'];
			 $codigo_promocao = $res_promocao['codigo_promocao'];
	 }
if($codigo_promocao == 0){
	echo "NÃO EXISTE PROMOÇÃO ATIVA NO MOMENTO.";
}else{
?>


<h2 style="font:30px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong><? echo $titulo; ?></strong><br /><img src="<? echo $img; ?>" alt="" width="400" height="343"/></h2><br />
    
    <h3 style="font:25px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#F00;"><strong>Data do sorteio: <? echo $data_promocao; ?></strong></h3>
<a target="_blank" href="http://www.vptravel.com.br/promocao/regulamento.pdf">Regulamento</a>



<? if($_GET['p'] == ''){ ?>
<h1 style="font:35px Arial, Helvetica, sans-serif; color:#09F;"><strong>Resgate de cupom</strong></h1><hr />

<form name="" method="post" action="" enctype="multipart/form-data">
<h1 style="font:25px Arial, Helvetica, sans-serif; margin:0; padding:0;"> <strong>Digite o código do cupom</strong></h1><br />
 <input style="font:30px Arial, Helvetica, sans-serif; text-align:center; text-transform:uppercase; padding:20px; height:40px; color:#F00; border-radius:5px; border:1px solid #000;" type="text" name="cupom" autofocus/><br /><br />
 <input style="font:20px Arial, Helvetica, sans-serif; padding:15px; color:000; border-radius:3px; border:1px solid #000;"type="submit" name="enviar" value="Avançar" />
</form><hr />

<? if(isset($_POST['enviar'])){

$cupom = strtoupper($_POST['cupom']);

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM promocao_cupom_gerador WHERE codigo_promocao = '$codigo_promocao' AND codigo_cupom = '$cupom' AND status = 'Aguarda'");
if(mysqli_num_rows($sql_verifica) == ''){
	echo "<script language='javascript'>window.alert('CUPOM PROMOCIONAL NÃO ENCONTRADO OU JÁ RESGATADO!');window.location='';</script>";
}else{
	$cupom = base64_encode($cupom);
	echo "<script language='javascript'>window.alert('CUPOM ENCONTRADO, AGORA PREENCHA SEUS DADOS DE CONTATO!');window.location='?p=2&cupom=$cupom';</script>";	
}
}?>

<? } // cadastro na promoção ?>




<? if($_GET['p'] == '2'){ ?>
<h1 style="font:30px Arial, Helvetica, sans-serif; color:#09F;"><strong>Preencha seus dados pessoais</strong></h1><hr />
<form name="" method="post" action="" enctype="multipart/form-data">
 <strong>Nome Completo:</strong><br />
 <input name="nome" type="text" id="nome" style="width:auto; border:1px solid #000; border-radius:3px; height:40px; padding:20px; color:#00F;" size="40" autofocus/><br />
 <strong>Telefone (inclua o DDD):</strong><br />
 <input name="telefone" type="text" id="telefone" style="width:auto; border:1px solid #000; border-radius:3px; height:40px; padding:20px; color:#00F;" maxlength="11" /><br />
 <strong>CPF:</strong><br />
 <input name="cpf" type="text" id="cpf" style="width:auto; border:1px solid #000; border-radius:3px; height:40px; padding:20px; color:#00F;" maxlength="11" /><br /><br />
 <input style="width:auto; border:1px solid #000; border-radius:3px; padding:15px; color:#00F;"  type="submit" name="validar" value="Validar" /> 
</form>
<? if(isset($_POST['validar'])){

$nome = strtoupper($_POST['nome']);
$telefone = $_POST['telefone'];
$cpf = $_POST['cpf'];
$cupom = base64_decode($_GET['cupom']);

$sql = mysqli_query($conexao_bd, "UPDATE promocao_cupom_gerador SET status = 'Ativo', nome = '$nome', telefone = '$telefone', cpf = '$cpf' WHERE codigo_cupom = '$cupom'");
if($sql == ''){
echo "<script language='javascript'>window.alert('Ocorreu um erro, por favor, tente novamente em alguns instantes!');window.location='';</script>";
}else{
echo "<script language='javascript'>window.alert('CUPOM RESGATADO COM SUCESSO, DESEJAMOS UMA BOA SORTE!');window.location='?p=';</script>";
}

}?>
<? } // cadastro na promoção ?>


<? } // verifica codigo promoçao ?>

</div><!-- box -->
</body>
</html>