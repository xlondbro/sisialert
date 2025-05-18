<?php
date_default_timezone_set('Asia/Jakarta');
require_once '../layout/_top.php';
require_once '../helper/connection.php';
$result = mysqli_query($connection, "SELECT * FROM customer");
require_once('../tracing.php');
?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Tambah Alert</h1>
    <a href="./index.php" class="btn btn-light">Kembali</a>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <!-- // Form -->
          <form action="./store.php" method="POST" enctype="multipart/form-data">
            <table cellpadding="8" class="w-100">
               <tr>
                <td>ID Problem</td>
                <td><input class="form-control" type="number" name="id_problem"  required></td>
              </tr>
              <tr>
                <td>Host</td>
                <td><input class="form-control" type="text" name="host"  required></td>
              </tr>
              <tr>
                <td>Start Alert</td>
                <td><input class="form-control" type="datetime-local" name="alert_date"  value="<?= date('Y-m-d H:i:s') ?>" step="1"></td>
              </tr>
              <tr>
                <td>Customer</td> 
                 <td><input class="form-control" type="text" name="customer"  required></td>               
              </tr>
               <tr>
                <td>Site</td>
                <td><input class="form-control" type="text" name="site"  required></td>
              </tr>
             
               <tr>
                <td>Kategori Alert</td>
                <td>
                  <select class="form-control" name="kategori_alert" id="kategori_alert" required>
                    <option value="">--Pilih Kategori--</option>
                    <option value="Aplikasi">Aplikasi</option>
                    <option value="Server">Server</option>
                    <option value="Network">Network</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td>Problem</td>
                <td><input class="form-control" type="text" name="problem_alert"  required></td>
              </tr>
              <tr>
                <td>True And False</td>
                <td>
                  <select class="form-control" name="tf" id="tf" required>
                    <option value="">--Pilih--</option>
                    <option value="True">True</option>
                    <option value="False">False</option>
                  </select>
                </td>
              </tr>
               <tr>
                 <td>Gambar</td>
                 <td>
                <input type="file" name="img[]" required="required"  id="inputField"  disabled="" multiple accept="image/*" />
                <p style="color: red">Ekstensi yang diperbolehkan .png | .jpg | .jpeg</p>
                </td>
             </tr> 
               <tr>
                <td>Nomor Tiket</td>
                <td><input class="form-control" type="text" name="notiket" id="tiket" disabled></td>
              </tr>
                <tr>
                <td>Severity</td>
                <td>
                  <select class="form-control" name="serverity" id="serverity" required>
                    <option value="">--Pilih Serverity--</option>
                    <option value="Warning">Warning</option>
                    <option value="Average">Average</option>
                    <option value="High">High</option>
                    <option value="Disater">Disater</option>
                    <option value="Not Classified">Not Classified</option>
                    <option value="Information">Information</option>
                  </select>
                </td>
              </tr> <tr>
                <td>Operational</td>
                <td><input class="form-control" type="text" name="operational"  required></td>
              </tr>
              <tr>
                <td>
                  <input class="btn btn-primary" type="submit" name="proses" value="Simpan">
                  <input class="btn btn-danger" type="reset" name="batal" value="Bersihkan"></td>
              </tr>

            </table>
          </form>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>

<?php
if (isset($_SESSION['info'])) :
  if ($_SESSION['info']['status'] == 'success') {
?>
    <script>
      iziToast.success({
        title: 'Sukses',
        message: `<?= $_SESSION['info']['message'] ?>`,
        position: 'topCenter',
        timeout: 5000
      });
    </script>
  <?php
  } else {
  ?>
    <script>
      iziToast.error({
        title: 'Gagal',
        message: `<?= $_SESSION['info']['message'] ?>`,
        timeout: 5000,
        position: 'topCenter'
      });
    </script>
<?php
  }

  unset($_SESSION['info']);
  $_SESSION['info'] = null;
endif;
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