<?php
// Atur durasi waktu tidak aktif dalam detik (misalnya 30 menit = 1800 detik)
$inactive = 10;  // 30 menit

// Jika sesi sudah dimulai, periksa waktu terakhir aktivitas
if (isset($_SESSION['last_activity'])) {
    $session_life = time() - $_SESSION['last_activity'];

    // Jika lebih dari 30 menit tidak ada aktivitas, logout pengguna
    if ($session_life > $inactive) {
        // Hapus sesi dan arahkan ke login
        session_unset(); // Hapus semua sesi
        session_destroy(); // Hancurkan sesi
        header('Location: login.php');  // Arahkan ke halaman login
        exit;
    }
}
if(isset($_SESSION['login'])){

  header('Location: dashboard/index.php');
}else{
  header('Location: ./login.php');
}