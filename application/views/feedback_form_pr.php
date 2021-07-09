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
      <h1>
       Feedback Form - Practical
      </h1>
      <ol class="breadcrumb">
        <li><a href="welcome.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Feedback</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <?php
                  $sid=$_SESSION['user_id'];
                  $sem=$_SESSION['sem'];
                  $div=$_SESSION['divi'];
                  $batch=$_SESSION['batch'];

                    if ($counter==null) {
                      echo "Question No: ".$Question['0']->Qid ."<br/>" ;
                      echo "<b>".$Question['0']->Ques." ?</b> <br/>";
                    }
                    else{
                      if (($counter['0']->count1)>(count($Question)-1)) {
                        echo 'Thank you! Your feedback has already been submitted.';
                      }
                      else{
                        echo "Question No: ".$Question[$counter['0']->count1]->Qid ."<br/>" ;
                        echo "<b>".$Question[$counter['0']->count1]->Ques." ?</b> <br/>";
                      }
                    }
                ?>
            </h3>
                <br><br>
        <?php
            if ($counter==null) {
            echo '<b>A:</b> '.$Question['0']->opt_a."&nbsp;&nbsp;";
            echo '<b>B:</b> '.$Question['0']->opt_b."&nbsp;&nbsp;";
            echo '<b>C:</b> '.$Question['0']->opt_c."&nbsp;&nbsp;";
            echo '<b>D:</b> '.$Question['0']->opt_d."<br/>";
          }
          else{
            if (($counter['0']->count1)>(count($Question)-1)) {}
            else{
              echo '<b>A:</b> '.$Question[$counter['0']->count1]->opt_a."&nbsp;&nbsp;";
              echo '<b>B:</b> '.$Question[$counter['0']->count1]->opt_b."&nbsp;&nbsp;";
              echo '<b>C:</b> '.$Question[$counter['0']->count1]->opt_c."&nbsp;&nbsp;";
              echo '<b>D:</b> '.$Question[$counter['0']->count1]->opt_d."<br/>";
            }
          }
        $attr = array('class' => 'form-horizontal','method' => 'POST');
              echo form_open('ctrl_feedback_pr/insert_fb',$attr);
    ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">


          <!-- Horizontal Form -->
            <!-- /.box-header -->
            <!-- form start -->
    <?php
        if (($counter==null)|| !((($counter['0']->count1)>(count($Question)-1)))) {
        echo '<table class="table table-hover" >';
        echo '<div class="">';


               echo '<div class="nav" cellspacing=10px>';

               echo '<center><tr>';
               echo '<th >Sr.no</th>';
               echo '<th>Course</th>';
               echo '<th>Faculty</th>';
//               echo '<th>Theory/Practicals</th>';
               echo '<th colspan="4">Select option</th>';
               echo '</tr>';


            }

        $count = 0;
        if ($counter==null) {

                echo '<input type="hidden" name="sid" value='.$sid.'>';
                  echo '<input type="hidden" name="Qid" value='.$Question['0']->Qid.'>';
                  echo '<input type="hidden" name="counter" value="0">';


                $i=1;
                foreach ($loadmat as $row) {

                     echo '<input type="hidden" name="fid'.$i.'" value="'.$row->Fid.'">';

                if((($row->Prac==1)&&(($batch=='A' && $row->A==1) || ($batch=='B' && $row->B==1) || ($batch=='C' && $row->C==1) || ($batch=='D' && $row->D==1))))
                {

                    echo '<tr>';
                     echo '<td>'.$i.'</td>' ;
                     echo'<td>'.$row->course .'</td>';
                        echo'<td>'.$row->F_name .'</td>';
                        /*if($row->Theory==1 && ($row->Prac==1&&($batch=='A' && $row->A==1) || ($batch=='B' && $row->B==1) || ($batch=='C' && $row->C==1) || ($batch=='D' && $row->D==1)))
                        {
                            $text='Theory & Practical';
                        }
                        else if($row->Theory==1 && ($row->Prac==1&&($batch=='A' && $row->A!=1) || ($batch=='B' && $row->B!=1) || ($batch=='C' && $row->C!=1) || ($batch=='D' && $row->D!=1)))
                        {
                            $text='Theory';
                        }
                        else if($row->Theory==1 && $row->Prac==0)
                        {
                            $text='Theory';
                        }
                        else if($row->Theory==0 && $row->Prac==1)
                        {
                            $text='Practical';
                        }
                        echo'<td>'.$text .'</td>';*/


                     $count++;
                        echo '<td>A:<input type="radio" value = "A" name="r'.$count.'" required></td>';
                        echo '<td>B:<input type="radio" value = "B" name="r'.$count.'"required></td>';
                        echo '<td>C:<input type="radio" value = "C" name="r'.$count.'"required></td>';
                        echo '<td>D:<input type="radio" value = "D" name="r'.$count.'"required></td>';
                    echo '</tr>';
                    $i++;
                    }
                    }
                    echo '<input type="hidden" name="count" value='.$count.'/>';
                  }

            elseif ((($counter['0']->count1)>(count($Question)-1))) {}
            else{

                echo '<input type="hidden" name="sid" value='.$sid.'>';
                echo '<input type="hidden" name="Qid" value='.$Question[$counter['0']->count1]->Qid.'>';
                echo '<input type="hidden" name="counter" value='.$counter['0']->count1.'>';


                $i=1;

                foreach ($loadmat as $row) {

                    echo '<input type="hidden" name="fid'.$i.'" value="'.$row->Fid.'">';

                if((($row->Prac==1)&&($batch=='A' && $row->A==1) || ($batch=='B' && $row->B==1) || ($batch=='C' && $row->C==1) || ($batch=='D' && $row->D==1)))
                {

                    echo '<tr>';
                     echo '<td>'.$i.'</td>' ;
                     echo'<td>'.$row->course .'</td>';
                        echo'<td>'.$row->F_name .'</td>';
                       /* if($row->Theory==1 && ($row->Prac==1&&($batch=='A' && $row->A==1) || ($batch=='B' && $row->B==1) || ($batch=='C' && $row->C==1) || ($batch=='D' && $row->D==1)))
                        {
                            $text='Theory & Practical';
                        }
                        else if($row->Theory==1 && ($row->Prac==1&&($batch=='A' && $row->A!=1) || ($batch=='B' && $row->B!=1) || ($batch=='C' && $row->C!=1) || ($batch=='D' && $row->D!=1)))
                        {
                            $text='Theory';
                        }
                        else if($row->Theory==0 && $row->Prac==1)
                        {
                            $text='Practical';
                        }
                        echo'<td>'.$text .'</td>';*/


                     $count++;

                        echo '<td>A:<input type="radio" value = "A" name="r'.$count.'" required></td>';
                        echo '<td>B:<input type="radio" value = "B" name="r'.$count.'" required></td>';
                        echo '<td>C:<input type="radio" value = "C" name="r'.$count.'" required></td>';
                        echo '<td>D:<input type="radio" value = "D" name="r'.$count.'" required></td>';
                    echo '</tr>';
                    $i++;
                    }
                    }
                    echo '<input type="hidden" name="count" value='.$count.'/>';
                  }
            ?>



 </table>
           <?php
           if ($counter==null) {
            echo '<div class="box-footer">';
            echo '<input type="submit" value="Next>>" class="btn btn-info pull-right"  >';
            echo '</div>';
            echo '</center>';
           }
            elseif ((!(($counter['0']->count1)>(count($Question)-1)))) {
                echo '<div class="box-footer">';
                echo '<input type="submit" value="Next>>" class="btn btn-info pull-right"  >';
                echo '</div>';
                echo '</center>';
            }

            ?>
                </div>
              <!-- /.box-body -->

              <!-- /.box-footer -->
            </form>
                </div>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      <!-- /.row -->
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
<!-- FastClick -->
<script src=" <?=base_url();?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src=" <?=base_url();?>dist/js/app.min.js"></script>
<script>
$(document).ready(function(){
	$(".treeview").removeClass('active');
	$(".treeview").eq(4).addClass('active');
})
</script>

</body>
</html>
