<?php


class user {

    public static $user = array();
    
    /**
     * Zwraca tablice ze wszystkimi danymi o użytkowniku.
     * Indeksy tablicy odpowiadają nazwom pól w bazie danych (login, haslo etc...)
     * @param string $login
     * @param string $pass
     * @return array
     */
    public function getData ($login, $pass, $imie, $imie2, $nazwisko, $data_urodzenia, $wyksztalcenie, $nip, $telefon) {
        if ($login == '') $login = $_SESSION['login'];
        if ($pass == '') $pass = $_SESSION['pass'];
        if ($imie == '') $imie = $_SESSION['imie'];
        if ($imie2 == '') $imie2 = $_SESSION['imie2'];
        if ($nazwisko == '') $nazwisko = $_SESSION['nazwisko'];
        if ($data_urodzenia == '') $data_urodzenia = $_SESSION['data_urodzenia'];
        if ($wyksztalcenie == '') $wyksztalcenie = $_SESSION['wyksztalcenie'];
        if ($nip == '') $nip = $_SESSION['nip'];
        if ($telefon == '') $telefon = $_SESSION['telefon'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM nauczyciel WHERE login='$login' AND pass='$pass' LIMIT 1;"));
        return self::$user;
    }

    
    /**
     * Zwraca tablice ze wszystkimi danymi o użytkowniku, tak jak powyższa metoda klasy,
     * ale rozpoznaje użytkownika nie po podaniu loginu i hasła tylko po podaniu ID.
     * Używana np. do wyświetlania strony profilu.
     * @param int $id
     * @return array 
     */
    public function getDataById ($idnauczyciela) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM nauczyciel WHERE id='$idnauczyciela' LIMIT 1;"));
        return $user;
    }

    /**
     * Jeżli użytkownik jest zalogowany - zwraca true, w przeciwnym wypadku - false
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
     * "Soli" hasło przed jego zahashowaniem funkcją md5()
     * @param string $haslo
     * @return string
     */
    public function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}
