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
                <ul>    
                    <!-- MENU -->
                    <li><a href="../index.php">Strona Główna</a></li>
                    <li><a href="dyrektor.php">Dyrektor</a></li>
                    <li class="selected"><a href="nauczyciel.php">Nauczyciel</a></li>
                    <li><a href="administrator.php">Administrator</a></li>
                    <!-- END MENU -->
                </ul>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                <?php
        session_start();

        require 'config.php'; // Dołącz plik konfiguracyjny i połączenie z bazą

        /**
         * SKRYPT LOGOWANIA
         */
        require_once 'nauczyciel.class.php'; // Dołączamy rdzeń systemu użytkowników

        // Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
        $login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
        $pass = mysql_real_escape_string($_POST['pass']);

        if ($_POST['send'] == 1) {
            // Sprawdź, czy wszystkie pola zostały uzupełnione
            if (!$login or empty($login)) {
                die ('<center><p class="error"><h4>Wypełnij pole z loginem!</h4></p></center>');
            }

            if (!$pass or empty($pass)) {
                die ('<center><p class="error"><h4>Wypełnij pole z hasłem!</h4></p></center>');
            }

            $pass = user::passSalter($pass); // Posól i zahashuj hasło
            
            // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
            $userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM nauczyciel WHERE login = '$login' AND pass = '$pass'"));

            if ($userExists[0] == 0) {
                // Użytkownik nie istnieje w bazie
                echo '<center><p class="error"><h4>Użytkownik o podanym loginie i haśle nie istnieje.Wpisz ponownie.</h4></p></center>';
            }

            else {
                // Użytkownik istnieje
                $user = user::getData($login, $pass); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

                // Przypisz pobrane dane do sesji
                $_SESSION['login'] = $login;
                $_SESSION['pass'] = $pass;
                header("Location: zalogowanynauczyciel.php\n\n");
            
            }


        }

        else {
            
        ?> <?php
        }

        ?>
                
                <center>
                Witam <b>Nauczycielu</b>. Wypełnij pola aby zalogować się. <br />
                <br />
                <form method="post" action=""><label for="login"><strong>Login:</strong><input type="text" name="login" maxlength="32" id="login" style="border:1px solid #000;" /></label> <br />
                <label for="pass"><strong>Hasło:</strong> <input type="password" name="pass" maxlength="32" id="pass" style="border:1px solid #000;" /></label><br />
                <input type="hidden" name="send" value="1" /> <input type="submit" value="Zaloguj" /></form>
                <br />
                </center>
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