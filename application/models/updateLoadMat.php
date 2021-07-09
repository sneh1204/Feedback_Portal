<?php
	$host="localhost"; // Host name 
		$username="root"; // Mysql username 
		$password=""; // Mysql password 
		$db_name="sakecfeedback"; // Database name 
		$no=0;
		$sem=0;$th=0;$pr=0;
		$i=0;$a=0;$b=0;$c=0;$d=0;
		$link = mysql_connect($host, $username, $password)or die("cannot connect"); 
		mysql_select_db($db_name, $link)or die("cannot select DB");
	
		$no=$_POST['numrow'];
	
		for($i=1;$i<=$no;$i++)
		{
			$fid=$_POST['fid'];
			$fname=$_POST['F_name'];
			
			$tmp="sem".$i;
			$sem = $_POST[$tmp];
	
			$tmp="divi".$i;
			$divi=$_POST[$tmp];
	
			$tmp="course".$i;
			$course=$_POST[$tmp];
	
			$tmp="chkbx_theory".$i;
			if(isset($_POST[$tmp]))
			{
				$th=1;
			}
			elseif (!isset($_POST[$tmp])) {
				$th=0;
			}
	
			$tmp="chkbx_pracs".$i;
			if(isset($_POST[$tmp]))
			{
				$pr=1;
				$tmp="chkbx_ba".$i;
				if(isset($_POST[$tmp]))
				{
					$a=1;
				}
				elseif (!isset($_POST[$tmp])) {
					$a=0;
				}
	
				$tmp="chkbx_bb".$i;
				if(isset($_POST[$tmp]))
				{
					$b=1;
				}
				elseif (!isset($_POST[$tmp])) {
					$b=0;
				}
	
				$tmp="chkbx_bc".$i;
				if(isset($_POST[$tmp]))
				{
					$c=1;
				}
				elseif (!isset($_POST[$tmp])) {
					$c=0;
				}
	
				$tmp="chkbx_bd".$i;
				if(isset($_POST[$tmp]))
				{
					$d=1;
				}
				elseif (!isset($_POST[$tmp])) {
					$d=0;
				}
			}
			elseif (!isset($_POST[$tmp])) {
				$pr=0;
			}
	
			if($th==0 && $pr==0)
			{
				$message = "Either theory or practical are compulsory!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='application/views/loadmatrix_input.php';</script>";
			}
	
			elseif ($pr==1 && $a==0 && $b==0 && $c==0 && $d==0) {
				$message = "Atleast one batch must be selected";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='application/views/loadmatrix_input.php';</script>";
			}
			else
			{
				$sql="INSERT INTO load_mat(`Fid`, `F_name`, `Sem`, `Divi`, `course`, `Theory`, `Prac`, `A`, `B`, `C`, `D`) VALUES ('".$fid."','".$fname."',".$sem.",".$divi.",'".$course."',".$th.",".$pr.",".$a.",".$b.",".$c.",".$d.");";
				$result=mysql_query($sql);
				$errnum=$i+1;
				if (!$result) {
					die("Couldn't Insert row number:".$errnum);
				}
			}
	
	
		
	
	}
			/*$message = "Table Updated!";
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='loadmatrix_input.php';</script>";*/
		
		
?>