<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h2>Kantor</h2>

<a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">Chroniona strona (w budowie)</a>
<a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a><br/><br/>

<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
	<fieldset>
		<label for="id_kwota">Kwota: </label>
		<input id="id_kwota" type="text" placeholder="wartość kwoty" name="kwota" value="<?php out($form['id_kwota']); ?>" /><br />
		<label for="id_kurs">Kurs: </label>
		<input id="id_kurs" type="text" placeholder="wartość kursu" name="kurs" value="<?php out($form['id_kurs']); ?>" /><br /><br />
		<label for="id_prz">Przelicznik: </label> <br>
		<input type="radio" name="prz" value="euroPLN"> € => PLN <br>
		<input type="radio" name="prz" value="plnEuro"> PLN => € <br>
	</fieldset>
	<button type="submit" class="pure-button pure-button-primary">Oblicz</button>
</form>	

<div class="messages">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print($result). " €/PLN"; ?>
</p>
<?php } ?>

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>