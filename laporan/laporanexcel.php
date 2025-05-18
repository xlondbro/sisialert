<?php


require_once '../helper/connection.php';    
$result = mysqli_query($connection, "SELECT * FROM alert");

$date1 = date("d-m-Y", strtotime($_GET['date1']));
$date2 = date("d-m-Y", strtotime($_GET['date2']));

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Page Title</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>

</style>
</head>
<body>
    <?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-excel.xls"); 
header("Pragma: no-chache");
header("Expires: 0");

?>

<center><h2>Data Laporan <?php echo isset($_GET['date1']) ? $_GET['date1'] : '' ?></h2></center>
<table border="1" align="center">
    <tr>
        <th>No</th>
              <th>ID Problem</th>
              <th>Host</th>
              <th>Start Alert</th>
              <th>End</th>
              <th>Downtime</th>
              <th>Customer </th>
              <th>Site</th>
              <th>Kategori Alert</th>
              <th>Problem</th>
              <th>Status</th>
              <th>True False</th>
             <th>Serverity</th>
</tr>
 <?php  

                   $no = 1;
                  ?>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>
<tr>
 <td><?= $no ?></td>
                    <td><?= $data['id_problem'] ?></td>
                    <td><?= $data['host'] ?></td>
                    <td><?=date('d.m.Y', strtotime( $data['alert_date']))?> ON <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
                    <td><?= $data['customer'] ?></td>
                    <td><?= $data['site'] ?></td>
                    <td><?= $data['kategori_alert'] ?></td>
                    <td><?= $data['problem_alert'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['tf'] ?></td>
                </tr>
<?php
                 $no++;
                endwhile;
                ?>
</table>

</body>
</html>









