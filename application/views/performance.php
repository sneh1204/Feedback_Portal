<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['user_id'])){
  redirect(base_url());
}
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Feedback of Performance</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="<?=base_url();?>bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url();?>icon/fontawesome/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url();?>icon/ionicon/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url();?>dist/css/skins/_all-skins.min.css">
  <style>
  td, th{
	width: 200px;  
	height: 40px;
	padding-left: 10px;
  }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
    <?php $this->load->view('header'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
	<div class="row">
	<div class="col-xs-12">
	<div class="row">
	<div class="col-xs-4">
    <h2>Performance Result:<br><h5><b>For year - <?=$semyear;?></b></h5></h2>
	</div>
	<div class="col-xs-8">
	<h4 style="float: right;"><b>Total faculty average: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format((float) $avg, 2) . "%<br>"; ?> 
	Appreciation cutoff: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format((float) $gthres, 2) . "%<br>"; ?>
	Below average cutoff: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo number_format((float) $bthres, 2) . "%"; ?> </b></h4>
	</div>
	</div>
	<div class="container" style="width: 100%; height: 100%;">
		<div class="best" style="width: 50%; float:left;">
		<h4><u>Appreciation:</u></h4>
		<?php
		if(!empty($appr)){
			echo '<table border="5px";>';
			echo '<tr><th>Faculty</th><th>Percentage</th></tr>';
			arsort($appr);
			foreach($appr as $id => $per){
				$name = $facl[$id];
				echo '<tr>';
				echo '<td>'.$name.'</td>';
				echo '<td>'.$per.'%</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		?>
		</div>
		<div class="bad" style="width: 50%; float:right;">
		<?php
		if(!empty($bad)){
		?>
		<h4><u>Below average performance:</u></h4>
		<?php
			echo '<table border="5px";>';
			echo '<tr><th>Faculty</th><th>Percentage</th></tr>';
			asort($bad);
			foreach($bad as $id => $per){
				$name = $facl[$id];
				echo '<tr>';
				echo '<td>'.$name.'</td>';
				echo '<td>'.$per.'%</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		?>
		</div>
	</div>
	<br>
	</div>
	</div>
	</section>
	</div>
	<footer class="main-footer">
    <div class="pull-right hidden-xs">Updated Dec,2018.
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="http://www.shahandanchor.com">SAKEC(IT dept)</a>.</strong> All rights
    reserved.
  </footer>
  <div class="control-sidebar-bg"></div>
</div>

	<!-- Bootstrap 3.3.5 -->
	<script src=" <?=base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <script src=" <?=base_url();?>bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src=" <?=base_url();?>dist/js/app.min.js"></script>
  </body>
</html>
