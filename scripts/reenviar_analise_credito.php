<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/reenviar_analise_credito.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../conexao.php"; $cliente = $_GET['cliente']; ?>


<? if(isset($_POST['button'])){


$enviar_selfie = $_POST['enviar_selfie'];
$enviar_cpf = $_POST['enviar_cpf'];
$enviar_frente_rg = $_POST['enviar_frente_rg'];
$enviar_verso_rg = $_POST['enviar_verso_rg'];
$enviar_comprovante_renda = $_POST['enviar_comprovante_renda'];
$enviar_comprovante_endereco = $_POST['enviar_comprovante_endereco'];
	
$selfie = $_FILES['selfie']['name'];
$foto_cpf = $_FILES['foto_cpf']['name'];
$frente_rg = $_FILES['frente_rg']['name'];
$verso_rg = $_FILES['verso_rg']['name'];
$comprovante_renda = $_FILES['comprovante_renda']['name'];
$comprovante_endereco = $_FILES['comprovante_endereco']['name'];


$selfie = str_replace(" ", "-", $selfie); $selfie = str_replace(",", "-", $selfie); $selfie = str_replace("ã", "a", $selfie);
$selfie = str_replace("á", "a", $selfie); $selfie = str_replace("à", "a", $selfie); $selfie = str_replace("é", "e", $selfie);
$selfie = str_replace("ê", "e", $selfie); $selfie = str_replace("è", "e", $selfie); $selfie = str_replace("í", "i", $selfie);
$selfie = str_replace("ì", "i", $selfie); $selfie = str_replace("ó", "o", $selfie); $selfie = str_replace("õ", "o", $selfie);
$selfie = str_replace("ç", "c", $selfie);

$foto_cpf = str_replace(" ", "-", $foto_cpf); $foto_cpf = str_replace(",", "-", $foto_cpf); $foto_cpf = str_replace("ã", "a", $foto_cpf);
$foto_cpf = str_replace("á", "a", $foto_cpf); $foto_cpf = str_replace("à", "a", $foto_cpf); $foto_cpf = str_replace("é", "e", $foto_cpf);
$foto_cpf = str_replace("ê", "e", $foto_cpf); $foto_cpf = str_replace("è", "e", $foto_cpf); $foto_cpf = str_replace("í", "i", $foto_cpf);
$foto_cpf = str_replace("ì", "i", $foto_cpf); $foto_cpf = str_replace("ó", "o", $foto_cpf); $foto_cpf = str_replace("õ", "o", $foto_cpf);
$foto_cpf = str_replace("ç", "c", $foto_cpf);

$frente_rg = str_replace(" ", "-", $frente_rg); $frente_rg = str_replace(",", "-", $frente_rg); $frente_rg = str_replace("ã", "a", $frente_rg);
$frente_rg = str_replace("á", "a", $frente_rg); $frente_rg = str_replace("à", "a", $frente_rg); $frente_rg = str_replace("é", "e", $frente_rg);
$frente_rg = str_replace("ê", "e", $frente_rg); $frente_rg = str_replace("è", "e", $frente_rg); $frente_rg = str_replace("í", "i", $frente_rg);
$frente_rg = str_replace("ì", "i", $frente_rg); $frente_rg = str_replace("ó", "o", $frente_rg); $frente_rg = str_replace("õ", "o", $frente_rg);
$frente_rg = str_replace("ç", "c", $frente_rg);

$verso_rg = str_replace(" ", "-", $verso_rg); $verso_rg = str_replace(",", "-", $verso_rg); $verso_rg = str_replace("ã", "a", $verso_rg);
$verso_rg = str_replace("á", "a", $verso_rg); $verso_rg = str_replace("à", "a", $verso_rg); $verso_rg = str_replace("é", "e", $verso_rg);
$verso_rg = str_replace("ê", "e", $verso_rg); $verso_rg = str_replace("è", "e", $verso_rg); $verso_rg = str_replace("í", "i", $verso_rg);
$verso_rg = str_replace("ì", "i", $verso_rg); $verso_rg = str_replace("ó", "o", $verso_rg); $verso_rg = str_replace("õ", "o", $verso_rg);
$verso_rg = str_replace("ç", "c", $verso_rg);

$comprovante_renda = str_replace(" ", "-", $comprovante_renda); $comprovante_renda = str_replace(",", "-", $comprovante_renda); 
$comprovante_renda = str_replace("ã", "a", $comprovante_renda); $comprovante_renda = str_replace("á", "a", $comprovante_renda); 
$comprovante_renda = str_replace("à", "a", $comprovante_renda); $comprovante_renda = str_replace("é", "e", $comprovante_renda);
$comprovante_renda = str_replace("ê", "e", $comprovante_renda); $comprovante_renda = str_replace("è", "e", $comprovante_renda); 
$comprovante_renda = str_replace("í", "i", $comprovante_renda); $comprovante_renda = str_replace("ì", "i", $comprovante_renda); 
$comprovante_renda = str_replace("ó", "o", $comprovante_renda); $comprovante_renda = str_replace("õ", "o", $comprovante_renda);
$comprovante_renda = str_replace("ç", "c", $comprovante_renda);


$comprovante_endereco = str_replace(" ", "-", $comprovante_endereco); $comprovante_endereco = str_replace(",", "-", $comprovante_endereco); $comprovante_endereco = str_replace("ã", "a", $comprovante_endereco); $comprovante_endereco = str_replace("á", "a", $comprovante_endereco); $comprovante_endereco = str_replace("à", "a", $comprovante_endereco); $comprovante_endereco = str_replace("é", "e", $comprovante_endereco); $comprovante_endereco = str_replace("ê", "e", $comprovante_endereco); $comprovante_endereco = str_replace("è", "e", $comprovante_endereco); $comprovante_endereco = str_replace("í", "i", $comprovante_endereco); $comprovante_endereco = str_replace("ì", "i", $comprovante_endereco); $comprovante_endereco = str_replace("ó", "o", $comprovante_endereco); $comprovante_endereco = str_replace("õ", "o", $comprovante_endereco); $comprovante_endereco = str_replace("ç", "c", $comprovante_endereco);


if(file_exists("../docs_clientes/$selfie")){ $a = 1;while(file_exists("../docs_clientes/[$a]$selfie")){$a++;}$selfie = "[".$a."]".$selfie;}
if(file_exists("../docs_clientes/$foto_cpf")){ $a = 1;while(file_exists("../docs_clientes/[$a]$foto_cpf")){$a++;}$foto_cpf = "[".$a."]".$foto_cpf;}
if(file_exists("../docs_clientes/$frente_rg")){ $a = 1;while(file_exists("../docs_clientes/[$a]$frente_rg")){$a++;}$frente_rg = "[".$a."]".$frente_rg;}
if(file_exists("../docs_clientes/$verso_rg")){ $a = 1;while(file_exists("../docs_clientes/[$a]$verso_rg")){$a++;}$verso_rg = "[".$a."]".$verso_rg;}
if(file_exists("../docs_clientes/$comprovante_renda")){ $a = 1;while(file_exists("../docs_clientes/[$a]$comprovante_renda")){$a++;}$comprovante_renda = "[".$a."]".$comprovante_renda;}
if(file_exists("../docs_clientes/$comprovante_endereco")){ $a = 1;while(file_exists("../docs_clientes/[$a]$comprovante_endereco")){$a++;}$comprovante_endereco = "[".$a."]".$comprovante_endereco;}


if($enviar_selfie == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET foto_cliente = '$selfie' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['selfie']['tmp_name'], "../docs_clientes/".$selfie));
}
if($enviar_cpf == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET foto_cpf = '$foto_cpf' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['foto_cpf']['tmp_name'], "../docs_clientes/".$foto_cpf));
}
if($enviar_frente_rg == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET frente_rg = '$frente_rg' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['frente_rg']['tmp_name'], "../docs_clientes/".$frente_rg));
}
if($enviar_verso_rg == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET verso_rg = '$verso_rg' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['verso_rg']['tmp_name'], "../docs_clientes/".$verso_rg));
}if($enviar_comprovante_renda == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET comprovante_renda = '$comprovante_renda' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['comprovante_renda']['tmp_name'], "../docs_clientes/".$comprovante_renda));
}
if($enviar_comprovante_endereco == 'SIM'){
	mysqli_query($conexao_bd, "UPDATE clientes SET comprovante_endereco = '$comprovante_endereco' WHERE cpf = '$cliente'");
    (move_uploaded_file($_FILES['comprovante_endereco']['tmp_name'], "../docs_clientes/".$comprovante_endereco));
}


mysqli_query($conexao_bd, "UPDATE conta_corrente SET data = '$data', proposta_credito = 'AGUARDA ANALISE', mes = '$mes', ano = '$ano', justificativa = '' WHERE cliente = '$cliente'");

echo "<strong>Documentos foram enviados para analise com sucesso. </strong><br><br><em>Aguarde resultado da analise</em><br> Pressione F5.";

die;


}?>



<?

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM conta_corrente WHERE cliente = '$cliente' AND mes = '$mes' AND ano = '$ano'");
if(mysqli_num_rows($sql_verifica) >= 1){
echo "<strong>Uma nova analise crédito só poderá ser feita uma vez a cada 30 dias. </strong><br><br><em>Aguarde chegar o próximo e solicite uma nova analise</em><br>Pressione F5";
}else{
?>

<form name="" method="post" action="" enctype="multipart/form-data">
<table width="800" border="0">
  <tr>
    <td bgcolor="#6666FF"><strong>SELFIE</strong></td>
    <td bgcolor="#CCCCCC"><strong>FRENTE DO CPF</strong></td>
    <td bgcolor="#99CC00"><strong>FRENTE DO RG</strong></td>
    <td bgcolor="#99CC00"><strong>VERSO DO RG</strong></td>
    <td bgcolor="#FFCC00"><strong>COMPROVANTE DE RENDA</strong></td>
    <td bgcolor="#9999CC"><strong>COMPROVANTE DE ENDEREÇO</strong></td>
    <td bgcolor="#009999">&nbsp;</td>
  </tr>
  <tr>
    <td><label for="fileField"></label>
    <input type="file" name="selfie" id="fileField"></td>
    <td><label for="fileField"></label>
    <input type="file" name="foto_cpf" id="fileField"></td>
    <td><label for="fileField2"></label>
      <input type="file" name="frente_rg" id="fileField2"></td>
    <td><label for="fileField3"></label>
    <input type="file" name="verso_rg" id="fileField3"></td>
    <td><label for="fileField4"></label>
    <input type="file" name="comprovante_renda" id="fileField4"></td>
    <td><label for="fileField5"></label>
    <input type="file" name="comprovante_endereco" id="fileField5"></td>
    <td bgcolor="#009999"><input class="input" type="submit" name="button" id="button" value="ENVIAR"></td>
  </tr>
  <tr>
    <td><input type="radio" name="enviar_selfie" id="radio6" value="SIM" />
Enviar
  <label for="radio6"></label></td>
    <td><input type="radio" name="enviar_cpf" id="radio" value="SIM" />
Enviar
  <label for="radio"></label></td>
    <td><input type="radio" name="enviar_frente_rg" id="radio2" value="SIM" />
      <label for="radio2">Enviar</label></td>
    <td><input type="radio" name="enviar_verso_rg" id="radio3" value="SIM" />
      <label for="radio3">Enviar</label></td>
    <td><input type="radio" name="enviar_comprovante_renda" id="radio4" value="SIM" />
      <label for="radio4">Enviar</label></td>
    <td><input type="radio" name="enviar_comprovante_endereco" id="radio5" value="SIM">
      <label for="radio5">Enviar</label></td>
    <td bgcolor="#009999">&nbsp;</td>
  </tr>
</table>
</form>
<hr />
<ul>
<li>Uma nova analise de crédito só poderá ser enviada após 30 dias passados a últimas analise.</li>
<li>Só envie novos documentos do cliente caso seja novo e diferente do anterior.</li>
<li>Se necessário atualize as informações básicas do cliente usando o código 413 antes do envio de novos documentos.</li>
<li>O resultado da nova analise sairá em até 48 horas corridas após o envio.</li>
<li>Caso o cliente seja aprovado, o crédito deverá liberado somente após a assinatura do contrado de prestação de serviço.</li>
</ul>
<? } ?>
</div><!-- box -->
</body>
</html>