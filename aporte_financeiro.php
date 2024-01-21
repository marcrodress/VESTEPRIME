<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/aporte_financeiro.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<? require "topo.php";  require "scripts/verificador_caixa.php"; ?>
<hr>
<div class="container" style="background:#FFF; border-radius:5px;">
    <div class="row">
        <h4><strong>Entrada de recursos</strong></h4>
        <hr />
    </div>
    
    <div class="row">
     
     <form name="" method="post" enctype="multipart/form-data">
         <table width="1108" border="0">
          <tr>
            <td width="145"><input class="form-control form-control-lg" name="valor" type="text" placeholder="Valor"></td>
            <td width="221"> <select name="motivo" class="form-control form-control-lg">
                    <option value="COFRE">COFRE</option>
                    <option value="EXTERNO">EXTERNO</option>
                </select></td>
            <td width="657"> <input class="form-control form-control-lg" type="text" name="descricao" placeholder="Descreva o motivo da entrada de recursos"></td>
            <td width="67"><button type="submit" name="enviar" class="btn form-control-lg btn-primary mb-2">Enviar</button></td>
          </tr>
        </table>
     </form>

       <? if(isset($_POST['enviar'])){
        
		$valor = $_POST['valor'];
		$motivo = $_POST['motivo'];
		$descricao = $_POST['descricao'];
		
		if($valor == ''){
			echo "<script>alert('O valor precisa ser informado!');</script>";
        }elseif($descricao == ''){
			echo "<script>alert('A descrição da entrada de recursos deve ser informado!');</script>";
        }else{
			mysqli_query($conexao_bd, "INSERT INTO aporte_financeiro (codeCaixa, turno, operador, data, data_completa, dia, mes, ano, valor, motivo, descricao) VALUES ('$codeCaixa', '$turno', '$operador', '$data', '$data_completa', '$dia', '$mes', '$ano', '$valor', '$motivo', '$descricao')");
			
			echo "
				<script>
					window.alert('Informação registrada com sucesso!');
					window.location='';
				</script>
				
			";
			
			
		}
	   
	   }?>
    </div>

    <div class="row mt-3">
        <table class="table table-striped table-dark" width="736" border="1">
         <thead>
          <tr>
            <th width="18">ID</th>
            <th width="173">OPERADOR</th>
            <th width="137">DATA</th>
            <th width="73">VALOR</th>
            <th width="85">FONTE</th>
            <th width="188">DESCRI&Ccedil;&Atilde;O</th>
            <th width="16">&nbsp;</th>
          </tr>
         </thead>
         <tbody>
         <?
          
		  $sql_aporte = mysqli_query($conexao_bd, "SELECT * FROM aporte_financeiro WHERE data = '$data'");
		 	while($resAporte = mysqli_fetch_array($sql_aporte)){
		 ?>
         
            <tr>
              <th scope="row"><? echo $resAporte['id']; ?></th>
              <td align="center"><? 
			  	$sqlOperador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$operador'");
					 while($resOperador = mysqli_fetch_array($sqlOperador)){
						 echo $resOperador['nome'];
					}
			   ?></td>
              <td><? echo $resAporte['data_completa']; ?></td>
              <td>R$ <? echo number_format($resAporte['valor'],2,',','.'); ?></td>
              <td><? echo $resAporte['motivo']; ?></td>
              <td><? echo $resAporte['descricao']; ?></td>
              <td>
              <? if($operador == '05379839371'){ ?>
               <a href="?p=excluir&id=<? echo $resAporte['id']; ?>"><img src="img/deleta.fw.png" width="16" height="15" title="Excluir registro" /></a>
              <? } ?>
              </td>
           </tr>
         <? } ?>         
         </tbody>
        </table>
        
    </div>

</div>
<? if($_GET['p'] == 'excluir'){

	mysqli_query($conexao_bd, "DELETE FROM aporte_financeiro WHERE id = '".$_GET['id']."'");
	
	echo "
				<script>
					window.alert('Informação registrada com sucesso!');
					window.location='aporte_financeiro.php';
				</script>
				
			";

}?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
