<?php

session_start();
require_once('functions.php');
$stary_uzytkownik = $_SESSION['prawidlowy_uzytkownik'];  
unset($_SESSION['prawidlowy_uzytkownik']);
$wynik_niszcz = session_destroy();

tworz_naglowek_html('Wylogowywanie');

if (!empty($stary_uzytkownik))
{
  if ($wynik_niszcz)
  {
    // jeżeli użytkownik zalogowany i nie wylogowany
    echo '<p class="correct">Wylogowano.</p><br />';
	wyswietl_formularz_logowania();
  }
  else
  {
   // użytkownik zalogowany i wylogowanie niemożliwe
    echo '<p class="error">Wylogowanie niemożliwe.</p><br />';
  }
}
else
{
  // jeżeli brak zalogowania, lecz w jakiś sposób uzyskany dostęp do strony
  echo '<p class="error">Użytkownik niezalogowany, brak wylogowania.</p><br />';
}

tworz_stopke_html();

?>

