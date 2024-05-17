<!DOCTYPE html>
<html lang="en">
<head>
	<title>SIM Skripsi</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================--> 
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css"> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">  
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css"> 
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css"> 
<!--===============================================================================================--> 
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<?php
session_start();

if (isset($_SESSION["login_error"])) {
	$message = $_SESSION["login_error"];
	echo "<script>
			document.addEventListener('DOMContentLoaded', function() {
				Swal.fire({
					icon: 'error',
					title: 'Login gagal!',
					text: '$message'
				});
			});
		  </script>";
	unset($_SESSION["login_error"]);
}
//ambil data setting 
$hset = mysqli_query($con ,"select * from setting");  
while($rset = mysqli_fetch_array($hset)){
	$Logo = $rset["Logo"]; 
} 
?> 
<body>
	<form action=loginexec.php method=post> 
    <div class="container-login100" style="background-image: url('images/bg-01.png');"> 
			<div class="wrap-login100 p-l-55 p-r-55 p-t-60 p-b-30">
				<form class="login100-form validate-form"> 
					<span class="login100-form-title p-b-26">  
           <?php echo "<img src='images/" . $Logo . "' width=100 height=100><br>"; ?>  
						SIM Skripsi        
					</span> 

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">  
						<input class="input100" type="text" name="Email">           
						<span class="focus-input100" data-placeholder="Username"></span>  
					</div>                                                              

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">                                              
							<i class="zmdi zmdi-eye"></i>                                              
						</span>                                                                         
						<input class="input100" type="password" name="Password">                           
						<span class="focus-input100" data-placeholder="Password"></span>                      
					</div>                                                                                     

					<div class="container-login100-form-btn">  
						<div class="wrap-login100-form-btn">        
							<div class="login100-form-bgbtn"></div>      
							<button class="login100-form-btn">              
								<i class="fa fa-sign-in"></i>&nbsp;&nbsp;Login                                            
							</button>                                             
						</div>                                                     
					</div>                                                          

					<div class="text-center p-t-25">                                  
						<span class="txt1">                                                 

						</span>  

<br>
					</div>      
				</form> 
		</div>      
	</div>    

	<div id="dropDownSelect1"></div>   

<!--===============================================================================================--> 
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>                                                
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================--> 
	<script src="vendor/bootstrap/js/popper.js"></script> 
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>   
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script> 
<!--===============================================================================================--> 
	<script src="vendor/countdowntime/countdowntime.js"></script>  
<!--===============================================================================================--> 
	<script src="js/main.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body> 
</html> 
