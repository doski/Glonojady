<?php
	
	session_start();
	require_once('functions.php');
	tworz_naglowek_html('Dodaj lekarza');
	sprawdz_prawdziwosc_uzytkownika();
	wyswietl_menu_uzytkownika();
	wyswietl_nowy_lekarz_form();
	tworz_stopke_html();
?>