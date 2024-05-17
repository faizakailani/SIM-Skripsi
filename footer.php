    <!-- CSS FILE -->
    <link rel="stylesheet" href="footer.css">   
    <!-- jQuery -->   
   <script src="js/jquery.js"></script>                                       
   <!-- Bootstrap Core JavaScript -->   
   <script src="js/bootstrap.min.js"></script>                                    
   <!-- Morris Charts JavaScript --> 
   <script src="js/plugins/morris/raphael.min.js"></script> 
   <script src="js/plugins/morris/morris.min.js"></script> 
   <script src="js/plugins/morris/morris-data.js"></script>               
    <!-- Bootstrap Core JavaScript -->   
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>  
    <!-- Metis Menu Plugin JavaScript -->        
    <script src="bower_components/metisMenu/dist/metisMenu.min.js"></script>  
   <!-- DataTables JavaScript -->                
    <script src="bower_components/datatables/media/js/jquery.dataTables.min.js"></script> 
    <script src="bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>  
    <!-- Custom Theme JavaScript -->   
    <script src="dist/js/sb-admin-2.js"></script> 
    <!-- Page-Level Demo Scripts - Tables - Use for reference --> 
    
        <script>                    
        $(document).ready(function() { 
            $('#dataTables-example').DataTable({   
                    responsive: true      
            });                      
        });              
        </script>
   <?php 
   if (isset($_SESSION["success_message"])) {
    $message = $_SESSION["success_message"];
          echo "<script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil!',
                          text: '$message'
                      });
                  });
                </script>";
          unset($_SESSION["success_message"]);
  }
  
  if (isset($_SESSION["delete_success"])) {
    echo "<script>
              document.addEventListener('DOMContentLoaded', function() {
                  Swal.fire({
                      icon: 'success',
                      title: 'Berhasil!',
                      text: '{$_SESSION['delete_success']}'
                  });
              });
            </script>";
      unset($_SESSION['delete_success']);
     
  }
  
  if (isset($_SESSION['edit_success'])) {
    $message = $_SESSION['edit_success'];
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: '$message'
                });
            });
          </script>";
    unset($_SESSION['edit_success']);
  }
   $setting = mysqli_query($con, 'select * from setting'); 
    while($rowSetting = mysqli_fetch_array($setting)){ 
        $Nama = $rowSetting[1]; 
        $Alamat = $rowSetting[2]; 
        $Telepon = $rowSetting[3]; 
        $Email = $rowSetting[4];
        $Logo = $rowSetting["Logo"];
    }
    ?>
   <footer>     
    <div class="footer-content">
    <table>
        <?php echo "<img src='images/" . $Logo . "' width=110 height=110>"; ?>
        <td> 
        <p><?php echo  $Alamat;?></p>
        <p><?php echo $Telepon;?></p>
        <p><?php echo $Email;?></p>
        </td>     
    </table>   
     <br>
     <div class="copyright">Copyright &copy; 2024 <?php echo"$Nama"?> </div>
    </div> 
</footer> 
<br>
</body>
</html>  
