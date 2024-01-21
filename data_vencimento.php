<form action="" method="post" enctype="multipart/form-data">
  <label for="diaFinal">Dia de final</label>
  <input name="diaFinal" type="text" autofocus>
  <label for="mesFinal">Mês final</label>
  <input name="mesFinal" type="text">
  <label for="anoFinal">Ano final</label>
  <input type="text" name="anoFinal" value="2026">
  <input type="submit" name="button" value="Começar">
</form>
<hr>






<? if(isset($_POST['button'])){
require_once "conexao.php";

$dataFinal = $_POST['diaFinal'];
$mesReferencia = $_POST['mesFinal']+0;
$ano = $_POST['anoFinal'];
$codigoInicial = 0;

$sqlUltimoCodigo = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento ORDER BY id DESC LIMIT 1");
while($resUltimoCodigo = mysqli_fetch_array($sqlUltimoCodigo)){
    $codigoInicial = $resUltimoCodigo['codigo'];
}


if($mesReferencia<10){
    $mesReferencia = "0$mesReferencia";
}

$dataCadastro = 0;

for($i=01; $i<=$dataFinal; $i++){ $codigoInicial++;

    if($i<10){
        $i = "0$i";
    }

   

    $dataCadastro = "$i/$mesReferencia/$ano";

    $verificaData = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento = '$dataCadastro'");
    if(mysqli_num_rows($verificaData) <=0){
        mysqli_query($conexao_bd, "INSERT INTO datas_vencimento (codigo, vencimento) VALUES ('$codigoInicial', '$dataCadastro')");
    }
    
    echo $dataCadastro;
    echo " - $codigoInicial";
    echo "<br>";

}

}?>