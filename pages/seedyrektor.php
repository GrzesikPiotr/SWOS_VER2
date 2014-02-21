<?php
session_start();
require 'config.php';

require_once 'dyrektor.class.php';
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
</head>
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
               <h3>Zarejestrowani dyrektorzy</h3>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                      <?php 
                            session_start();
                            require 'config.php';

                            require_once 'dyrektor.class.php';
                             //Definiujemy zapytanie pobierające wszystkie wiersze z wszystkimi
                             //polami z tabeli newsletter
                             $zapytanie = "SELECT * FROM `dyrektor`";
                             //wykonujemy zdefiniowane zapytanie na bazie mysql
                             $wynik = mysql_query($zapytanie);
                             
                             //Wyświetlamy w tabeli html dane pobrane 
                             //z tabeli newsletter bazy mysql
                             //Najpierw definiujemy nagłówek tabeli html
                             echo "<p>";
                             echo "<table boder=\"1\"><tr>";
                             echo "<td ><strong>Login</strong></td>";
                             echo "<td ><strong>Imię</strong></td>";
                             echo "<td ><strong>Drugie imię</strong></td>";
                             echo "<td ><strong>Nazwisko</strong></td>";
                             echo "<td ><strong>Data urodzenia</strong></td>";
                             echo "<td ><strong>wykształcenie</strong></td>";
                             echo "<td ><strong>Numer telefonu</strong></td>";
                             echo "</tr>";
                             //Teraz wyœwietlamy kolejne wiersze z tabeli newsletter
                             //Pola tabeli newsletter pobieramy odwołując się do ich 
                             //numerów jak poniżej:
                             //   0 (UID)
                             //   1 (Imie)
                             //   2 (Nazwisko)
                             //   3 (Wyksztalcenie)
                             while ( $row = mysql_fetch_row($wynik) ) {
                                echo "<tr>";
                                echo "<td >" . $row[1] . "</td>";
                                echo "<td >" . $row[3] . "</td>";
                                echo "<td >" . $row[4] . "</td>";
                                echo "<td >" . $row[5] . "</td>";
                                echo "<td >" . $row[6] . "</td>";
                                echo "<td >" . $row[7] . "</td>";
                                echo "<td >" . $row[8] . "</td>";
                                echo "</tr>";
                             }
                             echo "</table>";
                            

                             //Zamykamy połączenie z bazą danych
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