<?php
	
	session_start();
	require_once('functions.php');
	$pesel = $_POST['pesel'];
	$haslo = $_POST['haslo'];
	if($pesel && $haslo){
		try{
			loguj($pesel, $haslo);
			$_SESSION['prawidlowy_uzytkownik'] = $pesel;
			sprawdz_typ_uzytkownika($pesel);
		}
		catch(Exception $e){
			tworz_naglowek_html('Nieudane logowanie');
			echo '<p class="error">Niepoprawny pesel lub hasło.</p><br />';
			wyswietl_formularz_logowania();
			tworz_stopke_html();
			exit;
		}
	}
	else if(isset($pesel) || isset($haslo)){
		tworz_naglowek_html('Nieudane logowanie');
		echo '<p class="error">Niepoprawny pesel lub hasło.</p><br />';
		wyswietl_formularz_logowania();
		tworz_stopke_html();
		exit;
	}
	tworz_naglowek_html('Panel');
	sprawdz_prawdziwosc_uzytkownika();
	wyswietl_menu_uzytkownika();
	czy_zmieniono_haslo();
	echo '<p class="correct">Treść dla zalogowanego.</p>';
	tworz_stopke_html();
	
?>