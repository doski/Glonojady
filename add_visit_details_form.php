<?php
	
	session_start();
	require_once('functions.php');
	tworz_naglowek_html('Dodaj opis wizyty');
	sprawdz_prawdziwosc_uzytkownika();
	wyswietl_menu_uzytkownika();
	wyswietl_wizyta_dodaj_opis_form();
	tworz_stopke_html();
	
?>