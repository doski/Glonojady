<?php

	session_start();
	require_once('functions.php');
	
	$stare_haslo = $_POST['stare_haslo'];
	$nowe_haslo1 = $_POST['nowe_haslo1'];
	$nowe_haslo2 = $_POST['nowe_haslo2'];
	
	try{
		if(!wypelniony($_POST)){
			throw new Exception('<p class="error">Formularz nie został wypełniony całkowicie. Proszę spróbować ponownie.</p><br />');
		}
		if($nowe_haslo1!=$nowe_haslo2){
			throw new Exception('<p class="error">Wprowadzone hasła nie są identyczne. Hasło nie zostało zmienione.</p><br />');
		}
		if(strlen($nowe_haslo1)<6){
			throw new Exception('<p class="error">Nowe hasło musi mieć długość co najmniej 6 znaków. Proszę spróbować ponownie.</p><br />');
		}
		// próba uaktualnienia
		zmien_haslo($_SESSION['prawidlowy_uzytkownik'], $stare_haslo, $nowe_haslo1);
		tworz_naglowek_html('Hasło zmienione pomyślnie');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo '<p class="correct">Hasło zmienione.</p><br />';
	}
	catch(Exception $e){
		tworz_naglowek_html('Błąd zmiany hasła');
		sprawdz_prawdziwosc_uzytkownika();
		wyswietl_menu_uzytkownika();
		echo $e->getMessage();
		wyswietl_haslo_form();
	}
	tworz_stopke_html();
	
?>