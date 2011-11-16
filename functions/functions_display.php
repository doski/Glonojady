<?php

	//wyświetlenie nagłówka HTML
	function tworz_naglowek_html($tytul){
		?>
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
		<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $tytul; ?></title>
		<meta name="description" content="" />
		<link rel="stylesheet" type="text/css" href="css/reset.css" />
		<link rel="stylesheet" type="text/css" href="css/main.css" />
		</head>
		<body>
			<h1>Przychodnia</h1>
			<hr />
		<?php
		if($tytul){
			tworz_tytul_html($tytul);
		}
	}
	
	//wyświetlanie stopki HTML
	function tworz_stopke_html(){
		?>
		</body>
		</html>
		<?php
	}
	
	//wyświetlanie tytułu
	function tworz_tytul_html($tytul){
		?>
		<h2><?php echo $tytul; ?></h2>
		<hr />
		<?php
	}
	
	//wyświetlanie formularza logowania
	function wyswietl_formularz_logowania(){
		?>
		<form action="member.php" method="post">
			<label for="pesel">Pesel:</label>
			<input type="text" name="pesel" /><br /><br />
			<label for="pesel">Hasło:</label>
			<input type="password" name="haslo" /><br /><br />
			<input type="submit" value="Zaloguj" />
		</form>
		<?php
	}
	
	//wyświetlenie formularza zmiany hasła
	function wyswietl_haslo_form(){
		?>
		<form action="password_change.php" method="post">
			<label for="stare_haslo">Obecne hasło:</label>
			<input type="text" name="stare_haslo" /><br /><br />
			<label for="nowe_haslo1">Nowe hasło:</label>
			<input type="text" name="nowe_haslo1" /><br /><br />
			<label for="nowe_haslo2">Powtórzenie nowego hasła:</label>
			<input type="text" name="nowe_haslo2" /><br /><br />
			<input type="submit" value="Zmień" />
		</form>
		<?php
	}
	
	//formularz edycji danych przez pacjenta
	function wyswietl_edycja_pacjent_form(){
		?>
		<form action="data_patient_change.php" method="post">
			<label for="email">E-mail:</label>
			<input type="text" name="email" /><br /><br />
			<label for="telefon">Telefon:</label>
			<input type="text" name="telefon" /><br /><br />
			<label for="haslo">Wpisz hasło: </label>
			<input type="text" name="haslo" /><br /><br />
			<input type="submit" value="Zmień" />
		</form>		
		<?php
	}	
	
	//sprawdzanie wypełnienia pól formularza
	function wypelniony($zmienne_formularza){
		foreach($zmienne_formularza as $klucz => $wartosc){
			if(!isset($klucz) || ($wartosc == '')){
				return false;
			}
		} 
		return true;
	}
	
	//wyświetlanie menu użytkownika
	function wyswietl_menu_uzytkownika(){
		?>
		<a href="member.php">Panel</a>
		&nbsp;|&nbsp;
		<?php
			if($_SESSION['typ_uzytkownika'] == 'lekarz'){
				echo'<a href="add_visit_details_form.php">Dodaj opis wizyty</a>';
				echo '&nbsp;|&nbsp;';
			}
			if($_SESSION['typ_uzytkownika'] == 'sekretarka'){
				echo'<a href="add_patient_form.php">Utwórz konto pacjenta</a>';
				echo '&nbsp;|&nbsp;';
			}
			if($_SESSION['typ_uzytkownika'] == 'kierownik'){
				echo'<a href="add_doctor_form.php">Dodaj lekarza</a>';
				echo '&nbsp;|&nbsp;';
			}
		?>
		<a href="password_change_form.php">Zmiana hasła</a>
		&nbsp;|&nbsp;
		<a href="logout.php">Wyloguj</a>
		&nbsp;|&nbsp;
		<hr />
		<?php
	}
	
	//wyswietlanie formularza dodawania opisu wizyty przez lekarza
	function wyswietl_wizyta_dodaj_opis_form(){
		?>
		<form action="add_visit_details.php" method="post">
			<label for="wizyta">Wybierz wizytę:</label><br /><br />
			<?php
				$lacz = lacz_baza_danych();
				mysql_query("SET NAMES 'utf8'");
				$lekarz=$_SESSION['prawidlowy_uzytkownik'];
				$wynik = $lacz->query("select wi.data, wi.pesel_pacjenta, pa.imie, pa.nazwisko from wizyty wi, pacjenci pa where wi.pesel_pacjenta = pa.pesel_pacjenta and wi.pesel_pracownika = '$lekarz' and wi.opis = '' group by wi.data order by wi.data");
				if(($dane = $wynik->num_rows)==0){
					echo '<p class="error">Brak wizyt bez opisów.</p>';
					tworz_stopke_html();
					exit;
				}
				else{
					while(($dane = $wynik->fetch_assoc())!==null){
						echo '<input type="radio" name="wizyta" value="'.$dane['data'].'" />'.$dane['data'].' '.$dane['nazwisko'].' '.$dane['imie'].' '.$dane['pesel_pacjenta'].'<br />';
					}
				}
			?>
			<input type="radio" name="wizyta" value="zla" />Powinno zepsuć<br />
			<br />
			<label for="opis">Wpisz opis wizyty:</label><br /><br />
			<textarea name="opis" rows="10" cols="100"></textarea><br /><br />
			<input type="submit" value="Dodaj opis wizyty" />
		</form>
		<?php
	}
	
	//wyświetlenie formularza dodawania nowych pacjentów
	function wyswietl_pacjent_dodaj_form(){
		?>
		<form action="add_patient.php" method="post">
			<label for="pesel_pacjenta">PESEL pacjenta:</label>
			<input type="text" name="pesel_pacjenta" /><br /><br />
			<label for="imie">Imię:</label>
			<input type="text" name="imie" /><br /><br />
			<label for="nazwisko">Nazwisko:</label>
			<input type="text" name="nazwisko" /><br /><br />
			<label for="kod_pocztowy">Kod pocztowy:</label>
			<input type="text" name="kod_pocztowy" /><br /><br />
			<label for="miasto">Miasto:</label>
			<input type="text" name="miasto" /><br /><br />
			<label for="ulica">Ulica:</label>
			<input type="text" name="ulica" /><br /><br />
			<label for="nr_domu">Nr domu:</label>
			<input type="text" name="nr_domu" /><br /><br />
			<label for="nr_mieszkania">Nr mieszkania:</label>
			<input type="text" name="nr_mieszkania" /><br /><br />
			<label for="ubezpieczenie">Ubezpieczenie:</label>
			<input type="text" name="ubezpieczenie" /><br /><br />
			<input type="submit" value="Utwórz konto" />
		</form>		
		<?php
	}
	
	//formularz dodawania lekarza
	function wyswietl_nowy_lekarz_form(){
		?>
		<form action="add_doctor.php" method="post">
			<label for="pesel_pracownika">PESEL:</label>
			<input type="text" name="pesel_pracownika" /><br /><br />
			<label for="haslo1">Hasło:</label>
			<input type="text" name="haslo1" /><br /><br />
			<label for="haslo2">Powtórz hasło:</label>
			<input type="text" name="haslo2" /><br /><br />
			<label for="imie">Imię:</label>
			<input type="text" name="imie" /><br /><br />
			<label for="nazwisko">Nazwisko:</label>
			<input type="text" name="nazwisko" /><br /><br />
			<label for="specjalizacja">Specjalizacja:</label>
			<input type="text" name="specjalizacja" /><br /><br />
			Godziny pracy:<br /><br/>
			<label for="godz_od">Od:</label>
			<input type="text" name="godz_od" /><br /><br />
			<label for="godz_do">Do:</label>
			<input type="text" name="godz_do" /><br /><br />
			<input type="submit" value="Dodaj lekarza" />
		</form>		
		<?php
	}

?>