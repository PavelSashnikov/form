<?php
$xml = simplexml_load_file("db.xml");
$errors = array();
if(isset($_POST['login'])) {
    
                //login, email in DB
    for($i = 0; $i < count($xml->user); $i++) {
        if($xml->user[$i]->login == $_POST['login']) {      
            $errors[] = 'Такой пользователь уже существует';
        }
        if($xml->user[$i]->email == $_POST['email']) {
            $errors[] = 'Эта почта уже используется';
        }
    }
    if($_POST['pass1'] !== $_POST['pass2']) {
        $errors[] = 'Пароли должны совпадать';
    }
            //errors is empty
    if(empty($errors)) {
        $saltPass = 'соль'.md5($_POST['pass2']);
            //add new user to xml
        $newUser = $xml->addChild('user');
        $newUser->addAttribute('id', count($xml->user));
        $userLogin = $newUser->addChild('login', $_POST['login']);
        $userPass = $newUser->addChild('password',$saltPass);
        $userMail = $newUser->addChild('email', $_POST['email']);
        $userMail = $newUser->addChild('name', $_POST['name']);
        $xml->asXML('db.xml');
    }
    echo json_encode ($errors, JSON_UNESCAPED_UNICODE);
}
?>