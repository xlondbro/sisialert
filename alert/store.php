<?php
session_start();
require_once '../helper/connection.php';

$id_alert = $_POST['id_alert'];
$id_problem = $_POST['id_problem'];
$host = $_POST['host'];
$alert_date = $_POST['alert_date'];
$customer = $_POST['customer'];
$site = $_POST['site'];
$kategori_alert = $_POST['kategori_alert'];
$problem_alert = $_POST['problem_alert'];
$created_alert = date('Y-m-d H:i:s');
$status = "Progress";
$serverity = $_POST['serverity'];
$tf = $_POST['tf'];

$operational = $_POST['operational'];
$imgDir = '../uploads/';
if (!is_dir($imgDir)) {
    mkdir($imgDir, 0777, true);
}

// Penanganan multiple upload gambar
$img = []; // Array untuk menyimpan nama-nama file yang diunggah
if (isset($_FILES['img'])) {
    $files = $_FILES['img'];

    foreach ($files['name'] as $key => $name) {
        if ($files['error'][$key] == 0) {
            $tmpName = $files['tmp_name'][$key];
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Validasi tipe file
            if (in_array($ext, $allowedExtensions)) {
                // Buat nama file unik dan simpan
                $uniqueName = uniqid() . "_" . $name;
                $targetFile = $imgDir . $uniqueName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    $img[] = $uniqueName; // Tambahkan nama file ke array
                }
            }
        }
    }
}

// Gabungkan nama-nama file menjadi string (dipisahkan koma)
$imgFiles = implode(',', $img);
$notiket = $_POST['notiket'];

// Periksa apakah data sudah ada di database berdasarkan id_problem
$checkDuplicate = mysqli_query($connection, "SELECT * FROM alert WHERE id_problem = '$id_problem'");

if (mysqli_num_rows($checkDuplicate) > 0) {
    // Jika data duplikat ditemukan
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => 'Data ID Problem sudah ada, tidak dapat menambahkan data yang sama.'
    ];
    header('Location: ./create.php');
    exit; // Hentikan eksekusi jika data duplikat ditemukan
}

// Jika tidak ada duplikat, lakukan query INSERT
$query = mysqli_query($connection, "INSERT INTO alert (id_problem, host, alert_date, customer, site, kategori_alert, problem_alert, created_alert, status, serverity, tf, operational, img, notiket) VALUES ('$id_problem', '$host', '$alert_date', '$customer', '$site', '$kategori_alert', '$problem_alert', '$created_alert', '$status', '$serverity', '$tf', '$operational','$imgFiles', '$notiket')");

if ($query) {
    $_SESSION['info'] = [
        'status' => 'success',
        'message' => 'Berhasil menambah data'
    ];
    header('Location: ./index.php');
} else {
    $_SESSION['info'] = [
        'status' => 'failed',
        'message' => mysqli_error($connection)
    ];
    header('Location: ./create.php');
}
?>
