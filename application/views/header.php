<header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>IT</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SAKEC</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
	
      <!-- Sidebar toggle button-->
      <a href="welcome.php" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
	   <div class="btn-group" style="margin:8px;">
	   <script>
	   function gohome(){
		   window.location.href = "<?=base_url();?>";
	   }
	   function backup(){
		   window.location.href = "<?=base_url();?>/index.php/ctrl_admin/takebackup/";
	   }
	   </script>
  <button class="btn btn-primary" type="button" onClick="gohome();">Home
  </button>
</div>
<?php
if($_SESSION["user_type"] == "admin"){
?>
	 <div class="btn-group" style="margin:8px;">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
    Select Action
    <span class="caret"></span>
  </button>
  <ul  class="dropdown-menu">
    <li><a href="<?=base_url();?>/index.php/ctrl_admin/table/" style="color: black;">Classwise Feedback</a></li>
    <li><a href="<?=base_url();?>index.php/PieChart" style="color: black;">Classwise Summary</a></li>
	<li><a href="<?=base_url();?>index.php/AreaOfImprovement2" style="color: black;">Areas of Improvement</a></li>
	<li><a href="<?=base_url();?>/index.php/ctrl_admin/performancefeedback/" style="color: black;">Feedback of Performance</a></li>
	<!-- <li><a href="<?=base_url();?>index.php/FacultyMail/" style="color: black;">Mail Faculty</a></li> -->
  </ul>

</div>
  <div class="btn-group" style="margin:8px;">
<button class="btn btn-primary" type="button" onClick="backup();">
    Backup Database
  </button>
</div>
<?php
}
?>
<div class="navbar-brand navbar-brand-centered" style="font-size:22px; font-weight: bold;">IT FEEDBACK SYSTEM</div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
		<!--name display-->
			<li>
			<p style="font-size: 18px; color:white; margin:12px;">Hello, <?=$_SESSION['fname']?> <?=$_SESSION['lname'];?></p></li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url();?>dist\img\avatar5.png" class="user-image" alt="User Image">
              <span class="hidden-xs"></span>
            </a>
            <ul class="dropdown-menu">
			
              <!-- User image -->
              <li class="user-header">
                <img src="<?=base_url();?>dist\img\avatar5.png" class="img-circle" alt="User Image">

                <p>
                <?=$_SESSION['fname'];?> <?=$_SESSION['lname'];?><br>
                  - <?=$_SESSION['user_type'];?>
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
			  
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">

                <div class="pull-right">
                  <a href="<?php echo base_url();?>index.php/Ctrl_feedback/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form -->

      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->

        <ul class="sidebar-menu">
        <li class="header" style=" font-size: 20px; color: white;"><p>MENU</p></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-envelope"></i>
            <span>Mailer</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu">
            <li ><a href="compose.php"><i class="fa fa-minus"></i> Compose</a></li>
            <li><a href="index.php"><i class="fa fa-minus"></i> Inbox</a></li>
            <li><a href="outbox.php"><i class="fa fa-minus"></i> Outbox</a></li>
            </ul>
          </li>

            <li class="treeview">
          <a href="#">
            <i class="fa fa-clipboard"></i>
            <span>Test</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-minus"></i>My records</a></li>
            <li><a href="#"><i class="fa fa-minus"></i> Upcoming test</a></li>
            </ul>
          </li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-book"></i>
            <span>Tutorials</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          </li>
            <li class="treeview">
          <a href="#" class="active">
            <i class="fa fa-briefcase"></i>
            <span>Placement</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>

          </li>
            <li class="treeview active">
          <a href="ctrl_feedback">
            <i class="fa fa-edit"></i>
            <span>Feedback</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
            <ul class="treeview-menu active">
            <li><a href="ctrl_feedback"><i class="fa fa-minus"></i> Theory</a></li>
            <li><a href="ctrl_feedback_pr"><i class="fa fa-minus"></i> Practical</a></li>
            <li><a href="review"><i class="fa fa-minus"></i>Review</a></li>
            </ul>
          </li>
            <li class="treeview">
          <a href="#">
            <i class="fa fa-gear"></i>
            <span>Settings</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
                <ul class="treeview-menu">
            <li><a href="<?=base_url();?>settings/index.php"><i class="fa fa-minus"></i>Personal</a></li>
            <li><a href="<?=base_url();?>settings/academic.php"><i class="fa fa-minus"></i>Academic</a></li>
            <li><a href="<?=base_url();?>settings/changepassword.php"><i class="fa fa-minus"></i>Change passsword</a></li>
            </ul>
          </li>
            <li class="treeview">
          <a href="Ctrl_feedback/logout">
            <i class="fa fa-sign-out"></i>
            <span>Logout</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          </li>
        </ul>
    <!-- /.sidebar -->
  </aside>
  <?php 


$username = "root";
$password = "";
$host = "localhost";
$dbname = "feedback";
$path = "/Applications/MAMP/htdocs/html/test123.sql";
$backup = exec('C:\xampp\mysql\bin\backup--user=' . $username . ' --password='. $password .' --host=' . $host . ' ' . $dbname . ' > ' . $path . '');

if (isset($_POST['backup'])) {

        if (file_exists($path)) {

            echo "Backup Success";
            echo "<br>";

        } else {

            echo "Backup failed!";
            echo "<br>";
            echo "Backup of " . $dbname . " does not exist in " . $path;

        }

}

if (isset($_POST['download'])) {

    if (file_exists($path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path)); //Whoops...Forgot to change variable!
    readfile($path); //Whoops...Forgot to change variable!
    exit;
} else {

    echo "File does not exist!";

}


}

?>
