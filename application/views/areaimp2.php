<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!isset($_SESSION['user_id'])){
  redirect(base_url());
}
?>
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
	<select name="Faculty" id="faculty_select">
		  <option value="0">Select Faculty</option>
		  <?php
		  foreach ($facl_list as $rawData) {
			$faculty = $rawData['F_Name'];
            $facultyid = $rawData['Fid'];
			echo "<option value=\"$facultyid\">$faculty</option>";
		  }
		  ?>
		</select>
    <select id="field">
      <option  value="0">Select Field</option>
      <option  value="Theory">Theory</option>
      <option  value="Prac">Practicals</option>
    </select>
	<a class="btn btn-danger" id="final">Get results</a>
	<a style="float:right;display:none;" class="btn btn-danger" id="print">Print</a>
	<br>
	<span id="flag" style="color:red;">*Please select the faculty and field</span>
    <h1 id="dif">
	</h1>
	<br>
	<div id = "hide" style="display: none;">
	<h3>* List of Improvements *</h3>
	<div id="content1">
	<img src= "<?=base_url();?>/dist/img/header.jpg"/ style="display:none;">
	<br>
    <h4>Question - <h4 id = "ques"></h4></h4>
	<br>
    <h4>Average percentage -<h4 id = "avgper"></h4></h4>
	<br>
	<br>
	<h4>Comment -<h4 id = "comment"></h4></h4>
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
		$("#print").on('click',function(){
		var prtContent = document.getElementById("content1");
		var content = prtContent.innerHTML;
		content = "<img src=\"<?=base_url();?>/dist/img/header.jpg\"></img><br><b>" + $("#faculty_select option:selected").html() + "'s</b> Area of improvements:<br><br><b>" + $("#field option:selected").html() + "-</b><br>" + content;
		var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
		WinPrint.document.write(content);
		WinPrint.document.close();
		WinPrint.focus();
		WinPrint.print();
		WinPrint.close();
      });
      $("#final").on('click',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getavgminques/"+$("#field").val()+"/"+$("#faculty_select").val(),
          type:"POST",
          success:function(result){
			  if(result != 0){
				$("span#flag").html("");
				var output = $.parseJSON(result);
				var comment = output[1];
				$("#avgper").html("<b>" + output[0] + "%</b>");
				$("#hide").css('display', 'inline');
				$("#print").css('display', 'inline');
				$("#dif").html("<b>" + $("#field option:selected").html() + "</b>");
				var i=1;
				$("#ques").html("");
				for(var index=2; index < output.length; index++){
					$("#ques").append(i +". <b>" + output[index] + "</b><br>");
					++i;
				}
				if(comment){
				$("#comment").html("<b>'" + comment + "'</b>");
				}else{
				$("#comment").html("<b>"+ $("#faculty_select option:selected").html() +" hasn't commented yet.</b>");	
				}
			  }else{
				  alert($("#faculty_select option:selected").html() + " does not teach " + $("#field option:selected").html());
			  }
          }
        });
      });
    });
  </script>
  </body>
</html>
