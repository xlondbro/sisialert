<?php


require_once '../helper/connection.php';

        if(ISSET($_POST['search'])){
                $no = 1;
                $date1 = date("Y-m-d", strtotime($_POST['date1']));
                $date2 = date("Y-m-d", strtotime($_POST['date2']));
                $result=mysqli_query($connection, "SELECT * FROM `alert` WHERE date(`alert_date`) BETWEEN '$date1' AND '$date2'") or die(mysqli_error());
                $row=mysqli_num_rows($result);
                if($row>0){
                         while ($data = mysqli_fetch_array($result)) {
?>




       
       <tr>
                    <td><?= $no++ ?></td>
                             <td>
  <div id="alert-<?= $data['id_alert']?>" style="display: none;" class="hidden-text">
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
  <button class="copyButton btn btn-sm btn-warning" onclick="copyText('alert-<?= $data['id_alert']?>')"> <i class="fas fa-copy"></i> </button><p>
     <a class="btn btn-sm btn-success" href="edit2.php?id_alert=<?= $data['id_alert'] ?>"><i class="fas fa-check"></i>              
                    </a> </p>
</td>
                    <td><?= $data['id_problem'] ?></td>
                    <td><?= $data['host'] ?></td>
                    <td><?=date('d/m/Y', strtotime( $data['alert_date']))?> ON <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
                     <td> <?php
                      if (empty($data['endq'])) 
                      {
                        echo "NULL";
                      } 
                      else{
                           echo date('d-m-Y H:i:s', strtotime($data['endq'])) ;
                         
                      } 
                     
                      ?>
       </td>
                    <td><?= $data['customer'] ?></td>
                    <td><?= $data['site'] ?></td>
                    <td><?= $data['kategori_alert'] ?></td>
                    <td><?= $data['problem_alert'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['tf'] ?></td>
                    <td style="word-wrap: break-word;"><?= $data['notiket'] ?></td>
                    <td class="gallery">
                     <button id="button<?= $data['id_alert']?>" onclick="openModal(this.id)" class="btn btn-sm btn-primary">Lihat Gambar</button>
                    <!--  <button id="myBtn" onclick="openModal('<?= $data['id_alert']?>')">Caliak Gambar</button>  -->
                       <!-- <?php
                      $images = explode(',', $data['img']);
                        foreach ($images as $image) {
                            echo "<img src='../uploads/$image' alt='Image' id='myImg'  style='width: 100px; height: auto; margin: 5px;' onclick='openModal(this.src)' ><br>";
                        } 
                      ?>  -->

                      <!--  <a href="">Gambar Klik disiko cukk</a> -->

                    </td>
                    <td>
                      <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="delete.php?id_alert=<?= $data['id_alert'] ?>">
                        <i class="fas fa-trash fa-fw"></i>
                      </a>
                      <a class="btn btn-sm btn-info" href="edit.php?id_alert=<?= $data['id_alert'] ?>">
                        <i class="fas fa-edit fa-fw"></i>
                      </a>

                      <!-- The Modal -->
                      <div id="modal-button<?= $data['id_alert']?>" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                          <span class="close">&times;</span>
                          <div class="image-container">
                           <?php
                           $images = explode(',', $data['img']);
                           foreach ($images as $image) {
                            echo "<img src='../uploads/$image' style='width: 300px; height: auto; margin: 5px;' 
                            ><br>";
                          } 
                          ?> 
                        </div>
                      </div>

                    </div>
                 <!--     <div id="modal-button<?= $data['id_alert']?>" class="modal">
                    <div class="modal-content">
                       <div class="image-container">
                        
                        <p> <?php
                           $images = explode(',', $data['img']);
                           foreach ($images as $image) {
                            echo "<img src='../uploads/$image' style='width: 300px; height: auto; margin: 5px;' 
                            ><br>";
                          } 
                          ?> </p>
                       </div>
                    </div>
                </div> -->
 <!-- <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal(this.src)">&times;</span>
        <img class="modal-content" id="modalImage">
      </div> -->
      <!-- The Modal -->

 <div id="alert2-<?= $data['id_alert']?>" style="display: none;" class="hidden-text">
    <pre>#### PROBLEM ####
----------------------------------------
* Host: <?= $data['host'] ?><br>
* Severity: <?= $data['serverity'] ?><br>
* Problem: <?= $data['problem_alert'] ?> <br>
* Operational data: <?= $data['operational'] ?> <br>
* Problem started at: <?= $data['alert_date'] ?><br>
* Original problem ID: <?= $data['id_problem'] ?><br>

Perangkat : <?= $data['host'] ?> mengalami Problem : <?= $data['problem_alert'] ?> pada <?= $data['alert_date'] ?>.<br>
Terlampir Graph : Operational Status
Perihal ini minta tolong dibantu pengecekanya.
    </pre>
  </div>
  <button class="copyButton btn btn-sm btn-warning" onclick="copyText('alert2-<?= $data['id_alert']?>')"> <i class="fas fa-copy"></i> </button>

  </td>
</tr>

        </tr>
<?php
                        }
                }else{
                        echo'
                        <tr>
                                <td colspan = "15"><center>Record Not Found</center></td>
                        </tr>';
                }
        }else{
                 $no = 1;
                $result=mysqli_query($connection, "SELECT * FROM `alert` order by id_alert desc") or die(mysqli_error());
                while($data=mysqli_fetch_array($result)){
?>

        <tr>   <td><?= $no++ ?></td>
                 <td>
  <div id="alert-<?= $data['id_alert']?>" style="display: none;" class="hidden-text">
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
  <button class="copyButton btn btn-sm btn-warning" onclick="copyText('alert-<?= $data['id_alert']?>')"> <i class="fas fa-cpy"></i>Alert Resolve</button>
  <a class="btn btn-sm btn-success" href="edit2.php?id_alert=<?= $data['id_alert'] ?>">Resolve<i class="fas fa-check"></i>             
                    </a>
</td>
                    <td><?= $data['id_problem'] ?></td>
                    <td><?= $data['host'] ?></td>
                    <td><?=date('d/m/Y', strtotime( $data['alert_date']))?> ON <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
                     <td> <?php
                      if (empty($data['endq'])) 
                      {
                        echo "NULL";
                      } 
                      else{
                           echo date('d-m-Y H:i:s', strtotime($data['endq'])) ;
                         
                      } 
                     
                      ?>
       </td>
                    <td><?= $data['customer'] ?></td>
                    <td><?= $data['site'] ?></td>
                    <td><?= $data['kategori_alert'] ?></td>
                    <td><?= $data['problem_alert'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['tf'] ?></td>
                    <td style="word-wrap: break-word;"><?= $data['notiket'] ?></td>
                    <td class="gallery">
                     <button id="button<?= $data['id_alert']?>" onclick="openModal(this.id)" class="btn btn-sm btn-primary">Caliak Gambar</button>
                    <!--  <button id="myBtn" onclick="openModal('<?= $data['id_alert']?>')">Caliak Gambar</button>  -->
                       <!-- <?php
                      $images = explode(',', $data['img']);
                        foreach ($images as $image) {
                            echo "<img src='../uploads/$image' alt='Image' id='myImg'  style='width: 100px; height: auto; margin: 5px;' onclick='openModal(this.src)' ><br>";
                        } 
                      ?>  -->

                      <!--  <a href="">Gambar Klik disiko cukk</a> -->

                    </td>
                    <td>
                      <a class="btn btn-sm btn-danger mb-md-0 mb-1" href="delete.php?id_alert=<?= $data['id_alert'] ?>">Hapus
                        <i class="fas fa-trash fa-fw"></i>
                      </a>
                      <a class="btn btn-sm btn-info" href="edit.php?id_alert=<?= $data['id_alert'] ?>">Edit Data
                        <i class="fas fa-edit fa-fw"></i>
                      </a>

                      <!-- The Modal -->
                      <div id="modal-button<?= $data['id_alert']?>" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                          <span class="close">&times;</span>
                          <div class="image-container">
                           <?php
                           $images = explode(',', $data['img']);
                           foreach ($images as $image) {
                            echo "<img src='../uploads/$image' style='width: 300px; height: auto; margin: 5px;' 
                            ><br>";
                          } 
                          ?> 
                        </div>
                      </div>

                    </div>
                 <!--     <div id="modal-button<?= $data['id_alert']?>" class="modal">
                    <div class="modal-content">
                       <div class="image-container">
                        
                        <p> <?php
                           $images = explode(',', $data['img']);
                           foreach ($images as $image) {
                            echo "<img src='../uploads/$image' style='width: 300px; height: auto; margin: 5px;' 
                            ><br>";
                          } 
                          ?> </p>
                       </div>
                    </div>
                </div> -->
 <!-- <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal(this.src)">&times;</span>
        <img class="modal-content" id="modalImage">
      </div> -->
      <!-- The Modal -->


  <div id="alert2-<?= $data['id_alert']?>" style="display: none;" class="hidden-text">
    <pre>#### PROBLEM ####
----------------------------------------
* Host: <?= $data['host'] ?><br>
* Severity: <?= $data['serverity'] ?><br>
* Problem: <?= $data['problem_alert'] ?> <br>
* Operational data: <?= $data['operational'] ?> <br>
* Problem started at: <?= $data['alert_date'] ?><br>
* Original problem ID: <?= $data['id_problem'] ?><br>

Perangkat : <?= $data['host'] ?> mengalami Problem : <?= $data['problem_alert'] ?> pada <?= $data['alert_date'] ?>.<br>
Terlampir Graph : Operational Status
Perihal ini minta tolong dibantu pengecekanya.
    </pre>
  </div>
  <button class="copyButton btn btn-sm btn-warning mb-md-0 mb-1" onclick="copyText('alert2-<?= $data['id_alert']?>')"> <i class="fas fa-cpy"></i>Alert Progress</button>


  </td>
        </tr>
<?php
                }
        }
?>


