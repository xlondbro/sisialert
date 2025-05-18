<?php
session_start();
require_once '../helper/connection.php';

$id_customer = $_POST['id_customer'];
$customer = $_POST['customer'];

$query = mysqli_query($connection, "insert into customer (id_customer, customer) value ('$id_customer', '$customer')");

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
  header('Location: ./index.php');
}
