<?php

	session_start();
	require_once('functions.php');
	tworz_naglowek_html('Zmiana hasła');
	sprawdz_prawdziwosc_uzytkownika();
	wyswietl_menu_uzytkownika();
	wyswietl_haslo_form();
	tworz_stopke_html();
	
?>