<?php
$timeout = 1; // 5 menit

function isLogin()
{
  if (!isset($_SESSION['login']) && (time() - $_SESSION['login'] > $timeout)) {
    session_unset();
    session_destroy();
    
    // session_start();
    $_SESSION['login'] = time();
    
    
    header('Location: ../index.php');
  }
}

