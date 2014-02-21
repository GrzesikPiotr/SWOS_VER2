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
<link rel="shortcut icon" href="../images/ico/favicon.ico" />
<link rel="stylesheet" href="../styles.css" type="text/css" />
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
               <h3>Rejestracja Dyrektora</h3>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                       
                        <?php


                        require 'config.php'; // Dołącz plik konfiguracyjny i połączenie z bazą
                        require_once 'dyrektor.class.php';

                        /**
                         * Sprawdź czy formularz został wysłany
                         */
                        if ($_POST['send'] == 1) {
                            // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
                            $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
                            $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
                            $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v']));
                            $imie = mysql_real_escape_string(htmlspecialchars($_POST['imie']));
                            $imie2 = mysql_real_escape_string(htmlspecialchars($_POST['imie2']));
                            $nazwisko = mysql_real_escape_string(htmlspecialchars($_POST['nazwisko']));
                            $data_urodzenia = mysql_real_escape_string(htmlspecialchars($_POST['data_urodzenia']));
                            $wyksztalcenie = mysql_real_escape_string(htmlspecialchars($_POST['wyksztalcenie']));
                            $telefon = mysql_real_escape_string(htmlspecialchars($_POST['telefon']));

                            /**
                             * Sprawdź czy podany przez użytkownika login już istnieje
                             */
                            $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM dyrektor WHERE login='$login' LIMIT 1"));
                           

                            $errors = ''; // Zmienna przechowująca listę błędów które wystąpiły


                            // Sprawdź, czy nie wystąpiły błędy
                            if (!$login ||!$pass || !$pass_v || !$imie || !$nazwisko || !$data_urodzenia || !$wyksztalcenie || !$telefon) $errors .= ' <h4><center>Musisz wypełnić wszystkie pola</center></h4><br />';
                            if ($existsLogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
                            if ($pass != $pass_v)  $errors .= '- Hasła się nie zgadzają<br />';

                            /**
                             * Jeśli wystąpiły jakieś błędy, to je pokaż
                             */
                            if ($errors != '') {
                                echo '<p class="error"><center><h4>Rejestracja nie powiodła się, popraw następujące błędy:</h4><br />'.$errors.'</p></center>';
                            }

                            /**
                             * Jeśli nie ma żadnych błędów - kontynuuj rejestrację
                             */
                            else {

                                // Posól i zasahuj hasło
                                $pass = user::passSalter($pass);

                                // Zapisz dane do bazy
                                mysql_query("INSERT INTO dyrektor (login, pass, imie, imie2, nazwisko, data_urodzenia, wyksztalcenie, telefon) VALUES('$login', '$pass', '$imie', '$imie2', '$nazwisko', '$data_urodzenia', '$wyksztalcenie', '$telefon');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');

                                echo '<p class="success"><center>Dodany został nowy DYREKTOR:  <b>'.$imie.' '.$nazwisko.' </b><br /></center> ';
                            }
                        }
                        ?>
                    
                    <center>
                    <form method="post" action="">
                    <label for="login"><strong>Login:</strong><input maxlength="32" type="text" name="login" id="login" /></label> <br />
                    
                    <label for="pass"><strong>Hasło:</strong><input maxlength="32" type="password" name="pass" id="pass" /></label> <br />
                    
                    <label for="pass_again"><strong>Powtórz:</strong><input maxlength="32" type="password" name="pass_v" id="pass_again" /></label> <br />
                    
                    <label for="imie"><strong>Imię:</strong><input maxlength="15" type="text" name="imie" id="imie" /></label> <br />
                    
                    <label for="imie2"><strong>Drugie imię:</strong><input maxlength="15" type="text" name="imie2" id="imie2" /></label> <br />
                    
                    <label for="nazwisko"><strong>Nazwisko:</strong><input maxlength="20" type="text" name="nazwisko" id="nazwisko" /></label><br />
                    
                    <label for="data_urodzenia"><strong>Data urodzenia:</strong><input maxlength="" type="text" name="data_urodzenia" id="data_urodzenia" /></label> <br />

                    <label for="wyksztalcenie"><strong>Wykształcenie:</strong><br />
                    <select name="wyksztalcenie">
                    <option value="wybierz" selected="selected">Wybierz...</option>
                    <option value="Dr">Dr inż</option>
                    <option value="Dr">Dr</option>
                    <option value="wyższe">Wyższe</option>
                    <option value="średnie">Średnie</option>
                    </select></label><br />
                    <br />
                   
                    <label for="telefon"><strong>GSM:</strong><input maxlength="9" type="text" name="telefon" id="telefon" /></label> <br />
                    
                    <input type="hidden" name="send" value="1" /> <input type="submit" value="Zarejestruj" /><br /></form>
                    </center><br />
                    <a href="adminindex.php"><button>Zakończ dodawanie Dyrektora</button></a><br />
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
                <p>© <a href="mailto: grzesikpiotr@op.pl">Grzesik Piotr</a> and <a href="mailto: p.budnia5@gmail.com">Budniak Paweł</a> || 2013</p>  
            </div>  
        </div>
    </div>
</div>
</body>
</html>