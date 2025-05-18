<?php
// Atur waktu refresh dalam detik
$refreshInterval = 5; // Ganti 5 dengan waktu refresh yang Anda inginkan (misalnya 10)

// Refresh otomatis
header("Refresh: $refreshInterval");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auto Refresh PHP</title>
</head>
<body>
    <h1>Halaman ini akan refresh otomatis setiap <?php echo $refreshInterval; ?> detik.</h1>
    <p>Waktu sekarang: <?php echo date('H:i:s'); ?></p>
</body>
</html>
