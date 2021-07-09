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
            <select name="Faculty" id="faculty_select" style="display:none;">
              <option value="0">Select Faculty</option>
              <option value="<?=$_SESSION['user_id'];?>" selected="selected"><?=$_SESSION['fname'];?></option>
            </select>
            <select name="class" id="class_select" style="display:none;">
              <option value="0">Select Class</option>
            </select>
            <select name="divion" id="div_select" style="display:none;">
              <option value="0">Select Division</option>
            </select>
            <select name="subject" id="sub_select" style="display:none;">
              <option value="0">Select Subject</option>
            </select>
            <select name="thpr" id="thpr_select" style="display:none;">
              <option value="0">TH/PR</option>
              <option value="theory">Theory</option>
              <option value="practical">Practal</option>
            </select>
            <a class="btn btn-danger" href="./Ctrl_piechart?value=theory">Pie Chart</a>
			<a class="btn btn-danger" id="areaimp" style="float: right;">Areas of Improvement</a>
          </div>
        </div>
		<div class="row">
          <div class="col-xs-12">
            <span id="loading">Loading......</span>
          </div>
        </div>
        <h3 class="box-title col-xs-11">Feedback Response:</h3>
        <div class="row">
          <div class="col-xs-7 charts">
            <div class="box-body">
              <canvas style="height:500px"></canvas>
            </div>
            <br />
            <div class="text-center">
              <h2 id="chart-name"></h1>
              </div>
            </div>
            <div class="col-xs-7">
              <div class="" id="questions">
                <p style="font-size:16px">Questions List</p>
              </div>
            </div>
          </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.bundle.js"></script>
    <style>
    canvas {
      -moz-user-select: none;
      -webkit-user-select: none;
      -ms-user-select: none;
    }
    .ques {
      font-size: 20px;
      word-wrap: break-word;
    }
    </style>
    <script src=" <?=base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src=" <?=base_url();?>plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src=" <?=base_url();?>dist/js/app.min.js"></script>
    <script src="<?=base_url();?>plugins/printer/printThis.js" charset="utf-8"></script>
    <script>
    $(document).ready(function(){
	$(".treeview").removeClass('active');
    $(".treeview").eq(0).addClass('active');
	  $("#areaimp").on('click',function(){
        window.location.href = "<?=base_url();?>index.php/AreaOfImprovement";
    });
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getc/"+$("#faculty_select").val(),
          type:"POST",
          async: false,
          success:function(result){
            ////alert(result);
            if(result != '0'){
              $("#class_select").html(result);
            }
            else{
              alert("Faculty Doesn't Teach to any class");
            }
          }
        });
      $("#div_select").on('change',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/getsub/"+$("#faculty_select").val()+"/"+$("#class_select").val()+"/"+$("#div_select").val(),
          type:"POST",
          async: false,
          success:function(result){
            if(result != '0'){
              $("#sub_select").html(result);
            }
            else{
              alert("Faculty Doesn't Teach to any class");
            }
          }
        });
      });
      $("#sub_select").on('change',function(){
        $.ajax({
          url:"<?=base_url();?>/index.php/ctrl_admin/checkthpr/"+$("#faculty_select").val()+"/"+$("#class_select").val()+"/"+$("#div_select").val()+"/"+$("#sub_select").val(),
          type:"POST",
          async: false,
          success:function(result){
            if(result != '0'){
              $("#thpr_select").html(result);
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
              $("#div_select").html(result);
            }
            else{
              alert("Faculty Doesn't Teach to any class");
            }
          }
        });
      });
      var barChartData = {
        labels: [],
        datasets: [{
          label: 'Percentage',
          data: [],
          backgroundColor:'rgba(255, 159, 64, 1)'
        }]
      };
        $(".charts").empty();
        $(this).attr('selected', true);
        $(this).trigger("change");
		$("#loading").css("display", "none");
        $("#class_select > option").each(function(){
          //alert($(this).text());
          $(this).attr('selected', true);
          $(this).trigger("change");
          $("#div_select > option").each(function(){
            //alert($(this).text());
            $(this).attr('selected', true);
            $(this).trigger("change");
            $("#sub_select > option").each(function(){
              //alert($(this).text());
              $(this).attr('selected', true);
              $(this).trigger("change");
              $("#thpr_select > option").each(function(){
                //alert($(this).text());
                $(this).attr('selected', true);
                $(this).trigger("change");
                $(".charts").append('<div class="box-body"> <canvas style="height:500px"></canvas></div><br /><div class="text-center"><h2 class="chart-name"></h1></div><br /><br /><br /><br />');
                //alert($(".charts").html());
                barChartData = {
                  labels: [],
                  datasets: [{
                    label: 'Percentage',
                    data: [],
                    backgroundColor:'rgba(255, 159, 64, 1)'
                  }]
                };
                var ctx = $("canvas").last().get(0).getContext("2d");
                window.myBar = new Chart(ctx, {
                  type: 'bar',
                  data: barChartData,
                  options: {
                    scales: {
                      xAxes:[{
                        barThickness:50
                      }],
                      yAxes: [{
                        ticks: {
                          beginAtZero:true,
                          max:100,
                          stepSize:10
                        }
                      }]
                    }
                  }
                });
                var tmp = $("#class_select").val();
                if(tmp == '1' || tmp == '2') yr = "FE";
                if(tmp == '3' || tmp == '4') yr = "SE";
                if(tmp == '5' || tmp == '6') yr = "TE";
                if(tmp == '7' || tmp == '8') yr = "BE";
                if($("#thpr_select").val() == 1) str = "<?=base_url();?>/index.php/ctrl_admin/gendatath/"+$("#faculty_select").val()+"/"+$("#class_select").val()+"/"+$("#div_select").val()+"/"+$("#sub_select").val();
                if($("#thpr_select").val() == 2) str = "<?=base_url();?>/index.php/ctrl_admin/gendatapr/"+$("#faculty_select").val()+"/"+$("#class_select").val()+"/"+$("#div_select").val()+"/"+$("#sub_select").val();
                $.ajax({
                  url:str,
                  type:"POST",
                  async: false,
                  success:function(result){
                    if(result != '0'){
                      var json = jQuery.parseJSON(result);
                      var count = [];
                      var data = [];
                      for(key in json){
                        data.push(json[key]);
                        count.push(key.toString());
                      }
                      barChartData.labels = count;
                      barChartData.datasets[0].data = data;
                      barChartData.datasets[0].label = $("#faculty_select option:selected").text();
                      window.myBar.update();
                      $(".chart-name").last().html(yr+"-"+$("#div_select").val()+" "+$("#sub_select").val()+" "+$("#thpr_select option:selected").text());
                      str=undefined;
                    }
                    else{
                      alert("Faculty Doesn't Teach to any class");
                    }
                  }
                });
              });
            });
          });
        });
        str = "<?=base_url();?>/index.php/ctrl_admin/getq";
        $("#questions").empty();
        $.ajax({
          url:str,
          type:"POST",
          async: false,
          success:function(result){
            if(result != '0'){
              $("#questions").append("<p style=\"font-size:16px\">Questions List(Theory)</p>"+result);
              url=undefined;
            }
            else{
              alert("Faculty Doesn't Teach to any class");
            }
          }
        });
        str = "<?=base_url();?>/index.php/ctrl_admin/getq_pr";
        $.ajax({
          url:str,
          type:"POST",
          async: false,
          success:function(result){
            if(result != '0'){
              $("#questions").append("<p style=\"font-size:16px\">Questions List(Practical)</p>"+result);
              url=undefined;
            }
            else{
              alert("Faculty Doesn't Teach to any class");
            }
          }
        });
    })
    </script>

  </body>
  </html>
