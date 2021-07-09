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
  <title>Sakec Feedback | Mailbox</title>
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
  <style>

</style>
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
		  <?php
		  if(empty($this->input->get('value')) or $this->input->get('value') == "theory"){
			  $ques = "Question";
			  $type = "Theory";
			  $flag = "";
		  }elseif($this->input->get('value') == "practical"){
			  $ques = "Question_PR";
			  $type = "Practicals";
			  $flag = "1";
		  }else{
			  echo "<h4 style='color:red;'>Error: Invalid Request</h4>";
			  $type = "";
		  }
		  ?>
		  <select name="thpr" id="thpr_select" style="width: 100px;height:32px;">
              <option <?php if($type=="Theory"){echo "selected='selected'";} ?> value="theory">Theory</option>
              <option <?php if($type=="Practicals"){echo "selected='selected'";} ?>value="practical">Practical</option>
            </select>
			<a class="btn btn-primary" id="final">Get results</a>
			<a class="btn btn-danger" href="./Ctrl_faculty_chart">Bar Chart</a>
			<a class="btn btn-danger" id="areaimp" style="float: right;">Areas of Improvement</a>
			</div>
			</div>
			<br>
		<div class="td" style="float: center;">
		  
			<table align= "center"  style="float: center;"> 
			<th style="background-color:green; width:40px; color:green;"></th>
			<th style="width:120px;padding-left: 20px;">=> Excellent</th>
			<th style="background-color:#1e5b99; width:40px; color:#1e5b99;"></th>
			<th style="width:120px;padding-left: 20px;">=> Very Good</th>
			<th style="background-color:#f39c12; width:40px; color:#f39c12;"></th>
			<th style="width:120px;padding-left: 20px;">=> Good</th>
			<th style="background-color:#a30000; width:40px;  color:#a30000;"></th>
			<th style="width:120px;padding-left: 20px;">=> Satisfactory</th>
			</table>
		
		</div>
			<br>
				
		  <br>
		  
		  <?php
		  echo '<div class="row">';
            echo '<div class="col-xs-6">';
		  echo "<h4><b>$type Feedback Summary-</b></h4>";
		  echo '</div>';
		   echo '<div class="col-xs-6">';
		  echo '<div style="float: right; font-size: 20px;"><b><u>For year - </b>'.$year['year'].'-'.$year['year2'].' [<b>'.$year['type'].'</b>]</u></div>';
		   echo '</div>';
            echo '</div>';
          for($i=0;$i<(count($$ques));$i=$i+2)
          {
            echo '<div class="row">';
            echo '<div class="col-xs-6">';

                echo '<div class="box box-danger">';
                echo '<div class="box-header with-border">';
                echo '<h3 class="box-title col-xs-11">'.$$ques[$i]->Qid.' '.$$ques[$i]->Ques.'</h3>';

              echo '<div class="box-tools pull-right">';
                echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>';
                echo '</button>';
              echo '</div>';
            echo '</div>';
            echo '<div class="box-body">';
              echo '<canvas id="pieChart'.$i.'" style="height:250px"></canvas>';
            echo '</div>';

          echo '</div>';

          echo '</div>';


        echo '<div class="col-xs-6">';

                echo '<div class="box box-danger">';
                echo '<div class="box-header with-border">';
                echo '<h3 class="box-title col-xs-11">'.$$ques[$i+1]->Qid.' '.$$ques[$i+1]->Ques.'</h3>';

              echo '<div class="box-tools pull-right">';
                echo '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>';
                echo '</button>';
              echo '</div>';
            echo '</div>';
            echo '<div class="box-body">';
              $a =$i+1;
              echo '<canvas id="pieChart'.$a.'" style="height:250px"></canvas>';
            echo '</div>';

          echo '</div>';

          echo '</div>';
        echo '</div>';
         }
        ?>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">Updated Dec,2018.
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="http://www.shahandanchor.com">SAKEC(IT dept)</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src=" <?=base_url();?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
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

</script>
<script type="text/javascript">
  $(function() {
<?php
   for($i=0;$i<(count($$ques));$i++)
   {
       $q = $i+1;
    echo 'var pieChartCanvas = $("#pieChart'.$i.'").get(0).getContext("2d");
    pieChart = new Chart(pieChartCanvas);
    var PieData = [
      {
        value: "'.${"A".$flag.$q}["0"]->res.'",
        color: "Green",
		highlight: "#329932",
        label: "'.$$ques[$i]->opt_a.'"
      },
      {
        value: "'.${"B".$flag.$q}["0"]->res.'",
        color: "#1e5b99",
		highlight: "#3399ff",
        label: "'.$$ques[$i]->opt_b.'"
      },
      {
        value: "'.${"C".$flag.$q}["0"]->res.'",
       color: "#f39c12",
		highlight: "#e5c062",
        label: "'.$$ques[$i]->opt_c.'"
      },
      {
        value: "'.${"D".$flag.$q}["0"]->res.'",
        color: "#a30000",
		highlight: "#db4c4c",
        label: "'.$$ques[$i]->opt_d.'"
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
    pieChart.Doughnut(PieData, pieOptions);';
   }
?>
  });
</script>
<script>
$(document).ready(function(){
	$(".treeview").removeClass('active');
	$(".treeview").eq(0).addClass('active');
	$("#areaimp").on('click',function(){
        window.location.href = "<?=base_url();?>index.php/AreaOfImprovement";
    });
	$("#final").on('click',function(){
        window.location.href = "<?=base_url();?>index.php/Ctrl_piechart?value="+$("#thpr_select").val();
    });
});
</script>
</body>
</html>
