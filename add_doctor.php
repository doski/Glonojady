<?php

	session_start();
	require_once('functions.php');
	
	$pesel_pracownika = $_POST['pesel_pracownika'];
	$haslo = $_POST['haslo1'];
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];	
	$specjalizacja = $_POST['specjalizacja'];	
	$godz_od = $_POST['godz_od'];
	$godz_do = $_POST['godz_do'];	
	
	try{
		//próba utworzenia konta użytkownika
		dodaj_lekarza($pesel_pracownika, $haslo, $imie, $nazwisko, $specjalizacja, $godz_od, $godz_do);
		tworz_naglowek_html('Konto utworzone pomyślnie');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo '<p class="correct">Lekarz został dodany.</p><br />';
	}
	catch(Exception $e){
		tworz_naglowek_html('Błąd dodawania lekarza');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo $e->getMessage();
		wyswietl_nowy_lekarz_form();
	}
	tworz_stopke_html();

?>