<?php


class user {

    public static $user = array();
    
    /**
     * Zwraca tablice ze wszystkimi danymi o u¿ytkowniku.
     * Indeksy tablicy odpowiadaj¹ nazwom pól w bazie danych (login, haslo etc...)
     * @param string $login
     * @param string $pass
     * @return array
     */
    public function getData ($login, $pass, $imie, $imie2, $nazwisko, $data_urodzenia, $wyksztalcenie, $telefon) {
        if ($login == '') $login = $_SESSION['login'];
        if ($pass == '') $pass = $_SESSION['pass'];
        if ($imie == '') $imie = $_SESSION['imie'];
        if ($imie2 == '') $imie2 = $_SESSION['imie2'];
        if ($nazwisko == '') $nazwisko = $_SESSION['nazwisko'];
        if ($data_urodzenia == '') $data_urodzenia = $_SESSION['data_urodzenia'];
        if ($wyksztalcenie == '') $wyksztalcenie = $_SESSION['wyksztalcenie'];
        if ($telefon == '') $telefon = $_SESSION['telefon'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM dyrektor WHERE login='$login' AND pass='$pass' LIMIT 1;"));
        return self::$user;
    }

    
    /**
     * Zwraca tablice ze wszystkimi danymi o u¿ytkowniku, tak jak powy¿sza metoda klasy,
     * ale rozpoznaje u¿ytkownika nie po podaniu loginu i has³a tylko po podaniu ID.
     * U¿ywana np. do wyœwietlania strony profilu.
     * @param int $id
     * @return array 
     */
    public function getDataById ($iddyrektora) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM dyrektor WHERE id='$iddyrektora' LIMIT 1;"));
        return $user;
    }

    /**
     * Je¿li u¿ytkownik jest zalogowany - zwraca true, w przeciwnym wypadku - false
     * @return bool
     */
    public function isLogged () {
     if (empty($_SESSION['login']) || empty($_SESSION['pass'])) {
      return false;
     }

     else {
      return true;
     }
    }

    /**
     * "Soli" has³o przed jego zahashowaniem funkcj¹ md5()
     * @param string $haslo
     * @return string
     */
    public function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}
