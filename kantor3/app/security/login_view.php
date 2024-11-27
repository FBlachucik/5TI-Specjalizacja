<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>


<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/security/login.php" method="post">
	<legend>Logowanie</legend>
	<fieldset>
		<label for="id_login">Login: </label>
		<input id="id_login" type="text" placeholder="Podaj login" name="login" value="<?php out($form['login']); ?>" />
		<label for="id_pass">Hasło: </label>
		<input id="id_pass" type="password" placeholder="Podaj hasło" name="pass" />
	</fieldset>
	<input type="submit" value="zaloguj" class="pure-button pure-button-primary"/>
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

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>