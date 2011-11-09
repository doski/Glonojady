<?php

	//sprawdzanie, czy losowe hasło zostało zmienione
	function czy_zmieniono_haslo(){
		$lacz = lacz_baza_danych();
		$pesel = $_SESSION['prawidlowy_uzytkownik'];
		if($_SESSION['typ_uzytkownika'] == 'lekarz' || $_SESSION['typ_uzytkownika'] == 'kierownik' || $_SESSION['typ_uzytkownika'] == 'sekretarka'){
			$wynik = $lacz->query("select czy_zmieniono_haslo from pracownicy where pesel_pracownika = '$pesel'");
		}
		else{
			$wynik = $lacz->query("select czy_zmieniono_haslo from pacjenci where pesel_pacjenta = '$pesel'");
		}
		$zmiana = $wynik->fetch_row();
		if($zmiana[0]==0){
			echo '<p class="warning">Nadal posiadasz losowe hasło. Aby bezpiecznie korzystać z serwisu <a href="password_change_form.php">zmień je</a>.</p><br />';
		}
	}
	
	//funkcja zmiany hasła
	function zmien_haslo($pesel, $stare_haslo, $nowe_haslo){
		try{
			loguj($pesel, $stare_haslo);
		}
		catch(Exception $e){
			tworz_naglowek_html('Błąd zmiany hasła');
			wyswietl_menu_uzytkownika();
			echo 'Podałeś nieprawidłowe stare hasło.<br /><br />';
			wyswietl_haslo_form();
			tworz_stopke_html();
			exit;
		}
		$lacz = lacz_baza_danych();
		if($_SESSION['typ_uzytkownika'] == 'lekarz' || $_SESSION['typ_uzytkownika'] == 'kierownik' || $_SESSION['typ_uzytkownika'] == 'sekretarka'){
			$wynik = $lacz->query("update pracownicy set haslo = md5('$nowe_haslo'), czy_zmieniono_haslo = '1' where pesel_pracownika = '$pesel'");
		}
		else{
			$wynik = $lacz->query("update pacjenci set haslo = md5('$nowe_haslo'), czy_zmieniono_haslo = '1' where pesel_pacjenta = '$pesel'");
		}
		if(!$wynik){
			throw new Exception('<p class="error">Zmiana hasła nie powiodła się.</p><br />');
		}
		else{
			return true; 
		}
	}
	
	//funkcja dodawania wizyty
	function dodaj_opis_wizyty($pesel, $wizyta, $opis){
		$lacz = lacz_baza_danych();
		$wynik = $lacz->query("update wizyty set opis = '$opis' where pesel_pracownika = '$pesel' and data = '2011-10-18 14:00:00'");
		if($wynik == false){
			echo '<p class="error">Dodanie opisu wizyty nie powiodło się.</p><br />';
			exit;
		}
		else{
			return true; 
		}
	}
	
	//funkcja dodawania konta pacjenta
	function dodaj_konto_pacjenta($pesel_pacjenta, $imie, $nazwisko, $kod_pocztowy, $miasto, $ulica, $nr_domu, $nr_mieszkania, $ubezpieczenie){
		$haslo1 = md5(time());
		$haslo1 = substr($haslo1,0,8);
		$lacz = lacz_baza_danych();
		$haslo2 = md5($haslo1);
		$wynik = $lacz->query("insert into pacjenci (pesel_pacjenta, haslo, imie, nazwisko, kod_pocztowy, miasto, ulica, nr_domu, nr_mieszkania, ubezpieczenie, czy_zmieniono_haslo) values ('$pesel_pacjenta', '$haslo1', '$imie', '$nazwisko', '$kod_pocztowy', '$miasto', '$ulica', '$nr_domu', '$nr_mieszkania', '$ubezpieczenie', 0)");
		echo '<p class="correct">Konto utworzone pomyślnie. Twoje hasło to: '.$haslo1.'</p><br />';
		if($wynik == false){
			throw new Exception('<p class="error">Dodanie konta pacjenta nie powiodło się.</p><br />');
		}
		else{
			return true; 
		}
	}

?>