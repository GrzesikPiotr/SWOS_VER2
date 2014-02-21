<?php
session_start();
require 'config.php';

require_once 'user.class.php';
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
               <h1>Rejestracja Administratora</h1>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                       <?php


                            require 'config.php'; // Dołącz plik konfiguracyjny i połączenie z bazą
                            require_once 'user.class.php';

                            /**
                             * Sprawdź czy formularz został wysłany
                             */
                            if ($_POST['send'] == 1) {
                                // Zabezpiecz dane z formularza przed kodem HTML i ewentualnymi atakami SQL Injection
                                $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
                                $pass = mysql_real_escape_string(htmlspecialchars($_POST['pass']));
                                $pass_v = mysql_real_escape_string(htmlspecialchars($_POST['pass_v']));
                                $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
                                $email_v = mysql_real_escape_string(htmlspecialchars($_POST['email_v']));

                                /**
                                 * Sprawdź czy podany przez użytkownika email lub login już istnieje
                                 */
                                $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login='$login' LIMIT 1"));
                                $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='$email' LIMIT 1"));

                                $errors = ''; // Zmienna przechowująca listę błędów które wystąpiły


                                // Sprawdź, czy nie wystąpiły błędy
                                if (!$login || !$email || !$pass || !$pass_v || !$email_v ) $errors .= '<center><h4> Musisz wypełnić wszystkie pola</h4></center><br />';
                                if ($existsLogin[0] >= 1) $errors .= '<center><h4>- Ten login jest zajęty</h4></center><br />';
                                if ($existsEmail[0] >= 1) $errors .= '<center><h4>- Ten e-mail jest już używany</h4></center><br />';
                                if ($email != $email_v) $errors .= '<center><h4>- E-maile się nie zgadzają</h4></center><br />';
                                if ($pass != $pass_v)  $errors .= '<center><h4>- Hasła się nie zgadzają</h4></center><br />';

                                /**
                                 * Jeśli wystąpiły jakieś błędy, to je pokaż
                                 */
                                if ($errors != '') {
                                    echo '<p class="error"><center><h4>Rejestracja nie powiodła się, popraw następujące błędy:</h4></center><br />'.$errors.'</p>';
                                }

                                /**
                                 * Jeśli nie ma żadnych błędów - kontynuuj rejestrację
                                 */
                                else {

                                    // Posól i zasahuj hasło
                                    $pass = user::passSalter($pass);

                                    // Zapisz dane do bazy
                                    mysql_query("INSERT INTO users (login, email, pass) VALUES('$login','$email','$pass');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');

                                    echo '<p class="success"><center>Dodany został nowy Administrator: <b>'.$login.' </b>.
                                    <br /><a href="administrator.php"><h4>Logowanie</h4></a></center></p>';
                                }
                            }
                            ?>
                        <center>
                        <form method="post" action=""><label for="login"><strong>Login:</strong><input maxlength="32" type="text" name="login" id="login" /></label><br />
                        
                        <label for="pass"><strong>Hasło:</strong><input maxlength="32" type="password" name="pass" id="pass" /></label><br />
                        
                        <label for="pass_again"><strong>Powtórz:</strong><input maxlength="32" type="password" name="pass_v" id="pass_again" /></label><br />
                        
                        <label for="email"><strong>Email:</strong><input type="text" name="email" maxlength="50" id="email" /></label><br />
                        
                        <label for="email_again"><strong>Powtórz:</strong><input type="text" maxlength="255" name="email_v" id="email_again" /></label><br />
                        
                        <input type="hidden" name="send" value="1" /> <input type="submit" value="Zarejestruj" /></form><br />
                        </center>
                        <br />
                        <a href="adminindex.php"><button>Zakończ dodawanie administratora</button></a><br />
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