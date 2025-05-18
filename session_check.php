<?php
session_start();

// Periksa apakah user sudah login
if (!isset($_SESSION['login'])) {
    header('Location: ../login.php'); // Redirect ke halaman login jika user belum login
    exit();
}
else {
    
}

// Periksa apakah sesi telah kedaluwarsa
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $_SESSION['timeout_duration']) {
    // Hapus semua data sesi dan logout otomatis
    session_unset();
    session_destroy();
    header('Location: ../login.php?message=session_expired'); // Redirect ke login dengan pesan
    exit();
}

// Perbarui waktu aktivitas terakhir
$_SESSION['last_activity'] = time();
?>
