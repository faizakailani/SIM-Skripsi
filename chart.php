<div class="row">   
 <div class="col-lg-12">   
   <h1 class="page-header">   
     Chart <small>Statistics Overview</small>       
   </h1>
   <ol class="breadcrumb">
     <li class="active">     
       <i class="fa fa-bar-chart"></i> Chart
     </li>
   </ol>
 </div>    
</div>        

<?php               
//$con = mysqli_connect("localhost","root","","toko");

$warna1 = "red";
$warna2 = "green"; 
$warna3 = "blue";     
$warna4 = "orange";      
$warna5 = "brown";          

//ambil data tabel yang ada di database
// dan ambil jumlah record dari setiap tabel tersebut
$i = 1;
$txt = "";
$jml = 0;    
$warna = "brown";
$h = mysqli_query($con, "show tables from simskripsi");
while($r = mysqli_fetch_array($h)){                 
  if(($r[0] != "user") && ($r[0] != "tw_tabel") && ($r[0] != "tw_hak_akses") && ($r[0] != "logtw") && ($r[0] != "setting")){
  $txt1 = "\"". $r[0] ."\"";
  $x = mysqli_query($con, "select * from ". $r[0]);
  $jml1 = mysqli_num_rows($x);
  if($txt == ""){
    $txt = $txt1;
    $jml = $jml1;   
    $warna = "\"". $warna1 ."\"";
  }else{                            
    $txt = $txt .",". $txt1;           
    $jml = $jml .",". $jml1;              
    if($i == 1) { $warna = $warna .",\"". $warna1 ."\""; }
    if($i == 2) { $warna = $warna .",\"". $warna2 ."\""; }   
    if($i == 3) { $warna = $warna .",\"". $warna3 ."\""; }      
    if($i == 4) { $warna = $warna .",\"". $warna4 ."\""; }         
    if($i == 5) { $warna = $warna .",\"". $warna5 ."\""; }            
  }
  if($i < 5){ $i++; }else{ $i = 1; }
  }                                    
}                                         
//echo $txt;                                 
//echo $jml;                                    
//echo $warna; 
?>                

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<canvas id="myChart" style="width:100%;max-width:100%"></canvas>

<script>
var xValues = [<?php echo $txt; ?>];
var yValues = [<?php echo $jml; ?>];   
var barColors = [<?php echo $warna; ?>];  

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{       
      backgroundColor: barColors,
      data: yValues                 
    }]
  },
  options: {
    legend: {display: false},
    title: {                    
      display: true,               
      text: "Jumlah Data"             
    }                                    
  }                                         
});  
</script>

