<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/analise_de_credito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? require "topo.php"; ?>


<div id="box_plano_canada">
<h1 style="font:18px Arial, Helvetica, sans-serif; margin:10px; color:#666; text-transform:uppercase;"><strong>Analise de crédito
<? if($_GET['p'] != ''){ ?> - CPF: <? echo $cliente = $_GET['cliente']; ?>
<? } ?>
</strong></h1>
<hr />
<? if($_GET['p'] != ''){ ?>

<?
 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '$cliente'");
  while($res_cliente = mysqli_fetch_array($sql_cliente)){
	 $sql_conta_corrente = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente'");
	  while($res_corrente = mysqli_fetch_array($sql_conta_corrente)){
		 $sql_emprestimo_carne = mysqli_query($conexao_bd, "SELECT * FROM clientes_emprestimo_carne WHERE cliente = '$cliente'");			  
			  if(mysqli_num_rows($sql_emprestimo_carne) == ''){
				  mysqli_query($conexao_bd, "INSERT INTO clientes_emprestimo_carne (cliente, limite, juros, risco_anterior) VALUES ('$cliente', '0', '0', '0')");
				  echo "<script language='javascript'>window.location='';</script>";
			  }
		  while($res_emprestimo_carne = mysqli_fetch_array($sql_emprestimo_carne)){
			  
			  
			  
			  
			 $sql_limite_credmais = mysqli_query($conexao_bd, "SELECT * FROM limite_credmais WHERE cliente = '$cliente'");				  
			  if(mysqli_num_rows($sql_limite_credmais) == ''){
				  mysqli_query($conexao_bd, "INSERT INTO limite_credmais (cliente, limite, taxa_juros) VALUES ('$cliente', '0', '0')");
				  echo "<script language='javascript'>window.location='';</script>";
			  }
			  while($res_limite_credmais = mysqli_fetch_array($sql_limite_credmais)){

?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="1000" border="0">
<tr>
  <td colspan="6">DADOS DO CLIENTE</td>
</tr>
<tr>
  <td bgcolor="#99CC66">CPF</td>
  <td bgcolor="#99CC66">Cliente</td>
  <td bgcolor="#99CC66">RG</td>
  <td bgcolor="#99CC66">Data de nascimento</td>
  <td bgcolor="#99CC66">Estado civil</td>
  <td bgcolor="#99CC66">Conjuge</td>
</tr>
<tr>
  <td><? echo $res_cliente['cpf']; ?></td>
  <td><? echo $res_cliente['nome']; ?></td>
  <td><? echo $res_cliente['tipo_documento']; ?> - <? echo $res_cliente['rg']; ?> - <? echo $res_cliente['date_exp']; ?> - <? echo $res_cliente['uf_rg']; ?> - <? echo $res_cliente['orgao_expeditor']; ?></td>
  <td><? echo $res_cliente['nascimento']; ?></td>
  <td><? echo $res_cliente['estado_civil']; ?></td>
  <td><? echo $res_cliente['conjuge']; ?></td>
</tr>
<tr>
  <td bgcolor="#99CC66">Sexo</td>
  <td bgcolor="#99CC66">Nome da mãe</td>
  <td bgcolor="#99CC66">Nome do pai</td>
  <td bgcolor="#99CC66">Escolaridade</td>
  <td bgcolor="#99CC66">Naturalidade</td>
  <td bgcolor="#99CC66">Moradia</td>
</tr>
<tr>
  <td><? echo $res_cliente['sexo']; ?></td>
  <td><? echo $res_cliente['mae']; ?></td>
  <td><? echo $res_cliente['pai']; ?></td>
  <td><? echo $res_cliente['escolaridade']; ?></td>
  <td><? echo $res_cliente['naturalidade']; ?></td>
  <td><? echo $res_cliente['moradia']; ?></td>
</tr>
<tr>
  <td bgcolor="#99CC66">Endereço</td>
  <td bgcolor="#99CC66">CEP</td>
  <td bgcolor="#99CC66">Bairro</td>
  <td bgcolor="#99CC66">Cidade</td>
  <td bgcolor="#99CC66">Estado</td>
  <td bgcolor="#99CC66">Tempo moradia</td>
</tr>
<tr>
  <td><? echo $res_cliente['endereco']; ?></td>
  <td><? echo $res_cliente['cep']; ?></td>
  <td><? echo $res_cliente['bairro']; ?></td>
  <td><? echo $res_cliente['cidade']; ?></td>
  <td><? echo $res_cliente['estado']; ?></td>
  <td><? echo $res_cliente['ano_moradia']; ?></td>
</tr>
<tr>
  <td bgcolor="#99CC66">Situação profissional</td>
  <td bgcolor="#99CC66">Profissão</td>
  <td bgcolor="#99CC66">Nome da empresa</td>
  <td bgcolor="#99CC66">Tempo de serviço</td>
  <td bgcolor="#99CC66">Renda</td>
  <td bgcolor="#99CC66">E-mail:</td>
</tr>
<tr>
  <td><? echo $res_cliente['sit_profissional']; ?></td>
  <td><? echo $res_cliente['profissao']; ?></td>
  <td><? echo $res_cliente['nome_empresa']; ?></td>
  <td><? echo $res_cliente['tempo_de_servico']; ?></td>
  <td><? echo $res_cliente['renda_mensal']; ?></td>
  <td><? echo $res_cliente['email']; ?></td>
</tr>
<tr>
  <td bgcolor="#99CC66">Telefone residencial</td>
  <td bgcolor="#99CC66">Telefone 1</td>
  <td bgcolor="#99CC66">Operador</td>
  <td bgcolor="#99CC66">Telefone 2</td>
  <td bgcolor="#99CC66">Operador</td>
  <td bgcolor="#99CC66">Telefone 3</td>
</tr>
<tr>
  <td><? echo $res_cliente['tele_residencial']; ?></td>
  <td><? echo $res_cliente['celular_1']; ?></td>
  <td><? echo $res_cliente['operadora1']; ?></td>
  <td><? echo $res_cliente['celular_2']; ?></td>
  <td><? echo $res_cliente['operadora2']; ?></td>
  <td><? echo $res_cliente['celular_3']; ?></td>
</tr>
<tr>
  <td colspan="6" bgcolor="#F7EEEE">DOCUMENTOS DIGITALIZADOS
    <hr></td>
  </tr>
<tr>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['foto_cpf']; ?>">CPF</a></td>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['frente_rg']; ?>">RG frente</a></td>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['verso_rg']; ?>">RG verso</a></td>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['comprovante_renda']; ?>">Comprovante de renda</a></td>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['comprovante_endereco']; ?>">Endereço</a></td>
  <td bgcolor="#F7EEEE"><a target="_blank" href="docs_clientes/<? echo $res_cliente['foto_cliente']; ?>">Foto do cliente</a></td>
</tr>
<tr>
  <td colspan="6" bgcolor="#ECF5FF"><hr>
    RESULTADO PARA ANÁLISE</td>
  </tr>
<tr>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://servicos.receita.fazenda.gov.br/Servicos/CPF/ConsultaSituacao/ConsultaPublica.asp">Receita federal</a></td>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://www.serasaempreendedor.com.br/login">Consultar SERASA</a></td>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://sistema.spc.org.br/spc/controleacesso/autenticacao/entry.action">Consultar SPC</a></td>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://web2.bvsnet.com.br/transacional/login.php">Consultar Boa Vista</a></td>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://loja.quod.com.br/formulario-compra">Consulta Quod</a></td>
  <td bgcolor="#ECF5FF"><a target="_blank" href="https://nubank.com.br/cartao">Análise NK</a></td>
</tr>
<tr>
  <td colspan="6"><hr>
    DISTRIBUIÇÃO DOS LIMITES</td>
  </tr>
<tr>
  <td bgcolor="#FF9933">Resultado da analise</td>
  <td colspan="5" bgcolor="#FF9933">Justificativa</td>
  </tr>
<tr>
  <td><label for="select"></label>
    <select name="proposta_credito" size="1" id="select">
      <option value="<? echo $res_corrente['proposta_credito']; ?>"><? echo $res_corrente['proposta_credito']; ?></option>
      <option value=""></option>
      <option value="APROVADO">APROVADO</option>
      <option value="NEGADO">NEGADO</option>
    </select></td>
  <td colspan="5"><label for="justificativa"></label>
    <input name="justificativa" type="text" id="justificativa" size="120" value="<? echo $res_corrente['justificativa']; ?>"></td>
  </tr>
<tr>
  <td bgcolor="#FF9933">Private Label</td>
  <td bgcolor="#FF9933">Financiamento</td>
  <td bgcolor="#FF9933">Taxa</td>
  <td bgcolor="#FF9933">Juros parcelamento</td>
  <td bgcolor="#FF9933">Bandeirado</td>
  <td bgcolor="#FF9933">Juros bandeirado</td>
</tr>
<tr>
  <td><label for="textfield2"></label>
    <input name="limite_loja" type="text" id="textfield2" value="<? echo $res_corrente['limite_loja']; ?>" size="10" /></td>
  <td><label for="textfield3"></label>
    <input name="pagamento_contas" type="text" id="textfield3" value="<? echo $res_corrente['pagamento_contas']; ?>" size="10" /></td>
  <td><label for="textfield4"></label>
    <input name="taxa_juros" type="text" id="textfield4" value="<? echo $res_corrente['taxa_juros']; ?>" size="5" /></td>
  <td><input name="juros_parcelamento" type="text" id="textfield5" value="<? echo $res_corrente['juros_parcelamento']; ?>" size="5" /></td>
  <td><input name="limite_bandeirado" type="text" id="textfield6" value="<? echo $res_corrente['limite_bandeirado']; ?>" size="10" /></td>
  <td><input name="juro_bandeirado" type="text" id="textfield7" value="<? echo $res_corrente['juro_bandeirado']; ?>" size="5" /></td>
</tr>
<tr>
  <td bgcolor="#FF9933">Saque fácil</td>
  <td bgcolor="#FF9933">Cartão de crédito</td>
  <td bgcolor="#FF9933">Empréstimo carnê</td>
  <td bgcolor="#FF9933">Juros Carnê</td>
  <td bgcolor="#FF9933">CredMmais</td>
  <td bgcolor="#FF9933">Limite CredMais</td>
</tr>
<tr>
  <td><input name="credito_pessoal" type="text" id="textfield8" size="10" value="<? echo $res_corrente['credito_pessoal']; ?>" /></td>
  <td><input name="credito_pessoal_cartao_credito" type="text" id="textfield9" size="10" value="<? echo $res_corrente['credito_pessoal_cartao_credito']; ?>" /></td>
  <td><input name="limite" type="text" id="textfield10" size="10" value="<? echo $res_emprestimo_carne['limite']; ?>" /></td>
  <td><input name="juros" type="text" id="textfield11" size="5" value="<? echo $res_emprestimo_carne['juros']; ?>" /></td>
  <td><input name="limite_credimais" type="text" id="textfield12" size="10" value="<? echo $res_limite_credmais['limite']; ?>" /></td>
  <td><input name="taxa_juros_credimais" type="text" id="textfield13" size="5" value="<? echo $res_limite_credmais['taxa_juros']; ?>" /></td>
</tr>
<tr>
  <td colspan="6"><hr />    <input type="submit" name="button" id="button" value="Enviar"></td>
  </tr>
</table>
</form>
<? }}}} ?>

<? if(isset($_POST['button'])){

$proposta_credito = $_POST['proposta_credito'];
$justificativa = $_POST['justificativa'];
$limite_loja = $_POST['limite_loja'];
$pagamento_contas = $_POST['pagamento_contas'];
$pagamento_contas_taxa_juros = $_POST['taxa_juros'];
$juros_parcelamento = $_POST['juros_parcelamento'];
$limite_bandeirado = $_POST['limite_bandeirado'];
$juro_bandeirado = $_POST['juro_bandeirado'];
$credito_pessoal = $_POST['credito_pessoal'];
$credito_pessoal_cartao_credito = $_POST['credito_pessoal_cartao_credito'];
$limite_carne = $_POST['limite'];
$juros = $_POST['juros'];
$limite_credimais = $_POST['limite_credimais'];
$taxa_juros_credimais = $_POST['taxa_juros_credimais'];


mysqli_query($conexao_bd, "UPDATE conta_corrente SET limite_loja = '$limite_loja', justificativa = '$justificativa', proposta_credito = '$proposta_credito', limite_loja_disponivel = '$limite_loja', pagamento_contas = '$pagamento_contas', disponivel_pagamento_contas = '$pagamento_contas', taxa_juros = '$pagamento_contas_taxa_juros', juros_parcelamento = '$juros_parcelamento', credito_pessoal = '$credito_pessoal', credito_pessoal_disponivel = '$credito_pessoal', credito_pessoal_cartao_credito = '$credito_pessoal_cartao_credito', credito_pessoal_cartao_credito_dsponivel = '$credito_pessoal_cartao_credito', limite_bandeirado = '$limite_bandeirado', limite_bandeirado_disponivel = '$limite_bandeirado', juro_bandeirado = '$juro_bandeirado' WHERE cliente = '$cliente'");


mysqli_query($conexao_bd, "UPDATE clientes_emprestimo_carne SET limite = '$limite_carne', juros = '$juros', risco_anterior = '$juros' WHERE cliente = '$cliente'");
mysqli_query($conexao_bd, "UPDATE limite_credmais SET limite = '$limite_credimais', taxa_juros = '$taxa_juros_credimais' WHERE cliente = '$cliente'");

echo "<script language='javascript'>window.alert('Analise concluída');window.location='?p=';</script>";

}?>


<? } // verifica se o cliente foi informado ?>










<? if($_GET['p'] == ''){ ?>
<?
 
 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE proposta_credito = 'AGUARDA ANALISE' ORDER BY id DESC");
 if(mysqli_num_rows($sql_verifica) == ''){
	 echo "<h2 style='margin:10px; font:12px Arial'>Não existe nenhuma proposta de crédito aguardando analise!</h2>";
 }else{
 ?>
<table width="1000" border="0">
  <tr>
    <td width="99" bgcolor="#CCCCCC"><strong>Data</strong></td>
    <td width="98" bgcolor="#CCCCCC"><strong>CPF</strong></td>
    <td width="277" bgcolor="#CCCCCC"><strong>Nome do cliente</strong></td>
    <td width="92" bgcolor="#CCCCCC"><strong>RG</strong></td>
    <td width="145" bgcolor="#CCCCCC"><strong>Profissão</strong></td>
    <td width="165" bgcolor="#CCCCCC"><strong>Telefone</strong></td>
    <td width="92" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <? 
  $i = 0;
   while($res = mysqli_fetch_array($sql_verifica)){ $i++;
	
	$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE cpf = '".$res['cliente']."'");  
 		while($res_cliente = mysqli_fetch_array($sql_cliente)){
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res['data_completa']; ?></td>
    <td><? echo $res['cliente']; ?></td>
    <td><? echo strtoupper($res_cliente['nome']); ?></td>
    <td><? echo strtoupper($res_cliente['rg']); ?></td>
    <td><? echo strtoupper($res_cliente['profissao']); ?></td>
    <td><? echo strtoupper($res_cliente['celular_1']); ?></td>
    <td>
     <a href="?p=analise&cliente=<? echo $res['cliente']; ?>"><img src="img/lupa.png" width="25" height="25" border="0" title="Fazer analise de crédito" /></a>
     <img src="img/bloquea.png" width="25" height="25" border="0" title="Negar proposta" />
    </td>
  </tr>
  <? }} ?>
</table>
<? } ?>


<? } // se o p está vázio ?>
</div><!-- box_plano_canada -->
</body>
</html>
