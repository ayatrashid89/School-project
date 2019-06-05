<?php
//When a user logs out, the cookies will be deleted.
unset($_COOKIE['email']);
unset($_COOKIE['password']);
setcookie('email', null, -1, '/');
setcookie('password', null, -1, '/');
header("Location: login.php");