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
  <title>Classwise Summary</title>
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
    <select name="class" id="class_select">
              <option value="0">Select Class</option>
            </select>
            <select name="divion" id="div_select">
              <option value="0">Select Division</option>
            </select>
            
	<a class="btn btn-danger" id="final">Get results</a>

	<div class="td" style="float: center;">
		</div>
		
		
	<h3>Classwise Summary of Faculty -</h3>
	</div>
	</div>
	<?php
            echo '<div class="row">';
            echo '<div class="col-xs-6">';

                echo '<div class="box box-danger">';
                echo '<div class="box-header with-border">';

              echo '<div class="box-tools pull-right">';
                echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>';
                echo '</button>';
              echo '</div>';
            echo '</div>';
            echo '<div class="box-body">';
              echo '<canvas id="pieChart1" style="height:250px"></canvas>';
            echo '</div>';

          echo '</div>';

          echo '</div>';
		  echo '<div class="col-xs-6">';
		  if(!empty($this->input->get('value'))){
		  echo '<table align= "center"  style="float: center;"> 
		    <tr>
			<th style="background-color:green; width:40px; color:green;"></th>
			<th style="width:120px;padding-left: 20px;">=> Excellent  </th>';
			$total = $A + $B + $C + $D;
			$Aper = ($A / $total) * 100;
			$Bper = ($B / $total) * 100;
			$Cper = ($C / $total) * 100;
			$Dper = ($D / $total) * 100;
			$AP = Number_format((float) $Aper, 2);
			$BP = Number_format((float) $Bper, 2);
			$CP = Number_format((float) $Cper, 2);
			$DP = Number_format((float) $Dper, 2);
		  echo '<th style="width:120px;padding-left: 20px;">Count: '.$AP.' %</th>';
		  echo '
			</tr>
			<tr>
			<th style="background-color:#1e5b99; width:40px; color:#1e5b99;"></th>
			<th style="width:120px;padding-left: 20px;">=> Very Good  </th>';
		  echo '<th style="width:120px;padding-left: 20px;">Count: '.$BP.' %</th>';
		  echo '
			</tr>
			<tr>
			<th style="background-color:#f39c12; width:40px; color:#f39c12;"></th>
			<th style="width:120px;padding-left: 20px;">=> Good  </th>';
		  echo '<th style="width:120px;padding-left: 20px;">Count: '.$CP.' %</th>';
		  echo '
			</tr>
			<tr>
			<th style="background-color:#a30000; width:40px;  color:#a30000;"></th>
			<th style="width:120px;padding-left: 20px;">=> Satisfactory  </th>';
		  echo '<th style="width:120px;padding-left: 20px;">Count: '.$DP.' %</th>';
		  echo '
			</tr>
			</table>';
		  }
        echo '</div>';
        ?>
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
	<!-- Slimscroll -->
	<script src=" <?=base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<!--Charts-->
	<script src=" <?=base_url();?>plugins/chartjs/Chart.min.js"></script>
	<!-- FastClick -->
	<script src=" <?=base_url();?>plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src=" <?=base_url();?>dist/js/app.min.js"></script>
<script>
	var pieChartCanvas = $("#pieChart1").get(0).getContext("2d");
	var pieChart = new Chart(pieChartCanvas);
	var PieData = [
	  {
		value: <?php echo $A; ?>,
		color: "Green",
		highlight: "#329932",
		label: "Excellent"
	  },
	  {
		value: <?php echo $B; ?>,
		color: "#1e5b99",
		highlight: "#3399ff",
		label: "Very Good"
	  },
	  {
		value: <?php echo $C; ?>,
		color: "#f39c12",
		highlight: "#e5c062",
		label: "Good"
	  },
	  {
		value: <?php echo $D; ?>,
		color: "#a30000",
		highlight: "#db4c4c",
		label: "Satisfactory"
	  }
	];
    var pieOptions = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke: true,
      //String - The colour of each segment stroke
      segmentStrokeColor: "#fff",
      //Number - The width of each segment stroke
      segmentStrokeWidth: 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps: 100,
      //String - Animation easing effect
      animationEasing: "easeOutBounce",
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate: true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale: false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive: true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio: true,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
	$(document).ready(function(){
		$(".treeview").removeClass('active');
		$(".treeview").eq(0).addClass('active');
	});
</script>
  <script type="text/javascript">
    $(document).ready(function(){
      $("#final").on('click',function(){
       window.location.href = "<?=base_url();?>index.php/PieChart?value="+$("#faculty_select").val()+$("#class_select").val()+$("#div_select").val();
      });
	  $("#faculty_select").on('change',function(){
      $.ajax({
        url:"<?=base_url();?>/index.php/ctrl_admin/getc/"+$("#faculty_select").val(),
        type:"POST",
        async: false,
        success:function(result){
          if(result != '0'){
            $("#class_select").html("<option value=\"0\">Select Class</option>"+result);
          }
          else{
            alert("Faculty Doesn't Teach to any class");
          }
        }
      });
    });
    $("#class_select").on('change',function() {
      $.ajax({
        url:"<?=base_url();?>/index.php/ctrl_admin/getdiv/"+$("#faculty_select").val()+"/"+$("#class_select").val(),
        type:"POST",
        async: false,
        success:function(result){
          if(result != '0'){
            $("#div_select").html("<option value=\"0\">Select Division</option>"+result);
          }
          else{
            alert("Faculty Doesn't Teach to any class");
          }
        }
      });
    });
    });
  </script>
  </body>
</html>
