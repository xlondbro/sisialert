<?php
require_once '../session_check.php';
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$id_alert = $_GET['id_alert'];
$query = mysqli_query($connection, "SELECT * FROM alert WHERE id_alert='$id_alert'");

?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Ubah Data Alert</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./update.php" method="post">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <input type="hidden" name="id_alert" value="<?= $row['id_alert'] ?>">
              <table cellpadding="8" class="w-100">
               <tr>
                <td>Host</td>
                <td><input class="form-control" type="text" name="host" value="<?= $row['host'] ?>" readonly></td>
              </tr>
              <tr>
                <td>ID Problem</td>
                <td><input class="form-control" type="number" name="id_problem" value="<?= $row['id_problem'] ?>"  readonly></td>
              </tr>
              <tr>
                <td>Start Alert</td>
                <td><input class="form-control" type="datetime-local" name="alert_date" value="<?= $row['alert_date'] ?>"  readonly></td>
              </tr>
               <tr>
                <td>End Time</td>
                <td><input class="form-control" type="datetime-local" name="endq" value="<?= date('Y-m-d H:i:s') ?>" step="1" ></td>
              </tr>
              <tr>
                <td>Customer</td>
                  <td><input class="form-control" type="text" name="customer" value="<?= $row['customer'] ?>"  readonly></td> 
              </tr>
               <tr>
                <td>Site</td>
                <td><input class="form-control" type="text" name="site" value="<?= $row['site'] ?>" readonly></td>
              </tr>
              <tr>
                <td>Kategori Alert</td>
                <td><input class="form-control" type="text" name="kategori_alert" value="<?= $row['kategori_alert'] ?>" readonly></td>
              </tr>
              <tr>
                <td>Problem</td>
                 <td><input class="form-control" type="text" name="problem_alert"  value="<?= $row['problem_alert'] ?>" readonly></td>
              </tr>
              <tr>
                  <td>True and False</td>
                 <td><input class="form-control" type="text" name="tf" value="<?= $row['tf'] ?>" readonly></td>
                </tr>
                <tr>
                <td>Serverity</td>
                <td><input class="form-control" type="text" name="serverity" value="<?= $row['serverity'] ?>" readonly></td>
              </tr>
              <tr>
                <td>Description</td>
                <td><input class="form-control" type="text" name="Description" value="-"></td>
              </tr>
                <tr>
                  <td>
                    <input class="btn btn-success d-inline" type="submit" name="proses" value="Resolve">
                    <a href="./index.php" class="btn btn-danger ml-1">Batal</a>
                  <td>
                </tr>
              </table>

            <?php } ?>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>