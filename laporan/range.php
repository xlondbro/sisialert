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
                  <td><?= $data['id_problem'] ?></td>
                 
                    <td><?=date('m/d/Y', strtotime( $data['alert_date']))?> <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
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
             <td><?= $data['notiket'] ?></td>
               <td><?= $data['status'] ?></td>
              <td><?= $data['host'] ?></td>
              
             
                  <td><?= $data['problem_alert'] ?></td>
                  <td><?= $data['deskripsi'] ?></td>
                  
        </tr>
<?php
                        }
                }else{
                        echo'
                        <tr>
                                <td colspan = "13"><center>Record Not Found</center></td>
                        </tr>';
                }
        }else{
                 $no = 1;
                $result=mysqli_query($connection, "SELECT * FROM `alert`") or die(mysqli_error());
                while($data=mysqli_fetch_array($result)){
?>

        <tr>    <td><?= $no++ ?></td>
                  <td><?= $data['id_problem'] ?></td>
                    
                    <td><?=date('m/d/Y', strtotime( $data['alert_date']))?> <?=date('H:i:s', strtotime( $data['alert_date']))?></td>
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
                <td><?= $data['notiket'] ?></td>
               <td><?= $data['status'] ?></td>
               <td><?= $data['host'] ?></td>
               
              
               <td><?= $data['problem_alert'] ?></td>
               <td><?= $data['deskripsi'] ?></td>
        </tr>
<?php
                }
        }
?>