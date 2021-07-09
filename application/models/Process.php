<?php
class Process extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	function getOnlyTheoryStaff(){
		$sql = "Select DISTINCT Fid from load_mat where Theory=1";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getTheoryStaff($sem,$div){
		$sql = "Select * from load_mat where sem='$sem' AND divi='$div' AND Theory=1";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getPracticalStaff($sem,$div){
		$sql = "Select * from load_mat where sem='$sem' AND divi='$div' AND prac=1";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getcourse()
	{
		$query = $this->db->query('select Cname from list_of_course;');
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}
	function getques($tbl){
		$sql = "select * from $tbl";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getclist($fname){
		$sql = "Select DISTINCT sem from load_mat where Fid='$fname'";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getsublist($fname,$sem,$div){
		$sql = "Select DISTINCT course from load_mat where Fid='$fname' AND sem='$sem' AND divi='$div'";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function checkthpr($fname,$sem,$div,$course){
		$sql = "Select * from load_mat where Fid='$fname' AND sem='$sem' AND divi='$div' AND course='$course'";
		$res = $this->db->query($sql);
		if ($res->num_rows()>0){
			foreach ($res->result() as $row) {
				if($row->Theory == 1) echo "<option value=\"1\">Theory</option>";
				if($row->Prac == 1) echo "<option value=\"2\">Practical</option>";
			}
		}
	}
	function gendatath($fname,$sem,$div,$course){
		$sql = "select *,count(ans_opt) as benchmark from admin_disp where Fid='$fname' AND sem='$sem' AND admin_disp.div='$div' group by ans_opt,Question_id";
		$res = $this->db->query($sql);
		$const = array('A' => 4, 'B' => 3, 'C' => 2, 'D' => 1);
		$data = array();
		$count = array();
		foreach ($res->result() as $row) {
			$data[$row->Question_id] +=$row->benchmark*$const[$row->ans_opt];
			$count[$row->Question_id] += $row->benchmark;
		}
		foreach ($data as $key => $value) {
			$data[$key] = number_format((float)($data[$key] * 100)/($count[$key]*4), 2);
		}
		return $data;
	}
	function genDataThAvg($fname){
		$sql = "select *,count(ans_opt) as benchmark from feedback_th where Fid='$fname' group by ans_opt";
		$res = $this->db->query($sql);
		$const = array('A' => 4, 'B' => 3, 'C' => 2, 'D' => 1);
		$total = 0;
		$count = 0;
		foreach ($res->result() as $id => $row) {
			$total += $row->benchmark*$const[$row->Ans_opt];
			$count += $row->benchmark;
		}
		$totalavg = ($total * 100)/($count*4);
		return $totalavg;
	}
	function gendatapr($fname,$sem,$div,$course){
		$sql = "select *,count(ans_opt) as benchmark from admin_disp_pr where Fid='$fname' AND sem='$sem' AND admin_disp_pr.div='$div' group by ans_opt,Question_id";
		$res = $this->db->query($sql);
		$const = array('A' => 4, 'B' => 3, 'C' => 2, 'D' => 1);
		$data = array();
		$count = array();
		foreach ($res->result() as $row) {
			$data[$row->Question_id] +=$row->benchmark*$const[$row->ans_opt];
			$count[$row->Question_id] += $row->benchmark;
		}
		foreach ($data as $key => $value) {
			$data[$key] = number_format((float)($data[$key] * 100)/($count[$key]*4), 2);
		}
		return $data;
	}
	function getsemdivlist($fid){
		$sql = "Select * from load_mat where divi IN (Select DISTINCT divi from load_mat where Fid='$fid') AND Fid='$fid'";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function issemdivflag($fid,$sem,$div,$course,$flag="Theory"){
		$sql = "Select $flag from load_mat where sem=$sem and divi=$div and Fid='$fid' and course='$course'";
		$res = $this->db->query($sql);
		return $res->result()[0]->$flag;
	}
	function getdivlist($fname,$sem){
		$sql = "Select DISTINCT divi from load_mat where Fid='$fname' AND sem='$sem'";
		$res = $this->db->query($sql);
		return $res->result();
	}
	function getsemyear(){
		$data = [];
		$sql = "Select substr(Timestamp,1,4) as year from feedback_th where User_typ='IT' LIMIT 1";
		$res = $this->db->query($sql);
		$data['year'] = $res->result()[0]->year;
		$sql = "Select substr(Timestamp,6,7) as month from feedback_th where User_typ='IT' LIMIT 1";
		$res = $this->db->query($sql);
		$month = $res->result()[0]->month;
		if($month >= 1 and $month <= 6){
			$type = 'EVEN';
			$data['year'] = $data['year']-1;
			$data['year2'] = $data['year']+1;
		}	
		if($month > 6 and $month <= 12){
			$type = 'ODD'; 
			$data['year2'] = $data['year']+1;
		}	
		$data['type'] = $type;
		return $data;
	}
	function getfaculty()
	{
		$query = $this->db->query('SELECT * FROM `load_mat` GROUP BY Fid');
		if ($query->num_rows()>0) {
			$res = $query->result();
			$result = [];
			foreach($res as $id => $data){
				$result[$id] = ['Fid' => $data->Fid, 'F_Name' => $data->F_name];
			}
			ksort($result);
			return $result;
		}
		else
		{
			return null;
		}

	}

	function getfacultyid($fname)
	{
		$query = $this->db->query('SELECT Fid FROM load_mat where F_Name="'.$fname.'";');
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}

	}

	function updateLoadMat1($post,$fid)
	{

		$no=$post['numrow'];

		for($i=1;$i<=$no;$i++)
		{
			$fname=$post['F_name'];

			$tmp="sem".$i;
			$sem = $post[$tmp];

			$tmp="divi".$i;
			$divi=$post[$tmp];

			$tmp="course".$i;
			$course=$post[$tmp];

			$tmp="chkbx_theory".$i;
			if(isset($post[$tmp]))
			{
				$th=1;
			}
			elseif (!isset($post[$tmp])) {
				$th=0;
			}

			$tmp="chkbx_pracs".$i;
			if(isset($post[$tmp]))
			{
				$pr=1;
				$tmp="chkbx_ba".$i;
				if(isset($post[$tmp]))
				{
					$a=1;
				}
				elseif (!isset($post[$tmp])) {
					$a=0;
				}

				$tmp="chkbx_bb".$i;
				if(isset($post[$tmp]))
				{
					$b=1;
				}
				elseif (!isset($post[$tmp])) {
					$b=0;
				}

				$tmp="chkbx_bc".$i;
				if(isset($post[$tmp]))
				{
					$c=1;
				}
				elseif (!isset($post[$tmp])) {
					$c=0;
				}

				$tmp="chkbx_bd".$i;
				if(isset($post[$tmp]))
				{
					$d=1;
				}
				elseif (!isset($post[$tmp])) {
					$d=0;
				}
			}
			elseif (!isset($post[$tmp])) {
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
				if ($pr==1) {



					$data = array('Fid' => $fid,'F_name' => $fname , 'sem'=>$sem , 'Divi'=> $divi , 'course'=>$course , 'Theory'=>$th , 'Prac'=>$pr , 'A'=>$a , 'B'=>$b , 'C'=>$c , 'D'=>$d);
					$sql=$this->db->insert('load_mat', $data);
					$errnum=$i+1;
					if (!$sql) {
						die("Couldn't Insert row number:".$errnum);
					}
					$message = "Table Upadated!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else
				{
					$data = array('Fid' => $fid,'F_name' => $fname , 'sem'=>$sem , 'Divi'=> $divi , 'course'=>$course , 'Theory'=>$th , 'Prac'=>$pr);
					$sql=$this->db->insert('load_mat', $data);
					$errnum=$i+1;
					if (!$sql) {
						die("Couldn't Insert row number:".$errnum);
					}
					$message = "Table Upadated!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}

		}


	}


	function fetch_question()
	{
		$query = $this->db->query("SELECT * FROM questions_th order by Qid");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}

	}

	function fetch_question_pr()
	{
		$query = $this->db->query("SELECT * FROM questions_pr order by Qid");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}

	}
	
	function getelective($sid){
		$query = $this->db->query("SELECT th_batch FROM list_of_student where Sid='$sid'");
		if ($query->num_rows()>0) {
			return $query->result()[0]->th_batch;
		}
		else
		{
			return null;
		}
	}
	
	function getdeptelective($sid){
		$query = $this->db->query("SELECT th_batch FROM list_of_student where Sid='$sid'");
		if ($query->num_rows()>0) {
			return $query->result()[0]->th_batch;
		}
		else
		{
			return null;
		}
	}

	function fetch_loadmat_th($e)
	{
		$query = $this->db->query("SELECT * FROM load_mat where Sem=".$_SESSION['sem']." AND Divi=".$_SESSION['divi']." and (E='0' or E='$e') and Theory='1';");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}

	}
	
	function fetch_loadmat_pr()
	{
		$query = $this->db->query("SELECT * FROM load_mat where Sem=".$_SESSION['sem']." AND Divi=".$_SESSION['divi']." AND Prac='1';");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}

	}
	
	function fetch_elective($e){
		$query = $this->db->query("SELECT * FROM load_mat where Sem=".$_SESSION['sem']." AND Divi=".$_SESSION['divi']." and E='$e'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}

	function insert_loadmat($post)
	{
		$val = $this->db->query('select Sid from counter_th where Sid="'.$post['sid'].'"');
		if ($val->num_rows()==0) {
			$data = array('Sid' => $post['sid'] , 'count1' => 1 );
			$this->db->insert('counter_th',$data);
		}
		for($i=1;$i<=$post['count'];$i++)
		{
			$a='fid'.$i;
			$fid=$post[$a];
			$radio = 'r'.$i;
			$data = array('Sid' => $post['sid'],'Fid' => $fid,'Question_id' => $post['Qid'],'Ans_opt' => $post[$radio] ,'User_typ' => 'IT');
			$this->db->insert('feedback_th', $data);
		}
		$sql = "UPDATE `counter_th` SET count1='".$post['Qid']."' WHERE sid='".$post['sid']."'";
		$this->db->query($sql);
	}

	function insert_loadmat_pr($post)
	{
		$val = $this->db->query('select Sid from counter_pr where Sid="'.$post['sid'].'"');
		if ($val->num_rows()==0) {
			$data = array('Sid' => $post['sid'] , 'count1' => 1 );
			$this->db->insert('counter_pr',$data);
		}
		for($i=1;$i<=$post['count'];$i++)
		{
			$a='fid'.$i;
			$fid=$post[$a];
			$radio = 'r'.$i;
			$data = array('Sid' => $post['sid'],'Fid' => $fid,'Question_id' => $post['Qid'],'Ans_opt' => $post[$radio] ,'User_typ' => 'IT');
			$this->db->insert('feedback_pr', $data);
		}
		$sql = "UPDATE `counter_pr` SET count1='".$post['Qid']."' WHERE sid='".$post['sid']."'";
		$this->db->query($sql);
	}

	function check_q($sid)
	{
		$query = $this->db->query("SELECT count1 FROM counter_th where Sid='".$sid."';");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}

	function check_q_pr($sid)
	{
		$query = $this->db->query("SELECT count1 FROM counter_pr where Sid='".$sid."';");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}

	function chk_login($post)
	{
		$logintype=$post['per'];
		if ($logintype=="student") {
			$userid="Sid";
			$pwd="password";
			$tbl_name="list_of_student"; // Table name
		}
		else if ($logintype=="faculty") {
			$userid="Fid";
			$pwd="Fid";
			$tbl_name="load_mat"; // Table name
		}
		else if ($logintype=="admin") {
			$userid="UserId";
			$pwd="Apwd";
			$tbl_name="admin"; // Table name
		}
		// Define $myusername and $mypassword
		$myusername=$post['username'];
		$mypassword=$post['password'];

		// To protect MySQL injection (more detail about MySQL injection)
		$myusername = stripslashes($myusername);
		$mypassword = stripslashes($mypassword);


		$query = $this->db->query("SELECT * FROM $tbl_name WHERE ".$userid."='$myusername' and ".$pwd."='$mypassword'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}

	function getChartValues($fid,$opt,$qid)
	{
		$query = $this->db->query("select count(*) as res,Sid from feedback_th where Question_id=".$qid." and Ans_opt='".$opt."' and Fid='".$fid."'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}
	
	function getChartValues2($fid,$sem,$div,$opt)
	{
		$total = 0;
		$str = $div."0".$sem;
		$query = $this->db->query("select count(*) as res,Sid from feedback_th where Ans_opt='".$opt."' and Fid='".$fid."' and substr(Sid,5,3)='$str'");
		if ($query->num_rows()>0) {
			$total += $query->result()[0]->res;
		}
		$query = $this->db->query("select count(*) as res,Sid from feedback_pr where Ans_opt='".$opt."' and Fid='".$fid."' and substr(Sid,5,3)='$str'");
		if ($query->num_rows()>0) {
			$total += $query->result()[0]->res;
		}
		return $total;
	}
	
	function getChartValues3($fid,$opt,$qid)
	{
		$query = $this->db->query("select count(*) as res,Sid from feedback_pr where Question_id=".$qid." and Ans_opt='".$opt."' and Fid='".$fid."'");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}
	
	function getNumberOfStudentsTh($sem,$div)
	{
		$str = $div."0".$sem;
		$query = $this->db->query("select count(DISTINCT Sid) as res from feedback_th where substr(Sid,5,3)='$str'");
		if ($query->num_rows()>0) {
			return $query->result()[0]->res;
		}else{
			return null;
		}
	}
	
	function getNumberOfStudentsPr($sem,$div)
	{
		$str = $div."0".$sem;
		$query = $this->db->query("select count(DISTINCT Sid) as res from feedback_pr where substr(Sid,5,3)='$str'");
		if ($query->num_rows()>0) {
			return $query->result()[0]->res;
		}else{
			return null;
		}
	}

	function getFid()
	{
		$query = $this->db->query("Select DISTINCT Fid from feedback_th");
		if ($query->num_rows()>0) {
			return $query->result();
		}
		else
		{
			return null;
		}
	}
	
	function getIdFname()
	{
		$query = $this->db->query("Select DISTINCT Fid, F_name from load_mat");
		if ($query->num_rows()>0) {
			$old = $query->result();
			$new = [];
			foreach($old as $id => $class){
				$new[$class->Fid] = $class->F_name;
			}
			return $new;
		}
		else
		{
			return null;
		}
	}

	function genTable($data,$fid)
	{
		foreach($data as $d)
		{
			//echo $d->Fid;

		}
		//$d = array('Fid' => $fid,'Question_id' => $post['Qid'],'Ans_opt' => $post[$radio] ,'User_typ' => 'IT');
		//$this->db->insert('feedback_pr', $data);
	}

}





?>
