<?php
require_once '../session_check.php';
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM alert order by id_alert desc");

?>

<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Resolve</h1>
   <!--  <a href="./create.php" class="btn btn-primary">Tambah Data</a> -->
  </div>
  <div class="row">
    <div class="col-13">
      <div class="card">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                  <th style="width: 150">Aksi</th>
                  <th>ID Problem</th>
                  <th>Host</th>
                  <th>Start Alert</th>
                  <th>End</th>
                  <th>Downtime</th>
                  <th>Customer </th>
                  <th>Site</th>
                   <th>True False</th>
                  <th>Kategori Alert</th>
                  <th>Problem</th>
                  <th>Status</th>
                 <th>Serverity</th>
                  <th>Description</th>
                </tr>
              </thead>
              <tbody>
            <?php  

                   $no = 1;
                  ?>
                <?php
                while ($data = mysqli_fetch_array($result)) :
                ?>

                
                  <tr>
                    <td><?= $no ?></td>
                    <td>
                         <div id="<?= $data['id_alert']?>" style="display: none;" class="hidden-text">
<pre>#### Problem | RESOLVE ####
----------------------------------------
* Host: <?= $data['host'] ?><br>
* Severity: <?= $data['serverity'] ?><br>
* Problem: <?= $data['problem_alert'] ?> <br>
* Operational data: <?= $data['operational'] ?> <br>
* Problem started at: <?= $data['alert_date'] ?><br>
* Original problem ID: <?= $data['id_problem'] ?><br>

Perangkat : <?= $data['host'] ?> mengalami Problem : <?= $data['problem_alert'] ?> pada <?= $data['alert_date'] ?>.<br>
Terlampir Graph Operational Status 
Telah Resolve pada <?= date('m/d/Y H:i:s', strtotime($data['endq'])) ?> <br>
Perihal ini minta tolong dibantu pengecekan Team Terkait.
        </pre>
      </div>
      <button class="copyButton btn btn-sm btn-warning" onclick="copyText('<?= $data['id_alert']?>')">Copy Resolve</button>
                      <!-- <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="delete.php?id_alert=<?= $data['id_alert'] ?>">
                        <i class="fas fa-trash fa-fw"></i>
                      </a> -->
                      <a class="btn btn-sm btn-success" href="edit.php?id_alert=<?= $data['id_alert'] ?>">Resolve             
                    </a>     
                    </td>
                    <td><?= $data['id_problem'] ?></td>
                    <td><?= $data['host'] ?></td>
                    <td><?=date('m/d/Y', strtotime( $data['alert_date']))?> ON <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
                    <td>
                      <?php
                      if (empty($data['endq'])) 
                      {
                        echo "NULL";
                      } 
                      else{
                           echo date('m/d/Y H:i:s', strtotime($data['endq'])) ;
                         
                      } 
                     
                      ?>
       
                    </td>
                    <td>
                           <?php
                        $start = strtotime($data['alert_date']);
                        $end = strtotime($data['endq']);
                        
                        if ($start && $end) {
                            $differenceInMinutes = round(($end - $start) / 60); // Selisih dalam menit
                            echo $differenceInMinutes . " menit";
                        } else {
                            echo "Data tidak valid";
                        }
                        ?>
                    </td>
                    <td><?= $data['customer'] ?></td>
                    <td><?= $data['site'] ?></td>
                        <td><?= $data['tf'] ?></td>
                    <td><?= $data['kategori_alert'] ?></td>
                    <td><?= $data['problem_alert'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['serverity'] ?></td>
                    <td><?= $data['deskripsi'] ?></td>
                    
                    
                  </tr>
        
                <?php
                 $no++;
                endwhile;
                ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
</section>

<?php
require_once '../layout/_bottom.php';
?>
<!-- Page Specific JS File -->
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
<script src="../assets/js/page/modules-datatables.js"></script>
<script>
function copyText(elementId) {
    // Ambil elemen berdasarkan ID
    var textToCopy = document.getElementById(elementId).innerText;
    
    // Buat elemen input sementara untuk menampung teks yang akan disalin
    var tempInput = document.createElement("input");
    tempInput.value = textToCopy;
    document.body.appendChild(tempInput);
    
    // Pilih teks dalam input sementara dan salin ke clipboard
    tempInput.select();
    document.execCommand("copy");
    
    // Hapus elemen input sementara
    document.body.removeChild(tempInput);

    // Beri tahu pengguna bahwa teks telah disalin
   
     iziToast.success({
        title: 'Sukses',
        message: "Teks berhasil disalin:"  + textToCopy ,
        position: 'topCenter',
        timeout: 3000
      });
}
</script>
<script>
  function copyText(id) {
            // Get the text content of the element by ID
            const textToCopy = document.getElementById(id).innerText;

            // Copy to clipboard
            navigator.clipboard.writeText(textToCopy)
            .then(() => {
              alert(`Text from ${id} copied to clipboard!`);
            })
            .catch(err => {
              console.error('Failed to copy text: ', err);
              alert('Failed to copy text.');
            });
          }
        </script>
