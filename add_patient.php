<?php

	session_start();
	require_once('functions.php');
	
	$pesel_pacjenta = $_POST['pesel_pacjenta'];
	$imie = $_POST['imie'];
	$nazwisko = $_POST['nazwisko'];
	$kod_pocztowy = $_POST['kod_pocztowy'];
	$miasto = $_POST['miasto'];
	$ulica = $_POST['ulica'];
	$nr_domu = $_POST['nr_domu'];
	$nr_mieszkania = $_POST['nr_mieszkania'];
	$ubezpieczenie = $_POST['ubezpieczenie'];
	
	try{
		//próba utworzenia konta użytkownika
		dodaj_konto_pacjenta($pesel_pacjenta, $imie, $nazwisko, $kod_pocztowy, $miasto, $ulica, $nr_domu, $nr_mieszkania, $ubezpieczenie);
		tworz_naglowek_html('Konto utworzone pomyślnie');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo '<p class="correct">Konto pacjenta zostało dodane.</p><br />';
	}
	catch(Exception $e){
		tworz_naglowek_html('Błąd dodawania konta pacjenta');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo $e->getMessage();
		wyswietl_pacjent_dodaj_form();
	}
	tworz_stopke_html();

?>