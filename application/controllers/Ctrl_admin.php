<?php 
require 'vendor\autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ctrl_admin extends CI_Controller {

    function __construct() {
		parent::__construct();
		if(!isset($_SESSION['user_id'])){
			redirect(base_url());
		}
	}
	public function getyear(int $sem){
		if($sem % 2 == 0)	$i = $sem;
		else $i = ++$sem;
		$yr = array(2 => 'FE', 4 => 'SE', 6 => 'TE', 8 => 'BE');
		echo $yr[$i];
    }
    public function getalldiv($sem){
      $res = $this->db->query("Select Distinct divi from load_mat where sem='$sem'");
      $res = $res->result();
      foreach ($res as $key => $value) {
        echo "<option value=\"".$value->divi."\">".$value->divi."</option>";
      }
    }
    public function admin2(){
		if($this->session->userdata('user_type') == "admin"){
		  $this->load->model('process');
		  $data['facl_list'] = $this->process->getfaculty();
		  $this->load->view('admin_panel2',$data);
		}else{
			$this->load->view('error', $aid);
		}
    }
	public function getchartvalues($fid,$sem,$div){
		$this->load->model('process');
		$list = [1 => 'A', 2 => 'B', 3 => 'C', 4 => 'D'];
		$opt = [];
		for($i = 1; $i <= 4; $i++){
			$opt[$list[$i]] = $this->process->getChartValues2($fid,$sem,$div,$list[$i]);
		}
		echo json_encode($opt);
	}
	public function escapeHtml($string){
		return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
	public function insertcomment(){
		$comment = $_POST['comment'];
		$this->load->model("ctable");
		if(!$this->ctable->hasresponded($this->session->userdata('user_id'))){
			$this->ctable->insertcomment($this->session->userdata('user_id'), $comment);
		}else{
			$this->ctable->updatecomment($this->session->userdata('user_id'), $comment);
		}
		echo $this->escapeHtml($comment);
	}
	public function getcomment($id=0,$type="null"){
		$this->load->model("ctable");
		if($type=="null") $comment= $this->escapeHtml($this->ctable->getcomment($id)[0]->comment);
		if($type=="edit") $comment= $this->ctable->getcomment($id)[0]->comment;
		echo $comment;
	}
	public function hascommented(){
		$this->load->model("ctable");
		if($this->ctable->hasresponded($this->session->userdata('user_id'))){
			echo $this->getcomment($this->session->userdata('user_id'));
		}else echo 0;
	}
	public function getavgminques($dif,$fid=""){
	  if(!empty($dif)){
		  $this->load->model("process");
		  if($fid == "")	$id = $_SESSION["user_id"];
		  else $id = $fid;
		  $list = $this->process->getsemdivlist($id);
		  $per = [];
		  if($dif == "Theory"){
			  $questions = $this->process->getques("questions_th");
			  $func = "gendatath";
		  }	
		  if($dif == "Prac"){
			  $questions = $this->process->getques("questions_pr");
			  $func = "gendatapr";
		  }
		  $flag = false;
		  foreach($list as $key => $dat){
			  if($this->process->issemdivflag($id,$dat->Sem, $dat->Divi, $dat->course, $dif) == 1){
				  $flag = true;
				  $per[] = $this->process->$func($id,$dat->Sem,$dat->Divi,0);
			  }
		  }
		  if(!$flag){
			  echo 0;
			  return;
		  }	
		  $avg = [];
		  $total = 0;
		  for($i=1; $i<=(count($questions)); $i++){
			  for($y=0; $y<=count($per)-1; $y++){
				  $total += $per[$y][$i];
			  }
			  $avg[$i] = $total/count($per);
			  $total = 0;
		  }
		  $avgper = min($avg);
		  $keys = array_keys($avg, $avgper);
		  $this->load->model("ctable");
		  if($this->ctable->hasresponded($id)){
			$comment = $this->escapeHtml($this->ctable->getcomment($id)[0]->comment);
		  }else{
			  $comment = "";
		  }
		  $array = [number_format((float) $avgper, 2), $comment];
		  foreach($keys as $key){
			  $array[] = $questions[$key-1]->Ques;
		  }
		  echo json_encode($array);
	  }
    }
	public function performancefeedback($dif = ""){
		if($this->session->userdata('user_type') == "admin"){
		  $this->load->model("process");
		  $data['facl'] = $this->process->getIdFname();
		  $data['semyear'] = $this->getsemyr();
		  $staff = $this->process->getOnlyTheoryStaff();
		  $allper = [];
		  foreach($staff as $id => $obj){
			  $allper[$obj->Fid] = $this->process->genDataThAvg($obj->Fid);
		  }
		  $totalavg = array_sum($allper) / count($allper);
		  $data['avg'] = $totalavg;
		  $data['gthres'] = $threshold1 = $totalavg + ((5*$totalavg)/100);
		  $data['bthres'] = $threshold2 = (2*$totalavg)/3;
		  $appr = array_filter($allper,
				function ($value) use($threshold1) {
					return ($value >= $threshold1);
				}
			);
		  $bad = array_filter($allper,
				function ($value) use($threshold2) {
					return ($value <= $threshold2);
				}
		  );
		  $data['appr'] = array_map(function($num){return number_format((float) $num,2);}, $appr);
		  $data['bad'] = array_map(function($num){return number_format((float) $num,2);}, $bad);
		  $this->load->view("performance",$data);
	  }else{
		$this->load->view('error', 1);
	  }
    }
	public function getsemyr(){
		$this->load->model("process");
		$data = $this->process->getsemyear();
		$timestamp = $data['year'];
		$next = $data['year2'];
		$type = $data['type'];
		return $timestamp."-".$next." (".$type.")";
	}
	public function getsemyear(){
		$this->load->model("process");
		$data = $this->process->getsemyear();
		$timestamp = $data['year'];
		$next = $data['year2'];
		$type = $data['type'];
		echo $timestamp."-".$next." (".$type.")";
	}
	public function downloadexcelsheet($sem, $div, $type){
		if(isset($_SESSION['sheet_th']) or isset($_SESSION['sheet_pr'])){
			if($type == "Th") $spreadsheet = $_SESSION['sheet_th'];
			if($type == "Pr") $spreadsheet = $_SESSION['sheet_pr'];
			if($sem % 2 == 0)	$i = $sem;
			else $i = ++$sem;
			$yr = array(2 => 'FE', 4 => 'SE', 6 => 'TE', 8 => 'BE');
			$yrdivty = $yr[$i] . "_" . $div . "_" . $type;
			$writer = new Xlsx($spreadsheet);
			$name = "Spreadsheet_".$yrdivty.".xlsx";
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename='.$name);
			$writer->save("php://output");
		}
	}
	public function takebackup(){
		if($this->session->userdata('user_type') == "admin"){
			$username = "root"; 
			$password = ""; 
			$hostname = "localhost"; 
			$dbname   = "feedback";
			$backup_file = $dbname.'_'.date("Y-m-d-H-i-s").'.sql';
			$command = "C:/xampp/mysql/bin/"."mysqldump.exe --user=root --host=localhost feedback > $backup_file";
			exec($command);
			$content = file_get_contents("$backup_file");
			header('Content-Type: application/octet-stream');
			header('Content-Disposition: attachment; filename='.$backup_file);
			header('Pragma: no-cache');
			unlink($backup_file);
			echo $content;
		}else{
			$this->load->view('error', 1);
	  }
	}
	public function getclassdiv($sem,$div){
		if($sem % 2 == 0)	$i = $sem;
		else $i = ++$sem;
		$yr = array(2 => 'FE', 4 => 'SE', 6 => 'TE', 8 => 'BE');
		return $yr[$i] . $div;
	}
    public function table($sem=0,$div=0){
		if($this->session->userdata('user_type') == "admin"){
		  $this->load->model("process");
		  $tmp = $this->db->query("Select Distinct Sem from load_mat");
		  $data['sem'] = $tmp->result();
		  $data['questions_th'] = $this->process->getques("questions_th");
		  $data['questions_pr'] = $this->process->getques("questions_pr");
		  $th_list = $this->process->getTheoryStaff($sem,$div);
		  $pr_list = $this->process->getPracticalStaff($sem,$div);
		  $data['stud_count_th'] = $this->process->getNumberOfStudentsTh($sem,$div);
		  $data['stud_count_pr'] = $this->process->getNumberOfStudentsPr($sem,$div);
		  $data['entries_th'] = count($th_list) * count($data['questions_th']);
		  $data['entries_pr'] = count($pr_list) * count($data['questions_pr']);
		  $data['staffListTh'] = $th_list;
		  $data['staffListPr'] = $pr_list;
		  $data['semister'] = $sem;
		  $data['division'] = $div;
		  $data['class'] = $this->getclassdiv($sem,$div);
		  $thdata = array();
		  $prdata = array();
		  foreach ($th_list as $row) {
			$data1 = $this->process->gendatath($row->Fid,$sem,$div,0);
			$thdata[$row->Fid] = $data1;
			$thavg[$row->Fid] = number_format((float) (array_sum($data1) / count($data1)), 2);
		  }
		  foreach ($pr_list as $row) {
			$data2 = $this->process->gendatapr($row->Fid,$sem,$div,0);
			$prdata[$row->Fid] = $data2;
			$pravg[$row->Fid] = number_format((float) (array_sum($data2) / count($data2)), 2);
		  }
		  $data['thdata'] = $thdata;
		  $data['prdata'] = $prdata;
		  $data['thavg'] = $thavg;
		  $data['pravg'] = $pravg;
		  if($sem != 0 && $div != 0){
			  // Theory Excel
			  $spreadsheet = new Spreadsheet();
			  $sheet = $spreadsheet->getActiveSheet();
			  $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			  $drawing->setName('Logo');
			  $drawing->setDescription('Logo');
			  $drawing->setPath(FCPATH . 'dist/img/header.jpg');
			  $drawing->setWorksheet($sheet);
			  $drawing->setCoordinates('B1');
			  $sheet->setCellValue('A10', 'Class:');
			  $sheet->setCellValue('B10', $data['class']);
			  $sheet->setCellValue('A11', 'Faculty');
			  $sheet->setCellValue('B11', 'Subject');
			  $sheet->setCellValue('D10', 'Students count Theory:');
			  $sheet->setCellValue('E10', $data['stud_count_th']);
			  $sheet->setCellValue('G10', 'Total Entries:');
			  $sheet->setCellValue('H10', $data['entries_th']);
			  $sheet->getStyle('A10')->getFont()->setBold(true);
			  $sheet->getStyle('D10')->getFont()->setBold(true);
			  $sheet->getStyle('G10')->getFont()->setBold(true);
			  $i = 1;
			  $alph = 'C';
			  foreach($data['questions_th'] as $qth){
				  $sheet->setCellValue($alph.'11', 'Q'.$i);
				  $i++;
				  $alph++;
			  }
			  $sheet->setCellValue($alph.'11', 'Avg.');
			  $i = 12;
			  foreach($th_list as $key => $value){
				  $alp = 'C';
				  $sheet->setCellValue('A'.$i, $value->F_name);
				  $sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
				  $sheet->setCellValue('B'.$i, $value->course);
				  foreach($thdata[$value->Fid] as $key2 => $value2){
				    $sheet->setCellValue($alp.$i, $value2.'%');
				    $sheet->setCellValue($alph.$i, $thavg[$value->Fid].'%');
					$alp++;
				  }
				  $i++;
			  }
			  $_SESSION['sheet_th'] = $spreadsheet;
			  // Practical Excel
			  $spreadsheet = new Spreadsheet();
			  $sheet = $spreadsheet->getActiveSheet();
			  $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
			  $drawing->setName('Logo');
			  $drawing->setDescription('Logo');
			  $drawing->setPath(FCPATH . 'dist/img/header.jpg');
			  $drawing->setWorksheet($sheet);
			  $drawing->setCoordinates('B1');
			  $sheet->setCellValue('A10', 'Class:');
			  $sheet->setCellValue('B10', $data['class']);
			  $sheet->setCellValue('A11', 'Faculty');
			  $sheet->setCellValue('B11', 'Subject');
			  $sheet->setCellValue('D10', 'Students count Practicals:');
			  $sheet->setCellValue('E10', $data['stud_count_pr']);
			  $sheet->setCellValue('G10', 'Total Entries:');
			  $sheet->setCellValue('H10', $data['entries_pr']);
			  $sheet->getStyle('A10')->getFont()->setBold(true);
			  $sheet->getStyle('D10')->getFont()->setBold(true);
			  $sheet->getStyle('G10')->getFont()->setBold(true);
			  $i = 1;
			  $alph = 'C';
			  foreach($data['questions_pr'] as $qth){
				  $sheet->setCellValue($alph.'11', 'Q'.$i);
				  $i++;
				  $alph++;
			  }
			  $sheet->setCellValue($alph.'11', 'Avg.');
			  $i = 12;
			  foreach($pr_list as $key => $value){
				  $alp = 'C';
				  $sheet->setCellValue('A'.$i, $value->F_name);
				  $sheet->getStyle('A'.$i)->getAlignment()->setWrapText(true);
				  $sheet->setCellValue('B'.$i, $value->course);
				  foreach($prdata[$value->Fid] as $key2 => $value2){
				    $sheet->setCellValue($alp.$i, $value2.'%');
				    $sheet->setCellValue($alph.$i, $pravg[$value->Fid].'%');
					$alp++;
				  }
				  $i++;
			  }
			  $_SESSION['sheet_pr'] = $spreadsheet;
		  }
		  $this->load->view("tabulardata",$data);
	  }else{
		$this->load->view('error', $aid);
		}
    }
    public function index(){
       $aid=$this->session->userdata('user_id');
        $this->load_page($aid);
      }
    public function load_page($aid)
    {
		if($this->session->userdata('user_type') == "admin"){
			$this->load->model('process');
			$data['facl_list'] = $this->process->getfaculty();
			$this->load->view('admin_panel',$data);
		}else{
			$this->load->view('error', $aid);
		}
    }
    public function getq(){
      $this->load->model('process');
      $data = $this->process->getques("questions_th");
      foreach ($data as $row) {
        echo '<p class="ques" style="font-size:12px">'.$row->Qid.')'.$row->Ques.'</p>';
      }
    }
    public function getq_pr(){
      $this->load->model('process');
      $data = $this->process->getques("questions_pr");
      foreach ($data as $row) {
        echo '<p class="ques" style="font-size:12px">'.$row->Qid.')'.$row->Ques.'</p>';
      }
    }
    public function generate()
    {
        $this->load->model('process');
        $data = $this->process->getFid();
        $fid = $_SESSION['user_id'];
        $this->process->genTable($data,$fid);
    }
    public function getc($fname){
      $this->load->model('process');
      $raw = $this->process->getclist($fname);
      foreach ($raw as $data) {
        $sem = $data->sem;
        echo "<option value=\"$sem\">Sem $sem</option>";
      }
    }
    public function getsub($fname,$sem,$div){
      $this->load->model('process');
      $raw = $this->process->getsublist($fname,$sem,$div);
      foreach ($raw as $data) {
        $course = $data->course;
        echo "<option value=\"$course\">$course</option>";
      }
    }
    public function gendatath($fname,$sem,$div,$course){
      $this->load->model('process');
      echo json_encode($this->process->gendatath($fname,$sem,$div,urldecode($course)));
    }
    public function gendatapr($fname,$sem,$div,$course){
      $this->load->model('process');
      echo json_encode($this->process->gendatapr($fname,$sem,$div,urldecode($course)));
    }
    public function checkthpr($fname,$sem,$div,$course){
      $this->load->model('process');
      $this->process->checkthpr($fname,$sem,$div,urldecode($course));
    }
    public function getdiv($fname,$sem){
      $this->load->model('process');
      $raw = $this->process->getdivlist($fname,$sem);
      foreach ($raw as $data) {
        $course = $data->divi;
        echo "<option value=\"$course\">$course</option>";
      }
    }
    public function thgetvals($fname,$class,$div){

    }
    public function prgetvals($fname,$class,$div){
      //Get Practical Values
    }
}
