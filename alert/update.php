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
$status = $_POST['status'];
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
if ($imgFiles){

$query = mysqli_query($connection, "UPDATE alert SET id_problem = '$id_problem', host = '$host', alert_date = '$alert_date', customer = '$customer', site = '$site', kategori_alert = '$kategori_alert', problem_alert = '$problem_alert', created_alert = '$created_alert', status = '$status', serverity = '$serverity', tf = '$tf',  operational = '$operational', img = '$imgFiles', notiket = '$notiket'  WHERE id_alert = '$id_alert'");
}else{
    $query = mysqli_query($connection, "UPDATE alert SET id_problem = '$id_problem', host = '$host', alert_date = '$alert_date', customer = '$customer', site = '$site', kategori_alert = '$kategori_alert', problem_alert = '$problem_alert', created_alert = '$created_alert', status = '$status', serverity = '$serverity', tf = '$tf',  operational = '$operational', notiket = '$notiket'  WHERE id_alert = '$id_alert'");
}



if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil mengubah data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}

