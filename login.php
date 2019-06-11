<?php
$xml = simplexml_load_file("db.xml");
$result = '';

if(!isset($_COOKIE['login'])) {

    if(isset($_POST['login'])) {

        $login = $_POST['login'];
        $pass = 'соль'.md5($_POST['pass']);
        $dbUser = $xml->xpath("//user[login/text() = '$login']");   //search user in xml

        if($dbUser && $dbUser[0]->password == $pass ) {                 //confirm pass
            setcookie('login', $dbUser[0]->login, time() + (60*60));    //succes
            echo json_encode($result);
        } else {                                                        //wrong
            $result = 'Неверный логин или пароль';
            echo json_encode($result);
        }
    }
}
?>