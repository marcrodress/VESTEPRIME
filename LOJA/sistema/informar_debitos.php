<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/informar_debitos.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_cad_produto">
<p>


<? if($_GET['acao'] == '3'){ ?>


<? if(isset($_POST['button'])){
	
$data = $_POST['data_ocorrencia'];
$descricao = $_POST['descricao'];
$finalidade = $_POST['finalidade'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$compra = $_POST['compra'];
$forma_pagamento = $_POST['forma_pagamento'];
$banco_emissor = $_POST['banco_emissor'];
$nome_cartao = $_POST['nome_cartao'];
$n_cheque = $_POST['n_cheque'];
$valor = $_POST['valor'];
$banco_beneficiario = $_POST['banco_beneficiario'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$agencia = $_POST['agencia'];
$numero_conta = $_POST['numero_conta'];

$code_debito = rand();

$dia1 = $data[0];
$dia2 = $data[1];

$mes1 = $data[3];
$mes2 = $data[4];

$ano1 = $data[6];
$ano2 = $data[7]; 
$ano3 = $data[8]; 
$ano4 = $data[9]; 

$dia = "$dia1$dia2";
$mes = "$mes1$mes2";
$ano = "$ano1$ano2$ano3$ano4";


mysql_query("UPDATE debitos SET descricao = '$descricao', finalidade = '$finalidade', beneficiario = '$nome', cpf = '$cpf', endereco = '$endereco', compra = '$compra', valor = '$valor', forma_pagamento = '$forma_pagamento', banco_emissor = '$banco_emissor', nome_cartao = '$nome_cartao', n_cheque = '$n_cheque', banco_beneficiario = '$banco_beneficiario', tipo_conta = '$tipo_conta', agencia = '$agencia', numero_conta = '$numero_conta' WHERE code_debito = '".$_GET['code_debito']."'");

mysql_query("UPDATE fluxo_de_caixa SET descricao = '$descricao', forma_recebimento = '$forma_pagamento', bandeira_cartao = '$nome_cartao', tipo_cartao = '$nome_cartao', valor = '$valor' WHERE code_transacao = '".$_GET['code_debito']."'");

echo "<script language='javascript'>window.alert('Informação atualizadas com sucesso!');window.location='?pack=informar_debitos';</script>";


}?>

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">INFORMA&Ccedil;&Otilde;ES B&Aacute;SICAS</li>
    <li class="TabbedPanelsTab" tabindex="0">INFORMA&Ccedil;&Otilde;ES BENEFICI&Aacute;RIO</li>
    <li class="TabbedPanelsTab" tabindex="0">FORMA DE PAGAMENTO</li>
</ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <?
    $sql_update = mysql_query("SELECT * FROM debitos WHERE code_debito = '".$_GET['code_debito']."'");
		while($res_update = mysql_fetch_array($sql_update)){
	?>
    <form name="" method="post" action="" enctype="multipart/form-data">
      <table width="1000" border="0">
        <tr>
          <td width="144"><strong>DATA</strong></td>
          <td><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
          <td width="374"><strong>FINALIDADE</strong></td>
          <td width="107">&nbsp;</td>
        </tr>
        <tr>
          <td><span id="sprytextfield1">
          <input name="data_ocorrencia" type="text" id="data2" value="<? echo $res_update['data']; ?>" size="20" />
          <span class="textfieldInvalidFormatMsg">.</span></span></td>
          <td><label for="descricao"></label>
            <span id="sprytextfield3">
              <input name="descricao" type="text" id="descricao" size="85" value="<? echo $res_update['descricao']; ?>" />
            </span>            <label for="forma_pagamento"></label></td>
          <td><label for="finalidade"></label>
            <select name="finalidade" size="1" id="finalidade">
              <option value="<? echo $res_update['finalidade']; ?>"><? echo $res_update['finalidade']; ?></option>
              <option value=""></option>
              <option value="DEBITOS DE REFORMA">DEBITOS DE REFORMA</option>
              <option value="COMPRA DE PRODUTOS" selected="selected">COMPRA DE PRODUTOS</option>
              <option value="PERDA">PERDA</option>
              <option value="DOA&Ccedil;&Atilde;O">DOA&Ccedil;&Atilde;O</option>
              <option value="OUTROS">OUTROS</option>
            </select></td>
          <td><input class="input" type="submit" name="button" id="button" value="ENVIAR" /></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="1000" border="0">
        <tr>
          <td width="153"><strong>NOME DO BENEFICIARIO</strong></td>
          <td width="126"><strong>CPF/CNPJ</strong></td>
          <td width="346"><strong>ENDERE&Ccedil;O</strong></td>
          <td width="172"><strong>COMPRA</strong></td>
          <td width="169">&nbsp;</td>
        </tr>
        <tr>
          <td><span id="sprytextfield2">
            <label for="nome"></label>
            <input type="text" name="nome" id="nome" value="<? echo $res_update['finalidade']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><span id="sprytextfield4">
            <label for="cpf"></label>
            <input type="text" name="cpf" id="cpf" value="<? echo $res_update['cpf']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><span id="sprytextfield5">
            <label for="endereco"></label>
            <input type="text" name="endereco" id="endereco" value="<? echo $res_update['endereco']; ?>" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><label for="compra"></label>
            <select name="compra" size="1" id="compra">
              <option value="<? echo $res_update['compra']; ?>"><? echo $res_update['compra']; ?></option>
              <option value=""></option>
              <option value="PRESENCIAL">PRESENCIAL</option>
              <option value="INTERNET">INTERNET</option>
              <option value="TELEFONE">TELEFONE</option>
              <option value="OUTROS">OUTROS</option>
            </select></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="1100" border="0">
        <tr>
          <td align="center" width="200"><strong>VALOR</strong></td>
          <td width="206"><strong>FORMA DE PAGAMENTO</strong></td>
          <td width="203"><strong>BANCO EMISSOR</strong></td>
          <td width="200"><strong>NOME DO CART&Atilde;O</strong></td>
          <td width="138"><strong>N&ordm; DO CHEQUE</strong></td>
          <td width="127"><strong>BANCO BENEFICI&Aacute;RIO</strong></td>
        </tr>
        <tr>
          <td align="center"><label for="valor"></label>
            <input name="valor" type="text" id="valor" value="<? echo $res_update['valor']; ?>" size="5" /></td>
          <td><select name="forma_pagamento" size="1" id="forma_pagamento">
            <option value="<? echo $res_update['forma_pagamento']; ?>"><? echo $res_update['forma_pagamento']; ?></option>
            <option value=""></option>
            <option value="DINHEIRO">DINHEIRO</option>
            <option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
            <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
            <option value="CHEQUE">CHEQUE</option>
            <option value="TRANSFERENCIA BANCARIA">TRANSFERENCIA BANCARIA</option>
            <option value="BOLETO">BOLETO</option>
            <option value="DEP&Oacute;SITO BANCARIO">DEP&Oacute;SITO BANCARIO</option>
          </select></td>
          <td><label for="banco_emissor"></label>
            <select name="banco_emissor" size="1" id="banco_emissor">
            <option value="<? echo $res_update['banco_emissor']; ?>"><? echo $res_update['banco_emissor']; ?></option>            
              <option value=""></option>
              <option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
              <option value="ITAU">ITAU</option>
              <option value="BRADESCO">BRADESCO</option>
              <option value="SANTANDER">SANTANDER</option>
              <option value="INTER">INTER</option>
              <option value="CAIXA ECON&Ocirc;MICA FEDERAL">CAIXA ECON&Ocirc;MICA FEDERAL</option>
            </select></td>
          <td><label for="nome_cartao"></label>
            <select name="nome_cartao" size="1" id="nome_cartao">
            <option value="<? echo $res_update['nome_cartao']; ?>"><? echo $res_update['nome_cartao']; ?></option>            
              <option value=""></option>            
              <option value="OUROCARD">OUROCARD</option>
              <option value="C&amp;A VISA">C&amp;A VISA</option>
              <option value="RIACHUELO VISA">RIACHUELO VISA</option>
              <option value="ELO BRADESCO">ELO BRADESCO</option>
            </select></td>
          <td><label for="n_cartao"></label>
            <input name="n_cheque" type="text" id="n_cheque" size="5" value="<? echo $res_update['n_cheque']; ?>" /></td>
          <td><input name="banco_beneficiario" type="text" id="banco_beneficiario" value="<? echo $res_update['banco_beneficiario']; ?>" size="15" /></td>
        </tr>
        <tr>
          <td><strong>TIPO DE CONTA</strong></td>
          <td><strong>AG&Ecirc;NCIA</strong></td>
          <td><strong>NUMERO DA CONTA</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label for="tipo_conta"></label>
            <select name="tipo_conta" size="1" id="tipo_conta">
            <option value="<? echo $res_update['tipo_conta']; ?>"><? echo $res_update['tipo_conta']; ?></option>            
              <option value=""></option>
              <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
              <option value="CORRENTE">CORRENTE</option>
            </select>
            <label for="banco_beneficiario"></label></td>
          <td><label for="agencia"></label>
            <input type="text" name="agencia" id="agencia" value="<? echo $res_update['agencia']; ?>" /></td>
          <td><label for="numero_conta"></label>
            <input type="text" name="numero_conta" id="numero_conta" value="<? echo $res_update['numero_conta']; ?>" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </form>
      <? } ?>
    </div>
</div>
</div>
<br />
<? } // acao 3 ?>














<? if($_GET['acao'] == ''){ ?>


<? if(isset($_POST['button'])){
	
$data = $_POST['data_ocorrencia'];
$descricao = $_POST['descricao'];
$finalidade = $_POST['finalidade'];
$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$compra = $_POST['compra'];
$forma_pagamento = $_POST['forma_pagamento'];
$banco_emissor = $_POST['banco_emissor'];
$nome_cartao = $_POST['nome_cartao'];
$n_cheque = $_POST['n_cheque'];
$valor = $_POST['valor'];
$banco_beneficiario = $_POST['banco_beneficiario'];
$tipo_conta = $_POST['tipo_conta'];
$agencia = $_POST['agencia'];
$agencia = $_POST['agencia'];
$numero_conta = $_POST['numero_conta'];

$code_debito = rand();

$dia1 = $data[0];
$dia2 = $data[1];

$mes1 = $data[3];
$mes2 = $data[4];

$ano1 = $data[6];
$ano2 = $data[7]; 
$ano3 = $data[8]; 
$ano4 = $data[9]; 

$dia = "$dia1$dia2";
$mes = "$mes1$mes2";
$ano = "$ano1$ano2$ano3$ano4";

mysql_query("INSERT INTO fluxo_de_caixa (status, data, data_completa, dia, mes, ano, tipo_entrada, descricao, forma_recebimento, bandeira_cartao, tipo_cartao, valor, tipo, origem, code_transacao) VALUES ('Ativo', '$data,', '$data_completa', '$dia', '$mes', '$ano', 'DEBITO', '$descricao', '$forma_pagamento', '$nome_cartao', '$nome_cartao', '$valor', 'SAIDA', 'DEBITOS', '$code_debito')");

mysql_query("INSERT INTO debitos (ip, dia, mes, ano, data, data_completa, status, operador, descricao, finalidade, beneficiario, endereco, compra, valor, forma_pagamento, banco_emissor, nome_cartao, n_cheque, banco_beneficiario, tipo_conta, agencia, numero_conta, cpf, code_debito) VALUES ('$ip', '$dia', '$mes', '$ano', '$data', '$data_completa', 'Ativo', '$operador', '$descricao', '$finalidade', '$nome', '$endereco', '$compra', '$valor', '$forma_pagamento', '$banco_emissor', '$nome_cartao', '$n_cheque', '$banco_beneficiario', '$tipo_conta', '$agencia', '$numero_conta', '$cpf', '$code_debito')");

echo "<script language='javascript'>window.alert('Informação registrada com sucesso!');window.location='';</script>";


}?>

<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0">INFORMA&Ccedil;&Otilde;ES B&Aacute;SICAS</li>
    <li class="TabbedPanelsTab" tabindex="0">INFORMA&Ccedil;&Otilde;ES BENEFICI&Aacute;RIO</li>
    <li class="TabbedPanelsTab" tabindex="0">FORMA DE PAGAMENTO</li>
</ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
    <form name="" method="post" action="" enctype="multipart/form-data">
      <table width="1000" border="0">
        <tr>
          <td width="144"><strong>DATA</strong></td>
          <td><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
          <td width="374"><strong>FINALIDADE</strong></td>
          <td width="107">&nbsp;</td>
        </tr>
        <tr>
          <td><span id="sprytextfield1">
          <input name="data_ocorrencia" type="text" id="data2" value="<? echo date("d/m/Y"); ?>" size="20" />
          <span class="textfieldInvalidFormatMsg">.</span></span></td>
          <td><label for="descricao"></label>
            <span id="sprytextfield3">
              <input name="descricao" type="text" id="descricao" size="85" />
            </span>            <label for="forma_pagamento"></label></td>
          <td><label for="finalidade"></label>
            <select name="finalidade" size="1" id="finalidade">
              <option value="OUTROS">OUTROS</option>            
              <option value="DEBITOS DE REFORMA">DEBITOS DE REFORMA</option>
              <option value="COMPRA DE PRODUTOS" selected="selected">COMPRA DE PRODUTOS</option>
              <option value="PERDA">PERDA</option>
              <option value="DOA&Ccedil;&Atilde;O">DOA&Ccedil;&Atilde;O</option>
            </select></td>
          <td><input class="input" type="submit" name="button" id="button" value="ENVIAR" /></td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="1000" border="0">
        <tr>
          <td width="153"><strong>NOME DO BENEFICIARIO</strong></td>
          <td width="126"><strong>CPF/CNPJ</strong></td>
          <td width="346"><strong>ENDERE&Ccedil;O</strong></td>
          <td width="172"><strong>COMPRA</strong></td>
          <td width="169">&nbsp;</td>
        </tr>
        <tr>
          <td><span id="sprytextfield2">
            <label for="nome"></label>
            <input type="text" name="nome" id="nome" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><span id="sprytextfield4">
            <label for="cpf"></label>
            <input type="text" name="cpf" id="cpf" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><span id="sprytextfield5">
            <label for="endereco"></label>
            <input type="text" name="endereco" id="endereco" />
            <span class="textfieldRequiredMsg">A value is required.</span></span></td>
          <td><label for="compra"></label>
            <select name="compra" size="1" id="compra">
              <option value="PRESENCIAL">PRESENCIAL</option>
              <option value="INTERNET">INTERNET</option>
              <option value="TELEFONE">TELEFONE</option>
              <option value="OUTROS">OUTROS</option>
            </select></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div>
    <div class="TabbedPanelsContent">
      <table width="1100" border="0">
        <tr>
          <td align="center" width="200"><strong>VALOR</strong></td>
          <td width="206"><strong>FORMA DE PAGAMENTO</strong></td>
          <td width="203"><strong>BANCO EMISSOR</strong></td>
          <td width="200"><strong>NOME DO CART&Atilde;O</strong></td>
          <td width="138"><strong>N&ordm; DO CHEQUE</strong></td>
          <td width="127"><strong>BANCO BENEFICI&Aacute;RIO</strong></td>
        </tr>
        <tr>
          <td align="center"><label for="valor"></label>
            <input name="valor" type="text" id="valor" size="5" /></td>
          <td><select name="forma_pagamento" size="1" id="forma_pagamento">
            <option value="DINHEIRO">DINHEIRO</option>
            <option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
            <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
            <option value="CHEQUE">CHEQUE</option>
            <option value="TRANSFERENCIA BANCARIA">TRANSFERENCIA BANCARIA</option>
            <option value="BOLETO">BOLETO</option>
            <option value="DEP&Oacute;SITO BANCARIO">DEP&Oacute;SITO BANCARIO</option>
          </select></td>
          <td><label for="banco_emissor"></label>
            <select name="banco_emissor" size="1" id="banco_emissor">
              <option value=""></option>
              <option value="BANCO DO BRASIL">BANCO DO BRASIL</option>
              <option value="ITAU">ITAU</option>
              <option value="BRADESCO">BRADESCO</option>
              <option value="SANTANDER">SANTANDER</option>
              <option value="INTER">INTER</option>
              <option value="CAIXA ECON&Ocirc;MICA FEDERAL">CAIXA ECON&Ocirc;MICA FEDERAL</option>
            </select></td>
          <td><label for="nome_cartao"></label>
            <select name="nome_cartao" size="1" id="nome_cartao">
              <option value=""></option>            
              <option value="OUROCARD">OUROCARD</option>
              <option value="C&amp;A VISA">C&amp;A VISA</option>
              <option value="RIACHUELO VISA">RIACHUELO VISA</option>
              <option value="ELO BRADESCO">ELO BRADESCO</option>
            </select></td>
          <td><label for="n_cartao"></label>
            <input name="n_cheque" type="text" id="n_cartao" size="5" /></td>
          <td><input name="banco_beneficiario" type="text" id="banco_beneficiario" size="15" /></td>
        </tr>
        <tr>
          <td><strong>TIPO DE CONTA</strong></td>
          <td><strong>AG&Ecirc;NCIA</strong></td>
          <td><strong>NUMERO DA CONTA</strong></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><label for="tipo_conta"></label>
            <select name="tipo_conta" size="1" id="tipo_conta">
              <option value=""></option>            
              <option value="POUPAN&Ccedil;A">POUPAN&Ccedil;A</option>
              <option value="CORRENTE">CORRENTE</option>
            </select>
            <label for="banco_beneficiario"></label></td>
          <td><label for="agencia"></label>
            <input type="text" name="agencia" id="agencia" /></td>
          <td><label for="numero_conta"></label>
            <input type="text" name="numero_conta" id="numero_conta" /></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </form>
  </div>
</div>
</div>
<br />
<? } // acao 2 ?>




<hr />
<form name="" method="post" action="" enctype="multipart/form-data">
<input class="input3" type="text" name="key" /><input type="submit" name="enviar" value="Enviar" />
</form>

<? if(isset($_POST['enviar'])){
	
$key = $_POST['key'];

if($key == ''){
	echo "<script language='javascript'>window.alert('Digite o código do debito!');window.location='?pack=informar_debitos';</script>";
}else{

$verifica_debitos = mysql_query("SELECT * FROM debitos WHERE code_debito = '$key' ORDER BY id DESC LIMIT 20");
if(mysql_num_rows($verifica_debitos) == ''){
	echo "Não foi encontrado nenhum débito com o código apresentado!";
}else{
?>	

<table width="1190" border="0">
  <tr>
    <td width="46"><strong>DATA</strong></td>
    <td width="69"><strong>STATUS</strong></td>
    <td width="46"><strong>COD.</strong></td>
    <td width="56"><strong>VALOR</strong></td>
    <td width="309"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
    <td width="130"><strong>FINALIDADE</strong></td>
    <td width="116"><strong>BENEFICIARIO</strong></td>
    <td width="108"><strong>CPF/CNPJ</strong></td>
    <td width="150"><strong>FORM.  DE PAGAMENTO</strong></td>
    <td width="118">&nbsp;</td>
  </tr
>
  <?
$i = 0;
	while($res_debito = mysql_fetch_array($verifica_debitos)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_debito['data']; ?></td>
    <td><? echo $res_debito['status']; ?></td>
    <td><? echo $res_debito['code_debito']; ?></td>
    <td><? echo $res_debito['valor']; ?></td>
    <td><? echo $res_debito['descricao']; ?></td>
    <td><? echo $res_debito['finalidade']; ?></td>
    <td><? echo $res_debito['beneficiario']; ?></td>
    <td><? echo $res_debito['cpf']; ?></td>
    <td><? echo $res_debito['forma_pagamento']; ?></td>
    <td>
    <? if($res_debito['status'] == 'Ativo'){ ?>
    <a href="?pack=informar_debitos&status=Inativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=1"><img src="img/bloquea.png" width="20" height="20" border="0" /></a>
    <? }else{ ?>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=1"><img src="img/correto.jpg" width="20" height="20" border="0" /> </a>
	<? } ?>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=2"><img src="img/deleta.jpg" width="18" height="18" border="0" /></a>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=3"><img src="img/cadastro.jpg" width="20" height="20" border="0" /> </a>
    </td>
  </tr>
  <? } ?>
</table>
<br /><br /><br /><br /><br /><br />
<? }}}?>


<hr />




<?

$verifica_debitos = mysql_query("SELECT * FROM debitos ORDER BY id DESC LIMIT 20");
if(mysql_num_rows($verifica_debitos) == ''){
	echo "Não foi encontrado nenhum débito no sistema!";
}else{
?>
<table width="1190" border="0">
  <tr>
    <td width="46"><strong>DATA</strong></td>
    <td width="60"><strong>STATUS</strong></td>
    <td width="52"><strong>COD.</strong></td>
    <td width="71"><strong>VALOR</strong></td>
    <td width="311"><strong>DESCRI&Ccedil;&Atilde;O</strong></td>
    <td width="114"><strong>FINALIDADE</strong></td>
    <td width="150"><strong>BENEFICIARIO</strong></td>
    <td width="91"><strong>CPF/CNPJ</strong></td>
    <td width="136"><strong>FORM.  DE PAGAMENTO</strong></td>
    <td width="117">&nbsp;</td>
  </tr
>
  <?
$i = 0;
	while($res_debito = mysql_fetch_array($verifica_debitos)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_debito['data']; ?></td>
    <td><? echo $res_debito['status']; ?></td>
    <td><? echo $res_debito['code_debito']; ?></td>
    <td><? echo $res_debito['valor']; ?></td>
    <td><? echo $res_debito['descricao']; ?></td>
    <td><? echo $res_debito['finalidade']; ?></td>
    <td><? echo $res_debito['beneficiario']; ?></td>
    <td><? echo $res_debito['cpf']; ?></td>
    <td><? echo $res_debito['forma_pagamento']; ?></td>
    <td>
    <? if($res_debito['status'] == 'Ativo'){ ?>
    <a href="?pack=informar_debitos&status=Inativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=1"><img src="img/bloquea.png" width="20" height="20" border="0" /></a>
    <? }else{ ?>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=1"><img src="img/correto.jpg" width="20" height="20" border="0" /> </a>
	<? } ?>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=2"><img src="img/deleta.jpg" width="20" height="20" border="0" /></a>
    <a href="?pack=informar_debitos&status=Ativo&code_debito=<? echo $res_debito['code_debito']; ?>&acao=3"><img src="img/cadastro.jpg" width="20" height="20" border="0" /> </a>
    </td>
  </tr>
  <? } ?>
</table>
<? } // verifica debitos ?>
</div><!-- box_cad_produto -->
<script type="text/javascript">
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
</script>
</body>
</html>

<? if($_GET['acao'] == '1'){
	
$code_debito = $_GET['code_debito'];
$status = $_GET['status'];

mysql_query("UPDATE debitos SET status = '$status' WHERE code_debito = '$code_debito'");
mysql_query("UPDATE fluxo_de_caixa SET status = '$status' WHERE code_transacao = '$code_debito'");
echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?pack=informar_debitos';</script>";

}?>

<? if($_GET['acao'] == '2'){
	
$code_debito = $_GET['code_debito'];

mysql_query("DELETE FROM debitos WHERE code_debito = '$code_debito'");
mysql_query("DELETE FROM fluxo_de_caixa WHERE code_transacao = '$code_debito'");
echo "<script language='javascript'>window.alert('Operação realizada com sucesso!');window.location='?pack=informar_debitos';</script>";

}?>