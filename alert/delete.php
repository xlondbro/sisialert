<?php
session_start();
require_once '../helper/connection.php';

$id_alert = $_GET['id_alert'];

$result = mysqli_query($connection, "DELETE FROM alert WHERE id_alert='$id_alert'");

if (mysqli_affected_rows($connection) > 0) {
  $_SESSION['info'] = [
    'status' => 'success',
    'message' => 'Berhasil menghapus data'
  ];
  header('Location: ./index.php');
} else {
  $_SESSION['info'] = [
    'status' => 'failed',
    'message' => mysqli_error($connection)
  ];
  header('Location: ./index.php');
}
