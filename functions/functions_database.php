<?php

	//połączenie z bazą
	function lacz_baza_danych(){
		$wynik = new mysqli('localhost', 'przychodnia', 'Przychodnia2011_', 'przychodnia'); 
		$wynik->query('SET NAMES utf8');
		$wynik->query('SET CHARACTER_SET utf8_unicode_ci');
		if(!$wynik){
			throw new Exception('Połączenie z serwerem bazy danych nie powiodło się');
		}
		else{
			return $wynik;
		}
	}

?>