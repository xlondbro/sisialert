<?php
session_start();
session_destroy();
session_unset();
unset($_SESSION['login']);
$_SESSION['login'] = null;
header('Location: login.php');
exit();

