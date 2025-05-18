<?php
date_default_timezone_set('Asia/Jakarta');

?>

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
          <form action="./update.php" method="post" enctype="multipart/form-data">
            <?php
            while ($row = mysqli_fetch_array($query)) {
            ?>
              <input type="hidden" name="id_alert" value="<?= $row['id_alert'] ?>">
              <table cellpadding="8" class="w-100">
               <tr>
                <td>Host</td>
                <td><input class="form-control" type="text" name="host" value="<?= $row['host'] ?>" required></td>
              </tr>
              <tr>
                <td>ID Problem</td>
                <td><input class="form-control" type="number" name="id_problem" value="<?= $row['id_problem'] ?>"  required></td>
              </tr>
              <tr>
                <td>Start Alert</td>
                <td><input class="form-control" type="datetime-local" name="alert_date" value="<?= $row['alert_date'] ?>"  required></td>
              </tr>
              <tr>
                <td>End Time</td>
                <td><input class="form-control" type="datetime-local" name="endq" value="<?= date('d-m-Y H:i:s') ?>" step="1" ></td>
              </tr>
              <tr>
                <td>Customer</td>
                  <td><input class="form-control" type="text" name="customer" value="<?= $row['customer'] ?>"  required></td> 
              </tr>
               <tr>
                <td>Site</td>
                <td><input class="form-control" type="text" name="site" value="<?= $row['site'] ?>" required></td>
              </tr>
              <tr>
                <td>Kategori Alert</td>
                <td>
                    <select class="form-control" name="kategori_alert" id="kategori_alert" required>
                      <option value="Aplikasi" <?php if ($row['kategori_alert'] == "Aplikasi") {
                                              echo "selected";
                                            } ?>>Aplikasi</option>
                      <option value="Server" <?php if ($row['kategori_alert'] == "Server") {
                                                echo "selected";
                                              } ?>>Server</option>
                      <option value="Network" <?php if ($row['kategori_alert'] == "Network") {
                                                echo "selected";
                                              } ?>>Network</option>
                    </select>
                </td>
              </tr>
              <tr>
                <td>Problem</td>
                 <td><input class="form-control" type="text" name="problem_alert"  value="<?= $row['problem_alert'] ?>" required></td>
              </tr>
              <tr>
                  <td>True and False</td>
                  <td>
                    <select class="form-control" name="tf" id="tf" required>
                      <option value="0">--Pilih--</option>
                      <option value="True" <?php if ($row['tf'] == "True") {
                                              echo "selected";
                                            } ?>>True</option>
                      <option value="False" <?php if ($row['tf'] == "False") {
                                                echo "selected";
                                              } ?>>False</option>
                    </select>
                  </td>
                </tr>
                <tr>
                 <td>Gambar</td>
                 <td>
                   <?php if ($row['tf'] == "True") {
                           echo "<input type='file' name='img[]'  id='inputField'  multiple accept='image/*' />";
                    }else{
                      echo "<input type='file' name='img[]'  id='inputField' disabled=''   multiple accept='image/*' />";
                    }
                    ?>
               
               <!--  <input type="file" name="img[]"  id="inputField" disabled=""  multiple accept="image/*" />
                <p style="color: red">Kosongkan jika tidak mengupdate gambar</p> -->
                </td>
             </tr> 
             <tr>
                <td>No Tiket</td>
                 <td>   
                   <?php if ($row['tf'] == "True") {
                           echo "<input class='form-control' type='text' id='tiket' name='notiket' value='$row[notiket]' >";
                    }else{
                       echo "<input class='form-control' type='text' id='tiket' name='notiket' value='$row[notiket]' disabled >";
                    }
                    ?>
                </td>
               
               
              </tr>
                <tr>
                <td>Serverity</td>
                <td>
                    <select class="form-control" name="serverity" id="serverity" required>
                      <option value="Warning" <?php if ($row['serverity'] == "Warning") {
                                              echo "selected";
                                            } ?>>Warning</option>
                      <option value="Average" <?php if ($row['serverity'] == "Average") {
                                                echo "selected";
                                              } ?>>Average</option>
                      <option value="High" <?php if ($row['serverity'] == "High") {
                                                echo "selected";
                                              } ?>>High</option>
                      <option value="Disater" <?php if ($row['serverity'] == "Disater") {
                                              echo "selected";
                                            } ?>>Disater</option>
                      <option value="Not Classified" <?php if ($row['serverity'] == "Not Classified") {
                                                echo "selected";
                                              } ?>>Not Classified</option>
                      <option value="Information" <?php if ($row['serverity'] == "Information") {
                                                echo "selected";
                                              } ?>>Information</option>
                    </select>
                </td>
              </tr>
               <tr>
                <td>Operational</td>
                 <td><input class="form-control" type="text" name="operational"  value="<?= $row['operational'] ?>" required></td>
              </tr>
                <tr>
                  <td>
                      <input class="form-control" type="hidden" name="status"  value="<?= $row['status'] ?>" >
                    <input class="btn btn-primary d-inline" type="submit" name="proses" value="Ubah">
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
 <script>
        // JavaScript untuk mengontrol enable/disable field
        document.getElementById('tf').addEventListener('change', function() {
            const inputField = document.getElementById('inputField');
            if (this.value === 'True') {
                inputField.disabled = false; // Aktifkan field
            } else {
                inputField.disabled = true;  // Nonaktifkan field
            }
        });
    </script>
     <script>
        // JavaScript untuk mengontrol enable/disable field
        document.getElementById('tf').addEventListener('change', function() {
            const tiket = document.getElementById('tiket');
            if (this.value === 'True') {
                tiket.disabled = false; // Aktifkan field
            } else {
                tiket.disabled = true;  // Nonaktifkan field
            }
        });
    </script>