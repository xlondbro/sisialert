<?php
session_start();
require_once '../helper/connection.php';

$id_alert = $_POST['id_alert'];
$id_problem = $_POST['id_problem'];
$host = $_POST['host'];
$alert_date = $_POST['alert_date'];
$endq = $_POST['endq'];
$customer = $_POST['customer'];
$site = $_POST['site'];
$kategori_alert = $_POST['kategori_alert'];
$problem_alert = $_POST['problem_alert'];
$created_alert = date('Y-m-d H:i:s');
$status = "Close";
$serverity = $_POST['serverity'];
$tf = $_POST['tf'];
$deskripsi = $_POST['deskripsi'];
$query = mysqli_query($connection, "UPDATE alert SET id_problem = '$id_problem', host = '$host', alert_date = '$alert_date', endq = '$endq', customer = '$customer', site = '$site', kategori_alert = '$kategori_alert', problem_alert = '$problem_alert', created_alert = '$created_alert', status = '$status', serverity = '$serverity', tf = '$tf',deskripsi = '$deskripsi'  WHERE id_alert = '$id_alert'");

if ($query) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil Resolve'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}
