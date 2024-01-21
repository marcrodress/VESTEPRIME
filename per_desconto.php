<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

$taxa_parcelamento = 0.03;


	if($dias_atraso > 30 && $dias_atraso <= 90){
		$percentual = 0.2;
	}elseif($dias_atraso > 90 && $dias_atraso <= 120){
		$percentual = 0.35;
	}elseif($dias_atraso > 120 && $dias_atraso <= 150){
		$percentual = 0.4;
	}elseif($dias_atraso > 150 && $dias_atraso <= 180){
		$percentual = 0.45;
	}elseif($dias_atraso > 180 && $dias_atraso <= 210){
		$percentual = 0.50;
	}elseif($dias_atraso > 180 && $dias_atraso <= 210){
		$percentual = 0.55;
	}elseif($dias_atraso > 210 && $dias_atraso <= 240){
		$percentual = 0.60;
	}elseif($dias_atraso > 240 && $dias_atraso <= 270){
		$percentual = 0.65;
	}elseif($dias_atraso > 270 && $dias_atraso <= 300){
		$percentual = 0.70;
	}elseif($dias_atraso > 300 && $dias_atraso <= 330){
		$percentual = 0.75;	
	}elseif($dias_atraso > 330 && $dias_atraso <= 360){
		$percentual = 0.80;	
	}elseif($dias_atraso > 360 && $dias_atraso <= 390){
		$percentual = 0.85;	
	}elseif($dias_atraso > 390 && $dias_atraso <= 730){
		$percentual = 0.90;		
	}
?>
</body>
</html>