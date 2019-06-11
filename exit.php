<?php
unset($_COOKIE['login']);
setcookie('login', '', -1, '/');
header('Location: index.html');
?>