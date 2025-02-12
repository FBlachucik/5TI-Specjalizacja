<?php
// KONTROLER strony kantora
require_once dirname(__FILE__).'/../config.php';
//załaduj Smarty

require_once _ROOT_PATH.'/lib/smarty/libs/Smarty.class.php';

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

// 4. Przygotowanie danych dla szablonu

$smarty = new Smarty\Smarty();

$smarty->assign('app_url',_APP_URL);
$smarty->assign('root_path',_ROOT_PATH);
$smarty->assign('page_title','Przykład 04');
$smarty->assign('page_description','(Prawie) profesjonalne szablonowanie oparte na bibliotece Smarty');
$smarty->assign('page_header','Szablony Smarty');

//pozostałe zmienne niekoniecznie muszą istnieć, dlatego sprawdzamy aby nie otrzymać ostrzeżenia
$smarty->assign('form',$form);
$smarty->assign('result',$result);
$smarty->assign('messages',$messages);
$smarty->assign('infos',$infos);

// 5. Wywołanie szablonu
$smarty->display(_ROOT_PATH.'/app/calc.html');