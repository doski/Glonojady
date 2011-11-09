<?php

	session_start();
	require_once('functions.php');
	
	$wizyta = $_POST['wizyta'];
	$opis = $_POST['opis'];
	
	try{
		if(!wypelniony($_POST)){
			throw new Exception('<p class="error">Formularz nie został wypełniony całkowicie. Proszę spróbować ponownie.</p><br />');
		}
		//próba dodania opisu wizyty
		dodaj_opis_wizyty($_SESSION['prawidlowy_uzytkownik'], $wizyta, $opis);
		tworz_naglowek_html('Opis dodany pomyślnie');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo '<p class="correct">Opis wizyty został dodany.</p><br />';
	}
	catch(Exception $e){
		tworz_naglowek_html('Błąd dodawania opisu wizyty');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo $e->getMessage();
		wyswietl_wizyta_dodaj_opis_form();
	}
	tworz_stopke_html();

?>