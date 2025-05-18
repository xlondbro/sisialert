<?php
require_once '../session_check.php';
require_once '../layout/_top.php';
require_once '../helper/connection.php';

        
?>
<style>
       

        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal; /* memastikan teks membungkus */
        }

     
    </style>
<section class="section">

  <div class="section-header d-flex justify-content-between">
    <h1>Laporan</h1>
    <!--  <a href="./create.php" class="btn btn-primary">Tambah Data</a> -->
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
         <form method="POST">
          <div class="form-row">
           <div class="col-md-2 mb-3">
            <label>Tanggal dari</label>
             <input type="date" class="form-control" name="date1" value="<?php echo isset($_POST['date1']) ? $_POST['date1'] : '' ?>"  required="">
           </div>
           <div class="col-md-2 mb-3">
            <label>Sampai Tanggal</label>
            <input type="date" class="form-control" name="date2" value="<?php echo isset($_POST['date2']) ? $_POST['date2'] : '' ?>" required="">
          </div>

           <div class="col-md-2 mb-3">
              <label style="color:white">-</label>
            <input type="submit" class="form-control btn btn-primary" name="search" value="Cari">
           </div>
            <div class="col-md-2 mb-3">
            <label style="color:white">-</label>
            <a  href="index.php" class="form-control btn-warning" style="text-decoration:none;"><center></i>Refresh</center></a>
          </div>
         <!--   <div class="col-md-2 mb-3">
            <label style="color:white">-</label>
            <a target="_blank" href="laporanexcel.php" class="form-control btn-success" style="text-decoration:none;"><center></i>Excel</center></a>
          </div> -->
       <!--   <div class="col-md-2 mb-3">
            <label style="color:white">-</label>
            <input type="submit" class="form-control btn-primary" name="submit" value="cari">
          </div>
          <div class="col-md-2 mb-3">
            <label style="color:white">-</label>
            <a target="_blank" href="" class="form-control btn-success" style="text-decoration:none;"><center><i class="fas fa-print"></i> Ekspor</center></a>
          </div> -->
        </div>
      </form>
      <div class="table-responsive">
        <table class="table table-hover table-striped w-100" id="example">
          <thead>
            <tr>
              <th>No</th>
              <th>ID Problem</th>
              
              <th>Start Alert</th>
              <th>End</th>
              <th>Downtime</th>
              <th>Customer </th>
              <th>Site</th>
               <th>True False</th>
              <th>Kategori Alert</th>
               <th>Nomor Tiket</th>
              <th>Status</th>
              <th>Host</th>
              <th>Problem</th>
              <th>Deskripsi</th>
              
              
            </tr>
          </thead>
          <tbody>
 <?php include'range.php'?> 
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
$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip', // Aktifkan tombol di atas tabel
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export ke Excel', // Teks tombol
                title: 'Data Laporan <?php echo isset($_POST['date1']) ? date("d-m-Y", strtotime($_POST['date1'])) : '' ?> s/d <?php echo isset($_POST['date2']) ? date("d-m-Y", strtotime($_POST['date2'])) : '' ?> ', // Judul file Excel
               
                className: 'btn btn-success', // Tambahkan kelas jika perlu
                exportOptions: {
                    columns: ':visible' // Ekspor hanya kolom yang terlihat
                }
            }
        ]
    });
});
</script>
