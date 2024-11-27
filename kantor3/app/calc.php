<?php
// KONTROLER strony kantora
require_once dirname(__FILE__).'/../config.php';

// Kontroler podzielono na część definicji etapów (funkcje)
// oraz część wykonawczą, która te funkcje odpowiednio wywołuje.
// Na koniec wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy  przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//pobranie parametrów
function getParams(&$form){
	$form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$form['kurs'] = isset($_REQUEST['kurs']) ? $_REQUEST['kurs'] : null;
	$form['prz'] = isset($_REQUEST['prz']) ? $_REQUEST['prz'] : null;	
}	


//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro) {
	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['kwota']) && isset($form['kurs']) && isset($form['prz']) ))	return false;	
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['kwota'] == "") $msgs [] = 'Nie podano przeliczanej kwoty';
	if ( $form['kurs'] == "") $msgs [] = 'Nie podano kursu';

	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $x i $y są liczbami całkowitymi
		if (! is_numeric( $form['kwota'] )) $msgs [] = 'Podana kwota nie jest liczbą';
		if (! is_numeric( $form['kurs'] )) $msgs [] = ' Podany kurs nie jest liczbą';
	}

	if (count($msgs) > 0) return false;
	else return true;
	}

// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){

	global $role;
	
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na int
	$form['kwota'] = floatval($form['kwota']);
	$form['kurs'] = floatval($form['kurs']);
	
	//wykonanie operacji
	switch ($form['prz']) {
		case 'euroPLN' :
			if(($form['kwota'] > 100 || $form['kurs'] > 100) && $role !== 'admin'){
				$msgs [] = 'Tylko administrator może działać na kwotach i kursach większych niż 100!';
			} else {
				$result = ($form['kwota'] * $form['kurs']);
				$result = round($result,2);
			}
			break;
		case 'plnEuro' :
			if(($form['kwota'] > 100 || $form['kurs'] > 100) && $role !== 'admin'){
				$msgs [] = 'Tylko administrator może działać na kwotach i kursach większych niż 100!';
			} else {
				$result = ($form['kwota'] / $form['kurs']);
				$result = round($result,2);
			}
		break;
	}
}

//definicja zmiennych kontrolera
$form = null;
$infos = array();
$messages = array();
$result = null;
//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

//Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu
$page_title = 'Kantor v3';
$page_description = 'Proste szablony budujące widok w sposób puzzlowy - dołączanie części HTML zdefiniowanych w różnych .php';
$page_header = 'Proste szablony';
$page_footer = 'Jeszcze raz chciałbym przeprosić za pójście po linii najmniejszego oporu';

include 'calc_view.php';