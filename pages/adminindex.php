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
               <h3>PANEL ADMINISTRATORA</h3>
            </div>
        </div>
        
        <div class="page-wrap">
            <div class="content">
            
                <!-- CONTENT -->
                        <?php
                        if (user::isLogged()) {
                            // Widok dla użytkownika zalogowanego
                            
                            // Pobierz dane o użytkowniku i zapisz je do zmiennej $user
                            $user = user::getData('', '');
                            
                            echo '<p><center>Jesteś zalogowany jako administrator: <b>'.$user['login'].'</b>.</center>';
                            echo ' <center>Możesz zobaczyć swój <a href="profile.php?id='.$user['id'].'"><button>profil</button></a> albo <a href="logout.php"><button>wylogować się</button></a>.</center></p>';
                        }

                        ?>
					
						<center>
						<hr />
                        <br />
						<a href="dodaj_nauczyciela.php"><button>DODAJ NAUCZYCIELA</button></a>
						<a href="dodaj_dyrektora.php"><button>DODAJ DYREKTORA</button></a> 
						<a href="dodaj_ucznia.php"><button>DODAJ UCZNIA</button></a> 
						<a href="register.php"><button>ZAREJESTRUJ NOWEGO ADMINA</button></a>
						<br />
						<br />
						<a href="seenauczyciel.php"><button>Wyświetl Nauczycieli</button></a>
						<a href="seedyrektor.php"><button>Wyświetl Dyrektorów</button></a>
						<a href="seeuczen.php"><button>Wyświetl Uczniów</button></a><br />
						<br />
                       
                        <hr />
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
                <p>© <a href="mailto: grzesikpiotr@op.pl">Grzesik Piotr</a> and <a href="mailto: p.budnia5@gmail.com">Budniak Paweł</a> || 2013</p> 
            </div>  
        </div>
    </div>
</div>
</body>
</html>

