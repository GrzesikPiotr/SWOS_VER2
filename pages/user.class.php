<?php


class user {

    public static $user = array();
    
    /**
     * Zwraca tablice ze wszystkimi danymi o użytkowniku.
     * Indeksy tablicy odpowiadają nazwom pól w bazie danych (login, pass etc...)
     * @param string $login
     * @param string $pass
     * @return array
     */
    public function getData ($login, $pass) {
        if ($login == '') $login = $_SESSION['login'];
        if ($pass == '') $pass = $_SESSION['pass'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE login='$login' AND pass='$pass' LIMIT 1;"));
        return self::$user;
    }

    
    /**
     * Zwraca tablice ze wszystkimi danymi o użytkowniku, tak jak powyższa metoda klasy,
     * ale rozpoznaje u¿ytkownika nie po podaniu loginu i hasła tylko po podaniu ID.
     * Używana np. do wyświetlania strony profilu.
     * @param int $id
     * @return array 
     */
    public function getDataById ($id) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;"));
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
     * @param string $pass
     * @return string
     */
    public function passSalter ($pass) {
        $pass = '$@@#$#@$'.$pass.'q2#$3$%##@';
        return md5($pass);
    }

}