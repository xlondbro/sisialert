
<?php
require_once '../session_check.php';
require_once '../layout/_top.php';
require_once '../helper/connection.php';

$result = mysqli_query($connection, "SELECT * FROM alert order by id_alert desc");

?>

<?php include_once('otel.php'); ?>

<style>
.image-container {
  display: flex;
  flex-wrap: wrap; /* Gambar akan pindah ke baris baru jika jumlah maksimum kolom terpenuhi */
  gap: 10px; /* Jarak antar gambar */
}
.image-container img {
  flex: 1 1 calc(33.33% - 10px); /* Setiap gambar mengambil 1/3 lebar kontainer */
  max-width: calc(33.33% - 10px); /* Maksimum 3 kolom */
  height: auto; /* Menjaga proporsi gambar */
}
</style>
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;

}


</style>
<style>
       

        td {
            width: 1000;
            border: 2px solid #ddd;
            padding: 1px;
            text-align: center;
            word-wrap: break-word;
            word-break: break-word;
            white-space: normal; /* memastikan teks membungkus */
        }

     
    </style>
<section class="section">
  <div class="section-header d-flex justify-content-between">
    <h1>Alert</h1>

    <a href="./create.php" class="btn btn-primary">Tambah Data</a>
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
            <table class="table table-hover table-striped w-100" id="table-1">
              <thead>
                <tr>
                  <th>No</th>
                   <th> Aksi</th>
                  <th>ID Problem</th>
                  <th>Host</th>
                  <th>Start Alert</th>
                    <th>End Time</th>
                  <th>Customer </th>
                  <th>Site</th>
                  <th>Kategori Alert</th>
                  <th>Problem</th>
                  <th>Status</th>
                  <th>True False</th>
                   <th >Nomor Tiket</th>
                  <th>Gambar</th>
                  <th style="width: 200"> Aksi 2</th>
                  
                </tr>
              </thead>
              <tbody>
 <?php include'range2.php'?> 
              
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



        <script>
  // Open modal and display clicked image

  // function openModal(imageSrc) {
  //   const modal = document.getElementById("imageModal");
  //   const modalImage = document.getElementById("modalImage");
  //   modal.style.display = "block";
  //   modalImage.src = imageSrc;
  // }
     function openModal(buttonId) {
            const modalId = "modal-" + buttonId; // Buat ID modal sesuai ID tombol
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = "flex"; // Tampilkan modal
            }
        }
        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = "none"; // Sembunyikan modal
            }
        }
            // Tambahan: Menutup modal saat klik di luar area modal
        window.addEventListener("click", function (e) {
            const modals = document.querySelectorAll(".modal");
            modals.forEach(modal => {
                if (e.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
// Close modal
function closeModal(imageSrc) {
  const modal = document.getElementById("imageModal");
  modal.style.display = "none";
}
window.onclick = function(event) {
  const modal = document.getElementById('imageModal');
  if (event.target === modal) {
    modal.style.display = "none";
  }
}
</script>
 <script>
        function copyTextById(id) {
            const element = document.getElementById(id);
            if (element) {
                const text = element.innerText; // Ambil teks dari elemen
                const textarea = document.createElement('textarea');
                textarea.value = text; // Masukkan teks ke textarea
                document.body.appendChild(textarea); // Tambahkan ke DOM
                textarea.select(); // Pilih teks di textarea
                document.execCommand('copy'); // Salin teks ke clipboard
                document.body.removeChild(textarea); // Hapus textarea
                alert(Teks berhasil disalin ke clipboard  !' ${id});
            } else {
                alert('Elemen tidak ditemukan!');
            }
        }
    </script>
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";

}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>