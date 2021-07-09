<?php
require 'vendor\autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
  <title>Mail Faculty</title>
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
		  <h3>Mail Faculty</h3>
	<br>
	<form method="POST">
	<h4>Head:</h4>
	<input name = "head" type="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter head" value="SAKEC IT Feedback">
	<h4>Subject:</h4>
	<input name = "subject" type="username" class="form-control" aria-describedby="emailHelp" placeholder="Enter subject" value="Feedback Update!">
	<h4>Body:</h4>
	<textarea name = "body" class="form-control" rows="6">Feedback has been filled by students!</textarea><br>
	<button type="submit" name="submit" class="btn btn-danger" id="final">Send Mail</button>
	</form>
	<?php
	if(isset($_POST['submit'])){
		$mail = new PHPMailer(true);                             
		try {
			
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			$mail->isSMTP();                                     
			$mail->SMTPDebug = 1;                                     
			$mail->AuthType = 'PLAIN';
			$mail->Host = 'smtp.gmail.com';  
			$mail->SMTPAuth = true;                               
			$mail->Username = 'It-feedback@sakec.ac.in';                
			$mail->Password = 'SmartFeedback123';                             
			$mail->SMTPSecure = 'tls';                      
			$mail->Port = 587;                                  

			
			$mail->setFrom('It-feedback@sakec.ac.in', $_POST['head']);
			$a = ['sneh.jain@sakec.ac.in'];
			foreach($a as $email){
				$mail->addAddress($email);  
			}
			$mail->addReplyTo('It-feedback@sakec.ac.in', $_POST['head']);

			
			$mail->isHTML(true);                                 
			$mail->Subject = $_POST['subject'];
			$mail->Body    = $_POST['body'];
			$mail->AltBody = $_POST['body'];

			$mail->send();
			echo 'Mails have been sent';
		} catch (Exception $e) {
			echo 'Mails could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}
	?>
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
