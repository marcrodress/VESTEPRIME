<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>TERMO DE NEGOCIAÇÃO</title>
<style type="text/css">
body {
	background-color: #FFF;
	text-align:center;
	font:15px Arial, Helvetica, sans-serif;
	white-space:normal;
	line-height:1.8;
}
</style>
<? require "../conexao.php"; ?>
</head>

<body>
<?
$cliente = $_GET['cliente'];
$sql_clientes = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
while($res_cliente = mysqli_fetch_array($sql_clientes)){
?>
<table width="996" border="0">
  <tr>
    <td align="center"><img src="../img/logo.png" width="187" height="98" /></td>
  </tr>
  <tr>
    <td align="center"><h1 style="font:18px Arial, Helvetica, sans-serif;">&nbsp;</h1>
      <p style="font:18px Arial, Helvetica, sans-serif;">&nbsp;</p>
      <h1 style="font:18px Arial, Helvetica, sans-serif;"><strong>TERMO DE CONFISS&Atilde;O DE D&Iacute;VIDA E NEGOCIA&Ccedil;&Atilde;O DE D&Eacute;BITOS</strong></h1>
    <p style="font:18px Arial, Helvetica, sans-serif;">&nbsp;</p></td>
  </tr>
  <tr>
    <td align="justify">Eu, <strong><? echo strtoupper($res_cliente['nome']); ?></strong>, inscrito no CPF <? echo strtoupper($res_cliente['cpf']); ?> e RG <? echo strtoupper($res_cliente['rg']); ?>, residente e domiciliano na <? echo strtoupper($res_cliente['endereco']); ?>, <? echo strtoupper($res_cliente['n_residencia']); ?>,<? echo strtoupper($res_cliente['bairro']); ?> - <? echo strtoupper($res_cliente['cidade']); ?>, <? echo strtoupper($res_cliente['estado']); ?>, CEP: <? echo strtoupper($res_cliente['cep']); ?>, declaro que reconhe&ccedil;o minha d&iacute;vida no valor total de <strong>R$ <? echo number_format($_GET['valor'],2,',','.'); ?></strong> que a mim est&aacute; sendo apresentada e que me foi apresentado  todas as informa&ccedil;&otilde;es relativas ao meu d&eacute;bito e o todos os termos de negocia&ccedil;&atilde;o e que estou em pleno e total acordo com os termos descritos e a confiss&atilde;o de d&iacute;vida por mim assinada.</td>
  </tr>
  <tr>
    <td align="left">
    <br /><strong>Declaro que estou de acordo com os termos: </strong><ul>
     	  <li>A negocia&ccedil;&atilde;o se iniciar&aacute; quando for paga a primeira parcela descrita no termo de confiss&atilde;o de d&iacute;vida.</li>
     	  <li>Ap&oacute;s o in&iacute;cio desde acordo de pagamento, ser&atilde;o cobradas juros e multa em caso de atraso nas demais parcelas.</li>
     	  <li>O fim da negocia&ccedil;&atilde;o s&oacute; ser&aacute; findado ap&oacute;s a quita&ccedil;&atilde;o total deste termo de negocia&ccedil;&atilde;o.</li>
     	  <li>Estou ciente que em caso de mais de 60 (sessenta) dias de atraso, terei que arcar com todos os custos de uma nova negocia&ccedil;&atilde;o, al&eacute;m de ter a ci&ecirc;ncia que terei meu nome inscrito nos org&atilde;os de prote&ccedil;&atilde;o ao cr&eacute;dito.</li>
         </ul>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><p>&nbsp;</p>
      <p>_______________________, <? echo date("d"); ?> de
        <? $mes = date("m");
		
		if($mes == '1'){
			echo "janeiro";
		}elseif($mes == '2'){
			echo "fevereiro";
		}elseif($mes == '3'){
			echo "mar&ccedil;o";
		}elseif($mes == '4'){
			echo "abril";
		}elseif($mes == '5'){
			echo "maio";
		}elseif($mes == '6'){
			echo "junho";
		}elseif($mes == '7'){
			echo "julho";
		}elseif($mes == '8'){
			echo "agosto";
		}elseif($mes == '9'){
			echo "setembro";
		}elseif($mes == '10'){
			echo "outubro";
		}elseif($mes == '11'){
			echo "novembro";
		}else{
			echo "dezembro";
		}
	
	 ?>
 de <? echo date("Y"); ?></p>
      <p>&nbsp;</p>
      <p>&nbsp;</p>
      <p>______________________________________</p>
    <p><? echo strtoupper($res_cliente['nome']); ?></p>
    <p>CPF: <? echo strtoupper($res_cliente['cpf']); ?></p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>______________________________________</p>
    <p>Operador: Marcos Rodrigues de Oliveira</p></td>
  </tr>
</table>
<hr />

<table style="border:1px solid #000;" width="996" border="0">
  <tr>
    <td align="center"><p style="line-height:1.5;"><strong>VESTE PRIME</strong><br />CNPJ: 32.450.862/0001-02<br />
    Rua Capit&atilde;o In&aacute;cio Prata, 2010 - Ta&iacute;ba - S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br />
    CEP: 62670-000
    </p></td>
  </tr>
</table>
<? } ?>
<p>&nbsp;</p>
</body>
</html>