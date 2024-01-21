<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cliente.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>



<? if($_GET['p'] == 'analise_rapida'){ ?>
<div id="analise_rapida">
<h1><strong>Analise de cadastro</strong></h1>
<? if(isset($_POST['verifica'])){

$cpf = $_POST['cpf'];
$nascimento = $_POST['nascimento'];
$telefone = $_POST['telefone'];
$email = $_POST['email'];
$nome_completo = strtoupper($_POST['nome_completo']);
$tipo = $_POST['tipo'];

require "scripts/validar_cpf.php";
	
if($valida == 0){
	echo "<script language='javascript'>window.alert('O CPF INFORMADO ESTÁ INCORRETO!');</script>";
}else{


$verifica_cpf = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cpf'");
if(mysqli_num_rows($verifica_cpf) >= 1){
	echo "<script language='javascript'>window.alert('Cliente já está cadastrado no sistema, verifique a situação do cadastro do cliente e caso seja necessário faça uma atualização de dados!');</script>";
}else{

				mysqli_query($conexao_bd, "INSERT INTO clientes (atualizacao, ultima_atualizacao, dia, mes, ano, data_completa, date, ip, status, nome, tipo_documento, rg, date_exp, uf_rg, orgao_expeditor, cpf, nascimento, estado_civil, conjuge, sexo, mae, pai, escolaridade, nacionalidade, tele_residencial, celular_1, operadora1, celular_2, operadora2, celular_3, naturalidade, moradia, endereco, n_residencia, cep, bairro, cidade, estado, ano_moradia, complemento, sit_profissional, profissao, nome_empresa, tempo_de_servico, renda_mensal, cliente_desde, email, email2, email3, senha, origem_cadastro, operador, foto_cpf, frente_rg, verso_rg, comprovante_renda, comprovante_endereco, foto_cliente) VALUES ('', '', '$dia', '$mes', '$ano', '$data_completa', '$data', '$ip', 'ATIVO', '$nome_completo', 'tipo_documento', 'rg', 'date_exp', 'uf_rg', 'orgao_expeditor', '$cpf', '$nascimento', 'estado_civil', 'conjuge', 'sexo', 'mae', 'pai', 'escolaridade', 'nacionalidade', 'tele_residencial', '$telefone', 'operadora1', 'celular_2', 'operadora2', 'celular_3', 'naturalidade', 'moradia', 'endereco', 'n_residencia', 'cep', 'bairro', 'cidade', 'estado', 'ano_moradia', 'complemento', 'sit_profissional', 'profissao', 'nome_empresa', 'tempo_de_servico', 'renda_mensal', '$data', '$email', 'email2', 'email3', 'senha', 'VESTE PRIME', '$operador', 'foto_cpf', 'frente_rg', 'verso_rg', 'comprovante_renda', 'comprovante_endereco', 'foto_cliente')");
				
				mysqli_query($conexao_bd, "INSERT INTO conta_corrente (dia_cadastro, mes_cadastro, ano_cadastro, data_completa, data, status, vestepoint, score, serasa, quod, spc, scpc, categoria, atualizacao, anuidade, cliente, limite_loja, limite_loja_disponivel, cartao, pagamento_contas, disponivel_pagamento_contas, credito_pessoal, credito_pessoal_disponivel, credito_pessoal_cartao_credito, credito_pessoal_cartao_credito_dsponivel, limite_bandeirado, limite_bandeirado_disponivel, saldo, analise, proposta_credito, justificativa, mes, ano, vencimento, fechamento, senha_ml, taxa_juros, juros_parcelamento, limite_emergencial, juro_bandeirado) VALUES ('$dia', '$mes', '$ano', '$data_completa', '$data', 'PENDENTE', '100', '120', '0', '0', '0', '0', 'categoria', 'atualizacao', 'anuidade', '$cpf', '0', '0', 'cartao', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'SIM', 'NEGADO', 'NECESSÁRIO ENVIAR DOCUMENTAÇÃO PARA UMA NOVA ANALISE', '-', '-', 'vencimento', 'fechamento', 'senha_ml', '9.99', '9.99', 'CANCELAR', '9.99')");
				
			mysqli_query($conexao_bd, "INSERT INTO limite_credmais (cliente, limite, taxa_juros) VALUES ('$cpf', '400', '5')");
			mysqli_query($conexao_bd, "INSERT INTO clientes_emprestimo_carne (cliente, limite, juros, risco_anterior) VALUES ('$cpf', '0', '9.99', '0')");
		
	
	if($tipo == 'SIMPLES'){
	
		echo "<script language='javascript'>
			window.alert('CADASTRO APROVADO - APROVEITE OS BENEFÍCIOS DE SER UM CLIENTE VESTE PRIME!');
			window.location='carrinho.php'
			</script>";		
	}else{
		
	
		echo "<script language='javascript'>
			window.alert('CADASTRO PRÉ-APROVADO - TERMINE DE PREENCHER O CADASTRO DO CLIENTE!');
			window.location='?p=continua_proposta&cpf=$cpf&telefone=$telefone&nascimento=$nascimento&autorizacao=$autorizacao'
			</script>";				
		
	}
  }
 }
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1006" border="0">
  <tr>
    <td width="148" bgcolor="#333333"><strong>CPF</strong></td>
    <td width="138" bgcolor="#333333"><strong> NASCIMENTO</strong></td>
    <td width="197" bgcolor="#333333" align="center"><strong>NOME COMPLETO</strong></td>
    <td width="107" bgcolor="#333333"><strong>TELEFONE</strong></td>
    <td width="197" bgcolor="#333333"><strong>E-MAIL:</strong></td>
    <td width="88" bgcolor="#333333"><strong>TIPO</strong></td>
    <td width="101" bgcolor="#333333">&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#000000"><label for="textfield"></label>
      <input name="cpf" type="text" id="textfield" size="13" maxlength="11" />
      </td>
    <td bgcolor="#000000">
      <input name="nascimento" type="Date" id="textfield2" size="10" />
      </td>
    <td bgcolor="#000000"><label for="textfield3"></label>
      <input name="nome_completo" type="text" id="textfield4" size="35" />
     </td>
    <td bgcolor="#000000"><span id="sprytextfield2222">
      <input name="telefone" type="text" id="textfield3" size="15">
      <span class="textfieldInvalidFormatMsg">.</span></span></td>
    <td bgcolor="#000000">
      <input name="email" type="email" size="35" />
    </td>
    <td bgcolor="#000000"><select style="font:12px Arial, Helvetica, sans-serif; padding:10px; " name="tipo" size="1" id="select">
      <option value="SIMPLES">SIMPLES</option>
      <option value="CREDITO">CREDITO</option>
    </select></td>
    <td width="101" bgcolor="#000000"><input class="input" type="submit" name="verifica" value="Avan&ccedil;ar" /></td>
    </tr>
</table>
</form>
</div><!-- analise_rapida -->
<? }// analise_rapida  ?>







<? if($_GET['p'] == 'continua_proposta'){ ?>
<div id="box_cadastro_de_cliente">
<hr />
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:10px; color:#666;"><strong>ATUALIZE AS INFORMAÇÕES ABAIXO</strong></h1>

<?php if(isset($_POST['button'])){

$sexo = strtoupper($_POST['sexo']);
$tipo_documento = strtoupper($_POST['tipo_documento']);
$rg = strtoupper($_POST['rg']);
$date_exp = strtoupper($_POST['date_exp']);
$uf_rg = strtoupper($_POST['uf_rg']);
$orgao_expeditor = strtoupper($_POST['orgao_expeditor']);
$naturalidade = strtoupper($_POST['naturalidade']);
$nacionalidade = strtoupper($_POST['nacionalidade']);
$estado_civil = strtoupper($_POST['estado_civil']);
$mae = strtoupper($_POST['mae']);
$pai = strtoupper($_POST['pai']);
$conjuge = strtoupper($_POST['conjuge']);
$sit_profissional = strtoupper($_POST['sit_profissional']);
$escolaridade = strtoupper($_POST['escolaridade']);
$profissao = strtoupper($_POST['profissao']);
$nome_empresa = strtoupper($_POST['nome_empresa']);
$renda_mensal = strtoupper($_POST['renda_mensal']);
$tempo_de_servico = strtoupper($_POST['tempo_de_servico']);
$endereco = strtoupper($_POST['endereco']);
$n_residencia = strtoupper($_POST['n_residencia']);
$cidade = strtoupper($_POST['cidade']);
$cep = strtoupper($_POST['cep']);
$bairro = strtoupper($_POST['bairro']);
$complemento = strtoupper($_POST['complemento']);
$estado = strtoupper($_POST['estado']);
$ano_moradia = strtoupper($_POST['ano_moradia']);
$moradia = strtoupper($_POST['moradia']);
$tele_residencial = strtoupper($_POST['tele_residencial']);
$celular_1 = strtoupper($_POST['celular_1']);
$operadora1 = strtoupper($_POST['operadora1']);
$celular_2 = strtoupper($_POST['celular_2']);
$celular_3 = strtoupper($_POST['celular_3']);
$operadora2 = strtoupper($_POST['operadora2']);
$ano_moradia = strtoupper($_POST['ano_moradia']);
$email = strtolower($_POST['email']);
$email2 = strtolower($_POST['email2']);
$email3 = strtolower($_POST['email3']);

if($rg == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O CAMPO RG!');</script>";
}elseif($naturalidade == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O NASCIMENTO!');</script>";
}elseif($mae == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O NOME DA MÃE!');</script>";
}elseif($renda_mensal == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O VALOR DA RENDA MENSAL!');</script>";
}elseif($endereco == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O ENDEREÇO!');</script>";
}elseif($n_residencia == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O NÚMERO DA RESIDÊNCIA, SE NÃO TIVER NÚMERO COLOQUE 000!');</script>";
}elseif($cidade == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O NOME DA CIDADE!');</script>";
}elseif($bairro == ''){
	echo "<script language='javascript'>window.alert('FALTOU PREENCHER O NOME DO BAIRRO!');</script>";
}else{

$sql_atualiza = mysqli_query($conexao_bd, "UPDATE clientes SET atualizacao = 'GERAL', naturalidade = '$naturalidade', sexo = '$sexo', ultima_atualizacao = '$data', tipo_documento = '$tipo_documento', rg = '$rg', date_exp = '$date_exp', uf_rg = '$uf_rg', orgao_expeditor = '$orgao_expeditor', estado_civil = '$estado_civil', conjuge = '$conjuge', escolaridade = '$escolaridade', tele_residencial = '$tele_residencial', celular_1 = '$celular_1', operadora1 = '$operadora1', celular_2 = '$celular_2', operadora2 = '$operadora2', celular_3 = '$celular_3', moradia = '$moradia', endereco = '$endereco', n_residencia = '$n_residencia', cep = '$cep', bairro = '$bairro', cidade = '$cidade', estado = '$estado', ano_moradia = '$ano_moradia', complemento = '$complemento', sit_profissional = '$sit_profissional', profissao = '$profissao', nome_empresa = '$nome_empresa', tempo_de_servico = '$tempo_de_servico', renda_mensal = '$renda_mensal', mae = '$mae', pai = '$pai', nacionalidade = '$nacionalidade', email = '$email', email2 = '$email2', email3 = '$email3' WHERE cpf = '".$_GET['cpf']."'");

if($sql_atualiza == ''){
	echo "<script language='javascript'>window.alert('Ocorreu um erro atualizar, tente novamente!');</script>";
}else{
	$cliente = $_GET['cpf'];
	$score = 0;
	$sql_score = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	 while($res_score = mysqli_fetch_array($sql_score)){
		 $score = $res_score['score'];
	 }
	 
	 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM score WHERE cliente = '$cliente' AND descricao = 'ATUALIZACAO DE CADASTRO' AND mes = '$mes' AND ano = '$ano'");
	  if(mysqli_num_rows($sql_verifica) == ''){
		  
	   mysqli_query($conexao_bd, "INSERT INTO score (operador, tipo, data, dia, mes, ano, cliente, descricao, pontos) VALUES ('$operador', 'CREDITO', '$data', '$dia', '$mes', '$ano', '$cliente', 'ATUALIZACAO DE CADASTRO', '5')");
     
	  $score = $score+5;
	   mysqli_query($conexao_bd, "UPDATE conta_corrente SET score = '$score' WHERE cliente = '$cliente'");
	  }
	
	echo "<script language='javascript'>window.alert('Dados atualizados com sucesso!');window.location='carrinho.php';</script>";
}

}
}?>

<?

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$_GET['cpf']."'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
  <table width="944" border="0">
  <tr>
    <td colspan="6" bgcolor="#333333"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#FFF; padding:5px;"><strong>DADOS PESSOAIS</strong></h1></td>
  </tr>
  <tr>
    <td width="231" bgcolor="#999999"><strong>NOME</strong></td>
    <td bgcolor="#999999"><strong>CPF</strong></td>
    <td bgcolor="#999999"><strong>DATA DE NASCIMENTO</strong></td>
    <td bgcolor="#999999"><strong>SEXO</strong></td>
    <td bgcolor="#999999"><strong>DOCUMENTO</strong></td>
    <td bgcolor="#999999"><strong>EXPEDITOR</strong></td>
  </tr>
  <tr>
    <td><label for="textfield4"></label>
      <input name="textfield4" type="text" disabled="disabled" value="<? echo $res_cliente['nome']; ?>" size="40" /></td>
    <td><input name="textfield" type="text" disabled="disabled" value="<? echo $res_cliente['cpf']; ?>" /></td>
    <td><input name="textfield2" type="text" disabled="disabled" value="<? echo $res_cliente['nascimento']; ?>" /></td>
    <td align="center"><em style="font:10px Arial, Helvetica, sans-serif; color:#F90; text-decoration:none; text-transform:none;">
      <input type="radio" name="sexo" value="MASCULINO" <? if($res_cliente['sexo'] == 'MASCULINO'){ ?> checked="checked"  <? } ?>/>
      Masculino
      <input name="sexo" type="radio" value="FEMENINO" <? if($res_cliente['sexo'] == 'FEMENINO'){ ?> checked="checked"  <? } ?>/>
      <label for="sexo">Femenino</label>
    </em></td>
    <td><select style="width:100px;" name="tipo_documento" size="1" id="select5">
      <option value="<? echo $res_cliente['tipo_documento']; ?>"><? echo $res_cliente['tipo_documento']; ?></option>
      <option value="RG">RG</option>
      <option value="CNH">CNH</option>
      <option value="PASSAPORTE">PASSAPORTE</option>
    </select></td>
    <td><select style="width:100px;" name="orgao_expeditor" size="1" id="tipo_documento">
      <option value="<? echo $res_cliente['orgao_expeditor']; ?>"><? echo $res_cliente['orgao_expeditor']; ?></option>
      <option value="SSP">SSP</option>
      <option value="DETRAN">DETRAN</option>
      <option value="POLICIA FEDERAL">POLICIA FEDERAL</option>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#999999"><strong>DOCUMENTO DE IDENTIFICA&Ccedil;&Acirc;O</strong></td>
    <td width="151" bgcolor="#999999"><strong>DATA DE EXPEDI&Ccedil;&Atilde;O</strong></td>
    <td width="151" bgcolor="#999999"><strong>UF DE EXPEDI&Ccedil;&Atilde;O</strong></td>
    <td width="165" bgcolor="#999999"><strong>CIDADE DE NASCIMENTO</strong></td>
    <td width="113" bgcolor="#999999"><strong>NACIONALIDADE</strong></td>
    <td width="108" bgcolor="#999999"><strong>ESTADO CIV&Iacute;L</strong></td>
  </tr>
  <tr>
    <td><label for="rg"></label>
      <input name="rg" type="text" id="rg" size="40" value="<? echo $res_cliente['rg']; ?>" /></td>
    <td><label for="date_exp"></label>
      <input type="Date" name="date_exp" id="date_exp" value="<? echo $res_cliente['date_exp']; ?>" /></td>
    <td><label for="uf_rg"></label>
      <select style="width:150px;" name="uf_rg" size="1" id="uf_rg">
        <option value="<? echo $res_cliente['uf_rg']; ?>"><? echo $res_cliente['uf_rg']; ?></option>
        <option value="CE">CE</option>
      </select></td>
    <td><label for="naturalidade"></label>
      <input type="text" name="naturalidade" value="<? echo $res_cliente['naturalidade']; ?>" /></td>
    <td><label for="nacionalidade"></label>
      <select style="width:100px;" name="nacionalidade" size="1" id="nacionalidade">
        <option value="<? echo $res_cliente['nacionalidade']; ?>"><? echo $res_cliente['nacionalidade']; ?></option>
        <option value="BRASILEIRO">BRASILEIRO</option>
        <option value="ESTRAJEIRO">ESTRAJEIRO</option>
      </select></td>
    <td><label for="estado_civil"></label>
      <select style="width:100px;" name="estado_civil" size="1" id="estado_civil">
        <option value="<? echo $res_cliente['estado_civil']; ?>"><? echo $res_cliente['estado_civil']; ?></option>
        <option value="Solteiro">Solteiro</option>
        <option value="Casado">Casado</option>
        <option value="Divorciado">Divorciado</option>
        <option value="Vi&uacute;vo(a)">Vi&uacute;vo(a)</option>
      </select></td>
  </tr>
  <tr>
    <td bgcolor="#999999"><strong>MAE</strong></td>
    <td colspan="2" bgcolor="#999999"><strong>PAI</strong></td>
    <td colspan="3" bgcolor="#999999"><strong>CONJUGE</strong></td>
  </tr>
  <tr>
    <td><label for="mae"></label>
      <input name="mae" type="text" id="mae" size="40" value="<? echo $res_cliente['mae']; ?>"/></td>
    <td colspan="2"><label for="pai"></label>
      <input name="pai" type="text" id="pai" size="50" value="<? echo $res_cliente['pai']; ?>"/></td>
    <td colspan="3"><label for="conjuge"></label>
      <input name="conjuge" type="text" id="conjuge" size="73" value="<? echo $res_cliente['conjuge']; ?>"/></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#333333"><strong><span style="font:12px Arial, Helvetica, sans-serif; color:#FFF; padding:5px;; font-family: Arial, Helvetica, sans-serif; font-size: 12px"><strong>DADOS PROFISSIONAIS</strong></span></strong></td>
  </tr>
  <tr>
    <td bgcolor="#999999"><strong>SITUA&Ccedil;&Atilde;O PROFISSIONAL</strong></td>
    <td bgcolor="#999999"><strong>FORMA&Ccedil;&Atilde;O</strong></td>
    <td bgcolor="#999999"><strong>PROFISS&Atilde;O</strong></td>
    <td bgcolor="#999999"><strong>NOME DA EMPRESA</strong></td>
    <td bgcolor="#999999"><strong>RENDA MENSAL</strong></td>
    <td bgcolor="#999999"><strong>INICIO/TRABALHO</strong></td>
  </tr>
  <tr>
    <td><select style="width:230px;" name="sit_profissional" size="1" id="select6">
        <option value="<? echo $res_cliente['sit_profissional']; ?>"><? echo $res_cliente['sit_profissional']; ?></option>
        <option value="Funcion&aacute;rio Publico">Funcion&aacute;rio Publico</option>
        <option value="Aposentados e Pensionistas">Aposentados e Pensionistas</option>
        <option value="Aut&ocirc;nomo">Aut&ocirc;nomo</option>
        <option value="Empregador">Empregador</option>
        <option value="Funcion&aacute;rio de Empresa Privada">Funcion&aacute;rio de Empresa Privada</option>
        <option value="For&ccedil;as Armadas">For&ccedil;as Armadas</option>
        <option value="Militar">Militar</option>
        <option value="Proprit&aacute;rio">Proprit&aacute;rio</option>
    </select></td>
    <td><label for="escolaridade"></label>
      <select style="width:130px;" name="escolaridade" id="escolaridade">
        <option value="<? echo $res_cliente['escolaridade']; ?>"><? echo $res_cliente['escolaridade']; ?></option>
        <option value="Analfabeto">Analfabeto</option>
        <option value="Ensino Infantil">Ensino Infantil</option>
        <option value="Ensino Fundamental Incompleto">Ensino Fundamental Incompleto</option>
        <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
        <option value="Ensino M&eacute;dio Incompleto">Ensino M&eacute;dio Incompleto</option>
        <option value="Ensino M&eacute;dio Completo">Ensino M&eacute;dio Completo</option>
        <option value="Superior Incompleto">Superior Incompleto</option>
        <option value="Superior Completo">Superior Completo</option>        
      </select>
      <label for="profissao"></label></td>
    <td><input name="profissao" type="text" id="profissao" size="20" value="<? echo $res_cliente['profissao']; ?>" /></td>
    <td align="center"><label for="nome_empresa"></label>
      <input name="nome_empresa" type="text" id="nome_empresa" size="20" value="<? echo $res_cliente['nome_empresa']; ?>" /></td>
    <td align="center"><input style="width:80px;" name="renda_mensal" type="number" id="renda_mensal" size="15" value="<? echo $res_cliente['renda_mensal']; ?>" /></td>
    <td><label for="tempo_de_servico"></label>
      <input name="tempo_de_servico" type="text" id="tempo_de_servico" size="12" value="<? echo $res_cliente['tempo_de_servico']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#333333"><strong><span style="font:12px Arial, Helvetica, sans-serif; color:#FFF; padding:5px;; font-family: Arial, Helvetica, sans-serif; font-size: 12px"><strong>ENDERE&Ccedil;O PARA CORRESPOND&Ecirc;NCIA</strong></span></strong></td>
  </tr>
  <tr>
    <td colspan="2" bgcolor="#999999"><strong>ENDERE&Ccedil;O</strong></td>
    <td bgcolor="#999999"><strong>N&ordm;</strong></td>
    <td colspan="3" bgcolor="#999999"><strong>CIDADE</strong></td>
    </tr>
  <tr>
    <td colspan="2"><label for="endereco"></label>
      <input name="endereco" type="text" id="endereco" size="70" value="<? echo $res_cliente['endereco']; ?>"/></td>
    <td><label for="n_residencia"></label>
      <input name="n_residencia" type="number" id="n_residencia" size="13" value="<? echo $res_cliente['n_residencia']; ?>"/></td>
    <td colspan="3"><input name="cidade" type="text" id="textfield18" size="73" value="<? echo $res_cliente['cidade']; ?>"/></td>
  </tr>
  <tr>
    <td bgcolor="#999999"><strong>CEP</strong></td>
    <td bgcolor="#999999"><strong>BAIRRO</strong></td>
    <td bgcolor="#999999"><strong>COMPLEMENTO</strong></td>
    <td align="center" bgcolor="#999999"><strong>ESTADO</strong></td>
    <td align="center" bgcolor="#999999"><strong>TIPO DE MORADIA</strong></td>
    <td align="center" bgcolor="#999999"><strong>ANO DE MORADIA</strong></td>
  </tr>
  <tr>
    <td><label for="cep"></label>
      <input name="cep" type="text" id="cep" size="40" value="<? echo $res_cliente['cep']; ?>" /></td>
    <td><label for="bairro"></label>
      <input type="text" name="bairro" id="bairro" value="<? echo $res_cliente['bairro']; ?>" /></td>
    <td><input type="text" name="complemento" id="complemento" value="<? echo $res_cliente['complemento']; ?>" /></td>
    <td align="center"><label for="estado"></label>
      <select name="estado" id="estado">
        <option value="<? echo $res_cliente['estado']; ?>"><? echo $res_cliente['estado']; ?></option>
          <option value="Acre">Acre</option>
          <option value="Alagoas">Alagoas</option>
          <option value="Amap&aacute;">Amap&aacute;</option>
          <option value="Amazonas">Amazonas</option>
          <option value="Bahia">Bahia</option>
          <option value="Cear&aacute;">Cear&aacute;</option>
          <option value="Distrito Federal">Distrito Federal</option>
          <option value="Esp&iacute;rito Santo">Esp&iacute;rito Santo</option>
          <option value="Goi&aacute;s">Goi&aacute;s</option>
          <option value="Maranh&atilde;o">Maranh&atilde;o</option>
          <option value="Mato Grosso">Mato Grosso</option>
          <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
          <option value="Minas Gerais">Minas Gerais</option>
          <option value="Par&aacute;">Par&aacute;</option>
          <option value="Para&iacute;ba">Para&iacute;ba</option>
          <option value="Paran&aacute;">Paran&aacute;</option>
          <option value="Pernambuco">Pernambuco</option>
          <option value="Piau&iacute;">Piau&iacute;</option>
          <option value="Rio de Janeiro">Rio de Janeiro</option>
          <option value="Rio Grande do Norte">Rio Grande do Norte</option>
          <option value="Rio Grande do Sul">Rio Grande do Sul</option>
          <option value="Rond&ocirc;nia">Rond&ocirc;nia</option>
          <option value="Roraima">Roraima</option>
          <option value="Santa Catarina">Santa Catarina</option>
          <option value="S&atilde;o Paulo">S&atilde;o Paulo</option>
          <option value="Sergipe">Sergipe</option>
          <option value="Tocantins">Tocantins</option>        
      </select>
      <label for="ano_moradia"></label></td>
    <td align="center"><label for="tipo_moradia"></label>
      <select style="width:130px;" name="moradia" size="1" id="moradia">
        <option value="<? echo $res_cliente['moradia']; ?>"><? echo $res_cliente['moradia']; ?></option>
        <option value="PR&Oacute;PRIA">PR&Oacute;PRIA</option>
        <option value="ALUGADA">ALUGADA</option>
        <option value="CEDIDA">CEDIDA</option>
        <option value="FAMILIAR">FAMILIAR</option>
        <option value="OUTROS">OUTROS</option>
      </select></td>
    <td align="center"><input style="width:50px;" name="ano_moradia" type="number" id="ano_moradia" size="7" value="<? echo $res_cliente['ano_moradia']; ?>"/></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#333333"><strong><span style="font:12px Arial, Helvetica, sans-serif; color:#FFF; padding:5px;; font-family: Arial, Helvetica, sans-serif; font-size: 12px"><strong>DADOS DE CONTATO</strong></span></strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#999999"><strong>TELEFONE FIXO</strong></td>
    <td align="center" bgcolor="#999999"><strong>CELULAR 1</strong></td>
    <td align="center" bgcolor="#999999"><strong>OPERADORA</strong></td>
    <td align="center" bgcolor="#999999"><strong>CELULAR 2</strong></td>
    <td align="center" bgcolor="#999999"><strong>OPERADORA</strong></td>
    <td align="center" bgcolor="#999999"><strong>CELULAR 3</strong></td>
  </tr>
  <tr>
    <td align="center"><span id="sprytextfield10">
      <input type="text" name="tele_residencial" id="tele_residencial" value="<? echo $res_cliente['tele_residencial']; ?>" /></span></td>
    <td align="center"><span id="sprytextfield2222">
      <input type="text" name="celular_1" id="celular_1" value="<? echo $res_cliente['celular_1']; ?>" /><span class="textfieldInvalidFormatMsg">.</span></span></td>
    <td align="center"><label for="email"></label>
      <select name="operadora1" size="1" id="select10">
        <option value="<? echo $res_cliente['operadora1']; ?>"><? echo $res_cliente['operadora1']; ?></option>
        <option value="WhatsApp">WhatsApp</option>
        <option value="Oi">Oi</option>
        <option value="Tim">Tim</option>
        <option value="Claro">Claro</option>
        <option value="Vivo">Vivo</option>
        <option value="Correios">Correios</option>
        <option value="Nextel">Nextel</option>
      </select>
      <label for="ano_moradia"></label></td>
    <td align="center"><span id="sprytextfield2222">
      <input name="celular_2" type="text" id="celular_2" size="15" value="<? echo $res_cliente['celular_2']; ?>" /></span></span></td>
    <td align="center"><label for="email2"></label>
      <select name="operadora2" size="1" id="select11">
        <option value="<? echo $res_cliente['operadora2']; ?>"><? echo $res_cliente['operadora2']; ?></option>
        <option value="WhatsApp">WhatsApp</option>
        <option value="Oi">Oi</option>
        <option value="Tim">Tim</option>
        <option value="Claro">Claro</option>
        <option value="Vivo">Vivo</option>
        <option value="Correios">Correios</option>
        <option value="Nextel">Nextel</option>
      </select>
      <label for="ano_moradia"></label></td>
    <td align="center"><input name="celular_3" type="text" value="<? echo $res_cliente['celular_3']; ?>" size="12" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#999999"><strong>E-MAIL PRINCIPAL</strong></td>
    <td colspan="2" align="center" bgcolor="#999999"><strong>E-MAIL 2</strong></td>
    <td colspan="2" align="center" bgcolor="#999999"><strong>E-MAIL 3</strong></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><label for="email"></label>
      <input name="email" type="email" id="email" size="70" value="<? echo $res_cliente['email']; ?>" /></td>
    <td colspan="2" align="center"><label for="email2"></label>
      <input name="email2" type="email" id="email2" size="55" value="<? echo $res_cliente['email2']; ?>"/></td>
    <td colspan="2" align="center"><label for="email3"></label>
      <input name="email3" type="email" id="email3" size="35" value="<? echo $res_cliente['email3']; ?>" /></td>
    </tr>
  <tr>
    <td colspan="6" align="center"><hr /></td>
    </tr>
  <tr>
    <td colspan="6" align="center"><input type="submit" name="button" id="button" value="Atualizar cadastro" /></td>
  </tr>
    </table>
</form>
<? } ?>


</div><!-- box_cadastro_de_cliente -->
<? }// analise_rapida  ?>



<? require "rodape.php"; ?>
<script type="text/javascript">
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "phone_number", {format:"phone_custom", useCharacterMasking:true, isRequired:false, pattern:"(00) 0000.0000"});

var sprytextfield2222 = new Spry.Widget.ValidationTextField("sprytextfield2222", "custom", {useCharacterMasking:true, pattern:"(00) 00000.0000"});
</script>
</body>
</html>