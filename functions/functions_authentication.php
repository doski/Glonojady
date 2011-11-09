<?php
	
	//funkcja logowania
	function loguj($pesel, $haslo){
		$lacz = lacz_baza_danych();
		$wynik = $lacz->query("select * from pracownicy pr, pacjenci pa where (pr.pesel_pracownika='$pesel' and pr.haslo = md5('$haslo')) or (pa.pesel_pacjenta='$pesel' and pa.haslo = md5('$haslo'))");
		if(!$wynik){
			throw new Exception('Logowanie nie powiodło się.');
		}
		if($wynik->num_rows>0){
			return true;
		}
		else{
			throw new Exception('Logowanie nie powiodło się.');
		}
	}
	
	//sprawdzenie czy użytkownik jest zalogowany
	function sprawdz_prawdziwosc_uzytkownika(){
		if(isset($_SESSION['prawidlowy_uzytkownik'])){
			echo 'Zalogowano jako <b>'.stripslashes($_SESSION['prawidlowy_uzytkownik']).'</b>.<br />Typ użytkownika: '.stripslashes($_SESSION['typ_uzytkownika']).'.<br /><br />';
		}
		else{
			echo '<p class="error">Nie jesteś zalogowany.</p><br />';
			wyswietl_formularz_logowania();
			tworz_stopke_html();
			exit;
		}
	}
	
	//sprawdzanie typu użytkownika
	function sprawdz_typ_uzytkownika($pesel){
		$lacz = lacz_baza_danych();
		$wynik = $lacz->query("select specjalizacja from pracownicy where pesel_pracownika='$pesel'");
		$typ = $wynik->fetch_row();
		if(!$typ[0]){
			$_SESSION['typ_uzytkownika'] = 'pacjent';
		}
		else{
			switch($typ[0]){
				case 'sekretarka' :
					$_SESSION['typ_uzytkownika'] = 'sekretarka';
				break;
				case 'kierownik' :
					$_SESSION['typ_uzytkownika'] = 'kierownik';
				break;
				default :
					$_SESSION['typ_uzytkownika'] = 'lekarz';
				break;
			}
		}
	}

?>