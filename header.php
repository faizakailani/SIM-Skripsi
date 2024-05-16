<link href="page1.css" rel="stylesheet" type="text/css">
<!DOCTYPE html> 
<html lang="en"> 
<head>  
    <meta charset="utf-8">   
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">    
    <meta name="author" content="">     
    <title>SIM Skripsi</title>   
	<link rel="stylesheet" type="text/css" href="tag.css"> 
	<script type="text/javascript" src="tag.js"></script>  
	<script type="text/javascript" src="kalender/calendar.js"></script>  
	<link href="kalender/calendar.css" rel="stylesheet" type="text/css" media="screen"> 
    <!-- Bootstrap Core CSS -->               
    <link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"> 
    <!-- MetisMenu CSS -->
    <link href="bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">   
    <!-- Timeline CSS -->  
    <link href="dist/css/timeline.css" rel="stylesheet">  
    <!-- Custom CSS -->  
    <link href="dist/css/sb-admin-2.css" rel="stylesheet"> 
    <!-- Morris Charts CSS -->         
    <link href="bower_components/morrisjs/morris.css" rel="stylesheet">  
    <!-- Custom Fonts -->          
    <link href="bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"> 
    <!-- Custom Navbar -->          
    <link href="navbar.css" rel="stylesheet">
   <!-- Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" 
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->     
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->  
    <!--[if lt IE 9]>                                                             
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>  
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script> 
    <![endif]-->                                   
<link href="standar.css" rel="stylesheet" type="text/css">   
<!-- calendar -->                         
<script src="php_calendar/scripts.js" type="text/javascript"></script>  
<!-- TinyMCE -->                     
<script type="text/javascript" src="tiny_mce/tiny_mce.js"></script> 
<script type="text/javascript">                 
	tinyMCE.init({             
		mode : "textareas",     
		theme : "advanced",     
		plugins : "youtube,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print,paste,directionality,fullscreen,noneditable,contextmenu",   
		theme_advanced_buttons1_add_before : "save,newdocument,separator",   
		theme_advanced_buttons1_add : "fontselect,fontsizeselect",         
		theme_advanced_buttons2_add : "separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor,liststyle",  
		theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,search,replace,separator",   
		theme_advanced_buttons3_add_before : "tablecontrols,separator,youtube,separator",              
		theme_advanced_buttons3_add : "emotions,iespell,flash,advhr,separator,print,separator,ltr,rtl,separator,fullscreen",   
		theme_advanced_toolbar_location : "top",   
		theme_advanced_toolbar_align : "left",   
		theme_advanced_statusbar_location : "bottom",  
		plugin_insertdate_dateFormat : "%Y-%m-%d",   
		plugin_insertdate_timeFormat : "%H:%M:%S",   
		extended_valid_elements : "hr[class|width|size|noshade]", 
		file_browser_callback : "fileBrowserCallBack",    
		paste_use_dialog : false,                     
		theme_advanced_resizing : true,             
		theme_advanced_resize_horizontal : false,   
		theme_advanced_link_targets : "_something=My somthing;_something2=My somthing2;_something3=My somthing3;", 
		media_strict : false,   
		apply_source_formatting : true  
	});                          
	function fileBrowserCallBack(field_name, url, type, win) {   
		var connector = "../../filemanager/browser.html?Connector=connectors/php/connector.php";    
		var enableAutoTypeSelection = true;                              
		var cType;           
		tinymcpuk_field = field_name;    
		tinymcpuk = win;        
		switch (type) {     
			case "image":     
				cType = "Image";  
				break;          
			case "flash":     
				cType = "Flash";   
				break;      
			case "file":  
				cType = "File"; 
				break;   
		}             
		if (enableAutoTypeSelection && cType) {      
			connector += "&Type=" + cType;     
		}                                
		window.open(connector, "tinymcpuk", "modal,width=600,height=400");     
	}          
</script>       
<!-- /TinyMCE -->   
</head>     
<?php  
//ambil data setting 
$hset = mysqli_query($con ,"select * from setting"); 
while($rset = mysqli_fetch_array($hset)){
	$Nama = $rset["Nama"];  
} 
?>  
<body>    
    <div id="wrapper">     
        <!-- Navigation -->    
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">   
            <div class="navbar-header">             
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">  
                    <span class="sr-only">Toggle navigation</span>  
                    <span class="icon-bar"></span>    
                    <span class="icon-bar"></span>  
                    <span class="icon-bar"></span>  
                </button>                      
                <a class="navbar-brand" href="content.php">SIM Skripsi - <?php echo $Nama;?></a>    
            </div>                             
            <!-- /.navbar-header -->      
            <ul class="nav navbar-top-links navbar-right">   
               <li class="dropdown">         
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">    
                    <i class="fa-solid fa-user" style="color: #272829;"></i> <i class="fa-solid fa-caret-down" style="color: #272829;"></i>    
                    </a>             
                    <ul class="dropdown-menu dropdown-user">   
                        <li><a href="#"><i class="fa fa-user fa-fw"></i><?php echo $_SESSION['Email'];?></a> 
                        </li>                
                        <li><a href="listsetting.php"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                    </ul>         
                    <!-- /.dropdown-user -->     
                </li>                    
               <!-- /.dropdown -->    
            </ul>           
            <!-- /.navbar-top-links -->    
