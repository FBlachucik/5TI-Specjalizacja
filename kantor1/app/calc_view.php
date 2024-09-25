<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta charset="utf-8" />
<title>Kantor</title>
</head>
<body>

<form action="<?php print(_APP_URL);?>/app/calc.php" method="post">
	<label for="id_kwota">Kwota: </label>
	<input id="id_kwota" type="text" name="kwota" value="<?php isset($kwota)?print($kwota):""; ?>" /><br />
	<label for="id_kurs">Kurs: </label>
	<input id="id_kurs" type="text" name="kurs" value="<?php isset($kurs)?print($kurs):""; ?>" /><br /><br />
	<label for="id_prz">Przelicznik: </label> <br>
	<input type="radio" name="prz" value="euroZlote"> € => PLN <br>
	<input type="radio" name="prz" value="zloteEuro"> PLN => € <br>
	<input type="submit" value="Oblicz" />
</form>	

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
		echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #a62d2d; width:300px;">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
<div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
<?php echo 'Możesz zakupić '.$result. " €/PLN."; ?>
</div>
<?php } ?>

</body>
</html>