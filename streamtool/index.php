<?php session_start(); 
  error_reporting(E_ALL);
$_SESSION['debug']=false;
$security_required_level = 1;
date_default_timezone_set('Europe/Berlin');
if(isset($_SESSION['user_username'])){
	
	
	
	
}else{
	#header("Location:http://192.168.0.11/label/login.php");
}


include("include/db_connect.php");
include("include/db_querys.php");
include("include/times.php");


?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>DCW Streamtool</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="plugins/ionicons/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
  
  
  <!-- User-CSS -->
  <link href="css/usercss.css" rel="stylesheet">
  
  <!-- Tell Apple-Devices it's a WebApp -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="white">
  <meta name="apple-mobile-web-app-title" content="Label-Editor">
  
  

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php

  
  
  
  
  
		
		
  
	include("include/html_navbar.php");
	include("include/html_sidebar.php");
  
  
  
  ?>
  
   <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"></h1>
          </div><!-- /.col -->
          <!--<div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
     
  
  
  <?php
  
  include("include/html_result.php"); // the default result-handler
	if(isset($_GET['page'])){
		$include_page = $_GET['page'];
	}else{
		$include_page = "start";
	}
	
	if(is_file($include_page.".php")){
		include($include_page.".php");
	}else{
		include("404.php");
	}
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  include("include/html_footer.php");
  ?>
  
  <script src='js/userjs.js'></script>
        
