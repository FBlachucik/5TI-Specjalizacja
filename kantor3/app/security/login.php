<?php
require_once dirname(__FILE__).'/../../config.php';

//pobranie parametrów
function getParamsLogin(&$form){
	$form['login'] = isset ($_REQUEST ['login']) ? $_REQUEST ['login'] : null;
	$form['pass'] = isset ($_REQUEST ['pass']) ? $_REQUEST ['pass'] : null;
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validateLogin(&$form,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($form['login']) && isset($form['pass']))) {
		//sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['login'] == "") {
		$msgs [] = 'Nie podano loginu';
	}
	if ( $form['pass'] == "") {
		$msgs [] = 'Nie podano hasła';
	}

	//nie ma sensu walidować dalej, gdy brak parametrów
	if (count ( $messages ) > 0) return false;

	// sprawdzenie, czy dane logowania są poprawne
	// - takie informacje najczęściej przechowuje się w bazie danych
	//   jednak na potrzeby przykładu sprawdzamy bezpośrednio
	if ($form['login'] == "admin" && $form['pass'] == "admin") {
		session_start();
		$_SESSION['role'] = 'admin';
		return true;
	}
	if ($form['login'] == "user" && $form['pass'] == "user") {
		session_start();
		$_SESSION['role'] = 'user';
		return true;
	}
	
	$messages [] = 'Niepoprawny login lub hasło';
	return false; 
}

//inicjacja potrzebnych zmiennych
$form = null;
$messages = array();
//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

// pobierz parametry i podejmij akcję
getParamsLogin($form);

if (!validateLogin($form,$messages)) {
	
	$page_title = 'Kantor v3 - logowanie';
	$page_description = 'Proste szablony budujące widok w sposób puzzlowy - dołączanie części HTML zdefiniowanych w różnych .php';
	$page_header = 'Strona logowania';
	$page_footer = 'Zapraszamy do skorzystania z naszego kantoru';

	//jeśli błąd logowania to wyświetl formularz z tekstami z $messages
	include _ROOT_PATH.'/app/security/login_view.php';
} else { 
	//ok przekieruj lub "forward" na stronę główną
	
	//redirect - przeglądarka dostanie ten adres do "przejścia" na niego (wysłania kolejnego żądania)
	header("Location: "._APP_URL);
	
	//"forward"
	
	//include _ROOT_PATH.'/index.php';

}