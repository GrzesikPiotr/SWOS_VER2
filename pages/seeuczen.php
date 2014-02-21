<?php
session_start();
require 'config.php';

require_once 'uczen.class.php';
?>
<?php
if(!isset($_SESSION['login']) AND !isset($_SESSION['pass'])){
    header("Location:administrator.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="pl" lang="pl" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="generator" content="HTML Tidy for Linux (vers 25 March 2009), see www.w3.org" />
<title>SWOS</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../styles.css" />
<link rel="shortcut icon" href="../images/ico/favicon.ico" />
<meta name="Description" content="SWOS" />
<meta name="keywords" content="SWOS" />
<meta name="Author" content="Piotr Grzesik" />
<meta name="copyright" content="Grzesik Piotr" />
<meta name="Robots" content="ALL" />
<body>
<div id="wrap">
    <div class="header">
        <!-- TITLE -->
        <h5>PROJEKT <strong> SWOS</strong></h5>
        <!-- END TITLE -->
    </div>
    <div class="page">
        <div id="navbg">
            <div id="nav">
               <h3>Zarejestrowani Uczniowie</h3>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                       <?php 

                           //Definicje zmiennych
                           
                           //adres ip serwera mysql który zawiera bazê danych i tabele z osobami 
                           //zapisanymi na listê dystrybucyjna newslettera
                           $adres_ip_serwera_mysql_z_baza_danych = 'localhost';
                           
                           //nazwa bazy danych z tabel¹ newsletter zawieraj¹c¹ osoby zapisane na 
                           //listê dystrybucyjna newslettera
                           $nazwa_bazy_danych = 'swos';
                           
                           //nazwa uzytkownika bazy danych $nazwa_bazy_danych
                           $login_bazy_danych = 'root';
                           
                           //haslo uzytkownika bazy danych $nazwa_bazy_danych
                           $haslo_bazy_danych = 'admin';
                           
                           ////////////////////////////////////////////////////////////
                           //Kod programu
                           
                           //Ustanawiamy po³¹czenie z serwerem mysql
                           if ( !mysql_connect($adres_ip_serwera_mysql_z_baza_danych,
                           
                                        $login_bazy_danych,$haslo_bazy_danych) ) {
                              echo 'Nie moge polaczyc sie z baza danych';
                               exit (0);
                           }
                           //Wybieramy baze danych na serwerze mysql ktora zawiera tabele
                           //newsletter gdzie sa dane osob z listy dystrybucyjnej
                           if ( !mysql_select_db($nazwa_bazy_danych) ) {
                              echo 'Blad otwarcia bazy danych';
                               exit (0);
                           }
                           
                           //Definiujemy zapytanie pobierające wszystkie wiersze z wszystkimi
                           $zapytanie = "SELECT * FROM `uczen` ORDER BY idklasy";
                           //wykonujemy zdefiniowane zapytanie na bazie mysql
                           $wynik = mysql_query($zapytanie);
                           
                           //Wyświetlamy w tabeli html dane pobrane 
                           //Najpierw definiujemy nagłówek tabeli html
                           echo "<p>";
                           echo "<table boder=\"1\"><tr>";
                           echo "<td ><strong>Imię</strong></td>";
                           echo "<td ><strong>Drugie imię</strong></td>";
                           echo "<td ><strong>Nazwisko</strong></td>";
                           echo "<td ><strong>Data urodzenia</strong></td>";
                           echo "<td ><strong>Klasa</strong></td>";
                            echo "<td ><strong>Numer telefonu</strong></td>";
                           //Teraz wyowietlamy kolejne wiersze z tabeli newsletter
                           //Pola tabeli newsletter pobieramy odwo3uj1c sie do ich 
                           //numerów jak poni?ej:
                           //   0 (UID)
                           //   1 (Imie)
                           //   2 (Nazwisko)
                           //   3 (Wyksztalcenie)
                           while ( $row = mysql_fetch_row($wynik) ) {
                              echo "</tr>";
                              echo "<td >" . $row[1] . "</td>";
                              echo "<td >" . $row[2] . "</td>";
                              echo "<td >" . $row[3] . "</td>";
                              echo "<td >" . $row[4] . "</td>";
                              echo "<td >" . $row[6] . "</td>";
                              echo "<td >" . $row[5] . "</td>";
                              echo "</tr>";
                           }
                           echo "</table>";
                           
                           
                           //Zamykamy po³¹czenie z baz¹ danych
                           if ( !mysql_close() ) {
                              echo 'Nie moge zakonczyc polaczenia z baza danych';
                              exit (0);
                           }
                           ?>
                          <br />
                          <a href="adminindex.php"><button>Wstecz</button></a><br />
                          <br />
                <!-- END CONTENT -->
                
            </div>
        
            <div class="footer-navigation">
            
                <ul>
                    <li><a href="http://www.men.gov.pl" title="MEN - Ministerstwo Edukacji Narodowej" onclick="this.target='_blank'">MEN - Ministerstwo Edukacji Narodowej</a></li>
                    <li><a href="http://pl.wikipedia.org/wiki/Ministerstwo_Edukacji_Narodowej" title="MEN w Wikipedii" onclick="this.target='_blank'">MEN w Wikipedii</a></li>
                    <li><a href="http://www.mnisw.gov.pl" title="Ministerstwo Nauki i Szkolnictwa Wyższego" onclick="this.target='_blank'">Ministerstwo Nauki i Szkolnictwa Wyższego</a></li>
                    <li><a href="http://www.cie.men.gov.pl/index.php/sio-wykaz-szkol-i-placowek.html" title="Wykaz szkół i placówek oświatowych">Wykaz szkół i placówek oświatowych</a></li>
                    <li><a href="http://www.men.gov.pl/podreczniki/" title="Wykaz podręczników" onclick="this.target='_blank'">Wykaz podręczników</a></li>                 
                </ul>

                
                <ul> 
                    <li><a href="http://www.wsip.pl/dla_nauczycieli/przedmioty/szkolnictwo_specjalne/aktualnosci" title="Wydawnictwo szkolne i pedagogiczne" onclick="this.target='_blank'">Wydawnictwo szkolne i pedagogiczne</a></li>
                    <li><a href="http://www.zpsb.szczecin.pl" title="Zachodniopomorska Szkoła Biznesu w Szczecinie" onclick="this.target='_blank'">Zachodniopomorska Szkoła Biznesu w Szczecinie</a></li>
                    <li><a href="http://www.edukacja.net" title="Wszystko o uczelniach wyższych oraz o maturze" onclick="this.target='_blank'">Wszystko o uczelniach wyższych oraz o maturze</a></li>
                </ul>
                
                <div class="clear"></div>
            
            </div>
            <div class="footer">
                <p>© <a href="mailto: grzesikpiotr@op.pl">Grzesik Piotr</a> and <a href="mailto: p.budniak5@gmail.com">Budniak Paweł</a> || 2013</p>  
            </div>  
        </div>
    </div>
</div>
</body>
</html>