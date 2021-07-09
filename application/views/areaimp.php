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
  <title>Areas of Improvement</title>
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
		  <h3>Areas of Improvement</h3>
    <select id="field" style="width: 100px;height:32px;">
      <option  value="0">Select Field</option>
      <option value="Theory">Theory</option>
      <option value="Prac">Practicals</option>
    </select>
	<a class="btn btn-danger" id="final">Get results</a>
	<br>
	<span id="flag" style="color:red;">*Please select a field</span>
    <h1 id="dif">
	</h1>
	<br>
	<div id = "hide" style="display: none;">
	<h3>* List of Improvements *</h3>
	<br>
    <h4>Question - <h4 id = "ques"></h4></h4>
	<br>
    <h4>Average percentage -<h4 id = "avgper"></h4></h4>
	<br>
	<h4>Comment (200 length):</h4>
	<div class = "comment-box">
	<textarea id="textar" name="textar" rows="5" cols="40" maxlength="200"></textarea>
	<p style= "color: red";><span class="error">* required field</span></p>
	<a class="btn btn-danger" id="final2">Submit</a>
	</div>
	<div class="responded">
	<span id="show-comment" style="color: black;"></span>
	<br>
	<a class="btn btn-primary" id="final3">Edit Your Response</a>
	</div>
	</div>
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
  <script type="text/javascript">
    $(document).ready(function(){
		$(".treeview").removeClass('active');
		$(".treeview").eq(0).addClass('active');
      $("#final").on('click',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getavgminques/"+$("#field").val(),
          type:"POST",
          success:function(result){
			  if(result != 0){
				$("span#flag").html("");
				var output = $.parseJSON(result);
				$("#dif").html("<b>" + $("#field option:selected").html() + "</b>");
				$("#hide").css('display', 'inline');
				$("#avgper").html("<b>" + output[0] + "%</b>");
				var i=1;
				$("#ques").html("");
				for(var index=2; index < output.length; index++){
					$("#ques").append(i +". <b>" + output[index] + "</b><br>");
					++i;
				}
			  }else{
				  if($("#field").val() != 0){
					alert("No reviews for " + $("#field option:selected").html());
				  }else{
					alert("Select a field to get results!");
				  }
			  }
          }
        });
      });
	  $("#final2").on('click',function(){
		  comment = $("textarea#textar").val();
	   if(comment == ""){
		   alert("Please enter a comment to submit!");
	   }
		if(comment.length > 200 || comment.length <= 5){
			alert('Please write a comment between 5-200 characters only!');
		}
	   else{
		$.ajax({
		  url:"<?=base_url();?>/index.php/ctrl_admin/insertcomment/",
		  data: {comment: comment},
		  type:"POST",
		  success:function(result){
			  $('.comment-box').css('display', 'none');
			  $('.responded').css('display', 'inline');
			  $('#show-comment').html("<p style='font-size: 16px;'>Your response - '<span style='color: black;'>" + result + "</span>'</p>");
		  }
		});
	   }
      });
	  $("#final3").on('click',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getcomment/<?php echo $this->session->userdata('user_id'); ?>/edit",
          type:"POST",
          success:function(result){
			   $('.responded').css('display', 'none');
			   $('.comment-box').css('display', 'inline');
			   $('#textar').val(result);
          }
        });
	  });
	  $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/hascommented/",
          type:"POST",
          success:function(result){
			  if(result != 0){
				  $('.comment-box').css('display', 'none');
				  $('.responded').css('display', 'inline');
				  $('#show-comment').html("<p style='font-size: 16px;'>Your response - '<span style='color: black;'>" + result + "</span>'</p>");
			  }else{
				  $('.comment-box').css('display', 'inline');
				  $('.responded').css('display', 'none');
			  }
          }
        });
    });
  </script>
  </body>
</html>
