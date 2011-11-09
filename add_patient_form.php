<?php

	session_start();
	require_once('functions.php');
	tworz_naglowek_html('Utwórz konto pacjenta');
	sprawdz_prawdziwosc_uzytkownika();
	wyswietl_menu_uzytkownika();
	wyswietl_pacjent_dodaj_form();
	tworz_stopke_html();

?>