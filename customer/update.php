<?php
session_start();
require_once '../helper/connection.php';

$id_customer = $_POST['id_customer'];
$customer = $_POST['customer'];


$query = mysqli_query($connection, "UPDATE customer SET customer = '$customer' WHERE id_customer = '$id_customer'");
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
