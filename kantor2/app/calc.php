<?php
// KONTROLER strony kantora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$kwota,&$kurs,&$przelicznik){
	$kwota = isset($_REQUEST['kwota'])?$_REQUEST['kwota']:null;
	$kurs = isset($_REQUEST['kurs'])?$_REQUEST['kurs']:null;
	$przelicznik = isset($_REQUEST['prz'])?$_REQUEST['prz']:null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$kwota,&$kurs,&$przelicznik,&$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($kwota) && isset($kurs) && isset($przelicznik))) {
		// sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
		// teraz zakładamy, ze nie jest to błąd. Po prostu nie wykonamy obliczeń
		return false;
	}

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $kwota == "") {
		$messages [] = 'Nie podano liczby 1';
	}
	if ( $kurs == "") {
		$messages [] = 'Nie podano liczby 2';
	}

	//nie ma sensu walidować dalej gdy brak parametrów
	if (count ( $messages ) != 0) return false;
	
	// sprawdzenie, czy $x i $y są liczbami całkowitymi
	if (! is_numeric( $kwota )) {
		$messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
	}
	
	if (! is_numeric( $kurs )) {
		$messages [] = 'Druga wartość nie jest liczbą całkowitą';
	}	

	if (count ( $messages ) != 0) return false;
	else return true;
}

function process(&$kwota,&$kurs,&$przelicznik,&$messages,&$result){
	global $role;
	
	//konwersja parametrów na int
	$kwota = floatval($kwota);
	$kurs = floatval($kurs);
	
	//wykonanie operacji
	switch ($przelicznik) {
		case 'euroPLN' :
			if(($kwota > 100 || $kurs > 100) && $role !== 'admin'){
				$messages [] = 'Tylko administrator może działać na kwotach i kursach większych niż 100!';
			} else {
				$result = ($kwota * $kurs);
				$result = round($result,2);
			}
			break;
		case 'plnEuro' :
			if(($kwota > 100 || $kurs > 100) && $role !== 'admin'){
				$messages [] = 'Tylko administrator może działać na kwotach i kursach większych niż 100!';
			} else {
				$result = ($kwota / $kurs);
				$result = round($result,2);
			}
	}
}

//definicja zmiennych kontrolera
$kwota = null;
$null = null;
$przelicznik = null;
$result = null;
$messages = array();

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
getParams($kwota,$kurs,$przelicznik);
if ( validate($kwota,$kurs,$przelicznik,$messages) ) { // gdy brak błędów
	process($kwota,$kurs,$przelicznik,$messages,$result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';