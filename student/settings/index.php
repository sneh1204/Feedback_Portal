<?php
include'../../config.php';
require_once'session.php';
$reg_id=$_SESSION['login_user'];
$sql=mysql_query("select * from student_details where reg_id='$reg_id'");
while ($b=mysql_fetch_array($sql)) {
	$stname=$b['stname'];
    $faname=$b['faname'];
    $moname=$b['moname'];
    $reg_id=$b['reg_id'];
    $smart_card=$b['smart_card'];
    $dob=$b['dob'];
    $st_mobile=$b['st_mobile'];
    $pa_mobile=$b['pa_mobile'];
    $r_number=$b['r_number'];
    $branch=$b['branch'];
    $division=$b['division'];
    $stemailid=$b['stemailid'];
    $paemailid=$b['paemailid'];
    $gender=$b['gender'];
}
if(isset($_POST['update']))
{
	$stname=$_POST['stname'];
        $faname=$_POST['faname'];
        $moname=$_POST['moname'];
        $reg_id=$_POST['reg_id'];
        $smart_card=$_POST['smart_card'];
        $dob=$_POST['dob'];
        $st_mobile=$_POST['st_mobile'];
        $pa_mobile=$_POST['pa_mobile'];
        $r_number=$_POST['r_number'];
        $division=$_POST['division'];
        $branch=$_POST['branch'];
        $stemailid=$_POST['stemailid'];
        $paemailid=$_POST['paemailid'];
        $gender=$_POST['gender'];
        $sql=mysql_query("select * from student_details where reg_id='$reg_id'");
	    $count=mysql_num_rows($sql);
	    if($count==1)
        {
        mysql_query("update student_details set stname='$stname',faname='$faname',moname='$moname',smart_card='$smart_card',dob='$dob',st_mobile='$st_mobile',pa_mobile='$pa_mobile',r_number='$r_number',division='$division',branch='$branch',emailid='$emailid',gender='$gender' where reg_id='$reg_id' ");
        }
    
}






?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sakec Settings | Profile</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../icon/fontawesome/css/font-awesome.css">
  <!-- Ionicons -->
    <link rel="stylesheet" href="../../icon/ionicon/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href=" ../../dist/css/skins/_all-skins.min.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php include('header.php') ?>
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <section class="content">
      <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h1 class="box-title">Profile</h1>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" action="" >
              <div class="box-body">
              	<div class="col-md-6">
				 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Student name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" placeholder="Student name" name="stname" value="<?php echo $stname ?>">
                  </div>
                 </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Fathers name</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Fathers name" name="faname" value="<?php echo $faname ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Mothers name</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Mothers name" name="moname" value="<?php echo $moname ?>">
                  </div>
                </div>    
              	<div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Date of Birth</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Date of birth" name="dob" value="<?php echo $dob ?>">
                  </div>
                </div> 	
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student Contact</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Students mobile" name="st_mobile"value="<?php echo $st_mobile ?>">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Parent's Contact</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="parents mobile" name="pa_mobile"value="<?php echo $pa_mobile ?>">
                  </div>
                </div>    
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Student's Emailid</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Emailid" name="stemailid" value="<?php echo $stemailid ?>">
                  </div>
                </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Parent's Emailid</label>
                  <div class="col-sm-9">
                     <input type="text" class="form-control" id="inputEmail3" placeholder="Emailid" name="paemailid" value="<?php echo $paemailid ?>">
                  </div>
                </div>
              	</div>
                  
                  
                  
                <div class="col-md-6">
                	<div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Registration id</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Registration id" name="reg_id" value="<?php echo $reg_id ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Smartcard Number</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Smartcard Number" name="smart_card" value="<?php echo $smart_card ?>" readonly>
                  </div>
                </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Branch</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Branch" name="branch" value="<?php echo $branch ?>"readonly>
                  </div>
                </div>
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Division</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Division"name="division" value="<?php echo $division ?>" readonly>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Roll number</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Roll number" name="r_number" value="<?php echo $r_number ?>"readonly>
                  </div>
                </div>    
                    <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Gender</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="inputPassword3" placeholder="Gender" name="gender" value="<?php echo $gender ?>"readonly>
                  </div>
                </div>
                </div>

              </div>
     
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="submit" class="btn btn-info pull-right" name="update" id="update" value="Update">
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
	</div>
	
    </section>
      
    </section>
  <div class="modal">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Message</h4>
              </div>
              <div class="modal-body">
                <p><?php echo $stname ?>  your profile has been updated </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" id="close" data-dismiss="modal">Close</button>
                
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
      
      
      
      
      
      
      
      
      
      
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">Updated Dec,2018.
      <b>Version</b> 2.3.3
    </div>
    <strong>Copyright &copy; 2015-2016 <a href="http://www.shahandanchor.com">Shah And Anchor</a>.</strong> All rights
    reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<script src=" ../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src=" ../../bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<script src=" ../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src=" ../../plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src=" ../../dist/js/app.min.js"></script>
<script>
$(document).ready(function(){
	$(".treeview").removeClass('active');
	$(".treeview").eq(5).addClass('active');
})  
</script>

</body>
</html>
